<?php

namespace App\Livewire\Recibos;

use Livewire\Component;
use App\Models\Recibo;

class TablePlusWrapper extends Component
{
    public function render()
    {
        $columns = [
            ['field' => 'id', 'label' => 'Número', 'searchable' => true],
            ['field' => 'paciente.nombre', 'label' => 'Paciente', 'searchable' => true],
            ['field' => 'fecha', 'label' => 'Fecha', 'searchable' => false],
            ['field' => 'valor', 'label' => 'Valor', 'searchable' => true],
            ['field' => 'formadepago', 'label' => 'Forma de Pago', 'searchable' => true],
        ];

        // Pasas aquí el modelo como string
        $modelClass = \App\Models\Recibo::class;
        return view('livewire.recibos.table-plus-wrapper', compact('columns', 'modelClass'));

    }
}
