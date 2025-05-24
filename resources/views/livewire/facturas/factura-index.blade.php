<div>
<x-page-header
title="🧾 Listado de Facturas"
subtitle=""
color="green"
:clickable="true"
badge="Nuevo"
icon="check"
footer="Texto de pie"
wire:key="factura-filtros"
>

    <div class="mb-4 flex flex-wrap gap-4 items-end" >
        <div>
            <label class="block text-sm font-semibold text-gray-600">Buscar por apellido:</label>

            <flux:input type="text" wire:model.live="search" label="Apellido"/>


        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600">Desde:</label>

            <flux:input type="date" wire:model.live="fechaInicio" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600">Hasta:</label>

            <flux:input type="date" wire:model.live="fechaFin" />
        </div>
        <flux:button wire:click="limpiar">Limpiar Busqueda</flux:button>
    </div>



    <table class="min-w-full bg-white border border-gray-200 text-sm">
        <thead class="bg-blue-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">N°</th>
                <th class="px-4 py-2 text-left">Paciente</th>
                <th class="px-4 py-2 text-left">Fecha</th>
                <th class="px-4 py-2 text-right">Total</th>
                <th class="px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($facturas as $factura)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $factura->numero_factura }}</td>
                    <td class="px-4 py-2">{{ $factura->paciente->nombre ?? '—' }} {{$factura->paciente->apellido }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-right">€{{ number_format($factura->total, 2) }}</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <a href="{{ route('facturas.edit', $factura->id) }}" class="text-blue-600 hover:underline">✏️ Editar</a>
                        <button wire:click="descargarPdf({{ $factura->id }})" class="bg-green-600 text-white px-3 py-1 rounded shadow hover:bg-green-700">📄 PDF</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4 text-gray-500">No hay facturas disponibles</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $facturas->links() }}
    </div>

</div>
</x-page-header>
</div>
