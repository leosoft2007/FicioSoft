<?php

namespace App\Livewire\Profesionals;

use App\Models\Profesional;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $profesionals = Profesional::paginate();

        return view('livewire.profesional.index', compact('profesionals'))
            ->with('i', $this->getPage() * $profesionals->perPage());
    }

    public function delete(Profesional $profesional)
    {
        $profesional->delete();

        return $this->redirectRoute('profesionals.index', navigate: true);
    }
}
