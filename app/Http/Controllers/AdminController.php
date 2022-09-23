<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

    //--------------liste des employés--------------------
    public function liste_employes(Request $request)
    {
        $authed_Admin = auth()->user()->employe;


        $employes=Employe::with('service','service.departement','entreprise','contrat')
        ->where('entreprise_id', $authed_Admin->entreprise_id)
        ->where('id', '!=', $authed_Admin->id)
        ->get(['id', 'nom_emp', 'prenom_emp', 'email_emp', 'telephone_emp', 'service_id', 'entreprise_id', 'photos', 'date_embauche']);

         if ($request->ajax()) {
                // $employes=Employe::with('service','service.departement','entreprise','contrat')
                // ->where('entreprise_id', $authed_RH->entreprise_id)
                // ->where('id', '!=', $authed_RH->id)
                // ->get(['id', 'nom_emp', 'prenom_emp', 'email_emp', 'telephone_emp', 'service_id', 'entreprise_id', 'photos']);


                $employes = DataTables::of($employes)
                ->addColumn('id', function($s){
                    return $s->id;
                })

                ->addColumn('employes', function($s){
                    // show the photo of the employe
                    // <img src="'.asset('storage/'.$s->photos).'" class="img-fluid" alt="">
                    // <img src="'.asset('img/users/'.$s->photos).'" class="img-fluid rounded-circle" alt style="width: 70px;height: 70px;object-fit: cover;">
                    // <img src="'.$s->photos.'" class="img-fluid" alt="">
                    $r = '<span class="align-items-center d-flex justify-content-around" style="width: 250px">

                                <span class="ms-2">'.$s->nom_emp.' '.$s->prenom_emp.'</span>
                            </span>';

                    return $r;
                })

                ->addColumn('contacts', function($s){
                    $r = '<span class="ms-2 ">'.$s->email_emp. '<br>'.$s->telephone_emp. '</span>';
                    return $r;
                })


                ->addColumn('actions', function($s){


                })
                // ->rawColumns(['nom_prenom', 'actions'])
                ->rawColumns(['employes', 'contacts', 'actions'])
                ->make(true);


                // dd($employes);

            return $employes;
        }




        return view('admin.liste_employe');
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
