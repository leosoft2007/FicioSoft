<?php

namespace App\Livewire\Servicios;

use App\Livewire\Forms\ServicioForm;
use App\Models\Servicio;
use Livewire\Component;

class Edit extends Component
{
    public ServicioForm $form;

    public function mount(Servicio $servicio)
    {
        $this->form->setServicioModel($servicio);
    }

    public function save()
    {
        $this->authorize('edit servicios');
        $this->form->update();

        return $this->redirectRoute('servicios.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('edit servicios');
        return view('livewire.servicio.edit');
    }
}
