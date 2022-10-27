<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $form_id = "search_form";
    public $method = "POST";
    public $action = "";
    public $advance_filters =[
        /*'name'=> 'Name',
        'mobile' => 'Mobile',
        'Address' => 'Address' */
    ];
    public function __construct($form_id="search_form", $method = 'POST', $action = '')
    {
        $this->form_id = $form_id;
        $this->method  = $method;
        $this->action  = url($action);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
       
        return view('components.filter-component');
    }
}
