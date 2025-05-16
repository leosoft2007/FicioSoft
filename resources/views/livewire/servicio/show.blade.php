<section class="w-full">
    <x-page-header
        title="Detalle del Servicio"
        subtitle="Información completa del servicio médico"
        color="blue"
    >
        <div class="flex items-center gap-2">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <span class="font-medium">{{ $servicio->nombre }}</span>
        </div>
    </x-page-header>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Tarjeta principal -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <!-- Barra de acciones -->
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-gray-600">Información detallada del servicio</span>
                    </div>
                    <div>
                        <flux:button

                            :href="route('servicios.index')"
                            class="flex items-center gap-2"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al listado
                        </flux:button>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">Nombre del Servicio</h3>
                                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $servicio->nombre }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">Precio</h3>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ number_format($servicio->precio, 2) }} €
                                </p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">IVA</h3>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ number_format($servicio->iva, 2) }}%
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                            <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $servicio->descripcion ?: 'Sin descripción' }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                            <div class="mt-1">
                                @if($servicio->estado == 'activo')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                        Inactivo
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                            <flux:button

                                :href="route('servicios.edit', $servicio->id)"
                                class="flex items-center gap-2"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar Servicio
                            </flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
