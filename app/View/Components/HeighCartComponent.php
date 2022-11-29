<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class HeighCartComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $from_date;
    public $to_date;
    public function __construct( $from_date = null, $to_date = null)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
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

        $data = $data->whereYear('payment_created_at', date('Y'));
        if($this->from_date && $this->to_date){
            $data = $data->whereBetween('payment_created_at', [$this->from_date, $this->to_date]);
        }
        $data = $data->first();

        return view('components.heigh-cart-component', ['data'=>$data]);
    }
}
