<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public function getWorkedHours()
    {
        $workorders = Hours::where('project_id', $this->id)->get();

        $hours = 0;
        foreach ($workorders as $workorder) {
            $from = Carbon::parse($workorder->time_from);
            $to = Carbon::parse($workorder->time_to);
            $hours += $to->diffInMinutes($from) / 60;
        }
        return $hours;
    }

    public function workedAgreedPrice()
    {
        return number_format($this->getWorkedHours() * $this->set_price, 2, ',', '.');

    }


}

