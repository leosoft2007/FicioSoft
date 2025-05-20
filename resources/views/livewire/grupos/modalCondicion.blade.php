<!-- Modal para decidir que tipo de cita crear individual grupal -->

@if($mostrarSelectorTipoCita)
    <div
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <!-- Modal Container -->
        <div
            class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden"
            @click.away="$wire.set('mostrarSelectorTipoCita', false)"
        >
            <!-- Header -->
            <div class="px-6 py-4 bg-indigo-600 text-white">
                <h3 class="text-lg font-medium">Seleccionar tipo de cita</h3>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                <p class="text-gray-600">¿Qué tipo de cita deseas crear?</p>

                <div class="grid gap-4">
                    <!-- Botón Individual -->
                    <button
                        wire:click="seleccionarTipoCita('individual')"
                        class="flex items-center gap-4 px-4 py-3 text-left transition-all bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-100"
                    >
                        <div class="p-2 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Cita Individual</p>
                            <p class="text-sm text-gray-500">Para un solo paciente</p>
                        </div>
                    </button>

                    <!-- Botón Grupal -->
                    <button
                        wire:click="seleccionarTipoCita('grupal')"
                        class="flex items-center gap-4 px-4 py-3 text-left transition-all bg-green-50 hover:bg-green-100 rounded-lg border border-green-100"
                    >
                        <div class="p-2 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Cita Grupal</p>
                            <p class="text-sm text-gray-500">Para múltiples pacientes</p>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button
                    wire:click="$set('mostrarSelectorTipoCita', false)"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 transition"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
@endif
