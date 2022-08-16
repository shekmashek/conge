<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use App\Models\Conge;
use Illuminate\Http\Request;
use App\Mail\RefuserCongeMail;
use App\Mail\AccepterCongeMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendApproveMailCongeJob;

class CongeController extends Controller
{


    public function accepter_demande(Request $request) {

        $conge_id=$request->conge_id;

        $conge=Conge::where('id', $conge_id)->first();

        $debut=new DateTime($conge->debut);
        $fin=new DateTime($conge->fin);


        // transformer le string 'intervale' en objet DateIntervale php
        // sans prendre en compte les heures non valides
        // $intervale = date_diff($debut,$fin);

        // en prenant compte les heures non valides (ex: 1er janvier)
        // utilisation de la fonction getWorkingHours dans Helpers.php
        list($worktime) = getWorkingHours($debut,$fin,$conge->employe->heure_entree, $conge->employe->heure_sortie);

        $intervale = DateInterval::createFromDateString($worktime['duration']);
        $nombre_j_travail =intval($worktime['dt']/8);
        $hours=$intervale->h;


        if ($conge->cumul_perso) {
            $cumul_perso=DateInterval::createFromDateString($conge->cumul_perso);
        } else if(!$conge->cumul_perso && $conge->type_conge->max_duration) {
            $cumul_perso=DateInterval::createFromDateString($conge->type_conge->max_duration);
        } else {
            $cumul_perso=null;
        }

        // puisqu'un journée de travail est de 8 heures, le nombre d'heure restant ne peut dépasser 8
        // 8 heures = 1 jour de travail.

        // Si le nombre d'heure est supérieur à 4 mais inférieur à 8
        // On compte une demi-journée de travail.
        // Sur un DateIntervalle cela fait 12h sur 24.

        // les fonctions subDateInterval et addDateInterval sont définies dans Helpers.php

        if ($hours >= 4 && $hours < 8) {
            $d=0.5;
            $nbr_jour=$nombre_j_travail+$d;
            $nouveau_cumul=subDateInterval($cumul_perso, DateInterval::createFromDateString($nombre_j_travail.' days 12 hours'));

        } else if($hours < 4) {
            // si le nombre d'heure est inférieur à 4 : on ne compte pas ces heure
            // nombre de jour de travail = nombre d'heure / 8.
            $nbr_jour=intval($worktime['dt']/8);
            $nouveau_cumul=subDateInterval($cumul_perso, DateInterval::createFromDateString($nbr_jour.' days'));
        } else if($hours >= 8) {
            // si le nombre d'heures restant est de 8 : on divise l'heure totale par 8
            // ce qui donne un nombre de jour entier.
            // +8 h de travail ne peut arriver ( 08:00 - 17:00 )
            $nbr_jour=round($worktime['dt']/8);
            $nouveau_cumul=subDateInterval($cumul_perso, DateInterval::createFromDateString($nbr_jour.' days'));
        }


        // changer les info du congé acctépté :
        // etat 1 : accepté
        // interval : DateInterval des heures de travail.
        // cumul_perso et restant : DateInterval restant après la demande acceptée.
        // restant garde le nombre et cumul_perso varie selon les soldes de congé.
        // j_utilise : nombre de jour ( 1/0.5/5.5 ) utilisé à la demande : 1 ou une demi-journée.
        Conge::where('id',$conge_id)->update([

            'etat_conge_id'=>1,
            'interval' => $worktime['duration'],
            'duree_conge'=> $worktime['dt']*60, // durée en minute
            'j_utilise'=>$nbr_jour,
            'cumul_perso'=>$nouveau_cumul,
            'restant'=>$nouveau_cumul,

        ]);

        SendApproveMailCongeJob::dispatch($conge,$nbr_jour);
        // Mail::to($conge->employe->email_emp)->locale(config('app.locale'))->send(new AccepterCongeMail($conge,$nbr_jour));

        return response()->json([
            'employe'=>$conge->employe->nom_emp.' '.$conge->employe->prenom_emp,
            'nbr_jour'=>$nbr_jour,
            'nbr_heure'=>$worktime['dt'],
            'worktime'=>$worktime['duration'],
            'reste_heure'=>$hours,
            'period'=>$nbr_jour.' jours',
            'cumul_perso'=>$cumul_perso,
            'nouveau_cumul'=>$nouveau_cumul,
        ]);

    }


    public function refuser_demande(Request $request) {

        $conge_id=$request->conge_id;
        $message=$request->message;
        $conge=Conge::where('id', $conge_id)->first();



        $debut=new DateTime($conge->debut);
        $fin=new DateTime($conge->fin);

        list($worktime) = getWorkingHours($debut,$fin, $conge->employe->heure_entree, $conge->employe->heure_sortie);


        if ($conge->cumul_perso) {
            $cumul_perso=DateInterval::createFromDateString($conge->cumul_perso);
        } else if(!$conge->cumul_perso && $conge->type_conge->max_duration) {
            $cumul_perso=DateInterval::createFromDateString($conge->type_conge->max_duration);
        } else {
            $cumul_perso=null;
        }


        Conge::where('id',$conge_id)->update([
            'etat_conge_id'=>2,
            'interval' => $worktime['duration'],
            'duree_conge'=> $worktime['dt']*60, // en minute
            'j_utilise'=>0,
            'restant'=>$conge->cumul_perso,

        ]);


        Mail::to($conge->employe->email_emp)->locale(config('app.locale'))->send(new RefuserCongeMail($conge,$message));

            if ($request->ajax()) {
                return response()->json([
                    'message'=>'blabla',
                    'worktime'=>$worktime['duration'],
                    'nbr_heure'=>$worktime['dt'],
                    'cumul_perso'=>$cumul_perso,
                ]);
            } else {
                return redirect()->back();
            }

    }

    public function congeValideAPI()
    {
        $conges = Conge::where('etat_conge_id',1)->get();
        return response()->json($conges);
    }

    public function congeRefuseAPI()
    {
        $conges = Conge::where('etat_conge_id',2)->get();
        return response()->json($conges);
    }

    public function congeEnAttenteAPI()
    {
        $conges = Conge::where('etat_conge_id',3)->get();
        return response()->json($conges);
    }

    public function congeNonPayeEmployeAPI($id)
    {
        if ($id) {
            $conges = Conge::where('employe_id',$id)->where('type_conge_id',8)
            ->orWhere('type_conge_id',7)
            ->get();
        } else {
            $conges = Conge::where('type_conge_id',8)
            ->orWhere('type_conge_id',7)
            ->get();
        }

        return response()->json($conges);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
    public function show(Conge $conge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
    public function edit(Conge $conge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conge $conge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conge $conge)
    {
        //
    }
}
