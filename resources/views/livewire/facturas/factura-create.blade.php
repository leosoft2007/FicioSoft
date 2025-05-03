<div>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg space-y-6">
        <h2 class="text-2xl font-bold text-gray-800">🧾 Crear Factura</h2>
    
        {{-- Datos principales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block font-medium text-sm text-gray-700">Paciente</label>
                <select wire:model="paciente_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Seleccione un paciente</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Fecha</label>
                <input type="date" wire:model="fecha" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block font-medium text-sm text-gray-700">Método de Pago</label>
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="metodo_pago" value="efectivo" class="text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Efectivo</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="metodo_pago" value="tarjeta" class="text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Tarjeta</span>
                    </label>
                </div>
            </div>
        </div>
    
        {{-- Agregar servicios --}}
        <div class="border-t pt-4">
            <h3 class="font-semibold text-lg text-gray-800">➕ Agregar Servicios</h3>
            <div class="flex items-end gap-4 mt-2">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Servicio</label>
                    <select wire:model="servicio_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Seleccione un servicio</option>
                        @foreach($serviciosDisponibles as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-32">
                    <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" wire:model="cantidad" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="w-28">
                    <label class="block text-sm font-medium text-gray-700">IVA (%)</label>
                    <input type="number" wire:model="ivaInput" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <button type="button" wire:click="addServicio" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">Agregar</button>
            </div>
        </div>
    
        {{-- Tabla de servicios agregados --}}
        <div class="mt-4">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Descripción</th>
                        <th class="px-3 py-2 text-right">Cantidad</th>
                        <th class="px-3 py-2 text-right">Precio</th>
                        <th class="px-3 py-2 text-right">IVA %</th>
                        <th class="px-3 py-2 text-right">IVA</th>
                        <th class="px-3 py-2 text-right">Total</th>
                        <th class="px-3 py-2 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicios as $index => $item)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $item['descripcion'] }}</td>
                            <td class="px-3 py-2 text-right">{{ $item['cantidad'] }}</td>
                            <td class="px-3 py-2 text-right">${{ number_format($item['precio_unitario'], 2) }}</td>
                            <td class="px-3 py-2 text-right">{{ $item['iva_porcentaje'] }}%</td>
                            <td class="px-3 py-2 text-right">${{ number_format($item['iva'], 2) }}</td>
                            <td class="px-3 py-2 text-right">${{ number_format($item['total'], 2) }}</td>
                            <td class="px-3 py-2 text-center">
                                <button wire:click="removeServicio({{ $index }})" class="text-red-600 hover:text-red-800">🗑️</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-gray-500">No hay servicios agregados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        {{-- Totales y guardar --}}
        <div class="flex justify-between items-center mt-6 border-t pt-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción (opcional)</label>
                <textarea wire:model="descripcion" rows="2" class="mt-1 w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
            <div class="text-right">
                <p class="text-lg font-semibold text-gray-800">Total: ${{ number_format($this->calcularTotal(), 2) }}</p>
                <button wire:click="save" class="mt-2 px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">💾 Guardar Factura</button>
            </div>
        </div>
    
        @if (session()->has('success'))
            <div class="mt-4 text-green-600 font-semibold">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mt-4 text-red-600 font-semibold">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>
    
</div>
