<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "payments", 'name' => "Payments"]
        ];

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.payments', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function searchPayment(Request $request){
        print_r($request->all());
    }
}
