<?php

namespace App\Livewire\Clinicas;

use App\Livewire\Forms\ClinicaForm;
use App\Models\Clinica;
use Livewire\Component;

class Show extends Component
{
    public ClinicaForm $form;

    public function mount(Clinica $clinica)
    {
        $this->form->setClinicaModel($clinica);
    }

    public function render()
    {
        $this->authorize('view clinicas');
        return view('livewire.clinica.show', ['clinica' => $this->form->clinicaModel]);
    }
}
