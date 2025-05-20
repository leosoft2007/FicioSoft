<?php

namespace App\Livewire\Profesionals;

use App\Models\Profesional;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
public $sortField = 'nombre';
public $sortDirection = 'asc';

public function sortBy($field)
{
    if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        $this->sortDirection = 'asc';
    }

    $this->sortField = $field;
}
    public function render(): View
    {
        $profesionals = Profesional::paginate();

         return view('livewire.profesional.index', [
        'profesionals' => Profesional::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%'.$this->search.'%')
                      ->orWhere('apellido', 'like', '%'.$this->search.'%')
                      ->orWhere('cif', 'like', '%'.$this->search.'%')
                      ->orWhere('telefono', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10)
    ]);
    }

    public function delete(Profesional $profesional)
    {
        $this->authorize('delete profesionals');
        $profesional->delete();

        return $this->redirectRoute('profesionals.index', navigate: true);
    }
}
