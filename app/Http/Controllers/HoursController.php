<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hours;
use App\Models\Logbook;
use App\Models\LogSys;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HoursController extends Controller
{
    public function overview()
    {
        $admins = User::where('role', 'admin')->get();
        $hours = Hours::where('user_id', 'user_id');
//        foreach ($admins as $admin)
//        {
//            //Hours::where('user_id',$admin->id);
//            $total = $admin->hour_cost * Hours::sum('hours');
//        }
      // dd($total) ;

        return view('work.hours-overview', compact('admins',));
    }

    public function logAdd($title,$id,$type, $description)
    {
        $log = new Logbook();
        $log->user_id = Auth::id();
        $log->title = $title;
        $log->type = $type;
        $log->id_of = $id;
        $log->description = $description;
        $log->save();
    }


    public function fillHours(Request $request)
    {
        $hour = new Hours();
        $hour->user_id = Auth::id();
        $hour->title = $request->title;
        $hour->project_id = $request->project_id;
        $hour->date = $request->date;
        $hour->description = $request->description;
        $hour->time_from = $request->time_from;
        $hour->time_to = $request->time_to;

        $hours = 0;
        $start = Carbon::parse($request->time_from);
        $end = Carbon::parse($request->time_to);
        $hours += $end->diffInMinutes($start) / 60;
        $hour->hours = $hours;
        $hour->save();
$this->logAdd($request->title,$hour->id,'filled','Hours');
        return response()->json('success');
    }
//    public function getTotalHours()
//    {
//        $admins = User::where('role', 'admin')->get();
//        $hours = Hours::All();
//        $adminCost = [];
//        $totals = 0;
//
//        foreach ($admins as $admin) {
//            //Hours::where('user_id',$admin->id);
//            array_push($adminCost, $admin->hour_cost);
//            //array_push($totals, $adminCost * Hours::sum('hours'));
//            foreach ($hours as $key => $hour) {
//
//                $adminTotal = $adminCost[1] ?? 0;
//                $sum = $adminTotal * Hours::sum('hours');
//            }
//        }
//dd($sum);
//       // $sum = $totals + $adminCost;
//
//        return view('work.testing',compact('admins','totals'));
//
//    }
    public function editHours($hId)
    {
        $hour = Hours::find($hId);

        return response()->json([
            'status' => 200,
            'hour' => $hour
        ]);
    }
    public function getHours()
    {
        $admins = User::where('role', 'admin')->get();
        $hours = Hours::where('user_id', 'user_id');
        $total = [];
        foreach ($admins as $admin)
        {
            //Hours::where('user_id',$admin->id);
            array_push($total, $admin->hour_cost + $admin->hour_cost * Hours::sum('hours'));
        }
        $data = view('work.includes.get-hours', compact('admins','total'))->render();

        return response()->json($data);
    }
    public static function getHoursCost()
    {
        $admins = User::where('role', 'admin')->get();
        $hours = Hours::where('user_id', 'user_id');
        foreach ($admins as $admin)
        {
            //Hours::where('user_id',$admin->id);
            $total = $admin->hour_cost * Hours::sum('hours');
        }
        return  $total;

    }
    public function deleteHour($hId)
    {
        Hours::find($hId)->delete();
        $this->logAdd('non',$hId,'delete','Hours');

//    Book::find($eId)->delete();
    }
//    static function getDeclarabelTeamHours()
//    {
//        $workorders = WorkOrder::whereMonth('date', Carbon::today('Europe/Amsterdam')->format('m'))->whereYear('date', Carbon::today('Europe/Amsterdam')->format('Y'))->get();
//        $dec = 0;
//        $all = 0;
//        foreach ($workorders as $workorder) {
//            $from = Carbon::parse($workorder->time_from);
//            $to = Carbon::parse($workorder->time_to);
//            if ($workorder->project && $workorder->project->include_count) {
//                if ($workorder->status != "Niet meetellen") {
//                    $all += $to->diffInMinutes($from) / 60;
//                    if ($workorder->status == 'Declarabel') {
//                        $dec += $to->diffInMinutes($from) / 60;
//                    }
//                }
//            }
//        }
//
//        if ($all <= 0 || $dec <= 0) {
//            return 0;
//        } else {
//            return ($dec / $all) * 100;
//        }
//    }

}
