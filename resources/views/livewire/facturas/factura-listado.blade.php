<div>
    <div class="mb-4 bg-white p-4 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Listado de Facturas</h2>
        
        <!-- Filtros -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <!-- Búsqueda general -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                <input 
                    type="text" 
                    id="search" 
                    wire:model.live.debounce.500ms="search" 
                    placeholder="N° factura o paciente..."
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
            </div>

            <!-- Filtro por fechas -->
            <div>
                <label for="fechaInicio" class="block text-sm font-medium text-gray-700">Desde</label>
                <input 
                    type="date" 
                    id="fechaInicio" 
                    wire:model.live="fechaInicio" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
            </div>

            <div>
                <label for="fechaFin" class="block text-sm font-medium text-gray-700">Hasta</label>
                <input 
                    type="date" 
                    id="fechaFin" 
                    wire:model.live="fechaFin" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
            </div>

            <!-- Filtro por estado -->
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select 
                    id="estado" 
                    wire:model.live="estado" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
                    <option value="">Todos</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}">{{ ucfirst($estado) }}</option>
                    @endforeach
                </select>
            </div>

            
        </div>

        <!-- Botones de exportación -->
        <div class="flex justify-end space-x-2 mb-4">
            <button 
                wire:click="exportarPdf" 
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"
            >
                Exportar PDF
            </button>
            <button 
                wire:click="exportarExcel" 
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition"
            >
                Exportar Excel
            </button>
        </div>
    </div>

    <!-- Tabla de resultados -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('numero_factura')">
                            N° Factura
                            @if($sortField === 'numero_factura')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paciente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('fecha')">
                            Fecha
                            @if($sortField === 'fecha')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('total')">
                            Total
                            @if($sortField === 'total')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('estado')">
                            Estado
                            @if($sortField === 'estado')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Clínica
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
    
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($facturas as $factura)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $factura->numero_factura }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $factura->paciente->nombre }} {{ $factura->paciente->apellidos }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($factura->total, 2) }} €
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $factura->estado === 'pagada' ? 'bg-green-100 text-green-800' : 
                                       ($factura->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($factura->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $factura->clinica->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('facturas.index', $factura->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Ver</a>
                                <a href="{{ route('facturas.edit', $factura->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Editar</a>
                                <button wire:click="confirmDelete({{ $factura->id }})" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </td>
                        </tr>
                       
                    @empty

                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                No se encontraron facturas con los filtros aplicados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
            {{ $facturas->links() }}
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <!-- Puedes implementar un modal de confirmación aquí si lo deseas -->
</div>