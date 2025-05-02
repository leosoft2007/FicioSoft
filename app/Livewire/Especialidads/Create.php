<?php

namespace App\Livewire\Especialidads;

use App\Livewire\Forms\EspecialidadForm;
use App\Models\Especialidad;
use Livewire\Component;

class Create extends Component
{
    public EspecialidadForm $form;

    public function mount(Especialidad $especialidad)
    {
        $this->form->setEspecialidadModel($especialidad);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('especialidads.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.especialidad.create');
    }
}
