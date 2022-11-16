<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use DB;
use App\Models\Merchant;
use App\Models\MerchantUser;
use App\Models\PaymentPage;

class PaymentPageController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "payment-pages", 'name' => "Payment Pages"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        /*$client = new Client(['base_uri' => env('API_BASE_URL')]);
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
        $res  =  $res['data']['data'];*/
        $merchant_id =  session()->get('merchant');
        $res  =  PaymentPage::where('merchant_id',$merchant_id)->get();
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
                //$html.='<div class="card"><div class="card-body"><a href="payment-template/'.$data['id'].'"><div class="card-content"><p>'.$data['title'].'</p><p>'.$data['subtitle'].'</p></div></a></div></div>';

                $html.='<div class="col-md-2 payment-link-para">
                    <img src="'.url('/').'/payment_link_section/img/congrts.jpg" class="img-responsive">
                    <h5>'.$data['title'].'</h5>
                    <p>'.$data['subtitle'].'</p>
                    <div class="payment-link-btn">
                        <hr class="border-top">
                        <a class="btn-linkk" href="payment-page/'.$data['id'].'">Create now</a>
                    </div>
                </div>';
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
        $labelTypevalue = $request->labelTypevalue;
        $form_json = array_map (null,$label,$labeltype,$labelTypevalue);
        $form_json = json_encode($form_json);

        //print_r($form_json);exit;

        if($request->is_expiry=='yes'){
            $is_expiry = 1;
        }else{
            $is_expiry = 0;
        }

        $unique_id = rand(10000,99999);
        $page_url = Crypt::encryptString($unique_id);


        $save_array = array(
            "template_id" => $request->template_id,
            "merchant_id" => 1,
            "page_title" => $request["page_title"],
            "page_content" => $request["page_description"],
            "customer_name" => $request["customer_name"],
            "customer_number" => $request["customer_number"],
            "status" => "Active",
            "fb_link" =>  $request["fb_link"],
            "twitter_link" =>  $request["twitter_link"],
            "whatsapp" => $request["whatsapp"],
            "support_email" => $request["support_email"],
            "support_phone" => $request["support_contact"],
            "term_conditions" => $request["terms_and_condition"],
            "amount" => $request["amount"],
            "payment_form_json" => $form_json,
            "custom_url" => $request["custom_url"],
            "theme" => $request["theme"],
            "is_page_expiry" => $is_expiry,
            "successful_custom_message" => $request["custom_msg_area"],
            "successful_redirect_url" => $request["redirect_to_website"],
            "facebook_pixel" => $request["facebook_pixel"],
            "google_analytics" => $request["google_analytics"],
            "created_at" => date('Y-m-d H:i:s')
        );

        /*$client = new Client(['base_uri' => env('API_BASE_URL')]);
        $api_end_point = 'api/merchants/payment-pages';
        $merchant_salt = env('MERCHANT_SALT');
        $response = $client->request('POST',
        $api_end_point,[
            'form_params' =>  $save_array ,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.session('token'),
                'merchant_salt' => $merchant_salt
            ]
        ]);*/

        //$save_array['payment_page_id'] = $response->id;
        $save_array['merchant_id'] = session('merchant');
        $save_array['page_url'] = $page_url;
        $save_array['unique_id'] = $unique_id;
        DB::beginTransaction();
        try{
            PaymentPage::create($save_array);
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->withErrors(['error'=>$ex->getMessage()]);
        }
        //$status_code = $response->getStatusCode();
        return response()->json(array('success'=>1));
    }

    public function getPaymentPageDetails(Request $request){
        $id = $request->id;
        $get_payment_page_details = PaymentPage::where('id',$id)->first();
        return response()->json(array('page_title'=>$get_payment_page_details->page_title,'status'=>$get_payment_page_details->status,'custom_url'=>$get_payment_page_details->custom_url,'created_at'=>$get_payment_page_details->created_at,''));
    }

    public function paymentPageFront(Request $request)
    {
        $unique_id = request()->segment(count(request()->segments()));
        $decrypted = Crypt::decryptString($unique_id);
        $merchant_id =  session()->get('merchant');
        $get_payment_page_details = PaymentPage::where('unique_id',$decrypted)->first();
        $merchant_users_details = MerchantUser::where('merchant_id',$merchant_id)->first();
        $display_name = $merchant_users_details->display_name;
        return view('pages.paymentpages.payment_front_view', compact('get_payment_page_details','display_name'));

    }


    public function openPaymentTemplateType()
    {
        return view('pages.paymentpages.paymenttemplates');
    }

    public function showPaymentPageTemplates()
    {
        $merchant_id =  session()->get('merchant');
        $merchant_details = Merchant::where('id',$merchant_id)->first();
        $merchant_users_details = MerchantUser::where('merchant_id',$merchant_id)->first();
        $display_name = $merchant_users_details->display_name;
        return view('pages.paymentpages.paymentpagetemplate',compact('display_name'));
    }


    public function searchPaymentPage(Request $request)
    {
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $daterangepicker = $request->daterangepicker;

        $html = '';
        $merchant_id =  session()->get('merchant');
        $query = PaymentPage::where('merchant_id',$merchant_id);
        if($status!=''){
            $query->where('status',$status);
        }if($daterangepicker!='' && $start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $result = $query->get();

        if(!empty($result)){
            foreach($result as $page){
                $html.='<tr>
                    <td><a style="cursor:pointer;" data-toggle="modal" data-target="#modal1" onclick="show_payment_page(\''.$page->id.'\')">'.$page->page_title.'</a></th>
                    <td>'.$page->amount.'</td>
                    <td>0</td>
                    <td>'.$page->page_content.'</td>
                    <td>0</td>
                    <td>'.$page->custom_url.'</td>
                    <td>'.date('Y-m-d',strtotime($page->created_at)).'</td>
                    <td><button class="btn btn-sm btn-info" onclick="copy(\''.$page->page_url.'\')">Copy Url</button></td>
                    <td>';
                        if($page->status=='Inactive')
                        {
                        $html.='<span class="badge badge-danger">'.$page->status.'</span>';
                        }
                        else
                        {
                        $html.='<span class="badge badge-success">'.$page->status.'</span>';
                        }
                    $html.='</td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }
}
