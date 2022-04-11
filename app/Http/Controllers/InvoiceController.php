<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "invoices", 'name' => "Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_invoices = $api->invoice->all();

        $all_customers = $api->customer->all();

        $all_items = $api->Item->all();

        //print_r(array(array('item_id'=>'item_DRt61i2NnL8oy6')));exit;
        
        return view('pages.invoice.index', compact('breadcrumbs','pageConfigs', 'all_invoices','all_customers','all_items'));
    }

    public function searchInvoice(Request $request){
        $invoice_id = $request->invoice_id;
        $receipt = $request->reciept_number;
        $customer_contact = $request->customer_contact;
        $customer_email = $request->customer_email;

        /*$url = 'https://dashboard.razorpay.com/merchant/api/test/invoices';

        if($invoice_id!=''){
            $url.='/'.$invoice_id;
        }

        if($receipt!='' && $customer_contact=='' && $customer_email==''){
            $url.='?receipt='.$receipt;
        }
        if($receipt=='' && $customer_contact!='' && $customer_email==''){
            $url.='?customer_contact='.$customer_contact;
        }
        if($receipt=='' && $customer_contact=='' && $customer_email!=''){
            $url.='?customer_email='.$customer_email;
        }
        if($receipt!='' && $customer_contact!='' && $customer_email==''){
            $url.='?receipt='.$receipt.'&customer_contact='.$customer_contact;
        }
        if($receipt=='' && $customer_contact!='' && $customer_email!=''){
            $url.='?customer_contact='.$customer_contact.'&customer_email='.$customer_email;
        }
        if($receipt!='' && $customer_contact=='' && $customer_email!=''){
            $url.='?receipt='.$receipt.'&customer_email='.$customer_email;
        }
        if($receipt!='' && $customer_contact!='' && $customer_email!=''){
            $url.='?receipt='.$receipt.'&customer_email='.$customer_email.'&customer_contact='.$customer_contact;
        }
        $url.='&type=invoice';*/



        /*using curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_YRAqXZOYgy9uyf' . ':' . 'uSaaMQw3jHK0MPtOnXCSSg51');
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        print_r($result);exit;
        //end using curl*/




        /*$options = ['id'=>$invoice_id,'reciept'=>$receipt,'customer_contact'=>$customer_contact,'customer_email'=>$customer_email];*/

        
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_invoices = $api->invoice->all();

        $html = '';
        if(!empty($all_invoices->items)){
            foreach($all_invoices->items as $invoice){
                if($invoice_id==$invoice->id || $receipt==$invoice->receipt || $customer_contact==$invoice->customer_details->contact || $customer_email==$invoice->customer_details->email){
                    $html.='<tr>
                        <th scope="row">'.$invoice->id.'</th>
                        <td>'.number_format(($invoice->line_items[0]->net_amount)/100,2).'</td>
                        <td>'.$invoice->receipt.'</td>
                        <td>'.date('Y-m-d',$invoice->created_at).'</td>
                        <td>'.$invoice->customer_details->name.' ('.$invoice->customer_details->contact.'/ '.$invoice->customer_details->email.')</td>
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
        }
        return response()->json(array('html'=>$html));
    }

    public function newInvoice(Request $request){
        $breadcrumbs = [
            ['link' => "newinvoice", 'name' => "New Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        $all_customers = $api->customer->all();

        $all_items = $api->Item->all();
        
        return view('pages.invoice.newinvoice', compact('breadcrumbs','pageConfigs','all_customers','all_items'));
    }


    public function createItem(Request $request){
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        $api->Item->create(array("name" => $request->modal_item_name,"description" => $request->modal_item_description,"amount" => $request->modal_item_rate,"currency" => "INR"));

        $all_items = $api->Item->all();
        $item_dropdown='<option value="" disabled>Select An Item</option>';
        foreach($all_items->items as $titem){
            $item_dropdown.='<option value="'.$titem->id.'"';
            if($titem->name==$request->modal_item_name){
                $item_dropdown.=' selected';
            }
            $item_dropdown.='>'.$titem->name.'</option>';
        }
        return response()->json(array('name'=>$request->modal_item_name,"amount" => $request->modal_item_rate,'item_dropdown'=>$item_dropdown));
    }

    public function getItem(Request $request){
        $item_id = $request->item_id;
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $item_details = $api->Item->fetch($item_id);
        return response()->json(array("amount" => $item_details->amount));
    }

    public function addNewItemRow(Request $request){
        $count = $request->count;
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
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
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $itemidArray['item_id'] = array();
        foreach($request['tableitem'] as $items){
            $itemidArray['item_id'] = $items;
        }

        /*$c_details = $api->customer->fetch($request['customer']);
        print_r($c_details);*/

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


        $invoice_create_array = array (
            'type' => 'invoice',
            'description' => $request['description'], 
            'date' => strtotime(date('Y-m-d H:i:s')), 
            'customer_id'=> $request['customer'],  
            'line_items'=>array($itemidArray),
        );

        //print_r($invoice_create_array);exit;
        if($api->invoice->create($invoice_create_array)){
            return response()->json(array("success" => 1));    
        }else{
            return response()->json(array("success" => 0));    
        }


       

        /*{
            "type": "invoice",
            "description": "Invoice for the month of January 2020",
            "partial_payment": true,
            "customer": {
              "name": "Gaurav Kumar",
              "contact": 9999999999,
              "email": "gaurav.kumar@example.com",
              "billing_address": {
                "line1": "Ground & 1st Floor, SJR Cyber Laskar",
                "line2": "Hosur Road",
                "zipcode": "560068",
                "city": "Bengaluru",
                "state": "Karnataka",
                "country": "in"
              },
              "shipping_address": {
                "line1": "Ground & 1st Floor, SJR Cyber Laskar",
                "line2": "Hosur Road",
                "zipcode": "560068",
                "city": "Bengaluru",
                "state": "Karnataka",
                "country": "in"
              }
            },
            "line_items": [
              {
                "name": "Master Cloud Computing in 30 Days",
                "description": "Book by Ravena Ravenclaw",
                "amount": 399,
                "currency": "USD",
                "quantity": 1
              }
            ],
            "sms_notify": 1,
            "email_notify": 1,
            "currency": "USD",
            "expire_by": 1589765167
          }*/
    }

    public function showInvoice($invoiceId){
        $breadcrumbs = [
            ['link' => "invoice/".$invoiceId, 'name' => "Invoice Details"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
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

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        if($api->invoice->fetch($invoiceId)->edit(array('line_items' => array($itemidArray)))){
            return response()->json(array("success" => 1));    
        }else{
            return response()->json(array("success" => 0));    
        }
    }
}
