<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    //user functions

    public function user_list(){
        if(Auth::guard('admin')->check()){
        $users = User::all();

        return view('user.user_list', ['users' => $users]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function update_form(User $user){

        return view('user.update_form', ['user' => $user]);
    }

    public function update_user(User $user){ 

        request()->validate([
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user->update([
            'email' => request('email'),
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
        ]);

        return redirect('user_list')->withSuccess('User Edited Successfully!');
    }

    public function create_user(){
        return view('/user.create_form');
    }

    public function store(){
        request()->validate([
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
            'email' => request('email'),
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'password' => bcrypt(request('password')), 
        ]);
        Alert::success('User Successfully Created');
        return redirect('user_list')->with('success', 'User Created Successfully');
    }

    public function destroy($id){
        // $user->delete();
        $delete = User::where('id', $id)->delete();

        return redirect('user_list');
    }


    public function index(){
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */

     //admin functions
    public function registration(){
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        
        $credentials = $request->except(['_token']);

        $admin = Admin::where('email',$request->email)->first();
        if (Auth::guard('admin')->attempt($credentials)) {
            // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => 
            //     $request->password], $request->remember)){
            // SweetAlert::success('Success Message', 'Successfully Logged in');
            // Alert::success('Congrats', 'You\'ve Successfully Registered');
            // Auth::user()->id;
            return redirect()->intended('dashboard')->with('success', 'Log In Success');
        }
  
        return redirect("/")->with('error', 'Error Logging in');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request){  
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);
        
           
        $data = $request->all();
        $check = $this->create($data);
        Alert::success('Congrats', 'You\'ve Successfully Registered');

        return redirect("/");
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard(){
        if(Auth::guard('admin')->check()){
            $users = User::all();

            return view('user.user_list', ['users' => $users]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data){
      return Admin::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['first_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()    {
        Session::flush();
        Auth::logout();
        Alert::success('Successfully logged out');
  
        return redirect('/');
    }

    //houses functions
    public function houses(){
        if(Auth::guard('admin')->check()){
            $products = Product::all();

            return view('product.houses_list', ['products' => $products]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function create_house(){
        return view('/product.create_house_form');
    }

    public function create_post_house(){
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'address' => 'required',
            // 'description' => 'required',
            'status' => 'required',
        ],
        [
            'name.required' => 'Name is Required',
            'price.required' => 'Price is Required',
            'address.unique' => 'Address is Required',
            'status.required' => 'Status of the house is Required',
        ]);

        // user_id is equal to 1 if admin posted it
        Product::create([
            'user_id' => Auth::guard('admin')->id(),
            'name' => request('name'),
            'price' => request('price'),
            'description' => request('description'),
            'address' => request('address'),
            'status' => request('status'), 
        ]);
        return redirect('house_list')->with('success', 'House Created Successfully');
    }

    public function update_house_form(Product $product){

        return view('product.update_house_form', ['product' => $product]);
    }

    public function update_house(Product $product){ 

        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'address' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $product->update([
            'name' => request('name'),
            'price' => request('price'),
            'address' => request('address'),
            'description' => request('description'),
            'status' => request('status'),
        ]);
        // Alert::success('House Successfully Edited');

        return redirect('house_list')->withSuccess('House Edited Successfully!');
    }

    public function delete_product($id){
        // $user->delete();
        $delete = Product::where('id', $id)->delete();

        return redirect('house_list');
    }

    
}

