<section class="w-full bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <!-- Header con icono SVG -->
    <div class="flex items-center justify-between px-6 mb-6">
        <div class="flex items-center space-x-3">
            <!-- Icono SVG: Lápiz de edición -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-8 h-8 text-blue-600">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.428 8.428a.75.75 0 0 0-.15.23l-.844 2.533a.75.75 0 0 0 .926.926l2.533-.844a.75.75 0 0 0 .23-.15L19.513 8.2Z" />
            </svg>
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Editar Recibo') }}</h1>
        </div>
        <flux:button variant="primary" :href="route('recibos.index')" class="bg-indigo-600 hover:bg-indigo-700 transition">
            {{ __('Volver') }} 
        </flux:button>
    </div>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flow-root">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="space-y-6">

                                    <!-- Nombre del paciente -->
                                    <div class="text-center">
                                        <span class="font-semibold text-xl text-blue-700">{{ $recibo->paciente->nombre_completo }}</span>
                                    </div>

                                    <!-- Número del recibo -->
                                    <div class="text-center">
                                        <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-medium">REC-{{ $recibo->id }}</span>
                                    </div>

                                    <!-- Fecha -->
                                    <div>
                                        <flux:input wire:model="form.fecha" :label="__('Fecha')" type="date"  />

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
                                        <flux:button variant="primary" type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 transition duration-200">
                                            {{ __('Actualizar Recibo') }}
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
