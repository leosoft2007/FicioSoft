<?php

namespace App\Livewire\Profesionals;

use App\Livewire\Forms\ProfesionalForm;
use App\Models\Cita;
use App\Models\Profesional;
use Livewire\Component;

class Show extends Component
{
    public ProfesionalForm $form;
    public $profesional_seleccionado;

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

        // Recargar las citas para reflejar los cambios
        if ($estado == 'cancelado') {
            session()->flash('cancelado', "El estado de la cita fue actualizado a '{$estado}'.");
        } elseif ($estado == 'confirmado') {
            session()->flash('confirmado', "El estado de la cita fue actualizado a '{$estado}'.");
        } else {
            session()->flash('pendiente', "El estado de la cita fue actualizado a '{$estado}'.");
        }

        return redirect()->back();

    }


    public function render()

    {
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
