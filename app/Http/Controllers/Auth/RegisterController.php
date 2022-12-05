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
use App\Models\Merchant;
use App\Models\MerchantUser;
use App\Models\MerchantKey;



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
        DB::beginTransaction();
        try{

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
              return  $get_merchant_details = DB::table('merchants')->where('referral_link_text',$ref_no)->first();
                $referred_by = $get_merchant_details->id;
                $referral_id = $ref_no;
                $register_session_array['referral_id'] = $referral_id;
                $register_session_array['referred_by'] = $referred_by;
                $action = 'referral';
            }
            session::put('register_session_array',$register_session_array);
            DB::commit();
            return view('auth.register2',compact('action'));

        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->withErrors(['error'=>$ex->getMessage()]);
        }

    }

    public function SignUpMerchantStepTwo(Request $request)
    {
        //DB::beginTransaction();
        /*try{*/
            $input = $request->all();
            $register_session_array = Session::get('register_session_array');
            $access_salt = 'Merchant_'.$this->generateRandomString(20);
            $insertarray['merchant_logo'] = 'default_logo.png';
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


            $insert_merchant = Merchant::create($insertarray);
            $merchant_id = $insert_merchant->id;

            $merchantuserinsertarray['merchant_id'] = $merchant_id;
            $merchantuserinsertarray['name'] = $input['name'];
            $merchantuserinsertarray['email'] = $input['email'];
            $merchantuserinsertarray['email_verified_at'] = date('Y-m-d H:i:s');
            $merchantuserinsertarray['password'] = Hash::make('password');
            $merchantuserinsertarray['created_at'] = date('Y-m-d H:i:s');

            $merchant_user = MerchantUser::create($merchantuserinsertarray);

            $merchant_keys = MerchantKey::create(
                array(
                    'merchant_id'=>$merchant_id,
                    'api_title'=>'Razorpay',
                    'test_api_key'=>'wavexpay_test_'.$this->generateRandomString(14),
                    'test_api_secret'=>$this->generateRandomString(20),
                    'created_at'=>date('Y-m-d H:i:s')
                )
            );

            DB::commit();
            $merchant_salt = $access_salt;             
            $client = new Client(['base_uri' => env('API_BASE_URL')]);
            $api_end_point = '/api/merchants/login';
            $response = $client->request('POST',$api_end_point,[
                'form_params' => [
                    'email' => $request->input('email'),
                    'password' => 'password',
                    'merchant_salt' => $merchant_salt,
                    'mode' => 'test'
                ]
            ]);


            $status_code = $response->getStatusCode();
            $header = $response->getHeader('content-type');
            $res  =  json_decode($response->getBody(),true);

      #  print_r($res);exit;

        if($status_code==200){
            if($res['status']=='success'){
                //dd($res);
                $access_token = $res['access_token'];
                session()->put('token', $access_token);
                session()->put('merchant', $res['merchant']['merchant_id']);
                session()->put('merchant_key', $res['api_key']);
                session()->put('merchant_secret', $res['api_secret']);


                    $get_merchant_details = Helper::get_merchant_details($res['merchant']['merchant_id']);
                    if($get_merchant_details->is_partner=='yes')
                    {
                        //DB::commit();
                        return redirect('/partner-dashboard');
                    }
                    //DB::commit();
                    return redirect('/');
                }else{
                    //DB::rollback();
                    return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
                }
                //DB::commit();
            }else{
                DB::rollback();
                return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
            }
        /*}catch(\Exception $ex){
            #DB::rollback();
            return redirect()->back()->withErrors(['error'=>$ex->getMessage()]);
        }*/
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

    public function checkEmailExistence(Request $request)
    {
        $email = $request->email;
        $get_merchant_by_email = MerchantUser::where('email',$email)->first();
        //print_r($get_merchant_by_email);exit;
        if(isset($get_merchant_by_email->email) && $get_merchant_by_email->email!='')
        {
            return response()->json(array('success'=>1));
        }
        else 
        {
            return response()->json(array('success'=>0));
        }
    }

    public function showRegistrationForm(){
        $action = '';
        $ref_no = '';
        return view('auth.register',compact('action','ref_no'));
    }
}
