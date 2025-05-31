<?php

namespace App\Livewire\Recibos;

use App\Livewire\Forms\ReciboForm;
use App\Models\Recibo;
use Livewire\Component;

class Create extends Component
{
    public ReciboForm $form;
    public $pacientes;

    public function mount(Recibo $recibo)
    {
        $clinica_id = clinica_actual();
        $this->pacientes = \App\Models\Paciente::where('clinica_id', $clinica_id)
            ->orderBy('apellido')
            ->get();

        $this->form->setReciboModel($recibo);
    }

    public function save()
    {
        
        $this->form->store();

        return $this->redirectRoute('recibos.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.recibo.create');
    }
}
