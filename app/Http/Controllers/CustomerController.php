<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

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
        $breadcrumbs = [
            ['link' => "customer", 'name' => "Customer"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        $all_customers = $api->customer->all($options);
        return view('pages.customer.index', compact('pageConfigs','breadcrumbs','all_customers'));
    }

    public function store(Request $request){
        $request->validate([
            'name'          => 'required',
            'email'         => 'required',
            'customer_contact' => 'required',
        ]);
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api->customer->create(array('name' => $request->name, 'email' => $request->email,'contact'=>$request->customer_contact));
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
        return response()->json(array('msg'=>'Customer Updated'));
    }
}
