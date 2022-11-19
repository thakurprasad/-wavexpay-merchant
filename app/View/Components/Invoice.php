<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DB;

class Invoice extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->invoice_id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $invoice_details = DB::table('invoices')->where('id',$this->invoice_id)->first();
        $invoice_item_details = DB::table('invoice_items')->where('invoice_id',$this->invoice_id)->get();
        return view('components.invoice',compact('invoice_details','invoice_item_details'));
    }
}
