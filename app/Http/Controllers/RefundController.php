<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RefundController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "refunds", 'name' => "Refunds"]
        ];
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        $all_refunds = $api->refund->all($options);


        return view('pages.transaction.refunds', compact('pageConfigs','breadcrumbs','all_refunds'));
    }

    public function searchRefund(Request $request){
        $payment_id = $request->payment_id;
        $refund_id = $request->refund_id;
        $status = $request->status;
        $notes = $request->notes;

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_refunds = $api->refund->all();

        if(!empty($all_payments->items)){
            foreach($all_refunds->items as $refund){
                if($payment_id==$payment['id'] || $email==$payment['email'] || $status==$payment['status']){
                    $html.='<tr>
                        <th scope="row">'.$refund['id'].'</th>
                        <th scope="row">'.$refund['payment_id'].'</th>
                        <td>'.number_format($refund['amount']/100,2).'</td>
                        <td>'.date("jS F, Y", $refund['created_at']).'</td>
                        <td>
                            <a class="waves-effect waves-light btn-small">'.$refund['status'].'</a>
                        </td>
                    </tr>';
                }
            }
        }
        return response()->json(array('html'=>$html));
    }
}
