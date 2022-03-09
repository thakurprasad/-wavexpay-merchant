<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class SettlementController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "settlements", 'name' => "Settlements"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_settlements = $api->settlement->all();

        return view('pages.settlement.index', compact('breadcrumbs','pageConfigs', 'all_settlements'));
    }

    public function searchSettlement(Request $request){
        print_r($request->all());
    }
}
