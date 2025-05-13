<?php

namespace App\Livewire\Grupos;

use App\Models\Cita;
use App\Models\CitaGrupal;
use App\Models\CitaGrupalOcurrencia;
use App\Models\Paciente;
use App\Models\Profesional;
use Livewire\Component;
use Illuminate\Support\Carbon;

use function Pest\Laravel\delete;

class Grupo extends Component
{
    public $showOcurrenciaUnicaModal = false;
    public $ocurrencia = [
        'fecha' => '',
        'hora_inicio' => '',
        'hora_fin' => '',
        'participantes' => [], // IDs
        'cupo_maximo' => 0,
    ];

    public $profesionalNombre;
    public $nombreGrupo;


    public $tipoEdicion = null; // 'todas' o 'una'
    public $ocurrenciaId = null;
    public $showOcurrenciaModal = false;
    public string $modoFormulario = 'editar'; // o 'editar'
    public $editCitaGrupalId = null;
    public $showGrupalModal = false;
    public $newCitaGrupal = [
        'profesional_id' => null,
        'fecha_inicio' => null,
        'fecha_fin' => null,
        'hora_inicio' => null,
        'hora_fin' => null,
        'frecuencia' => 'semanal',
        'dias_semana' => [],
        'cupo_maximo' => 0,
        'observaciones' => '',
        'pacientes' => [],
        'nombre'
    ];


    public $profesionalSeleccionado = null;
    public $clinicaId;
    public $citas = [];
    public $user;
    public $showModal = false;
    public $showModal2 = false;
    public $selectedCita = null;
    public $estado = '';
    public $fecha;
    public $hora_inicio;
    public $hora_fin;
    public $errorMessage = null;
    protected $listeners = ['openCreateModal', 'openCitaGrupalModal', 'openCitaModal', 'abrirOcurrencia'];

    public $datosSeleccion;
    public $mostrarSelectorTipoCita = false;
    public $newCita = [
        'paciente_id' => '',
        'profesional_id' => '',
        'fecha' => '',
        'hora_inicio' => '',
        'hora_fin' => '',
        'observaciones' => ' '

    ];

    public $pacientes = [];
    public $profesionales = [];

    public function openGrupalocurrencia($a, $eventData)
    {

        $this->dispatch( $a , $eventData);
    }

    public function closeGrupalModal() {}

    public function mount()
    {
        $this->user = auth()->user();
        $this->clinicaId = $this->user->clinica_id;
        $this->pacientes = Paciente::where('clinica_id', $this->clinicaId)->get();

        // Cargar solo profesionales con al menos una cita
        $this->profesionales = Profesional::where('clinica_id', $this->clinicaId)->get();


        $this->loadCitas();
    }

    public function loadCitas()
    {
        $citasIndividuales = Cita::paraCalendario($this->clinicaId, $this->profesionalSeleccionado);
        $citasGrupales = CitaGrupalOcurrencia::paraCalendario($this->clinicaId, $this->profesionalSeleccionado);

        $this->citas = $citasIndividuales->merge($citasGrupales)->toArray();
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

    public function openCreateGrupalModal($data)
    {
        $this->modoFormulario = 'crear';

        $this->reset('newCitaGrupal');
        $start = \Carbon\Carbon::parse($data['start']);
        $end = \Carbon\Carbon::parse($data['end']);

        $this->newCitaGrupal['fecha_inicio'] = $start->toDateString();
        $this->newCitaGrupal['hora_inicio'] = $start->format('H:i');
        $this->newCitaGrupal['hora_fin'] = $end->format('H:i');



        $this->showGrupalModal = true;
    }

    protected function reglasCitaGrupal(): array
    {
        return [
            'newCitaGrupal.profesional_id' => 'required|exists:profesionals,id',
            'newCitaGrupal.nombre' => 'string',
            'newCitaGrupal.fecha_inicio' => 'required|date',
            'newCitaGrupal.fecha_fin' => 'nullable|date|after_or_equal:newCitaGrupal.fecha_inicio',
            'newCitaGrupal.hora_inicio' => 'required',
            'newCitaGrupal.hora_fin' => 'required|after:newCitaGrupal.hora_inicio',
            'newCitaGrupal.dias_semana' => 'required|array|min:1',
            'newCitaGrupal.frecuencia' => 'required|in:semanal,quincenal',
            'newCitaGrupal.cupo_maximo' => 'required|integer|min:1',
            'newCitaGrupal.pacientes' => 'nullable|array|max:' . $this->newCitaGrupal['cupo_maximo'],
        ];
    }

    protected function crearCitaGrupal(): CitaGrupal
    {
        $this->newCitaGrupal['dias_semana'] = array_map('intval', $this->newCitaGrupal['dias_semana']);

        $cita = CitaGrupal::create([
            'profesional_id' => $this->newCitaGrupal['profesional_id'],
            'nombre' => $this->newCitaGrupal['nombre'],
            'fecha_inicio' => $this->newCitaGrupal['fecha_inicio'],
            'fecha_fin' => $this->newCitaGrupal['fecha_fin'],
            'hora_inicio' => $this->newCitaGrupal['hora_inicio'],
            'hora_fin' => $this->newCitaGrupal['hora_fin'],
            'frecuencia' => $this->newCitaGrupal['frecuencia'],
            'cupo_maximo' => $this->newCitaGrupal['cupo_maximo'],
            'observaciones' => $this->newCitaGrupal['observaciones'] ?? '',
            'dias_semana' =>  $this->newCitaGrupal['dias_semana'],
        ]);

        $cita->asignarPacientes($this->newCitaGrupal['pacientes'] ?? []);

        return $cita;
    }

    public function createCitaGrupal()
    {
        $this->validate($this->reglasCitaGrupal());

        $this->crearCitaGrupal();
        $this->finalizarAccionGrupal('Grupo creado exitosamente.');

    }

    protected function finalizarAccionGrupal(string $mensaje)
    {
        $this->reset('newCitaGrupal');
        $this->showGrupalModal = false;
        $this->loadCitas();
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        session()->flash('message', $mensaje);
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


    public function removePaciente($id)
    {
        $this->newCitaGrupal['pacientes'] = array_filter($this->newCitaGrupal['pacientes'], fn($pid) => $pid !== $id);
    }

    public function addPaciente($id)
    {
        if (count($this->newCitaGrupal['pacientes']) < $this->newCitaGrupal['cupo_maximo']) {
            if (!in_array($id, $this->newCitaGrupal['pacientes'])) {
                $this->newCitaGrupal['pacientes'][] = $id;
            }
        } else {
            $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => 'Se alcanzó el cupo máximo']);
        }
    }

    public function validateStep($step)
    {
        $rules = match ($step) {
            'general' => [
                'newCitaGrupal.profesional_id' => 'required',
                'newCitaGrupal.fecha_inicio' => 'required|date',
                'newCitaGrupal.fecha_fin' => 'nullable|date|after_or_equal:newCitaGrupal.fecha_inicio',
                'newCitaGrupal.hora_inicio' => 'required',
                'newCitaGrupal.hora_fin' => 'required|after:newCitaGrupal.hora_inicio',
                'newCitaGrupal.dias_semana' => 'required|array|min:1',
                'newCitaGrupal.frecuencia' => 'required|in:semanal,quincenal',
            ],
            'opciones' => [
                'newCitaGrupal.cupo_maximo' => 'required|integer|min:1',
            ],
            'pacientes' => [
                'newCitaGrupal.pacientes' => 'nullable|array|max:' . $this->newCitaGrupal['cupo_maximo'],
            ],
            default => [],
        };

        $validated = $this->validate($rules);

        return true; // necesario para Alpine
    }

    public function seleccionarTipoCita($tipo)
    {
        $this->mostrarSelectorTipoCita = false;

        if ($tipo === 'individual') {
            $this->openCreateModal($this->datosSeleccion);
        } else {
            $this->openCreateGrupalModal($this->datosSeleccion);
        }
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
        $this->estado = $cita->estado;
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


    #[On('openCitaGrupalModal')]
    public function openCitaGrupalModal($eventData)
    {
        $this->modoFormulario = 'editar';
       // 2. Buscar la ocurrencia con su relación
        $ocurrencia = $this->buscaIdenocurencia($eventData);

        $cita = $ocurrencia->citaGrupal;

        // 3. Cargar la cita grupal completa para edición
        $this->editCitaGrupalId = $cita->id;
        $this->newCitaGrupal = [
            'profesional_id' => $cita->profesional_id,
            'fecha_inicio' => Carbon::parse($cita->fecha_inicio)->format('Y-m-d'), // Formato correcto para input date
            'fecha_fin' => Carbon::parse($cita->fecha_fin)->format('Y-m-d'),
            'hora_inicio' => $cita->hora_inicio,
            'hora_fin' => $cita->hora_fin,
            'frecuencia' => $cita->frecuencia,
            'dias_semana' => $cita->dias_semana,
            'cupo_maximo' => $cita->cupo_maximo,
            'observaciones' => $cita->observaciones,
            'pacientes' => $cita->pacientesIndirectos()->pluck('id')->toArray(), // todos los pacientes
            'nombre' => $cita->nombre,
        ];

        // Mostrar modal
        $this->showGrupalModal = true;
    }


    public function updateCitaGrupal()
    {
        $this->validate($this->reglasCitaGrupal());

        $cita = CitaGrupal::findOrFail($this->editCitaGrupalId);

        $cita->delete();



        $this->crearCitaGrupal();

        $this->finalizarAccionGrupal('Grupo Actualizado exitosamente.');

    }

    #[On('abrirOcurrencia')]
    public function abrirOcurrencia($ocurrenciaId)
    {
        $ocurrencia = $this->buscaIdenocurencia($ocurrenciaId);
        $this->ocurrenciaId = $ocurrencia->id;


        $this->ocurrencia = [
            'fecha' => $ocurrencia->fecha,
            'hora_inicio' => $ocurrencia->hora_inicio,
            'hora_fin' => $ocurrencia->hora_fin,
            'participantes' => $ocurrencia->muchospacientes()->pluck('id')->toArray(),
            'cupo_maximo' => $ocurrencia->citaGrupal->cupo_maximo,

        ];


        $this->profesionalNombre = $ocurrencia->citaGrupal->profesional->nombre . ' ' . $ocurrencia->citaGrupal->profesional->apellido;
        $this->nombreGrupo = $ocurrencia->citaGrupal->nombre;

        $this->pacientes = Paciente::orderBy('apellido')->get();

        $this->showOcurrenciaUnicaModal = true;
    }

    public function agregarParticipante($id)
    {
        // Evitar duplicados
        if (in_array($id, $this->ocurrencia['participantes'])) {
            return;
        }

        // Obtener cupo máximo desde la ocurrencia actual
        $ocurrencia = CitaGrupalOcurrencia::find($this->ocurrenciaId);
        $cupoMaximo = $ocurrencia?->citaGrupal?->cupo_maximo ?? 0;

        // Validar que no se exceda el cupo
        if (count($this->ocurrencia['participantes']) >= $cupoMaximo) {
            $this->addError('ocurrencia.participantes', "Ya se alcanzó el cupo máximo de {$cupoMaximo} participantes.");
            return;
        }

        // Agregar si todo está bien
        $this->resetErrorBag('ocurrencia.participantes'); // Limpiar error si lo hubo
        $this->ocurrencia['participantes'][] = $id;
    }

    public function quitarParticipante($id)
    {
        $this->ocurrencia['participantes'] = array_filter(
            $this->ocurrencia['participantes'],
            fn($p) => $p != $id
        );
    }

    public function guardarOcurrenciaUnica()
    {
        $this->validate([
            'ocurrencia.fecha' => 'required|date',
            'ocurrencia.hora_inicio' => 'required',
            'ocurrencia.hora_fin' => 'required|after:ocurrencia.hora_inicio',
            'ocurrencia.participantes' => 'array|min:1',
        ]);

        $ocurrencia = CitaGrupalOcurrencia::findOrFail($this->ocurrenciaId);

        $ocurrencia->update([
            'fecha' => $this->ocurrencia['fecha'],
            'hora_inicio' => $this->ocurrencia['hora_inicio'],
            'hora_fin' => $this->ocurrencia['hora_fin'],
        ]);
        $clinicaId = auth()->user()->clinica_id;

        $pivotData = collect($this->ocurrencia['participantes'])
            ->mapWithKeys(fn($id) => [$id => ['clinica_id' => $clinicaId]])
            ->toArray();
        $ocurrencia->muchosPacientes()->sync($pivotData);
       //$ocurrencia->muchospacientes()->sync($this->ocurrencia['participantes']);
        $this->loadCitas();
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        $this->showOcurrenciaUnicaModal = false;
        session()->flash('success', 'Ocurrencia actualizada correctamente.');
    }


    public function buscaIdenocurencia($ocurrencia)
    {
        // 1. Extraer el ID de la ocurrencia desde el string
        $fullId = $ocurrencia['citaId'];
        preg_match('/grupal-ocurrencia-(\d+)/', $fullId, $matches);
        $ocurrenciaId = $matches[1] ?? null;

        if (!$ocurrenciaId) {
            session()->flash('error', 'ID de ocurrencia inválido');
            return;
        }

        // 2. Buscar la ocurrencia con su relación
        $ocurrencia = CitaGrupalOcurrencia::with('citaGrupal')->findOrFail($ocurrenciaId);

        return $ocurrencia;
    }


    public function render()
    {
        return view('livewire.grupos.grupo');
    }
}
