<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\MerchantUser;
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

        $merchant_id =  session()->get('merchant');
        $mdetails = MerchantUser::where('merchant_id',$merchant_id)->first();
        if(!Hash::check($request->current_password, $mdetails->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        MerchantUser::where('merchant_id',$merchant_id)->update(['password'=> Hash::make($request->new_password)]);
        return back()->with("success", "Password changed successfully!");
   
    }
}