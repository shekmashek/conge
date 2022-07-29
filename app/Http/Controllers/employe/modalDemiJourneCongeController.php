<?php

namespace App\Http\Controllers\employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\type_motif_conge;

class modalDemiJourneCongeController extends Controller
{
    public function  stockValueSession(Request $request)
    {
        $date_debut = $request->dateDebut;

        if ($request->dateFin == null) {
            $date_fin = $date_debut;
        }
        $request->session()->put('dateDebut', $date_debut);
        $request->session()->put('dateFin', $date_fin);

        $type_motif_conges = type_motif_conge::all();
        return redirect()->route('formConge');;
    }
}
