<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title = '';
    public $value = 0;
    public $type  = 1;
    public $icon  = 'calendar';
    public function __construct($type = 1, $title='', $value = 0, $icon= 'calendar')
    {
        $this->title = $title;
        $this->value = $value;
        $this->type = $type;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.my-card');
    }
}
