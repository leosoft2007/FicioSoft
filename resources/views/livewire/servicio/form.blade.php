

        <div class="space-y-6">
            <div>
                <flux:input
                    wire:model="form.nombre"
                    :label="__('Nombre')"
                    type="text"
                    required
                    autocomplete="off"
                    placeholder="Ej: Consulta médica general"
                />
                @error('form.nombre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <flux:textarea
                    wire:model="form.descripcion"
                    :label="__('Descripción')"
                    rows="3"
                    placeholder="Describa el servicio en detalle"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input
                        wire:model="form.precio"
                        :label="__('Precio (€)')"
                        type="number"
                        step="0.01"
                        min="0"
                        required
                        autocomplete="off"
                        placeholder="0.00"
                    />
                    @error('form.precio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input
                        wire:model="form.iva"
                        :label="__('IVA (%)')"
                        type="number"
                        step="0.01"
                        min="0"
                        max="100"
                        required
                        autocomplete="off"
                        placeholder="21.00"
                    />
                    @error('form.iva')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            wire:model="form.estado"
                            value="activo"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                        >
                        <span class="ml-2 text-gray-700">Activo</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            wire:model="form.estado"
                            value="inactivo"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                        >
                        <span class="ml-2 text-gray-700">Inactivo</span>
                    </label>
                </div>
                @error('form.estado')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-6 border-t border-gray-100">
                <flux:button
                    variant="primary"
                    type="submit"
                    class="flex items-center gap-2"
                >
                    <svg wire:loading.remove class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <svg wire:loading class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Guardar Cambios') }}
                </flux:button>
            </div>
        </div>
