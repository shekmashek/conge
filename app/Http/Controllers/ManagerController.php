<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $conges=Conge::all();
        $conges=Conge::with('employe', 'type_conge', 'etat_conge')->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();


        if ($request->ajax()) {
            $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')->where('etat_conge_id', 3)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

            $conges_en_attente= DataTables::of($conges_en_attente)
                                ->toJson();

            return $conges_en_attente;
        }

        return view('manager.home_manager', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
    }

    public function listeCongeEnAttente(Request $request)
    {
        if ($request->ajax()) {
            $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')->where('etat_conge_id', 3)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

            $conges_en_attente= DataTables::of($conges_en_attente)
                                ->toJson();

            return $conges_en_attente;
        }
    }

    public function listeConge(Request $request)
    {
        if ($request->ajax()) {
            $conges=Conge::with('employe','type_conge', 'etat_conge')->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

            $conge= DataTables::of($conges)
                                ->toJson();

            return $conge;
        }
    }



    public function calendrier_conge(Request $request)
    {

        $conges=Conge::with('employe','type_conge', 'etat_conge')->where('etat_conge_id', 1)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        foreach ($conges as $key => $value) {
                $value->title = $value->employe->nom_emp.' '.$value->employe->prenom_emp;
                $value->start = $value->debut;
                $value->end = $value->fin;
                $value->color = $value->type_conge->couleur;
        }


                    if ($request->ajax()) {
                        $conges=Conge::with('employe','type_conge', 'etat_conge')->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

                        foreach ($conges as $key => $value) {
                                $value->title = $value->employe->nom_emp.' '.$value->employe->prenom_emp;
                                $value->start = $value->debut;
                                $value->end = $value->fin;
                            }

                        return response()->json($conges);
                    }


        return view('manager.calendrier_conge', compact('conges'));
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
