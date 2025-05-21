<?php

namespace App\Livewire\Card;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;

// este componente se encarga de mostrar el total de citas del dia y el total de citas confirmadas del dia
// en la vista se mostrara el total de citas y el total de citas confirmadas
// el componente se actualizara cada 5 segundos
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
