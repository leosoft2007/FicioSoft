<section>
    <x-page-header
        title="{{ __('Detalles de la Clínica') }}"
        subtitle="Información completa y resumen estadístico"
        color="blue"
    />

    <section class="w-full py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Card: Información de la clínica -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Datos de la Clínica</h3>
                    <flux:button variant="primary" :href="route('clinicas.index')">
                        {{ __('Volver al listado') }}
                    </flux:button>
                </div>

                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $clinica->nombre }}</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">NIF</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $clinica->nif }}</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $clinica->direccion }}</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $clinica->telefono }}</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $clinica->email }}</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Color Asignado</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900 flex items-center">
                                <span class="inline-block w-6 h-6 rounded-full" style="background-color: {{ $clinica->color }}"></span>
                                <span class="ml-2">{{ $clinica->color }}</span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Resumen estadístico -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Usuarios -->
                <div class="bg-blue-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-blue-700">Usuarios</dt>
                    <dd class="mt-1 text-2xl font-bold text-blue-900">{{ $clinica->users_count }}</dd>
                </div>

                <!-- Pacientes -->
                <div class="bg-green-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-green-700">Pacientes</dt>
                    <dd class="mt-1 text-2xl font-bold text-green-900">{{ $clinica->pacientes_count }}</dd>
                </div>

                <!-- Profesionales -->
                <div class="bg-purple-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-purple-700">Profesionales</dt>
                    <dd class="mt-1 text-2xl font-bold text-purple-900">{{ $clinica->profesionales_count }}</dd>
                </div>

                <!-- Especialidades -->
                <div class="bg-yellow-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-yellow-700">Especialidades</dt>
                    <dd class="mt-1 text-2xl font-bold text-yellow-900">{{ $clinica->especialidades_count }}</dd>
                </div>

                <!-- Servicios -->
                <div class="bg-indigo-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-indigo-700">Servicios</dt>
                    <dd class="mt-1 text-2xl font-bold text-indigo-900">{{ $clinica->servicios_count }}</dd>
                </div>

                <!-- Citas individuales -->
                <div class="bg-red-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-red-700">Citas Individuales</dt>
                    <dd class="mt-1 text-2xl font-bold text-red-900">{{ $clinica->citas_count }}</dd>
                </div>

                <!-- Citas grupales -->
                <div class="bg-pink-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-pink-700">Citas Grupales</dt>
                    <dd class="mt-1 text-2xl font-bold text-pink-900">{{ $clinica->citasgrupals_count }}</dd>
                </div>

                <!-- Facturas -->
                <div class="bg-emerald-50 p-6 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <dt class="text-sm font-medium text-emerald-700">Facturas</dt>
                    <dd class="mt-1 text-2xl font-bold text-emerald-900">{{ $clinica->facturas_count }}</dd>
                </div>
            </div>

            <!-- Detalles adicionales -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Detalles Adicionales</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Profesionales Destacados</h4>
                            @forelse($clinica->profesionales as $profesional)
                                <div class="flex items-center justify-between py-2 border-b border-dashed border-gray-200 last:border-0">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center h-8 w-8 bg-blue-100 rounded-full text-blue-600 text-xs font-semibold">
                                            {{ substr($profesional->nombre, 0, 1) }}{{ substr($profesional->apellido, 0, 1) }}
                                        </span>
                                        <span class="ml-3 text-sm text-gray-900">{{ $profesional->nombre }} {{ $profesional->apellido }}</span>
                                    </div>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                        {{ $profesional->especialidad?->nombre ?? 'Sin especialidad' }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">No hay profesionales asignados.</p>
                            @endforelse
                        </div>

                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Servicios Populares</h4>
                            @forelse($clinica->servicios as $servicio)
                                <div class="flex items-center justify-between py-2 border-b border-dashed border-gray-200 last:border-0">
                                    <div class="flex items-center">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $servicio->color }}"></span>
                                        <span class="text-sm text-gray-900">{{ $servicio->nombre }}</span>
                                    </div>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-800">
                                        {{ $servicio->citas_count }} citas
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">No hay servicios registrados.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
