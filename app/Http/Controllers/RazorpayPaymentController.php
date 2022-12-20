<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\CheckoutPaymentsRazorpay;
use App\Models\Payment;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;
use Helper;

class RazorpayPaymentController extends Controller
{

    public function getWaveXpay_Key($payment_link_id){     
    #dd($payment_link_idv);
       $row = DB::select("SELECT 
                    w.id as wavexpay_api_key_id,
                    pl.wavexpay_api_key_id as wavexpay_api_key_id_,
                    pl.merchant_id, 
                    pl.amount,
                    if(pl.transaction_mode = 'live', w.live_api_key, w.test_api_key) as api_key,
                    if(pl.transaction_mode = 'live', w.live_api_secret, w.live_api_secret) as api_secret
                    FROM `wxp_payment_link` as pl 
                    JOIN wxp_wavexpay_api_keys w ON w.id = pl.wavexpay_api_key_id
                    WHERE pl.payment_link_id = '".$payment_link_id."' ");  
        
        return $row = $row[0];
    }

    public function orderIdGenerate(Request $request){
         $payment_link_id = $request->payment_link_id;
         $row = DB::select("SELECT 
                    pl.merchant_id, 
                    pl.amount,
                    if(pl.transaction_mode = 'live', w.live_api_key, w.test_api_key) as api_key,
                    if(pl.transaction_mode = 'live', w.live_api_secret, w.live_api_secret) as api_secret
                    FROM `wxp_payment_link` as pl 
                    JOIN wxp_wavexpay_api_keys w ON w.id = pl.wavexpay_api_key_id
                    WHERE pl.payment_link_id = '".$payment_link_id."' ");  
        $row = $row[0];
        $merchant_id = $row->merchant_id;
        $link_text = substr(Crypt::encryptString($merchant_id.'/'.date('Y-m-d H:i:s').rand(10000,99999)),5,10);
		
        Session::put('payment_link_id', $payment_link_id);

        $api = new Api($row->api_key, $row->api_secret);

        $order = $api->order->create(array('receipt' => 'order_rcptid'.$link_text, 'amount' => $row->amount * 100, 'currency' => 'INR')); // Creates order
        //return response()->json(['order_id' => $order['id']]);
        return $this->sendResponse(['order_id' => $order['id']], 'Data retrieved successfully.');
	}

    public function storePayment(Request $request){
        ///return $request->input();
       $key =  $this->getWaveXpay_Key($request->input('payment_link_id'));

        if(!$key){
            die('Invalid payment_id');
        }
        $wavexpay_api_key_id = $key->wavexpay_api_key_id;

        $api = new Api($key->api_key, $key->api_secret);
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($request->input('razorpay_payment_id'));        
        //print_r($payment);exit;

        if (!empty($payment) && $payment['status'] == 'captured') {
            $paymentId = $payment['id'];
            $amount = $payment['amount'];
            $currency = $payment['currency'];
            $status = $payment['status'];
            $entity = $payment['entity'];
            $orderId = $payment['order_id'];
            $invoiceId = $payment['invoice_id'];
            $method = $payment['method'];
            $bank = $payment['bank'];
            $wallet = $payment['wallet'];
            $email = $payment['email'];
            $contact = $payment['contact'];
            $bankTranstionId = isset($payment['acquirer_data']['bank_transaction_id']) ? $payment['acquirer_data']['bank_transaction_id'] : '';
        } else {
            return redirect()->back()->with('error', 'Something went wrong, Please try again later!');
        }
        try {
            // Payment detail save in database
            $payment = new CheckoutPaymentsRazorpay;
            $payment->transaction_id = $paymentId;
            $payment->amount = $amount / 100;
            $payment->currency = $currency;
            $payment->entity = $entity;
            $payment->status = $status;
            $payment->order_id = $orderId;
            $payment->method = $method;
            $payment->bank = $bank;
            $payment->wallet = $wallet;
            $payment->bank_transaction_id = $bankTranstionId;
            $saved = $payment->save();


            /*$to = "".$session_array['txtEmail'].", admin@gauvansh.com";
            $subject = "Wavexpay Payment";
            $message="<h1>Thank You!!</h1>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <info@gauvansh.com>' . "\r\n";
            mail($to,$subject,$message,$headers);*/
            $payment_link_id = Session::get('payment_link_id');
            $payment_link_table_array = array('payment_id' => $paymentId,'status' => 'paid');
            DB::table('payment_link')->where('payment_link_id',$payment_link_id)->update($payment_link_table_array);
            Session::forget('payment_link_id');

            $payment_table_array = array(
                'merchant_id' => session()->get('merchant'),
                'payment_id' => $paymentId,
                'amount' => $amount/100,
                'email' => $email,
                'contact' => $contact,
                'payment_created_at' => date('Y-m-d H:i:s'),
                'status' => $status,
                'payment_method' => $method,
                'created_at' => date('Y-m-d H:i:s'),
                'wavexpay_api_key_id' => $wavexpay_api_key_id,
            );

            Payment::create($payment_table_array);

        } catch (Exception $e) {
            return $e->getMessage();
            $saved = false;
        }
        if ($saved) {
            return redirect('/transactions/payments')->with('success', __('Payment Detail store successfully!'));
        } else {
            return back()->withInput()->with('error', __('Something went wrong, Please try again later!'));
        }
		
    }
}
