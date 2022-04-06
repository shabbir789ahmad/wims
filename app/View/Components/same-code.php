<?php

namespace App\View\Components;
use App\Http\Traits\ProductTrait;
use Illuminate\View\Component;class same-code extends Component
{
    use ProductTrait;
    $categories;
    

  
    public function __construct($categories)
    {
        $this->categories=$categories;
        
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.same-code');
    }
}
