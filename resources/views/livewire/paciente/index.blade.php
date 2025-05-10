<section class="w-full">
    <x-page-header title="Pacientes" subtitle="Lista de pacientes" color="green">
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- Búsqueda y botón crear -->
                    <div class="sm:flex sm:items-center justify-between gap-4 mb-6">
                        <div class="flex-1">
                            <flux:input label="Buscar paciente" wire:model.live.debounce.500ms="buscar" placeholder="Nombre o apellido..." />
                        </div>
                        <div class="shrink-0">
                            <flux:button variant="primary" :href="route('pacientes.create')">{{ __('Agregar nuevo') }}</flux:button>
                        </div>
                    </div>

                    <!-- Tabla -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                            <thead class="bg-gray-50 text-xs uppercase tracking-wider text-left text-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">#</th>
                                    <th scope="col" class="px-6 py-3 font-semibold cursor-pointer hover:text-blue-500" wire:click="sortBy('nombre')">
                                        Nombre
                                        @if ($sortField === 'nombre')
                                            @if ($sortDirection === 'asc')
                                                🔼
                                            @else
                                                🔽
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold cursor-pointer hover:text-blue-500" wire:click="sortBy('apellido')">
                                        Apellido
                                        @if ($sortField === 'apellido')
                                            @if ($sortDirection === 'asc')
                                                🔼
                                            @else
                                                🔽
                                            @endif
                                        @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($pacientes as $paciente)
                                    <tr wire:key="{{ $paciente->id }}" class="hover:bg-gray-50 transition-colors">
                                        <td class="whitespace-nowrap px-6 py-4">{{ ++$i }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $paciente->nombre }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $paciente->apellido }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <flux:button.group>
                                                @can('view pacientes')
                                                    <flux:button size="sm" wire:navigate href="{{ route('pacientes.show', $paciente->id) }}">Ver</flux:button>
                                                @endcan
                                                @can('edit pacientes')
                                                    <flux:button size="sm" variant="primary" wire:navigate href="{{ route('pacientes.edit', $paciente->id) }}">Editar</flux:button>
                                                @endcan
                                                <flux:button size="sm" variant="filled" href="{{ route('disponibilidad', $paciente->id) }}">Disponibilidad</flux:button>
                                                @can('delete pacientes')
                                                    <flux:button size="sm" variant="danger" wire:click="delete({{ $paciente->id }})" wire:confirm="¿Estás seguro de eliminar este paciente?">Eliminar</flux:button>
                                                @endcan
                                            </flux:button.group>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-gray-500">No se encontraron pacientes.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4 px-4">
                        {{ $pacientes->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-page-header>
</section>