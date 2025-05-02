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
       $this->especialidades = Especialidad::all(); // O puedes usar ->pluck('nombre', 'id') si lo prefieres    
        
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('profesionals.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.profesional.create');
    }
}
