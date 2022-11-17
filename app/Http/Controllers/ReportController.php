<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;

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

    public function downloadReport(Request $request){
        $request->validate([
            'daterangepicker' => 'required',
            'filter_on' => 'required',
        ]);


        $daterange = $request->daterangepicker;
        $filter_on = $request->filter_on;
        $date = explode(" - ",$daterange);
        $start_date = trim($date[0]);
        $start_date = date('Y-m-d',strtotime($start_date));
        $end_date = trim($date[1]);
        $end_date = date('Y-m-d',strtotime($end_date));


        $merchant_id =  session()->get('merchant');
        if($filter_on=='payment'){
            $query = Payment::where('merchant_id',$merchant_id);
        }
        if($filter_on=='order'){
            $query = Order::where('merchant_id',$merchant_id);
        }
        $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        $result = $query->get();

        //print_r($result);exit;

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=".$filter_on."-Report-".date('Y-m-d').".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Payment Id', 'Amount', 'Email', 'Contact', 'Payment Method', 'Status');

        $callback = function() use($result, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($result as $details) {
                fputcsv($file, array($details->payment_id, $details->amount, $details->email, $details->contact, $details->payment_method, $details->status));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
