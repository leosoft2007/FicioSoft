<?php

namespace App\Livewire\Pacientes;

use App\Livewire\Forms\PacienteForm;
use App\Models\Paciente;
use Livewire\Component;

class Show extends Component
{
    public PacienteForm $form;

    public function mount(Paciente $paciente)
    {
        $this->form->setPacienteModel($paciente);
    }

    public function render()
    {
        return view('livewire.paciente.show', ['paciente' => $this->form->pacienteModel]);
    }
}
