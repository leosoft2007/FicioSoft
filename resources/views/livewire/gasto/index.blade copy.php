<section class="w-full bg-gradient-to-b from-purple-50 to-white">
    <section class="w-full">
        <x-page-header title="Gestión de Gastos" subtitle="Listado completo de gastos" color="purple"></x-page-header>

        <div class="py-8">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-6 bg-white shadow-lg rounded-xl border border-purple-100">
                    <div class="w-full">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h3 class="text-lg font-bold text-purple-800 flex items-center">
                                    <!-- SVG de dinero -->
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17 9V7C17 5.89543 16.1046 5 15 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H15C16.1046 19 17 18.1046 17 17V15"
                                            stroke="#6D28D9" stroke-width="2" stroke-linecap="round" />
                                        <path d="M21 13H19C17.8954 13 17 12.1046 17 11V5C17 3.89543 17.8954 3 19 3H21"
                                            stroke="#6D28D9" stroke-width="2" />
                                        <circle cx="12" cy="12" r="2" stroke="#6D28D9" stroke-width="2" />
                                    </svg>
                                    Registro de Gastos
                                </h3>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <flux:button variant="primary" :href="route('gastos.create')">
                                    <!-- SVG de añadir -->
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4V20M4 12H20" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                    {{ __('Add New') }}
                                </flux:button>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.500ms="buscar"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                                placeholder="Buscar por tipo de gasto y descripción...">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" class="text-purple-600 hover:text-purple-800 focus:outline-none"
                                    wire:click="$set('showFiltro', true)" title="Filtros avanzados">
                                    <!-- SVG de filtro/embudo -->
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A2 2 0 0013 14.586V19a1 1 0 01-1.447.894l-4-2A1 1 0 017 17v-2.414a2 2 0 00-.586-1.414L3.293 6.707A1 1 0 013 6V4z" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Filtro avanzado -->
                            @if ($showFiltro)
                                <div
                                    class="absolute right-0 top-12 z-50 w-72 bg-white rounded-lg shadow-lg border border-purple-100 p-6">
                                    <h3 class="text-lg font-bold mb-4">Filtros avanzados</h3>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-1">Método de Pago</label>
                                        <select wire:model="filtroMetodoPago" class="w-full border rounded px-2 py-1">
                                            <option value="">Todos</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 flex space-x-2">
                                        <div class="w-1/2">
                                            <label class="block text-sm font-medium mb-1">Desde</label>
                                            <input type="date" wire:model="filtroFechaInicio" class="w-full border rounded px-2 py-1">
                                        </div>
                                        <div class="w-1/2">
                                            <label class="block text-sm font-medium mb-1">Hasta</label>
                                            <input type="date" wire:model="filtroFechaFin" class="w-full border rounded px-2 py-1">
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button wire:click="$set('showFiltro', false)"
                                            class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">Cerrar</button>
                                        <button wire:click="$set('showFiltro', false)"
                                            class="px-3 py-1 rounded bg-purple-600 text-white hover:bg-purple-700">Aplicar</button>
                                    </div>
                                </div>
                            @endif
                        </div>


                        <div class="flow-root mt-6">
                            <div class="overflow-x-auto rounded-lg border border-purple-50">
                                <div class="inline-block min-w-full py-2 align-middle">
                                    <div class="hidden md:block">
                                    <table class="w-full divide-y divide-purple-200">
                                        <thead class="bg-purple-600 text-white">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <!-- SVG de etiqueta -->
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M7 7H7.01M7 3H12C12.5119 3 12.9995 3.19439 13.3666 3.5403L20.3666 10.0403C21.2111 10.8097 21.2111 12.0601 20.3666 12.8295L13.3666 19.3295C12.9995 19.6754 12.5119 19.8698 12 19.8698H4C2.89543 19.8698 2 18.9744 2 17.8698V7C2 4.79086 3.79086 3 7 3Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        Tipo de Gasto
                                                    </span>
                                                </th>
                                                <th scope="col"
                                                    class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <!-- SVG de descripción -->
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9 12H15M9 8H15M9 16H12M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        Descripción
                                                    </span>
                                                </th>
                                                <th scope="col"
                                                    class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <!-- SVG de monto -->
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16 8V4M8 8V4M4 8H20M4 8V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V8M4 8H3M20 8H21"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                            <circle cx="12" cy="14" r="2"
                                                                stroke="currentColor" stroke-width="2" />
                                                        </svg>
                                                        Monto
                                                    </span>
                                                </th>
                                                <th scope="col"
                                                    class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <!-- SVG de calendario -->
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8 4V6M16 4V6M3 10H21M5 8H19C20.1046 8 21 8.89543 21 10V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V10C3 8.89543 3.89543 8 5 8Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        Fecha
                                                    </span>
                                                </th>
                                                <th scope="col"
                                                    class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <!-- SVG de método de pago -->
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                        Método Pago
                                                    </span>
                                                </th>

                                                <th scope="col"
                                                    class="py-3 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <!-- SVG de acciones -->
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
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
                                        <tbody class="divide-y divide-purple-100 bg-white">
                                            @foreach ($gastos as $gasto)
                                                <tr class="hover:bg-purple-50 transition-colors duration-150"
                                                    wire:key="{{ $gasto->id }}">
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                                        <span
                                                            class="bg-pink-100 text-pink-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                            <!-- SVG pequeño de etiqueta -->
                                                            <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M7 7H7.01M7 3H12C12.5119 3 12.9995 3.19439 13.3666 3.5403L20.3666 10.0403C21.2111 10.8097 21.2111 12.0601 20.3666 12.8295L13.3666 19.3295C12.9995 19.6754 12.5119 19.8698 12 19.8698H4C2.89543 19.8698 2 18.9744 2 17.8698V7C2 4.79086 3.79086 3 7 3Z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            {{ $gasto->tipoGasto->nombre }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-800">
                                                        {{ $gasto->descripcion }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm font-semibold text-red-600">
                                                        €{{ number_format($gasto->monto, 2) }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                                        <span
                                                            class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                            <!-- SVG pequeño de calendario -->
                                                            <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8 4V6M16 4V6M3 10H21M5 8H19C20.1046 8 21 8.89543 21 10V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V10C3 8.89543 3.89543 8 5 8Z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            {{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}
                                                        </span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                                        @php
                                                            $metodoPagoColors = [
                                                                'Efectivo' => 'bg-green-100 text-green-800',
                                                                'Tarjeta' => 'bg-blue-100 text-blue-800',
                                                                'Transferencia' => 'bg-indigo-100 text-indigo-800',
                                                                'Cheque' => 'bg-yellow-100 text-yellow-800',
                                                            ];
                                                            $colorClass =
                                                                $metodoPagoColors[$gasto->metodo_pago] ??
                                                                'bg-gray-100 text-gray-800';
                                                        @endphp
                                                        <span
                                                            class="{{ $colorClass }} px-2 py-1 rounded-full text-xs flex items-center">
                                                            <!-- SVG pequeño de método de pago -->
                                                            <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                            {{ $gasto->metodo_pago }}
                                                        </span>
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap py-4 pr-6 pl-3 text-right text-sm font-medium">
                                                        <div class="flex justify-end space-x-2">
                                                            <a wire:navigate
                                                                href="{{ route('gastos.show', $gasto->id) }}"
                                                                class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded hover:bg-blue-50 transition-colors flex items-center"
                                                                title="Ver detalles">
                                                                <!-- SVG de ojo -->
                                                                <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                                href="{{ route('gastos.edit', $gasto->id) }}"
                                                                class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded hover:bg-indigo-50 transition-colors flex items-center"
                                                                title="Editar">
                                                                <!-- SVG de editar -->
                                                                <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                                wire:click="delete({{ $gasto->id }})"
                                                                wire:confirm="¿Estás seguro de que quieres eliminar este gasto?"
                                                                title="Eliminar">
                                                                <!-- SVG de eliminar -->
                                                                <svg class="w-4 h-4" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                    <div class="mt-4 px-6 py-3 bg-purple-50 border-t border-purple-100 rounded-b-lg">
                                        {!! $gastos->withQueryString()->links() !!}
                                    </div>
                                    </div>
                                    <!--vista de movil-->
                                    <div class="block md:hidden space-y-4 mt-6">
                                        @foreach ($gastos as $gasto)
                                            <div class="bg-white rounded-xl shadow border border-purple-100 p-4 flex flex-col space-y-2">
                                                <div class="flex items-center justify-between">
                                                    <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M7 7H7.01M7 3H12C12.5119 3 12.9995 3.19439 13.3666 3.5403L20.3666 10.0403C21.2111 10.8097 21.2111 12.0601 20.3666 12.8295L13.3666 19.3295C12.9995 19.6754 12.5119 19.8698 12 19.8698H4C2.89543 19.8698 2 18.9744 2 17.8698V7C2 4.79086 3.79086 3 7 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                                        {{ $gasto->tipoGasto->nombre }}
                                                    </span>
                                                    <span class="font-semibold text-red-600">€{{ number_format($gasto->monto, 2) }}</span>
                                                </div>
                                                <div class="text-sm text-gray-800 font-medium">{{ $gasto->descripcion }}</div>
                                                <div class="flex items-center text-xs text-gray-600 space-x-2">
                                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full flex items-center">
                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M8 4V6M16 4V6M3 10H21M5 8H19C20.1046 8 21 8.89543 21 10V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V10C3 8.89543 3.89543 8 5 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                                        {{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}
                                                    </span>
                                                    @php
                                                        $metodoPagoColors = [
                                                            'Efectivo' => 'bg-green-100 text-green-800',
                                                            'Tarjeta' => 'bg-blue-100 text-blue-800',
                                                            'Transferencia' => 'bg-indigo-100 text-indigo-800',
                                                            'Cheque' => 'bg-yellow-100 text-yellow-800'
                                                        ];
                                                        $colorClass = $metodoPagoColors[$gasto->metodo_pago] ?? 'bg-gray-100 text-gray-800';
                                                    @endphp
                                                    <span class="{{ $colorClass }} px-2 py-1 rounded-full flex items-center">
                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                                        {{ $gasto->metodo_pago }}
                                                    </span>
                                                </div>
                                                <div class="flex justify-end space-x-2 mt-2">
                                                    <a wire:navigate href="{{ route('gastos.show', $gasto->id) }}"
                                                       class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded hover:bg-blue-50 transition-colors flex items-center"
                                                       title="Ver detalles">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </a>
                                                    <a wire:navigate href="{{ route('gastos.edit', $gasto->id) }}"
                                                       class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded hover:bg-indigo-50 transition-colors flex items-center"
                                                       title="Editar">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </a>
                                                    <button
                                                        class="text-red-600 hover:text-red-900 px-2 py-1 rounded hover:bg-red-50 transition-colors flex items-center"
                                                        type="button"
                                                        wire:click="delete({{ $gasto->id }})"
                                                        wire:confirm="¿Estás seguro de que quieres eliminar este gasto?"
                                                        title="Eliminar"
                                                    >
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M4 7H20M10 11V17M14 11V17M5 7L6 19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19L19 7M9 7V4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="mt-4 px-2 py-3 bg-purple-50 border-t border-purple-100 rounded-b-lg">
                                            {!! $gastos->withQueryString()->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:component.table-plus
        :model-class="\App\Models\Gasto::class"
        :columns="$columnsGastos"
        add-route="{{ route('gastos.create') }}" title="Lista de Gastos"
        :delete="false"
        :showExportExcel="true"
        :showExportPdf="true"
        estilo="amarillo"

    />


    </section>
