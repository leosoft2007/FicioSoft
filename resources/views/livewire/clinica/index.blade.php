<section class="w-full">
    <x-page-header
        title="{{ __('Clínicas') }}"
        subtitle="Lista de todas las clínicas registradas"
        color="blue"
        :clickable="true"
        badge="Nuevo"
        icon="check"
        footer="Texto de pie"
        wire:key="factura-filtros"
    />

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Card principal -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                <div class="sm:flex sm:items-center sm:justify-between mb-6">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Clínicas Registradas</h3>
                        <p class="mt-1 text-sm text-gray-500">Administra los datos de cada clínica desde aquí.</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <flux:button variant="primary" :href="route('clinicas.create')">
                            {{ __('Añadir nueva clínica') }}
                        </flux:button>
                    </div>
                </div>

                <!-- Tabla de clínicas -->
                <x-table :headers="['Nombre', 'Teléfono', 'Email', 'Acciones']">
                    @forelse ($clinicas as $clinica)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $clinica->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $clinica->telefono }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $clinica->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                <a href="{{ route('clinicas.edit', $clinica->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <button wire:click="delete({{ $clinica->id }})" class="text-red-600 hover:text-red-900">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay clínicas registradas.
                            </td>
                        </tr>
                    @endforelse
                </x-table>
            </div>
            </div>
        </div>
    </div>
</section>
