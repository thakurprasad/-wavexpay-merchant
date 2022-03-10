<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RefundController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "refunds", 'name' => "Refunds"]
        ];
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        $all_refunds = $api->refund->all($options);


        return view('pages.transaction.refunds', compact('pageConfigs','breadcrumbs','all_refunds'));
    }

    public function searchrefunds(Request $request){
        print_r($request->all());
    }
}
