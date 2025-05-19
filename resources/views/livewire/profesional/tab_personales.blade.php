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
