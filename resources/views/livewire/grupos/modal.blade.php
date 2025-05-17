<flux:modal
    wire:model="showGrupalModal"
    variant="bare"
    class="w-full max-w-4xl"
    :dismissible="false"
    hide-close-button
    x-data="{
        tab: 'general',
        resetTab() {
            this.tab = 'general';
        }
    }"
    x-init="
        Livewire.on('resetTab', () => {
            resetTab();
        });
    "
>
    <div @click.away="$wire.closeGrupalModal()" class="bg-white rounded-lg shadow-xl overflow-hidden">

        <!-- Encabezado del modal -->
        <div class="bg-indigo-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-white">
                    {{ $modoFormulario === 'editar' ? 'Editar Cita Grupal' : 'Nueva Cita Grupal' }}
                </h2>
                <button wire:click="$set('showGrupalModal', false)" class="text-indigo-100 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-4 min-h-[30rem] flex flex-col justify-between">

            <!-- Pestañas mejoradas -->
            <div class="flex border-b border-gray-200 mb-6">
                <button
                    @click="tab = 'general'"
                    :class="{
                        'border-b-2 border-indigo-500 text-indigo-600': tab === 'general',
                        'text-gray-500 hover:text-gray-700': tab !== 'general'
                    }"
                    class="px-4 py-3 flex-1 flex items-center justify-center gap-2 font-medium text-sm focus:outline-none"
                >
                    <svg class="w-5 h-5" :class="{ 'text-indigo-500': tab === 'general', 'text-gray-400': tab !== 'general' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    General
                </button>

                <button
                    @click="tab = 'opciones'"
                    :class="{
                        'border-b-2 border-indigo-500 text-indigo-600': tab === 'opciones',
                        'text-gray-500 hover:text-gray-700': tab !== 'opciones'
                    }"
                    class="px-4 py-3 flex-1 flex items-center justify-center gap-2 font-medium text-sm focus:outline-none"
                >
                    <svg class="w-5 h-5" :class="{ 'text-indigo-500': tab === 'opciones', 'text-gray-400': tab !== 'opciones' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Opciones
                </button>

                <button
                    @click="tab = 'pacientes'"
                    :class="{
                        'border-b-2 border-indigo-500 text-indigo-600': tab === 'pacientes',
                        'text-gray-500 hover:text-gray-700': tab !== 'pacientes'
                    }"
                    class="px-4 py-3 flex-1 flex items-center justify-center gap-2 font-medium text-sm focus:outline-none"
                >
                    <svg class="w-5 h-5" :class="{ 'text-indigo-500': tab === 'pacientes', 'text-gray-400': tab !== 'pacientes' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Pacientes
                </button>
            </div>

            {{-- TAB: GENERAL --}}
            <div x-show="tab === 'general'" class="space-y-4 h-[420px]" x-transition>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:input type="text" label="Nombre del Grupo" wire:model.defer="newCitaGrupal.nombre" />
                        @error('newCitaGrupal.nombre')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <flux:select label="Profesional" wire:model.defer="newCitaGrupal.profesional_id">
                            <option value="">Seleccione</option>
                            @foreach ($profesionales as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->nombre }}</option>
                            @endforeach
                        </flux:select>
                        @error('newCitaGrupal.profesional_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:input type="date" label="Fecha Inicio" wire:model.defer="newCitaGrupal.fecha_inicio" />
                        @error('newCitaGrupal.fecha_inicio')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <flux:input type="date" label="Fecha Fin" wire:model.defer="newCitaGrupal.fecha_fin" />
                        @error('newCitaGrupal.fecha_fin')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:input type="time" label="Hora Inicio" wire:model.defer="newCitaGrupal.hora_inicio" />
                        @error('newCitaGrupal.hora_inicio')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <flux:input type="time" label="Hora Fin" wire:model.defer="newCitaGrupal.hora_fin" />
                        @error('newCitaGrupal.hora_fin')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Días de la Semana</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                        @foreach (['1' => 'Lunes', '2' => 'Martes', '3' => 'Miércoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sábado', '7' => 'Domingo'] as $key => $dia)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" value="{{ $key }}"
                                    wire:model.lazy="newCitaGrupal.dias_semana" class="rounded text-indigo-600">
                                <span>{{ $dia }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('newCitaGrupal.dias_semana')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <flux:select label="Frecuencia" wire:model.defer="newCitaGrupal.frecuencia">
                    <option value="semanal">Semanal</option>
                    <option value="quincenal">Quincenal</option>
                </flux:select>
                @error('newCitaGrupal.frecuencia')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- TAB: OPCIONES --}}
            <div x-show="tab === 'opciones'" class="space-y-4 h-[420px]" x-transition>
                <div>
                    <flux:input type="number" label="Cupo Máximo" wire:model.defer="newCitaGrupal.cupo_maximo"
                        min="1" />
                    @error('newCitaGrupal.cupo_maximo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <flux:textarea label="Observaciones" wire:model.defer="newCitaGrupal.observaciones" rows="3" />
            </div>

            {{-- TAB: PACIENTES --}}
            <div x-show="tab === 'pacientes'" class="grid grid-cols-2 gap-4 h-[420px]" x-transition>
                <div>
                    <h4 class="font-semibold mb-2">Pacientes Disponibles</h4>
                    <ul class="border p-2 h-60 overflow-y-auto space-y-1">
                        @foreach ($pacientes as $paciente)
                            @if (!in_array($paciente->id, $newCitaGrupal['pacientes']))
                                <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                    <span>{{ $paciente->nombre }} {{ $paciente->apellido }}</span>
                                    <button type="button" wire:click="addPaciente({{ $paciente->id }})"
                                        @if (count($newCitaGrupal['pacientes']) >= $newCitaGrupal['cupo_maximo']) disabled @endif
                                        class="text-indigo-600 hover:text-indigo-800 px-2 py-1 rounded hover:bg-indigo-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Pacientes Seleccionados
                        ({{ count($newCitaGrupal['pacientes']) }}/{{ $newCitaGrupal['cupo_maximo'] }})</h4>
                    <ul class="border p-2 h-60 overflow-y-auto space-y-1">
                        @foreach ($newCitaGrupal['pacientes'] as $id)
                            @php $pac = $pacientes->find($id); @endphp
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span>{{ $pac?->nombre }} {{ $pac?->apellido }}</span>
                                <button type="button" wire:click="removePaciente({{ $id }})"
                                    class="text-red-600 hover:text-red-800 px-2 py-1 rounded hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @error('newCitaGrupal.pacientes')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- NAVEGACIÓN + FOOTER --}}
            <div class="flex justify-between mt-6">


                    <div>
                        <flux:button type="button" variant="danger" wire:click="deleteCitaGrupal" class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>

                        </flux:button>
                    </div>

                <div>
                    <button x-show="tab !== 'general'" @click="tab = tab === 'pacientes' ? 'opciones' : 'general'"
                        class="text-gray-600 hover:text-gray-800 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Anterior
                    </button>
                </div>
                <div class="flex space-x-2">
                    <button x-show="tab !== 'pacientes'"
                        @click="$wire.validateStep(tab).then(valid => { if(valid) tab = tab === 'general' ? 'opciones' : 'pacientes' })"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 flex items-center gap-1">
                        Siguiente
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                    <flux:button x-show="tab === 'pacientes'"
                        wire:click="{{ $modoFormulario === 'editar' ? 'updateCitaGrupal' : 'createCitaGrupal' }}"
                        spinner class="bg-indigo-600 hover:bg-indigo-700">
                        {{ $modoFormulario === 'editar' ? 'Actualizar' : 'Guardar' }}
                    </flux:button>
                    <flux:button wire:click="$set('showGrupalModal', false)" variant="danger">Cancelar</flux:button>
                </div>
            </div>
        </div>
    </div>
</flux:modal>
