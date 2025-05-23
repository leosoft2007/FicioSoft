<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Próximas Citas</h3>
    </div>

    <div class="px-4 py-5 sm:p-6">
        <!-- Contenedor responsivo -->
        <div class="overflow-x-auto rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paciente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Profesional
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha y Hora
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Servicio
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($proximasCitas as $cita)
                        <tr>
                            <!-- Paciente -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-medium">
                                            {{ substr($cita->paciente->nombre, 0, 1) }}{{ substr($cita->paciente->apellido, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $cita->paciente->telefono }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- Profesional -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $cita->profesional->nombre }}</div>
                                <div class="text-sm text-gray-500">{{ $cita->profesional->especialidad->nombre }}</div>
                            </td>
                            <!-- Fecha y Hora -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $cita->fecha->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($cita->hora_fin)->format('H:i') }}
</div>
                            </td>
                            <!-- Servicio -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $cita->servicio?->nombre ?? 'Sin servicio' }}
                            </td>
                            <!-- Estado -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($cita->estado == 'confirmada')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Confirmada
                                    </span>
                                @elseif($cita->estado == 'pendiente')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pendiente
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                @endif
                            </td>
                            <!-- Acciones -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('agenda') }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <a href="{{ route('agenda') }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay próximas citas programadas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer con info y enlace -->
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Mostrando <span class="font-medium">{{ $proximasCitas->count() }}</span> de <span class="font-medium">{{ $totalProximasCitas }}</span> próximas citas
            </div>
            <a href="{{ route('agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                Ver todas las citas →
            </a>
        </div>
    </div>
</div>
