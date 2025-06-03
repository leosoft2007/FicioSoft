@props([
    'options' => [],
    'selectedValue' => null,
    'valueField' => 'id',
    'labelField' => 'nombre',
    'model' => '',
    'placeholder' => 'Seleccione una opción',
    'primaryColor' => 'blue-500',
    'hoverColor' => 'blue-100'
])

@php
    $optionsJs = \Illuminate\Support\Js::from($options);
@endphp

<div
    class="relative group"
    x-data="{
        open: false,
        search: '',
        getLabel(value) {
            let found = {{ $optionsJs }}.find(opt => opt['{{ $valueField }}'].toString() == (value ?? '').toString());
            return found ? found['{{ $labelField }}'] : '{{ $placeholder }}';
        }
    }"
>
    <button
        type="button"
        @click="open = !open; search = ''; if(open){ $nextTick(() => { $refs.searchInput.focus() }) }"
        :class="{'ring-2 ring-{{ $primaryColor }}': open}"
        class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm transition-all duration-200 focus:outline-none hover:border-{{ $primaryColor }}"
    >
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-{{ $primaryColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <span class="truncate" x-text="getLabel($wire.{{ $model }})"></span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-99 w-full mt-1 origin-top-right bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none"
        style="display: none;"
    >
        <div class="p-2 space-y-1">
            <div class="relative">
                <input
                    x-model="search"
                    x-ref="searchInput"
                    class="block w-full px-4 py-2 pl-10 text-gray-800 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-{{ $primaryColor }} focus:border-{{ $primaryColor }}"
                    type="text"
                    placeholder="Buscar..."
                    autocomplete="off"
                >
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="overflow-y-auto max-h-60">
                @foreach ($options as $option)
                    <a
                        href="#"
                        @click.prevent="$wire.set('{{ $model }}', {{ $option[$valueField] }}); open = false; search = '';"
                        x-show="search === '' || '{{ strtolower($option[$labelField]) }}'.includes(search.toLowerCase())"
                        class="flex items-center px-4 py-2 text-gray-700 transition-colors duration-150 rounded-lg hover:bg-{{ $hoverColor }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-{{ $primaryColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $option[$labelField] }}
                    </a>
                @endforeach

                <div
                    x-show="search !== '' && {{ $optionsJs }}.filter(opt => opt['{{ $labelField }}'].toLowerCase().includes(search.toLowerCase())).length === 0"
                    class="px-4 py-2 text-sm text-gray-500"
                >
                    No se encontraron resultados
                </div>
            </div>
        </div>
    </div>
</div>
