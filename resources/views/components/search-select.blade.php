<div class="search-select-container relative"
     x-data="searchSelect"
     x-init="init()"
     x-cloak>

    <!-- Input hidden para el valor seleccionado -->
    <input type="hidden" name="{{ $name }}" x-model="selected" @if($wireModel) wire:model="{{ $wireModel }}" @endif>
    

    <!-- Campo de búsqueda -->
    <div class="relative">
        <input type="text"
               x-model="search"
               @click="open = true"
               @focus="open = true"
               @keydown.escape="open = false"
               :placeholder="selectedText || '{{ addslashes($placeholder) }}'"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
               :disabled="{{ $disabled ? 'true' : 'false' }}"
               :required="{{ $required ? 'true' : 'false' }}">

        <!-- Botón desplegable -->
        <button type="button" @click="open = !open" class="absolute inset-y-0 right-0 flex items-center pr-2">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <!-- Lista de opciones -->
    <ul x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none">
        <template x-for="option in filteredOptions" :key="option.key">
            <li @click="selectOption(option)"
                class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 hover:bg-blue-100"
                :class="{ 'bg-blue-100': selected == option.key }">
                <span x-text="option.value" class="block truncate"></span>
                <span x-show="selected == option.key" class="text-blue-600 absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </li>
        </template>

        <li x-show="filteredOptions.length === 0" class="text-gray-500 py-2 pl-3 pr-9">
            No se encontraron resultados
        </li>
    </ul>
</div>

<script>
// Registramos el componente Alpine.js de forma segura
document.addEventListener('alpine:init', () => {
    Alpine.data('searchSelect', () => ({
        open: false,
        search: '',
        selected: @json($selected ?? ''),
        selectedText: @json($selected && isset($options[$selected]) ? $options[$selected] : ''),
        options: @json($options),
        filteredOptions: [],

        init() {
            this.filteredOptions = this.formatOptions(this.options);

            this.$watch('search', (value) => {
                this.filterOptions();
            });

            @if($wireModel)
            this.$watch('selected', (value) => {
                @this.set('{{ $wireModel }}', value);
            });
            @endif


        },

        formatOptions(options) {
            return Object.entries(options).map(([key, value]) => ({
                key: key,
                value: value
            }));
        },

        filterOptions() {
            const searchTerm = this.search.toLowerCase();
            this.filteredOptions = this.formatOptions(this.options)
                .filter(option =>
                    String(option.value).toLowerCase().includes(searchTerm) ||
                    String(option.key).toLowerCase().includes(searchTerm)
                );
        },


        selectOption(option) {
            this.selected = option.key;
            this.selectedText = option.value;
            this.search = '';
            this.open = false;
            this.filterOptions();

            // Sincronizar manualmente con Livewire
            @if($wireModel)
            @this.set('{{ $wireModel }}', this.selected);
            @endif
        }
    }));
});
</script>
