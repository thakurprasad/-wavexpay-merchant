<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;

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
        $all_customers = DB::table('customers')->get();
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

        DB::table('customers')->insert(array('customer_id'=> $response->id, 'merchant_id'=>session('merchant'), 'name' => $request->name, 'email' => $request->email,'contact'=>$request->customer_contact,'gstin'=>$request->gstin,"created_at"=>NOW()));

        return response()->json(array('msg'=>'Customer Created'));
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
}
