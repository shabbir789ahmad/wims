<?php

namespace App\View\Components;

use Illuminate\View\Component;

class same-code2 extends Component
{
    
    $brands;
    public function __construct($brands;)
    {
        $this->brands = $brands;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.same-code2');
    }
}
