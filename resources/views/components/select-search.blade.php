<div x-data="{
    search: '',
    show: false,
    selected: '{{ $value }}',
    options: @js($options),
    get filteredOptions() {
        return this.options.filter(o => o.text.toLowerCase().includes(this.search.toLowerCase()))
    }
}" class="relative w-full" wire:ignore>
    <input 
        type="text"
        x-model="search"
        @focus="show = true"
        @click.away="show = false"
        placeholder="{{ $placeholder }}"
        class="w-full border px-3 py-2 rounded dark:bg-zinc-800 dark:text-white"
    >

    <div x-show="show" class="absolute z-10 mt-1 w-full bg-white dark:bg-zinc-900 border rounded shadow max-h-60 overflow-auto">
        <template x-for="option in filteredOptions" :key="option.value">
            <div 
                        @click="
                        selected = option.value;
                        search = option.text;
                        show = false;
                        $dispatch('input', { detail: option.value })
                        console.log('Selected:', option.value); 
                    "
        
                class="px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
                x-text="option.text"
            ></div>
        </template>
    </div>

    <input type="hidden" name="{{ $name }}" :value="selected">
</div>
