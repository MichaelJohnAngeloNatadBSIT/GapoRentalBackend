<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    // //
    // public function passwordResetProcess(UpdatePasswordRequest $request){
    //     return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
    //   }

    //   // Verify if token is valid
    //   private function updatePasswordRow($request){
    //      return DB::table('recover_password')->where([
    //          'email' => $request->email,
    //          'token' => $request->passwordToken
    //      ]);
    //   }

    // // Token not found response
    // private function tokenNotFoundError() {
    //     return response()->json([
    //       'error' => 'Either your email or token is wrong.'
    //     ],Response::HTTP_UNPROCESSABLE_ENTITY);
    // }

    // // Reset password
    // private function resetPassword($request) {
    //     // find email
    //     $userData = DB::table('users')->where('email',$request->email)->first();
    //     // Product::select('*')->where('user_id','=',$id)->get()
    //     //User::whereEmail($request->email)->first();
    //     // update password
    //     $userData->update([
    //       'password'=>bcrypt($request->password)
    //     ]);
    //     // remove verification data from db
    //     $this->updatePasswordRow($request)->delete();
    //     // reset password response
    //     return response()->json([
    //       'data'=>'Password has been updated.'
    //     ],Response::HTTP_CREATED);
    // }    

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgot_password');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins',
        ],
        [
            'email.exists' =>'this email does not exist in our database!',
                
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.resetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->withSuccess('Password Reset Has been sent to your email!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.forgot_password_link', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
        //   $request->validate([
        //       'email' => 'required|email|exists:admins',
        //       'password' => 'required|string|min:6|confirmed',
        //       'password_confirmation' => 'required'
        //   ]);
          $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ],
        [   
            'email.exists' =>'this email does not exist in our database!',
            'password.confirmed' => 'Password does not match with Password Confirmation'
            
                
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $admin = Admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/login')->withSuccess('Your password has been changed!');
      }
}
