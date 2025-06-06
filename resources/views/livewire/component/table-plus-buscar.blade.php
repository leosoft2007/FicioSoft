{{--
Buscador principal y botón de filtros avanzados.
Incluye: modal de filtros avanzados y chips de filtros activos.
--}}

<div class="relative mt-4">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <input wire:model.live.debounce.500ms="search" type="text"
        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500"
        placeholder="Buscar...">
    <!-- Botón para abrir filtros avanzados -->
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
        <button type="button" class="text-indigo-600 hover:text-indigo-800 focus:outline-none"
            wire:click="$set('showFiltro', true)" title="Filtros avanzados">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A2 2 0 0013 14.586V19a1 1 0 01-1.447.894l-4-2A1 1 0 017 17v-2.414a2 2 0 00-.586-1.414L3.293 6.707A1 1 0 013 6V4z" />
            </svg>
        </button>
    </div>
    <!-- Filtro avanzado modal -->
    @if ($showFiltro ?? false)
        <div class="absolute right-0 top-12 z-50 w-80 bg-white rounded-lg shadow-lg border border-indigo-100 p-6">
            <h3 class="text-lg font-bold mb-4">Filtros avanzados</h3>
            @foreach ($this->columnsWithOptions as $col)
                @if (!empty($col['filter']))
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">{{ $col['label'] }}</label>
                        @if ($col['filter'] === 'range_number')
                            <div class="flex gap-2">
                                <input type="number" wire:model="filters.{{ $col['field'] }}_min" placeholder="Mín"
                                    class="w-1/2 border rounded px-2 py-1" />
                                <input type="number" wire:model="filters.{{ $col['field'] }}_max" placeholder="Máx"
                                    class="w-1/2 border rounded px-2 py-1" />
                            </div>
                        @elseif ($col['filter'] === 'range_date')
                            <div class="flex gap-2">
                                <input type="date" wire:model="filters.{{ $col['field'] }}_from"
                                    class="w-1/2 border rounded px-2 py-1" />
                                <input type="date" wire:model="filters.{{ $col['field'] }}_to"
                                    class="w-1/2 border rounded px-2 py-1" />
                            </div>
                        @elseif(($col['filter'] ?? null) === 'relation-select')
                            <select wire:model="filters.{{ $col['relation_field'] }}"
                                class="border rounded px-2 py-1 text-sm">
                                <option value="">Todos</option>
                                @foreach ($col['options'] as $id => $label)
                                    <option value="{{ $id }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        @elseif ($col['filter'] === 'select')
                            <select wire:model="filters.{{ $col['field'] }}" class="w-full border rounded px-2 py-1">
                                <option value="">Todos</option>
                                @foreach ($col['options'] as $option)
                                    <option value="{{ $option }}">{{ ucfirst($option) }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endif
            @endforeach
            <div class="flex justify-end space-x-2">
                <button wire:click="resetFilters"
                    class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">Limpiar</button>
                <button wire:click="$set('showFiltro', false)"
                    class="px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700">Aplicar</button>
            </div>
        </div>
    @endif
</div>
@if (count($filters))
    <div class="flex flex-wrap gap-2 mt-4">
        @foreach ($filters as $key => $value)
            @if (!empty($value))
                @php
                    // Buscar la columna asociada
                    $col = collect($this->columnsWithOptions)
                        ->first(function ($c) use ($key) {
                            return ($c['relation_field'] ?? $c['field']) === $key
                                || (isset($c['field']) && (str_starts_with($key, $c['field'] . '_') || $key === $c['field']));
                        });
                @endphp
                @if ($col)
                    <span class="border border-indigo-200 bg-indigo-50 rounded px-2 py-1 text-sm flex items-center">
                        <span>
                            {{ $col['label'] }}:
                            @if (($col['filter'] ?? null) === 'relation-select')
                                {{ $col['options'][$value] ?? $value }}
                            @elseif (($col['filter'] ?? null) === 'select')
                                {{ ucfirst($value) }}
                            @elseif (str_contains($key, '_from'))
                                desde {{ $value }}
                            @elseif (str_contains($key, '_to'))
                                hasta {{ $value }}
                            @else
                                {{ $value }}
                            @endif
                        </span>
                        <button wire:click="$set('filters.{{ $key }}', '')" class="ml-2 text-red-500 hover:text-red-700" title="Quitar filtro">&times;</button>
                    </span>
                @endif
            @endif
        @endforeach
    </div>
@endif
