<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UsersController extends Controller
{
    public function create() {
        if(User::whereEmail(request()->email)->exists()) {
            return;
        } else {
            $new = new User();
            $new->name = request()->name;
            $new->email = request()->email;
            if(request()->password === request()->password_veri) {
                $new->password = bcrypt(request()->password);
            } else {
                return;
            }
            $new->role = 'Admin';
            $new->hour_cost = 75.00;
            $new->save();
        }

        $users = User::all();
        $data = view('users.ajax.usersTable', compact('users'))->render();
        return response()->json($data);
    }
}
