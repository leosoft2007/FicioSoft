<section class="w-full bg-gradient-to-b from-purple-50 to-white">
    <x-page-header title="Gestión de Gastos" subtitle="Editar gasto" color="purple">
        <svg class="w-8 h-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
            <path fill-rule="evenodd"
                d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                clip-rule="evenodd" />
            <path
                d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z" />
        </svg>
    </x-page-header>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow-lg rounded-xl border border-purple-100">
                <!-- Header con icono y botón -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                            <path
                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Editar Gasto</h3>
                    </div>
                    <flux:button variant="primary" :href="route('gastos.index')" class="flex items-center space-x-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ __('Volver') }}</span>
                    </flux:button>
                </div>

                <!-- Tarjeta del formulario con degradado -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-lg shadow-inner">
                    <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data"
                        class="space-y-6">
                        {{ method_field('PATCH') }}
                        @csrf

                        <!-- Sección del formulario -->
                        <div class="space-y-4">
                            @include('livewire.gasto.form')
                        </div>

                       

                    </form>
                </div>
            </div>

            <!-- Gráfico de ejemplo (puedes reemplazar con tu propio gráfico) -->
            <div class="p-6 bg-white rounded-xl shadow-lg border border-purple-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-purple-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M15.5 2A1.5 1.5 0 0014 3.5v13a1.5 1.5 0 001.5 1.5h1a1.5 1.5 0 001.5-1.5v-13A1.5 1.5 0 0016.5 2h-1zM9.5 6A1.5 1.5 0 008 7.5v9A1.5 1.5 0 009.5 18h1a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0010.5 6h-1zM3.5 10A1.5 1.5 0 002 11.5v5A1.5 1.5 0 003.5 18h1A1.5 1.5 0 006 16.5v-5A1.5 1.5 0 004.5 10h-1z" />
                    </svg>
                    Historial de Gastos (Ejemplo)
                </h3>
                <div
                    class="h-64 bg-gradient-to-b from-purple-50 to-white rounded-lg flex items-center justify-center text-gray-400">
                    [Aquí iría un gráfico de gastos]
                </div>
            </div>
        </div>
    </div>
</section>
