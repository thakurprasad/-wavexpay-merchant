<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
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
        $all_payments = Payment::where('merchant_id',$merchant_id)->get();
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

        $html = '';
        $merchant_id =  session()->get('merchant');
        $query = Payment::where('merchant_id',$merchant_id);
        if($payment_id!=''){
            $query->where('payment_id',$payment_id);
        }if($email!=''){
            $query->where('email',$email);
        }if($status!=''){
            $query->where('status',$status);
        }if($start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $result = $query->get();
        

        if(!empty($result)){
            foreach($result as $payment){
                $html.='<tr>
                    <th scope="row">'.$payment->payment_id.'</th>
                    <td>'.$payment->amount.'</td>
                    <td>'.$payment->email.'</td>
                    <td>'.$payment->contact.'</td>
                    <td>'.date('Y-m-d',strtotime($payment->created_at)).'</td>
                    <td>
                        <a class="waves-effect waves-light btn-small">'.$payment->status.'</a>
                    </td>
                </tr>';
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
