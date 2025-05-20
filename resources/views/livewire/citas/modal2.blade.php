<!-- -- Modal para crear una nueva cita  individual-->

<flux:modal wire:model="showModal2" variant='bare' class="md:w-[600px]" :dismissible="false" hide-close-button>
        <div @click.away="$wire.closeModal2()" class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Encabezado del modal -->
            <div class="bg-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-white">Crear Nueva Cita</h2>
                    <button wire:click="closeModal2" class="text-indigo-100 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mensaje de error -->
            @if ($errorMessage)
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mx-6 mt-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ $errorMessage }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contenido del modal -->
            <div class="p-6 space-y-4">
                <!-- Paciente y Profesional -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <flux:select label="Paciente" wire:model="newCita.paciente_id" class="w-full">
                            <option value="">Seleccione un paciente</option>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">
                                    {{ $paciente->apellido }}, {{ $paciente->nombre }}
                                </option>
                            @endforeach
                        </flux:select>

                    </div>
                    <div>
                        <flux:select label="Profesional" wire:model="newCita.profesional_id" class="w-full">
                            <option value="">Seleccione un profesional</option>
                            @foreach ($profesionales as $profesional)
                                <option value="{{ $profesional->id }}">
                                    {{ $profesional->nombre }}
                                </option>
                            @endforeach
                        </flux:select>
                    </div>
                </div>

                <!-- Fecha y Horas -->
                <div class="grid grid-cols-1 gap-4">
                    <flux:input label="Fecha" type="date" wire:model="newCita.fecha" class="w-full" />

                    <div class="grid grid-cols-2 gap-4">
                        <flux:input label="Hora Inicio" type="time" wire:model="newCita.hora_inicio" />
                        <flux:input label="Hora Fin" type="time" wire:model="newCita.hora_fin" />
                    </div>
                </div>

                <!-- Observaciones -->
                <div>
                    <flux:textarea label="Observaciones" wire:model="newCita.observaciones" rows="3"
                        placeholder="Ingrese cualquier observación relevante..." class="w-full" />
                </div>
            </div>

            <!-- Pie del modal -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-200">
                <flux:button type="button" variant="primary" wire:click="closeModal2">
                    Cancelar
                </flux:button>

                <flux:button wire:click="guardarCita" color="primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>

                </flux:button>
            </div>
        </div>
    </flux:modal>
