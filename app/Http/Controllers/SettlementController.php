<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class SettlementController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['link' => "settlements", 'name' => "Settlements"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_settlements = $api->settlement->all();

        return view('pages.settlement.index', compact('breadcrumbs','pageConfigs', 'all_settlements'));
    }

    public function searchSettlement(Request $request){
        $settlement_id = $request->settlement_id;
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_settlements = $api->settlement->all();
        $html = '';

        if(!empty($all_settlements->items)){
            foreach($all_settlements->items as $settlement){
                if($settlement_id==$settlement['id']){
                    $html.='<tr>
                            <th scope="row">'.$settlement['id'].'</th>
                            <td>'.number_format($settlement['fees']/100,2).'</td>
                            <td>'.number_format($settlement['tax']/100,2).'</td></td>
                            <td>'.date('Y-m-d',$settlement['created_at']).'</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">'.$settlement['status'].'</a>
                                <a class="waves-effect waves-light btn-flat">Breakup</a>
                            </td>
                        </tr>';
                }
            }
        }
        return response()->json(array('html'=>$html));
    }
}
