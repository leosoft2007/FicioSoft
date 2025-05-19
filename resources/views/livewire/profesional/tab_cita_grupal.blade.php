<div x-show="activeTab === 'grupales'" class="p-6 bg-green-100 rounded-b-lg shadow-md">
    <h3 class="text-lg font-medium text-green-600 mb-4">
        <i class="fas fa-users mr-2"></i>Citas Grupales
    </h3>
    <!-- Tabla de citas grupales -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300">

            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($citasGrupales as $citaGrupal)
                <tr class="block sm:table-row border border-green-500">
                        <!-- Columnas principales (visibles en móvil) -->
                        <td class="py-2 px-2 text-sm text-gray-900 block sm:table-cell" data-label="Nombre">
                            <span class="font-semibold sm:hidden">Nombre: </span>{{ $citaGrupal->nombre }}
                        </td>
                        <td class="py-2 px-2 text-sm text-gray-500 block sm:table-cell" data-label="Descripción">
                            <span class="font-semibold sm:hidden">Descripción: </span>
                            <div class="line-clamp-2">{{ $citaGrupal->descripcion }}</div>
                        </td>
                    </tr>
                    <tr class="block sm:table-row">
                        <td class="py-2 px-2 text-sm text-gray-500 block sm:table-cell" data-label="Horario">
                            <span class="font-semibold sm:hidden">Horario: </span>
                            {{ \Carbon\Carbon::parse($citaGrupal->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($citaGrupal->hora_fin)->format('H:i') }}
                        </td>
                        <td class="py-2 px-2 text-sm text-gray-500 block sm:table-cell" data-label="Fechas">
                            <span class="font-semibold sm:hidden">Fechas: </span>
                            {{ $citaGrupal->fecha_inicio->format('d/m/Y') }}
                            @if($citaGrupal->fecha_fin)
                                - {{ $citaGrupal->fecha_fin->format('d/m/Y') }}
                            @endif
                        </td>
                    </tr>
                    <tr class="block sm:table-row">
                        <!-- Columnas que pasan a fila en móvil -->
                        <td colspan="2" class="block sm:table-cell sm:col-span-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2 sm:mt-0">
                                <!-- Sesiones -->
                                <div class="sm:hidden font-semibold text-gray-900">Sesiones</div>
                                <div class="@if(!empty($citaGrupal->ocurrencias)) bg-gray-50 rounded-lg p-2 @endif">
                                    @if(!empty($citaGrupal->ocurrencias) && is_iterable($citaGrupal->ocurrencias))
                                        <div class="max-h-60 overflow-y-auto pr-2">
                                            <ul class="space-y-2">
                                                @foreach($citaGrupal->ocurrencias as $ocurrencia)
                                                    <li class="p-2 border rounded-lg">
                                                        <span class="font-medium block">{{ \Carbon\Carbon::parse($ocurrencia->fecha)->format('d/m/Y') ?? 'Sin fecha' }}</span>
                                                        <span class="text-xs text-gray-500 block">
                                                            {{ \Carbon\Carbon::parse($ocurrencia->fecha)->locale('es')->isoFormat('dddd') }}
                                                        </span>
                                                        <div class="flex justify-center space-x-2 mt-1">
                                                            <!-- Estado Pendiente -->
                                                            <button wire:click="actualizarEstadoOcurrencia({{ $ocurrencia->id }}, 'pendiente')"
                                                                class="focus:outline-none">
                                                                <div
                                                                    class="inline-block w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center border {{ $ocurrencia->estado == 'pendiente' ? 'border-yellow-500' : 'border-transparent' }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-6 h-6 text-yellow-500 hover:scale-110 transition-transform"
                                                                        fill="none"
                                                                        viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                </div>
                                                            </button>

                                                            <!-- Estado Confirmado -->
                                                            <button wire:click="actualizarEstadoOcurrencia({{ $ocurrencia->id }}, 'confirmado')"
                                                                class="focus:outline-none">
                                                                <div
                                                                    class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center border {{ $ocurrencia->estado == 'confirmado' ? 'border-green-500' : 'border-transparent' }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M5 13l4 4L19 7" />
                                                                    </svg>
                                                                </div>
                                                            </button>

                                                            <!-- Estado Cancelado -->
                                                            <button wire:click="actualizarEstadoOcurrencia({{ $ocurrencia->id }}, 'cancelado')"
                                                                class="focus:outline-none">
                                                                <div
                                                                    class="inline-block w-8 h-8 rounded-full bg-red-100 flex items-center justify-center border {{ $ocurrencia->estado == 'cancelado' ? 'border-red-500' : 'border-transparent' }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500"
                                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <span class="text-gray-500">Sin días asignados</span>
                                    @endif
                                </div>

                                <!-- Participantes -->
                                <div class="sm:hidden font-semibold text-gray-900">Participantes</div>
                                <div class="@if(!empty($citaGrupal->pacientes)) bg-gray-50 rounded-lg p-2 @endif">
                                    @if(!empty($citaGrupal->pacientes) && is_iterable($citaGrupal->pacientes))
                                        <div class="max-h-60 overflow-y-auto pr-2">
                                            <ul class="space-y-2">
                                                @foreach($citaGrupal->pacientes as $paciente)
                                                    <li class="p-2 border rounded-lg">
                                                        <span class="font-medium block">{{ $paciente->nombre_completo ?? 'Sin nombre' }}</span>
                                                        <span class="text-xs text-gray-500 block">{{ $paciente->email ?? 'Sin email' }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <span class="text-gray-500">Sin participantes</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-sm text-gray-500">No hay citas grupales registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
