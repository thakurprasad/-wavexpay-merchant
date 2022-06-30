<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use DB;

class PageController extends Controller
{
    public function blankPage()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Blank Page"],
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('pages.page-blank', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function dashboard()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Blank Page"],
        ];

        $payments = DB::table('payments')->get();
        $orders = DB::table('orders')->get();
        $disputes = DB::table('disputes')->get();
        $refunds = DB::table('refunds')->get();
        $users = DB::table('users')->get();

        $success_perc = number_format(((count($payments)*100)/(count($payments)+count($orders)+count($disputes)+count($refunds))),2);
        
        return view('pages.dashboard', compact('payments','orders','disputes','refunds','users','success_perc'));
    }


    public function collapsePage()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Page Collapse"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'bodyCustomClass' => 'menu-collapse'];

        return view('pages.page-collapse', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }


    public function invoiceList()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.list', ['pageConfigs' => $pageConfigs]);
    }
    public function invoiceView()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.view', ['pageConfigs' => $pageConfigs]);
    }
    public function invoiceEdit()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.edit', ['pageConfigs' => $pageConfigs]);
    }
    public function invoiceAdd()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.add', ['pageConfigs' => $pageConfigs]);
    }


    public function merchantProfile()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "User Profile"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.merchant-profile', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
