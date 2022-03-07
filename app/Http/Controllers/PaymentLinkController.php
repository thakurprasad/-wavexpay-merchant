<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentLinkController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "payment-links", 'name' => "Payment Links"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.paymentlinks.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
