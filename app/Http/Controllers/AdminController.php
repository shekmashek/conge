<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.test');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $request->validate([
            'matricule' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'cin' => ['required', 'min:12'],
            'phone' => ['required', 'min:8'],
            'email' => ['required', 'email', 'unique:users'],
            'nom_fonction' => ['required']
        ]);

        Employe::create([
            'matricule_emp' => $request->matricule,
            'nom_emp' => $request->nom,
            'prenom_emp' => $request->prenom,
            'cin_emp' => $request->cin,
            'telephone_emp' => $request->phone,
            'email_emp' => $request->email,
            'fonction_emp' => $request->nom_fonction
        ]);


        return redirect()->back()->with('message', 'Ajout employer avec succès!');
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
