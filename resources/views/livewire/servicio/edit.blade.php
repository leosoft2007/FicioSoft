<section class="w-full">
    <x-page-header
        title="Editar Servicio"
        subtitle="Actualizar los datos del servicio médico"
        color="blue"
    >
        <div class="flex items-center gap-2">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            <span class="font-medium">Editando: {{ $form->nombre }}</span>
        </div>
    </x-page-header>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Tarjeta principal -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <!-- Barra de acciones -->
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-gray-600">Complete todos los campos requeridos</span>
                    </div>
                    <div>
                        <flux:button
                            
                            :href="route('servicios.index')"
                            class="flex items-center gap-2"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al listado
                        </flux:button>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="p-6">
                    <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                                    @include('livewire.servicio.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
