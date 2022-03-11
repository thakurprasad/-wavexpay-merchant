<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Carbon\Carbon;
use Session;
use GuzzleHttp\Client;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLogin(){

        $data['title'] ="Login";
        return view('auth.login')->with($data);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        $remember_me = $request->has('remember') ? true : false;
        $merchant_salt = env('MERCHANT_SALT');
        try {
            $client = new Client(['base_uri' => env('API_BASE_URL')]);
            $api_end_point = 'api/merchants/login';
            $response = $client->request('POST',$api_end_point,[
                'form_params' => [
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'merchant_salt' => $merchant_salt
                        ]
            ]);
            $status_code = $response->getStatusCode();
            // 200
            $header = $response->getHeader('content-type');
            // 'application/json; charset=utf8'
            $res  =  json_decode($response->getBody(),true);

            if($status_code==200){
                if($res['status']=='success'){

                    $access_token = $res['access_token'];
                    session()->put('token', $access_token);
                    session()->put('merchant', $res['merchant']['merchant_id']);
                    return redirect('/');
                }else{
                    return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
                }
            }else{
                return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['credentials'=>'Invalid Email or Password']);
        }

    }
}
