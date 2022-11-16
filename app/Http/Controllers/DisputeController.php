<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;
use App\Models\Dispute;
use Helper;

class DisputeController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "disputes", 'name' => "Disputes"]
        ];

        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/disputes');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_YRAqXZOYgy9uyf' . ':' . 'uSaaMQw3jHK0MPtOnXCSSg51');
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $all_disputes = json_decode($result, TRUE);
        curl_close($ch);*/
        $merchant_id =  session()->get('merchant');
        $all_disputes = Dispute::where('merchant_id',$merchant_id)->get();
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.disputes', compact('breadcrumbs', 'all_disputes'));
    }

    public function searchDispute(Request $request){
        $dispute_id = $request->dispute_id;
        $payment_id = $request->payment_id;
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $daterangepicker = $request->daterangepicker;


        $merchant_id =  session()->get('merchant');
        $query = Dispute::where('merchant_id',$merchant_id);
        if($dispute_id!=''){
            $query->where('dispute_id',$dispute_id);
        }if($payment_id!=''){
            $query->where('payment_id',$payment_id);
        }if($status!=''){
            $query->where('status',$status);
        }if($daterangepicker!='' && $start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $all_disputes = $query->get();



        /*$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/disputes');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_YRAqXZOYgy9uyf' . ':' . 'uSaaMQw3jHK0MPtOnXCSSg51');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $all_disputes = json_decode($result, TRUE);
        curl_close($ch);*/

        $html = '';

        if(!empty($all_disputes)){
            foreach($all_disputes as $dispute){
                $html.='<tr>
                    <th scope="row">'.$dispute->id.'</th>
                    <th scope="row">'.$dispute->payment_id.'</th>
                    <td>'.number_format($dispute->amount,2).'</td>
                    <td>'.$dispute->reason_code.'</td>
                    <td>'.date("jS F, Y", $dispute->respond_by).'</td>
                    <td>'.date("jS F, Y", $dispute->created_at).'</td>
                    <td>
                        <a class="waves-effect waves-light btn-small">'.Helper::badge($dispute['status']).'</a>
                    </td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }
}
