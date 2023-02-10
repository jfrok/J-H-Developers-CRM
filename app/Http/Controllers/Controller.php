<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hours;
use App\Models\Logbook;
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(Request $req)
    {
        $notis = Notification::all();
//        $filt =$req->filter;
//        dd($filt);
        $projectAll = Project::all();
        $customerAll = Customer::all();
//        where(function ($query){
//            if ($filterDay = \request()->query('filter') === Carbon::today()->format('Y-m-d')){
//                $query->whereDate('created_at',$filterDay)->get();
//            }elseif ($filterMonth = \request()->query('filter') === Carbon::today()->format('m')){
//                $query->whereMonth('created_at',$filterMonth)->get();
//
//            }elseif ($filterYear = \request()->query('filter') === Carbon::today()->format('Y')){
//                $query->whereYear('created_at',$filterYear)->get();
//
//            }
//        });
        $customers = Customer::all();
        $hourAll = Hours::all();
        $logBook = Logbook::all();
        $admins = User::where('role', 'admin')->get();
        $role = User::find(Auth::id());

        $total = 0;

        foreach ($admins as $admin) {

            $costs = $admin->hour_cost * \App\Models\Hours::where('user_id', $admin->id)->sum('hours');
            $total += $costs;
        }
//        dd($total);


        $month = '2023-01';
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $period = \Carbon\CarbonPeriod::create('2023-01-09', Carbon::today());

        $p = [];
        // If you want just dates
        // Iterate over the period and create push to array
        foreach ($period as $date) {
            array_push($p, $date->format('Y-m-d'));
        }

        // Return an array of dates
        // dd($p);

//dd($dates);
        //  echo "<pre>", print_r($dates), "</pre>";
        return view('dashboard', compact('notis', 'customerAll', 'projectAll', 'p', 'hourAll', 'logBook', 'total','customers','role'));
    }
public function filters($month,$year)
{
    $customerFilter = Customer::whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
//    $dec = 0;
//    $all = 0;
//    foreach ($customerFilter as $workorder) {
//        $from = Carbon::parse($workorder->time_from);
//        $to = Carbon::parse($workorder->time_to);
//        if ($workorder->project && $workorder->project->include_count) {
//            if ($workorder->status != "Niet meetellen") {
//                $all += $to->diffInMinutes($from) / 60;
//                if ($workorder->status == 'Declarabel') {
//                    $dec += $to->diffInMinutes($from) / 60;
//                }
//            }
//        }
//    }

//    if ($all <= 0 || $dec <= 0) {
//        return 0;
//    } else {
//        return ($dec / $all) * 100;
//    }
}
    public function notification(Request $request)
    {
        $noti = new Notification();
        $noti->user_id = Auth::id();
        $noti->title = $request->title;
        $noti->description = $request->description;
        $noti->save();
        return response()->json();
    }

    public function getNotification()
    {
        $notis = Notification::all();
        $data = view('layouts.navigation', compact('notis'))->render();
        return response()->json($data);
    }

    public function generalSearch() {
        $search = $_GET['searchQuery'];

        $project = Project::where('title', 'like', '%'.$search.'%');
        $query = Customer::where('fullname', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%');
        $customerQ = $query->latest()->paginate(5);
        $projectQ = $project->latest()->paginate(5);

        $data = view('includes.search-sugg', compact('customerQ','projectQ'))->render();
        return response()->json($data);
    }

//    public function page($page) {
//        if(view()->exists($page)) {
//            $notis = Notification::all();
//            return view($page,compact('notis'));
//        } else {
//            return redirect()->to('/');
//        }
//    }
}
