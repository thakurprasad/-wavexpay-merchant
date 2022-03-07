<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "settlements", 'name' => "Settlements"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.settlement.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function searchSettlement(Request $request){
        print_r($request->all());
    }
}
