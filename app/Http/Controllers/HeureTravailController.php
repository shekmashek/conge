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
        // dd($request->all());

        // defini les heures de la table heure_de_travail à partir des donnés du formulaire work_times.blade.php
        $heureTravail = HeureDeTravail::find($request->id);

        // dd($heureTravail);
        if($request->debut_pause ==null && $request->fin_pause ==null){

            $heureTravail->heure_debut = $request->input('heure_debut');
            $heureTravail->heure_fin = $request->input('heure_fin');

            $heureTravail->debut_pause = $heureTravail->debut_pause;
            $heureTravail->fin_pause = $heureTravail->fin_pause;


            $heureTravail->save();
        }
        else if($request->heure_debut ==null && $request->heure_fin ==null){

            $heureTravail->heure_debut = $heureTravail->heure_debut;
            $heureTravail->heure_fin =  $heureTravail->heure_fin;
            $heureTravail->debut_pause = $request->input('debut_pause');
            $heureTravail->fin_pause = $request->input('fin_pause');


            $heureTravail->save();
        }

        return redirect()->back()->with('success', 'Modification effectuée avec succès');

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
