<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FechaVisual extends Component
{
    public $fecha;

    public function __construct($fecha = null)
    {
        $this->fecha = $fecha ? \Carbon\Carbon::parse($fecha) : now();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fecha-visual');
    }
}
