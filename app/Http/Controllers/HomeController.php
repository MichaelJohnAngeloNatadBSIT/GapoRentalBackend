<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request){
        $data = [
            'name' => 'test',
            'channel' => $request->channel

        ];
        return view('adminlte', $data);
    }

    public function first_page(Request $request){
        // return $request->route()->uri();
        return view('first_page');
    }

    public function second_page(){
        return view('second_page');
    }
}
