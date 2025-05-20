<?php

namespace App\Livewire\Profesionals;

use App\Livewire\Forms\ProfesionalForm;
use App\Models\Especialidad;
use App\Models\Profesional;
use Livewire\Component;

class Create extends Component
{
    public ProfesionalForm $form;
    public $especialidades =[];


    public function mount(Profesional $profesional)
    {
        $this->form->setProfesionalModel($profesional);
        //especialidad de la clinica
        $clinicaId = auth()->user()->clinica_id;

        $this->especialidades = Especialidad::where('clinica_id', $clinicaId)->get();


    }

    public function save()
    {
        $this->authorize('create profesionals');
        $prof = $this->form->store();



        return $this->redirectRoute('profesionals.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('create profesionals');
        return view('livewire.profesional.create');
    }
}
