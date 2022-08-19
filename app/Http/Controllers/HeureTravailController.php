<?php

namespace App\Http\Controllers;

use App\Models\HeureTravail;
use Illuminate\Http\Request;
use App\Models\HeureDeTravail;
use App\Http\Controllers\Controller;

class HeureTravailController extends Controller
{
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
     * @param  \App\Models\HeureTravail  $heureTravail
     * @return \Illuminate\Http\Response
     */
    public function show(HeureDeTravail $heureTravail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeureTravail  $heureTravail
     * @return \Illuminate\Http\Response
     */
    public function edit(HeureDeTravail $heureTravail)
    {


        // editer des donnés dans la table heure_de_travail

                $heureTravail = HeureDeTravail::get([
                    'id',
                    'designation',
                    'heure_debut',
                    'heure_fin',
                    'debut_pause',
                    'fin_pause',
                ]);





        return view('referent.work_times', compact('heureTravail'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeureTravail  $heureTravail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeureDeTravail $heureTravail)
    {

        // defini les heures de la table heure_de_travail à partir des donnés du formulaire work_times.blade.php
        $heureTravail->designation = $request->input('designation');
        $heureTravail->heure_debut = $request->input('heure_debut');
        $heureTravail->heure_fin = $request->input('heure_fin');
        $heureTravail->debut_pause = $request->input('debut_pause');
        $heureTravail->fin_pause = $request->input('fin_pause');

;


          $heureTravail->update([
            'designation' => $request->time_id,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'debut_pause' => $request->debut_pause,
            'fin_pause' => $request->fin_pause,
        ]);


        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeureTravail  $heureTravail
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeureDeTravail $heureTravail)
    {
        //
    }
}
