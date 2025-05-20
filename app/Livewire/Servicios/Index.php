<?php

namespace App\Livewire\Servicios;

use App\Models\Servicio;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'nombre'; // Campo por defecto para ordenar
    public $sortDirection = 'asc'; // Dirección por defecto
    public function render()
    {
        $servicios = Servicio::query()
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortDirection);
            })
            ->paginate(10);

        return view('livewire.servicio.index', [
            'servicios' => $servicios
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }


    public function delete(Servicio $servicio)
    {
        $this->authorize('delete servicios');
        $servicio->delete();

        return $this->redirectRoute('servicios.index', navigate: true);
    }
}
