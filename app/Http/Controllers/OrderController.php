<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use Helper;

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
        $all_orders = Order::where('merchant_id',$merchant_id)->get();
        return view('pages.transaction.orders', compact('pageConfigs','breadcrumbs','all_orders'));
    }

    public function searchOrder(Request $request){
        $order_id = $request->order_id;
        $reciept = $request->reciept;
        $status = $request->status;
        $notes = $request->notes;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $daterangepicker = $request->daterangepicker;
        $html = '';
        
        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        //$all_orders = $api->order->all();*/
        $merchant_id =  session()->get('merchant');
        $query = Order::where('merchant_id',$merchant_id);
        if($order_id!=''){
            $query->where('order_id',$order_id);
        }if($reciept!=''){
            $query->where('receipt',$reciept);
        }if($status!=''){
            $query->where('status',$status);
        }if($daterangepicker!='' && $start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $all_orders = $query->get();

        if(!empty($all_orders)){
            foreach($all_orders as $order){
                $html.='<tr>
                    <th scope="row">'.$order->order_id.'</th>
                    <td>'.number_format($order->amount,2).'</td>
                    <td>'.$order->attempts.'</td>
                    <td>'.$order->receipt.'</td>
                    <td>'.$order->created_at.'</td>
                    <td>
                        <a class="waves-effect waves-light btn-small">'.Helper::badge($order->status).'</a>
                    </td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }
}
