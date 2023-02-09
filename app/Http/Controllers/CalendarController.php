<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\settings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function calendar()
    {
        $events = Event::all();
        return view('calendar.calendar',compact('events'));
    }
    public function eventData()
    {
        $events = Event::all();
        return view('includes.event-calendar',compact('events'));
    }
    public function addEvent(Request $request)
    {
        $start = $request->start;
        $title = $request->title;
        $color = $request->color;
        $timeFrom = $request->time_from;
          $timeTo = $request->time_to;

        $newEvent = new Event();
        $newEvent->dateIn = $start;
        $newEvent->title = $title;
        $newEvent->color = $color;
        if ($timeFrom != null){
            $newEvent->time_from = $timeFrom;
            $newEvent->time_to = $timeTo;
        }

        $newEvent->save();
        return response()->json('success');
    }
    public function editEvent($eId,Request $request)
    {
        $start = $request->start_edit;
        $title = $request->title_edit;
        $color = $request->color_edit;
        $timeFrom = $request->time_from_edit;
        $timeTo = $request->time_to_edit;
//        $this->validate($request, [
//            'title' => 'required',
//            'start' => 'required',
//            'çolor' => 'required',
//        ]);
        //$timeTo = date('H:i', strtotime(Carbon::parse($timeFrom)->addMinutes($settings->interval)));
        $newEvent = Event::find($eId);
        $newEvent->dateIn = $start;
        $newEvent->title = $title;
        $newEvent->time_from = $timeFrom;
        $newEvent->time_to = $timeTo;
        $newEvent->color = $color;
//dd($timeTo);
        $newEvent->save();
        return response()->json('success');
    }
    public function deleteEvent($eId)
    {
        Event::find($eId)->delete();
//    Book::find($eId)->delete();
    }
}
