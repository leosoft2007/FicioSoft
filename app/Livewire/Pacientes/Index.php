<?php

namespace App\Livewire\Pacientes;

use App\Livewire\Grupos\Grupo;
use App\Models\Paciente;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $categoria_id;
    public $categorias = [];
    public $buscar = '';
    public $perPage = 10;

public $sortField = 'nombre';
public $sortDirection = 'asc';

    public function mount()
    {
        $this->categorias = Paciente::all()->map(function ($cat) {
            return [
                'value' => $cat->id,
                'text' => $cat->nombre,
            ];
        })->toArray();
    }


    public function render(): View
    {
        // buscar por nombre y apellido

            $pacientes = Paciente::query()
    ->where('nombre', 'like', '%' . $this->buscar . '%')
    ->orWhere('apellido', 'like', '%' . $this->buscar . '%')
    ->orderBy($this->sortField, $this->sortDirection)
    ->paginate($this->perPage);



        return view('livewire.paciente.index', compact('pacientes'))
            ->with('i', $this->getPage() * $pacientes->perPage());


    }
    public function updatedCategoriaId($value)
        {
            dd($value);  // Esto nos permitirá ver si Livewire está recibiendo el valor correctamente
        }

    public function delete(Paciente $paciente)
    {
        $this->authorize('delete pacientes');
        $paciente->delete();

        return $this->redirectRoute('pacientes.index', navigate: true);
    }
    public function sortBy($field)
{
    $this->sortDirection = $this->sortField === $field
        ? $this->toggleSortDirection()
        : 'asc';

    $this->sortField = $field;
}

public function toggleSortDirection()
{
    return $this->sortDirection === 'asc' ? 'desc' : 'asc';
}

   

}
