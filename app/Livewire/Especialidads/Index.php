<?php

namespace App\Livewire\Especialidads;

use App\Models\Especialidad;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';

    protected $queryString = ['search' => ['except' => ''], 'sortField', 'sortDirection'];
    public function render(): View
    {

        return view('livewire.especialidad.index', [
            'especialidads' => Especialidad::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
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

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function delete(Especialidad $especialidad)
    {
        $this->authorize('delete especialidads');
        $especialidad->delete();

        return $this->redirectRoute('especialidads.index', navigate: true);
    }
}
