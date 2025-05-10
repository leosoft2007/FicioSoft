<?php

namespace App\Livewire\Pacientes;

use App\Livewire\Forms\PacienteForm;
use App\Models\Paciente;
use Livewire\Component;

class Edit extends Component
{
    public PacienteForm $form;

    public function mount(Paciente $paciente)
    {
        $this->form->setPacienteModel($paciente);
    }

    public function save()
    {
        $this->authorize('edit pacientes');
        
        $this->form->update();

        return $this->redirectRoute('pacientes.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('edit pacientes');
        return view('livewire.paciente.edit');
    }
}
