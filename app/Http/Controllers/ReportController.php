<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "reports", 'name' => "Reports"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.report.index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }


    public function transactionReport(Request $request){
        $breadcrumbs = [
            ['link' => "transaction-reports", 'name' => "Transaction Reports"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $type='transaction';
        return view('pages.report.transaction-report', compact('type'));
    }

    public function settlementReport(){
        $type='settlement';
        return view('pages.report.transaction-report', compact('type'));
    }

    public function refundReport(){
        $type='refund';
        return view('pages.report.transaction-report', compact('type'));
    }

    public function chargebackDisputeReport(){
        $type='chargeback-dispute';
        return view('pages.report.transaction-report', compact('type'));
    }
}
