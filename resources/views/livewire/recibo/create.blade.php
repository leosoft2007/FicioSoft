<section class="w-full bg-gradient-to-br from-indigo-50 to-blue-100 py-8 px-4">
    <!-- Cabecera con icono -->
    <x-page-header
        title="Crear Recibo"
        subtitle="Registrar un nuevo recibo"
        color="indigo"
    >
        <div class="flex items-center gap-2">
            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            <span class="font-medium">Nuevo:</span>
        </div>
    </x-page-header>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-md border border-indigo-100">
                <div class="flow-root">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">

                            <!-- Formulario -->
                            <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="space-y-6">

                                    <!-- Sección de paciente -->
                                    <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-200">
                                        <label class="block text-sm font-medium text-indigo-700 mb-2">Paciente</label>
                                        <x-select-busqueda
                                            :options="$pacientes"
                                            :selected-value="$form->paciente_id"
                                            valueField="id"
                                            labelField="nombre_completo"
                                            model="form.paciente_id"
                                            primaryColor="indigo-600"
                                            hoverColor="indigo-50"
                                            placeholder="Buscar y seleccionar paciente"
                                        />
                                        @error('form.paciente_id')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Fecha -->
                                    <div>
                                        <flux:input wire:model="form.fecha" :label="__('Fecha')" type="date" autocomplete="form.fecha" required />
                                    </div>

                                    <!-- Valor -->
                                    <div>
                                        <flux:input wire:model="form.valor" :label="__('Valor')" type="number" step="0.01" autocomplete="form.valor" required />
                                    </div>

                                    <!-- Forma de pago -->
                                    <div>
                                        <flux:select wire:model="form.formadepago" :label="__('Forma de pago')" placeholder="Seleccione una forma de pago">
                                            <flux:select.option>contado</flux:select.option>
                                            <flux:select.option>tarjeta</flux:select.option>
                                            <flux:select.option>bizum</flux:select.option>
                                            <flux:select.option>transferencia</flux:select.option>
                                        </flux:select>
                                    </div>

                                    <!-- Observación -->
                                    <div>
                                        <flux:input wire:model="form.observacion" :label="__('En concepto de')" type="text" autocomplete="form.observacion" />
                                    </div>

                                    <!-- Botón de enviar -->
                                    <div class="pt-4">
                                        <flux:button variant="primary" type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 transition duration-200 shadow-md">
                                            {{ __('Guardar Recibo') }}
                                        </flux:button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
