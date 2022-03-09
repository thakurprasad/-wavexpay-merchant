<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "invoices", 'name' => "Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_invoices = $api->invoice->all();
        
        return view('pages.invoice.index', compact('breadcrumbs','pageConfigs', 'all_invoices'));
    }

    public function searchInvoice(Request $request){
        print_r($request->all());
    }
}
