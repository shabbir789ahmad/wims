<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;
use Mail;
use DB;
use App\Models\Admin;
use Carbon\Carbon;
class PasswordController extends Controller
{
    public function forgotPasswordEmail() {
        
        return view('auth.email');

    }

    function sendForgotPasswordEmail(Request $req)
    {
  
        $req->validate([
        
         'email'=>'required|email|exists:admins'

        ]);   

       $token = Str::random(64);
         DB::table('password_resets')->insert([
              'email' => $req->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
       Mail::send('auth.forgetPassword', ['token' => $token], function($message) use($req){
              $message->to($req->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      
    }

    function resetView($token)
    {
        return view('auth.resetemail',['token'=>$token]);
    }


    function resetPassword(Request $request)
    {
         $request->validate([
              'email' => 'required|email|exists:admins',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
        
         $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = Admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/')->with('message', 'Your password has been changed!');
    }
}
