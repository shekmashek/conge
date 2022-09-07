<?php

namespace App\Http\Controllers\Api;

use DateInterval;
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
                $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde_minute',t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
                                    CASE WHEN t.frequence_solde_id = 1 THEN TIMESTAMPDIFF(MONTH, contrat.date_embauche,NOW() )*t.solde
                                    WHEN t.frequence_solde_id = 4 THEN TIMESTAMPDIFF(YEAR, contrat.date_embauche,NOW() )*t.solde
                                    ELSE t.duree_max
                                    END AS 'total_acquis_minute'
                                    from conges c join conges_types_conge t on c.type_conge_id = t.id JOIN employes e on c.employe_id=e.id
                                    JOIN pers_contrats contrat on contrat.employer_id=e.id
                                    JOIN conges_etats_conge etat ON c.etat_conge_id=etat.id
                                    JOIN employes on c.employe_id=employes.id
                                    JOIN departement_entreprises on employes.departement_entreprises_id=departement_entreprises.id
                                    JOIN services on services.id=services.departement_entreprise_id
                                    where c.employe_id=$id and c.etat_conge_id=1
                                    group by c.type_conge_id, c.employe_id;"
                );

        // la fonction minuteToDayDecimal() est définie dans le fichier Helpers.php : la décimale est soit .0 soit .5
            foreach ($conges as $key => $value) {
                $value->total_j_acquis=minuteToDayDecimal($value->total_acquis_minute);
                $value->solde_jour=minuteToDayDecimal($value->solde_minute);
            }

            return $conges;

        } else {
            $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde_minute',t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
                                CASE WHEN t.frequence_solde_id = 1 THEN TIMESTAMPDIFF(MONTH, contrat.date_embauche,NOW() )*t.solde
                                WHEN t.frequence_solde_id = 4 THEN TIMESTAMPDIFF(YEAR, contrat.date_embauche,NOW() )*t.solde
                                ELSE t.duree_max
                                END AS 'total_acquis_minute'
                                from conges c join conges_types_conge t on c.type_conge_id = t.id JOIN employes e on c.employe_id=e.id
                                JOIN pers_contrats contrat on contrat.employer_id=e.id
                                JOIN conges_etats_conge etat ON c.etat_conge_id=etat.id
                                JOIN employes on c.employe_id=employes.id
                                JOIN departement_entreprises on employes.departement_entreprises_id=departement_entreprises.id
                                JOIN services on services.id=services.departement_entreprise_id
                                where c.etat_conge_id=1
                                group by c.type_conge_id, c.employe_id;"
            );

            $group_conges = array();
            foreach ($conges as $key => $value) {
                $value->total_j_acquis=minuteToDayDecimal($value->total_acquis_minute);
                $value->solde_jour=minuteToDayDecimal($value->solde_minute);

                $group_conges[$value->employe_id][$value->type_conge_id]=$value;
            }

            // congés groupés par employé
            return $group_conges;
        }


    }

    public function getCongesAnnuelValide(Request $request,$year,$employe_id=null) {
        if ($request) {
            $year=$request->year;
            $employe_id=$request->employe_id;
        } else {
            $year=$year;
            $employe_id=$employe_id;
        }


        if ($employe_id) {
            // return $employe_id;
            $conges = DB::select("select MONTH(c.debut),MONTH(c.fin),YEAR(c.debut),c.id, c.employe_id,type_conge_id,type_c.type_conge,
                                        h_travail.heure_debut as work_start, h_travail.heure_fin as work_end,
                                        h_travail.debut_pause as break_start, h_travail.fin_pause as break_end, debut,fin,
                                    CASE WHEN YEAR(c.fin)=YEAR(c.debut) THEN
                                            -- debut + variation
                                            DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.debut, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                    ELSE
                                            CASE WHEN YEAR(c.debut)=$year AND YEAR(c.fin)!=$year THEN
                                                    -- debut + variation
                                                    DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.debut, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                            WHEN YEAR(c.fin)=$year AND YEAR(c.debut)!=$year THEN
                                                    -- premier jour du mois de fin
                                                    DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(YEAR(c.fin),'-01-01'), '%Y-%m-%d %H:%i'), INTERVAL -DAYOFMONTH(STR_TO_DATE(CONCAT(YEAR(c.fin),'-01-01'), '%Y-%m-%d %H:%i'))+1+0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                            END
                                    END AS 'start',

                                    CASE WHEN YEAR(c.fin)=YEAR(c.debut) THEN
                                            -- fin + variation
                                            DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.fin, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                    ELSE
                                            CASE WHEN YEAR(c.debut)=$year AND YEAR(c.fin)!=$year THEN
                                                    -- dernier jour de l'années de debut
                                                    DATE_FORMAT(DATE_ADD(LAST_DAY(c.debut), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                            WHEN YEAR(c.fin)=$year AND YEAR(c.debut)!=$year THEN
                                                    --  fin + variation
                                                    DATE_FORMAT(DATE_ADD(STR_TO_DATE(fin, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                            END
                                    END AS 'end'

                                    from conges c
                                    JOIN employes emp on c.employe_id=emp.id
                                    JOIN conges_heures_de_travail h_travail on emp.heure_de_travail_id=h_travail.id
                                    JOIN conges_types_conge type_c on c.type_conge_id=type_c.id
                                    where (c.etat_conge_id=1)
                                    AND (YEAR(c.debut)=$year or YEAR(c.fin)=$year)
                                    AND (employe_id=$employe_id);"
                                );


                // $conges=collect($conges);

            } else {
                $conges = DB::select("select MONTH(c.debut),YEAR(c.debut), YEAR(c.fin),c.id, c.employe_id,type_conge_id,type_c.type_conge,
                                            h_travail.heure_debut as work_start, h_travail.heure_fin as work_end,
                                            h_travail.debut_pause as break_start, h_travail.fin_pause as break_end, debut,fin,
                                        CASE WHEN YEAR(c.fin)=YEAR(c.debut) THEN
                                                -- debut + variation
                                                DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.debut, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                        ELSE
                                                CASE WHEN YEAR(c.debut)=$year AND YEAR(c.fin)!=$year THEN
                                                        -- debut + variation
                                                        DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.debut, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                                WHEN YEAR(c.fin)=$year AND YEAR(c.debut)!=$year THEN
                                                        -- premier jour du mois de fin
                                                        DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(YEAR(c.fin),'-01-01'), '%Y-%m-%d %H:%i'), INTERVAL -DAYOFMONTH(STR_TO_DATE(CONCAT(YEAR(c.fin),'-01-01'), '%Y-%m-%d %H:%i'))+1+0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                                END
                                        END AS 'start',

                                        CASE WHEN YEAR(c.fin)=YEAR(c.debut) THEN
                                                -- fin + variation
                                                DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.fin, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                        ELSE
                                                CASE WHEN YEAR(c.debut)=$year AND YEAR(c.fin)!=$year THEN
                                                        -- dernier jour de l'années de debut
                                                        DATE_FORMAT(DATE_ADD(LAST_DAY(c.debut), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                                WHEN YEAR(c.fin)=$year AND YEAR(c.debut)!=$year THEN
                                                        --  fin + variation
                                                        DATE_FORMAT(DATE_ADD(STR_TO_DATE(fin, '%Y-%m-%d %H:%i'), INTERVAL 0 DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                                END
                                        END AS 'end'

                                        from conges c
                                        JOIN employes emp on c.employe_id=emp.id
                                        JOIN conges_heures_de_travail h_travail on emp.heure_de_travail_id=h_travail.id
                                        JOIN conges_types_conge type_c on c.type_conge_id=type_c.id
                                        where (c.etat_conge_id=1)
                                        AND (YEAR(c.debut)=$year or YEAR(c.fin)=$year)"
                                    );


                // $conges=collect($conges);

            }

            // return $conges;


            foreach ($conges as $key => $value) {

                // dump(getWorkingHours($value->start,$value->end,$value->work_start,$value->work_end,$value->break_start,$value->break_end));

                $jours_travail[]=array(
                    'id'=>$value->id,
                    'employe_id'=>$value->employe_id,
                    'type_conge_id'=>$value->type_conge_id,
                    'type_conge'=>$value->type_conge,
                    'start' => $value->start,
                    'end' => $value->end,
                    'work_start' => $value->work_start,
                    'work_end' => $value->work_end,
                    'duration' => getWorkingHours($value->start,$value->end,$value->work_start,$value->work_end,$value->break_start,$value->break_end)['duration'],
                    'total_heure' => getWorkingHours($value->start,$value->end,$value->work_start,$value->work_end,$value->break_start,$value->break_end)['dt']

                );
            }


            // return $jours_travail;

                // 8h n'est qu'une valeur temporaire par défaut.
                // La valeur horaire d'une journée de travail doit être définie dynamiquement suivant l'employé concerné

                foreach ($jours_travail as $key => $value) {

                    $intervalle = DateInterval::createFromDateString($value['duration']);
                    $nombre_j_travail =intval($value['total_heure']/8);
                    $hours=$intervalle->h;

                    if ($hours >= 4 && $hours < 8) {
                        $d=0.5;
                        $nbr_jour=$nombre_j_travail+$d;

                    } else if($hours < 4) {
                        // si le nombre d'heure est inférieur à 4 : on ne compte pas ces heure
                        // nombre de jour de travail = nombre d'heure / 8.
                        $nbr_jour=intval($value['total_heure']/8);
                    } else if($hours >= 8) {
                        // si le nombre d'heures restant est de 8 : on divise l'heure totale par 8
                        // ce qui donne un nombre de jour entier.
                        $nbr_jour=round($value['total_heure']/8);
                    }

                    $jours_travail[$key]['nbr_jour']=$nbr_jour;
                }


        return $jours_travail;

    }

}
