<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Citas Hoy por Profesional</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <ul class="divide-y divide-gray-200">
            @forelse($citasPorProfesional as $profesional)
                <li class="py-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 font-medium">
                                    {{ substr($profesional['nombre'], 0, 1) }}{{ substr($profesional['apellido'], 0, 1) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $profesional['nombre'] }} {{ $profesional['apellido'] }}
                                </p>
                                <p class="text-sm text-gray-500">{{ $profesional['especialidad']['nombre'] }}</p>
                            </div>
                        </div>
                        <div class="ml-2 flex-shrink-0 flex">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $profesional['citas_count'] }} citas
                            </span>
                        </div>
                    </div>
                </li>
            @empty
                <li class="py-3 text-center text-gray-500">
                    No hay profesionales con citas hoy
                </li>
            @endforelse
        </ul>
    </div>
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <a href="{{ route('agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
            Agendar nueva cita
        </a>
    </div>
</div>