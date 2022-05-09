<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;
use App\Helpers\Helper;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "invoices", 'name' => "Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        //rzp_live_WtpbTT2s2aJ3Ky
        //uSaaMQw3jHK0MPtOnXCSSg51

        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api($api_key, $api_secret);
        /*$all_invoices = $api->invoice->all();
        $all_customers = $api->customer->all();
        $all_items = $api->Item->all();*/
        $all_invoices = DB::table('invoices')->get();
        $all_customers = DB::table('customers')->get();
        $all_items = DB::table('items')->get();

        //print_r(array(array('item_id'=>'item_DRt61i2NnL8oy6')));exit;
        
        return view('pages.invoice.index', compact('breadcrumbs','pageConfigs', 'all_invoices','all_customers','all_items'));
    }

    public function searchInvoice(Request $request){
        $invoice_id = $request->invoice_id;
        $receipt = $request->reciept_number;
        $customer_contact = $request->customer_contact;
        $customer_email = $request->customer_email;

        $query = DB::table('invoices');
        if($invoice_id!=''){
            $query->where('invoice_id',$invoice_id);
        }if($receipt!=''){
            $query->where('receipt',$receipt);
        }if($customer_email!=''){
            $query->where('customer_email',$customer_email);
        }if($customer_email!=''){
            $query->where('customer_email',$customer_email);
        }
        $result = $query->get();
        //print_r($result);exit;
        $all_invoices = $result;



        //$api_key = session('merchant_key');
        //$api_secret = session('merchant_secret');
        //$api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        //$all_invoices = $api->invoice->all();

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
                    <th scope="row">'.$invoice->id.'</th>
                    <td>'.number_format($amount,2).'</td>
                    <td>'.$invoice->receipt.'</td>
                    <td>'.$invoice->created_at.'</td>
                    <td>'.$customer_details->name.' ('.$customer_details->contact.'/ '.$customer_details->email.')</td>
                    <td>'.$invoice->short_url.'</td>
                    <td>';
                        if($invoice->status=='cancelled'){
                            $html.='<span class="new badge red">'.$invoice->status.'</span>';
                        }
                        else{
                            $html.='<span class="new badge blue">'.$invoice->status.'</span>';
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

        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        $all_customers = DB::table('customers')->get();

        $all_items = DB::table('items')->get();
        
        return view('pages.invoice.newinvoice', compact('breadcrumbs','pageConfigs','all_customers','all_items'));
    }


    public function createItem(Request $request){
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        $response = $api->Item->create(array("name" => $request->modal_item_name,"description" => $request->modal_item_description,"amount" => $request->modal_item_rate,"currency" => "INR"));

        DB::table('items')->insert(array("item_id"=>$response->id,"name" => $request->modal_item_name,"description" => $request->modal_item_description,"amount" => $request->modal_item_rate,"currency" => "INR","created_at"=>NOW()));


        return response()->json(array('success'=>1,'msg'=>'Item Created SUccessfully!!'));
    }

    public function getItem(Request $request){
        $item_id = $request->item_id;
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $item_details = $api->Item->fetch($item_id);
        return response()->json(array("amount" => $item_details->amount));
    }

    public function addNewItemRow(Request $request){
        $count = $request->count;
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_items = $api->Item->all();

        $html='<tr id="item_row_id'.$count.'">
            <td>
                <span id="itd'.$count.'">
                <select name="tableitem" id="tableitem'.$count.'" onchange="select_item(\''.$count.'\')">
                    <option value="" disabled selected>Select An Item</option>';
                    if(!empty($all_items->items)){
                        foreach($all_items->items as $titem){
                            $html.='<option value="'.$titem->id.'"><strong>'.$titem->name.'</option>';
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
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');


        $api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $itemidArray['item_id'] = array();
        foreach($request['tableitem'] as $items){
            $itemidArray['item_id'] = $items;
        }

        $item_id = '';
        foreach($request['tableitem'] as $items){
            $item_id.=$items.',';
        }
        $item_id = rtrim($item_id,',');


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

        $customer_name = '';
        $customer_email = '';
        $customer_contact = '';

        $get_customer_details = DB::table('customers')->where('customer_id',$request['customer'])->first();
        if(!empty($get_customer_details)){
            $customer_name = $get_customer_details->name;
            $customer_email = $get_customer_details->email;
            $customer_contact = $get_customer_details->contact;
        }


        $invoice_create_array = array (
            'type' => 'invoice',
            'description' => $request['description'], 
            'date' => strtotime(date('Y-m-d H:i:s')), 
            'customer_id'=> $request['customer'],  
            'line_items'=>array($itemidArray),
        );

        $response = $api->invoice->create($invoice_create_array);

        DB::table('invoices')->insert(array('invoice_id'=>$response->id,'reciept'=>$response->reciept,'short_url'=>$response->short_url,'type' => 'invoice','description' => $request['description'],'date' => date('Y-m-d H:i:s'),'customer_id'=> $request['customer'],'customer_name'=>$customer_name,'customer_email'=>$customer_email,'customer_contact'=>$customer_contact,'item_id'=>$item_id,'customer_billing_address1'=>$request->billing_address1,'customer_billing_address2'=>$request->billing_address2,'customer_billing_zip'=>$request->billing_zip,'customer_billing_city'=>$request->billing_city,'customer_billing_state'=>$request->billing_state,'customer_billing_country'=>$request->billing_country,'customer_shipping_address1'=>$request->shipping_address1,'customer_shipping_address2'=>$request->shipping_address2,'customer_shipping_zip'=>$request->shipping_zip,'customer_shipping_city'=>$request->shipping_city,'customer_shipping_state'=>$request->shipping_state,'customer_shipping_country'=>$request->shipping_country,'merchant_id'=>session('merchant'),'status'=>$response->status,'created_at'=>date('Y-m-d H:i:s')));

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


        $api = new Api($api_key, $api_secret);
        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $invoice_details = $api->invoice->fetch($invoiceId);

        $all_customers = $api->customer->all();
        $all_items = $api->Item->all();
        //print_r($invoice_details);exit;

        return view('pages.invoice.invoicedetails', compact('breadcrumbs','pageConfigs','invoice_details','all_customers','all_items'));
    }

    public function editInvoice(Request $request){
        $invoiceId = $request->edit_id;

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


        $api = new Api($api_key, $api_secret);

        //$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        if($api->invoice->fetch($invoiceId)->edit(array('line_items' => array($itemidArray)))){
            return response()->json(array("success" => 1));    
        }else{
            return response()->json(array("success" => 0));    
        }
    }
}
