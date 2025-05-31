<section class="w-full bg-gradient-to-b from-blue-50 to-white">
    <x-page-header
        title="Detalle del Recibo"
        subtitle="Información completa del recibo"
        color="blue"
    >
        <div class="flex items-center gap-2 bg-blue-100 px-4 py-2 rounded-full">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium text-blue-800">{{ $recibo->paciente->nombre_completo }}</span>
        </div>
    </x-page-header>

    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow-lg rounded-xl border border-blue-100">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h3 class="text-lg font-bold text-blue-800 flex items-center">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 17V15M12 17V13M15 17V11M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14.5858C14.851 3 15.1054 3.10536 15.2929 3.29289L18.7071 6.70711C18.8946 6.89464 19 7.149 19 7.41421V19C19 20.1046 18.1046 21 17 21Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                Detalles del Recibo
                            </h3>
                            <p class="mt-1 text-sm text-blue-600">Información detallada del recibo REC-{{ $recibo->id }}</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button  :href="route('recibos.index')" class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                {{ __('Volver') }}
                            </flux:button>
                        </div>
                    </div>

                    <div class="flow-root mt-6">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="mt-6 border-t border-blue-100">
                                    <dl class="divide-y divide-blue-100">
                                        <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-blue-50/50 transition-colors duration-150">
                                            <dt class="flex items-center text-sm font-medium leading-6 text-blue-800">
                                                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                                Paciente
                                            </dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0 flex items-center">
                                                {{ $recibo->paciente->nombre_completo }}
                                                <a href="{{ route('pacientes.show', $recibo->paciente_id) }}" class="ml-2 text-blue-600 hover:text-blue-800" title="Ver paciente">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                                    </svg>
                                                </a>
                                            </dd>
                                        </div>

                                        <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-blue-50/50 transition-colors duration-150">
                                            <dt class="flex items-center text-sm font-medium leading-6 text-blue-800">
                                                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 12H15M9 8H15M9 16H12M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                                Número
                                            </dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                    REC-{{ $recibo->id }}
                                                </span>
                                            </dd>
                                        </div>

                                        <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-blue-50/50 transition-colors duration-150">
                                            <dt class="flex items-center text-sm font-medium leading-6 text-blue-800">
                                                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                                Fecha
                                            </dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                    {{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}
                                                </span>
                                            </dd>
                                        </div>

                                        <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-blue-50/50 transition-colors duration-150">
                                            <dt class="flex items-center text-sm font-medium leading-6 text-blue-800">
                                                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Valor
                                            </dt>
                                            <dd class="mt-1 text-xl font-semibold leading-6 text-green-600 sm:col-span-2 sm:mt-0">
                                                €{{ number_format($recibo->valor, 2) }}
                                            </dd>
                                        </div>

                                        <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-blue-50/50 transition-colors duration-150">
                                            <dt class="flex items-center text-sm font-medium leading-6 text-blue-800">
                                                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                                Forma de Pago
                                            </dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                @php
                                                    $formaPagoColors = [
                                                        'Efectivo' => 'bg-green-100 text-green-800',
                                                        'Tarjeta' => 'bg-blue-100 text-blue-800',
                                                        'Transferencia' => 'bg-indigo-100 text-indigo-800',
                                                        'Cheque' => 'bg-yellow-100 text-yellow-800',
                                                    ];
                                                    $colorClass = $formaPagoColors[$recibo->formadepago] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="{{ $colorClass }} px-3 py-1 rounded-full text-sm font-medium">
                                                    {{ $recibo->formadepago }}
                                                </span>
                                            </dd>
                                        </div>

                                        <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-blue-50/50 transition-colors duration-150">
                                            <dt class="flex items-center text-sm font-medium leading-6 text-blue-800">
                                                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13 16H12C9.79086 16 8 14.2091 8 12V11M13 16V18C13 19.1046 13.8954 20 15 20H18C19.1046 20 20 19.1046 20 18V12C20 9.79086 18.2091 8 16 8H15M13 16H15C16.1046 16 17 15.1046 17 14V12C17 9.79086 15.2091 8 13 8H12M8 11V8C8 5.79086 9.79086 4 12 4H13C15.2091 4 17 5.79086 17 8V9M8 11H6C4.89543 11 4 10.1046 4 9V6C4 4.89543 4.89543 4 6 4H7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                                En concepto de
                                            </dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                @if($recibo->observacion)
                                                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                                        {{ $recibo->observacion }}
                                                    </div>
                                                @else
                                                    <span class="text-gray-400">Sin observaciones</span>
                                                @endif
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                                <!-- Acciones adicionales -->
                                <div class="mt-8 pt-6 border-t border-blue-100 flex justify-end space-x-3">
                                    <a href="{{ route('recibos.edit', $recibo->id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-yellow-100 border border-transparent rounded-md font-semibold text-yellow-800 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar Recibo
                                    </a>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-red-100 border border-transparent rounded-md font-semibold text-red-800 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150"
                                        type="button"
                                        wire:click="delete({{ $recibo->id }})"
                                        wire:confirm="¿Estás seguro de que quieres eliminar este recibo?">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Listado de facturas asociadas --}}
@if($recibo->facturas && $recibo->facturas->count())
<div class="mt-10">
    <h4 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V15M12 17V13M15 17V11M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14.5858C14.851 3 15.1054 3.10536 15.2929 3.29289L18.7071 6.70711C18.8946 6.89464 19 7.149 19 7.41421V19C19 20.1046 18.1046 21 17 21Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Facturas asociadas a este recibo
    </h4>
    <div class="overflow-x-auto rounded-lg border border-blue-100 bg-white">
        <table class="min-w-full divide-y divide-blue-100">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-blue-700 uppercase">Número Factura</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-blue-700 uppercase">Fecha</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-blue-700 uppercase">Valor asignado</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recibo->facturas as $factura)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="px-4 py-2">{{ $factura->numero }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">€{{ number_format($factura->pivot->valor, 2) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('facturas.show', $factura->id) }}" class="text-blue-600 hover:underline">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
    </div>
</section>
