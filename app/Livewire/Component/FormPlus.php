<?php

namespace App\Livewire\Component;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class FormPlus extends Component
{
    /**
     * Clase del modelo Eloquent (Ej: App\Models\User)
     */
    public string $modelClass;

    /**
     * Instancia del modelo para edición, null para crear
     */
    public ?Model $model = null;

    /**
     * Configuración de campos (array de [name, label, type, rules, options, ...])
     */
    public array $fields = [];

    /**
     * Datos del formulario (clave => valor)
     */
    public array $formData = [];

    /**
     * Modo del formulario ('edit' o 'create')
     */
    public string $mode = 'edit';
    public array $validationMessages = [];

    public $showModal = [];
    public $newRelated = [];

    /**
     * Mensaje de éxito
     */
    public ?string $successMessage = null;
    public int $columns = 2; // Cambia a 1, 2 o 3 según lo que necesites
    public ?string $redirectRoute = null;
    public string $headerColor = 'indigo';

    /**
     * Inicializa el formulario con la configuración, modelo y valores iniciales.
     */
    public function mount(string $modelClass, array $fields, $id = null, $redirectRoute = null, $headerColor = 'indigo')
    {

        $this->modelClass = $modelClass;
        $this->fields = $fields;
        $this->mode = $id ? 'edit' : 'create';
        $this->redirectRoute = $redirectRoute;
        $this->headerColor = $headerColor;

        if ($id) {
            $this->model = $modelClass::findOrFail($id);
            foreach ($fields as $field) {
                $this->formData[$field['name']] = $this->model->{$field['name']};
            }
        } else {
            foreach ($fields as $field) {
                $this->formData[$field['name']] = $field['default'] ?? null;
            }
        }
        // Asigna dinámicamente las opciones si es necesario
        foreach ($this->fields as &$field) {
            if ($field['type'] === 'select' && isset($field['options_source'])) {
                $model = app($field['options_source']['model']);
                $field['options'] = $model::pluck(
                    $field['options_source']['label'],
                    $field['options_source']['key']
                )->toArray(); // [id => nombre]
            }
            if ($field['type'] === 'select-busqueda' && isset($field['options_source'])) {
                $model = app($field['options_source']['model']);
                $key = $field['options_source']['key'] ?? 'id';
                $label = $field['options_source']['label'] ?? 'nombre';
                $field['options'] = $model::all()->map(function ($item) use ($key, $label) {
                    return [
                        $key => $item[$key],
                        $label => $item[$label],
                    ];
                })->toArray(); // [['id'=>..., 'nombre'=>...], ...]
            }
        }
        unset($field);
    }

    public function openCreateModal($fieldName)
    {

        $this->showModal[$fieldName] = true;
        $this->newRelated[$fieldName] = [];
    }

    public function closeCreateModal($fieldName)
    {
        $this->showModal[$fieldName] = false;
        $this->newRelated[$fieldName] = [];
    }

    public function saveNewRelated($fieldName)
    {
        $field = collect($this->fields)->firstWhere('name', $fieldName);
        $modelClass = $field['create_model'];
        $data = $this->newRelated[$fieldName];

        // Validación simple (puedes mejorarla)
        foreach ($field['create_fields'] as $f) {
            if (($f['rules'] ?? '') === 'required' && empty($data[$f['name']])) {
                $this->addError("newRelated.$fieldName.{$f['name']}", "{$f['label']} es obligatorio.");
                return;
            }
        }

        $new = $modelClass::create($data);

        // Recarga las opciones
        $this->refreshOptions($fieldName);

        // Selecciona el nuevo valor
        $this->formData[$fieldName] = $new->{$field['valueField']};

        $this->closeCreateModal($fieldName);
    }

    public function refreshOptions($fieldName)
    {
        foreach ($this->fields as &$field) {
            if ($field['name'] === $fieldName && isset($field['options_source'])) {
                $model = app($field['options_source']['model']);
                $key = $field['options_source']['key'] ?? 'id';
                $label = $field['options_source']['label'] ?? 'nombre';
                $field['options'] = $model::all()->map(function ($item) use ($key, $label) {
                    return [
                        $key => $item[$key],
                        $label => $item[$label],
                    ];
                })->toArray();
            }
        }
        unset($field);
    }
    /**
     * Reglas de validación dinámicas basadas en la configuración de campos.
     */
    public function rules()
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules["formData.{$field['name']}"] = $field['rules'] ?? 'nullable';
        }
        return $rules;
    }

    /**
     * Guardar (crear o actualizar) el registro y mostrar mensaje de éxito.
     */
    public function save()
    {
        $validated = $this->validate();

        if ($this->model) {
            $this->model->update($validated['formData']);
            $this->successMessage = __('Actualizado correctamente');
        } else {
            $this->modelClass::create($validated['formData']);
            $this->successMessage = __('Creado correctamente');
            foreach ($this->fields as $field) {
                $this->formData[$field['name']] = $field['default'] ?? null;
            }
        }
        
        session()->flash('success', $this->successMessage);

        if ($this->redirectRoute) {
            return redirect()->route($this->redirectRoute);
        }

      //   Si no se pasa ruta, solo recarga
        return redirect()->back();
    }
    public function messages()
    {
        return $this->validationMessages ?? [];
    }

    public function render()
    {
        return view('livewire.component.form-plus');
    }
}
