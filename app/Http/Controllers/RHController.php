<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RHController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conges=Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();


        return view('rh.home_rh', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
    }

    public function calendrier_conge()
    {
        $conges=Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();
        return view('rh.calendrier_conge', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
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
