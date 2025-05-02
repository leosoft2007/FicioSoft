<?php

namespace App\Livewire\Forms;

use App\Models\Disponible;
use App\Models\Paciente;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DisponibilidadPaciente extends Component
{
    public $paciente_id;
    public $dia = '';
    public $hora_inicio = '09:00';
    public $hora_fin = '10:00';
    public $eventos = [];
    public Paciente $paciente;

    public function mount($id)
    {
        $this->paciente = Paciente::find($id);
    }

    public function save()
    {
        $this->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'dia' => 'required|in:lun,mar,mie,jue,vie,sab,dom',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        Disponible::create([
            'paciente_id' => $this->paciente_id,
            'dia' => $this->dia,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
        ]);

        session()->flash('message', 'Disponibilidad guardada correctamente.');
        $this->reset('dia', 'hora_inicio', 'hora_fin');
    }
    public function ver($id)
    {
        
        $disponibilidades = Disponible::where('paciente_id', $id)->get();
        
        $diasSemana = [
            'lun' => 0,
            'mar' => 1,
            'mie' => 2,
            'jue' => 3,
            'vie' => 4,
            'sab' => 5,
            'dom' => 6,
        ];

        

        foreach ($disponibilidades as $disp) {
            if (!array_key_exists($disp->dia, $diasSemana)) continue;

            $fecha = Carbon::now()->startOfWeek()->addDays($diasSemana[$disp->dia]);

            $this->eventos[] = [
                'id'    => $disp->id,
                'title' => 'Disponible',
                'start' => $fecha->format('Y-m-d') . 'T' . Carbon::parse($disp->hora_inicio)->format('H:i:s'),
                'end'   => $fecha->format('Y-m-d') . 'T' . Carbon::parse($disp->hora_fin)->format('H:i:s'),
                'color' => '#10b981',
            ];


            
        }
      
        return $this->eventos;
    }



    public function store($st, $en)
        {

                $start = new Carbon($st);
                $end = new Carbon($en);

                $this->paciente->disponibles()->create([
                    'dia' => $start->dayOfWeekIso, // Lunes = 1
                    'hora_inicio' => $start->format('H:i:s'),
                    'hora_fin' => $end->format('H:i:s'),
                ]);

            

            $this->dispatch('eventoActualizado'); // para recargar el calendario
        }

        public function eliminar($id)
        {
            Disponible::findOrFail($id)->delete();
            $this->dispatch('eventoActualizado');
        }

    public function render()
    {
        $paciente = Paciente::find($this->paciente_id);
        $disponibilidad = $this->ver($this->paciente_id);
        

        return view('livewire.paciente.disponibilidad-paciente', compact('paciente'));
    }
}
