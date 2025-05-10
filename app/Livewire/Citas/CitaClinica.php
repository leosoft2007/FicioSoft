<?php

namespace App\Livewire\Citas;

use App\Models\Cita;
use App\Models\Factura;
use App\Models\Paciente;
use App\Models\Profesional;
use App\Models\Servicio;
use Livewire\Component;
use Illuminate\Support\Carbon;


class CitaClinica extends Component
{
    public $profesionalSeleccionado = null;
    public $clinicaId;
    public $citas = [];
    public $user;
    public $showModal = false;
    public $showModal2 = false;
    public $selectedCita = null;
    public $estado='';
    public $fecha;
    public $hora_inicio;
    public $hora_fin;
    public $errorMessage = null;
    protected $listeners = ['openCreateModal'];
    public $newCita = [
        'paciente_id' => '',
        'profesional_id' => '',
        'fecha' => '',
        'hora_inicio' => '',
        'hora_fin' => '',
        'observaciones' => ' ',
    ];
    public $pacientes= [];
    public $profesionales= [];

   

    public function mount()
    {
        $this->user = auth()->user();
        $this->clinicaId = $this->user->clinica_id;
        $this->pacientes = Paciente::where('clinica_id', $this->clinicaId)->get();
       
        // Cargar solo profesionales con al menos una cita
        $this->profesionales = Profesional::where('clinica_id', $this->clinicaId)
            ->whereHas('citas', function ($query) {
                // Opcional: filtra por fecha si lo necesitas
                // $query->whereDate('fecha', today()); // Filtrar hoy
            })
            ->get();


        $this->loadCitas();

    }

    public function openCreateModal($data)
{
    
    $start = \Carbon\Carbon::parse($data['start']);
    $end = \Carbon\Carbon::parse($data['end']);

    $this->newCita['fecha'] = $start->toDateString();
    $this->newCita['hora_inicio'] = $start->format('H:i');
    $this->newCita['hora_fin'] = $end->format('H:i');

    $this->showModal2 = true;
}

public function guardarCita()
{
    $this->validate([
        'newCita.paciente_id' => 'required|exists:pacientes,id',
        'newCita.profesional_id' => 'required|exists:profesionals,id',
        'newCita.fecha' => 'required|date',
        'newCita.hora_inicio' => 'required|date_format:H:i',
        'newCita.hora_fin' => 'required|date_format:H:i|after:newCita.hora_inicio',
        'newCita.observaciones' => 'nullable|string|max:255',
    ]);

    // Crear la cita
  
    
    // Verificar si la cita ya existe
    $existingCita = Cita::where('fecha', $this->newCita['fecha'])
        ->where('hora_inicio', $this->newCita['hora_inicio'])
        ->where('hora_fin', $this->newCita['hora_fin'])
        ->where('clinica_id', $this->clinicaId)
        ->first();

    if ($existingCita) {
        session()->flash('error', 'Ya existe una cita en este horario.');
        return;
    }
    // capturar el error de la creación de la cita
    try {
        $cita = Cita::create([
            'paciente_id' => $this->newCita['paciente_id'],
            'profesional_id' => $this->newCita['profesional_id'],
            'fecha' => $this->newCita['fecha'],
            'hora_inicio' => $this->newCita['hora_inicio'],
            'hora_fin' => $this->newCita['hora_fin'],
            'observaciones' => $this->newCita['observaciones'],
            'estado' => 'pendiente',
            'clinica_id' => $this->clinicaId,
            'tipo' => 'individual', // o 'grupal' según tu lógica
        ]);
                        } catch (\Exception $e) {
                            $this->errorMessage = 'Error al crear la cita: ' . $e->getMessage();
                            \Log::error('Error al crear cita: ' . $e->getMessage(), [
                                'trace' => $e->getTraceAsString()
                            ]);
                            return;
                        }
                    $this->loadCitas(); // Recargar citas    
                    $this->closemodal2();
                
                $this->reset('newCita', 'showModal2');
                $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
            }
    public function filtrarPorProfesional($profesionalId)
    {
        
        $this->profesionalSeleccionado = $profesionalId;
        $this->loadCitas();
    }
    public function loadCitas()
    {
        // Usar solo los campos necesarios para evitar sobrecarga
        $query = Cita::with([
            'paciente:id,nombre,apellido',
            'profesional:id,nombre,color'
        ])
        ->select([
            'id', 'paciente_id', 'profesional_id', 'fecha', 'hora_inicio', 'hora_fin',
            'observaciones', 'estado', 'tipo', 'clinica_id'
        ])
        ->where('clinica_id', $this->clinicaId);
    
        if ($this->profesionalSeleccionado) {
            $query->where('profesional_id', $this->profesionalSeleccionado);
        }
        
    
        $this->citas = $query->get()->map(function ($cita) {
            $pacienteNombre = $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido;
            $profesionalNombre = $cita->profesional?->nombre;
            $color = $cita->profesional?->color ?? '#3b82f6';

            return [
                'id' => $cita->id,
                'title' => ($cita->tipo === 'grupal' ? '👥 ' : '👤 ') . ($pacienteNombre ?? 'Sin paciente') . ' - ' . ($profesionalNombre ?? ''),
                'start' => $cita->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i:s'),
                'end' => $cita->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($cita->hora_fin)->format('H:i:s'),
                'borderColor' => '#ccc',
                'classNames' => ['evento-' . $cita->estado],
                'extendedProps' => [
                    'tipo' => $cita->tipo,
                    'observaciones' => $cita->observaciones,
                    'profesional' => [
                        'color' => $color,
                    ],
                ],
            ];
        })->toArray();
    
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
    
        return $this->citas;
    }

    public function openCitaModal($data)
    {
        // Buscar la cita completa en la base de datos
        $cita = Cita::with(['paciente', 'profesional'])->find($data['citaId']);
        
        if ($cita) {
            $this->selectedCita = [
                'id' => $cita->id,
                'paciente' => $cita->paciente ? $cita->paciente->toArray() : null,
                'profesional' => $cita->profesional ? $cita->profesional->toArray() : null,
                'fecha' => Carbon::parse($cita->fecha)->format('Y-m-d'), // Formato correcto para input date
                'hora_inicio' => Carbon::parse($cita->hora_inicio)->format('H:i'), // Formato correcto para input time
                'hora_fin' => Carbon::parse($cita->hora_inicio)->format('H:i'),
                'tipo' => $cita->tipo,
                'estado' => (string) $cita->estado,
                'observaciones' => $cita->observaciones,
            ];
              //dd($this->selectedCita);
              $this->fecha = Carbon::parse($cita->fecha)->format('Y-m-d');
              $this->hora_inicio = Carbon::parse($cita->hora_inicio)->format('H:i');
              $this->hora_fin = Carbon::parse($cita->hora_fin)->format('H:i');

            $this->showModal = true;
           // dd($this->showModal);
        }
        $this->estado =$cita->estado;
    }

    public function closeModal()
    {
        
        $this->showModal = false;
        $this->selectedCita = null;
        
         $this->dispatch('modalClosed');
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
      
    }
    public function closeModal2()
    {
      
        $this->showModal2 = false;
        $this->selectedCita = null;
        
         $this->dispatch('modalClosed');
         $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
      
    }
  

    public function saveCita()
    {
        $this->validate([
            'selectedCita.estado' => 'required|in:pendiente,confirmado,cancelado',
        ]);

        $cita = Cita::find($this->selectedCita['id']);
        
        if ($cita) {
            $cita->update([
                'estado' => $this->selectedCita['estado'],
                'observaciones' => $this->selectedCita['observaciones'] ?? null,
                'fecha' => $this->selectedCita['fecha'],
                'hora_inicio' => $this->selectedCita['hora_inicio'],
                'hora_fin' => $this->selectedCita['hora_fin'],
                
            ]);

            
            
            $this->loadCitas(); // Recargar citas
            $this->closeModal();
            
            // Emitir evento para actualizar el calendario
            $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        }
    }

    public function deleteCita()
{
    if ($this->selectedCita && isset($this->selectedCita['id'])) {
        Cita::find($this->selectedCita['id'])?->delete();
        $this->showModal = false;
        $this->selectedCita = null;
        $this->loadCitas();
        $this->dispatch('modalClosed');
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        }
}

    public function render()
    {

        return view('livewire.citas.cita-clinica');
    }

}
