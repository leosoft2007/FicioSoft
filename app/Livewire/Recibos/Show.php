<?php

namespace App\Livewire\Recibos;

use App\Livewire\Forms\ReciboForm;
use App\Models\Recibo;
use Livewire\Component;

class Show extends Component
{
    public ReciboForm $form;

    public function mount(Recibo $recibo)
    {
        $this->form->setReciboModel($recibo);
    }

    public function render()
    {
        return view('livewire.recibo.show', ['recibo' => $this->form->reciboModel]);
    }
}
