<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RefundController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "refunds", 'name' => "Refunds"]
        ];
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.refunds', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function searchrefunds(Request $request){
        print_r($request->all());
    }
}
