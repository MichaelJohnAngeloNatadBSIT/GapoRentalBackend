<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sales;
use App\Models\Schedule;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Redirect,Response;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    public function dashboard(){
        if(Auth::guard('admin')->check()){
            // $users = User::all();

            $users_count = User::count();
            $posts_count = Product::count();
            $schedules_count = Schedule::count();
            $approved_schedules_count = Schedule::select('*')->where('status', '=', 'approved')->get()->count();
            $sales_total = Sales::get()->sum("product_price");
            $sales_count = Sales::count();
            $sales_graph_data = Sales::pluck('product_price');
            // $sales_date = Sales::pluck('created_at');
            // $date_sales_graph_data = Sales::pluck('created_at');
            // $sales_graph_data = Sales::pluck('id')->count();
                                    
          
            return view('dashboard', [
                        'users_count' => $users_count, 
                        'posts_count' => $posts_count, 
                        'schedules_count' => $schedules_count, 
                        'sales_total' => $sales_total,
                        'sales_count'=> $sales_count,
                        'approved_schedules_count' => $approved_schedules_count,
                        'sales_graph_data' => $sales_graph_data,
                        // 'sales_date' =>  $sales_date
                        // 'chart_data' => $data,
                        // 'date_sales_graph_data' => $date_sales_graph_data,
                        // 'chart' => compact('labels', 'data')
                    ]);
            // return view('dashboard');
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function graphsData(){
        if(Auth::guard('admin')->check()){


            $sales_graph_data = Sales::pluck('product_price');

            return view('graph_data',[
                'sales_graph_data' => $sales_graph_data,
            ]);
            }
    }
 
    //user functions

    public function user_list(){
        if(Auth::guard('admin')->check()){
        $users = User::all();
        $sales_graph_data = Sales::pluck('product_price');

        return view('user.user_list', ['users' => $users, 'sales_graph_data' => $sales_graph_data,]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function update_form(User $user){
        if(Auth::guard('admin')->check()){
            $sales_graph_data = Sales::pluck('product_price');
            return view('user.update_form', ['user' => $user,  'sales_graph_data' => $sales_graph_data,]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function update_user(User $user){ 
    if(Auth::guard('admin')->check()){
        
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
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }

    public function create_user(){
    if(Auth::guard('admin')->check()){
        $sales_graph_data = Sales::pluck('product_price');
        return view('/user.create_form', ['sales_graph_data' => $sales_graph_data]);
    }
    Alert::error('Opps! You do not have access');
    return redirect("/");
       
    }

    public function store(){
    if(Auth::guard('admin')->check()){
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
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }

    public function destroy($id){
        if(Auth::guard('admin')->check()){
            // $user->delete();
            $delete = User::where('id', $id)->delete();

            return redirect('user_list');
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
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
        ],
        [
            'email.required' => 'Email is Required',
            'password.required' => 'Password is Required',
        ]);
   
        $credentials = $request->only('email', 'password');

        
        $credentials = $request->except(['_token']);

        $admin = Admin::where('email',$request->email)->first();
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Log In Success');
        }
      
        // if ($request('email') == null && $request('password') == null) {
        //     // $validator->errors()->add('event', 'Please select an event');
        //     return redirect("/")->with('error', 'Email and Password required');
        // }
        return redirect()->back()->withErrors('Wrong Email or Password');
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
            'password_confirmation' => 'required'
        ]);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ],
        [
            'email.unique' =>'This email is already been taken',
            'email.required' => 'Email is Required',
            'first_name.required' => 'First Name is Required',
            'last_name.required' => 'Last Name is Required',
            'password.required' => 'Password is Required',
            'password_confirmation.required' => 'Password Confirmation is Required',
                
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
           
        $data = $request->all();
        $check = $this->create($data);
        Alert::success('Congrats', 'You\'ve Successfully Registered');

        return redirect("/");
    }
    
    
    public function create(array $data){
      return Admin::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['first_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function update_admin_profile_form(){
        return view('admin.admin_update_form');
    }

    
    public function update_admin(Admin $admin){ 
        if(Auth::guard('admin')->check()){
    
            request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                // 'password' => 'required',
            ]);
    
            $admin->update([
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'email' => request('email'),
                // 'password' => request('description'),
            ]);
    
            return redirect('dashboard')->withSuccess('Your Profile is Edited Successfully!');
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
        }

        public function update_image(Request $request, $id){

            if(Auth::guard('admin')->check()){
                if ($request->hasFile('image')){
                    $file = $request->file('image');
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = date('His').'-'.$filename;
                    //move image to public/img folder
                    $file->move(public_path('storage/adminImage'), $picture);
                    Admin::where('id',$id)->update(array('image'=> $picture));
        
                    return redirect('dashboard')->withSuccess('Your Profile Picture is Updated Successfully!');
                } 
                else{
                    return redirect('dashboard')->with('error', 'Something went wrong');
                }
            }
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
            $sales_graph_data = Sales::pluck('product_price');

            return view('product.houses_list', ['products' => $products,  'sales_graph_data' => $sales_graph_data,]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function create_house(){
    if(Auth::guard('admin')->check()){
        $sales_graph_data = Sales::pluck('product_price');
        return view('/product.create_house_form', ['sales_graph_data' => $sales_graph_data]);
    }
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }

    public function create_post_house(){
    if(Auth::guard('admin')->check()){
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
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }

    public function update_house_form(Product $product){
    if(Auth::guard('admin')->check()){
        $sales_graph_data = Sales::pluck('product_price');

        return view('product.update_house_form', ['product' => $product,  'sales_graph_data' => $sales_graph_data,]);
    }
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }

    public function update_house(Product $product){ 
    if(Auth::guard('admin')->check()){

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
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }

    public function delete_product($id){
    if(Auth::guard('admin')->check()){
        // $user->delete();
        $delete = Product::where('id', $id)->delete();

        return redirect('house_list');
    }
    Alert::error('Opps! You do not have access');
    return redirect("/");
    }


    //Schedule Functions

    public function schedules(){
        if(Auth::guard('admin')->check()){
            $schedules = Schedule::all();
            $sales_graph_data = Sales::pluck('product_price');

            return view('schedule.schedule_list', ['schedules' => $schedules, 'sales_graph_data' => $sales_graph_data]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    public function update_schedule_form(Schedule $schedule){
        if(Auth::guard('admin')->check()){
    
            return view('schedule.update_schedule_form', ['schedule' => $schedule]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
        }

    public function update_schedule(Schedule $schedule){ 
        if(Auth::guard('admin')->check()){
    
            request()->validate([
                'product_name' => 'required',
                'product_price' => 'required',
                'schedule_date' => 'required',
            ]);
    
            $schedule->update([
                'product_name' => request('required'),
                'product_price' => request('required'),
                'schedule_date' => request('required'),
            ]);
    
            return redirect('schedule.schedule_list')->withSuccess('Schedule Edited Successfully!');
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
        }


        //sales functions
    public function sales(){
        if(Auth::guard('admin')->check()){
            $sales = Sales::all();
            $sales_graph_data = Sales::pluck('product_price');

            return view('sale.sale_list', ['sales' => $sales, 'sales_graph_data' => $sales_graph_data]);
        }
        Alert::error('Opps! You do not have access');
        return redirect("/");
    }

    
}

