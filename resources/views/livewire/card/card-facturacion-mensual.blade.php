<!-- filepath: resources/views/livewire/card/card-facturacion-mensual.blade.php -->
<div class="bg-white shadow rounded-lg overflow-hidden h-full flex flex-col">
    <div class="flex-1 px-4 py-5 sm:p-6 flex items-center">
        <div class="rounded-full bg-green-100 p-3 mr-4">
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-900">Facturación Mensual</h3>
            <p class="text-2xl font-semibold text-gray-900">€{{ number_format($facturacionMes, 2) }}</p>
            <p class="text-sm text-gray-500">
                @if($comparacionFacturacion >= 0)
                    <span class="text-green-600">↑ {{ $comparacionFacturacion }}%</span> vs mes anterior
                @else
                    <span class="text-red-600">↓ {{ abs($comparacionFacturacion) }}%</span> vs mes anterior
                @endif
            </p>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <a href="{{ route('facturas.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
            Ver reporte completo
        </a>
    </div>
</div>
