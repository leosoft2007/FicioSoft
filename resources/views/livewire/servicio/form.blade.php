<div class="space-y-6">
    <div>
        <flux:input wire:model="form.nombre" :label="__('Nombre')" type="text"  autocomplete="form.nombre" placeholder="Nombre"/>
    </div>
    <div>
        <flux:input wire:model="form.descripcion" :label="__('Descripcion')" type="text"  autocomplete="form.descripcion" placeholder="Descripcion"/>
    </div>
    <div>
        <flux:input wire:model="form.precio" :label="__('Precio')" type="text"  autocomplete="form.precio" placeholder="Precio"/>
        @error('precio')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <flux:input wire:model="form.iva" :label="__('Iva')" type="text"  autocomplete="form.iva" placeholder="Iva"/>
        @error('iva')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <flux:input wire:model="form.estado" :label="__('Estado')" type="text"  autocomplete="form.estado" placeholder="Estado"/>
    </div>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>
