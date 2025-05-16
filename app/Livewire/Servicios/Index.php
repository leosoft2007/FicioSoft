<?php

namespace App\Livewire\Servicios;

use App\Models\Servicio;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $servicios = Servicio::paginate();

        return view('livewire.servicio.index', compact('servicios'))
            ->with('i', $this->getPage() * $servicios->perPage());
    }

    public function delete(Servicio $servicio)
    {
        $servicio->delete();

        return $this->redirectRoute('servicios.index', navigate: true);
    }
}
