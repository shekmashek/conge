<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventCalendar;
use App\Models\type_motif_conge;
use App\Models\conge;
use Illuminate\Support\Facades\DB;

class FullCalenderController extends Controller
{

    public function indexTest()
    {
        $type_conges = type_motif_conge::get(['id', 'nom_motif', 'etat_paiement']);
        $conges=json_encode(conge::all());
        return view('manager.calendartest', compact('type_conges','conges'));
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = conge::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->where('etat_conge', '=', 1)
                //->get(['id','user_id','type_motif_conge_id','date_debut','date_fin','descriptions','dure_conge']);
                ->get(['id', 'start', 'end', 'title']);

            return response()->json($data);
        }
        $type_conges = type_motif_conge::get(['id', 'nom_motif', 'etat_paiement']);

        //$type_conges=type_motif_conge::all();
        return view('manager.fullCalendar', compact('type_conges'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

     public function insertConge(Request $request)
     {

           $conge=new conge();
            $conge->user_id=1;
            $conge->type_motif_conge_id=$request->type_motif_conge_id;
            $conge->start=$request->start;
            $conge->end=$request->end;
            $conge->title=$request->title;
            $conge->dure_conge=DB::raw( "TIMESTAMPDIFF(HOUR,'".$request->start."','".$request->end."')");
            $conge->save();
            $data=conge::all();
            return response()->json(['success'=>'abscence ajouter avec succes!','data'=>$data]);

     }
    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = conge::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = conge::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = conge::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }
}
