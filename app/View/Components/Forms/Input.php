<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $error;

    public function __construct() {
        
        if (session()->has('errors')) {
            
            $this->error = session('errors');

        }
    }

    public function checkError($field) {
        
        return ( isset($this->error) && $this->error->has($field) ) ? ' is-invalid' : '';

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */

    public function render() {

        return view('components.forms.input');

    }
}
