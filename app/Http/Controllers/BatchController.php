<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "batch", 'name' => "Batch"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.batch', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function searchBatch(Request $request){
        print_r($request->all());
    }
}
