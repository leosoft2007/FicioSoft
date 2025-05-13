<flux:modal wire:model="showOcurrenciaUnicaModal" variant='bare' class="w-full max-w-3xl" :dismissible="false" hide-close-button>
    <div @click.away="$wire.closeOcurrenciaUnicaModal()" class="bg-white rounded-lg shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-indigo-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-white">Editar Ocurrencia</h2>
                <button wire:click="$set('showOcurrenciaUnicaModal', false)" class="text-indigo-100 hover:text-white">

                </button>
            </div>
        </div>

        <!-- Contenido -->
        <div class="p-6 space-y-6">

            <!-- Datos informativos -->
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Profesional</label>
                    <p class="mt-1 text-gray-900 font-semibold">{{ $profesionalNombre }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Curso / Grupo</label>
                    <p class="mt-1 text-gray-900 font-semibold">{{ $nombreGrupo }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cupo Máximo</label>
                    <p class="mt-1 text-gray-900 font-semibold">{{ $ocurrencia['cupo_maximo'] }}</p>
                </div>
            </div>

            <!-- Fecha y horas -->
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <flux:input type="date" label="Fecha" wire:model.defer="ocurrencia.fecha" />
                    @error('ocurrencia.fecha') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <flux:input type="time" label="Hora Inicio" wire:model.defer="ocurrencia.hora_inicio" />
                    @error('ocurrencia.hora_inicio') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <flux:input type="time" label="Hora Fin" wire:model.defer="ocurrencia.hora_fin" />
                    @error('ocurrencia.hora_fin') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Pacientes -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold mb-2">Pacientes Disponibles</h4>
                    <ul class="border p-2 h-56 overflow-y-auto space-y-1">
                        @foreach ($pacientes as $paciente)
                            @if (!in_array($paciente->id, $ocurrencia['participantes']))
                                <li class="flex justify-between items-center">
                                    <span>{{ $paciente->nombre }} {{ $paciente->apellido }}</span>
                                    <button type="button" wire:click="agregarParticipante({{ $paciente->id }})"
                                        class="text-lime-600 hover:underline">Agregar</button>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Participantes Seleccionados</h4>
                    <ul class="border p-2 h-56 overflow-y-auto space-y-1">
                        @foreach ($ocurrencia['participantes'] as $id)
                            @php $pac = $pacientes->find($id); @endphp
                            <li class="flex justify-between items-center">
                                <span>{{ $pac?->nombre }} {{ $pac?->apellido }}</span>
                                <button type="button" wire:click="quitarParticipante({{ $id }})"
                                    class="text-red-600 hover:underline">Quitar</button>
                            </li>
                        @endforeach
                    </ul>
                    @error('ocurrencia.participantes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 px-6 py-4 flex justify-end space-x-2">
            <flux:button wire:click="$set('showOcurrenciaUnicaModal', false)" variant="danger">Cancelar</flux:button>
            <flux:button wire:click="guardarOcurrenciaUnica" spinner>Guardar Cambios</flux:button>
        </div>
    </div>
</flux:modal>
