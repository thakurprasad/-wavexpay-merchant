<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use DB;

class AffiliateController extends Controller
{
    public function affiliateAccounts(Request $request){
       return view('partner.affiliate-accounts');
    }

    public function createReferralLink(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $merchant_details = DB::table('merchants')->where('id',$merchant_id)->first();
        if($merchant_details->referral_link_text=='')
        {
            $link_text = substr(Crypt::encryptString($merchant_id.'/'.date('Y-m-d H:i:s')),5,10);
            DB::table('merchants')->where('id',$merchant_id)->update(array('referral_link_text'=>$link_text));
        }
        else 
        {
            $link_text = $merchant_details->referral_link_text;
        }
        return response()->json(array('link_text'=>$link_text));
    }

}
