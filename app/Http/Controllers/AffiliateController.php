<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;

class AffiliateController extends Controller
{
    public function affiliateAccounts(Request $request){
       return view('partner.affiliate-accounts');
    }

}
