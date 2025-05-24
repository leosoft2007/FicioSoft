<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;

class FechaCompacta extends Component
{
    public $fecha;
    public $dayColors;
    public $bgColor;
    public $dayName;

    public function __construct($fecha = null)
    {
        $this->fecha = $fecha ? Carbon::parse($fecha) : now();
        $this->dayColors = [
            'Monday'    => 'bg-gradient-to-br from-blue-500 to-blue-300',
            'Tuesday'   => 'bg-gradient-to-br from-green-500 to-green-300',
            'Wednesday' => 'bg-gradient-to-br from-yellow-500 to-yellow-300',
            'Thursday'  => 'bg-gradient-to-br from-purple-500 to-purple-300',
            'Friday'    => 'bg-gradient-to-br from-red-500 to-red-300',
            'Saturday'  => 'bg-gradient-to-br from-pink-500 to-pink-300',
            'Sunday'    => 'bg-gradient-to-br from-orange-500 to-orange-300'
        ];
        $this->dayName = $this->fecha->format('l');
        $this->bgColor = $this->dayColors[$this->dayName] ?? 'bg-gradient-to-br from-gray-500 to-gray-300';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fecha-compacta');
    }
}
