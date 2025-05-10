<section class="w-full">

    
    <x-page-header 
    title="{{ __('Show') }}"
    subtitle="{{ __('Consentimiento') }}"
    color="pink" 
    :clickable="true" 
    badge="Nuevo" 
    icon="check" 
    footer="Texto de pie" 
    wire:key="factura-filtros"
    >
    

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <p class="mt-2 text-sm text-gray-700">Details of {{ __('Consentimiento') }}</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button variant="primary"  :href="route('consentimientos.index')">{{ __('Back') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="mt-6 border-t border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="text-sm font-medium leading-6 text-gray-900">Titulo</dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $consentimiento->titulo }}</dd>
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="text-sm font-medium leading-6 text-gray-900">Contenido</dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $consentimiento->contenido }}</dd>
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="text-sm font-medium leading-6 text-gray-900">Tipo</dt>
                                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $consentimiento->tipo }}</dd>
                                        </div>

                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>