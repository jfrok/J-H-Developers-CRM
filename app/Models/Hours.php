<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Hours extends Model
{
    use HasFactory;
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
    public static function getWorkedHours($from,$to)

    {
        $hours = 0;
            $start = Carbon::parse($from);
            $end = Carbon::parse($to);
            $hours += $end->diffInMinutes($start) / 60;

            return $hours;

        }
        public static function totalHours()
        {
            $admin = User::where('role','admin')->get();
            $workHours = Hours::all();
            $hours = 0;
            foreach ($workHours as $workHour){
               $from = Carbon::parse($workHour->time_from);
               $to = Carbon::parse($workHour->time_to);
               $hours += $to->diffInMinutes($from) / 60;
            }

            return $hours;
        }
        public static function getTotalPriceByProject()
        {
            $admins = User::where('role', 'admin')->get();
            $hours = Hours::All();
            $adminsTotal = [];
            $totals = 0;

            foreach ($admins as $admin) {
                //Hours::where('user_id',$admin->id);
                 array_push($adminsTotal,$admin->hour_cost * 26);

                //array_push($totals, $adminCost * Hours::sum('hours'));
            }
return $adminsTotal;
        }
    public function getWorkedHoursByProject()
    {
        $workorders = Hours::where('project_id', $this->id)->get();

        $hours = 0;
        foreach ($workorders as $workorder) {
            $from = \Carbon\Carbon::parse($workorder->time_from);
            $to = Carbon::parse($workorder->time_to);
            $hours += $to->diffInMinutes($from) / 60;
        }
        return $hours;
    }

    public static function workedAgreedPriceFromProject()
    {
        $project = Project::all();

        $totalPrices = 0;
        foreach ($project as $proj){
            $prices =  $proj->getWorkedHours() * $proj->set_price;
            $totalPrices += $prices;
        }

        return number_format($totalPrices,2,',','.');
    }
}
