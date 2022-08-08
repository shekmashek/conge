<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // utilisation de la fonction dans Helpers.php
        list($worktime) = getWorkingHours($debut,$fin);

        $intervale = DateInterval::createFromDateString($worktime['duration']);
        $nombre_j_travail = $worktime['dt']/8;
        $hours=$intervale->h;


        if ($hours >= 4 && $hours < 8) {
            $d=0.5;
            $nbt_jour=$nombre_j_travail+$d;
            $nouveau_cumul=subDateInterval($conge->cumul_perso, DateInterval::createFromDateString($nombre_j_travail.' days 12 hours'));

        } else if($hours < 4) {
            $nbt_jour=$nombre_j_travail;
            $nouveau_cumul=subDateInterval($conge->cumul_perso, DateInterval::createFromDateString($nombre_j_travail.' days'));
        } else {
            $nbt_jour=$nombre_j_travail;
            $nouveau_cumul=subDateInterval($conge->cumul_perso, DateInterval::createFromDateString($nombre_j_travail.' days'));
        }

        $cumul_perso=DateInterval::createFromDateString($conge->cumul_perso);

        Conge::where('id',$conge_id)->update([
            'etat_conge_id'=>1,
            'intervale' => $worktime['duration'],
            'duree_conge'=> $worktime['dt']*60,
            'j_utilise'=>$nombre_j_travail,
            'cumul_perso'=>$conge->cumul_perso,
            'restant'=>$nouveau_cumul,

        ]);

        return response()->json([
            'nbr_jour'=>$nbt_jour,
            'worktime'=>$worktime['duration'],
            'nbr_heure'=>$hours,
            'period'=>$nbt_jour.' jours',
            'cumul_perso'=>$cumul_perso,
            'nouveau_cumul'=>$nouveau_cumul,
        ]);

    }


    public function refuser_demande(Request $request) {

        $conge_id=$request->conge_id;

        $conge=Conge::where('id', $conge_id)->first();

        $debut=new DateTime($conge->debut);
        $fin=new DateTime($conge->fin);

        list($worktime) = getWorkingHours($debut,$fin);

        $cumul_perso=DateInterval::createFromDateString($conge->cumul_perso);

        Conge::where('id',$conge_id)->update([
            'etat_conge_id'=>2,
            'intervale' => $worktime['duration'],
            'duree_conge'=> $worktime['dt']*60,
            'j_utilise'=>0,
            'restant'=>$conge->cumul_perso,

        ]);



        return response()->json([
            'worktime'=>$worktime['duration'],
            'nbr_heure'=>$worktime['dt'],
            'cumul_perso'=>$cumul_perso,
        ]);

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
