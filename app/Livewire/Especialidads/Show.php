<?php

namespace App\Livewire\Especialidads;

use App\Livewire\Forms\EspecialidadForm;
use App\Models\Especialidad;
use Livewire\Component;

class Show extends Component
{
    public EspecialidadForm $form;

    public function mount(Especialidad $especialidad)
    {
        $this->form->setEspecialidadModel($especialidad);
    }

    public function render()
    {
        return view('livewire.especialidad.show', ['especialidad' => $this->form->especialidadModel]);
    }
}
