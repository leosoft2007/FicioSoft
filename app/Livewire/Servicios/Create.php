<?php

namespace App\Livewire\Servicios;

use App\Livewire\Forms\ServicioForm;
use App\Models\Servicio;
use Livewire\Component;

class Create extends Component
{
    public ServicioForm $form;

    public function mount(Servicio $servicio)
    {
        $this->form->setServicioModel($servicio);
    }

    public function save()
    {
        $this->authorize('create servicios');
        $this->form->store();

        return $this->redirectRoute('servicios.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('create servicios');
        return view('livewire.servicio.create');
    }
}
