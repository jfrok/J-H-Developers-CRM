<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        return view('request.index');
    }

    public function website()
    {
        return view('request.website');
    }

    public function software()
    {
        return view('request.software');
    }

    public function createReq(Request $req)
    {
        $this->validate($req,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'details' => 'required',
            'file' => 'file',

        ]);
        $new = new Order();
        $new->first_name = $req->first_name;
        $new->last_name = $req->last_name;
        $new->email = $req->email;
        $new->company = $req->company_name;
        $new->description = $req->details;
        $image = $req->file('file');
        $imageName = today()->format('Y-m-d') . "#img" . rand(1, 100) . now()->addHour()->format("H:i") . '.' . $image->extension();
        $new->files_id = $imageName;

        $new->save();
        $image->move(public_path('temp'), $imageName);
         return back()->with('success','Your request has been sent');
    }

    public function store(Request $req)
    {

        $image = $req->file('file');
        $imageName = today()->format('Y-m-d') . "#img" . rand(1, 100) . now()->addHour()->format("H:i") . '.' . $image->extension();
        $image->move(public_path('temp'), $imageName);
        return response()->json(['success' => $imageName]);

    }

}
