<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "orders", 'name' => "Order"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.orders', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function searchOrder(Request $request){
        print_r($request->all());
    }
}
