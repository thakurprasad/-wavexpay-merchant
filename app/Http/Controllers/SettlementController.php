<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Settlement;
use Helper;

class SettlementController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "settlements", 'name' => "Settlements"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_settlements = $api->settlement->all();*/
        $merchant_id =  session()->get('merchant');
        $all_settlements = Settlement::where('merchant_id',$merchant_id)->get();
        return view('pages.settlement.index', compact('breadcrumbs','pageConfigs', 'all_settlements'));
    }

    public function searchSettlement(Request $request){
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $settlement_id = $request->settlement_id;
        /*$api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_settlements = $api->settlement->all();*/
        $merchant_id =  session()->get('merchant');
        $query = Settlement::where('merchant_id',$merchant_id);
        if($settlement_id!=''){
            $query->where('settlement_id',$settlement_id);
        }if($status!=''){
            $query->where('status',$status);
        }if($start_date!='' && $end_date!=''){
            $query->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"]);
        }
        $all_settlements = $query->get();
        $html = '';

        if(!empty($all_settlements)){
            foreach($all_settlements as $settlement){
                $html.='<tr>
                    <th scope="row">'.$settlement->id.'</th>
                    <td>'.number_format($settlement->fees,2).'</td>
                    <td>'.number_format($settlement->tax,2).'</td></td>
                    <td>'.date('Y-m-d',strtotime($settlement->created_at)).'</td>
                    <td>
                        <a class="waves-effect waves-light btn-small">'.Helper::badge($settlement->status).'</a>
                    </td>
                </tr>';
            }
        }
        return response()->json(array('html'=>$html));
    }
}
