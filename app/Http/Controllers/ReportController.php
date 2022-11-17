<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Settlement;
use App\Models\Dispute;


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
        }else if($filter_on=='order'){
            $query = Order::where('merchant_id',$merchant_id);
        }else if($filter_on=='refund'){
            $query = Refund::where('merchant_id',$merchant_id);
        }else if($filter_on=='settlement'){
            $query = Settlement::where('merchant_id',$merchant_id);
        }else if($filter_on=='dispute'){
            $query = Dispute::where('merchant_id',$merchant_id);
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


        if($filter_on=='payment'){
            $columns = array('Payment Id', 'Amount', 'Email', 'Contact', 'Payment Method', 'Status');
        }else if($filter_on=='order'){
            $columns = array('Order Id', 'Amount', 'Reciept', 'Status');
        }else if($filter_on=='refund'){
            $columns = array('Refund Id', 'Amount', 'Reciept', 'Status');
        }else if($filter_on=='settlement'){
            $columns = array('Settlement Id', 'Entity', 'Amount', 'Status', 'Fees', 'Tax', 'UTR');
        }else if($filter_on=='dispute'){
            $columns = array('Dispute Id', 'Payment Id', 'Amount', 'Reason Code', 'Respond By', 'Status');
        }


        $callback = function() use($result, $columns,$filter_on) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($result as $details) {
                if($filter_on=='payment'){
                    fputcsv($file, array($details->payment_id, $details->amount, $details->email, $details->contact, $details->payment_method, $details->status));
                }else if($filter_on=='order'){
                    fputcsv($file, array($details->order_id, $details->amount, $details->receipt, $details->status));
                }else if($filter_on=='refund'){
                    fputcsv($file, array($details->refund_id, $details->amount, $details->receipt, $details->status));
                }else if($filter_on=='settlement'){
                    fputcsv($file, array($details->settlement_id, $details->entity, $details->amount, $details->status, $details->fees, $details->tax, $details->utr));
                }else if($filter_on=='dispute'){
                    fputcsv($file, array($details->dispute_id, $details->payment_id, $details->amount, $details->reason_code, $details->respond_by, $details->status));
                }
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
