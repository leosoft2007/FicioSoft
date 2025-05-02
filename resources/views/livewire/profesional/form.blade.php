<div class="space-y-6 pl-1">
    
    <div>
        <flux:input wire:model="form.nombre" :label="__('Nombre')" type="text"  autocomplete="form.nombre" placeholder="Nombre"/>
    </div>
    <div>
        <flux:input wire:model="form.apellido" :label="__('Apellido')" type="text"  autocomplete="form.apellido" placeholder="Apellido"/>
    </div>
    <div>
        <flux:input wire:model="form.email" :label="__('Email')" type="text"  autocomplete="form.email" placeholder="Email"/>
    </div>
    <div>
        <flux:input wire:model="form.telefono" :label="__('Telefono')" type="text"  autocomplete="form.telefono" placeholder="Telefono"/>
    </div>
    <div>
        <flux:input wire:model="form.cif" :label="__('Cif')" type="text"  autocomplete="form.cif" placeholder="Cif"/>
    </div>
    <div>
        <flux:input wire:model="form.direccion" :label="__('Direccion')" type="text"  autocomplete="form.direccion" placeholder="Direccion"/>
    </div>
    <div>
        <flux:input wire:model="form.ciudad" :label="__('Ciudad')" type="text"  autocomplete="form.ciudad" placeholder="Ciudad"/>
    </div>
    <div>
        <flux:input wire:model="form.estado" :label="__('Estado')" type="text"  autocomplete="form.estado" placeholder="Estado"/>
    </div>
    <div>
        <flux:input wire:model="form.codigo_postal" :label="__('Codigo Postal')" type="text"  autocomplete="form.codigo_postal" placeholder="Codigo Postal"/>
    </div>
    
    <div>
    <flux:select wire:model="form.especialidad_id" :label="__('Especialidad')" type="text"  autocomplete="form.especialidad_id" placeholder="Especialidad">
        @foreach ($especialidades as $especialidad)
            <flux:select.option value="{{ $especialidad->id }}">
                {{ $especialidad->nombre }}
            </flux:select.option>
        @endforeach
    </flux:select>
    </div>
    <div>
        
       <!-- <flux:input wire:model="form.especialidad_id" :label="__('Especialidad Id')" type="text"  autocomplete="form.especialidad_id" placeholder="Especialidad Id"/> -->
    </div>
    

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>