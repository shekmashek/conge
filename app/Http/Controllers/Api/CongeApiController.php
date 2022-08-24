<?php

namespace App\Http\Controllers\Api;

use App\Models\Conge;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

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

    // obtenir le nombre de jour de congé par employé par type de congé
    // si l'id de l'employé n'est pas spécifié, on retourne le nombre de jour de congé par type de congé
    // pour tous les employés et goupé par employés
    // les requêtes complexe sont faites en sql. Seul les traitements sont faits en php
    public function joursCongesEmploye($id=null) {

        if ($id) {
                $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde',t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
                    CASE WHEN t.frequence_solde_id = 1 THEN TIMESTAMPDIFF(MONTH, contrat.date_embauche,NOW() )*t.solde
                    WHEN t.frequence_solde_id = 4 THEN TIMESTAMPDIFF(YEAR, contrat.date_embauche,NOW() )*t.solde
                    ELSE t.duree_max
                    END AS 'total_acquis'
                    from conges c join conges_types_conge t on c.type_conge_id = t.id JOIN employes e on c.employe_id=e.id
                    JOIN pers_contrats contrat on contrat.employer_id=e.id
                    JOIN conges_etats_conge etat ON c.etat_conge_id=etat.id
                    where c.employe_id=$id and c.etat_conge_id=1
                    group by c.type_conge_id;"
                );

        // la fonction minuteToDayDecimal() est définie dans le fichier Helpers.php : la décimale est soit .0 soit .5
            foreach ($conges as $key => $value) {
                $value->total_j_acquis=minuteToDayDecimal($value->total_acquis);
                $value->solde_jour=minuteToDayDecimal($value->solde);
            }

            return $conges;

        } else {
            $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde',t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
                    CASE WHEN t.frequence_solde_id = 1 THEN TIMESTAMPDIFF(MONTH, contrat.date_embauche,NOW() )*t.solde
                    WHEN t.frequence_solde_id = 4 THEN TIMESTAMPDIFF(YEAR, contrat.date_embauche,NOW() )*t.solde
                    ELSE t.duree_max
                    END AS 'total_acquis'
                    from conges c join conges_types_conge t on c.type_conge_id = t.id JOIN employes e on c.employe_id=e.id
                    JOIN pers_contrats contrat on contrat.employer_id=e.id
                    JOIN conges_etats_conge etat ON c.etat_conge_id=etat.id
                    where c.etat_conge_id=1
                    group by c.type_conge_id, c.employe_id;"
            );

            $group_conges = array();
            foreach ($conges as $key => $value) {
                $value->total_j_acquis=minuteToDayDecimal($value->total_acquis);
                $value->solde_jour=minuteToDayDecimal($value->solde);

                $group_conges[$value->employe_id][$value->type_conge_id]=$value;
            }

            // congés groupés par employé
            return $group_conges;
        }


    }

}
