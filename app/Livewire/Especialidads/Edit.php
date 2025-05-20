<?php

namespace App\Livewire\Especialidads;

use App\Livewire\Forms\EspecialidadForm;
use App\Models\Especialidad;
use Livewire\Component;

class Edit extends Component
{
    public EspecialidadForm $form;

    public function mount(Especialidad $especialidad)
    {
        $this->form->setEspecialidadModel($especialidad);
    }

    public function save()
    {
        $this->authorize('edit especialidads');
        $this->form->update();
        
        return $this->redirectRoute('especialidads.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('edit especialidads');
        return view('livewire.especialidad.edit');
    }
}
