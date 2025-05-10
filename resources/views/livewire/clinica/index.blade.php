<section class="w-full">


    <x-page-header 
    title="{{ __('Clinicas') }}"
    subtitle="Lista de todas las {{ __('Clinicas') }}"
    color="blue" 
    :clickable="true" 
    badge="Nuevo" 
    icon="check" 
    footer="Texto de pie" 
    wire:key="factura-filtros"
    >
    </x-page-header>



    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto"></div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button variant="primary"  :href="route('clinicas.create')">{{ __('Add New') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Color</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nif</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Direccion</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Telefono</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Email</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Imagen</th>

                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($clinicas as $clinica)
                                        <tr class="even:bg-gray-50" wire:key="{{ $clinica->id }}">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                            
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->nombre }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->color }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->nif }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->direccion }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->telefono }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->email }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $clinica->imagen }}</td>

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <a wire:navigate href="{{ route('clinicas.show', $clinica->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>
                                                <a wire:navigate href="{{ route('clinicas.edit', $clinica->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                                <button
                                                    class="text-red-600 font-bold hover:text-red-900"
                                                    type="button"
                                                    wire:click="delete({{ $clinica->id }})"
                                                    wire:confirm="Are you sure you want to delete?"
                                                >
                                                    {{ __('Delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $clinicas->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>