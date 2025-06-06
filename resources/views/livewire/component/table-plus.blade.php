<section class="w-full bg-white">
    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow-lg rounded-xl border {{ $estilo['border'] }}">
                <div class="w-full">
                    @include('livewire.component.table-plus-header')
                    <!-- Buscador y filtros -->
                    @include('livewire.component.table-plus-buscar')


                    <!-- Vista de escritorio -->

                    {{--
                                Tabla responsiva de escritorio.
                                - Columnas y filas renderizadas con formato
                                - Acciones (ver, editar, eliminar) con SVGs y tooltips
                                - Pagina la tabla
                                - Usa variables $columns, $items, $sortField, $sortDirection, $routeShow, $routeEdit, $delete
                                --}}


                    <div class="flow-root mt-6">
                        <div class="overflow-x-auto rounded-2xl shadow-lg border {{ $estilo['border'] }} bg-white">
                            <!-- sombra + redondeado + fondo -->
                            <div class="inline-block min-w-full py-0 align-middle">
                                <div class="hidden md:block">
                                    <table class="w-full {{ $estilo['divide'] }} rounded-2xl overflow-hidden">
                                        <!-- redondeado tabla -->
                                        <thead class="{{ $estilo['thead'] }}">
                                            <tr>
                                                @foreach ($columns as $column)
                                                    @if (!isset($column['visible']) || $column['visible'])
                                                        <th wire:click="sort('{{ $column['field'] }}')"
                                                            class="py-3 pl-6 pr-3 text-center text-xs font-bold uppercase tracking-wider cursor-pointer select-none">
                                                            <span class="flex items-center">
                                                                @if ($sortField === $column['field'])
                                                                    @if ($sortDirection === 'asc')
                                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 20 20"
                                                                            fill="currentColor">
                                                                            <path
                                                                                d="M10 3a1 1 0 01.894.553l3 6A1 1 0 0113 11H7a1 1 0 01-.894-1.447l3-6A1 1 0 0110 3z" />
                                                                        </svg>
                                                                    @else
                                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 20 20"
                                                                            fill="currentColor">
                                                                            <path
                                                                                d="M10 17a1 1 0 01-.894-.553l-3-6A1 1 0 017 9h6a1 1 0 01.894 1.447l-3 6A1 1 0 0110 17z" />
                                                                        </svg>
                                                                    @endif
                                                                @endif
                                                                {{ $column['label'] }}
                                                            </span>
                                                        </th>
                                                    @endif
                                                @endforeach
                                                <th
                                                    class="py-3 pr-6 pl-3 text-left text-xs font-bold uppercase tracking-wider">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none">
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
                                        <tbody class="divide-y {{ $estilo['divide'] }} bg-white">
                                            @forelse($items as $item)
                                                <tr class="{{ $estilo['row_hover'] }} transition-colors duration-150">

                                                    @foreach ($columns as $column)
                                                        @if (!isset($column['visible']) || $column['visible'])
                                                            <td
                                                                class="whitespace-nowrap px-3 py-4 text-sm
                                                            @if (($column['format'] ?? null) === 'nombre') text-gray-700 @endif">
                                                                @php
                                                                    $value = data_get($item, $column['field']);
                                                                    $format = $column['format'] ?? null;
                                                                @endphp

                                                                {{-- Fecha --}}
                                                                @if ($format === 'date' && !empty($value))
                                                                    <span
                                                                        class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs flex items-center justify-center text-center">
                                                                        <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                            fill="none">
                                                                            <path
                                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" />
                                                                        </svg>
                                                                        {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                                                                    </span>
                                                                    {{-- Valor monetario --}}
                                                                @elseif($format === 'money' && isset($value))
                                                                    @php
                                                                        $positivo = $value >= 0;
                                                                        $symbol = '€';
                                                                        $color = $positivo
                                                                            ? 'bg-green-100 text-green-800'
                                                                            : 'bg-red-100 text-red-800';
                                                                    @endphp
                                                                    <span
                                                                        class="{{ $color }} px-2 py-1 rounded-full text-xs flex items-center justify-end text-right font-semibold">
                                                                        {{ $symbol }}
                                                                        {{ number_format(abs($value), 2) }}
                                                                    </span>
                                                                    {{-- Badge genérico --}}
                                                                @elseif($format === 'badge')
                                                                    @php
                                                                        $badge_map = $column['badge_map'] ?? [];
                                                                        $badge = $badge_map[$value] ?? 'gris';
                                                                        $colorClass =
                                                                            $this->fondoPalettes[$badge] ??
                                                                            $this->fondoPalettes['gris'];
                                                                        $icon = $column['icon'] ?? '';
                                                                    @endphp
                                                                    <span
                                                                        class="{{ $colorClass }} px-2 py-1 rounded-full text-xs flex items-center justify-center text-center">
                                                                        {!! $icon !!}{{ $value }}
                                                                    </span>
                                                                    {{-- Nombre --}}
                                                                @elseif($format === 'nombre')
                                                                    @php
                                                                        // Si hay concat_fields, arma el string
                                                                        if (isset($column['concat_fields'])) {
                                                                            $fields = $column['concat_fields'];
                                                                            $separator =
                                                                                $column['concat_separator'] ?? ' ';
                                                                            $parts = [];
                                                                            foreach ($fields as $field) {
                                                                                $part = data_get($item, $field);
                                                                                if (!empty($part)) {
                                                                                    $parts[] = $part;
                                                                                }
                                                                            }
                                                                            $display = implode($separator, $parts);
                                                                        } else {
                                                                            $display = $value;
                                                                        }
                                                                    @endphp
                                                                    <div class="flex items-center gap-2">
                                                                        <svg class="h-4 w-4 text-indigo-400"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                        </svg>
                                                                        {{ $display }}
                                                                    </div>
                                                                @elseif ($format === 'custom' && isset($column['render']) && is_callable($column['render']))
                                                                    {!! $column['render']($item, $value) !!}
                                                                @elseif ($format === 'contacto')
                                                                    @php
                                                                        $email = data_get(
                                                                            $item,
                                                                            $column['email_field'] ?? 'email',
                                                                        );
                                                                        $telefono = data_get(
                                                                            $item,
                                                                            $column['telefono_field'] ?? 'telefono',
                                                                        );
                                                                    @endphp
                                                                    <div class="flex flex-col gap-1">
                                                                        <div class="flex items-center gap-2">
                                                                            <svg class="h-4 w-4 text-gray-400"
                                                                                fill="none" stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                            </svg>
                                                                            <span
                                                                                class="text-gray-700">{{ $email }}</span>
                                                                        </div>
                                                                        <div class="flex items-center gap-2">
                                                                            <svg class="h-4 w-4 text-gray-400"
                                                                                fill="none" stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                            </svg>
                                                                            <span
                                                                                class="text-gray-700">{{ $telefono }}</span>
                                                                        </div>
                                                                    </div>
                                                                @elseif ($format === 'color')
                                                                    <div
                                                                        class="px-6 py-4 text-sm font-medium text-gray-900">
                                                                        <div class="flex items-center gap-2">
                                                                            <span
                                                                                class="inline-block w-4 h-4 rounded-full border"
                                                                                style="background-color: {{ $value }};">
                                                                            </span>

                                                                        </div>
                                                                    </div>
                                                                @elseif($format === 'limit_html')
                                                                    {{ \Illuminate\Support\Str::limit(strip_tags($value ), 80) }}
                                                                @elseif ($format === 'fondo')
                                                                    @php
                                                                        $paletteKey = $column['fondo_palette'] ?? 'gris'; // Por defecto el gris si no hay clave
                                                                        $fondoClass = $fondoPalettes[$paletteKey] ?? $fondoPalettes['gris'];
                                                                    @endphp
                                                                    <span class="{{ $fondoClass }} px-3 py-1 rounded-lg block text-center">
                                                                        {{ $value }}
                                                                    </span>
                                                                    {{-- Genérico --}}
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    @php
                                                        // Calcula las URLs una sola vez y valídalas aquí
                                                        $showRouteUrl =
                                                            isset($routeShow) && $routeShow
                                                                ? route($routeShow, $item->id)
                                                                : null;
                                                        $editRouteUrl =
                                                            isset($routeEdit) && $routeEdit
                                                                ? route($routeEdit, $item->id)
                                                                : null;
                                                    @endphp

                                                    <!-- acciones Vista de escritorio -->
                                                    <td
                                                        class="whitespace-nowrap py-4 pr-6 pl-3 text-right text-sm font-medium">
                                                        <div class="flex justify-end space-x-2">
                                                            @if ($showRouteUrl)
                                                                <a href="{{ $showRouteUrl }}"
                                                                    class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded hover:bg-blue-50 transition-colors flex items-center"
                                                                    title="Ver detalles">
                                                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                        fill="none">
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
                                                            @endif
                                                            @if ($editRouteUrl)
                                                                <a href="{{ $editRouteUrl }}"
                                                                    class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded hover:bg-indigo-50 transition-colors flex items-center"
                                                                    title="Editar">
                                                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <path
                                                                            d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                            @if (!empty($delete))
                                                                <button
                                                                    wire:click="$emit('deleteItem', {{ $item->id }})"
                                                                    class="text-red-600 hover:text-red-900 px-2 py-1 rounded hover:bg-red-50 transition-colors flex items-center"
                                                                    title="Eliminar">
                                                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <path
                                                                            d="M4 7H20M10 11V17M14 11V17M5 7L6 19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19L19 7M9 7V4C9 3.44772 9 3 10 3H14C14.5523 3 15 3.44772 15 4V7"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </button>
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="{{ count($columns) + 1 }}" class="text-center py-4">
                                                        Sin resultados.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="mt-4 px-6 py-3 {{ $estilo['footer_bg'] }} rounded-b-lg">
                                        <div
                                            class="flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                                            {{-- Paginador --}}
                                            <div>
                                                {{ $items->links() }}
                                            </div>
                                            {{-- Selector de cantidad por página --}}
                                            <div class="flex items-center gap-2">
                                                <label for="perPage" class="text-sm text-gray-700">Mostrar</label>
                                                <select wire:model.live="perPage" id="perPage"
                                                    class="border rounded px-2 py-1 text-sm bg-accent-foreground">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="1000">Todos</option>
                                                </select>
                                                <span class="text-sm text-gray-700">resultados</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Fin Vista de escritorio -->

                                <!-- Vista móvil -->
                                {{--
                                    Vista tipo "tarjetas" para móviles.
                                    - Muestra solo las columnas con ['show_in_mobile' => true]
                                    - Acciones accesibles (ver, editar, eliminar)
                                    - Paginación clara y accesible
                                    --}}


                                <div class="block md:hidden space-y-4 mt-6">
                                    @foreach ($items as $item)
                                        <div class="bg-white rounded-xl shadow border border-indigo-100 p-4">
                                            <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                                                @foreach ($columns as $column)
                                                    @if (!empty($column['show_in_mobile']))
                                                        @php
                                                            $value = data_get($item, $column['field']);
                                                            $format = $column['format'] ?? null;
                                                        @endphp
                                                        {{-- Label: ocupa 1 columna --}}
                                                        <div class="flex items-center text-sm col-span-1">
                                                            <span class="font-bold text-indigo-600 mr-1">
                                                                {{ $column['label'] }}:
                                                            </span>
                                                        </div>
                                                        {{-- Value: ocupa 2 columnas --}}
                                                        <div class="flex items-center text-sm col-span-2">
                                                            @if ($format === 'date' && !empty($value))
                                                                <span
                                                                    class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs flex items-center">
                                                                    <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <path
                                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" />
                                                                    </svg>
                                                                    {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                                                                </span>
                                                            @elseif($format === 'money' && isset($value))
                                                                @php
                                                                    $positivo = $value >= 0;
                                                                    $symbol = '€';
                                                                    $color = $positivo
                                                                        ? 'bg-green-100 text-green-800'
                                                                        : 'bg-red-100 text-red-800';
                                                                @endphp
                                                                <span
                                                                    class="{{ $color }} px-2 py-1 rounded-full text-xs flex items-center font-semibold">
                                                                    {{ $symbol }}{{ number_format(abs($value), 2) }}
                                                                </span>
                                                            @elseif($format === 'badge')
                                                                @php
                                                                    $badge_map = $column['badge_map'] ?? [];
                                                                    $badge = $badge_map[$value] ?? 'gris';
                                                                    $colorClass =
                                                                        $this->fondoPalettes[$badge] ??
                                                                        $this->fondoPalettes['gris'];
                                                                    $icon = $column['icon'] ?? '';
                                                                @endphp
                                                                <span
                                                                    class="{{ $colorClass }} px-2 py-1 rounded-full text-xs flex items-center">
                                                                    {!! $icon !!}{{ $value }}
                                                                </span>
                                                            @elseif($format === 'nombre' && !empty($value))
                                                                <div class="flex items-center gap-2">
                                                                    <svg class="h-4 w-4 text-indigo-400"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                    </svg>
                                                                    {{ $value }}
                                                                </div>
                                                            @elseif($format === 'contacto')
                                                                @php
                                                                    $email = data_get(
                                                                        $item,
                                                                        $column['email_field'] ?? 'email',
                                                                    );
                                                                    $telefono = data_get(
                                                                        $item,
                                                                        $column['telefono_field'] ?? 'telefono',
                                                                    );
                                                                @endphp
                                                                <div>
                                                                    <div class="flex items-center gap-2">
                                                                        <svg class="h-4 w-4 text-gray-400"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                        </svg>
                                                                        <span
                                                                            class="text-gray-700">{{ $email }}</span>
                                                                    </div>
                                                                    <div class="flex items-center gap-2 mt-1">
                                                                        <svg class="h-4 w-4 text-gray-400"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                        </svg>
                                                                        <span
                                                                            class="text-gray-700">{{ $telefono }}</span>
                                                                    </div>
                                                                </div>
                                                            @elseif ($format === 'color')
                                                                <div
                                                                    class="px-6 py-4 text-sm font-medium text-gray-900">
                                                                    <div class="flex items-center gap-2">
                                                                        <span
                                                                            class="inline-block w-4 h-4 rounded-full border"
                                                                            style="background-color: {{ $value }};">
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <!-- Acciones -->
                                            <div class="flex justify-end space-x-2 mt-2">
                                                @if ($showRouteUrl)
                                                    <a href="{{ $showRouteUrl }}"
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
                                                @endif
                                                @if ($editRouteUrl)
                                                    <a href="{{ $editRouteUrl }}"
                                                        class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded hover:bg-indigo-50 transition-colors flex items-center"
                                                        title="Editar">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                @endif
                                                @if (!empty($delete))
                                                    <button wire:click="$emit('deleteItem', {{ $item->id }})"
                                                        class="text-red-600 hover:text-red-900 px-2 py-1 rounded hover:bg-red-50 transition-colors flex items-center"
                                                        title="Eliminar">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M4 7H20M10 11V17M14 11V17M5 7L6 19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19L19 7M9 7V4C9 3.44772 9 3 10 3H14C14.5523 3 15 3.44772 15 4V7"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mt-4 px-2 py-3 bg-indigo-50 border-t border-indigo-100 rounded-b-lg">
                                        {{ $items->links() }}
                                    </div>

                                </div>
                                <!-- Fin Vista móvil -->
                            </div>
                        </div>
                    </div> <!-- flow-root -->
                </div>
            </div>
        </div>
    </div>
</section>
