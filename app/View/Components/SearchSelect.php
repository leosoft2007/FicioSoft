<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchSelect extends Component
{
    public $name;
    public $options;
    public $selected;
    public $placeholder;
    public $id;
    public $disabled;
    public $required;
    public $wireModel;

    public function __construct(
        $name,
        $options = [],
        $selected = null,
        $placeholder = 'Buscar...',
        $id = null,
        $disabled = false,
        $required = false,
        $wireModel = null
    ) {
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
        $this->id = $id ?? str_replace(['[', ']'], ['-', ''], $name);
        $this->disabled = $disabled;
        $this->required = $required;
        $this->wireModel = $wireModel;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-select');
    }
}
