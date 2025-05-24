<?php

namespace App\Livewire\Gastos;

use App\Livewire\Forms\GastoForm;
use App\Models\Gasto;
use Livewire\Component;

class Show extends Component
{
    public GastoForm $form;

    public function mount(Gasto $gasto)
    {
        $this->form->setGastoModel($gasto);
    }

    public function render()
    {
        return view('livewire.gasto.show', ['gasto' => $this->form->gastoModel]);
    }
}
