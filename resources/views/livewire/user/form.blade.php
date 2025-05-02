<div class="space-y-6 pl-1">
    
    <div>
        <flux:input wire:model="form.name" :label="__('Name')" type="text"  autocomplete="form.name" placeholder="Name"/>
    </div>
    <div>
        <flux:input wire:model="form.email" :label="__('Email')" type="text"  autocomplete="form.email" placeholder="Email"/>
    </div>
    <!-- Agregar campo para asignar rol -->
    

    <div>
        <flux:select wire:model="role" :label="__('Rol')" type="text"  autocomplete="role" placeholder="Rol">
            @foreach ($roles as $role)
                <flux:select.option value="{{ $role->id }}">
                    {{ $role->name }}
                </flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div>
        <flux:select wire:model="form.clinica_id" :label="__('Clinica')" autocomplete="form.clinica_id" placeholder="Clínica">
            @foreach ($clinicas as $clinica)
                <flux:select.option value="{{ $clinica->id }}">
                    {{ $clinica->nombre }}
                </flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>