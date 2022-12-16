<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;
use App\Models\PaymentLink;
use App\Models\Merchant;
use Illuminate\Support\Facades\Crypt;
use App\Models\GeneralSetting;
use Helper;
use Mail;

class PaymentLinkController extends Controller
{
   
    public function index(Request $request){

        $breadcrumbs = [
            ['link' => "payment-links", 'name' => "Payment Links"]
        ];
        $merchant_id =  session()->get('merchant');
        $all_links = PaymentLink::where('merchant_id',$merchant_id)->get();
        return view('pages.paymentlinks.index', compact('breadcrumbs','all_links'));
    }


    public function searchPaymentLink(Request $request){
        $payment_link_id = $request->payment_link_id;
        $batch_id = $request->batch_id;
        $reference_id = $request->reference_id;
        $customer_contact = $request->customer_contact;
        $customer_email = $request->customer_email;
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $daterangepicker = $request->daterangepicker;

        $merchant_id =  session()->get('merchant');
        $query = PaymentLink::where('merchant_id',$merchant_id);
        if($reference_id!=''){
            $query->where('reference_id',$reference_id);
        }if($customer_contact!=''){
            $query->where('customer_contact',$customer_contact);
        }if($customer_email!=''){
            $query->where('customer_email',$customer_email);
        }if($status!=''){
            $query->where('status',$status);
        }if($payment_link_id!=''){
            $query->where('payment_link_id',$payment_link_id);
        }if($daterangepicker!='' && $start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $result = $query->get();
        $all_links = $result;

        $html = '';
        if(!empty($all_links)){
            foreach($all_links as $link){
                $s_customer_contact = 'N/A';
                $s_customer_email = 'N/A';
                if(isset($link->customer_contact) && $link->customer_contact!=''){
                    $s_customer_contact = $link->customer_contact;
                }
                if(isset($link->customer_email) && $link->customer_email!=''){
                    $s_customer_email = $link->customer_email;
                }
                $html.='<tr>
                    <th><a style="cursor:pointer; color: blue;" onclick="show_notes(\''.$link->payment_link_id.'\')">'.$link->payment_link_id.'</a></th>
                    <td>'.date('Y-m-d H:i:s',strtotime($link->created_at)).'</td>
                    <td>'.number_format($link->amount,2).'</td>
                    <td>'.$link->reference_id.'</td>
                    <td>'.$s_customer_contact.'('.$s_customer_email.')'.'</td>
                    <td>';if($link->status!='paid') { $html.='<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="copy(\''.$link->link_text.'\')">Copy Link</a>'; } else { $html.=Helper::badge('N/A'); } $html.='</td>
                    <td>'.Helper::badge($link->status).'</td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }

    public function createPaymentLink(Request $request){


        $api = new Api(Helper::api_key(), Helper::api_secret());
        $accept_partial = false;
        $db_accept_partial = 0;
        $email = false;
        $sms = false;
        $reference_id = rand(10000,99999);
        $customer_contact = rand(1000000000,20000000000);
        $customer_email = 'testcustomer'.rand(1000,2000).'@wavexpay.com';

        /**
         * data for mail
         * 
         * */
     
  $merchant_data = Merchant::select('merchants.id', 'merchants.merchant_name', 'merchants.merchant_logo', 'merchant_users.name', 'merchant_users.display_name', 'merchant_users.email')
        ->join('merchant_users', 'merchant_users.merchant_id', '=', 'merchants.id')->first();
   
      

        $MAIL_DATA['merchant_display_name'] = $merchant_data->merchant_name;
        $MAIL_DATA['merchant_address']      = "Delhi 110041";
        $MAIL_DATA['logo']                  = $merchant_data->merchant_logo;


        /**
         * end param lists
         * */

        if(isset($request['partial_paymet']) && $request['partial_paymet']=='yes'){
            $accept_partial = true;
            $db_accept_partial = 1;
        }

        if(isset($request['notify_via_email']) && $request['notify_via_email']=='yes'){
            $email = true;
        }

        if(isset($request['notify_via_sms']) && $request['notify_via_sms']=='yes'){
            $sms = true;
        }

        if(isset($request['customer_contact']) && $request['customer_contact']!=''){
            $customer_contact = $request['customer_contact'];
        }

        if(isset($request['customer_email']) && $request['customer_email']!=''){
            $customer_email = $request['customer_email'];
        }

        $note_title = $request['note_title'];
        $note_desc = $request['note_desc'];

        $note_array = array();
        if(!empty($note_title)){
            for($i=0;$i<count($note_title);$i++){
                $note_array[$note_title[$i]] = $note_desc[$i];
            }
        }
        

        $callback_url = url('/payment/successful');
        $amount =  ((float)$request['amount'])*100;
        if($request['show_hide_status']=='hide'){
            try {
                $response = $api->paymentLink->create(
                array(
                    'amount'=> $amount, #(float)$request['amount'], 
                    'reference_id' => $request['reference_id'], 
                    'currency'=>'INR',
                    'accept_partial'=>$accept_partial, 
                    'description' => $request['payment_description'], 
                    'notify'=> array('sms'=>$sms, 'email'=>$email), 
                    'reminder_enable'=>true ,
                    'notes'=>$note_array,
                    'callback_url' => $callback_url, #'https://example-callback-url.com/',
                    'callback_method'=>'get')
                );
            } catch (\Exception $e) {
                return response()->json(array('success'=>0,'error'=>$e->getMessage()));
            }
        }else if($request['show_hide_status']=='show'){
            try {
                $response = $api->paymentLink->create(
                    array(
                        'amount'=> $amount, #(float)$request['amount'], 
                        'reference_id' => $request['reference_id'], 
                        'currency'=>'INR',
                        'accept_partial'=>$accept_partial, 
                        'description' => $request['payment_description'], 
                        'customer' => array(
                                    'name'=>$request['customer_name'],
                                    'email' => $request['customer_email'], 
                                    'contact'=>$request['customer_contact']
                                    ), 
                        'notify'=>array('sms'=>$sms, 'email'=>$email) , 
                        'reminder_enable'=>true ,
                        'notes'=>$note_array,
                        'callback_url' => $callback_url, #'https://example-callback-url.com/',
                        'callback_method'=>'get'
                        )
                    );
            } catch (\Exception $e) {
                return response()->json(array('success'=>0,'error'=>$e->getMessage()));
            }
        }


        $db_customer_email = '';
        if(isset($response->customer->email)){
            $db_customer_email = $response->customer->email;
        }
        $db_customer_contact = '';
        if(isset($response->customer->contact)){
            $db_customer_contact = $response->customer->contact;
        }

        $merchant_id = session()->get('merchant');
        $link_text = substr(Crypt::encryptString($merchant_id.'/'.date('Y-m-d H:i:s').rand(10000,99999)),5,10);

        DB::beginTransaction();
        try{
            $amount = (float)$response->amount/100;
            PaymentLink::create(
                array(
                        'amount'=> $amount,
                        'reference_id' => $response->reference_id, 
                        'currency'=>'INR',
                        'accept_partial'=>$db_accept_partial,
                        'description' => $response->description, 
                        'customer_email' => $db_customer_email, 
                        'customer_contact' => $db_customer_contact,
                        'notify_email'=> $response->notify->email,
                        'payment_link_id'=>$response->id, 
                        'link_text'=>$link_text, 
                        'short_url'=>$response->short_url, 
                        'notify_sms'=> $response->notify->sms, 
                        'reminder_enable'=>'true',
                        'callback_url' => $callback_url, #'https://example-callback-url.com/',
                        'callback_method'=>'get',
                        'merchant_id'=>session('merchant'),
                        'created_at'=>date('Y-m-d H:i:s')
                    )
                );

                if($email && Helper::mailFlag('create_payment_link')){    
                        $payment_link =  url('/i/pl/'.$link_text);
                        $MAIL_DATA['payment_link']     = $payment_link;
                        $MAIL_DATA['payment_id']       = $response->id;
                        $MAIL_DATA['issued_to_name']   = $request['customer_name'];
                        $MAIL_DATA['issued_to_mobile'] = $request['customer_contact'];
                        $MAIL_DATA['issued_to_email']  = $request['customer_email'];
                        $MAIL_DATA['amount_payable']   = number_format($amount);
                    Mail::send('emails.payment-link', $MAIL_DATA ,
                        function($message) use($request){   
                            $message->to( $request->input('customer_email') );
                            $message->subject('Thank you for Registering on WaveXpay as Merchant');
                        });
            
                }

            DB::commit();
            return response()->json(array("success" => 1));  
        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->withErrors(['error'=>$ex->getMessage()]);
        }
        
    }


    public function getPaymentLink(Request $request){
        
        $id = $request->link_id;
        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $link_details = $api->paymentLink->fetch($id);*/
        $link_details = PaymentLink::where('payment_link_id',$id)->first();
        $customer_email = 'N/A';
        $customer_contact = 'N/A';
        if(isset($link_details->customer_email) && $link_details->customer_email!='')
        {
            $customer_email = $link_details->customer_email;
        }
        if(isset($link_details->customer_contact) && $link_details->customer_contact!='')
        {
            $customer_contact = $link_details->customer_contact;
        }
        
        if($link_details->notify_email==1){
            $estatus = 'yes';
        }else{
            $estatus = 'no';
        }

        if($link_details->notify_sms==1){
            $sstatus = 'yes';
        }else{
            $sstatus = 'no';
        }

        if(isset($link_details->expire_by) && $link_details->expire_by==0){
            $is_expire = 'no';
        }else{
            $is_expire = 'yes';
        }

        if($link_details->accept_partial == 1){
            $part_pay = 'yes &nbsp;&nbsp;<a style="margin-left:20px;cursor:pointer;"  class="btn btn-sm btn-warning" onclick="part_pay(\''.$id.'\',1)">Disable</a>';
        }else{
            $part_pay = 'no &nbsp;&nbsp;<a style="margin-left:20px;cursor:pointer;"  class="btn btn-sm btn-success" onclick="part_pay(\''.$id.'\',0)">Enable</a>';
        }

        $notehtml = '';
        if(isset($link_details->notes) && !empty($link_details->notes)){
            foreach($link_details->notes as $key=>$val){
                $notehtml.='<div class="row"><div class="col-sm-3">'.$key.'</div><div class="col-sm-3">'.$val.'</div><div class="col-sm-6"></div></div>';
            }
        }

        /*<a style="margin-left:20px;" class="waves-effect waves-light" onclick="delete_note(\''.$key.'\',\''.$id.'\')">Delete</a>*/

       
        
        $html='<div class="row">
            <div class="col-sm-6">
            <div class="form-group">
                <label>Amount </label><br><input type="text" class="form-control" readonly value="'.$link_details->amount.'" />
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Payment For</label> <br><input type="text" class="form-control" readonly value="'.$link_details->description.'">
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Reference Id</label>  <br><input type="text" class="form-control" readonly value="'.$link_details->reference_id.'" id="c_r_c"><a class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal3" onclick="ch_r_id(\''.$id.'\')">Change Reference Id</a>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Customer Email</label>  <br><input type="text" readonly class="form-control" value="'.$customer_email.'" />
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <span id="customer_contact"></span>
                <label>Customer Contact</label>  <br><input type="text" readonly class="form-control" value="'.$customer_contact.'" />
            </div>
            </div>
            <div class="col-sm-3">
            <div class="form-group">
                <label>Notify Via Email   <br><strong>'.$estatus.'</strong></label>
            </div>
            </div>
            <div class="col-sm-3">
            <div class="form-group">
                <label>Notify Via SMS  <br><strong>'.$sstatus.'</strong></label>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Expiry?  <strong>'.$is_expire.'</strong><br>';
                if($is_expire=='yes'){
                    $html.='<strong>'.date('d/m/Y',strtotime($link_details->expire_by)).'</strong><a class="btn btn-sm btn-warning" style="margin-left:10px;" data-toggle="modal" data-target="#modal5" onclick="edit_expiry_date(\''.$id.'\')">Change</a>';
                }
                $html.='</label>
                <span id="isexpiry"></span>
            </div>
            </div>';
            $html.='<div class="col-sm-6">
            <div class="form-group">
                <label>Partial Payments?  <br><strong>'.$part_pay.'</strong></label>
                <span id="partial_paymet"></span>
            </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
                <label for="first_name" style="color:#000;"> <strong style="color:black;">NOTES</strong><For></For><a style="margin-left:20px;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal4" onclick="edit_notes(\''.$id.'\')"> + Add Notes</a></label><br>                     
                <span id="add_note_container">'.$notehtml.'</span>
            </div>
            </div>
        </div>';

        return response()->json(array("html" => $html));  
    }

    public function changeRefIdProcess(Request $request){
        $plid = $request['plid'];
        $update_reference_id = $request['update_reference_id'];
        if(PaymentLink::where('payment_link_id',$plid)->update(array('reference_id'=>$request['update_reference_id']))){
            return response()->json(array("success" => 1, "update_reference_id"=> $update_reference_id));  
        }else{
            return response()->json(array("success" => 0, "msg"=> "OOps!Something Error Happened!!"));  
        }
    }

    public function changeNoteProcess(Request $request){
        $id = $request->editplid;
        $edit_note_title = $request->edit_note_title;
        $edit_note_desc = $request->edit_note_desc;

        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api = new Api(Helper::api_key(), Helper::api_secret());
        $link_details = $api->paymentLink->fetch($id);

        $note_array = array();
        if(!empty($edit_note_title)){
            for($i=0;$i<count($edit_note_title);$i++){
                $note_array[$edit_note_title[$i]] = $edit_note_desc[$i];
            }
        }

        if(!empty($link_details->notes)){
            $new_note_aray = array_merge($link_details->notes->toArray(),$note_array);
        }else{
            $new_note_aray = array_merge(array(),$note_array);
        }
        

        if($api->paymentLink->fetch($id)->edit(array('notes'=>$new_note_aray))){
            $api = new Api(Helper::api_key(), Helper::api_secret());
            $new_link_details = $api->paymentLink->fetch($id);
            $notehtml = '';
            if(!empty($new_link_details->notes)){
                foreach($new_link_details->notes as $key=>$val){
                    $notehtml.='<label for="first_name" style="color:blue;">'.$key.'   :   <strong>'.$val.'</strong><For></For></label><br>';
                }
            }
            return response()->json(array("success" => 1, "notehtml"=> $notehtml));  
        }else{
            return response()->json(array("success" => 0, "msg"=> "OOps!Something Error Happened!!"));  
        }

        
    }

    public function changePayStatus(Request $request){
        $lid = $request['lid'];
        $status = $request['status'];
        if($status==1){
            $update_status = 0;
        }else{
            $update_status = 1;
        }
        if(PaymentLink::where('payment_link_id',$lid)->update(array("accept_partial"=>$update_status))){
            return response()->json(array("success" => 1));  
        }else{
            return response()->json(array("success" => 0));  
        }
    }

    public function changeExpDate(Request $request){
        $paylinkid = $request['paylinkid'];
        $expiry_dt = $request['expiry_dt'];
        if(PaymentLink::where('payment_link_id',$paylinkid)->update(array("expire_by"=>$expiry_dt))){
            return response()->json(array("success" => 1));  
        }else{
            return response()->json(array("success" => 0));  
        }
    }


    public function deleteNote(Request $request){
        $key1 = str_replace('+', ' ', $request['key']);
        $linkid = $request['linkid'];
        #$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api = new Api(Helper::api_key(), Helper::api_secret());
        $link_details = $api->paymentLink->fetch($linkid);
        $note_array = $link_details->notes->toArray();
        foreach($link_details->notes as $key=>$val){
            if($key==$key1){
                unset($note_array[$key]);
            }
        }
        return response()->json(array("success" => 1));  
    }

    public function openPaymentLink(){
        return view('pages.paymentlinks.standardPaymentlink');
    }

    public function openStandardPaymentLink(){
        return view('pages.paymentlinks.standardPaymentlink');
    }


    public function openPaymentLinkPage(Request $request)
    {  
        $general_settings = GeneralSetting::first();

        $link_text = request()->segment(count(request()->segments()));
        $get_payment_link_details_by_text = DB::table('payment_link')->where('link_text',$link_text)->first();

        $merchant_id =  session()->get('merchant');
        $merchant_users_details = DB::table('merchant_users')->where('merchant_id',$merchant_id)->first();
        $display_name = $merchant_users_details->display_name;


        return view('pages.paymentlinks.checkout',compact('get_payment_link_details_by_text','display_name','link_text', 'general_settings'));
        //return view('pages.paymentlinks.checkoutall',compact('get_payment_link_details_by_text','display_name'));
    }

    public function paylinkCheckout(Request $request)
    {
        $phone = $request->phone;
        $email = $request->email;

        $link_text = $request->link_text;
        $get_payment_link_details_by_text = DB::table('payment_link')->where('link_text',$link_text)->first();

        $merchant_id =  session()->get('merchant');
        $merchant_users_details = DB::table('merchant_users')->where('merchant_id',$merchant_id)->first();
        $display_name = $merchant_users_details->display_name;
        $general_settings = GeneralSetting::first();
        return view('pages.paymentlinks.checkoutall',compact('phone','email','display_name','get_payment_link_details_by_text', 'general_settings'));
    }
}
