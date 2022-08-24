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
// function joursCongesEmploye($id=null) {

//     if ($id) {
//             $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde',t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
//                 CASE WHEN t.frequence_solde_id = 1 THEN TIMESTAMPDIFF(MONTH, contrat.date_embauche,NOW() )*t.solde
//                 WHEN t.frequence_solde_id = 4 THEN TIMESTAMPDIFF(YEAR, contrat.date_embauche,NOW() )*t.solde
//                 ELSE t.duree_max
//                 END AS 'total_acquis'
//                 from conges c join conges_types_conge t on c.type_conge_id = t.id JOIN employes e on c.employe_id=e.id
//                 JOIN pers_contrats contrat on contrat.employer_id=e.id
//                 JOIN conges_etats_conge etat ON c.etat_conge_id=etat.id
//                 where c.employe_id=$id and c.etat_conge_id=1
//                 group by c.type_conge_id;"
//             );


//         foreach ($conges as $key => $value) {
//             $value->total_j_acquis=minuteToDayDecimal($value->total_acquis);
//             $value->solde_jour=minuteToDayDecimal($value->solde);
//         }

//         return $conges;

//     } else {
//         $conges=DB::select("select c.employe_id, c.type_conge_id, t.type_conge,IF(t.solde, t.solde, 'pas de solde') as 'solde',t.solde_format as 'solde(php)', sum(c.j_utilise) as total_j_utilise,
//                 CASE WHEN t.frequence_solde_id = 1 THEN TIMESTAMPDIFF(MONTH, contrat.date_embauche,NOW() )*t.solde
//                 WHEN t.frequence_solde_id = 4 THEN TIMESTAMPDIFF(YEAR, contrat.date_embauche,NOW() )*t.solde
//                 ELSE t.duree_max
//                 END AS 'total_acquis'
//                 from conges c join conges_types_conge t on c.type_conge_id = t.id JOIN employes e on c.employe_id=e.id
//                 JOIN pers_contrats contrat on contrat.employer_id=e.id
//                 JOIN conges_etats_conge etat ON c.etat_conge_id=etat.id
//                 where c.etat_conge_id=1
//                 group by c.type_conge_id, c.employe_id;"
//         );

//         $group_conges = array();
//         foreach ($conges as $key => $value) {
//             $value->total_j_acquis=minuteToDayDecimal($value->total_acquis);
//             $value->solde_jour=minuteToDayDecimal($value->solde);

//             $group_conges[$value->employe_id][$value->type_conge_id]=$value;
//         }

//         return $group_conges;
//     }


// }
