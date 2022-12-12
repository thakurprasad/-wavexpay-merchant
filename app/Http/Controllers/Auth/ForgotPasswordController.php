<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request; 
use Carbon\Carbon; 
use App\Models\MerchantUser; 
use App\Models\Merchant; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use DB;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function showForgetPasswordForm()
    {
        return view('auth.passwords.forgetPassword');
    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|exists:merchant_users',
        ]);

        $merchant = MerchantUser::where('email', $request->email)->first();
        if(!$merchant){
            return back()->with('error', 'Error: Invalid email , '.$request->email.'This email address is not registered');    
        }
        $token = Str::random(64);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email])->first();
        if($updatePassword){
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
        }

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('auth.passwords.forgetPasswordTemplate', ['token' => $token, 'merchant_name'=>$merchant->name], function($message) use($request){
            
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token) { 
        $updatePassword = DB::table('password_resets')->where(['token' => $token])->first();
        if(!$updatePassword){
            return redirect('/forget-password')->with('error', 'Token Is Not Correct! Please Try Again...');
        }
       return view('auth.passwords.forgetPasswordLink', ['token' => $token]);
    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:merchant_users',
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


        $user = MerchantUser::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
