<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
  
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        /*User::find(auth()->guard('merchant')->user()->id)->update(['password'=> Hash::make($request->new_password)]);*/
        $get_merchant_by_password = DB::table('merchant_users')->where('password',Hash::make($request->current_password))->get();


        if(!empty($get_merchant_by_password)){
            if($request->new_password!=$request->new_confirm_password){
                return redirect()->back()->with('error', 'new password and confirm password password not right'); 
            }
            DB::table('merchant_users')->where('email','merchant@gmail.com')->update(['password'=> Hash::make($request->new_password)]);
            return redirect()->back()->with('success', 'password changed successfully!!');   
        }else{
            return redirect()->back()->with('error', 'current password not right');   
        }
   
        //dd('Password change successfully.');
    }
}