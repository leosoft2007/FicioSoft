<section class="w-full">
    
	<x-page-header 
    title="Pacientes" 
    subtitle="Lista de Pacientes"
    color="green">
	
	

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto"></div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button variant="primary"  :href="route('pacientes.create')">{{ __('Add New') }}</flux:butt>
                        </div>
                    </div>

					
				<flux:input label="Buscar Paciente" wire:model.live="buscar"> Buscar Paciente </flux:input>


                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Apellido</th>
								

                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($pacientes as $paciente)
                                        <tr class="even:bg-gray-50" wire:key="{{ $paciente->id }}">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                            
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $paciente->nombre }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $paciente->apellido }}</td>
									

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">

                                            <flux:button.group>
											@can('view pacientes')
												<flux:button wire:navigate href="{{ route('pacientes.show', $paciente->id) }}" >{{ __('Show') }}</flux:button>
											@endcan
                                            @can('edit pacientes')
                                            	<flux:button variant="primary" wire:navigate href="{{ route('pacientes.edit', $paciente->id) }}" >{{ __('Edit') }}</flux:button>
											@endcan
                                            <flux:button variant="filled" href="{{ route('disponibilidad', $paciente->id) }}">Ver disponibilidad</flux:button>
											@can('delete pacientes')
                                            	<flux:button variant="danger" wire:click="delete({{ $paciente->id }})" wire:confirm="Are you sure you want to delete?">{{ __('Delete') }}</flux:button>
											@endcan
                                            </flux:button.group>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $pacientes->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</x-page-header>
</section>