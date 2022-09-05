<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employe;
use Aws\Api\Service;
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

        // obtenir l'employe de l'user connecté ( si vous voulez l'utiliser comme valiable )
        $authed_emp = auth()->user()->employe;

        // Le manager peut voir la liste des congés de tous les employes de son service ( même service_id ).
        // conditions sur la relation employe des congés à afficher.
        $conges=Conge::with('employe', 'type_conge', 'etat_conge')->whereHas('employe', function ($query) use ($authed_emp) {
            $query->where('entreprise_id', $authed_emp->entreprise_id)
                ->where('departement_entreprises_id', $authed_emp->departement_entreprises_id)
                ->where('service_id', $authed_emp->service_id)
                ->where('id', '!=', $authed_emp->id);
        })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        // dd($conges);


        // uniquement utile pour calculer ne nombre de congé en attente initial
        // je sais pas encore comment le mettre en ajax
        $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')
                                ->where('etat_conge_id', 3)
                                ->whereHas('employe', function ($query) {
                                $query->where('entreprise_id', auth()->user()->employe->entreprise_id)
                                    ->where('service_id', auth()->user()->employe->service_id)
                                    ->where('id', '!=', auth()->user()->employe->id);
                                })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

        // compter les congés en attente pour le mettre dans le badge
        $nbr_en_attente = $conges_en_attente->count();


        if ($request->ajax()) {
            $conges_en_attente=Conge::with('employe','type_conge', 'etat_conge')
                                    ->where('etat_conge_id', 3)
                                    ->whereHas('employe', function ($query) {
                                    $query->where('entreprise_id', auth()->user()->employe->entreprise_id)
                                        ->where('service_id', auth()->user()->employe->service_id)
                                        ->where('id', '!=', auth()->user()->employe->id);
                                    })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

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
        // données du datatable en ajax
        if ($request->ajax()) {
            $conges=Conge::with('employe', 'type_conge', 'etat_conge')->whereHas('employe', function ($query) {
                $query->where('entreprise_id', auth()->user()->employe->entreprise_id)
                    ->where('service_id', auth()->user()->employe->service_id)
                    ->where('id', '!=', auth()->user()->employe->id);
            })->get(['id', 'employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);

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

    // liste des employes du service du manager connecté.
    public function listeEmployes(Request $request)
    {
        $authed_manager = auth()->user()->employe;

        $employes=Employe::where('service_id', $authed_manager->service_id)
                        ->with('service','service.departement','entreprise','contrat')
                        ->where('departement_entreprises_id', $authed_manager->departement_entreprises_id)
                        ->where('entreprise_id', $authed_manager->entreprise_id)
                        ->where('id', '!=', $authed_manager->id)
                ->get(['id', 'nom_emp', 'prenom_emp', 'email_emp', 'telephone_emp', 'service_id', 'entreprise_id']);



        // return $employes;


        if ($request->ajax()) {
            $employes=Employe::where('service_id', $authed_manager->service_id)
            ->with('service','service.departement','entreprise','contrat')
            ->where('departement_entreprises_id', $authed_manager->departement_entreprises_id)
            ->where('entreprise_id', $authed_manager->entreprise_id)
            ->where('id', '!=', $authed_manager->id)
            ->get(['id', 'nom_emp', 'prenom_emp', 'email_emp', 'telephone_emp', 'service_id', 'entreprise_id']);

            $employes = DataTables::of($employes)
                ->addColumn('nom_prenom', function($s){
                    // show the photo of the employe
                    // <img src="'.asset('storage/'.$s->photos).'" class="img-fluid" alt="">
                    $r = '<div class="media align-items-center">
                                <div class="media-left">
                                    <img src="'.$s->url_photo.'" class="img-fluid" alt="">

                                </div>
                                <div class="media-body">
                                    <h4 class="mb-0">'.$s->nom_emp.' '.$s->prenom_emp.'</h4>
                                    <span>'.$s->email_emp.'</span>
                                </div>
                            </div>';
                    return $r;
                })

                ->addColumn('actions', function($s){
                    $r = '<div  class="dropdown dropstart myDrop" data-conge-id="'.$s->id.'">
                                <button class="btn fs-3" type="button" id="action_button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-start" aria-labelledby="etat_actions">
                                    <li><button  class="dropdown-item btnAccepter" type="button" >Voir</button></li>

                                    <li><button  class="dropdown-item btnRefuser" type="button" onclick="">Historique</button></li>
                                </ul>
                            </div>';
                    return $r;
                })
                ->rawColumns(['nom_prenom', 'actions'])
                ->make(true);

            return $employes;
        }

        return view('manager.liste_employe_manager', compact('employes'));

    }


    public function statisticsConges (Request $request) {
        return view('manager.stats_conges_manager');
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
