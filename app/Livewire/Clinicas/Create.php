<?php

namespace App\Livewire\Clinicas;

use App\Livewire\Forms\ClinicaForm;
use App\Models\Clinica;
use Livewire\Component;

class Create extends Component
{
    public ClinicaForm $form;

    public function mount(Clinica $clinica)
    {
        $this->form->setClinicaModel($clinica);
    }

    public function save()
    {
        $this->authorize('create clinicas');
        $this->form->store();

        return $this->redirectRoute('clinicas.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('create clinicas');
        return view('livewire.clinica.create');
    }
}
