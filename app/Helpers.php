<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Cmixin\BusinessTime;


function getWorkingHours($start,$end)
{
    BusinessTime::enable(Carbon::class, [
        'monday' => ['08:00-12:00', '13:00-17:00'],
        'tuesday' => ['08:00-12:00', '13:00-17:00'],
        'wednesday' => ['08:00-12:00'],
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

    $interv=DateInterval::createFromDateString(strval($dt).' hours');

    $duration=$interv->format('%y years %m months %D days %H hours %I minutes');

    return $duration;

}
