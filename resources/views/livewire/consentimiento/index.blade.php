<section class="w-full">


    <x-page-header
    title="{{ __('Consentimientos') }}"
    subtitle="Lista de  {{ __('Consentimientos') }}"
    color="pink"
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
                            <flux:button variant="primary"  :href="route('consentimientos.create')">{{ __('Add New') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>

									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Titulo</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Contenido</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo</th>

                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($consentimientos as $consentimiento)
                                        <tr class="even:bg-gray-50" wire:key="{{ $consentimiento->id }}">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>

										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $consentimiento->titulo }}</td>

                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 overflow-hidden text-ellipsis max-w-[250px]">{{ $consentimiento->contenido }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $consentimiento->tipo }}</td>

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <flux:button wire:navigate href="{{ route('consentimientos.show', $consentimiento->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</flux:button>
                                                <flux:button wire:navigate href="{{ route('consentimientos.edit', $consentimiento->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</flux:button>
                                                <flux:button variant="danger"
                                                    class="text-red-600 font-bold hover:text-red-900"
                                                    type="button"
                                                    wire:click="delete({{ $consentimiento->id }})"
                                                    wire:confirm="Are you sure you want to delete?"
                                                >
                                                    {{ __('Delete') }}
                                                </flux:button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $consentimientos->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
