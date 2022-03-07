<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "invoices", 'name' => "Invoice"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.invoice.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
