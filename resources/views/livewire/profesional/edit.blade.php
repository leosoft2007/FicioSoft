<section class="w-full">
    <x-page-header
        title="{{ __('Editar Profesional') }}"
        subtitle="Actualizar los datos del profesional"
        color="blue"
    />

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <!-- Encabezado con botón de volver -->
                <div class="px-6 py-5 bg-indigo-600 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-white">
                        {{ $form->nombre }} {{ $form->apellido }}
                    </h3>
                    <flux:button
                        color="white"
                        variant="outline"
                        :href="route('profesionals.index')"
                        class="flex items-center"
                    >
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver al listado
                    </flux:button>
                </div>

                <!-- Formulario -->
                <div class="px-6 py-8">
                    <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data" class="space-y-6">
                        {{ method_field('PATCH') }}
                        @csrf

                        <!-- Campos existentes del formulario -->
                        @include('livewire.profesional.form')

                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
