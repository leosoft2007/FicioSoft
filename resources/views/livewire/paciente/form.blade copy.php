<div x-data="{ activeTab: 'informacion' }" class="space-y-6">
    <!-- Pestañas -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button @click="activeTab = 'informacion'" :class="{ 'border-green-500 text-green-600': activeTab === 'informacion', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'informacion' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Información Personal
            </button>

            <button @click="activeTab = 'direccion'" :class="{ 'border-green-500 text-green-600': activeTab === 'direccion', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'direccion' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Dirección
            </button>

            <button @click="activeTab = 'emergencia'" :class="{ 'border-green-500 text-green-600': activeTab === 'emergencia', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'emergencia' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Contacto de Emergencia
            </button>

            <button @click="activeTab = 'medica'" :class="{ 'border-green-500 text-green-600': activeTab === 'medica', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'medica' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Información Médica
            </button>

            <button @click="activeTab = 'estado'" :class="{ 'border-green-500 text-green-600': activeTab === 'estado', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'estado' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Estado del Paciente
            </button>

            <button @click="activeTab = 'foto'" :class="{ 'border-green-500 text-green-600': activeTab === 'foto', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'foto' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Foto
            </button>
        </nav>
    </div>

    <!-- Contenido de las pestañas -->
    <div x-show="activeTab === 'informacion'" class="space-y-6">
        <flux:heading size="lg">Información Personal</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field label="Nombre" wire:model="form.nombre">
                <flux:input type="text" wire:model="form.nombre" placeholder="Ej: Juan" />
            </flux:field>
            <flux:field label="Apellido" wire:model="form.apellido">
                <flux:input type="text" wire:model="form.apellido" placeholder="Ej: Pérez" />
            </flux:field>
            <flux:field label="Email" wire:model="form.email">
                <flux:input type="email" wire:model="form.email" placeholder="Ej: juan@example.com" />
            </flux:field>
            <flux:field label="Teléfono" wire:model="form.telefono">
                <flux:input type="text" wire:model="form.telefono" placeholder="Ej: +54 9 11 1234 5678" />
            </flux:field>
            <flux:field label="Fecha de Nacimiento" wire:model="form.fecha_nacimiento">
                <flux:input type="date" wire:model="form.fecha_nacimiento" />
            </flux:field>
            <flux:field label="Género" wire:model="form.genero">
                <flux:input type="text" wire:model="form.genero" placeholder="Ej: Masculino / Femenino" />
            </flux:field>
            <flux:field label="Estado Civil" wire:model="form.estado_civil">
                <flux:input type="text" wire:model="form.estado_civil" placeholder="Ej: Soltero/a" />
            </flux:field>
            <flux:field label="Ocupación" wire:model="form.ocupacion">
                <flux:input type="text" wire:model="form.ocupacion" placeholder="Ej: Médico, Ingeniero..." />
            </flux:field>
            <flux:field label="Nacionalidad" wire:model="form.nacionalidad">
                <flux:input type="text" wire:model="form.nacionalidad" placeholder="Ej: Argentina" />
            </flux:field>
            <flux:field label="Tipo de Documento" wire:model="form.tipo_documento">
                <flux:input type="text" wire:model="form.tipo_documento" placeholder="Ej: DNI, Pasaporte..." />
            </flux:field>
            <flux:field label="Número de Documento" wire:model="form.numero_documento">
                <flux:input type="text" wire:model="form.numero_documento" placeholder="Ej: 30.123.456" />
            </flux:field>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'direccion'" class="space-y-6">
        <flux:heading size="lg">Dirección</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field label="Dirección" wire:model="form.direccion">
                <flux:input type="text" wire:model="form.direccion" placeholder="Ej: Calle Falsa 123" />
            </flux:field>
            <flux:field label="Ciudad" wire:model="form.ciudad">
                <flux:input type="text" wire:model="form.ciudad" placeholder="Ej: Buenos Aires" />
            </flux:field>
            <flux:field label="Estado/Provincia" wire:model="form.estado">
                <flux:input type="text" wire:model="form.estado" placeholder="Ej: CABA" />
            </flux:field>
            <flux:field label="Código Postal" wire:model="form.codigo_postal">
                <flux:input type="text" wire:model="form.codigo_postal" placeholder="Ej: C1001ABC" />
            </flux:field>
            <flux:field label="País" wire:model="form.pais">
                <flux:input type="text" wire:model="form.pais" placeholder="Ej: Argentina" />
            </flux:field>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'emergencia'" class="space-y-6">
        <flux:heading size="lg">Contacto de Emergencia</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field label="Nombre de contacto" wire:model="form.nombre_contacto_emergencia">
                <flux:input type="text" wire:model="form.nombre_contacto_emergencia" placeholder="Ej: María López" />
            </flux:field>
            <flux:field label="Teléfono de emergencia" wire:model="form.telefono_emergencia">
                <flux:input type="text" wire:model="form.telefono_emergencia" placeholder="Ej: +54 9 11 1234 5678" />
            </flux:field>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'medica'" class="space-y-6">
        <flux:heading size="lg">Información Médica</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field label="Alergias" wire:model="form.alergias">
                <flux:input type="text" wire:model="form.alergias" placeholder="Ej: Penicilina, Mariscos" />
            </flux:field>
            <flux:field label="Medicamentos Actuales" wire:model="form.medicamentos">
                <flux:input type="text" wire:model="form.medicamentos" placeholder="Ej: Paracetamol 500mg" />
            </flux:field>
            <flux:field label="Historial Médico" wire:model="form.historial_medico">
                <flux:textarea wire:model="form.historial_medico" rows="3" placeholder="Ej: Hipertensión desde 2020" />
            </flux:field>
            <flux:field label="Notas Adicionales" wire:model="form.notas">
                <flux:textarea wire:model="form.notas" rows="3" placeholder="Ej: Paciente alérgico a anestésicos locales" />
            </flux:field>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'estado'" class="space-y-6">
        <flux:heading size="lg">Estado del Paciente</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field label="Estado del Paciente" wire:model="form.estado_paciente">
                <flux:input type="text" wire:model="form.estado_paciente" placeholder="Ej: Activo, Inactivo" />
            </flux:field>
            <flux:field label="Tipo de Paciente" wire:model="form.tipo_paciente">
                <flux:input type="text" wire:model="form.tipo_paciente" placeholder="Ej: Particular, Obra Social" />
            </flux:field>
            <flux:field label="Referido por" wire:model="form.referido_por">
                <flux:input type="text" wire:model="form.referido_por" placeholder="Ej: Dr. Carlos Sánchez" />
            </flux:field>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'foto'" class="space-y-6">
        <flux:heading size="lg">Foto</flux:heading>
        <flux:fieldset class="grid grid-cols-1 gap-6">
            <flux:field label="Foto del paciente" wire:model="form.foto">
                <flux:input type="file" wire:model="form.foto" />
            </flux:field>
        </flux:fieldset>
    </div>

    <!-- Botón Guardar -->
    <div class="pt-6 flex justify-end">
        <flux:button variant="primary" type="submit">{{ __('Guardar') }}</flux:button>
    </div>
</div>