<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\Dashboardheader;

class Notification extends Component
{
    
    //$title = '';
    //$description = '';
    public function __construct($title = '', $description = '')
    {
         //$this->title = $title;
         //$this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = Dashboardheader::find(1);
        $title = $data->title;
        $description = $data->description;
        return view('components.notification', ['title' => $title, 'description' => $description]);
    }
}
