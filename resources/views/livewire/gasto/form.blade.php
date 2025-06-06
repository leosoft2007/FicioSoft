<div class="space-y-6">

    <div>
        <flux:input wire:model="form.descripcion" :label="__('Descripcion')" type="text" autocomplete="form.descripcion"
            placeholder="Descripcion" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">{{ __('Monto') }}</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-base">€</span>
            <flux:input
                wire:model="form.monto"
                type="text"
                class="pl-8 w-full"
                placeholder="Monto"
                autocomplete="form.monto"
            />
        </div>
    </div>
    <div>
        <flux:input wire:model="form.fecha" :label="__('Fecha')" type="date" autocomplete="form.fecha"
            placeholder="Fecha" />
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">{{ __('Metodo Pago') }}</label>
        <flux:select wire:model="form.metodo_pago" class="w-full border rounded px-2 py-1">
            <option value="">Seleccione un método de pago</option>
            <option value="Contado">Contado</option>
            <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
            <option value="Cheque">Cheque</option>
            <option value="Otro">Otro</option>
        </flux:select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">{{ __('Tipo de Gasto') }}</label>
        <div class="flex items-center space-x-2 relative">
            <div class="flex-1">
                <x-select-busqueda
                :options="$tiposgasto"
                :selected-value="old('form.tipo_gasto_id',
                $form->tipo_gasto_id ?? null)"
                valueField="id"
                labelField="nombre"
                model="form.tipo_gasto_id"
                placeholder="Seleccione un tipo de gasto"
                primaryColor="indigo-600"
                    hoverColor="indigo-50" />
            </div>
            <button type="button"
                class="ml-2 p-2 rounded-full bg-green-100 hover:bg-green-200 text-green-700 shadow transition"
                wire:click="$set('showModalTipoGasto', true)" title="Añadir tipo de gasto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>

            @if ($showModalTipoGasto)
                <div
                    class="absolute right-0 top-12 z-50 w-72 bg-white rounded-lg shadow-lg border border-green-200 p-6">
                    <h3 class="text-lg font-bold mb-4">Nuevo Tipo de Gasto</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nombre</label>
                        <input type="text" wire:model.defer="nuevoTipoGasto.nombre"
                            class="w-full border rounded px-2 py-1" placeholder="Nombre">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Descripción</label>
                        <input type="text" wire:model.defer="nuevoTipoGasto.descripcion"
                            class="w-full border rounded px-2 py-1" placeholder="Descripción">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button wire:click="$set('showModalTipoGasto', false)"
                            class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancelar</button>
                        <button wire:click="guardarNuevoTipoGasto"
                            class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">Guardar</button>
                    </div>
                </div>
            @endif
        </div>


    </div>
     <!-- Pie del formulario con botón de guardar -->
     <div class="flex justify-end pt-4 border-t border-purple-100">
        <button type="submit"
            class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg shadow-md hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 flex items-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            <span>Guardar Cambios</span>
        </button>
    </div>
