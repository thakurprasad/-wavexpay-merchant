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

        

        /*****************payment value calculation for payment line graph***********************/
        $payment_current_month_data = DB::table('payments')->whereMonth('payment_created_at', date('m'))
        ->whereYear('payment_created_at', date('Y'))
        ->get(['amount','payment_created_at']);

        $paymentmaxValue = DB::table('payments')->orderBy('amount', 'desc')->value('amount');
        $paymentminValue = DB::table('payments')->orderBy('amount', 'asc')->value('amount');

        $paymentxvalue1='[';
        $paymentyvalue1='[';
        foreach($payment_current_month_data as $data)
        {
            $paymentxvalue1.="'".date('M',strtotime($data->payment_created_at)).date('d',strtotime($data->payment_created_at))."'".",";

            $paymentyvalue1.=$data->amount.',';
        }
        $paymentxvalue1=rtrim($paymentxvalue1,",");
        $paymentxvalue1.=']';

        $paymentyvalue1=rtrim($paymentyvalue1,",");
        $paymentyvalue1.=']';
        /*****************payment value end calculation for payment line graph***********************/


        /*****************order value calculation for total line graph***********************/
        $order_current_month_data = DB::table('orders')->whereMonth('order_created_at', date('m'))
        ->whereYear('order_created_at', date('Y'))
        ->get(['amount','order_created_at']);

        $ordermaxValue = DB::table('orders')->whereMonth('order_created_at', date('m'))->whereYear('order_created_at', date('Y'))->orderBy('amount', 'desc')->value('amount');
        $orderminValue = DB::table('orders')->whereMonth('order_created_at', date('m'))->whereYear('order_created_at', date('Y'))->orderBy('amount', 'asc')->value('amount');

        $orderxvalue1='[';
        $orderyvalue1='[';
        foreach($order_current_month_data as $data)
        {
            $orderxvalue1.="'".date('M',strtotime($data->order_created_at)).date('d',strtotime($data->order_created_at))."'".",";

            $orderyvalue1.=$data->amount.',';
        }
        $orderxvalue1=rtrim($orderxvalue1,",");
        $orderxvalue1.=']';

        $orderyvalue1=rtrim($orderyvalue1,",");
        $orderyvalue1.=']';
        /*****************order value end calculation for payment line graph***********************/

        $success_perc = number_format(((count($payments)*100)/(count($payments)+count($orders)+count($disputes)+count($refunds))),2);
        
        return view('pages.dashboard', compact('payments','orders','disputes','refunds','users','success_perc','paymentxvalue1','paymentyvalue1','paymentmaxValue','paymentminValue','ordermaxValue','orderminValue','orderxvalue1','orderyvalue1'));
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
