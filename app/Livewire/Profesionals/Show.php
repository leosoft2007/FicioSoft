<?php

namespace App\Livewire\Profesionals;

use App\Livewire\Forms\ProfesionalForm;
use App\Models\Profesional;
use Livewire\Component;

class Show extends Component
{
    public ProfesionalForm $form;

    public function mount(Profesional $profesional)
    {
        $this->form->setProfesionalModel($profesional);
    }

    public function render()
    {
        return view('livewire.profesional.show', ['profesional' => $this->form->profesionalModel]);
    }
}
