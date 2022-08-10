<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "orders", 'name' => "Order"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $merchant_id =  session()->get('merchant');

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $options = ['count'=>50, 'skip'=>0];
        //$all_orders = $api->order->all($options);
        $all_orders = DB::table('orders')->where('merchant_id',$merchant_id)->get();
        return view('pages.transaction.orders', compact('pageConfigs','breadcrumbs','all_orders'));
    }

    public function searchOrder(Request $request){
        $order_id = $request->order_id;
        $reciept = $request->reciept;
        $status = $request->status;
        $notes = $request->notes;
        $html = '';
        
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        //$all_orders = $api->order->all();
        $merchant_id =  session()->get('merchant');
        $all_orders = DB::table('orders')->where('merchant_id',$merchant_id)->get();

        if(!empty($all_orders)){
            foreach($all_orders as $order){
                if(($order_id==$order->id && $order->id!='') || ($reciept==$order->receipt && $order->receipt!='') ||  ($status==$order->status && $order->status!='')){
                    $html.='<tr>
                        <th scope="row">'.$order->id.'</th>
                        <td>'.number_format($order->amount,2).'</td>
                        <td>'.$order->attempts.'</td>
                        <td>'.$order->receipt.'</td>
                        <td>'.$order->created_at.'</td>
                        <td>
                            <a class="waves-effect waves-light btn-small">'.$order->status.'</a>
                        </td>
                    </tr>';
                }
            }
        }
        return response()->json(array('html'=>$html));
    }
}
