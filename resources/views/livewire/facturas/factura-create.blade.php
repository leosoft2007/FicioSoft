<div>
    <x-page-header 
title="🧾 {{$titulo}}"
subtitle=""
color="green" 
:clickable="true" 
badge="Nuevo" 
icon="check" 
footer="Texto de pie" 

>
    
    
        {{-- Datos principales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                
                <flux:select label="Paciente" wire:model="paciente_id" >
                    <option value="">Seleccione un paciente</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->apellido }} {{ $paciente->nombre }}</option>
                    @endforeach
                </flux:select>
            </div>
            <div>
                
                <flux:input label="Fecha" type="date" wire:model="fecha" />
            </div>
            <div>

                <flux:radio.group  wire:model="metodo_pago" label="Método de Pago" variant="segmented">
               
                    <flux:radio value="efectivo" label="Efectivo" />
                    <flux:radio value="tarjeta" label="Tarjeta" />
                </flux:radio.group>



                
            </div>
        </div>
    
        {{-- Agregar servicios --}}
        <div class="border-t pt-4">
            
            <div class="flex items-end gap-4 mt-2">
                <div class="flex-1">

                    

                    
                    <flux:select label="➕ Agregar Servicios" wire:model="servicio_id" >
                        <option value="">Seleccione un servicio</option>
                        @foreach($serviciosDisponibles as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}</option>
                        @endforeach
                    </flux:select>
                    </div>
                <div class="w-32">
                    
                    <flux:input label="Cantidad" type="number" wire:model="cantidad" min="1" />
                </div>
                <div class="w-28">
                   
                    <flux:input label="IVA (%)" type="number" wire:model="ivaInput" min="0" max="100" />
                </div>
                <button type="button" wire:click="addServicio" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">Agregar</button>
            </div>
        </div>
    
        {{-- Tabla de servicios agregados --}}
        <div class="mt-4">
            <table class="min-w-full border bg-white border-gray-200 text-sm">
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
            
                <flux:textarea label="Descripción (opcional)" wire:model="descripcion" cols="40" rows="2" ></flux:textarea>
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
   
</x-page-header>
    
</div>
