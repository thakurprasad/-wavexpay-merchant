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
        //return 0;
        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');
        //$api = new Api($api_key, $api_secret);
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $all_payments = $api->payment->all();
        $options = ['count'=>50, 'skip'=>0];
        $all_orders = $api->order->all($options);

        if(!empty($all_payments->items)){
            foreach($all_payments->items as $payment){
                $get_payment_details = DB::table('payments')->where('payment_id',$payment->id)->first();
                if(!empty($get_payment_details)){
                    DB::table('payments')->where('payment_id',$payment->id)->update(array('amount'=>$payment->amount,'email'=>$payment->email,'contact'=>$payment->contact,'payment_created_at'=>date('Y-m-d',$payment->created_at),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                }else{
                    DB::table('payments')->insert(array('payment_id'=>$payment->id,'amount'=>$payment->amount,'email'=>$payment->email,'contact'=>$payment->contact,'payment_created_at'=>date('Y-m-d',$payment->created_at),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
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
        echo 'Transaction Data Inserted Successfully!!';
    }
}
