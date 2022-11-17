<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReportFilterComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $form_id = "search_form";
    public $method = "POST";
    public $action = "";
    public $status = '';
    public function __construct($form_id="search_form", $method = 'POST', $action = '', $type = '')
    {
        $this->form_id = $form_id;
        $this->method  = $method;
        $this->action  = url($action);
        $this->type  = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $type = $this->type;
        return view('components.report-filter-component',compact('type'));
    }
}
