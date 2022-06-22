<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;

class PaymentLinkController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "payment-links", 'name' => "Payment Links"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        //$all_links = $api->paymentLink->all();
        //@if(!empty($all_links->payment_links))
        //@foreach($all_links->payment_links as $link)
        $all_links = DB::table('payment_link')->get();

        return view('pages.paymentlinks.index', compact('pageConfigs','breadcrumbs','all_links'));
    }


    public function searchPaymentLink(Request $request){
       $payment_link_id = $request->payment_link_id;
       $batch_id = $request->batch_id;
       $reference_id = $request->reference_id;
       $customer_contact = $request->customer_contact;
       $customer_email = $request->customer_email;
       $notes = $request->notes;

       //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
       //$all_links = $api->paymentLink->all();
        $query = DB::table('payment_link');
        if($reference_id!=''){
            $query->where('reference_id',$reference_id);
        }if($customer_contact!=''){
            $query->where('customer_contact',$customer_contact);
        }if($customer_email!=''){
            $query->where('customer_email',$customer_email);
        }if($payment_link_id!=''){
            $query->where('payment_link_id',$payment_link_id);
        }
        $result = $query->get();
        //print_r($result);exit;
        $all_links = $result;

        $html = '';
        /*if(!empty($all_links->payment_links)){
            foreach($all_links->payment_links as $link){*/
        if(!empty($all_links)){
            foreach($all_links as $link){
                $s_customer_contact = '';
                $s_customer_email = '';
                if(isset($link->customer_contact) && $link->customer_contact!=''){
                    $s_customer_contact = $link->customer_contact;
                }
                if(isset($link->customer_email) && $link->customer_email!=''){
                    $s_customer_email = $link->customer_email;
                }
                $html.='<tr>
                    <th>'.$link->id.'</th>
                    <td>'.date('Y-m-d H:i:s',$link->created_at).'</td>
                    <td>'.number_format($link->amount,2).'</td>
                    <td>'.$link->reference_id.'</td>
                    <td>'.$s_customer_contact.'('.$s_customer_email.')'.'</td>
                    <td>'.$link->short_url.'</td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }

    public function createPaymentLink(Request $request){
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        if($request['partial_paymet']=='yes'){
            $accept_partial = true;
        }else{
            $accept_partial = false;
        }

        if($request['notify_via_email']=='yes'){
            $email = true;
        }
        else{
            $email = false;
        }
        if($request['notify_via_sms']=='yes'){
            $sms = true;
        }else{
            $sms = false;
        }

        $note_title = $request['note_title'];
        $note_desc = $request['note_desc'];

        $note_array = array();
        if(!empty($note_title)){
            for($i=0;$i<count($note_title);$i++){
                $note_array[$note_title[$i]] = $note_desc[$i];
            }
        }
        
        //echo $request['amount'];exit;

        

        $response = $api->paymentLink->create(array('amount'=>(float)$request['amount'], 'reference_id' => $request['reference_id'], 'currency'=>'INR','accept_partial'=>$accept_partial, 'description' => $request['payment_description'], 'customer' => array('email' => $request['customer_email'], 'contact'=> $request['customer_contact']), 'notify'=>array('sms'=>$sms, 'email'=>$email) , 'reminder_enable'=>true ,'notes'=>$note_array,'callback_url' => 'https://example-callback-url.com/','callback_method'=>'get'));

        //print_r($response);exit;

        DB::table('payment_link')->insert(array('amount'=>(float)$response->amount,'reference_id' => $response->reference_id, 'currency'=>'INR','accept_partial'=>'true','description' => $response->description, 'customer_email' => $response->customer->email, 'customer_contact' => $response->customer->contact, 'notify_email'=> $response->notify->email,'payment_link_id'=>$response->id, 'short_url'=>$response->short_url, 'notify_sms'=> $response->notify->sms, 'reminder_enable'=>'true','callback_url' => 'https://example-callback-url.com/','callback_method'=>'get','merchant_id'=>session('merchant'),'created_at'=>date('Y-m-d H:i:s')));

        return response()->json(array("success" => 1));  
        
    }


    public function getPaymentLink(Request $request){
        
        $id = $request->link_id;
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $link_details = $api->paymentLink->fetch($id);
        
        if($link_details->notify->email==1){
            $estatus = 'yes';
        }else{
            $estatus = 'no';
        }

        if($link_details->notify->sms==1){
            $sstatus = 'yes';
        }else{
            $sstatus = 'no';
        }

        if($link_details->expire_by==0){
            $is_expire = 'no';
        }else{
            $is_expire = 'yes';
        }

        if($link_details->accept_partial == '1'){
            $part_pay = 'yes &nbsp;&nbsp;<a style="margin-left:20px;cursor:pointer;"  class="btn btn-sm btn-warning" onclick="part_pay(\''.$id.'\',1)">Disable</a>';
        }else{
            $part_pay = 'no &nbsp;&nbsp;<a style="margin-left:20px;cursor:pointer;"  class="btn btn-sm btn-success" onclick="part_pay(\''.$id.'\',0)">Enable</a>';
        }

        $notehtml = '';
        if(!empty($link_details->notes)){
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
                <label>Reference Id</label>  <br><input type="text" class="form-control" value="'.$link_details->reference_id.'" id="c_r_c"><a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal3" onclick="ch_r_id(\''.$id.'\')">Change Reference Id</a>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Customer Email</label>  <br><input type="text" readonly class="form-control" value="'.$link_details->customer->email.'" />
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <span id="customer_contact"></span>
                <label>Customer Contact</label>  <br><input type="text" readonly class="form-control" value="'.$link_details->customer->contact.'" />
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
                    $html.='<strong>'.date('d/m/Y',$link_details->expire_by).'</strong><a class="btn btn-sm btn-warning" style="margin-left:10px;" data-toggle="modal" data-target="#modal5" onclick="edit_expiry_date(\''.$id.'\')">Change</a>';
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

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        if($api->paymentLink->fetch($plid)->edit(array("reference_id"=>$update_reference_id))){
            return response()->json(array("success" => 1, "update_reference_id"=> $update_reference_id));  
        }else{
            return response()->json(array("success" => 0, "msg"=> "OOps!Something Error Happened!!"));  
        }
    }

    public function changeNoteProcess(Request $request){
        $id = $request->editplid;
        $edit_note_title = $request->edit_note_title;
        $edit_note_desc = $request->edit_note_desc;

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
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
            $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
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
            $update_status = false;
        }else{
            $update_status = true;
        }
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        if($api->paymentLink->fetch($lid)->edit(array("accept_partial"=>$update_status))){
            return response()->json(array("success" => 1));  
        }else{
            return response()->json(array("success" => 0));  
        }
    }

    public function changeExpDate(Request $request){
        $paylinkid = $request['paylinkid'];
        $expiry_dt = $request['expiry_dt'];
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        if($api->paymentLink->fetch($paylinkid)->edit(array("expire_by"=>strtotime($expiry_dt)))){
            return response()->json(array("success" => 1));  
        }else{
            return response()->json(array("success" => 0));  
        }
    }


    public function deleteNote(Request $request){
        $key1 = str_replace('+', ' ', $request['key']);
        $linkid = $request['linkid'];
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $link_details = $api->paymentLink->fetch($linkid);
        $note_array = $link_details->notes->toArray();
        foreach($link_details->notes as $key=>$val){
            if($key==$key1){
                unset($note_array[$key]);
            }
        }
        return response()->json(array("success" => 1));  
    }
}
