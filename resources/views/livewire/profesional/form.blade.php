<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Columna 1 -->
    <div class="space-y-4">
        <!-- Nombre -->
        <div>
            <flux:input 
                wire:model="form.nombre" 
                :label="__('Nombre')" 
                type="text" 
                placeholder="Ej: Juan"
                required
                class="w-full"
            />
        </div>

        <!-- Apellido -->
        <div>
            <flux:input 
                wire:model="form.apellido" 
                :label="__('Apellido')" 
                type="text" 
                placeholder="Ej: Pérez"
                required
                class="w-full"
            />
        </div>

        <!-- Email -->
        <div>
            <flux:input 
                wire:model="form.email" 
                :label="__('Email')" 
                type="email" 
                placeholder="Ej: juan.perez@clinica.com"
                required
                class="w-full"
            />
        </div>

        <!-- Teléfono -->
        <div>
            <flux:input 
                wire:model="form.telefono" 
                :label="__('Teléfono')" 
                type="tel" 
                placeholder="Ej: 600123456"
                class="w-full"
            />
        </div>

        <!-- CIF -->
        <div>
            <flux:input 
                wire:model="form.cif" 
                :label="__('CIF/NIF')" 
                type="text" 
                placeholder="Ej: 12345678X"
                class="w-full"
            />
        </div>
    </div>

    <!-- Columna 2 -->
    <div class="space-y-4">
        <!-- Dirección -->
        <div>
            <flux:input 
                wire:model="form.direccion" 
                :label="__('Dirección')" 
                type="text" 
                placeholder="Ej: Calle Principal, 123"
                class="w-full"
            />
        </div>

        <!-- Ciudad -->
        <div>
            <flux:input 
                wire:model="form.ciudad" 
                :label="__('Ciudad')" 
                type="text" 
                placeholder="Ej: Madrid"
                class="w-full"
            />
        </div>

        <!-- Estado/Provincia -->
        <div>
            <flux:input 
                wire:model="form.estado" 
                :label="__('Provincia')" 
                type="text" 
                placeholder="Ej: Madrid"
                class="w-full"
            />
        </div>

        <!-- Código Postal -->
        <div>
            <flux:input 
                wire:model="form.codigo_postal" 
                :label="__('Código Postal')" 
                type="text" 
                placeholder="Ej: 28001"
                class="w-full"
            />
        </div>

        <!-- Especialidad -->
        <div>
            <flux:select 
                wire:model="form.especialidad_id" 
                :label="__('Especialidad')" 
                required
                class="w-full"
            >
                <flux:select.option value="">Seleccione una especialidad</flux:select.option>
                @foreach ($especialidades as $especialidad)
                    <flux:select.option value="{{ $especialidad->id }}">
                        {{ $especialidad->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>
</div>

<!-- Botón de submit -->
<div class="pt-6">
    <div class="flex justify-end">
        <flux:button 
            variant="primary" 
            type="submit"
            class="flex items-center px-6 py-3"
            icon="check"
        >
            
            {{ __('Guardar') }}
        </flux:button>
    </div>
</div>