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
        $intervale = date_diff($debut,$fin);
        $nbr_jour = intval($intervale->format('%a'));
        $nbr_heure = $intervale->h;

        $worktime = getWorkingHours($debut,$fin);

        $intervale = DateInterval::createFromDateString($worktime);

        $hours=$intervale->h;

        if ($hours >= 4 && $hours < 8) {
            $d=0.5;
            $days=intval($hours/8)+$d;
        } else if($hours < 4) {
            $days=intval($hours/8);
        } else {
            $days=intval($hours/8);
        }


        Conge::where('id',$conge_id)->update([
            'etat_conge_id'=>1,
            'j_utilise'=>$days,
        ]);

        return response()->json([
            'nbr_jour'=>$nbr_jour,
            'nbr_heure'=>$hours,
            'period'=>$days.' jours'
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
