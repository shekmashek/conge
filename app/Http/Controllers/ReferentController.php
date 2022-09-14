<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ReferentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // obtenir l'employe de l'user connecté ( si vous voulez l'utiliser comme valiable )
        $authed_emp = auth()->user()->employe;

        // Le manager peut voir la liste des congés de tous les employes de son service ( même service_id ).
        // conditions sur la relation employe des congés à afficher.
        $conges=Conge::with('employe', 'type_conge', 'etat_conge')->whereHas('employe', function ($query) use ($authed_emp) {
            $query->where('entreprise_id', $authed_emp->entreprise_id)
                // ->where('departement_entreprises_id', $authed_emp->departement_entreprises_id)
                // ->where('service_id', $authed_emp->service_id)
                ->where('id', '!=', $authed_emp->id);
        })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        // dd($conges);


        // uniquement utile pour calculer ne nombre de congé en attente initial
        // je sais pas encore comment le mettre en ajax
        $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')
                                ->where('etat_conge_id', 3)
                                ->whereHas('employe', function ($query) {
                                $query->where('entreprise_id', auth()->user()->employe->entreprise_id)
                                    // ->where('service_id', auth()->user()->employe->service_id)
                                    ->where('id', '!=', auth()->user()->employe->id);
                                })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        // compter les congés en attente pour le mettre dans le badge
        $nbr_en_attente = $conges_en_attente->count();


        if ($request->ajax()) {
            $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')
                                    ->where('etat_conge_id', 3)
                                    ->whereHas('employe', function ($query) {
                                    $query->where('entreprise_id', auth()->user()->employe->entreprise_id)
                                        // ->where('service_id', auth()->user()->employe->service_id)
                                        ->where('id', '!=', auth()->user()->employe->id);
                                    })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

            return DataTables::of($conges_en_attente)
                ->addColumn('action', function($s){
                    // $r = '<div  class="dropdown dropstart myDrop" data-conge-id="'.$s->id.'">
                    //             <button class="btn fs-3" type="button" id="etat_actions" data-bs-toggle="dropdown" aria-expanded="false">
                    //             <i class="bx bx-dots-vertical-rounded"></i>
                    //             </button>
                    //             <ul class="dropdown-menu dropdown-start" aria-labelledby="etat_actions">
                    //                 <li><button onclick="accepter_conge('.$s->id.');"  class="dropdown-item btnAccepter" type="button" >Accepter</button></li>

                    //                 <li><button onclick="show_modal_refus('.$s->id.');" class="dropdown-item btnRefuser" type="button" onclick="">Refuser</button></li>
                    //             </ul>
                    //         </div>';
                    // return $r;
                    $r='<div class="d-flex" data-conge-id="'.$s->id.'">
                           <button onclick="accepter_conge('.$s->id.');"  class="btn d-flex btnAccepter" type="button" ><i class="bx bx-check-circle fs-3 text_green text_big_hover"></i><span class="show_hover">Accepter</span></button>
                            <button onclick="show_modal_refus('.$s->id.');" class="btn d-flex btnRefuser" type="button " onclick=""><i class="bx bx-x-circle fs-3 text-danger text_big_hover"></i><span class="show_hover">Rejeter</span></button>
                        </div>';

                    return $r;

                })
                // ->toJson()
                ->rawColumns(['action'])
                ->make(true);
            // return $conges_en_attente;
        }

        return view('referent.home_referent', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
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
