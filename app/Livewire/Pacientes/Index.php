<?php

namespace App\Livewire\Pacientes;

use App\Models\Paciente;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $pacientes = Paciente::paginate();

        return view('livewire.paciente.index', compact('pacientes'))
            ->with('i', $this->getPage() * $pacientes->perPage());
    }

    public function delete(Paciente $paciente)
    {
        $paciente->delete();

        return $this->redirectRoute('pacientes.index', navigate: true);
    }
}
