<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventCalendar;
use App\Models\conge;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()) {

             $data = conge::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       //->get(['id','user_id','type_motif_conge_id','date_debut','date_fin','descriptions','dure_conge']);
                       ->get(['id','start','end','descriptions']);

             return response()->json($data);
        }

        return view('fullcalender');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
           case 'add':
              $event = conge::create([
                  'descriptions' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'update':
              $event = EventCalendar::find($request->id)->update([
                  'descriptions' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = EventCalendar::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # code...
             break;
        }
    }

}
