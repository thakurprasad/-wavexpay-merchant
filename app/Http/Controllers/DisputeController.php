<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;

class DisputeController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "javascript:void(0)", 'name' => "Transaction"], ['link' => "disputes", 'name' => "Disputes"]
        ];


        
        $ch = curl_init();

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
        curl_close($ch);

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        return view('pages.transaction.disputes', compact('breadcrumbs','pageConfigs', 'all_disputes'));
    }

    public function searchDispute(Request $request){
        $dispute_id = $request->dispute_id;
        $payment_id = $request->payment_id;
        $status = $request->status;
        $phase = $request->phase;
        $start_date = $request->start_date;
        $end_date = $request->end_date;



        $ch = curl_init();

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
        curl_close($ch);

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
        

        if(!empty($all_disputes['items'])){
            foreach($all_disputes['items'] as $dispute){
                if($dispute_id==$dispute['id'] || $payment_id==$dispute['payment_id'] ||  $status==$dispute['status'] ||  $phase==$dispute['phase'] || ($dispute['created_at']>=$s_date && $dispute['created_at']<=$e_date)){
                    $html.='<tr>
                        <th scope="row">'.$dispute['id'].'</th>
                        <th scope="row">'.$dispute['payment_id'].'</th>
                        <td>'.number_format($dispute['amount'],2).'</td>
                        <td>'.$dispute['reason_code'].'</td>
                        <td>'.date("jS F, Y", $dispute['respond_by']).'</td>
                        <td>'.date("jS F, Y", $dispute['created_at']).'</td>
                        <td>
                            <a class="waves-effect waves-light btn-small">'.$dispute['status'].'</a>
                        </td>
                    </tr>';
                }
            }
        }
        return response()->json(array('html'=>$html));
    }
}
