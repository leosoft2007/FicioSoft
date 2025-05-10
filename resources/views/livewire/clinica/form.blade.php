<div class="space-y-6">
    
    <div>
        <flux:input wire:model="form.nombre" :label="__('Nombre')" type="text"  autocomplete="form.nombre" placeholder="Nombre"/>
    </div>
    <div>
        <flux:input wire:model="form.color" :label="__('Color')" type="text"  autocomplete="form.color" placeholder="Color"/>
    </div>
    <div>
        <flux:input wire:model="form.nif" :label="__('Nif')" type="text"  autocomplete="form.nif" placeholder="Nif"/>
    </div>
    <div>
        <flux:input wire:model="form.direccion" :label="__('Direccion')" type="text"  autocomplete="form.direccion" placeholder="Direccion"/>
    </div>
    <div>
        <flux:input wire:model="form.telefono" :label="__('Telefono')" type="text"  autocomplete="form.telefono" placeholder="Telefono"/>
    </div>
    <div>
        <flux:input wire:model="form.email" :label="__('Email')" type="text"  autocomplete="form.email" placeholder="Email"/>
    </div>
    <div>
        <flux:input wire:model="form.imagen" :label="__('Imagen')" type="text"  autocomplete="form.imagen" placeholder="Imagen"/>
    </div>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>