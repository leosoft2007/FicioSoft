<div class="bg-gradient-to-br from-sky-50 to-indigo-100 min-h-screen p-6">

        {{-- Datos principales --}}
        <x-page-header title="🧾 {{ $titulo }}"  color="indigo" :clickable="true"
        badge="Nuevo" icon="check" >

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <flux:label>Paciente</flux:label>
                <x-select-busqueda :options="$pacientes" :selected-value="$paciente_id" valueField="id" labelField="nombre_completo"
                    model="paciente_id" primaryColor="indigo-600" hoverColor="indigo-50"
                    placeholder="Seleccione un paciente" />

            </div>
            <div >
                <flux:input label="Fecha" type="date" wire:model="fecha" />
            </div>
            <div>
                <flux:radio.group wire:model.live="metodo_pago" label="Método de Pago" variant="segmented">
                    <flux:radio value="efectivo" label="Efectivo" checked>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-badge-euro-icon lucide-badge-euro">
                            <path
                                d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="M7 12h5" />
                            <path d="M15 9.4a4 4 0 1 0 0 5.2" />
                        </svg>
                    </flux:radio>
                    <flux:radio value="tarjeta" label="Tarjeta" icon="credit-card" />
                    <flux:radio value="transferencia" label="Transferencia" icon="credit-card" />
                </flux:radio.group>
            </div>
        </div>
    </x-page-header>

    <div class="rounded-xl bg-orange-50 border border-orange-200 p-4 mb-4 shadow">
        {{-- Resto de la vista (líneas de factura, resumen de totales, etc.) --}}
        {{-- Líneas de factura --}}
        <div class="border rounded-lg overflow-hidden mb-6 bg-white shadow-sm">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left w-1/3">Producto/Servicio</th>
                        <th class="px-2 py-3 text-center">Cantidad</th>
                        <th class="px-2 py-3 text-right">P. Unitario</th>
                        <th class="px-2 py-3 text-center">IVA %</th>
                        <th class="px-2 py-3 text-right">Subtotal</th>
                        <th class="px-2 py-3 text-right">IVA</th>
                        <th class="px-2 py-3 text-right">Total</th>
                        <th class="px-2 py-3 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Líneas existentes --}}
                    @forelse($servicios as $index => $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $item['descripcion'] }}</td>
                            <td class="px-2 py-3 text-center">
                                <input type="number" wire:model.live="servicios.{{ $index }}.cantidad"
                                    min="1" class="w-20 text-center border rounded p-1"
                                    wire:change="actualizarLinea({{ $index }})">
                            </td>
                            <td class="px-2 py-3 text-right">
                                <input type="number" step="0.01"
                                    wire:model.live="servicios.{{ $index }}.precio_unitario"
                                    class="w-24 text-right border rounded p-1"
                                    wire:change="actualizarLinea({{ $index }})">
                            </td>
                            <td class="px-2 py-3 text-center">
                                <select wire:model.live="servicios.{{ $index }}.iva_porcentaje"
                                    wire:change="actualizarLinea({{ $index }})" class="border rounded p-1">
                                    <option value="0">0%</option>
                                    <option value="4">4%</option>
                                    <option value="10">10%</option>
                                    <option value="21">21%</option>
                                </select>
                            </td>
                            <td class="px-2 py-3 text-right">€{{ number_format($item['subtotal'], 2) }}</td>
                            <td class="px-2 py-3 text-right">€{{ number_format($item['iva'], 2) }}</td>
                            <td class="px-2 py-3 text-right font-medium">€{{ number_format($item['total'], 2) }}</td>
                            <td class="px-2 py-3 text-center">
                                <button wire:click="removeServicio({{ $index }})"
                                    class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">No hay líneas agregadas</td>
                        </tr>
                    @endforelse

                    {{-- Nueva línea --}}
                    <tr class="border-t bg-gray-50">
                        <td class="px-4 py-3">
                            <select wire:model.live="servicio_id" class="w-full border rounded p-2">
                                <option value="">Buscar producto/servicio...</option>
                                @foreach ($serviciosDisponibles as $servicio)
                                    <option value="{{ $servicio->id }}">
                                        {{ $servicio->nombre }} - €{{ number_format($servicio->precio, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-2 py-3">
                            <input type="number" wire:model="cantidad" min="1"
                                class="w-20 text-center border rounded p-1">
                        </td>

                        <td class="px-2 py-3">
                            <select wire:model="ivaInput" class="border rounded p-1">
                                <option value="0">0%</option>
                                <option value="4">4%</option>
                                <option value="10">10%</option>
                                <option value="21">21%</option>
                            </select>
                        </td>
                        <td colspan="3" class="px-2 py-3 text-right">
                            <button wire:click="addServicio"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 flex items-center gap-2 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Agregar
                            </button>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Resumen de totales --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="border rounded-lg p-4 bg-white shadow-sm">
                <h3 class="font-semibold text-indigo-700 mb-3">Resumen de IVA</h3>

                

                {{-- Tabla de resumen IVA --}}
                <table class="w-full">
                    <tbody>
                        @forelse($this->resumenIva as $iva)
                            <tr class="border-b">
                                <td class="py-2">IVA {{ $iva['porcentaje'] }}%</td>
                                <td class="py-2 text-right">€{{ number_format($iva['base'], 2) }}</td>
                                <td class="py-2 text-right">€{{ number_format($iva['importe'], 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-2 text-center text-gray-500">Sin IVA aplicado</td>
                            </tr>
                        @endforelse
                        <tr class="font-semibold border-t">
                            <td class="py-2">Total IVA</td>
                            <td colspan="2" class="py-2 text-right">
                                €{{ number_format($this->totalIva, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="border rounded-lg p-4 bg-white shadow-sm">
                <h3 class="font-semibold text-indigo-700 mb-3">Observaciones</h3>
                <flux:textarea wire:model="descripcion" rows="4" class="w-full"
                    placeholder="Notas adicionales sobre la factura..."></flux:textarea>
            </div>

            <div class="border rounded-lg p-4 bg-white shadow-sm">
                <h3 class="font-semibold text-indigo-700 mb-3">Totales</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Base Imponible:</span>
                        <span class="font-medium">€{{ number_format($this->baseImponible, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total IVA:</span>
                        <span class="font-medium">€{{ number_format($this->totalIva, 2) }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-2 text-lg font-semibold">
                        <span>TOTAL FACTURA:</span>
                        <span class="text-green-600">€{{ number_format($this->calcularTotal(), 2) }}</span>
                    </div>
                </div>
                <button wire:click="save"
                    class="mt-4 w-full px-5 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold flex items-center justify-center gap-2 transition transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    GUARDAR FACTURA
                </button>
            </div>
        </div>

    </div>
    <x-page-header title="Asignación de Recibos"  color="red" :clickable="true"
        badge="Nuevo" icon="check" >

        {{-- Asignación de recibos - Nueva implementación --}}
        <div class="mb-6 bg-white rounded-lg shadow-sm p-4 border">
            <h3 class="font-semibold text-indigo-700 mb-3"></h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Recibos Disponibles --}}
                <div class="border rounded-lg p-3">
                    <h4 class="font-medium text-gray-700 mb-2">Recibos Disponibles</h4>
                    <div class="space-y-2 max-h-60 overflow-y-auto">
                        @forelse($recibosDisponibles as $recibo)
                            @if (!in_array($recibo->id, $recibosAsignadosTemporal))
                                <div class="flex items-center justify-between p-2 border rounded hover:bg-gray-50">
                                    <div>
                                        <span class="font-medium">#{{ $recibo->numero }}</span>
                                        <span class="text-sm text-gray-600 ml-2">€{{ number_format($recibo->valor, 2) }}</span>
                                        <span class="text-xs text-gray-500 ml-2">
                                            {{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <button wire:click="agregarRecibo({{ $recibo->id }})"
                                        class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-sm hover:bg-indigo-200 transition">
                                        Asignar
                                    </button>
                                </div>
                            @endif
                        @empty
                            <p class="text-gray-500 text-sm">No hay recibos disponibles para este paciente</p>
                        @endforelse
                    </div>
                </div>

                {{-- Recibos Asignados Temporalmente --}}
                <div class="border rounded-lg p-3">
                    <h4 class="font-medium text-gray-700 mb-2">Recibos Asignados</h4>
                    <div class="space-y-2 max-h-60 overflow-y-auto">
                        @forelse($recibosDisponibles->whereIn('id', $recibosAsignadosTemporal) as $recibo)
                            <div class="flex items-center justify-between p-2 border rounded hover:bg-gray-50">
                                <div>
                                    <span class="font-medium">#{{ $recibo->numero }}</span>
                                    <span class="text-sm text-gray-600 ml-2">€{{ number_format($recibo->valor, 2) }}</span>
                                    <span class="text-xs text-gray-500 ml-2">
                                        {{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}
                                    </span>
                                </div>
                                <button wire:click="quitarRecibo({{ $recibo->id }})"
                                    class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm hover:bg-red-200 transition">
                                    Quitar
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No hay recibos asignados</p>
                        @endforelse
                    </div>
                </div>

                {{-- Resumen de montos (usando la propiedad computada) --}}



            </div>

            {{-- Resumen de montos --}}
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-3 rounded-lg">
                    <div class="text-sm text-blue-700">Total Factura</div>
                    <div class="text-xl font-bold">€{{ number_format($this->calcularTotal(), 2) }}</div>
                </div>

                <div class="bg-green-50 p-3 rounded-lg">
                    <div class="text-sm text-green-700">Total Asignado</div>
                    <div class="text-xl font-bold">€{{ number_format($this->montoAsignado, 2) }}</div>
                </div>

                <div class="@if ($this->calcularTotal() > $this->montoAsignado) bg-red-50 @else bg-gray-50 @endif p-3 rounded-lg">
                    <div class="text-sm @if ($this->calcularTotal() > $this->montoAsignado) text-red-700 @else text-gray-700 @endif">
                        Diferencia
                    </div>
                    <div class="text-xl font-bold">
                        @if ($this->calcularTotal() > $this->montoAsignado)
                            -€{{ number_format($this->calcularTotal() - $this->montoAsignado, 2) }}
                        @else
                            €{{ number_format($this->montoAsignado - $this->calcularTotal(), 2) }}
                        @endif
                    </div>
                </div>
            </div>

            {{-- Mensajes de validación --}}
            @if ($this->calcularTotal() > $this->montoAsignado)
                <div class="mt-3 p-2 bg-red-100 text-red-700 rounded text-sm flex items-center gap-2">
                    ⚠️ La suma de los recibos asignados no cubre el total de la factura
                </div>
            @elseif($this->montoAsignado > 0 && $this->montoAsignado >= $this->calcularTotal())
                <div class="mt-3 p-2 bg-green-100 text-green-700 rounded text-sm flex items-center gap-2">
                    ✅ La factura está cubierta por los recibos asignados
                </div>
            @endif
        </div>
    </x-page-header>

        {{-- Mensajes de éxito/error --}}
        @if (session()->has('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg font-semibold flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg font-semibold flex items-center gap-2">
                ❌ {{ session('error') }}
            </div>
        @endif


</div>
