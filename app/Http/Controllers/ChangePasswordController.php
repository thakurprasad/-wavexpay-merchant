<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\MerchantUser;
use DB;
use Illuminate\Support\Facades\Validator;
  
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
        $rules = array([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $rules = array('current_password' => ['required'], 'new_password' => ['required'], 'new_confirm_password' => ['same:new_password']);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error_msg = '';
            $error = $validator->getMessageBag()->toArray();
            foreach($error as $key=>$val)
            {
                $error_msg.=$val[0].'<br />';
            }
            return response()->json(array('success'=>0,'msg'=>$error_msg));
        }


        $merchant_id =  session()->get('merchant');
        $mdetails = MerchantUser::where('merchant_id',$merchant_id)->first();
        if(!Hash::check($request->current_password, $mdetails->password)){
            return response()->json(array('success'=>0,'msg'=>'Old Password Does not match!'));
        }

        MerchantUser::where('merchant_id',$merchant_id)->update(['password'=> Hash::make($request->new_password)]);
        return response()->json(array('success'=>1,'msg'=>'Password changed successfully!'));
    }
}