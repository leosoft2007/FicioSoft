<!-- filepath: resources/views/livewire/card/card-facturacion-servicios.blade.php -->
<div class="bg-white shadow rounded-lg overflow-hidden lg:col-span-2 h-full flex flex-col">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Facturación por Servicio (Últimos 30 días)</h3>
    </div>
    <div class="flex-1 p-6">
        <!-- Listado de servicios -->
        <ul class="space-y-4">
            @php
                $total = collect($facturacionServicios)->sum('total');
            @endphp

            @forelse ($facturacionServicios as $index => $servicio)
                @php
                    $porcentaje = $total > 0 ? round(($servicio['total'] / $total) * 100, 1) : 0;
                    $color = ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#ef4444'][$index % 5];
                @endphp
                <li class="flex flex-col space-y-2">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $color }};"></span>
                            <span class="font-medium text-gray-900">{{ $servicio['nombre'] }}</span>
                        </div>
                        <div class="text-right">
                            <span class="font-semibold text-gray-900">${{ number_format($servicio['total'], 2) }}</span>
                            <span class="ml-2 text-xs text-gray-500">({{ $porcentaje }}%)</span>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div
                            class="rounded-full h-2 transition-all duration-500 ease-in-out"
                            style="width: {{ $porcentaje }}%; background-color: {{ $color }};">
                        </div>
                    </div>
                </li>
            @empty
                <li class="text-center text-gray-500 py-10">
                    No hay datos de facturación disponibles.
                </li>
            @endforelse

            @if (!empty($facturacionServicios) && count($facturacionServicios) > 0)
                <li class="pt-4 mt-4 border-t border-gray-200 flex justify-between items-center font-bold text-gray-900">
                    <span>Total General</span>
                    <span>${{ number_format($total, 2) }}</span>
                </li>
            @endif
        </ul>
    </div>
    <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end">
        <a href="{{ route('facturas.listado') }}" class="text-sm font-medium text-green-600 hover:text-green-700">
            Ver reporte detallado
        </a>
    </div>
</div>
