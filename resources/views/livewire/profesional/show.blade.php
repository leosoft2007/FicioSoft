<section class="w-full">
    <x-page-header title="{{ __('Detalles del Profesional') }}" subtitle="{{ __('Información completa') }}" color="blue" />

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gradient-to-br from-blue-50 to-white shadow-lg sm:rounded-xl">
                <div class="w-full">
                    <div class="sm:flex sm:items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $profesional->nombre }} {{ $profesional->apellido }}</h1>
                            <p class="mt-1 text-sm text-gray-600">Detalles completos del profesional</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <flux:button variant="primary" :href="route('profesionals.index')" class="text-white bg-blue-600 hover:bg-blue-700">
                                <i class="fas fa-arrow-left mr-2"></i>{{ __('Volver al listado') }}
                            </flux:button>
                        </div>
                    </div>

                    <!-- Pestañas -->
                    <div class="mt-8" x-data="{ activeTab: 'datos' }">
                        <div class="relative">
                            <nav class="flex space-x-4" aria-label="Tabs">
                                <button @click="activeTab = 'datos'"
                                    :class="activeTab === 'datos' ? 'bg-pink-100 text-pink-600' : 'bg-gray-100 text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-2 text-sm font-bold rounded-t-md transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-user mr-2"></i>Datos Personales
                                </button>
                                <button @click="activeTab = 'individuales'"
                                    :class="activeTab === 'individuales' ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-2 text-sm font-bold rounded-t-md transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-calendar mr-2"></i>Citas Individuales ({{ $citasIndividuales->count() }})
                                </button>
                                <button @click="activeTab = 'grupales'"
                                    :class="activeTab === 'grupales' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-2 text-sm font-bold rounded-t-md transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-users mr-2"></i>Citas Grupales ({{ $citasGrupales->count() }})
                                </button>
                            </nav>
                        </div>

                        <!-- Contenido de las pestañas -->
                        <div>
                            <!-- Pestaña Datos Personales -->
                            <div x-show="activeTab === 'datos'" class="p-6 bg-pink-100 rounded-b-lg shadow-md">
                                <h3 class="text-lg font-medium text-pink-600 mb-4">
                                    <i class="fas fa-info-circle mr-2"></i>Información Básica
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <dl class="space-y-4">
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Nombre completo</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->nombre }} {{ $profesional->apellido }}
                                                </dd>
                                            </div>
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->email }}
                                                </dd>
                                            </div>
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->telefono }}
                                                </dd>
                                            </div>
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">CIF/NIF</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->cif }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>

                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <dl class="space-y-4">
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->direccion }}
                                                </dd>
                                            </div>
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Ciudad</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->ciudad }}
                                                </dd>
                                            </div>
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Código Postal</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->codigo_postal }}
                                                </dd>
                                            </div>
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">Estado</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                    {{ $profesional->estado }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <!-- Pestaña Citas Individuales -->
                            <div x-show="activeTab === 'individuales'" class="p-6 bg-blue-100 rounded-b-lg shadow-md">
                                <h3 class="text-lg font-medium text-blue-600 mb-4">
                                    <i class="fas fa-calendar-alt mr-2"></i>Citas Individuales
                                </h3>
                                <!-- Tabla de citas individuales -->
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
                                                    <td class="py-4 text-sm text-gray-500">{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                                                    <td class="py-4 text-sm">
                                                        <span class="inline-block rounded-full px-2 py-1 text-xs font-semibold
                                                        @if($cita->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                                        @elseif($cita->estado == 'confirmado') bg-green-100 text-green-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                            {{ ucfirst($cita->estado) }}
                                                        </span>
                                                    </td>
                                                    <td class="py-4 text-sm text-blue-600 hover:text-blue-900 cursor-pointer">Editar</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="py-4 text-center text-sm text-gray-500">No hay citas individuales registradas</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pestaña Citas Grupales -->
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
                                                    <td class="py-4 text-sm text-gray-500">{{ $citaGrupal->hora_inicio }} - {{ $citaGrupal->hora_fin }}</td>
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
                                                                        <span class="font-medium">{{ $ocurrencia->fecha ?? 'Sin fecha' }}</span>
                                                                        <span class="text-xs text-gray-500 block">
                                                                            {{ \Carbon\Carbon::parse($ocurrencia->fecha)->locale('es')->isoFormat('dddd') }}
                                                                            {{ $ocurrencia->estado ?? 'Sin estado' }}
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
