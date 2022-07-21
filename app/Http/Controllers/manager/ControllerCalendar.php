<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerCalendar extends Controller
{
    public function index(Request $request)
    {


        return view("manager.calendar");
    }

    public function test(Request $request)
    {
        if($request->ajax())
        {
           dump($request->start);
           dump($request->end);
        }
    }

    public function index1()
    {
        return view('manager.fullCalendar');
    }
}
