<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Cmixin\BusinessTime;


function addDateInterval($interval, $ajout) {
    $interval=DateInterval::createFromDateString($interval);
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
    $interval1=DateInterval::createFromDateString($interval1);
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


function getWorkingHours($start,$end)
{
    BusinessTime::enable(Carbon::class, [
        'monday' => ['08:00-12:00', '13:00-17:00'],
        'tuesday' => ['08:00-12:00', '13:00-17:00'],
        'wednesday' => ['08:00-12:00', '13:00-17:00'],
        'thursday' => ['08:00-12:00', '13:00-17:00'],
        'friday' => ['08:00-12:00', '13:00-17:00'],
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
