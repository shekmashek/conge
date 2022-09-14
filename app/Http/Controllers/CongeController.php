<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use App\Models\Conge;
use App\Models\Employe;
use App\Models\TypeConge;
use Illuminate\Http\Request;
use App\Mail\RefuserCongeMail;
use App\Mail\AccepterCongeMail;
use App\Jobs\SendRejectCongeMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendApproveMailCongeJob;

class CongeController extends Controller
{


    public function accepter_demande(Request $request) {


        if (Gate::allows('isManager')) {
            $conge_id=$request->conge_id;

            $conge=Conge::where('id', $conge_id)->first();


            // Le manager étant qussi un employé, il ne peut pas valider ses propres congés
            // Un employe ne peut pas valider sa propre demande de congé
            if ($conge->employe_id != Auth()->user()->id) {

                $debut=new DateTime($conge->debut);
                $fin=new DateTime($conge->fin);


                // transformer le string 'intervalle' en objet DateIntervale php
                // sans prendre en compte les heures non valides
                // $intervalle = date_diff($debut,$fin);

                // en prenant compte les heures non valides (ex: 1er janvier)
                // utilisation de la fonction getWorkingHours dans Helpers.php
                $worktime = getWorkingHours($debut,$fin,$conge->employe->heure_de_travail->heure_debut, $conge->employe->heure_de_travail->heure_fin,$conge->employe->heure_de_travail->debut_pause,$conge->employe->heure_de_travail->fin_pause);

                $intervalle = DateInterval::createFromDateString($worktime['duration']);
                $nombre_j_travail =intval($worktime['dt']/8);
                $hours=$intervalle->h;


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
                    'intervalle' => $worktime['duration'],
                    'duree_conge'=> $worktime['dt']*60, // durée en minute
                    'j_utilise'=>$nbr_jour,
                    'cumul_perso'=>$nouveau_cumul,
                    'restant'=>$nouveau_cumul,

                ]);

                // ne pas oublier d'excecuter : php artisan queue:work pour envoyer les mails en file d'attente
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
            } else {
                return response()->json([
                    'error'=>'Vous ne pouvez pas accepter votre propre demande de congé',
                ]);
            }

        } else {
            return response()->json([
                'error'=>'Vous ne pouvez pas accepter votre propre demande de congé',
            ]);
        }


    }


    public function refuser_demande(Request $request) {

        if (Gate::allows('isManager')) {
            $conge_id=$request->conge_id;
            $message=$request->message;
            $conge=Conge::where('id', $conge_id)->first();



            $debut=new DateTime($conge->debut);
            $fin=new DateTime($conge->fin);

            $worktime = getWorkingHours($debut,$fin, $conge->employe->heure_de_travail->heure_debut, $conge->employe->heure_de_travail->heure_fin,$conge->employe->heure_de_travail->debut_pause, $conge->employe->heure_de_travail->fin_pause);


            if ($conge->cumul_perso) {
                $cumul_perso=DateInterval::createFromDateString($conge->cumul_perso);
            } else if(!$conge->cumul_perso && $conge->type_conge->max_duration) {
                $cumul_perso=DateInterval::createFromDateString($conge->type_conge->max_duration);
            } else {
                $cumul_perso=null;
            }


            Conge::where('id',$conge_id)->update([
                'etat_conge_id'=>2,
                'intervalle' => $worktime['duration'],
                'duree_conge'=> $worktime['dt']*60, // en minute
                'j_utilise'=>0,
                'restant'=>$conge->cumul_perso,

            ]);

            SendRejectCongeMail::dispatch($conge,$message);
            // Mail::to($conge->employe->email_emp)->locale(config('app.locale'))->send(new RefuserCongeMail($conge,$message));

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

        } else {
            return response()->json([
                'error'=>'Vous ne pouvez pas refuser votre propre demande de congé',
            ]);
       }


    }


    public function conge_employe($id) {

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



    public function congeEnAttenteJson(){
        $etat_conge_id = 3;
        $congesEnAttentes = DB::Table('conges')
        ->select(DB::raw('conges.id as idConge, conges.debut, motif, conges.fin, DATEDIFF(conges.fin, conges.debut) AS nombre_jours, conges_etats_conge.etat_conge'))
        ->join('conges_etats_conge', 'etat_conge_id', '=', 'etats_conge.id')
            ->where('conges.etat_conge_id', '=', $etat_conge_id)
            ->get();
        return json_encode($congesEnAttentes);
    }

    public function congeValideJson(){
        $etat_conge_id = 1;
        $congesValides = DB::Table('conges')
        ->select(DB::raw('conges.id as idConge, conges.debut, motif, conges.fin, DATEDIFF(conges.fin, conges.debut) AS nombre_jours, conges_etats_conge.etat_conge'))
        ->join('conges_etats_conge', 'etat_conge_id', '=', 'etats_conge.id')
        ->where('conges.etat_conge_id', '=', $etat_conge_id)
        ->get();
        return json_encode($congesValides);
    }

    public function congeEnAttente(){
        return view('congeEnAttente');
    }

    public function congeValide(){
        return view('congeValide');
    }



    ///////////////////////////////////////////////////////////
    // EMPLOYE

    public function homeCongeEmploye()
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        // $type_conge = new TypeConge;
        $type_conges = TypeConge::All();
        $conge = new Conge;
        $conges = json_encode($conge->getAll());
        $historiquesCongeEmp = $this->getListCongesEmpJson();
        // dd($historiquesCongeEmp);
        $solde = $this->soldeEmployeJours();
        $dateEmbauche = $this->getDateEmbaucheEmploye();
        $reste_conge = $this->getAbsenceEnAttent();
        $moisJour=$this->getMoisJourAbsenceEnAttent();
        // $historiques = $this->historique_congeJson();
        // return view('home', compact('type_conges', 'conges'));
        return view('conge_employe.home_conge_employe', compact('type_conges', 'conges', 'solde', 'dateEmbauche', 'reste_conge', 'moisJour', 'historiquesCongeEmp'));
    }

    public function insertConge(Request $request)
    {
        $employe = Auth::user()->employe;

        $debut = $request->debut.' '.$employe->heure_de_travail->heure_debut;
        $fin = $request->fin.' '.$employe->heure_de_travail->heure_fin;


        $conge=Conge::create(
            [
                'employe_id' => $employe->id,
                'type_conge_id' => $request->type_conge_id,
                'debut' => $request->date_debut,
                'fin' => $request->date_fin,
                'motif' => $request->motif,
                'duree_conge' => DB::raw("TIMESTAMPDIFF(MINUTE,'".$debut."','".$fin."')"),
                'etat_conge_id' => 3,
            ]
        );

        $solde = $this->soldeEmployeJours();

        $data = Conge::all();

        $dateEmbauche = $this->getDateEmbaucheEmploye();
        $reste_conge = $this->getAbsenceEnAttent();
        $moisJour=$this->getMoisJourAbsenceEnAttent();
        $historiques = $this->historique_congeJson();
        $historiquesCongeEmp = Conge::where('employe_id',$employe->id)->get();
        return response()->json(['success' => 'abscence ajouter avec succes!', 'data' => $data, 'reste_conge' => $reste_conge,'moisJour'=>$moisJour]);
    }

    //select identifiant employe a partir de son l'user authentifier
    public function getDetailsEmployerIdByUserId()
    {
        $id_user = Auth::user()->id;
        $details = Employe::where('user_id', '=', $id_user)
            ->get(['id as Employe_id',  'user_id', 'created_at', 'date_embauche']);
        // dd($details[0]['created_at']->format('M-Y'));
        return $details;
    }

    // duree de travail dans l'entreprise
    public function dateValabiliteCongePayeEmploye()
    {
        $employe = $this->getDetailsEmployerIdByUserId();
        for ($i = 0; count($employe); $i++) {
            $nombreJourApresDebutTravail = (DB::raw("TIMESTAMPDIFF(DAY'" . $employe[$i]['created_at'] . "','now()'"));
            if ($nombreJourApresDebutTravail > 365) {
                return 1;
            }
        }
        return 0;
    }

    //Date de premiere embauche vers la date actuelle
    public function getDateEmbaucheEmploye()
    {
        $detailEmp = $this->getDetailsEmployerIdByUserId();
        $datePremierEmbauche = $detailEmp[0]['created_at']->format('M-Y');
        $date_actuelle = now()->format('M-Y');
        return 'De ' . $datePremierEmbauche . ' à ' . $date_actuelle;
    }

    //cumule annnee conge paye par date expiration selon l'entreprise
    public function getCumuleAnneeCongePayeEmploye(Request $request)
    {
        if ($request->input('type_motif_conge_id') == 1) {
            $getDateExpirationConge = TypeConge::where('id', '=', 1)->get(['date_expiration']);
            $anneActuelle = now()->format('Y');
            $anneCumul = (int)$anneActuelle - (int)$getDateExpirationConge[0]['date_expiration'];
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function soldeEmployeJours()
    {
        $detail_employe = $this->getDetailsEmployerIdByUserId();
        $date_embauche = $detail_employe[0]['created_at']->format('Y');
        // echo $date_embauche;
        $date_actuelle = now()->format('Y');
        // echo $date_actuelle;
        $diffAnnee = $date_actuelle - $date_embauche;
    ///solde en minute convertis en jours
        $solde = TypeConge::sum('solde') * 3 / 1440;
        // echo $solde;
        $arrondissementMin = floor($solde);
        $decimal = $solde - $arrondissementMin;
        if ($decimal > 0.5) {
            $solde = ceil($solde);
        } elseif ($decimal > 0 && $decimal <= 0.5) {
            $solde = $arrondissementMin + 0.5;
        }
        return $solde;
    }

    /*public function getHeureAbsenceParMois()
    {
        $congePaye=Conge::join('types_conge as t','conges.type_conge_id','=','types_conge.id')
                        ->where('t.nom_conges')
    }*/


    //Absence en attente
    public function getAbsenceEnAttent()
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        //dump($id_employe);
        $date_actuelle = now()->format('Y');
        $data = Conge::where('employe_id', '=', $id_employe)
            ->where('etat_conge_id', '=', 3)
            ->whereYear('debut', '=', $date_actuelle)
            ->sum('duree_conge') / 1440;
        // dd($data);
        $arrondissementMin = floor($data);
        $decimal = $data - $arrondissementMin;
        if ($decimal > 0.5) {
            $data = ceil($data);
        } elseif ($decimal > 0 && $decimal <= 0.5) {
            $data = $arrondissementMin + 0.5;
        }
        return $data;
    }
    //Mois d'absence en attente
    public function getMoisJourAbsenceEnAttent()
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['id'];
        //dump($id_employe);
        $date_actuelle = now()->format('Y');
        $dateDebutMin = Conge::where('employe_id', '=', $id_employe)
            ->where('etat_conge_id', '=', 3)
            ->min('debut');
        $dateFinMax = Conge::where('employe_id', '=', $id_employe)
            ->where('etat_conge_id', '=', 3)
            ->max('fin');

        $var1=new DateTime($dateDebutMin);
        $var2=new DateTime( $dateFinMax);

        return date_format($var1, 'M-d').'  à  '.date_format($var2, 'M-d');
    }

    // La liste de conge de tous les utilisateurs
    public function historique_congeJson(){
        $conges = DB::table('conges')
            ->join('conges_etats_conge', 'etat_conge_id', '=', 'conges_etats_conge.id')
            ->join('conges_types_conge', 'type_conge_id', '=', 'conges_types_conge.id')
            ->join('conges_frequences_solde', 'conges_types_conge.frequence_solde_id', '=', 'conges_frequences_solde.id')
            ->join('employes', 'employe_id', '=', 'employes.id')
            ->get();
        return $conges;
    }

    public function getListCongesEmpJson(){
        $conge = new Conge;
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        return $conge->getListCongesByEmpId($id_employe);
    }

    public function historique_conge(){
        return view('conge_employe.historique_conge');
    }

}
