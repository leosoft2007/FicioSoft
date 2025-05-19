<div x-show="activeTab === 'grupales'" class="p-6 bg-green-100 rounded-b-lg shadow-md">
    <h3 class="text-lg font-medium text-green-600 mb-4">
        <i class="fas fa-users mr-2"></i>Citas Grupales
    </h3>
    <!-- Tabla de citas grupales -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-green-100">
                <tr>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Nombre</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Descripción</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Horario</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Fechas</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Sesiones</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Participantes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($citasGrupales as $citaGrupal)
                    <tr>
                        <td class="py-4 text-sm text-gray-900">{{ $citaGrupal->nombre }}</td>
                        <td class="py-4 text-sm text-gray-500 truncate">{{ $citaGrupal->descripcion }}</td>
                        <td class="py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($citaGrupal->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($citaGrupal->hora_fin)->format('H:i') }}</td>
                        <td class="py-4 text-sm text-gray-500">
                            {{ $citaGrupal->fecha_inicio->format('d/m/Y') }}
                            @if($citaGrupal->fecha_fin)
                                - {{ $citaGrupal->fecha_fin->format('d/m/Y') }}
                            @endif
                        </td>
                        <td class="py-4 text-sm text-gray-500">
                            @if(!empty($citaGrupal->ocurrencias) && is_iterable($citaGrupal->ocurrencias))
                                <ul class="list-disc pl-4 space-y-1">
                                    @foreach($citaGrupal->ocurrencias as $ocurrencia)
                                        <li>


                                            <span class="font-medium">{{ \Carbon\Carbon::parse($ocurrencia->fecha)->format('d/m/Y') ?? 'Sin fecha' }}</span>
                                            <span class="text-xs text-gray-500 block">
                                                {{ \Carbon\Carbon::parse($ocurrencia->fecha)->locale('es')->isoFormat('dddd') }}

                                                <span class="inline-block rounded-full px-2 py-1 text-xs font-semibold
                                                @if($ocurrencia->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                                @elseif($ocurrencia->estado == 'confirmado') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($ocurrencia->estado) }}
                                                </span>


                                                
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-500">Sin días asignados</span>
                            @endif
                        </td>
                        <td class="py-4 text-sm text-gray-500">
                            @if(!empty($citaGrupal->pacientes) && is_iterable($citaGrupal->pacientes))
                                <ul class="list-disc pl-4 space-y-1">
                                    @foreach($citaGrupal->pacientes as $paciente)
                                        <li>
                                            <span class="font-medium">{{ $paciente->nombre_completo ?? 'Sin nombre' }}</span>
                                            <span class="text-xs text-gray-500 block">{{ $paciente->email ?? 'Sin email' }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-500">Sin participantes</span>
                            @endif
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
