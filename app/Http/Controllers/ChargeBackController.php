<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargeBackController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "chargeback", 'name' => "Chargeback"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.chargeback.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
