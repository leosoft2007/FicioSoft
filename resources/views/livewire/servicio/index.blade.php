<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Servicios') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">A list of all the {{ __('Servicios') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto"></div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button variant="primary"  :href="route('servicios.create')">{{ __('Add New') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                       


									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Descripcion</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Precio</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Iva</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Estado</th>

                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($servicios as $servicio)
                                        <tr class="even:bg-gray-50" wire:key="{{ $servicio->id }}">



										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $servicio->nombre }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $servicio->descripcion }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $servicio->precio }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $servicio->iva }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $servicio->estado }}</td>

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <a wire:navigate href="{{ route('servicios.show', $servicio->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>
                                                <a wire:navigate href="{{ route('servicios.edit', $servicio->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                                <button
                                                    class="text-red-600 font-bold hover:text-red-900"
                                                    type="button"
                                                    wire:click="delete({{ $servicio->id }})"
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
                                    {!! $servicios->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
