<?php

namespace App\Livewire\Pacientes;

use App\Livewire\Forms\PacienteForm;
use App\Models\Paciente;
use Livewire\Component;


class Create extends Component
{
    public PacienteForm $form;

    public function mount(Paciente $paciente)
    {
        $this->form->setPacienteModel($paciente);
    }

    public function save()
    {
        $this->authorize('create pacientes');
        
        $this->form->store();

        return $this->redirectRoute('pacientes.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('create pacientes');
        return view('livewire.paciente.create');
    }
}
