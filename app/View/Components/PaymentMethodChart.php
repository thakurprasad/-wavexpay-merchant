<?php

namespace App\View\Components;

use Illuminate\View\Component;


use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use  Carbon\Carbon;
use App\Models\DateList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PaymentMethodChart extends Component
{
   
    public $from_date;
    public $to_date;
    public $get;

    public function __construct()
    {
        $this->get = isset($_GET) ? array_filter($_GET) : [];  
        $this->from_date = date('Y') . '-01-01';
        $this->to_date = date('Y') . '-12-31';
    }

    public function getData(){

        if(isset($this->get['daterangepicker'])){
            $date_arr = explode("-",$this->get['daterangepicker']);
            if(count($date_arr)>1){
              $this->from_date =  date('Y-m-d', strtotime($date_arr[0]));
              $this->to_date   =  date('Y-m-d', strtotime($date_arr[1]));             
            } 
        }
        
        $get = $this->get;
        #\DB::enableQueryLog();

         $data = Payment::select(
            'payment_method',
            DB::raw('sum(wxp_payments.amount) as amounts'),            

        )->join('merchants', function($join){
            $join = $join->on( 'merchants.id', '=', 'payments.merchant_id');
         })->where('merchants.id', session()->get('merchant') );
         
        if($this->from_date && $this->to_date){
            $data = $data->whereBetween('payments.payment_created_at', [$this->from_date, $this->to_date]);
        }

        if(isset($get['status'])) {
            $data = $data->where('payments.status', $get['status']);
        }else{
            $data = $data->where('payments.status', 'captured');
        }
        return $data = $data->groupBy('payment_method')->orderBy('payments.payment_method', 'ASC')->get();

    }



    public function render()
    {
        $data      = $this->getData();
        $card = 0;
        $upi = 0;
        $wallet = 0;
        $netbanking = 0;
        foreach ($data as $key => $row) {
            if($row->payment_method == 'card'){
                $card = $row->amounts;
            }
            if($row->payment_method == 'upi'){
                $upi = $row->amounts;
            }
            if($row->payment_method == 'wallet'){
                $wallet = $row->amounts;
            }
            if($row->payment_method == 'netbanking'){
                $netbanking = $row->amounts;
            }
        }
        return view('components.payment-method-chart', ['upi'=>$upi, 'card'=>$card, 'netbanking'=>$netbanking, 'wallet'=>$wallet]);

    }
}
