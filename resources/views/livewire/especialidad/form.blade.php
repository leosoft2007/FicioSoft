<div class="space-y-6 pl-1">
    
    <div>
        <flux:input wire:model="form.nombre" :label="__('Nombre')" type="text"  autocomplete="form.nombre" placeholder="Nombre"/>
    </div>
    <div>
        <flux:input wire:model="form.descripcion" :label="__('Descripcion')" type="text"  autocomplete="form.descripcion" placeholder="Descripcion"/>
    </div>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>