<div x-data="{ activeTab: 'informacion' }" class="space-y-6">
    <!-- Pestañas -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button type="button" @click="activeTab = 'informacion'" :class="{ 'border-green-500 text-green-600': activeTab === 'informacion', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'informacion' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Información Personal
            </button>

            <button type="button" @click="activeTab = 'direccion'" :class="{ 'border-green-500 text-green-600': activeTab === 'direccion', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'direccion' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Dirección
            </button>

            <button type="button" @click="activeTab = 'emergencia'" :class="{ 'border-green-500 text-green-600': activeTab === 'emergencia', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'emergencia' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Contacto de Emergencia
            </button>

            <button type="button" @click="activeTab = 'medica'" :class="{ 'border-green-500 text-green-600': activeTab === 'medica', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'medica' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Información Médica
            </button>

            <button type="button" @click="activeTab = 'estado'" :class="{ 'border-green-500 text-green-600': activeTab === 'estado', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'estado' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Estado del Paciente
            </button>

            <button type="button" @click="activeTab = 'foto'" :class="{ 'border-green-500 text-green-600': activeTab === 'foto', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'foto' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Foto
            </button>
        </nav>
    </div>

    <!-- Contenido de las pestañas -->
    <div x-show="activeTab === 'informacion'" class="space-y-6">
        <flux:heading size="lg">Información Personal</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <flux:input label="Nombre" type="text" wire:model="form.nombre" placeholder="Ej: Juan" />

                <flux:input label="Apellido" type="text" wire:model="form.apellido" placeholder="Ej: Pérez" />

                <flux:input label="Email" type="email" wire:model="form.email" placeholder="Ej: juan@example.com" />

                <flux:input label="Teléfono" type="text" wire:model="form.telefono" placeholder="Ej: +54 9 11 1234 5678" />

                <flux:input label="Fecha de Nacimiento" type="date" wire:model="form.fecha_nacimiento" />

                <flux:select label="Género" wire:model="form.genero">
                    <option value="">Selecciona género</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </flux:select>

                <flux:select label="Estado Civil" wire:model="form.estado_civil">
                    <option value="">Selecciona estado civil</option>
                    <option value="Soltero/a">Soltero/a</option>
                    <option value="Casado/a">Casado/a</option>
                    <option value="Divorciado/a">Divorciado/a</option>
                    <option value="Viudo/a">Viudo/a</option>
                </flux:select>

                <flux:input label="Ocupación" type="text" wire:model="form.ocupacion" placeholder="Ej: Médico, Ingeniero..." />

                <flux:input label="Nacionalidad" type="text" wire:model="form.nacionalidad" placeholder="Ej: Argentina" />

                <flux:select label="Tipo de Documento" wire:model="form.tipo_documento">
                    <option value="">Selecciona tipo de documento</option>
                    <option value="DNI">DNI</option>
                    <option value="Pasaporte">Pasaporte</option>
                </flux:select>


                <flux:input type="text" label="Número de Documento" wire:model="form.numero_documento" placeholder="Ej: 30.123.456" />


                <flux:select label="Tipo de Paciente" wire:model="form.tipo_paciente">
                    <option value="">Selecciona tipo de paciente</option>
                    <option value="Regular">Regular</option>
                    <option value="Urgente">Urgente</option>
                    <option value="Pilates">Pilates</option>
                </flux:select>
                <div class="hidden md:block"></div>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'direccion'" class="space-y-6">
        <flux:heading size="lg">Dirección</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field  wire:model="form.direccion">
                <flux:input label="Dirección" type="text" wire:model="form.direccion" placeholder="Ej: Calle Falsa 123" />
            </flux:field>
            <flux:field  wire:model="form.ciudad">
                <flux:input label="Ciudad" type="text" wire:model="form.ciudad" placeholder="Ej: Buenos Aires" />
            </flux:field>
            <flux:field  wire:model="form.estado">
                <flux:input label="Estado/Provincia" type="text" wire:model="form.estado" placeholder="Ej: CABA" />
            </flux:field>
            <flux:field  wire:model="form.codigo_postal">
                <flux:input label="Código Postal" type="text" wire:model="form.codigo_postal" placeholder="Ej: C1001ABC" />
            </flux:field>
            <flux:field  wire:model="form.pais">
                <flux:input label="País" type="text" wire:model="form.pais" placeholder="Ej: Argentina" />
            </flux:field>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'emergencia'" class="space-y-6">
        <flux:heading size="lg">Contacto de Emergencia</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field  wire:model="form.nombre_contacto_emergencia">
                <flux:input label="Nombre de contacto" type="text" wire:model="form.nombre_contacto_emergencia" placeholder="Ej: María López" />
            </flux:field>
            <flux:field  wire:model="form.telefono_emergencia">
                <flux:input label="Teléfono de emergencia" type="text" wire:model="form.telefono_emergencia" placeholder="Ej: +34 654987123" />
            </flux:field>
            <div class="hidden md:block"></div>
        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'medica'" class="space-y-6">
        <flux:heading size="lg">Información Médica</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field  wire:model="form.alergias">
                <flux:input label="Alergias" type="text" wire:model="form.alergias" placeholder="Ej: Penicilina, Mariscos" />
            </flux:field>
            <flux:field  wire:model="form.medicamentos">
                <flux:input label="Medicamentos Actuales" type="text" wire:model="form.medicamentos" placeholder="Ej: Paracetamol 500mg" />
            </flux:field>
            <flux:field  wire:model="form.historial_medico">
                <flux:textarea label="Historial Médico" wire:model="form.historial_medico" rows="3" placeholder="Ej: Hipertensión desde 2020" />
            </flux:field>

        </flux:fieldset>
    </div>

    <div x-show="activeTab === 'estado'" class="space-y-6">
        <flux:heading size="lg">Estado del Paciente</flux:heading>
        <flux:fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:field  wire:model="form.estado_paciente">
                <flux:select label="Estado" wire:model="form.estado_paciente">
                    <option value="">Selecciona tipo estado</option>
                    <option value="Particular">Activo</option>
                    <option value="Obra Social">Inactivo</option>
                    <option value="Seguro Médico">Suspendido</option>
                </flux:select>
            </flux:field>
            <flux:field  wire:model="form.referido_por">
                <flux:input label="Referido por" type="text" wire:model="form.referido_por" placeholder="Ej: Dr. Carlos Sánchez" />
            </flux:field>
            <flux:field  wire:model="form.notas">
                <flux:textarea label="Nota" wire:model="form.notas" rows="3" placeholder="Ej: anotaciones extras" />
            </flux:field>
            <div class="hidden md:block"></div>
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

    <!-- Acciones -->
    <div class="pt-6 flex justify-end">
        <a href="{{ route('pacientes.index') }}" class="mr-3 inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
            Volver
        </a>
        <flux:button variant="primary" type="submit">{{ __('Guardar') }}</flux:button>
    </div>
</div>
