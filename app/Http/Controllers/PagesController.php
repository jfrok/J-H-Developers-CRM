<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function createPage(Request $req)
    {
        $new = new Page();
        $new->user_id = Auth::id();
        $new->title = $req->title;
        $new->description = $req->description;
        $new->save();
        return response()->json('success');
    }
    public function getPages()
    {
       $pages = Page::where('user_id',Auth::id())->get();
       $data = view('PDF.includes.pages-load',compact('pages'))->render();
        return response()->json($data);
    }
    public function deletePage($pId)
    {
        Page::find($pId)->delete();
        return response()->json('success');
    }
}
