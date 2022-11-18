<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;

class ItemController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "items", 'name' => "Items"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        #$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api = new Api(Helper::api_key(), Helper::api_secret());
        //$all_items = $api->Item->all();
        /*@if(!empty($all_items->items))
                @foreach($all_items->items as $titem)*/
        $all_items = DB::table('items')->get();
        
        return view('pages.item.index', compact('breadcrumbs','pageConfigs','all_items'));
    }

    public function deleteItem(Request $request){
        $item_id = $request->item_id;
        #$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $api = new Api(Helper::api_key(), Helper::api_secret());
        
        if($api->Item->fetch($item_id)->delete()){
            $delete_item_from_db = DB::table('items')->where('item_id',$request->item_id)->delete();
            return response()->json(array("success" => 1));    
        }else{
            return response()->json(array("success" => 0));    
        }
    }

}
