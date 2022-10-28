<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $status = '';
    public function __construct($status = '')
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $options = [];
        if($this->status == 'payments'){
            $options = ['authorized' => 'Authorized', 'captured' => 'Captured', 
                        'refunded' => 'Refunded', 'failed' => 'Failed'];
        }
        if($this->status == 'refunds'){
            $options = ['created'=>'Created', 'accepted'=>'Accepted', 'paid'=>'Paid'];
        }
        if($this->status == '..'){
            $options = [];
        }
        if($this->status == ''){
            return false;
        }
        return view('components.dropdown', ['options'=> $options]);
    }
}