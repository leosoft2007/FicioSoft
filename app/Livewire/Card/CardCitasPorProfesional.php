<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Profesional;
use Illuminate\Support\Facades\Auth;

class CardCitasPorProfesional extends Component
{
     public $citasPorProfesional = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->citasPorProfesional = Profesional::withCount(['citas' => function ($query) {
                $query->whereDate('fecha', today());
            }])
            ->whereHas('citas', function ($query) {
                $query->whereDate('fecha', today());
            })
            ->orderBy('citas_count', 'desc')
            ->get()
            ->map(function ($profesional) {
                return [
                    'nombre' => $profesional->nombre,
                    'apellido' => $profesional->apellido ?? '',
                    'especialidad' => $profesional->especialidad ?? 'Sin especialidad',
                    'citas_count' => $profesional->citas_count ?? 0
                ];
            });
    }

    public function render()
    {
        
        return view('livewire.card.card-citas-por-profesional');
    }
}
