<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Profesional;

class CardProfesionalesActivos extends Component
{
     public $profesionalesActivos = 0;
    public $profesionalesDisponibles = 0;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->profesionalesActivos = Profesional::count();
        $this->profesionalesDisponibles = Profesional::whereHas('citas', function ($query) {
            $query->where('fecha', today())->where('estado', 'disponible');
        })->count();
    }

    public function render()
    {
        return view('livewire.card.card-profesionales-activos');
    }
}
