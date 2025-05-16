<?php

namespace App\Livewire\Servicios;

use App\Livewire\Forms\ServicioForm;
use App\Models\Servicio;
use Livewire\Component;

class Show extends Component
{
    public ServicioForm $form;

    public function mount(Servicio $servicio)
    {
        $this->form->setServicioModel($servicio);
    }

    public function render()
    {
        return view('livewire.servicio.show', ['servicio' => $this->form->servicioModel]);
    }
}
