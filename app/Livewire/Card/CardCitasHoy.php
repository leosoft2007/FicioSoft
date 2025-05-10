<?php

namespace App\Livewire\Card;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;

class CardCitasHoy extends Component
{
    public $citasHoy = 0;
    public $citasConfirmadasHoy = 0;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->citasHoy = Cita::where('fecha', today())
            ->count();

        $this->citasConfirmadasHoy = Cita::where('fecha', today())
            ->where('estado', 'confirmado')
            ->count();
    }
    public function render()
    {
        return view('livewire.card.card-citas-hoy');
    }
}
