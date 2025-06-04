<section class="w-full bg-gradient-to-b from-indigo-50 to-white">
    <section class="w-full">
        <x-page-header title="Gestión de Recibos" subtitle="Listado completo de recibos" color="indigo">
            <div class="flex items-center gap-2 bg-indigo-100 px-4 py-2 rounded-full">
                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium text-indigo-800">{{ $recibos->total() }} recibos registrados</span>
            </div>
        </x-page-header>

        <div class="py-8">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-6 bg-white shadow-lg rounded-xl border border-indigo-100">
                    <div class="w-full">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h3 class="text-lg font-bold text-indigo-800 flex items-center">
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 17V15M12 17V13M15 17V11M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14.5858C14.851 3 15.1054 3.10536 15.2929 3.29289L18.7071 6.70711C18.8946 6.89464 19 7.149 19 7.41421V19C19 20.1046 18.1046 21 17 21Z"
                                            stroke="#4F46E5" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    Registro de Recibos
                                </h3>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <flux:button variant="primary" :href="route('recibos.create')">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4V20M4 12H20" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                    {{ __('Add New') }}
                                </flux:button>
                            </div>
                        </div>

                        <!-- Barra de búsqueda y filtros -->
                        <div class="relative mt-4">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.500ms="buscar"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Buscar por número de recibo, paciente...">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" class="text-indigo-600 hover:text-indigo-800 focus:outline-none"
                                    wire:click="$set('showFiltro', true)" title="Filtros avanzados">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A2 2 0 0013 14.586V19a1 1 0 01-1.447.894l-4-2A1 1 0 017 17v-2.414a2 2 0 00-.586-1.414L3.293 6.707A1 1 0 013 6V4z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Filtro avanzado -->
                            @if ($showFiltro)
                                <div
                                    class="absolute right-0 top-12 z-50 w-72 bg-white rounded-lg shadow-lg border border-indigo-100 p-6">
                                    <h3 class="text-lg font-bold mb-4">Filtros avanzados</h3>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-1">Forma de Pago</label>
                                        <select wire:model="filtroFormaPago" class="w-full border rounded px-2 py-1">
                                            <option value="">Todas</option>
                                            <option value="efectivo">Efectivo</option>
                                            <option value="tarjeta">Tarjeta</option>
                                            <option value="transferencia">Transferencia</option>
                                            <option value="bizum">Bizum</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 flex space-x-2">
                                        <div class="w-1/2">
                                            <label class="block text-sm font-medium mb-1">Desde</label>
                                            <input type="date" wire:model="filtroFechaInicio"
                                                class="w-full border rounded px-2 py-1">
                                        </div>
                                        <div class="w-1/2">
                                            <label class="block text-sm font-medium mb-1">Hasta</label>
                                            <input type="date" wire:model="filtroFechaFin"
                                                class="w-full border rounded px-2 py-1">
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button wire:click="resetFilters"
                                            class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">Limpiar</button>
                                        <button wire:click="$set('showFiltro', false)"
                                            class="px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700">Aplicar</button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="flow-root mt-6">
                            <div class="overflow-x-auto rounded-lg border border-indigo-50">
                                <div class="inline-block min-w-full py-2 align-middle">
                                    <!-- Vista de escritorio -->
                                    <div class="hidden md:block">
                                        <table class="w-full divide-y divide-indigo-200">
                                            <thead class="bg-indigo-600 text-white">
                                                <tr>
                                                    <th scope="col"
                                                        class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9 12H15M9 8H15M9 16H12M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            Número
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            Paciente
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            Fecha
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            Valor
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            Forma de Pago
                                                        </span>
                                                    </th>
                                                    <th scope="col"
                                                        class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 6H12.01M12 12H12.01M12 18H12.01M13 6C13 6.55228 12.5523 7 12 7C11.4477 7 11 6.55228 11 6C11 5.44772 11.4477 5 12 5C12.5523 5 13 5.44772 13 6ZM13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12ZM13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17C12.5523 17 13 17.4477 13 18Z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            Acciones
                                                        </span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-indigo-100 bg-white">
                                                @foreach ($recibos as $recibo)
                                                    <tr class="hover:bg-indigo-50 transition-colors duration-150"
                                                        wire:key="{{ $recibo->id }}">
                                                        <td
                                                            class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-800">
                                                            <span
                                                                class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                                <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9 12H15M9 8H15M9 16H12M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                              REC-{{ $recibo->id }}
                                                            </span>
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="h-4 w-4 text-indigo-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                </svg>
                                                                {{ $recibo->paciente->nombre_completo ?? 'N/A' }}
                                                            </div>
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                                            <span
                                                                class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                                <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                                {{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-3 py-4 text-sm font-semibold text-green-600">
                                                            €{{ number_format($recibo->valor, 2) }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                                            @php
                                                                $formaPagoColors = [
                                                                    'efectivo' => 'bg-green-100 text-green-800',
                                                                    'tarjeta' => 'bg-blue-100 text-blue-800',
                                                                    'transferencia' => 'bg-indigo-100 text-indigo-800',
                                                                    'bizum' => 'bg-yellow-100 text-yellow-800',
                                                                ];
                                                                $colorClass =
                                                                    $formaPagoColors[$recibo->formadepago] ?? 'bg-gray-100 text-gray-800';
                                                            @endphp
                                                            <span
                                                                class="{{ $colorClass }} px-2 py-1 rounded-full text-xs flex items-center">
                                                                <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                                {{ $recibo->formadepago }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap py-4 pr-6 pl-3 text-right text-sm font-medium">
                                                            <div class="flex justify-end space-x-2">
                                                                <a wire:navigate
                                                                    href="{{ route('recibos.show', $recibo->id) }}"
                                                                    class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded hover:bg-blue-50 transition-colors flex items-center"
                                                                    title="Ver detalles">
                                                                    <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </a>
                                                                <a wire:navigate
                                                                    href="{{ route('recibos.edit', $recibo->id) }}"
                                                                    class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded hover:bg-indigo-50 transition-colors flex items-center"
                                                                    title="Editar">
                                                                    <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </a>
                                                                <button
                                                                    class="text-red-600 hover:text-red-900 px-2 py-1 rounded hover:bg-red-50 transition-colors flex items-center"
                                                                    type="button"
                                                                    wire:click="delete({{ $recibo->id }})"
                                                                    wire:confirm="¿Estás seguro de que quieres eliminar este recibo?"
                                                                    title="Eliminar">
                                                                    <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M4 7H20M10 11V17M14 11V17M5 7L6 19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19L19 7M9 7V4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V7"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div
                                            class="mt-4 px-6 py-3 bg-indigo-50 border-t border-indigo-100 rounded-b-lg">
                                            {!! $recibos->withQueryString()->links() !!}
                                        </div>
                                    </div>

                                    <!-- Vista móvil -->
                                    <div class="block md:hidden space-y-4 mt-6">
                                        @foreach ($recibos as $recibo)
                                            <div
                                                class="bg-white rounded-xl shadow border border-indigo-100 p-4 flex flex-col space-y-2">
                                                <div class="flex items-center justify-between">
                                                    <span
                                                        class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M9 12H15M9 8H15M9 16H12M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        Rec-{{ $recibo->id }}
                                                    </span>
                                                    <span
                                                        class="font-semibold text-green-600">€{{ number_format($recibo->valor, 2) }}</span>
                                                </div>
                                                <div class="text-sm text-gray-800 font-medium flex items-center gap-2">
                                                    <svg class="h-4 w-4 text-indigo-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    {{ $recibo->paciente->nombre_completo ?? 'N/A' }}
                                                </div>
                                                <div class="flex items-center text-xs text-gray-600 space-x-2">
                                                    <span
                                                        class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full flex items-center">
                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}
                                                    </span>
                                                    @php
                                                        $formaPagoColors = [
                                                            'efectivo' => 'bg-green-100 text-green-800',
                                                            'tarjeta' => 'bg-blue-100 text-blue-800',
                                                            'transferencia' => 'bg-indigo-100 text-indigo-800',
                                                            'bizum' => 'bg-yellow-100 text-yellow-800',
                                                        ];
                                                        $colorClass = $formaPagoColors[$recibo->formadepago] ?? 'bg-gray-100 text-gray-800';
                                                    @endphp
                                                    <span
                                                        class="{{ $colorClass }} px-2 py-1 rounded-full flex items-center">
                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        {{ $recibo->formadepago }}
                                                    </span>
                                                </div>
                                                <div class="flex justify-end space-x-2 mt-2">
                                                    <a wire:navigate href="{{ route('recibos.show', $recibo->id) }}"
                                                        class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded hover:bg-blue-50 transition-colors flex items-center"
                                                        title="Ver detalles">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                    <a wire:navigate href="{{ route('recibos.edit', $recibo->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded hover:bg-indigo-50 transition-colors flex items-center"
                                                        title="Editar">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                    <button
                                                        class="text-red-600 hover:text-red-900 px-2 py-1 rounded hover:bg-red-50 transition-colors flex items-center"
                                                        type="button" wire:click="delete({{ $recibo->id }})"
                                                        wire:confirm="¿Estás seguro de que quieres eliminar este recibo?"
                                                        title="Eliminar">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M4 7H20M10 11V17M14 11V17M5 7L6 19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19L19 7M9 7V4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V7"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div
                                            class="mt-4 px-2 py-3 bg-indigo-50 border-t border-indigo-100 rounded-b-lg">
                                            {!! $recibos->withQueryString()->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
