<section class="w-full space-y-6">
    <x-page-header title="Datos del Paciente" subtitle="Información detallada del paciente" color="green" />

    <!-- Pestañas -->
    <div x-data="{ activeTab: 'datos' }" class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Navegación de pestañas -->
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button @click="activeTab = 'datos'"
                    :class="{ 'border-green-500 text-green-600': activeTab === 'datos', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'datos' }"
                    class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Datos Personales
                </button>

                <button @click="activeTab = 'citas'"
                    :class="{ 'border-green-500 text-green-600': activeTab === 'citas', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'citas' }"
                    class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Citas
                </button>

                <button @click="activeTab = 'consentimientos'"
                    :class="{ 'border-green-500 text-green-600': activeTab === 'consentimientos', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'consentimientos' }"
                    class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Consentimientos
                </button>
            </nav>
        </div>

        <!-- Contenido de las pestañas -->
        <div class="p-6">
            <!-- Pestaña de Datos Personales -->
            <div x-show="activeTab === 'datos'" x-transition>
                <!-- Encabezado con foto y datos básicos -->
                <div class="bg-gray-50 px-6 py-4 border-b flex items-center space-x-4">
                    @if ($paciente->foto)
                        <img src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto del paciente"
                            class="h-16 w-16 rounded-full object-cover border-2 border-white shadow">
                    @else
                        <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $paciente->nombre }} {{ $paciente->apellido }}</h2>
                        <p class="text-sm text-gray-600">{{ $paciente->tipo_paciente }} • {{ $paciente->estado_paciente }}</p>
                    </div>
                </div>

                <!-- Datos organizados en 3 columnas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-6">
                    <!-- Columna 1: Información personal -->
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Información Personal
                            </h3>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Fecha de Nacimiento</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años)</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Género</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->genero }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Estado Civil</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->estado_civil }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Documento</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->tipo_documento }}:
                                    {{ $paciente->numero_documento }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Nacionalidad</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->nacionalidad }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Ocupación</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->ocupacion }}</dd>
                            </div>
                        </div>
                    </div>

                    <!-- Columna 2: Información de contacto -->
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Contacto
                            </h3>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Teléfono</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->telefono }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Dirección</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $paciente->direccion }}<br>
                                    {{ $paciente->ciudad }}, {{ $paciente->estado }}<br>
                                    {{ $paciente->codigo_postal }}, {{ $paciente->pais }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Referido por</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->referido_por }}</dd>
                            </div>
                        </div>
                    </div>

                    <!-- Columna 3: Información médica -->
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                                Historial Médico
                            </h3>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Contacto de Emergencia</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $paciente->nombre_contacto_emergencia }}<br>
                                    {{ $paciente->telefono_emergencia }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Alergias</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->alergias ?: 'Ninguna registrada' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Medicamentos</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->medicamentos ?: 'Ninguno registrado' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Historial Médico</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->historial_medico ?: 'No especificado' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Notas Adicionales</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $paciente->notas ?: 'Ninguna nota' }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pestaña de Citas -->
            <div x-show="activeTab === 'citas'" x-transition>
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Historial de Citas
                    </h3>

                    @if($citas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profesional</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($citas as $cita)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($cita->hora_fin)->format('H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $cita->profesional->nombre ?? 'No especificado' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $cita->servicio->nombre ?? 'No especificado' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $cita->estado == 'confirmado' ? 'bg-green-100 text-green-800' :
                                                       ($cita->estado == 'cancelado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ ucfirst($cita->estado) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-green-600 hover:text-green-900 mr-3">Editar</a>
                                                <a href="#" class="text-red-600 hover:text-red-900">Cancelar</a>
                                            </td>
                                        </tr>
                                         <!-- Fila adicional para observaciones -->
                                            <tr>
                                                <td colspan="6" class="px-6 py-3 bg-gray-50 text-sm text-gray-700 border-t border-gray-200">
                                                    <div class="flex items-start">
                                                        <span class="font-medium mr-2">Observaciones:</span>
                                                        <span class="text-gray-600">{{ $cita->observaciones ?: 'Ninguna observación registrada' }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $citas->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay citas registradas</h3>
                            <p class="mt-1 text-sm text-gray-500">Este paciente no tiene citas agendadas.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pestaña de Consentimientos -->
            <div x-show="activeTab === 'consentimientos'" x-transition>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Tarjeta para firmar nuevos consentimientos -->
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Firmar Consentimiento
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label for="consentimiento" class="block text-sm font-medium text-gray-700 mb-1">Selecciona
                                    Consentimiento</label>
                                <select wire:model.live="consentimientoSeleccionado" id="consentimiento"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                                    <option value="0">-- Seleccionar --</option>
                                    @foreach ($consentimientos as $consentimiento)
                                        <option value="{{ $consentimiento->id }}">{{ $consentimiento->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button wire:click="firmarConsentimiento"
                                class="w-full bg-green-600 text-white py-2 px-4 rounded-md shadow hover:bg-green-700 disabled:bg-gray-300 flex items-center justify-center gap-2"
                                @disabled($consentimientoSeleccionado == 0)>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Firmar Consentimiento
                            </button>
                        </div>
                    </div>

                    <!-- Tarjeta de consentimientos firmados -->
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Consentimientos Firmados
                        </h3>

                        @if (count($listaConsentimientos) > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach ($listaConsentimientos as $consentimiento)
                                    <li class="py-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-2">
                                                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-sm text-gray-700">{{ $consentimiento->titulo }}</span>
                                            </div>

                                            @if(count($listaConsentimientos) > 0)
                                            <div class="flex justify-end">
                                                <a href="{{ route('descarga-pdf', ['id_consentimiento' => $consentimiento->id, 'id_paciente' => $paciente->id]) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M4 4v16h16V4H4zm4 4h8v2H8V8zm0 4h8v6H8v-6z"/>
                                                    </svg>
                                                    Descargar último consentimiento
                                                </a>
                                            </div>
                                        @endif

                                            <span
                                                class="text-xs px-2 py-1 rounded-full
                        {{ $consentimiento->pivot ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                                                @if ($consentimiento->pivot && $consentimiento->pivot->firmado_en)
                                                    Firmado el
                                                    {{ \Carbon\Carbon::parse($consentimiento->pivot->firmado_en)->format('d/m/Y') }}
                                                @else
                                                    Sin fecha
                                                @endif
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-6">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Este paciente no ha firmado ningún consentimiento aún.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


