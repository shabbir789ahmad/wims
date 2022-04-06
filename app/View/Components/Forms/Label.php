<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Label extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $icon;
    public $name;

    public function __construct($icon, $name) {
        
        $this->icon = $icon;
        $this->name = $name;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */

    public function render() {

        return view('components.forms.label');

    }
}
