<?php

namespace App\Http\Controllers\employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\type_motif_conge;
use App\Models\conge;
use Illuminate\Support\Facades\DB;

class CongeEmployeController extends Controller
{
    public function index(Request $request)
    {
        //dump($request->session()->get('dateDebut'));
        //dump($request->session()->get('dateFin'));
        $type_conges=type_motif_conge::get(['id','nom_motif','etat_paiement']);
        return view('Employe.formulaireConge',compact('type_conges'));
    }

    public function insertionConge(Request $request)
    {
        $date_debut=$request->input('dateDebut');
        $date_fin=$request->input('dateFin');
        if($date_fin==null)
        {
            $date_fin=$date_debut;
        }
        $conge = new conge();
        $conge->user_id=1;
        $conge->start=$date_debut;
        $conge->type_motif_conge_id=$request->input('motif');
        $conge->end=$date_fin;
        $conge->title=$request->input('description');
        $conge->dure_conge=DB::raw( "TIMESTAMPDIFF(HOUR,'".$date_debut."','".$date_fin."')");
        $conge->save();

        dump($date_debut);
        dump($date_fin);
        $type_conges=type_motif_conge::get(['id','nom_motif','etat_paiement']);
        return view('Employe.formulaireConge',compact('type_conges'));
    }

    public function indexFormulaireHeure()
    {
        $type_conges=type_motif_conge::get(['id','nom_motif','etat_paiement']);
        return view('Employe.formHeureConge',compact('type_conges'));
    }

    public function indexFormulaireJour()
    {
        $type_conges=type_motif_conge::get(['id','nom_motif','etat_paiement']);
        return view('Employe.formJourConge',compact('type_conges'));
    }

    public function indexFormulaireDemiJourne()
    {
        $type_conges=type_motif_conge::get(['id','nom_motif','etat_paiement']);
        return view('Employe.formDemiJourneConge',compact('type_conges'));
    }

    public function index2(){
        return view('Employe.modalDate');
    }


}
