<?php

namespace App\Livewire\Consentimientos;

use App\Livewire\Forms\ConsentimientoForm;
use App\Models\Consentimiento;
use Livewire\Component;

class Show extends Component
{
    public ConsentimientoForm $form;

    public function mount(Consentimiento $consentimiento)
    {
        $this->form->setConsentimientoModel($consentimiento);
    }

    public function render()
    {
        return view('livewire.consentimiento.show', ['consentimiento' => $this->form->consentimientoModel]);
    }
}
