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
    ];

    public $profesionalNombre;
    public $nombreGrupo;


    public $tipoEdicion = null; // 'todas' o 'una'
    public $editOcurrenciaId = null;
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
    protected $listeners = ['openCreateModal', 'openCitaGrupalModal', 'openCitaModal'];

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
        $citasIndividuales = Cita::with([
            'paciente:id,nombre,apellido',  // Especificamos paciente.id
            'profesional:id,nombre,color'  // Especificamos profesional.id
        ])
            ->select([
                'id',  // id de la tabla Cita
                'paciente_id',
                'profesional_id',
                'fecha',
                'hora_inicio',
                'hora_fin',
                'observaciones',
                'estado',
                'tipo',
                'clinica_id'
            ])
            ->where('clinica_id', $this->clinicaId)
            ->when($this->profesionalSeleccionado, function ($query) {
                $query->where('profesional_id', $this->profesionalSeleccionado);
            })
            ->get()
            ->map(function ($cita) {
                $pacienteNombre = $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido;
                $profesionalNombre = $cita->profesional?->nombre;
                $color = $cita->profesional?->color ?? '#3b82f6';

                return [
                    'id' => $cita->id,
                    'title' => '👤 ' . $profesionalNombre . ' ' . $profesionalNombre, // texto plano si quieres fallback
                    'titleHtml' => "👤  <span style='color:gray;'>$profesionalNombre</span> - $pacienteNombre",

                    'tooltipHtml' => "
                    <div style='font-size: 14px; line-height: 1.5; color: #333;'>
                        <strong>Cita Individual</strong> <br>
                        <strong>Profesional:</strong> $profesionalNombre<br>
                        <strong>Pacientes:</strong><br>- " . $pacienteNombre . " </div> ",
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
            });

        $citasGrupales = CitaGrupalOcurrencia::with([
            'citaGrupal.profesional:id,nombre,color',
            'pacientes.paciente:id,nombre,apellido'
        ])
            ->whereHas('citaGrupal', function ($query) {
                $query->where('clinica_id', $this->clinicaId);
                if ($this->profesionalSeleccionado) {
                    $query->where('profesional_id', $this->profesionalSeleccionado);
                }
            })
            ->get()
            ->map(function ($ocurrencia) {
                $nombre = $ocurrencia->citaGrupal->nombre;
                $pacientes = $ocurrencia->pacientes->pluck('paciente')->unique('id');
                $pacienteNombres = $pacientes->map(fn($p) => "{$p->nombre} {$p->apellido}")->join(', ');
                $profesional = $ocurrencia->citaGrupal->profesional->nombre;
                $color = $profesional->color ?? '#3b82f6';
                $cupo = $ocurrencia->cuposDisponibles();


                return [
                    'id' => 'grupal-ocurrencia-' . $ocurrencia->id,
                    'nombre' => $nombre,
                    'title' => '👥 ' . $profesional . ' ' . $pacienteNombres, // texto plano si quieres fallback
                    'titleHtml' => "👥 <span style='color:gray;'>$profesional</span> - $pacienteNombres",

                'tooltipHtml' => "
                    <div class='tooltip-container'>
                        <div class='tooltip-row'>
                            <strong class='tooltip-label'>Grupo:</strong>
                            <span class='tooltip-value'>$nombre</span>
                        </div>

                        <div class='tooltip-row'>
                            <strong class='tooltip-label'>Cupo disponible:</strong>
                            <span class='tooltip-value'>$cupo</span>
                        </div>

                        <div class='tooltip-row'>
                            <strong class='tooltip-label'>Profesional:</strong>
                            <span class='tooltip-value tooltip-professional'>$profesional</span>
                        </div>

                        <div>
                            <strong class='tooltip-patients-title'>Integrantes:</strong>
                            <div class='tooltip-patients'>
                                " . $pacientes->pluck('nombre')->join('<br>') . "
                            </div>
                        </div>
                    </div>",

                    'start' => \Carbon\Carbon::parse($ocurrencia->fecha)->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($ocurrencia->hora_inicio)->format('H:i:s'),
                    'end' => \Carbon\Carbon::parse($ocurrencia->fecha)->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($ocurrencia->hora_fin)->format('H:i:s'),
                    'borderColor' => '#ccc',
                    'classNames' => ['evento-' . $ocurrencia->estado],
                    'extendedProps' => [
                        'tipo' => 'grupal',
                        'observaciones' => $ocurrencia->observaciones,
                        'profesional' => [
                            'color' => $color,
                        ],
                    ],
                ];
            });



        $this->citas = $citasIndividuales->merge($citasGrupales)->toArray();
        // $this->citas = $citasIndividuales->toArray();

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

    public function createCitaGrupal()
    {
        $this->validate([
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
        ]);

        $this->newCitaGrupal['dias_semana'] = array_map('intval', $this->newCitaGrupal['dias_semana']);
        // Creamos la cita grupal
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


        // Asignar pacientes a TODAS las ocurrencias generadas automáticamente
        if (!empty($this->newCitaGrupal['pacientes'])) {
            foreach ($cita->ocurrencias as $ocurrencia) {
                foreach ($this->newCitaGrupal['pacientes'] as $pacienteId) {
                    $ocurrencia->pacientes()->create([
                        'paciente_id' => $pacienteId,
                    ]);
                }
            }
        }

        $this->reset('newCitaGrupal');
        $this->showGrupalModal = false;
        $this->loadCitas();
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        session()->flash('message', 'Grupo creado: se agendaron todas las citas con éxito.');
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



    public function openCitaGrupalModal($eventData)
    {
        $this->modoFormulario = 'editar';
        // 1. Extraer el ID de la ocurrencia desde el string
        $fullId = $eventData['citaId'];
        preg_match('/grupal-ocurrencia-(\d+)/', $fullId, $matches);
        $ocurrenciaId = $matches[1] ?? null;

        if (!$ocurrenciaId) {
            session()->flash('error', 'ID de ocurrencia inválido');
            return;
        }

        // 2. Buscar la ocurrencia con su relación
        $ocurrencia = CitaGrupalOcurrencia::with('citaGrupal')->findOrFail($ocurrenciaId);

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
        ];

        // Mostrar modal
        $this->showGrupalModal = true;
    }


    public function updateCitaGrupal()
    {

        $this->validate([
            'newCitaGrupal.profesional_id' => 'required|exists:profesionals,id',
            'newCitaGrupal.nombre' => 'string',
            'newCitaGrupal.fecha_inicio' => 'required|date',
            'newCitaGrupal.fecha_fin' => 'nullable|date|after_or_equal:newCitaGrupal.fecha_inicio',
            'newCitaGrupal.hora_inicio' => 'required',
            'newCitaGrupal.dias_semana.*' => 'integer|between:1,7',
            'newCitaGrupal.hora_fin' => 'required|after:newCitaGrupal.hora_inicio',
            'newCitaGrupal.frecuencia' => 'required|in:semanal,quincenal',
            'newCitaGrupal.cupo_maximo' => 'required|integer|min:1',
            'newCitaGrupal.pacientes' => 'nullable|array|max:' . $this->newCitaGrupal['cupo_maximo'],
        ]);

        $cita = CitaGrupal::findOrFail($this->editCitaGrupalId);
        $cita->delete();

        $this->newCitaGrupal['dias_semana'] = array_map('intval', $this->newCitaGrupal['dias_semana']);

        $cita_nueva = CitaGrupal::create([
            'profesional_id' => $this->newCitaGrupal['profesional_id'],
            'nombre' => $this->newCitaGrupal['nombre'],
            'fecha_inicio' => $this->newCitaGrupal['fecha_inicio'],
            'fecha_fin' => $this->newCitaGrupal['fecha_fin'],
            'hora_inicio' => $this->newCitaGrupal['hora_inicio'],
            'hora_fin' => $this->newCitaGrupal['hora_fin'],
            'frecuencia' => $this->newCitaGrupal['frecuencia'],
            'cupo_maximo' => $this->newCitaGrupal['cupo_maximo'],
            'observaciones' => $this->newCitaGrupal['observaciones'] ?? '',
            'dias_semana' => $this->newCitaGrupal['dias_semana'],
        ]);

        // 2. Eliminamos ocurrencias anteriores y sus pacientes
        // Asignar pacientes a TODAS las ocurrencias generadas automáticamente
        if (!empty($this->newCitaGrupal['pacientes'])) {
            foreach ($cita_nueva->ocurrencias as $ocurrencia) {
                foreach ($this->newCitaGrupal['pacientes'] as $pacienteId) {
                    $ocurrencia->pacientes()->create([
                        'paciente_id' => $pacienteId,
                    ]);
                }
            }
        }

        $this->reset('newCitaGrupal');
        $this->showGrupalModal = false;
        $this->loadCitas();
        $this->dispatch('refresh-calendar', updatedEvents: $this->citas);
        session()->flash('message', 'Grupo creado: se agendaron todas las citas con éxito.');
    }

    public function abrirOcurrencia($ocurrenciaId)
    {
        $ocurrencia = CitaGrupalOcurrencia::findOrFail($ocurrenciaId);

        $this->ocurrencia = [
            'fecha' => $ocurrencia->fecha,
            'hora_inicio' => $ocurrencia->hora_inicio,
            'hora_fin' => $ocurrencia->hora_fin,
            'participantes' => $ocurrencia->pacientes->pluck('id')->toArray(),
        ];

        $this->profesionalNombre = $ocurrencia->citaGrupal->profesional->id;
        $this->nombreGrupo = $ocurrencia->citaGrupal->nombre;

        $this->pacientes = Paciente::orderBy('apellido')->get();

        $this->showOcurrenciaUnicaModal = true;
    }

    public function agregarParticipante($id)
    {
        if (!in_array($id, $this->ocurrencia['participantes'])) {
            $this->ocurrencia['participantes'][] = $id;
        }
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
        $ocurrencia->participantes()->sync($this->ocurrencia['participantes']);

        $this->showOcurrenciaUnicaModal = false;
        session()->flash('success', 'Ocurrencia actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.grupos.grupo');
    }
}
