<?php

namespace App\Livewire\Citas;

use App\Models\Cita;
use Livewire\Component;
use Illuminate\Support\Carbon;


class CitaClinica extends Component
{
    public $clinicaId;
    public $citas = [];
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
        $this->clinicaId = $this->user->clinica_id;
        $this->loadCitas();
    }

    public function loadCitas()
    {

        $this->citas = Cita::with(['paciente', 'profesional'])
            ->where('clinica_id', $this->clinicaId)
            ->get()
            ->map(function ($cita) {
                return [
                    'id' => $cita->id,
                    //'title' => ($cita->tipo === 'grupal' ? '[Grupo] ' : '') . ($cita->paciente?->nombre . ' ' . $cita->paciente?->apellido ?? 'Sin paciente') . ' - ' . ($cita->profesional?->nombre ?? ''),
                    'title' => ($cita->tipo === 'grupal' ? '👥 ' : '👤 ') . ($cita->paciente?->nombre . ' ' . $cita->paciente?->apellido ?? 'Sin paciente') . ' - ' . ($cita->profesional?->nombre ?? ''),
                    'start' => $cita->fecha->format('Y-m-d') . 'T' . Carbon::parse($cita->hora_inicio)->format('H:i:s'),
                    'end'   => $cita->fecha->format('Y-m-d') . 'T' . Carbon::parse($cita->hora_fin)->format('H:i:s'),
                   // 'backgroundColor' => $cita->tipo === 'grupal' ? '#c7d2fe' : '#bbf7d0',
                    'color' => $cita->tipo === 'grupal' ? '#10b981' : '#3b82f6', // verde vs azul
                    'borderColor' => '#ccc',
                    'tipo' => $cita->tipo,
                    'classNames' => ['evento-' . $cita->estado],
                ];
            })->toArray();
           // dd($this->citas);
           return $this->citas;
    }

    public function render()
    {
        return view('livewire.citas.cita-clinica');
    }
}
