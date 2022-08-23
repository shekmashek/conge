<?php

namespace App\Http\Controllers\Api;

use App\Models\Conge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function congeValideAPI()
    {
        $conges = Conge::where('etat_conge_id',1)->get();
        return response()->json($conges);
    }

    public function congeRefuseAPI()
    {
        $conges = Conge::where('etat_conge_id',2)->get();
        return response()->json($conges);
    }

    public function congeEnAttenteAPI()
    {
        $conges = Conge::where('etat_conge_id',3)->get();
        return response()->json($conges);
    }

    // retourne les congés non payés d'un employé ou tous les congés non payés : type_conge_id = 7 ( congé impayé ), type_conge_id = 8 ( absence irrégulière )
    public function congeNonPayeEmployeAPI($id=null)
    {
        if ($id) {
            $conges = Conge::where('employe_id',$id)->where('type_conge_id',8)
            ->orWhere('type_conge_id',7)
            ->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise']);
        } else {
            $conges = Conge::where('type_conge_id',8)
            ->orWhere('type_conge_id',7)
            ->get(['employe_id', 'type_conge_id', 'debut', 'fin', 'j_utilise']);
        }

        return response()->json($conges);
    }

    // retourne les congés payés d'un employé ou de tous les employés. type_conge_id = 1 ( congé payé )
    public function congePayeEmployeAPI($id=null)
    {
        if ($id) {
            $conges = Conge::where('employe_id',$id)->where('type_conge_id',1)
            ->get();
        } else {
            $conges = Conge::where('type_conge_id',1)
            ->get();
        }



        return response()->json($conges);
    }

    public function typesCongesEmployeApi ($id)
    {

    }

}
