<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class GenericExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $columns;

    public function __construct($data, $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return collect($this->columns)->map(function ($col) use ($item) {
                return data_get($item, $col['field']);
            });
        });
    }

    public function headings(): array
    {
        return collect($this->columns)->pluck('label')->toArray();
    }
}
