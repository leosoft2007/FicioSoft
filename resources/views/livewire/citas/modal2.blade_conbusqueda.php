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

                        <label for="paciente" class="block text-sm font-medium text-gray-700">Paciente</label>
                        <div class="relative group pt-1.5">
                            <button id="dropdown-button" type="button"
                                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                <span class="mr-2">
                                    @php
                                        $pacienteSeleccionado = collect($pacientes)->firstWhere('id', $newCita['paciente_id']);
                                    @endphp
                                    @if($pacienteSeleccionado)
                                        {{ $pacienteSeleccionado['apellido'] }}, {{ $pacienteSeleccionado['nombre'] }}
                                    @else
                                        Seleccione un paciente
                                    @endif
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="dropdown-menu" class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1 z-50">
                                <input id="search-input" class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none" type="text" placeholder="Buscar paciente..." autocomplete="off">
                                @foreach ($pacientes as $paciente)
                                    <a href="#" onclick="@this.set('newCita.paciente_id', {{ $paciente['id'] }}); toggleDropdown(); return false;"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">
                                        {{ $paciente['apellido'] }}, {{ $paciente['nombre'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>





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
        <script>
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const searchInput = document.getElementById('search-input');
            let isOpen = false;
            function toggleDropdown() {
                    isOpen = !isOpen;
                    dropdownMenu.classList.toggle('hidden', !isOpen);
                    if (isOpen) {
                        searchInput.value = '';
                        // Opcional: mostrar todos los pacientes al abrir
                        const items = dropdownMenu.querySelectorAll('a');
                        items.forEach((item) => item.style.display = 'block');
                        searchInput.focus();
                    }
                }

            // Asegura que el menú esté oculto al inicio
            dropdownMenu.classList.add('hidden');
            isOpen = false;

            

            dropdownButton.addEventListener('click', () => {
                toggleDropdown();
                if (isOpen) searchInput.focus();
            });

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                const items = dropdownMenu.querySelectorAll('a');
                items.forEach((item) => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Opcional: cerrar al hacer click fuera
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                    isOpen = false;
                }
            });
        </script>




