<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Razorpay\Api\Api;
use DateTime;
use DB;
use Session;

class TransactionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');
        //$api = new Api($api_key, $api_secret);
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_payments = $api->payment->all();
        $options = ['count'=>50, 'skip'=>0];
        $all_orders = $api->order->all($options);
        $all_refunds = $api->refund->all($options);
        //CURL call for disputes
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

        if(!empty($all_payments->items)){
            foreach($all_payments->items as $payment){
                $get_payment_details = DB::table('payments')->where('payment_id',$payment->id)->first();
                if(!empty($get_payment_details)){
                    DB::table('payments')->where('payment_id',$payment->id)->update(array('amount'=>$payment->amount,'email'=>$payment->email,'contact'=>$payment->contact,'payment_created_at'=>date('Y-m-d',$payment->created_at),'status'=> $payment->status,'payment_method'=>$payment->method,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                }else{
                    DB::table('payments')->insert(array('payment_id'=>$payment->id,'amount'=>$payment->amount,'email'=>$payment->email,'contact'=>$payment->contact,'payment_created_at'=>date('Y-m-d',$payment->created_at),'status'=> $payment->status,'payment_method'=>$payment->method,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                }
            }
        }

        if(!empty($all_orders->items)){
            foreach($all_orders->items as $order){
                $get_order_details = DB::table('orders')->where('order_id',$order->id)->first();
                if(!empty($get_order_details)){
                    DB::table('orders')->where('order_id',$order->id)->update(array('amount'=>$order->amount,'attempts'=>$order->attempts,'receipt'=>$order->receipt,'order_created_at'=>date('Y-m-d',$order->created_at),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                }else{
                    DB::table('orders')->insert(array('order_id'=>$order->id,'amount'=>$order->amount,'attempts'=>$order->attempts,'receipt'=>$order->receipt,'order_created_at'=>date('Y-m-d',$order->created_at),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                }
            }
        }

        if(!empty($all_refunds->items)){
            foreach($all_refunds->items as $refund){              
                $get_refunds_details = DB::table('refunds')->where('refund_id',$refund->id)->first();
                if(!empty($get_order_details)){
                    DB::table('refunds')->where('refund_id',$refund->id)->update(array('amount'=>$refund->amount,'currency'=>$refund->currency,'payment_id'=>$refund->payment_id,'receipt'=>$refund->receipt,'status'=>$refund->status,'batch_id'=>$refund->batch_id,'created_at'=>date('Y-m-d H:i:s',$refund->created_at)));
                }else{
                    DB::table('refunds')->insert(array('refund_id'=>$refund->id,'amount'=>$refund->amount,'currency'=>$refund->currency,'payment_id'=>$refund->payment_id,'receipt'=>$refund->receipt,'status'=>$refund->status,'batch_id'=>$refund->batch_id,'created_at'=>date('Y-m-d H:i:s',$refund->created_at)));
                }             
            }
        }

        if(!empty($all_disputes['items']))
        {
            foreach($all_disputes['items'] as $dispute)
            {
                $get_disputes_details = DB::table('disputes')->where('dispute_id',$dispute->id)->first();
                if(!empty($get_order_details)){
                    DB::table('disputes')->where('dispute_id',$dispute->id)->update(array('amount'=>$dispute->amount,'payment_id'=>$dispute->payment_id,'reason_code'=>$refund->reason_code,'status'=>$refund->status,'respond_by'=>$dispute->respond_by,'created_at'=>date('Y-m-d H:i:s',$refund->created_at)));
                }else{
                    DB::table('disputes')->insert(array('dispute_id'=>$dispute->id,'amount'=>$dispute->amount,'payment_id'=>$dispute->payment_id,'reason_code'=>$refund->reason_code,'status'=>$refund->status,'respond_by'=>$dispute->respond_by,'created_at'=>date('Y-m-d H:i:s',$refund->created_at)));
                }
            }
        }        
    }
}