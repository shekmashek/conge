<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Conge;
use App\Models\Employe;
use Carbon\CarbonPeriod;
use Cmixin\BusinessTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


function addDateInterval($interval, $ajout) {

    if(gettype($interval)=='string') {
        $interval=DateInterval::createFromDateString($interval);
    } else {
        $interval=DateInterval::createFromDateString($interval->format("%y years %m months %D days %H hours %I minutes %s seconds"));
    }

    if(gettype($ajout)=='string') {
        $ajout=DateInterval::createFromDateString($ajout);
    } else {
        $ajout=DateInterval::createFromDateString($ajout->format("%y years %m months %D days %H hours %I minutes %s seconds"));
    }
    $e = new DateTime('00:00');
    $f = clone $e;
    $e->add($interval);
    $e->add($ajout);
    return $f->diff($e)->format("%y years %m months %D days %H hours %I minutes %s seconds");

}

function subDateInterval($interval1, $retrait) {

    if(gettype($interval1)=='string') {
        $interval1=DateInterval::createFromDateString($interval1);
    } else {
        $interval1=DateInterval::createFromDateString($interval1->format("%y years %m months %D days %H hours %I minutes %s seconds"));
    }

    if(gettype($retrait)=='string') {
        $retrait=DateInterval::createFromDateString($retrait);
    } else {
        $retrait=DateInterval::createFromDateString($retrait->format("%y years %m months %D days %H hours %I minutes %s seconds"));
    }

    $e = new DateTime('00:00');
    $f = clone $e;
    $e->add($interval1);
    $e->sub($retrait);
    return $f->diff($e)->format("%y years %m months %D days %H hours %I minutes %s seconds");

}


// Calcule de nombre d'heure de travail en prenant un heure d'entré et une heure de sortie.
function getWorkingHours($start,$end,$heure_entree,$heure_sortie,$debut_pause,$fin_pause)
{

    // format $heure_entree to H:i
    $heure_entree=Carbon::parse($heure_entree);
    $heure_entree=$heure_entree->format('H:i');
    // format $heure_sortie to H:i
    $heure_sortie=Carbon::parse($heure_sortie);
    $heure_sortie=$heure_sortie->format('H:i');

    // format $debut_pause to H:i
    $debut_pause=Carbon::parse($debut_pause);
    $debut_pause=$debut_pause->format('H:i');
    // format $fin_pause to H:i
    $fin_pause=Carbon::parse($fin_pause);
    $fin_pause=$fin_pause->format('H:i');


    BusinessTime::enable(Carbon::class, [
        'monday' => [$heure_entree.'-'.$debut_pause, $fin_pause.'-'.$heure_sortie],
        'tuesday' => [$heure_entree.'-'.$debut_pause, $fin_pause.'-'.$heure_sortie],
        'wednesday' => [$heure_entree.'-'.$debut_pause, $fin_pause.'-'.$heure_sortie],
        'thursday' => [$heure_entree.'-'.$debut_pause, $fin_pause.'-'.$heure_sortie],
        'friday' => [$heure_entree.'-'.$debut_pause, $fin_pause.'-'.$heure_sortie],
        'saturday' => [],
        'sunday' => [],
        'exceptions' => [
          '01-01' => [], // Recurring on each 1st of january
          '12-25' => ['09:00-12:00'], // Recurring on each 25th of december
        ],
      ]);

    //   a function to get the datePeriode between two dates
    $start = Carbon::parse($start);
    $end = Carbon::parse($end);

    $period = new CarbonPeriod($start, '1 hour', $end);

    $dt=$start->diffInHours($end);

    foreach ($period as $key => $date) {

        // echo $date."\n";
        // var_dump($date->isOpen());
        // $date->nextOpen();


        // echo $date."\n";
        // var_dump($date->isOpen());

        if($date->isOpen()!=true){
          // echo($date."\n");
          $date->nextOpen();
          $dt=$dt-1;
        }

    }

    $dt=$dt+1;

    if (gettype($dt/8)=='int') {
        $d1 = new DateTime();
        $d2 = new DateTime();
        $d2->add(new DateInterval('P'.($dt/8).'D'));

        $iv = $d2->diff($d1);
    } else if($dt/8 - intval($dt/8)>=0.5) {
        $d1 = new DateTime();
        $d2 = new DateTime();
        $d2->add(new DateInterval('P'.intval($dt/8).'DT'.intval(($dt/8-intval($dt/8))*8).'H'));

        $iv = $d2->diff($d1);
    } else if ($dt/8 - intval($dt/8)<0.5) {
        $d1 = new DateTime();
        $d2 = new DateTime();
        $d2->add(new DateInterval('P'.intval($dt/8).'DT0H'));

        $iv = $d2->diff($d1);
    }



    // convertIR $dt en DateInterval avec heures jours mois etc...
    // $d1 = new DateTime();
    // $d2 = new DateTime();
    // $d2->add(new DateInterval('P'.($dt/8).'D'));

    // $iv = $d2->diff($d1);

    $duration=$iv->format('%y years %m months %D days %H hours %I minutes');

    // return simultaneously $duration and $dt
    return array([
        'duration'=>$duration,
        'dt'=>$dt
    ]);

}



function minuteToDayInterval($minutes){
    $d1 = new DateTime();
    $d2 = new DateTime();
    $d2->add(new DateInterval('PT'.$minutes.'M'));

    $iv = $d2->diff($d1);

    $duration=$iv->format('%y years %m months %D days %H hours %I minutes');
    $days=$iv->format('%a days');

    return array([
        'duration'=>$duration,
        'days'=>$days
    ]);
}

function minuteToDayDecimal($minutes) {
    $days=intval($minutes)/60/24;
    // if the value after the decimal point is greater than 0.5, lower it to 0.5 and if it is less than 0.5, lower to 0
    if ($days - intval($days)>=0.5) {
        $days=intval($days)+0.5;
    } else if ($days - intval($days)<0.5) {
        $days=intval($days);
    }
    return $days;
}

// Obtenir le nombre de jour(en décimal) de congé pour un employe par type de congé
function joursCongesEmploye($id=null) {

    if ($id) {
            $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde',
                    t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
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

        return $group_conges;
    }

}

function joursTravailMensuel($mois,$annee,$jour_debut=null) {

    // a dictionary of the name of the month and its number both in french and english
    $months = array(
        'janvier' => 1,
        'fevrier' => 2,
        'février' => 2,
        'mars' => 3,
        'avril' => 4,
        'mai' => 5,
        'juin' => 6,
        'juillet' => 7,
        'aout' => 8,
        'septembre' => 9,
        'octobre' => 10,
        'novembre' => 11,
        'decembre' => 12,
        'january' => 1,
        'february' => 2,
        'march' => 3,
        'april' => 4,
        'may' => 5,
        'june' => 6,
        'july' => 7,
        'august' => 8,
        'september' => 9,
        'october' => 10,
        'november' => 11,
        'december' => 12
    );

    // get the day of '2022-10-05'
    if ($jour_debut) {
        // $day = date('d', strtotime($annee.'-'.$months[$mois].'-'.$jour_debut));
        // $day=intval($day);
        $day=$jour_debut;
    } else {
        $day = 0;
    }
    // get the number of the month
    if (is_numeric($mois)) {
        $month=$mois;
    } else {
        $month = $months[$mois];
    }

    $conges=DB::select("select c.id, c.employe_id,type_conge_id,
                            h_travail.heure_debut as work_start, h_travail.heure_fin as work_end,
                            h_travail.debut_pause as break_start, h_travail.fin_pause as break_end, debut,fin,
                        CASE WHEN MONTH(c.fin)=MONTH(c.debut) THEN
                                -- debut + variation
                                DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.debut, '%Y-%m-%d %H:%i'), INTERVAL $day DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                        ELSE
                                CASE WHEN MONTH(c.debut)=$month AND MONTH(c.fin)!=$month THEN
                                        -- debut + variation
                                        DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.debut, '%Y-%m-%d %H:%i'), INTERVAL $day DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                WHEN MONTH(c.fin)=$month AND MONTH(c.debut)!=$month THEN
                                        -- premier jour du mois de fin
                                        DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.fin, '%Y-%m-%d %H:%i'), INTERVAL -DAYOFMONTH(STR_TO_DATE(c.fin, '%Y-%m-%d %H:%i'))+1+$day DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_debut))
                                END
                        END AS 'start',

                        CASE WHEN MONTH(c.fin)=MONTH(c.debut) THEN
                                -- fin + variation
                                DATE_FORMAT(DATE_ADD(STR_TO_DATE(c.fin, '%Y-%m-%d %H:%i'), INTERVAL $day DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                        ELSE
                                CASE WHEN MONTH(c.debut)=$month AND MONTH(c.fin)!=$month THEN
                                        -- dernier jour du mois de debut
                                        DATE_FORMAT(DATE_ADD(LAST_DAY(c.debut), INTERVAL $day DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                WHEN MONTH(c.fin)=$month AND MONTH(c.debut)!=$month THEN
                                        --  fin + variation
                                        DATE_FORMAT(DATE_ADD(STR_TO_DATE(fin, '%Y-%m-%d %H:%i'), INTERVAL $day DAY), CONCAT('%Y-%m-%d',' ',h_travail.heure_fin))
                                END
                        END AS 'end'

                        from conges c
                        JOIN employes emp on c.employe_id=emp.id
                        JOIN conges_heures_de_travail h_travail on emp.heure_de_travail_id=h_travail.id
                        where (c.etat_conge_id=1 and YEAR(c.debut)=$annee and YEAR(c.fin)=$annee)
                        AND (MONTH(c.debut)=$month or MONTH(c.fin)=$month)"
                    );



    // return $conges;


    // return an array of getWorkingHours() on conges
    $jours_travail=array();
    foreach ($conges as $key => $value) {
        // return the getWorkingHours() on conges
        $jours_travail[]=getWorkingHours($value->start,$value->end,$value->work_start,$value->work_end,$value->break_start,$value->break_end);
        // get the value of the key duration on getWorkingHours() on conges*
        $jours_travail[]=getWorkingHours($value->start,$value->end,$value->work_start,$value->work_end,$value->break_start,$value->break_end)['duration'];
    }

    return $jours_travail;

    // collapse the array of getWorkingHours() on conges
    $jours_travail=collect($jours_travail)->collapse()->toArray();

foreach ($jours_travail as $key => $value) {

    $intervalle = DateInterval::createFromDateString($value['duration']);
    $nombre_j_travail =intval($value['dt']/8);
    $hours=$intervalle->h;

    if ($hours >= 4 && $hours < 8) {
        $d=0.5;
        $nbr_jour=$nombre_j_travail+$d;

    } else if($hours < 4) {
        // si le nombre d'heure est inférieur à 4 : on ne compte pas ces heure
        // nombre de jour de travail = nombre d'heure / 8.
        $nbr_jour=intval($value['dt']/8);
    } else if($hours >= 8) {
        // si le nombre d'heures restant est de 8 : on divise l'heure totale par 8
        // ce qui donne un nombre de jour entier.
        // +8 h de travail ne peut arriver ( 08:00 - 17:00 )
        $nbr_jour=round($value['dt']/8);
    }


    // add the attribute nbr_jour to the array
    $jours_travail[$key]['nbr_jour']=$nbr_jour;

}


    return $jours_travail;


}
