<?php

namespace App\Livewire\Component;

use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericExport;


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
    public $showExportExcel = true;
    public $showExportPdf = true;
    public int $perPage = 10;
    public array $fondoPalettes = [
        'verde' => 'bg-green-100 text-green-900 font-semibold',
        'azul' => 'bg-blue-100 text-blue-900 font-semibold',
        'indigo' => 'bg-indigo-100 text-indigo-900 font-semibold',
        'amarillo' => 'bg-yellow-100 text-yellow-900 font-semibold',
        'gris' => 'bg-gray-100 text-gray-900 font-semibold',
        'rojo' => 'bg-red-100 text-red-900 font-semibold',
        // o usa cadenas si prefieres
        'warning' => 'bg-yellow-100 text-yellow-800',
        'info'    => 'bg-blue-100 text-blue-800',
        'success' => 'bg-green-100 text-green-800',
        'error'   => 'bg-red-100 text-red-800',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => ''],
        'sortDirection' => ['except' => 'asc'],
        'page' => ['except' => 1],
    ];

    public $routeShow = null;
    public $routeEdit = null;
    public $delete = false;

    public function mount($modelClass, $columns, $title = 'Listado', $routeShow = null, $routeEdit = null, $delete = false, $showExportExcel = true, $showExportPdf = true)
    {
        $this->modelClass = $modelClass;
        // Asigna sortable=true por defecto si no está definido
        $this->columns = array_map(function ($col) {
            if (!array_key_exists('sortable', $col)) {
                $col['sortable'] = true;
            }
            return $col;
        }, $columns);

        $this->showExportExcel = $showExportExcel;
        $this->showExportPdf = $showExportPdf;

        $this->title = $title;
        $this->routeShow = $routeShow;
        $this->routeEdit = $routeEdit;
        $this->delete = $delete;
        if (count($this->columns)) {
            $this->sortField = $this->columns[0]['field'];
        }
    }

    protected function getTableColumns()
    {
        return array_filter($this->columns, fn($col) => !isset($col['visible']) || $col['visible']);
    }

    protected function getExportColumns()
    {
        return array_filter($this->columns, fn($col) => !isset($col['show_in_export']) || $col['show_in_export']);
    }

    public function exportExcel()
    {
        $query = $this->getExportQuery();
        $data = $query->get();

        return Excel::download(new GenericExport($data, $this->columns), 'listado.xlsx');
    }

    public function exportPdf()
    {
        $query = $this->getExportQuery();
        $data = $query->get();

        // Usamos una vista genérica y le pasamos los datos y columnas
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.generic-table', [
            'data' => $data,
            'columns' => $this->columns,
        ])->setPaper('a4', 'portrait'); // 'portrait' o 'landscape'
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'listado.pdf'
        );
    }

    protected function getExportQuery()
    {
        return $this->buildQuery();

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

    protected function buildQuery()
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
    $search = strtolower($this->search);
    $query->where(function ($q) use ($search) {
        foreach ($this->columns as $column) {
            if (!empty($column['searchable'])) {
                $fields = $column['search_fields'] ?? [$column['field']];
                foreach ($fields as $field) {
                    if (str_contains($field, '.')) {
                        [$relation, $relatedField] = explode('.', $field, 2);
                        $q->orWhereHas($relation, function ($qr) use ($relatedField, $search) {
                            $qr->whereRaw('LOWER(' . $relatedField . ') LIKE ?', ['%' . $search . '%']);
                        });
                    } else {
                        $q->orWhereRaw('LOWER(' . $field . ') LIKE ?', ['%' . $search . '%']);
                    }
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
        return $query;

    }

    public function getItemsProperty()
    {
        return $this->buildQuery()->paginate($this->perPage);
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
