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

                        <!-- Nuevo campo para el color -->
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Color de identificación
                            </label>

                            <div class="flex items-center space-x-4">
                                <!-- Selector de color -->
                                <input
                                    type="color"
                                    wire:model="form.color"
                                    class="h-10 w-10 rounded cursor-pointer border border-gray-300"
                                    value="{{ $form->color ?? '#3b82f6' }}"
                                >

                                <!-- Input de texto para el código HEX -->
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500"></span>
                                    </div>
                                    <input
                                        type="text"
                                        wire:model="form.color"
                                        placeholder="Ej: 3b82f6"
                                        class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        maxlength="6"

                                    >
                                </div>

                                <!-- Muestra de color actual -->
                                <div
                                    class="h-10 w-16 rounded border border-gray-300"
                                    style="background-color: {{ $form->color ?? '#3b82f6' }}"
                                ></div>
                            </div>

                            <p class="mt-1 text-sm text-gray-500">
                                Selecciona un color que identifique a este profesional en el calendario.
                            </p>
                            @error('form.color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
