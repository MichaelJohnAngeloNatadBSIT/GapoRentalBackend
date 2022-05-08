<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }

    public function user(Request $request){
        return $request->user();
    }

    public function register(UserRegisterRequest $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ],
        [
            'first_name.required' => 'First Name is Required',
            'last_name.required' => 'Last Name is Required',
            'email.required' => 'Email is Required',
            'email.unique' => 'Email is Already Taken',
            'password.required' => 'Password is Required',
        ]);
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json($request);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->update();

       return response()->json($user);
   }

}
