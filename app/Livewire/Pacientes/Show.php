<?php

namespace App\Livewire\Pacientes;

use App\Livewire\Forms\PacienteForm;
use App\Models\Consentimiento;
use App\Models\Paciente;
use Livewire\Component;

class Show extends Component
{
    public $consentimientoSeleccionado = 0;
    public PacienteForm $form;
    public $listaConsentimientos = [];

    public function mount(Paciente $paciente)
    {
        $this->listaConsentimientos = $paciente->consentimientos;
        $this->form->setPacienteModel($paciente);
    }

    public function firmarConsentimiento()
{
    if ($this->consentimientoSeleccionado === 0) return;

   return redirect()->route('consentimiento.firmar', [
    'paciente' => $this->form->pacienteModel->id,
    'consentimientos' => $this->consentimientoSeleccionado]);

}


    public function render()
    {
        ;
        // Resto de tu código...
       

        $clinica_id = auth()->user()->clinica->id;
        $this->authorize('view pacientes');
        $consentimientos= Consentimiento::where('clinica_id', $clinica_id)->get();
        $paciente = $this->form->pacienteModel;
        $citas = $paciente->citas()->with(['profesional', 'servicio'])->latest()->paginate(10);
        return view('livewire.paciente.show', compact('paciente', 'consentimientos','citas'));
    }
}
