<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Paciente;

class CardPacientesNuevos extends Component
{
    public $pacientesNuevosMes = 0;
    public $totalPacientes = 0;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->pacientesNuevosMes = Paciente::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $this->totalPacientes = Paciente::count();
    }

    public function render()
    {
        return view('livewire.card.card-pacientes-nuevos');
    }
}
