<?php

namespace App\Livewire\Pacientes;

use App\Livewire\Forms\PacienteForm;
use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public PacienteForm $form;
    public $paciente;
    public $foto=null;


    public function mount(Paciente $paciente)
    {
        $this->paciente = $paciente;
        $this->form->setPacienteModel($paciente);
    }
    public function rules()
    {
        return [
            'foto' => 'nullable|image|max:1024', // ejemplo
        ];
    }
    public function save()
    {
        $this->authorize('edit pacientes');


        if ($this->form->foto) {


                    // 🗑️ Borrar la anterior si existe
            if ($this->paciente->foto && Storage::disk('public')->exists($this->paciente->foto)) {
                Storage::disk('public')->delete($this->paciente->foto);
            }
            // ✅ Guardar la nueva foto
            $path = $this->foto->store('pacientes', 'public');


            // 💾 Guardar ruta en DB
            $this->paciente->foto = $path;
            $this->paciente->save();
            $this->form->foto = $path;


        }

        $this->form->update();

        return $this->redirectRoute('pacientes.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('edit pacientes');
        return view('livewire.paciente.edit');
    }
}
