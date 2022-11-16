<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Refund;

class RefundController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "refunds", 'name' => "Refunds"]
        ];
        $pageConfigs = ['pageHeader' => true];

        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        $all_refunds = $api->refund->all($options);*/
        $merchant_id =  session()->get('merchant');
        $all_refunds = Refund::where('merchant_id',$merchant_id)->get();

        return view('pages.transaction.refunds', compact('pageConfigs','breadcrumbs','all_refunds'));
    }

    public function searchRefund(Request $request){
        $payment_id = $request->payment_id;
        $refund_id = $request->refund_id;
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $daterangepicker = $request->daterangepicker;
        $html='';


        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_refunds = $api->refund->all();*/
        $merchant_id =  session()->get('merchant');
        $query = Refund::where('merchant_id',$merchant_id);
        if($payment_id!=''){
            $query->where('payment_id',$payment_id);
        }if($refund_id!=''){
            $query->where('refund_id',$refund_id);
        }if($status!=''){
            $query->where('status',$status);
        }if($daterangepicker!='' && $start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $all_refunds = $query->get();


        if(!empty($all_refunds)){
            foreach($all_refunds as $refund){
                $html.='<tr>
                    <th scope="row">'.$refund->refund_id.'</th>
                    <th scope="row">'.$refund->payment_id.'</th>
                    <td>'.number_format($refund->amount/100,2).'</td>
                    <td>'.date("jS F, Y", $refund->created_at).'</td>
                    <td>
                        <a class="waves-effect waves-light btn-small">'.Helper::badge($refund->status).'</a>
                    </td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }
}
