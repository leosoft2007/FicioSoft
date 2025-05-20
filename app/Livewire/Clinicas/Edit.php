<?php

namespace App\Livewire\Clinicas;

use App\Livewire\Forms\ClinicaForm;
use App\Models\Clinica;
use Livewire\Component;

class Edit extends Component
{
    public ClinicaForm $form;

    public function mount(Clinica $clinica)
    {
        $this->form->setClinicaModel($clinica);
    }

    public function save()
    {
        $this->authorize('edit clinicas');
        $this->form->update();

        return $this->redirectRoute('clinicas.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('edit clinicas');
        return view('livewire.clinica.edit');
    }
}
