<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $conges=Conge::all();
        $conges=Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();
        // dd($conges);
        // dd($conges_en_attente->employe);

        // combine les deux tableaux
        $conge_events = $conges->merge($conges_en_attente);

        return view('manager.home_manager', compact('conges', 'conges_en_attente', 'nbr_en_attente', 'conge_events'));
    }

    public function calendrier_conge()
    {
        return view('manager.calendrier_conge');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
