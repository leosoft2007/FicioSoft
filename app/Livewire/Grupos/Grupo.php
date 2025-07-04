<?php

namespace App\Livewire\Grupos;

use App\Models\Cita;
use App\Models\CitaGrupal;
use App\Models\CitaGrupalOcurrencia;
use App\Models\Paciente;
use App\Models\Profesional;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class Grupo extends Component
{
    // === PROPIEDADES ===

    // -- Citas individuales
    public $newCita = [
        'paciente_id' => '',
        'profesional_id' => '',
        'fecha' => '',
        'hora_inicio' => '',
        'hora_fin' => '',
        'observaciones' => ' '
    ];
    public $selectedCita = null;
    public $showModal = false;
    public $showModal2 = false;

    // -- Citas grupales
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
        'nombre' => ''
    ];
    public $editCitaGrupalId = null;
    public $showGrupalModal = false;

    // -- Ocurrencias grupales
    public $ocurrencia = [
        'fecha' => '',
        'hora_inicio' => '',
        'hora_fin' => '',
        'participantes' => [], // IDs
        'cupo_maximo' => 0,
    ];
    public $ocurrenciaId = null;
    public $showOcurrenciaUnicaModal = false;
    public $showOcurrenciaModal = false;


    // -- Datos auxiliares y búsqueda
    public $profesionalNombre;
    public $nombreGrupo;
    public $tipoEdicion = null; // 'todas' o 'una'
    public string $modoFormulario = 'editar'; // o 'editar'
    public $profesionalSeleccionado = null;
    public $clinicaId;
    public $citas = [];
    public $user;
    public $estado = '';
    public $fecha;
    public $hora_inicio;
    public $hora_fin;
    public $errorMessage = null;
    public $datosSeleccion;
    public $mostrarSelectorTipoCita = false;
    public $profesionales = [];
    public $paciente_id = null;
    public $search = ''; // Campo de búsqueda
    public $pacientes = []; // Opciones cargadas dinámicamente
    public $selectedPaciente = null; // Paciente seleccionado
    public $pacientesbusqueda = []; // Opciones cargadas dinámicamente


    // -- Listeners
    protected $listeners = [
        'openCreateModal',
        'openCitaGrupalModal',
        'openCitaModal',
        'abrirOcurrencia',
        'resetTab'
    ];

    // === CICLO DE VIDA ===
    public function mount()
    {
        $this->user = auth()->user();
        $this->clinicaId = clinica_actual();


       $this->pacientes = Paciente::where('clinica_id', $this->clinicaId)->orderby('apellido')->get();


        $this->profesionales = Profesional::where('clinica_id', $this->clinicaId)->get();



        //  ->whereHas('citas', function ($query) {
        // Opcional: filtra por fecha si lo necesitas
        // $query->whereDate('fecha', today()); // Filtrar hoy
        // })


        $this->loadCitas();
    }
    public function render()
    {
        return view('livewire.grupos.grupo');
    }

    // === MÉTODOS DE CITAS INDIVIDUALES ===
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
        ], $this->mensajesValidacion());

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
    protected function mensajesValidacion()
    {
        return [
            // Citas individuales
            'newCita.paciente_id.required' => 'El paciente es obligatorio.',
            'newCita.paciente_id.exists' => 'El paciente seleccionado no existe.',
            'newCita.profesional_id.required' => 'El profesional es obligatorio.',
            'newCita.profesional_id.exists' => 'El profesional seleccionado no existe.',
            'newCita.fecha.required' => 'La fecha es obligatoria.',
            'newCita.fecha.date' => 'La fecha no es válida.',
            'newCita.hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'newCita.hora_inicio.date_format' => 'La hora de inicio debe tener el formato HH:MM.',
            'newCita.hora_fin.required' => 'La hora de fin es obligatoria.',
            'newCita.hora_fin.date_format' => 'La hora de fin debe tener el formato HH:MM.',
            'newCita.hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'newCita.observaciones.max' => 'Las observaciones no pueden superar los 255 caracteres.',

            // Citas individuales - edición
            'selectedCita.estado.required' => 'El estado es obligatorio.',
            'selectedCita.estado.in' => 'El estado debe ser pendiente, confirmado o cancelado.',

            // Citas grupales
            'newCitaGrupal.profesional_id.required' => 'El profesional es obligatorio.',
            'newCitaGrupal.profesional_id.exists' => 'El profesional seleccionado no existe.',
            'newCitaGrupal.nombre.string' => 'El nombre debe ser un texto.',
            'newCitaGrupal.fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'newCitaGrupal.fecha_inicio.date' => 'La fecha de inicio no es válida.',
            'newCitaGrupal.fecha_fin.date' => 'La fecha de fin no es válida.',
            'newCitaGrupal.fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
            'newCitaGrupal.hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'newCitaGrupal.hora_fin.required' => 'La hora de fin es obligatoria.',
            'newCitaGrupal.hora_fin.after' => 'La hora de fin debe ser posterior a la de inicio.',
            'newCitaGrupal.dias_semana.required' => 'Debes seleccionar al menos un día de la semana.',
            'newCitaGrupal.dias_semana.array' => 'Los días de la semana deben ser una lista.',
            'newCitaGrupal.dias_semana.min' => 'Selecciona al menos un día de la semana.',
            'newCitaGrupal.frecuencia.required' => 'La frecuencia es obligatoria.',
            'newCitaGrupal.frecuencia.in' => 'La frecuencia debe ser semanal o quincenal.',
            'newCitaGrupal.cupo_maximo.required' => 'El cupo máximo es obligatorio.',
            'newCitaGrupal.cupo_maximo.integer' => 'El cupo máximo debe ser un número.',
            'newCitaGrupal.cupo_maximo.min' => 'El cupo máximo debe ser al menos 1.',
            'newCitaGrupal.pacientes.array' => 'Los pacientes deben ser una lista.',
            'newCitaGrupal.pacientes.max' => 'No puedes agregar más pacientes que el cupo máximo.',

            // Ocurrencias grupales
            'ocurrencia.fecha.required' => 'La fecha es obligatoria.',
            'ocurrencia.fecha.date' => 'La fecha no es válida.',
            'ocurrencia.hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'ocurrencia.hora_fin.required' => 'La hora de fin es obligatoria.',
            'ocurrencia.hora_fin.after' => 'La hora de fin debe ser posterior a la de inicio.',
            'ocurrencia.participantes.array' => 'Los participantes deben ser una lista.',
            'ocurrencia.participantes.min' => 'Debes seleccionar al menos un participante.',
        ];
    }
    public function saveCita()
    {
        $this->validate([
            'selectedCita.estado' => 'required|in:pendiente,confirmado,cancelado',
            'selectedCita.observaciones' => 'nullable|string|max:255',
            'selectedCita.fecha' => 'required|date',
            'selectedCita.hora_inicio' => 'required|date_format:H:i',
            'selectedCita.hora_fin' => 'required|date_format:H:i|after:selectedCita.hora_inicio',
        ], $this->mensajesValidacion());

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
            session()->flash('message', 'Cita Eliminada exitosamente.');
        }
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

    // === MÉTODOS DE CITAS GRUPALES ===
    public function openCreateGrupalModal($data)
    {
        $this->modoFormulario = 'crear';

        $this->reset('newCitaGrupal');
        $start = \Carbon\Carbon::parse($data['start']);
        $end = \Carbon\Carbon::parse($data['end']);

        $this->newCitaGrupal['fecha_inicio'] = $start->toDateString();
        $this->newCitaGrupal['hora_inicio'] = $start->format('H:i');
        $this->newCitaGrupal['hora_fin'] = $end->format('H:i');

        $this->dispatch('resetTab');


        $this->showGrupalModal = true;
    }
    public function createCitaGrupal()
    {
        $this->validate($this->reglasCitaGrupal(), $this->mensajesValidacion());

        $this->crearCitaGrupal();
        $this->finalizarAccionGrupal('Grupo creado exitosamente.');
    }
    public function updateCitaGrupal()
    {
        $this->validate($this->reglasCitaGrupal());

        $cita = CitaGrupal::findOrFail($this->editCitaGrupalId);

        $cita->delete();



        $this->crearCitaGrupal();

        $this->finalizarAccionGrupal('Grupo Actualizado exitosamente.');
    }
    public function deleteCitaGrupal()
    {
        if (!$this->editCitaGrupalId) {
            session()->flash('error', 'No se seleccionó ningún grupo para eliminar.');
            return;
        }

        $citaGrupal = CitaGrupal::find($this->editCitaGrupalId);

        if (!$citaGrupal) {
            session()->flash('error', 'El grupo no fue encontrado.');
            return;
        }

        try {
            $citaGrupal->delete();

            // Reset y actualizaciones
            $this->editCitaGrupalId = null;
            $this->dispatch('resetTab');

            $this->showGrupalModal = false;

            $this->loadCitas();

            $this->dispatch('modalClosed');
            $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
            session()->flash('message', 'Grupo eliminado exitosamente.');
        } catch (\Exception $e) {
            // Log para debugging
            \Log::error('Error al eliminar grupo: ' . $e->getMessage());

            session()->flash('error', 'Ocurrió un error al eliminar el grupo. Intenta nuevamente.');
        }
    }
    public function closeGrupalModal() {}
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
    protected function finalizarAccionGrupal(string $mensaje)
    {
        $this->reset('newCitaGrupal');

        $this->dispatch('resetTab');


        $this->showGrupalModal = false;
        $this->loadCitas();
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        session()->flash('message', $mensaje);
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

        $messages = [
            'newCitaGrupal.profesional_id.required' => 'El profesional es obligatorio.',
            'newCitaGrupal.fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'newCitaGrupal.fecha_inicio.date' => 'La fecha de inicio no es válida.',
            'newCitaGrupal.fecha_fin.date' => 'La fecha de fin no es válida.',
            'newCitaGrupal.fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
            'newCitaGrupal.hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'newCitaGrupal.hora_fin.required' => 'La hora de fin es obligatoria.',
            'newCitaGrupal.hora_fin.after' => 'La hora de fin debe ser posterior a la de inicio.',
            'newCitaGrupal.dias_semana.required' => 'Debes seleccionar al menos un día de la semana.',
            'newCitaGrupal.dias_semana.array' => 'Los días de la semana deben ser una lista.',
            'newCitaGrupal.dias_semana.min' => 'Selecciona al menos un día de la semana.',
            'newCitaGrupal.frecuencia.required' => 'La frecuencia es obligatoria.',
            'newCitaGrupal.frecuencia.in' => 'La frecuencia debe ser semanal o quincenal.',
            'newCitaGrupal.cupo_maximo.required' => 'El cupo máximo es obligatorio.',
            'newCitaGrupal.cupo_maximo.integer' => 'El cupo máximo debe ser un número.',
            'newCitaGrupal.cupo_maximo.min' => 'El cupo máximo debe ser al menos 1.',
            'newCitaGrupal.pacientes.array' => 'Los pacientes deben ser una lista.',
            'newCitaGrupal.pacientes.max' => 'No puedes agregar más pacientes que el cupo máximo.',
        ];

        $validated = $this->validate($rules, $messages);

        return true; // necesario para Alpine
    }

    // === MÉTODOS DE OCURRENCIAS GRUPALES ===
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

    // === MÉTODOS DE UTILIDAD Y FILTRO ===
    public function openGrupalocurrencia($a, $eventData)
    {

        $this->dispatch( $a , $eventData);
    }
    public function loadCitas()
    {
        $citasIndividuales = Cita::paraCalendario($this->clinicaId, $this->profesionalSeleccionado);
        $citasGrupales = CitaGrupalOcurrencia::paraCalendario($this->clinicaId, $this->profesionalSeleccionado);

        // $this->citas = $citasIndividuales->merge($citasGrupales)->toArray();
        $this->citas = collect($citasIndividuales)->merge(collect($citasGrupales))->toArray();


        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
    }
    public function filtrarPorProfesional($profesionalId)
    {

        $this->profesionalSeleccionado = $profesionalId;
        $this->loadCitas();
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
        // Emitir evento para resetear la pestaña activa
        $this->dispatch('resetTab');


        // Mostrar modal
        $this->showGrupalModal = true;
    }
}
