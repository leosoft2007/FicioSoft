<section class="w-full">


    <!-- mensajes de sesion -->

    <x-page-header title="{{ __('Detalles del Profesional') }}" subtitle="{{ __('Información completa') }}"
        color="blue" />

        @include('livewire.profesional.mensaje')



    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gradient-to-br from-blue-50 to-white shadow-lg sm:rounded-xl">
                <div class="w-full">
                    <div class="sm:flex sm:items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $profesional->nombre }}
                                {{ $profesional->apellido }}</h1>
                            <p class="mt-1 text-sm text-gray-600">Detalles completos del profesional</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <flux:button variant="primary" :href="route('profesionals.index')"
                                class="text-white bg-blue-600 hover:bg-blue-700">
                                <i class="fas fa-arrow-left mr-2"></i>{{ __('Volver al listado') }}
                            </flux:button>
                        </div>
                    </div>

                    <!-- Pestañas -->
                    <div class="mt-8" x-data="{ activeTab: 'datos' }">
                        <div class="relative">
                            <nav class="flex space-x-4" aria-label="Tabs">
                                <button @click="activeTab = 'datos'"
                                    :class="activeTab === 'datos' ? 'bg-pink-100 text-pink-600' :
                                        'bg-gray-100 text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-2 text-sm font-bold rounded-t-md transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-user mr-2"></i>Datos Personales
                                </button>
                                <button @click="activeTab = 'individuales'"
                                    :class="activeTab === 'individuales' ? 'bg-blue-100 text-blue-600' :
                                        'bg-gray-100 text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-2 text-sm font-bold rounded-t-md transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-calendar mr-2"></i>Citas Individuales
                                    ({{ $citasIndividuales->count() }})
                                </button>
                                <button @click="activeTab = 'grupales'"
                                    :class="activeTab === 'grupales' ? 'bg-green-100 text-green-600' :
                                        'bg-gray-100 text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-2 text-sm font-bold rounded-t-md transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-users mr-2"></i>Citas Grupales ({{ $citasGrupales->count() }})
                                </button>
                            </nav>
                        </div>

                        <!-- Contenido de las pestañas -->
                        <div>
                            <!-- Pestaña Datos Personales -->
                            @include('livewire.profesional.tab_personales')

                            <!-- Pestaña Citas Individuales -->
                            @include('livewire.profesional.tab_cita_individual')

                            <!-- Pestaña Citas Grupales -->
                            @include('livewire.profesional.tab_cita_grupal')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
