<?php

namespace App\Http\Controllers;

use App\Mail\sendMesseges;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function messagesView($cId)
    {
       $messages = Email::where('customer_id',$cId)->orderBy('created_at', 'DESC')->get();
        return view('includes.customer-tab',compact('messages'));
    }
    public function emailsHistory(Request $request)
    {
        $history = new Email();
        $history->user_id = Auth::id();
        $history->customer_id = $request->customerId;
        $history->subject = $request->subject;
        $history->message = $request->message;
        $history->save();
        $details = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];
//        dd($request->all());
        Mail::to($request->email)->send(new sendMesseges($details));
        return response()->json('success');
    }

}
