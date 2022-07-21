<?php

namespace App\Http\Controllers\employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\type_motif_conge;
use App\Models\conge;
use Illuminate\Support\Facades\DB;

class CongeEmployeController extends Controller
{
    public function index()
    {
        $type_motif_conges=type_motif_conge::getAllTypeMotifConges();
        return view('Employe.formulaireConge',['motif_conges'=>$type_motif_conges]);
    }

    public function insertionConge(Request $request)
    {
        $conge = new conge();
        $conge->user_id=1;
        $conge->start=$request->input('DateDebut');
        $conge->type_motif_conge_id=$request->input('motif');
        $conge->end=$request->input('DateFin');
        $conge->descriptions=$request->input('description');
        $conge->dure_conge=DB::raw( "TIMESTAMPDIFF(HOUR,'".$request->input('DateDebut')."','".$request->input('DateFin')."')");
        $conge->save();
        $type_motif_conges=type_motif_conge::getAllTypeMotifConges();
        return view('Employe.formulaireConge',['motif_conges'=>$type_motif_conges]);
    }

    public function index2(){
        return view('manager.fullCalendar');
    }
}
