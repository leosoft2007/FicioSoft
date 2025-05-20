<?php

namespace App\Livewire\Profesionals;

use App\Livewire\Forms\ProfesionalForm;
use App\Models\Cita;
use App\Models\CitaGrupalOcurrencia;
use App\Models\Profesional;
use Livewire\Component;
use Livewire\Livewire;

class Show extends Component
{
    public ProfesionalForm $form;
    public $profesional_seleccionado;
    public $mensaje;
    public $color;

    public function mount(Profesional $profesional)
    {
        $this->form->setProfesionalModel($profesional);
        $this->profesional_seleccionado = $profesional;
    }
    public function actualizarEstado($id, $estado)
    {
        $cita = Cita::findOrFail($id);

        // Validar que el estado sea válido
        if (!in_array($estado, ['pendiente', 'confirmado', 'cancelado'])) {
            return;
        }

        // Actualizar el estado en la base de datos
        $cita->estado = $estado;
        $cita->save();

        // Configura el mensaje y el color según el estado
        if ($estado == 'cancelado') {

            $this->mensaje = 'El estado de la cita fue actualizado a CANCELADO';
            $this->color = 'red';
        } elseif ($estado == 'confirmado') {
            $this->mensaje = 'El estado de la cita fue actualizado a CONFIRMADO';
            $this->color = 'green';
        } else {
            $this->mensaje = 'El estado de la cita fue actualizado a PENDIENTE';
            $this->color = 'yellow';
        }

    }
    public function actualizarEstadoOcurrencia($id, $estado)
    {

        $cita = CitaGrupalOcurrencia::findOrFail($id);

        // Validar que el estado sea válido
        if (!in_array($estado, ['pendiente', 'confirmado', 'cancelado'])) {
            return;
        }

        // Actualizar el estado en la base de datos
        $cita->estado = $estado;
        $cita->save();

        // Configura el mensaje y el color según el estado
        if ($estado == 'cancelado') {

            $this->mensaje = 'El estado de la cita fue actualizado a CANCELADO';
            $this->color = 'red';
        } elseif ($estado == 'confirmado') {
            $this->mensaje = 'El estado de la cita fue actualizado a CONFIRMADO';
            $this->color = 'green';
        } else {
            $this->mensaje = 'El estado de la cita fue actualizado a PENDIENTE';
            $this->color = 'yellow';
        }

    }


    public function render()

    {
        $this->authorize('view profesionals');
        // Citas individuales con relaciones
        $citasIndividuales = $this->profesional_seleccionado->citas()
            ->with(['paciente', 'servicio', 'clinica'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->paginate(10);



        $citasGrupales = $this->profesional_seleccionado->citaGrupals()
            ->with(['ocurrencias.pacientes.paciente'])
            ->get()
            ->each(function ($citaGrupal) {
                // Agregamos la colección de pacientes al modelo
                $citaGrupal->setAttribute('pacientes', $citaGrupal->pacientesIndirectos());
            });



        return view('livewire.profesional.show', ['profesional' => $this->form->profesionalModel], compact('citasIndividuales', 'citasGrupales'));
    }
}
