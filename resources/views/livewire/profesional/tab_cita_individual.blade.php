<div x-show="activeTab === 'individuales'" class="p-6 bg-blue-100 rounded-b-lg shadow-md">
    <h3 class="text-lg font-medium text-blue-600 mb-4">
        <i class="fas fa-calendar-alt mr-2"></i>Citas Individuales
    </h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-blue-100">
                <tr>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Paciente</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Servicio</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Fecha</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Horario</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Estado</th>
                    <th class="py-3.5 text-left text-sm font-semibold text-gray-900">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($citasIndividuales as $cita)
                    <tr>
                        <td class="py-4 text-sm text-gray-900">{{ $cita->paciente->nombre_completo ?? 'N/A' }}</td>
                        <td class="py-4 text-sm text-gray-500">{{ $cita->servicio->nombre ?? 'N/A' }}</td>
                        <td class="py-4 text-sm text-gray-500">{{ $cita->fecha->format('d/m/Y') }}</td>

                        <td class="py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($cita->hora_inicio )->format('H:i') }} - {{ \Carbon\Carbon::parse($cita->hora_fin )->format('H:i') }}</td>
                        <td class="py-4 text-sm text-center">
                            <div class="flex justify-center space-x-2">
                                <!-- Estado Pendiente -->
                                <button wire:click="actualizarEstado({{ $cita->id }}, 'pendiente')"
                                    class="focus:outline-none">
                                    <div
                                        class="inline-block w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center border {{ $cita->estado == 'pendiente' ? 'border-yellow-500' : 'border-transparent' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                        </svg>
                                    </div>
                                </button>

                                <!-- Estado Confirmado -->
                                <button wire:click="actualizarEstado({{ $cita->id }}, 'confirmado')"
                                    class="focus:outline-none">
                                    <div
                                        class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center border {{ $cita->estado == 'confirmado' ? 'border-green-500' : 'border-transparent' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </button>

                                <!-- Estado Cancelado -->
                                <button wire:click="actualizarEstado({{ $cita->id }}, 'cancelado')"
                                    class="focus:outline-none">
                                    <div
                                        class="inline-block w-8 h-8 rounded-full bg-red-100 flex items-center justify-center border {{ $cita->estado == 'cancelado' ? 'border-red-500' : 'border-transparent' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </td>
                        <td class="py-4 text-sm text-blue-600 hover:text-blue-900 cursor-pointer">Editar</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-sm text-gray-500">No hay citas individuales
                            registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
