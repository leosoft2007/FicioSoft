<?php

namespace App\Livewire\Firma;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class FirmaPad extends Component
{
    public string $firmaSvg = '';

public function guardarFirma($svg)
{
    $this->firmaSvg = $svg;
    session()->flash('message', 'Firma guardada correctamente');
}
    public function render()
    {
        return view('livewire.firma.firma-pad');
    }

    
}
