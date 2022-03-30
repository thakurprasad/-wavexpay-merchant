<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class SettingsController extends Controller
{
    public $token,$merchant;
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->token = session('token');
            $this->merchant = session('merchant');
            return $next($request);
        });
    }
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "settings", 'name' => "Settings"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        
        $client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = 'api/merchants/apikey';
        $token = Session::get('token');
        $merchant_salt = env('MERCHANT_SALT');
        $response = $client->request('GET',$api_end_point,[
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.session('token'),
                'merchant_salt' => $merchant_salt
            ]    
        ]);
        $res  =  json_decode($response->getBody(),true);
        return view('pages.settings.index', compact('breadcrumbs','pageConfigs', 'res'));
    }
}
