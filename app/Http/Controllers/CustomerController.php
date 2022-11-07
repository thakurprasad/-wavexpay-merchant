<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;
use App\Models\Customer;
use App\Models\CustomerAddress;

class CustomerController extends Controller
{
    public $token,$merchant;
    /**
     * Instantiate a new ClassController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->token = session('token');
            $this->merchant = session('merchant');
            return $next($request);
        });

    }

    public function index(Request $request){
        
        //echo $this->token;exit;
        $breadcrumbs = [
            ['link' => "customer", 'name' => "Customer"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        //$all_customers = $api->customer->all($options);
        $all_customers = Customer::all();
        return view('pages.customer.index', compact('pageConfigs','breadcrumbs','all_customers'));
    }

    public function store(Request $request){
        $request->validate([
            'name'          => 'required',
            'email'         => 'required',
            'customer_contact' => 'required',
        ]);
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');

        $response = $api->customer->create(array('name' => $request->name, 'email' => $request->email,'contact'=>$request->customer_contact));

        $customer = Customer::create(array('customer_id'=> $response->id, 'merchant_id'=>session('merchant'), 'name' => $request->name, 'email' => $request->email,'contact'=>$request->customer_contact,'gstin'=>$request->gstin,"created_at"=>NOW()));

        if(isset($request->action) && $request->action=='invoice')
        {
            $all_customers = Customer::all();
            $customer_html='<option value="">Select A Customer</option>';
            if(!empty($all_customers)){
                foreach($all_customers as $cust){
                    $customer_html.='<option value="'.$cust->customer_id.'"';
                    if($cust->id==$customer->id)
                    {
                        $customer_html.=' selected="selected"';
                    }
                    $customer_html.='><strong>'.$cust->name.'</strong> ( '.$cust->email.' )</option>';
                }
            }
            return response()->json(array('customer_html'=>$customer_html));
        }
        else 
        {
            return response()->json(array('msg'=>'Customer Created'));
        }
        
    }

    public function update(Request $request){
        $request->validate([
            'name'          => 'required',
            'email'         => 'required',
            'contact' => 'required',
        ]);
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api->customer->fetch($request->id)->edit(array('name' => $request->name, 'email' => $request->email,'contact'=>$request->contact));

        DB::table('customers')->where('customer_id',$request->id)->update(array('name' => $request->name, 'email' => $request->email,'contact'=>$request->contact,'gstin'=>$request->gst,"updated_at"=>NOW()));

        return response()->json(array('msg'=>'Customer Updated'));
    }

    public function getCustomerExistingAddress(Request $request)
    {
        $customer_id = $request->customer;
        $type = $request->type;
        $get_customer_details = Customer::where('customer_id',$customer_id)->first();
        $get_customer_billing_adresss = CustomerAddress::where('customer_id',$get_customer_details->id)->where('address_type',$type.'_address')->get();
        $html = '';
        if(count($get_customer_billing_adresss)>0)
        {
            foreach($get_customer_billing_adresss as $adresss)
            {
                $html.='<div class="card" style="margin-left:50px;width: 80%; border-color:#6f42c1; border-width:1px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Address Line 1</strong> : '.$adresss->line_1.'
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="radio" style="float:right;" name="billing_address_id" onclick="set_address(\''.$type.'\',\''.$adresss->id.'\',\''.$adresss->line_1.'\',\''.$adresss->line_2.'\',\''.$adresss->state.'\',\''.$adresss->city.'\',\''.$adresss->country.'\',\''.$adresss->zip.'\')" value="'.$adresss->id.'" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Address Line 1</strong> : '.$adresss->line_1.'
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <strong>Address Line 2</strong> : '.$adresss->line_2.'
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>State</strong> : '.$adresss->state.'
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>City</strong> : '.$adresss->city.'
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>Country</strong> : '.$adresss->country.'
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <strong>ZIP</strong> : '.$adresss->zip.'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        else 
        {
            $html.='<div class="card" style="margin-left:50px;width: 80%; border-color:#6f42c1; border-width:1px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>No Existing Address Found</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        return response()->json(array('html'=>$html));
    }
}
