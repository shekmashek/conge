<?php

namespace App\Http\Controllers;

use App\Models\ServiceEntreprise;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class RHController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        // $conge=Conge::with('employe','type_conge', 'etat_conge')->get(['id','employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        // foreach ($conge as $key => $value) {
        //     dump($value->id,$value->employe);
        // }

        // dd('end');

        $calendar = Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)
        ->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();

        //--------------relation eloquent calendrier-----------------------

           foreach ($calendar as $key => $value) {
            $value->employe=$value->employe;
            $value->etat_conge=$value->etat_conge;
        }

        return view('rh.home_rh', compact('calendar', 'conges_en_attente', 'nbr_en_attente'));
    }
//-------------------------ajax listes des conges d'un employe----------------------------------------------
public function liste_en_attente(Request $request)
{
    $conge=Conge::with('employe','type_conge', 'etat_conge')->get(['id','employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);



    if ($request->ajax())
    {


        $conge = DataTables::of($conge)
            ->addColumn('employe', function($s){
                $r = '<div class="d-flex align-items-center">

                            <div class="flex-grow-1 ms-3">
                                <div class="mb-0">'.$s->employe->nom_emp.' '.$s->employe->prenom_emp.'</div>
                            </div>
                        </div>';
                return $r;
            })
            ->rawColumns(['employe'])
            ->make(true);


            return $conge;



    }

    return view('rh.liste_en_attente');
}

 //-------------------------ajax historique des conges d'un employe----------------------------------------------
 public function history_conges(Request $request)
 {
                    //---------relation eloquent datable et declaration de la table a utilisé---------
    $conge=Conge::with('employe','type_conge', 'etat_conge');

    if ($request->ajax())
    {
        // $conge=Conge::with('employe','type_conge', 'etat_conge')
        // ->get(['id', 'employe_id', 'type_conge_id', 'etat_conge_id', 'debut', 'fin', 'j_utilise', 'motif']);

                    // RECHERCHE AVEC DATES-------------------------------------------
            if($request->debut && $request->fin)
            {
                $conge->whereBetween('debut', [$request->debut, $request->fin]);
                // $conge = $conge->whereRaw('DATE_FORMAT(debut, "%Y-%m-%d") = \''.$request->debut.'\' AND DATE_FORMAT(fin, "%Y-%m-%d") = \''.$request->fin . '\'');

            }


        $conge = DataTables::of($conge)
            ->addColumn('employe', function($s){
                $r = '<div class="d-flex align-items-center">

                            <div class="flex-grow-1 ms-3">
                                <div class="mb-0">'.$s->employe->nom_emp.' '.$s->employe->prenom_emp.'</div>
                            </div>
                        </div>';
                return $r;
            })
            ->rawColumns(['employe'])
            ->make(true);


            return $conge;



    }

    return view('rh.liste_conge');
 }

//-----------affiche le calendrier full calendar------------------------------------------------------

    public function calendrier(){
        $conges=Conge::with('etat_conge','employe')->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();




         foreach ($conges as $conge) {
            // 1 = accordé
            //2 = refusé
            //3 = en attente


            if ($conge->etat_conge_id == 1 ) {
                           $conge->debut = date('Y-m-d H:i', strtotime($conge->debut));
                            $conge->fin = date('Y-m-d H:i', strtotime($conge->fin));


                            $events[]=array(
                                'title'=>'Conge',
                                'start'=>$conge->debut,
                                'end'=>$conge->fin,
                                'employe'=>$conge->employe->nom_emp.' '.$conge->employe->prenom_emp,
                                'color'=>$conge->type_conge->couleur,
                                'etat_conge'=>$conge->etat_conge,
                                'type_conge'=>$conge->type_conge,


                            );
            }




         }



            return view('rh.calendrier_conge', compact('events','conges', 'conges_en_attente', 'nbr_en_attente'));


    }


    //-----------employer  RH --------------------------------------------------

    public function employes(Request $request)
    {
        return view('rh.menu_employes');
    }




    //-----------liste employer depuis l'interface RH --------------------------------------------------

    public function liste_employes(Request $request)
    {
       $authed_RH = auth()->user()->employe;


            $employes=Employe::with('service','service.departement','entreprise','contrat')
            ->where('entreprise_id', $authed_RH->entreprise_id)
            ->where('id', '!=', $authed_RH->id)
            ->get(['id', 'nom_emp', 'prenom_emp', 'email_emp', 'telephone_emp', 'service_id', 'entreprise_id', 'photos']);


        if ($request->ajax()) {
            $employes=Employe::with('service','service.departement','entreprise','contrat')
            ->where('entreprise_id', $authed_RH->entreprise_id)
            ->where('id', '!=', $authed_RH->id)
            ->get(['id', 'nom_emp', 'prenom_emp', 'email_emp', 'telephone_emp', 'service_id', 'entreprise_id', 'photos']);

            $employes = DataTables::of($employes)
                ->addColumn('id', function($s){
                    return $s->id;
                })

                ->addColumn('nom_prenom', function($s){
                    // show the photo of the employe
                    // <img src="'.asset('storage/'.$s->photos).'" class="img-fluid" alt="">
                    // <img src="'.$s->photos.'" class="img-fluid" alt="">
                    $r = '<span class="align-items-center d-flex justify-content-around" style="width: 250px">
                                <img src="'.asset('img/users/'.$s->photos).'" class="img-fluid rounded-circle" alt style="width: 70px;height: 70px;object-fit: cover;">
                                <span class="ms-2">'.$s->nom_emp.' '.$s->prenom_emp.'</span>
                            </span>';

                    return $r;
                })

                ->addColumn('contacts', function($s){
                    $r = '<span class="ms-2 ">'.$s->email_emp. '<br>'.$s->telephone_emp. '</span>';
                    return $r;
                })


                // ->addColumn('actions', function($s){
                //     $r = '<div  class="dropdown dropstart myDrop" data-conge-id="'.$s->id.'">
                //                 <button class="btn fs-3" type="button" id="action_button" data-bs-toggle="dropdown" aria-expanded="false">
                //                 <i class="bx bx-dots-vertical-rounded"></i>
                //                 </button>
                //                 <ul class="dropdown-menu dropdown-start" aria-labelledby="etat_actions">
                //                     <li><button  class="dropdown-item btnAccepter" type="button" >Voir</button></li>
                //                     <li><button  class="dropdown-item btnRefuser" type="button" onclick="">Historique</button></li>
                //                 </ul>
                //             </div>';
                //     return $r;
                // })
                // ->rawColumns(['nom_prenom', 'actions'])
                ->rawColumns(['nom_prenom', 'contacts'])
                ->make(true);



            return $employes;
        }

        return view('rh.liste_employes');


    }


 //----------------------formulaire d'ajout employes---------------------------------------------
    public function add_employe()
    {
        $services = ServiceEntreprise::all();
        $entreprises = Entreprise::all();
        $contrats = Contrat::all();
        return view('rh.add_employe', compact('services', 'entreprises', 'contrats'));
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
