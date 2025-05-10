<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectSearch extends Component
{
    public $options;
    public $value;
    public $name;
    public $placeholder;

    public function __construct($options = [], $value = null, $name = 'select', $placeholder = 'Seleccione...')
    {
        $this->options = $options;
        $this->value = $value;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-search');
    }
}
