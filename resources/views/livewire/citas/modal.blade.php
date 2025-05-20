<!-- Modal para editar cita individual -->

<flux:modal wire:model="showModal" variant='bare' class="md:w-[600px]" :dismissible="false">
        <div @click.away="$wire.closeModal()" class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Encabezado del modal -->
            <div class="bg-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-white">Editar Cita</h3>
                    <button wire:click="closeModal" class="text-indigo-100 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Contenido del modal -->
            <div class="p-6">
                @if ($selectedCita)
                    <div class="space-y-4">
                        <!-- Sección Paciente/Profesional -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:input type="text" label="Paciente"
                                    value="{{ $selectedCita['paciente']['nombre'] }}" disabled class="bg-gray-50" />
                            </div>
                            <div>
                                <flux:input label="Profesional"
                                    value="{{ $selectedCita['profesional']['nombre'] ?? 'No asignado' }}" disabled
                                    class="bg-gray-50" />
                            </div>
                        </div>

                        <!-- Sección Fecha/Hora -->
                        <div class="grid grid-cols-1 gap-4">
                            <flux:input label="Fecha" type="date" wire:model="selectedCita.fecha" class="w-full" />

                            <div class="grid grid-cols-2 gap-4">
                                <flux:input label="Hora Inicio" type="time" wire:model="selectedCita.hora_inicio" />
                                <flux:input label="Hora Fin" type="time" wire:model="selectedCita.hora_fin" />
                            </div>
                        </div>

                        <!-- Estado y Observaciones -->
                        <div class="grid grid-cols-1 gap-4">
                            <flux:select label="Estado" wire:model="selectedCita.estado" class="w-full">
                                <flux:select.option value="pendiente" class="flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-yellow-400 mr-2"></span>
                                    Pendiente
                                </flux:select.option>
                                <flux:select.option value="confirmado" class="flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                    Confirmado
                                </flux:select.option>
                                <flux:select.option value="cancelado" class="flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-red-400 mr-2"></span>
                                    Cancelado
                                </flux:select.option>
                            </flux:select>

                            <flux:textarea label="Observaciones" wire:model="selectedCita.observaciones"
                                rows="3" placeholder="Ingrese cualquier observación relevante..." />
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pie del modal -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <div>
                    <flux:button type="button" variant="danger" wire:click="deleteCita" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>

                    </flux:button>
                </div>

                <div class="flex">
                    <flux:button type="button" color="secondary" wire:click="closeModal" class="mr-2">
                        Cancelar
                    </flux:button>

                    <flux:button type="button" color="primary" label="Guardar Cambios" wire:click="saveCita">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>

                    </flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
