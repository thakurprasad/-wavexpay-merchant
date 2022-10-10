<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Helper;
use Session;
use GuzzleHttp\Client;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function SignUpMerchantStepOne(Request $request)
    {
        $input = $request->all();
        $action = '';
        $register_session_array = array();
        $register_session_array['business_type'] = $input['business_type'];
        $register_session_array['business_category'] = $input['business_category'];
        if(isset($request->action) && $request->action=='become_a_partner')
        {
            $register_session_array['action'] = $request->action;
            $action = $request->action;
        }
        else if(isset($request->action) && $request->action=='reference')
        {
            $ref_no = $request->ref_no;
            $get_merchant_details = DB::table('merchants')->where('referral_link_text',$ref_no)->first();
            $referred_by = $get_merchant_details->id;
            $referral_id = $ref_no;
            $register_session_array['referral_id'] = $referral_id;
            $register_session_array['referred_by'] = $referred_by;
            $action = 'referral';
        }
        Session::put('register_session_array',$register_session_array);
        return view('auth.register2',compact('action'));
    }

    public function SignUpMerchantStepTwo(Request $request)
    {
        $input = $request->all();
        $register_session_array = Session::get('register_session_array');
        $access_salt = 'Merchant_'.$this->generateRandomString(20);
        $insertarray['merchant_logo'] = 'default_logo.png';
        //$insertarray['access_salt'] = env('MERCHANT_SALT');
        $insertarray['access_salt'] = $access_salt;
        $insertarray['merchant_payment_method'] = 'razorpay';
        $insertarray['contact_name'] = $input['name'];
        $insertarray['merchant_name'] = $input['name'];
        $insertarray['contact_phone'] = $input['phone'];
        if(isset($input['action']) && $input['action']!='' && $input['action']=='become_a_partner')
        {
            $insertarray['is_partner'] = 'yes';
        }
        else if(isset($input['action']) && $input['action']!='' && $input['action']=='referral')
        {
            $insertarray['referral_id'] = $register_session_array['referral_id'];
            $insertarray['referred_by'] = $register_session_array['referred_by'];
        }
        $insertarray['created_at'] = date('Y-m-d H:i:s');

        $merchant_id = DB::table('merchants')->insertGetId($insertarray);

        $merchantuserinsertarray['merchant_id'] = $merchant_id;
        $merchantuserinsertarray['name'] = $input['name'];
        $merchantuserinsertarray['email'] = $input['email'];
        $merchantuserinsertarray['email_verified_at'] = date('Y-m-d H:i:s');
        $merchantuserinsertarray['password'] = Hash::make('password');
        $merchantuserinsertarray['created_at'] = date('Y-m-d H:i:s');

        $merchant_user = DB::table('merchant_users')->insertGetId($merchantuserinsertarray);

        $merchant_keys = DB::table('merchant_keys')->insert(array('merchnat_id'=>$merchant_id,'api_title'=>'Razorpay','api_key'=>'rzp_live_'.$this->generateRandomString(14),'api_secret'=>$this->generateRandomString(20),'created_at'=>date('Y-m-d H:i:s')));


        $merchant_salt = $access_salt;
        
        $client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = '/api/merchants/login';
        $response = $client->request('POST',$api_end_point,[
            'form_params' => [
                'email' => $request->input('email'),
                'password' => 'password',
                'merchant_salt' => $merchant_salt
            ]
        ]);

        //dd($response);

        $status_code = $response->getStatusCode();
        // 200
        $header = $response->getHeader('content-type');
        // 'application/json; charset=utf8'
        $res  =  json_decode($response->getBody(),true);

        //print_r($res);exit;

        if($status_code==200){
            if($res['status']=='success'){
                //dd($res);
                $access_token = $res['access_token'];
                session()->put('token', $access_token);
                session()->put('merchant', $res['merchant']['merchant_id']);
                session()->put('merchant_key', $res['api_keys'][0]['api_key']);
                session()->put('merchant_secret', $res['api_keys'][0]['api_secret']);

                $get_merchant_details = Helper::get_merchant_details($res['merchant']['merchant_id']);
                if($get_merchant_details->is_partner=='yes')
                {
                    return redirect('/partner-dashboard');
                }
                //return redirect('/complete-sign-up');
                return redirect('/');
            }else{
                return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
            }
        }else{
            return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
        }
       

       
    }


    public function RegisterAsPartner(Request $request)
    {
        if(isset($request->ref) && $request->ref!='')
        {
            $action = 'reference';
            $ref_no = $request->ref;
        }
        else 
        {
            $action = 'become_a_partner';
            $ref_no = '';
        }
        
        return view('auth.register',compact('action','ref_no'));
    }
}
