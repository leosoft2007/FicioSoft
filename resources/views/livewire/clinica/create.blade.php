<section class="w-full">
    <x-page-header 
title="{{ __('Clinicas') }}"
subtitle="Añadir nueva {{ __('Clinica') }}"
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
                            <flux:button variant="primary"  :href="route('clinicas.index')">{{ __('Back') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data">
                                    @csrf
                                    @include('livewire.clinica.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>