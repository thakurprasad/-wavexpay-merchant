<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;

class PaymentController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "payments", 'name' => "Payments"]
        ];


        $merchant_id =  session()->get('merchant');

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_payments = $api->payment->all();
        //print_r($all_payments);exit;
        //Pageheader set true for breadcrumbs
        $all_payments = DB::table('payments')->where('merchant_id',$merchant_id)->get();
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.payments', compact('breadcrumbs','pageConfigs', 'all_payments'));
    }

    public function searchPayment(Request $request){
        $payment_id = $request->payment_id;
        $email = $request->email;
        $status = $request->status;
        $notes = $request->notes;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_payments = $api->payment->all();

        $merchant_id =  session()->get('merchant');
        
        $html = '';

        $start_date = DateTime::createFromFormat('d/m/Y', $start_date);
        if ($start_date === false) {
            $s_date='';
        } else {
            $s_date = $start_date->getTimestamp();
        }

        $end_date = DateTime::createFromFormat('d/m/Y', $end_date);
        if ($end_date === false) {
            $e_date='';
        } else {
            $e_date = $end_date->getTimestamp();
        }
        

        if(!empty($all_payments->items)){
            foreach($all_payments->items as $payment){
                if($payment_id==$payment['id'] || $email==$payment['email'] ||  $status==$payment['status']){
                    $html.='<tr>
                        <th scope="row">'.$payment['id'].'</th>
                        <td>'.$payment['amount'].'</td>
                        <td>'.$payment['email'].'</td>
                        <td>'.$payment['contact'].'</td>
                        <td>'.date('Y-m-d',$payment['created_at']).'</td>
                        <td>
                            <a class="waves-effect waves-light btn-small">'.$payment['status'].'</a>
                        </td>
                    </tr>';
                }
            }
        }
        return response()->json(array('html'=>$html));
    }

    public function statusWisePayment(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $status = $request->status;
        if($status=='all'){
            $all_payments = DB::table('payments')->get();
        }else{
            $all_payments = DB::table('payments')->where('merchant_id',$merchant_id)->where('status',$status)->get();
        }
        
        return view('pages.transaction.paymentsstatus', compact('all_payments'));
    }
}
