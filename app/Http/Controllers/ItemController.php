<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class ItemController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "items", 'name' => "Items"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_items = $api->Item->all();
        
        return view('pages.item.index', compact('breadcrumbs','pageConfigs','all_items'));
    }

    public function deleteItem(Request $request){
        $item_id = $request->item_id;
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        
        if($api->Item->fetch($item_id)->delete()){
            return response()->json(array("success" => 1));    
        }else{
            return response()->json(array("success" => 0));    
        }
    }

}
