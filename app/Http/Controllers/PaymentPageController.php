<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentPageController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "payment-pages", 'name' => "Payment Pages"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.paymentpages.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
