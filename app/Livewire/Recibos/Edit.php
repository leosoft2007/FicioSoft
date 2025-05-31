<?php

namespace App\Livewire\Recibos;

use App\Livewire\Forms\ReciboForm;
use App\Models\Recibo;
use Livewire\Component;

class Edit extends Component
{
    public ReciboForm $form;
    public $recibo;

    public function mount(Recibo $recibo)
    {
        $this->recibo = $recibo;
        $this->form->setReciboModel($recibo);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('recibos.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.recibo.edit');
    }
}
