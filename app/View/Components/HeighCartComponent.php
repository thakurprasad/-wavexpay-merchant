<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use  Carbon\Carbon;


class HeighCartComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $from_date;
    public $to_date;
    public function __construct( $fromDate = '' , $toDate = '')
    {
       
        $this->from_date = $fromDate;
        $this->to_date = $toDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
       
        $data = Payment::select(
            DB::raw('group_concat(amount) as Amounts'),
            DB::raw("group_concat(DATE_FORMAT(payment_created_at, '%d-%b')) as Dates")
        );
         
         /*$data = $data->whereMonth('payment_created_at', date('m'));*/

        
        if($this->from_date && $this->to_date){
            $data = $data->whereBetween('payment_created_at', [$this->from_date, $this->to_date]);
        }else{
            $data = $data->whereYear('payment_created_at', date('Y'));    
        }
        $data = $data->first();

        return view('components.heigh-cart-component', ['data'=>$data]);
    }
}
