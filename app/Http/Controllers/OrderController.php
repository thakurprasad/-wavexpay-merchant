<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "orders", 'name' => "Order"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        $all_orders = $api->order->all($options);

        return view('pages.transaction.orders', compact('pageConfigs','breadcrumbs','all_orders'));
    }

    public function searchOrder(Request $request){
        print_r($request->all());
    }
}
