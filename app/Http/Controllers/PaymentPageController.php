<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class PaymentPageController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "payment-pages", 'name' => "Payment Pages"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = 'api/merchants/payment-pages';
        $token = Session::get('token');
        $merchant_salt = env('MERCHANT_SALT');
        $response = $client->request('GET',$api_end_point,[
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.session('token'),
                'merchant_salt' => $merchant_salt
            ],
            'sort' => 'ASC',
            'orderby' => 'page_title',
            'offset' => 15,
            'status' => 'Active'
        ]);
        $res  =  json_decode($response->getBody(),true);
        $res  =  $res['data']['data'];


        return view('pages.paymentpages.index', compact('breadcrumbs','pageConfigs', 'res'));
    }


    public function getPaymentTemplates(Request $request){
        $client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = 'api/merchants/payment-templates';
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
        $res  =  $res['data'];
        
        $html = '';
        if(!empty($res)){
            foreach($res as $data){
                $html.='<div class="card"><a href="payment-template/'.$data['id'].'"><div class="card-content"><p>'.$data['title'].'</p><p>'.$data['subtitle'].'</p></div></a></div>';
            }
        }
        return response()->json(array('html'=>$html));
    }

    public function showPaymentTemplates($template_id){
        $breadcrumbs = [
            ['link' => "payment-template/".$template_id, 'name' => "Payment Template"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];


        $client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = 'api/merchants/payment-templates/'.$template_id;
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
        return view('pages.paymentpages.payment_template', compact('breadcrumbs','pageConfigs', 'res', 'template_id'));
    }

    public function savePaymentPage(Request $request){
        $label = $request->label;
        $labeltype = $request->labeltype;
        $form_json = array_map (null,$label,$labeltype);
        $form_json = json_encode($form_json);

        if($request->is_expiry=='yes'){
            $is_expiry = 1;
        }else{
            $is_expiry = 0;
        }


        $save_array = array(
            "template_id" => $request->template_id,
            "merchant_id" => 1,
            "page_title" => $request["page_title"],
            "page_content" => $request["page_description"],
            "status" => "Active",
            "fb_link" =>  $request["fb_link"],
            "twitter_link" =>  $request["twitter_link"],
            "whatsapp" => $request["whatsapp"],
            "support_email" => $request["support_email"],
            "support_phone" => $request["support_contact"],
            "term_conditions" => $request["terms_and_condition"],
            "payment_form_json" => $form_json,
            "custom_url" => $request["custom_url"],
            "theme" => $request["theme"],
            "is_page_expiry" => $is_expiry,
            "successful_custom_message" => $request["custom_msg_area"],
            "successful_redirect_url" => $request["redirect_to_website"],
            "facebook_pixel" => $request["facebook_pixel"],
            "google_analytics" => $request["google_analytics"]
        );

        $client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = 'api/merchants/payment-pages';
        $merchant_salt = env('MERCHANT_SALT');
        $response = $client->request('POST',$api_end_point,[
                        'form_params' =>  $save_array ,
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer '.session('token'),
                            'merchant_salt' => $merchant_salt
                        ]
                    ]);
        $status_code = $response->getStatusCode();
        return response()->json(array('success'=>1));
    }
}
