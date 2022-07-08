<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function user_list(Request $request){
        // return $request->route()->uri();
        $users = User::all();

        return view('user_list', ['users' => $users]);
    }
}
