<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Conge;
use Illuminate\Http\Request;
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
        //---------relation eloquent datable---------
         $conges=Conge::with('employe','type_conge', 'etat_conge');


        //---------------------------------------------
        if($request->ajax()) // ajax de la table historique
        {
            // RECHERCHE AVEC DATES-------------------------------------------
            if($request->debut && $request->fin)
            {
                $conges->whereBetween('debut', [$request->debut, $request->fin]);
                // $conges = $conges->whereRaw('DATE_FORMAT(debut, "%Y-%m-%d") = \''.$request->debut.'\' AND DATE_FORMAT(fin, "%Y-%m-%d") = \''.$request->fin . '\'');
            }


            $alldata = DataTables::of($conges)
            ->toJson();
            return $alldata;
        }
        $calendar = Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();

        //--------------relation eloquent calendrier-----------------------

           foreach ($calendar as $key => $value) {
            $value->employe=$value->employe;
            $value->etat_conge=$value->etat_conge;
        }


        return view('rh.home_rh', compact('calendar','conges', 'conges_en_attente', 'nbr_en_attente'));
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


                            );
            }




         }



            return view('rh.calendrier_conge', compact('events','conges', 'conges_en_attente', 'nbr_en_attente'));


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
