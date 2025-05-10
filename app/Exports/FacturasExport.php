<?php

namespace App\Exports;

use App\Models\Factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class FacturasExport implements FromCollection, WithHeadings, WithMapping
{
    protected $facturas;

    public function __construct($facturas)
    {
        $this->facturas = $facturas;
    }

    public function collection()
    {
        return $this->facturas;
    }

    public function headings(): array
    {
        return [
            'N° Factura',
            'Paciente',
            'Fecha',
            'Total',
            'Estado',
            'Método de Pago',
            'Clínica',
            'Descripción',
        ];
    }

    public function map($factura): array
    {
        return [
            $factura->numero_factura,
            $factura->paciente->nombre . ' ' . $factura->paciente->apellido,
           \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y'),
            $factura->total,
            ucfirst($factura->estado),
            $factura->metodo_pago ? ucfirst($factura->metodo_pago) : 'No especificado',
            $factura->descripcion,
        ];
    }
}

