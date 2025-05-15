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

<!-- Nuevo campo para el color -->
<div class="col-span-6 sm:col-span-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Color de identificación
    </label>

    <div class="flex items-center space-x-4">
        <!-- Selector de color -->
        <input
            type="color"
            wire:model="form.color"
            class="h-10 w-10 rounded cursor-pointer border border-gray-300"
            value="{{ $form->color ?? '#3b82f6' }}"
        >

        <!-- Input de texto para el código HEX -->
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500"></span>
            </div>
            <input
                type="text"
                wire:model="form.color"
                placeholder="Ej: 3b82f6"
                class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                maxlength="6"

            >
        </div>

        <!-- Muestra de color actual -->
        <div
            class="h-10 w-16 rounded border border-gray-300"
            style="background-color: {{ $form->color ?? '#3b82f6' }}"
        ></div>
    </div>

    <p class="mt-1 text-sm text-gray-500">
        Selecciona un color que identifique a este profesional en el calendario.
    </p>
    @error('form.color')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
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

