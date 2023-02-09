<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Logbook extends Model
{
    use HasFactory;

    public function logAdd($title, $description)
    {
        $log = new Logbook();
        $log->user_id = Auth::id();
        $log->title = $title;
        $log->description = $description;
        $log->save();
    }
}
