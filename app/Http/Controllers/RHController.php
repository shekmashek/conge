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
         $conges=Conge::all();
        foreach ($conges as $conge) {
            $conge->employe;
            $conge->type_conge;
            $conge->etat_conge;
        }
        if($request->ajax()) // ajax de la table historique
        {
            $alldata = DataTables::of($conges)
            ->make(true);
            return $alldata;
        }
        $conges=Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();

        foreach ($conges as $key => $value) {
            $value->employe=$value->employe;
        }

        return view('rh.home_rh', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
    }

//----------------------fonction du tableau historique------------------------------------------------------------------------------------------------

    public function fetchData(){
           $conges=Conge::all();
        //    foreach ($conges as $conge) {
        //     $conge->employe;
        //     $conge->type_conge;
        //     $conge->etat_conge;
        // }
        // return response()->json([
        //     'conges'=>$conges,
        // ]);

    }

//----------------------fonction du tableau demande en attente------------------------------------------------------------------------------------------------

    // public function fetchDataAtt(){
    //        $conges=Conge::all();
    //        foreach ($conges as $conge) {
    //         $conge->employe;
    //         $conge->type_conge;
    //         $conge->etat_conge;
    //     }
    //     return response()->json([
    //         'conges'=>$conges,
    //     ]);
    // }





//-----------affiche le calendrier full calendar------------------------------------------------------

    public function calendrier(){
         $conges=Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();

         foreach ($conges as $conge) {
            $conge->debut = date('Y-m-d H:i', strtotime($conge->debut));
            $conge->fin = date('Y-m-d H:i', strtotime($conge->fin));

            $events[]=array(
            'title'=>'Conge',
            'start'=>$conge->debut,
            'end'=>$conge->fin,
            'employe'=>$conge->employe->nom_emp.' '.$conge->employe->prenom_emp,


         );
         }


            return view('rh.calendrier_conge', compact('events','conges', 'conges_en_attente', 'nbr_en_attente'));


    }
    //-------------------fonction pour filtrer entre 2 dates dans une recherche --------------------------

    public function filtreDate(Request $req){

        $conges=Conge::get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
        $nbr_en_attente = $conges_en_attente->count();

        //  foreach ($conges as $conge) {
        //     $conge->debut = date('Y-m-d H:i', strtotime($conge->debut));
        //     $conge->fin = date('Y-m-d H:i', strtotime($conge->fin));

        //     $events[]=array(
        //     'title'=>'Conge',
        //     'start'=>$conge->debut,
        //     'end'=>$conge->fin,
        //     'employe'=>$conge->employe->nom_emp.' '.$conge->employe->prenom_emp,


        //  );
        //  }


        $debut = strval($req->input('debut'));
        $fin =strval( $req->input('fin'));


        $conge = DB::select('select * from conges where debut >= ? and  debut <= ?', [$debut, $fin]);

        // return view('rh.home_rh', compact('conge'));
        dd($debut, $fin, $conge);
        //return redirect()->route('home_RH')->with('conge', $conge);
        return view('rh.home_rh', compact('conges', 'conge', 'debut', 'fin', 'nbr_en_attente', 'conges_en_attente'));

    }


//-------------------fonction pour filtrer entre 2 dates dans une recherche --------------------------

    // public function filtreDate(Request $request){
    //     $debut = $request->input('debut');
    //     $fin = $request->input('fin');

    //     $conges=Conge::whereBetween('debut', [$debut, $fin])->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
    //     $conges_en_attente = Conge::where('etat_conge_id', 3)->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise', 'motif', 'etat_conge_id']);
    //     $nbr_en_attente = $conges_en_attente->count();
    //     foreach ($conges as $conge) {
    //         $conge->debut = date('Y-m-d H:i', strtotime($conge->debut));
    //         $conge->fin = date('Y-m-d H:i', strtotime($conge->fin));

    //         $events[]=array(
    //         'title'=>'Conge',
    //         'start'=>$conge->debut,
    //         'end'=>$conge->fin,
    //         'employe'=>$conge->employe->nom_emp.' '.$conge->employe->prenom_emp,

    //      );
    //      }
    //        dd($debut, $fin, $conges);

    //     // return view('rh.recherche_conges', compact('conges', 'conges_en_attente', 'nbr_en_attente'));
    //     return redirect()->route('home_RH')->with('conges', $conges);
    // }




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
