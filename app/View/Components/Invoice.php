<?php

namespace App\View\Components;

use Illuminate\View\Component;

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
        echo $this->invoice_id;exit;
        return view('components.invoice',compact('invoice_details'));
    }
}
