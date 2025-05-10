<?php

namespace App\Livewire\Consentimientos;

use App\Livewire\Forms\ConsentimientoForm;
use App\Models\Consentimiento;
use Livewire\Component;

class Create extends Component
{
    public ConsentimientoForm $form;

    public function mount(Consentimiento $consentimiento)
    {
        $this->form->setConsentimientoModel($consentimiento);
    }

    public function save()
    {
        $this->form->clinica_id = auth()->user()->clinica->id;
        $this->form->store();

        return $this->redirectRoute('consentimientos.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.consentimiento.create');
    }
}
