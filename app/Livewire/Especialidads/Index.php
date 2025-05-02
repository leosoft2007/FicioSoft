<?php

namespace App\Livewire\Especialidads;

use App\Models\Especialidad;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $especialidads = Especialidad::paginate();

        return view('livewire.especialidad.index', compact('especialidads'))
            ->with('i', $this->getPage() * $especialidads->perPage());
    }

    public function delete(Especialidad $especialidad)
    {
        $especialidad->delete();

        return $this->redirectRoute('especialidads.index', navigate: true);
    }
}
