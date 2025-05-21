<?php

namespace App\Livewire\Clinicas;

use App\Livewire\Forms\ClinicaForm;
use App\Models\Clinica;
use Livewire\Component;

class Show extends Component
{
    public ClinicaForm $form;
    public $clinica;

    public function mount(Clinica $clinica)
    {
        $this->clinica = $clinica;
        $this->form->setClinicaModel($clinica);
    }

    public function render()
    {
        $this->authorize('view clinicas');
        $this->clinica->loadCount([
            'users',
            'pacientes',
            'profesionales',
            'especialidades',
            'servicios',
            'citas',
            'facturas',
            'citasgrupals',
        ]);
        $clinica = $this->clinica;
        return view('livewire.clinica.show', ['clinica' => $this->form->clinicaModel], compact('clinica'));

    }

}
