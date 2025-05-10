<?php

namespace App\Livewire\Clinicas;

use App\Models\Clinica;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public function render(): View
    {
        // implementamos busqueda por nombre y amellido

        $clinicas = Clinica::paginate();

        return view('livewire.clinica.index', compact('clinicas'))
            ->with('i', $this->getPage() * $clinicas->perPage());
    }

    public function delete(Clinica $clinica)
    {
        $clinica->delete();

        return $this->redirectRoute('clinicas.index', navigate: true);
    }
}
