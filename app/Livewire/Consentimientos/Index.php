<?php

namespace App\Livewire\Consentimientos;

use App\Models\Consentimiento;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        // identificamos el usuario autenticado
        $clinica = auth()->user()->clinica;

        // listamos los concentimientos de la clinica
        $consentimientos = Consentimiento::where('clinica_id', $clinica->id)->paginate();


        return view('livewire.consentimiento.index', compact('consentimientos'))
            ->with('i', $this->getPage() * $consentimientos->perPage());
    }

    public function delete(Consentimiento $consentimiento)
    {
        $this->authorize('delete consentimientos');
        $consentimiento->delete();

        return $this->redirectRoute('consentimientos.index', navigate: true);
    }
}
