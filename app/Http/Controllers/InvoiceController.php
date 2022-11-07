<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;
use App\Helpers\Helper;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\MerchantAddress;

class InvoiceController extends Controller
{
     
    public function index(Request $request){
      
        $breadcrumbs = [
            ['link' => "invoices", 'name' => "Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        
        $merchant_id =  session()->get('merchant');
        $all_invoices = Invoice::where('merchant_id',$merchant_id)->get();
        $all_customers = Customer::where('merchant_id',$merchant_id)->get();
        $all_items = Item::all();

        //print_r(array(array('item_id'=>'item_DRt61i2NnL8oy6')));exit;
        
        return view('pages.invoice.index', compact('breadcrumbs','pageConfigs', 'all_invoices','all_customers','all_items'));
    }

    public function searchInvoice(Request $request){
        $invoice_id = $request->invoice_id;
        $receipt = $request->reciept_number;
        $customer_contact = $request->customer_contact;
        $customer_email = $request->customer_email;
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = DB::table('invoices');
        if($invoice_id!=''){
            $query->where('invoice_id',$invoice_id);
        }if($receipt!=''){
            $query->where('receipt',$receipt);
        }if($customer_email!=''){
            $query->where('customer_email',$customer_email);
        }if($customer_email!=''){
            $query->where('customer_email',$customer_email);
        }if($status!=''){
            $query->where('status',$status);
        }if($start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $result = $query->get();
        //print_r($result);exit;
        $all_invoices = $result;


        $html = '';
        if(!empty($all_invoices)){
            foreach($all_invoices as $invoice){
                $customer_details = Helper::get_customer_details($invoice->customer_id);  
                $items = explode(',',$invoice->item_id);
                $amount = 0;
                foreach($items as $iid){
                    $item_details = Helper::get_item_details($iid);
                    $amount+=$item_details->amount;
                } 
                $html.='<tr>
                    <th scope="row"><a style="color: blue;" href="'.url('/invoice',$invoice->invoice_id).'">'.$invoice->invoice_id.'</a> </th>
                    <td>'.number_format($amount,2).'</td>
                    <td>'.$invoice->reciept.'</td>
                    <td>'.$invoice->created_at.'</td>
                    <td>'.$customer_details->name.' ('.$customer_details->contact.'/ '.$customer_details->email.')</td>
                    <td>'.$invoice->short_url.'</td>
                    <td>';
                        if($invoice->status=='cancelled'){
                            $html.='<span class="new badge red">'.Helper::badge($invoice->status).'</span>';
                        }
                        else{
                            $html.='<span class="new badge blue">'.Helper::badge($invoice->status).'</span>';
                        }
                        $html.='</td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }

    public function newInvoice(Request $request){
        $breadcrumbs = [
            ['link' => "newinvoice", 'name' => "New Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $merchant_id =  session()->get('merchant');
        $all_customers = Customer::where('merchant_id',$merchant_id)->get();
        $all_items = Item::all();
        
        return view('pages.invoice.newinvoice', compact('breadcrumbs','pageConfigs','all_customers','all_items'));
    }


    public function createItem(Request $request){
       # $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api = new Api(Helper::api_key(), Helper::api_secret());

        $response = $api->Item->create(array("name" => $request->modal_item_name,"description" => $request->modal_item_description,"amount" => $request->modal_item_rate,"currency" => "INR"));

        Item::create(array("item_id"=>$response->id,"name" => $request->modal_item_name,"description" => $request->modal_item_description,"amount" => $request->modal_item_rate,"currency" => "INR","created_at"=>NOW()));

        return response()->json(array('success'=>1,'msg'=>'Item Created SUccessfully!!'));
    }

    public function getItem(Request $request){
        $item_id = $request->item_id;
        //$api_key = session('merchant_key');
        //$api_secret = session('merchant_secret');
        //$api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        //$item_details = $api->Item->fetch($item_id);
        $item_details = Item::where('item_id',$item_id)->first();
        return response()->json(array("amount" => $item_details->amount));
    }

    public function addNewItemRow(Request $request){
        $count = $request->count;
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api(Helper::api_key(), Helper::api_secret());
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_items = Item::all();

        $html='<tr id="item_row_id'.$count.'">
            <td>
                <span id="itd'.$count.'">
                <select name="tableitem" id="tableitem'.$count.'" onchange="select_item(\''.$count.'\')">
                    <option value="" disabled selected>Select An Item</option>';
                    if(!empty($all_items)){
                        foreach($all_items as $titem){
                            $html.='<option value="'.$titem->item_id.'"><strong>'.$titem->name.'</option>';
                        }
                    }
                    $html.='</select>
                </span>
                <a class="modal-trigger" href="#createitemmodal" onclick="item_row(\''.$count.'\')">+ Create New Item</a>
            </td>
            <td>
                <input type="text" name="item_rate[]" id="item_rate'.$count.'" class="validate sum" required>
            </td>
            <td>
                <input type="number" min="1" name="item_qty[]" id="item_qty'.$count.'" class="validate" onclick="change_sub_amount(\''.$count.'\')" required>
            </td>
            <td>
                <input type="text" name="item_total[]" id="item_total'.$count.'" class="validate" required>
            </td>
        </tr>';
        return response()->json(array("html" => $html));      

    }

    public function createInvoice(Request $request){
       // return $request->input();
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api(Helper::api_key(), Helper::api_secret());
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $itemidArray['item_id'] = array();
        foreach($request['tableitem'] as $items){
            $itemidArray['item_id'] = $items;
        }

        $item_id = '';
        $item_qty = '';

        
        foreach($request['tableitem'] as $items){
            $item_id.=$items.',';
        }
        $item_id = rtrim($item_id,',');


        foreach($request['item_qty'] as $itemsqty){
            $item_qty.=$itemsqty.',';
        }
        $item_qty = rtrim($item_qty,',');


        $item_array = array();
        $item_array_count = 0;
        for($i=0;$i<count($request['tableitem']);$i++)
        {
            $get_item_details = DB::table('items')->where('item_id',$request['tableitem'][$i])->first();
            $item_array[$item_array_count]['name'] = $get_item_details->name;
            $item_array[$item_array_count]['description'] = $get_item_details->description;
            $item_array[$item_array_count]['amount'] = $request['item_rate'][$i];
            $item_array[$item_array_count]['currency'] = "INR";
            $item_array[$item_array_count]['quantity'] = $request['item_qty'][$i];
            $item_array_count++;
        }

        /*$item_array = json_encode($item_array,true);
        print_r($item_array);exit;*/


        $customer_array = array(
            'name' => "Gaurav Kumar",
            'contact' => 9999999999,
            'email' => "gaurav.kumar@example.com",
            'billing_address'=> array(
                "line1" => $request->billing_address1,
                "line2" => $request->billing_address2,
                "zipcode" => $request->billing_zip,
                "city" => $request->billing_city,
                "state" => $request->billing_state,
                "country" => $request->billing_country
            ),
            'shipping_address'=> array(
                "line1" => $request->shipping_address1,
                "line2" => $request->shipping_address2,
                "zipcode" => $request->shipping_zip,
                "city" => $request->shipping_city,
                "state" => $request->shipping_state,
                "country" => $request->shipping_country
            )
        );

        $billing_address_array = array(
            "merchant_id" => session('merchant'),
            "address_type" => "billing_address",
            "line_1" => $request->billing_address1,
            "line_2" => $request->billing_address2,
            "zip" => $request->billing_zip,
            "city" => $request->billing_city,
            "state" => $request->billing_state,
            "country" => $request->billing_country,
            "created_by" => session('merchant')
        );

        $shipping_address_array = array(
            'customer_id' => $request['customer'],
            "address_type" => "shipping_address",
            "line_1" => $request->shipping_address1,
            "line_2" => $request->shipping_address2,
            "zip" => $request->shipping_zip,
            "city" => $request->shipping_city,
            "state" => $request->shipping_state,
            "country" => $request->shipping_country,
            "created_by" => session('merchant')
        );

        $customer_name = '';
        $customer_email = '';
        $customer_contact = '';

        $get_customer_details = DB::table('customers')->where('customer_id',$request['customer'])->first();
        if(!empty($get_customer_details)){
            $customer_name = $get_customer_details->name;
            $customer_email = $get_customer_details->email;
            $customer_contact = $get_customer_details->contact;
        }

        /*echo $request['customer'];
        print_r($get_customer_details);exit;*/


        $invoice_create_array = array (
            'type' => 'invoice',
            'description' => $request['description'], 
            'date' => strtotime(date('Y-m-d H:i:s')), 
            'customer_id'=> $request['customer'],  
            'line_items'=>(object)$item_array,
        );

        //print_r($invoice_create_array);exit;

        $response = $api->invoice->create($invoice_create_array);

        if(isset($response->reciept) && $response->reciept!=''){
            $reciept = $response->reciept;
        }else{
            $reciept = '';
        }

        Invoice::create(array('invoice_id'=>$response->id,'reciept'=>$reciept,'short_url'=>$response->short_url,'type' => 'invoice','description' => $request['description'],'date' => date('Y-m-d H:i:s'),'customer_id'=> $request['customer'],'customer_name'=>$customer_name,'customer_email'=>$customer_email,'customer_contact'=>$customer_contact,'item_id'=>$item_id, 'item_qty' => $item_qty, 'customer_billing_address1'=>$request->billing_address1,'customer_billing_address2'=>$request->billing_address2,'customer_billing_zip'=>$request->billing_zip,'customer_billing_city'=>$request->billing_city,'customer_billing_state'=>$request->billing_state,'customer_billing_country'=>$request->billing_country,'customer_shipping_address1'=>$request->shipping_address1,'customer_shipping_address2'=>$request->shipping_address2,'customer_shipping_zip'=>$request->shipping_zip,'customer_shipping_city'=>$request->shipping_city,'customer_shipping_state'=>$request->shipping_state,'customer_shipping_country'=>$request->shipping_country,'merchant_id'=>session('merchant'),'status'=>$response->status,'created_at'=>date('Y-m-d H:i:s'),'issue_date'=>$request['isssue_date'],'expiry_date'=>$request['expiry_date'],'place_of_supply'=>$request['place_of_supply'],'customer_notes'=>$request->customer_notes,'description'=>$request->description));

        return response()->json(array("success" => 1));    

    }

    public function showInvoice($invoiceId){
        $breadcrumbs = [
            ['link' => "invoice/".$invoiceId, 'name' => "Invoice Details"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api(Helper::api_key(), Helper::api_secret());
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        //$invoice_details = $api->invoice->fetch($invoiceId);

        //$all_customers = $api->customer->all();
        //$all_items = $api->Item->all();
        //print_r($invoice_details);exit;

        $invoice_details = Invoice::where('invoice_id',$invoiceId)->first();
        $all_customers = Customer::all();
        $all_items = Item::all();

        return view('pages.invoice.invoicedetails', compact('breadcrumbs','pageConfigs','invoice_details','all_customers','all_items'));
    }

    public function editInvoice(Request $request){
        $invoiceId = $request->edit_id;

        $invoice_no = $request->invoice_no;

        $itemidArray['item_id'] = array();
        foreach($request['tableitem'] as $items){
            $itemidArray['item_id'] = $items;
        }

        $customer_array = array(
            'billing_address'=> array(
                "line1" => $request->billing_address1,
                "line2" => $request->billing_address2,
                "zipcode" => $request->billing_zip,
                "city" => $request->billing_city,
                "state" => $request->billing_state,
                "country" => $request->billing_country
            ),
            'shipping_address'=> array(
                "line1" => $request->shipping_address1,
                "line2" => $request->shipping_address2,
                "zipcode" => $request->shipping_zip,
                "city" => $request->shipping_city,
                "state" => $request->shipping_state,
                "country" => $request->shipping_country
            )
        );

        $customer_name = '';
        $customer_email = '';
        $customer_contact = '';

        $get_customer_details = DB::table('customers')->where('customer_id',$request['customer'])->first();
        if(!empty($get_customer_details)){
            $customer_name = $get_customer_details->name;
            $customer_email = $get_customer_details->email;
            $customer_contact = $get_customer_details->contact;
        }


        $item_id = '';
        $item_qty = '';
        foreach($request['tableitem'] as $items){
            $item_id.=$items.',';
        }
        $item_id = rtrim($item_id,',');


        foreach($request['item_qty'] as $itemsqty){
            $item_qty.=$itemsqty.',';
        }
        $item_qty = rtrim($item_qty,',');



        $item_array = array();
        $item_array_count = 0;
        for($i=0;$i<count($request['tableitem']);$i++)
        {
            $get_item_details = DB::table('items')->where('item_id',$request['tableitem'][$i])->first();
            $item_array[$item_array_count]['name'] = $get_item_details->name;
            $item_array[$item_array_count]['description'] = $get_item_details->description;
            $item_array[$item_array_count]['amount'] = $request['item_rate'][$i];
            $item_array[$item_array_count]['currency'] = "INR";
            $item_array[$item_array_count]['quantity'] = $request['item_qty'][$i];
            $item_array_count++;
        }


        $invoice_update_array = array (
            'type' => 'invoice',
            'description' => $request['description'], 
            'date' => strtotime(date('Y-m-d H:i:s')), 
            'customer_id'=> $request['customer'],  
            'line_items'=>array($itemidArray),
            'customer'=> $customer_array
        );

        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api->invoice->fetch($invoice_no)->edit($invoice_update_array);*/


        Invoice::where('id',$invoiceId)->update(array('type' => 'invoice','description' => $request['description'],'date' => date('Y-m-d H:i:s'),'customer_id'=> $request['customer'],'customer_name'=>$customer_name,'customer_email'=>$customer_email,'customer_contact'=>$customer_contact,'item_id'=>$item_id, 'item_qty' => $item_qty, 'customer_billing_address1'=>$request->billing_address1,'customer_billing_address2'=>$request->billing_address2,'customer_billing_zip'=>$request->billing_zip,'customer_billing_city'=>$request->billing_city,'customer_billing_state'=>$request->billing_state,'customer_billing_country'=>$request->billing_country,'customer_shipping_address1'=>$request->shipping_address1,'customer_shipping_address2'=>$request->shipping_address2,'customer_shipping_zip'=>$request->shipping_zip,'customer_shipping_city'=>$request->shipping_city,'customer_shipping_state'=>$request->shipping_state,'customer_shipping_country'=>$request->shipping_country,'merchant_id'=>session('merchant'),'created_at'=>date('Y-m-d H:i:s'),'issue_date'=>$request['issue_date'],'expiry_date'=>$request['expiry_date'],'place_of_supply'=>$request['place_of_supply'],'customer_notes'=>$request->customer_notes,'description'=>$request->desscription));
        
        return response()->json(array("success" => 1));    
        
    }
}
