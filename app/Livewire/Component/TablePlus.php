<?php

namespace App\Livewire\Component;

use Livewire\Component;
use Livewire\WithPagination;


class TablePlus extends Component
{
    use WithPagination;

    public string $modelClass;   // Ej: App\Models\Recibo
    public array $columns = [];  // Definición de columnas
    public array $filters = []; // Filtros avanzados dinámicos
    public string $search = '';
    public string $sortField = '';
    public string $sortDirection = 'asc';
    public $showMobileView = true;
    public $addRoute = null;
    public $showFiltro = false;
    public $title = 'Listado';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => ''],
        'sortDirection' => ['except' => 'asc'],
        'page' => ['except' => 1],
    ];

    public $routeShow = null;
    public $routeEdit = null;
    public $delete = false;

    public function mount($modelClass, $columns, $title = 'Listado', $routeShow = null, $routeEdit = null, $delete = false)
    {
        $this->modelClass = $modelClass;
        // Asigna sortable=true por defecto si no está definido
        $this->columns = array_map(function ($col) {
            if (!array_key_exists('sortable', $col)) {
                $col['sortable'] = true;
            }
            return $col;
        }, $columns);

        $this->title = $title;
        $this->routeShow = $routeShow;
        $this->routeEdit = $routeEdit;
        $this->delete = $delete;
        if (count($this->columns)) {
            $this->sortField = $this->columns[0]['field'];
        }
    }

    public function sort($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function getItemsProperty()
    {

        $query = ($this->modelClass)::query();
        // Busca la columna actual en el array de columnas
        $currentColumn = collect($this->columns)->firstWhere('field', $this->sortField);


        // Solo aplica orden si la columna es sortable
        if ($currentColumn && !empty($currentColumn['sortable'])) {
            if (str_contains($this->sortField, '.')) {
                [$relation, $field] = explode('.', $this->sortField, 2);

                $model = new $this->modelClass;
                $relationObj = $model->$relation();
                $relationTable = $relationObj->getRelated()->getTable();
                $foreignKey = $relationObj->getForeignKeyName();
                $parentTable = $model->getTable();

                $query->join($relationTable, "{$relationTable}.id", '=', "{$parentTable}." . $relationObj->getForeignKeyName())
                    ->orderBy("{$relationTable}.{$field}", $this->sortDirection)
                    ->select("{$parentTable}.*");
            } else {
                $query->orderBy($this->sortField, $this->sortDirection);
            }
        }

        // Búsqueda genérica
        if ($this->search) {
            $query->where(function ($q) {
                foreach ($this->columns as $column) {
                    if (!empty($column['searchable'])) {
                        if (str_contains($column['field'], '.')) {
                            [$relation, $field] = explode('.', $column['field'], 2);
                            $q->orWhereHas($relation, function ($qr) use ($field) {
                                $qr->where($field, 'like', '%' . $this->search . '%');
                            });
                        } else {
                            $q->orWhere($column['field'], 'like', '%' . $this->search . '%');
                        }
                    }
                }
            });
        }

        // Filtros avanzados

        foreach ($this->filters as $field => $value) {

            // Filtro Rango Numérico
            if (str_ends_with($field, '_min') && $value !== '') {
                $realField = str_replace('_min', '', $field);
                $mainTable = (new $this->modelClass)->getTable();
                $dbField = !str_contains($realField, '.') ? $mainTable . '.' . $realField : $realField;
                $query->where($dbField, '>=', $value);
                continue;
            }
            if (str_ends_with($field, '_max') && $value !== '') {
                $realField = str_replace('_max', '', $field);
                $mainTable = (new $this->modelClass)->getTable();
                $dbField = !str_contains($realField, '.') ? $mainTable . '.' . $realField : $realField;
                $query->where($dbField, '<=', $value);
                continue;
            }
            // Filtro Rango de Fecha
            if (str_ends_with($field, '_from') && $value !== '') {
                $realField = str_replace('_from', '', $field);
                $mainTable = (new $this->modelClass)->getTable();
                $dbField = !str_contains($realField, '.') ? $mainTable . '.' . $realField : $realField;
                $query->whereDate($dbField, '>=', $value);
                continue;
            }
            if (str_ends_with($field, '_to') && $value !== '') {
                $realField = str_replace('_to', '', $field);
                $mainTable = (new $this->modelClass)->getTable();
                $dbField = !str_contains($realField, '.') ? $mainTable . '.' . $realField : $realField;
                $query->whereDate($dbField, '<=', $value);
                continue;
            }
            // Filtro Select o texto exacto (valor único)
            if ($value !== '') {
                $mainTable = (new $this->modelClass)->getTable();
                $dbField = !str_contains($field, '.') ? $mainTable . '.' . $field : $field;

                if (is_array($value)) {
                    $query->whereIn($dbField, $value);
                } else {
                    $query->where($dbField, $value);
                }
            }


        }


        return $query->paginate(10);
    }

    public function resetFilters()
    {
        $this->filters = [];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.component.table-plus', [
            'items' => $this->items,
        ]);
    }
}
