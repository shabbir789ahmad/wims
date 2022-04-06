<?php

namespace App\View\Components;

use Illuminate\View\Component;

class same-code3 extends Component
{
    $products;
    public function __construct($products)
    {
        $this->products=$products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.same-code3');
    }
}
