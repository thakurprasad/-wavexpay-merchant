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
 
        \DB::enableQueryLog();        

         $data = Payment::select(
            DB::raw('sum(amount) as Amounts'),
            DB::raw('DATE_FORMAT(date_col, "%b %Y") as Dates')
        )->rightJoin('date_lists', 'date_lists.date_col', '=', DB::raw('date(payment_created_at)'));
         
        if($this->from_date && $this->to_date){
            $data = $data->orWhereBetween('date_lists.date_col', [$this->from_date, $this->to_date]);
        }else{
            $data = $data->orWhereBetween('date_lists.date_col', [date('Y') . '-01-01', date('Y') . '-12-31']);
        }

        $data = $data->groupBy('Dates')->orderBy('date_lists.date_col', 'ASC');

       $data = $data->get();
      #dd(\DB::getQueryLog()); // Show
        $AMOUNTS = [];
        $DATES = [];
        foreach ($data as $key => $row) {
            $AMOUNTS[] = $row->Amounts;
            $DATES[] = $row->Dates;
        }
        $amounts = implode(",",$AMOUNTS);
        $dates = implode(",",$DATES);
        return view('components.heigh-cart-component', ['amounts'=>$amounts, 'dates'=>$dates]);
    }
}
