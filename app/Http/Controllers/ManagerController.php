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

        // Le manager peut voir la liste des congés de tous les employes de son service ( même service_id ).
        // conditions sur la relation employe des congés à afficher.
        $conges=Conge::with('employe', 'type_conge', 'etat_conge')->whereHas('employe', function ($query) {
            $query->where('service_id', auth()->user()->employe->service_id)
                ->where('entreprise_id', auth()->user()->employe->entreprise_id)
                ->where('id', '!=', auth()->user()->employe->id);
        })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        dd($conges);

        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();


        if ($request->ajax()) {
            $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')->where('etat_conge_id', 3)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

            return DataTables::of($conges_en_attente)
                ->addColumn('action', function($s){
                    $r = '<div  class="dropdown dropstart myDrop" data-conge-id="'.$s->id.'">
                                <button class="btn fs-3" type="button" id="etat_actions" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-start" aria-labelledby="etat_actions">
                                    <li><button onclick="accepter_conge('.$s->id.');"  class="dropdown-item btnAccepter" type="button" >Accepter</button></li>

                                    <li><button onclick="show_modal_refus('.$s->id.');" class="dropdown-item btnRefuser" type="button" onclick="">Refuser</button></li>
                                </ul>
                            </div>';
                    return $r;
                })
                // ->toJson()
                ->rawColumns(['action'])
                ->make(true);
            // return $conges_en_attente;
        }

        return view('manager.home_manager', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
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

        // $conges=Conge::with('employe','type_conge', 'etat_conge')->where('etat_conge_id', 1)->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        $conges=Conge::with('employe', 'type_conge', 'etat_conge')->whereHas('employe', function ($query) {
            $query->where('service_id', auth()->user()->employe->service_id)
                ->where('entreprise_id', auth()->user()->employe->entreprise_id)
                ->where('id', '!=', auth()->user()->employe->id);
        })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

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
