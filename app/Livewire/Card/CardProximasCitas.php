<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class CardProximasCitas extends Component
{
    public $proximasCitas;
    public $totalProximasCitas;

    public function mount()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.card.card-proximas-citas');
    }
    public function loadData()
    {
        // Cargar las próximas citas (ej. próximos 7 días)
        $this->proximasCitas = Cita::where('fecha', '>=', now())
            ->with(['paciente', 'profesional'])
            ->take(5)
            ->get();

        $this->totalProximasCitas = Cita::where('fecha', '>=', now())->count();
    }
}
