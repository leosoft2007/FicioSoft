<?php

namespace App\Livewire\Gastos;

use App\Livewire\Forms\GastoForm;
use App\Models\Gasto;
use App\Models\TipoGasto;
use Livewire\Component;

class Edit extends Component
{
    public GastoForm $form;
    public $tiposgasto;
    public $showModalTipoGasto = false;
    public $nuevoTipoGasto = [
        'nombre' => '',
        'descripcion' => '',
    ];

    public function guardarNuevoTipoGasto()
    {
        $tipo = \App\Models\TipoGasto::create([
            'nombre' => $this->nuevoTipoGasto['nombre'],
            'descripcion' => $this->nuevoTipoGasto['descripcion'],
            'clinica_id' => auth()->user()->clinica_id,
        ]);
        $this->tiposgasto = \App\Models\TipoGasto::where('clinica_id', auth()->user()->clinica_id)
            ->orderBy('nombre')->get();
        $this->form->tipo_gasto_id = $tipo->id;
        $this->showModalTipoGasto = false;
        $this->nuevoTipoGasto = ['nombre' => '', 'descripcion' => ''];
    }
    
    public function mount(Gasto $gasto)
    {
        $this->form->setGastoModel($gasto);
        $this->tiposgasto = TipoGasto::where('clinica_id', auth()->user()->clinica_id)
            ->orderBy('nombre')
            ->get();
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('gastos.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.gasto.edit');
    }
}
