<section class="w-full bg-gradient-to-b from-purple-50 to-white">
    <x-page-header title="Gastos" subtitle="Detalles del Gasto" color="purple">
        <svg class="w-8 h-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
            <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd" />
            <path d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z" />
        </svg>
    </x-page-header>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow-lg rounded-xl border border-purple-100">
                <!-- Header con icono y botón -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm4.75 11.25a.75.75 0 001.5 0v-2.546l.943 1.048a.75.75 0 101.114-1.004l-2.25-2.5a.75.75 0 00-1.114 0l-2.25 2.5a.75.75 0 101.114 1.004l.943-1.048v2.546z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Detalles del Gasto</h3>
                    </div>
                    <flux:button variant="primary" :href="route('gastos.index')" class="flex items-center space-x-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ __('Volver') }}</span>
                    </flux:button>
                </div>

                <!-- Tarjeta con detalles del gasto -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-lg shadow-inner">
                    <div class="divide-y divide-purple-100">
                        <!-- Descripción -->
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 flex items-center">
                            <dt class="text-sm font-medium text-purple-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                </svg>
                                Descripción
                            </dt>
                            <dd class="mt-1 text-sm text-gray-800 sm:col-span-2 sm:mt-0 bg-white p-3 rounded-md shadow-sm">{{ $gasto->descripcion }}</dd>
                        </div>

                        <!-- Monto -->
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 flex items-center">
                            <dt class="text-sm font-medium text-purple-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.75 10.818v2.614A3.13 3.13 0 0011.888 13c.482-.315.612-.648.612-.875 0-.227-.13-.56-.612-.875a3.13 3.13 0 00-1.138-.432zM8.33 8.62c.053.055.115.11.184.164.208.16.46.284.736.363V6.603a2.45 2.45 0 00-.35.16c-.14.065-.27.143-.386.233-.377.292-.514.627-.514.909 0 .184.058.39.202.592.037.051.08.102.128.152z" />
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-6a.75.75 0 01.75.75v.316a3.78 3.78 0 011.653.713c.426.33.744.74.925 1.2a.75.75 0 01-1.395.55 1.35 1.35 0 00-.447-.563 2.187 2.187 0 00-.736-.363V9.3c.698.093 1.383.32 1.959.696.787.514 1.29 1.27 1.29 2.13 0 .86-.504 1.616-1.29 2.13-.576.377-1.261.603-1.96.696v.299a.75.75 0 11-1.5 0v-.3c-.697-.092-1.382-.318-1.958-.695-.482-.315-.857-.717-1.078-1.188a.75.75 0 111.359-.636c.08.173.245.376.54.569.313.205.706.353 1.138.432v-2.748a3.782 3.782 0 01-1.653-.713C6.9 9.433 6.5 8.681 6.5 7.875c0-.805.4-1.558 1.097-2.096a3.78 3.78 0 011.653-.713V4.75A.75.75 0 0110 4z" clip-rule="evenodd" />
                                </svg>
                                Monto
                            </dt>
                            <dd class="mt-1 text-sm text-gray-800 sm:col-span-2 sm:mt-0 bg-white p-3 rounded-md shadow-sm font-medium text-purple-600">{{ $gasto->monto }}</dd>
                        </div>

                        <!-- Fecha -->
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 flex items-center">
                            <dt class="text-sm font-medium text-purple-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                </svg>
                                Fecha
                            </dt>
                            <dd class="mt-1 text-sm text-gray-800 sm:col-span-2 sm:mt-0 bg-white p-3 rounded-md shadow-sm">{{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}</dd>
                        </div>

                        <!-- Método de Pago -->
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 flex items-center">
                            <dt class="text-sm font-medium text-purple-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 001 5.5v1.375a.75.75 0 000 1.5v1.375a.75.75 0 000 1.5V14.5A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-4.625a.75.75 0 000-1.5v-1.375a.75.75 0 000-1.5V5.5A1.5 1.5 0 0017.5 4h-15zm5.25 6.5a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z" clip-rule="evenodd" />
                                </svg>
                                Método de Pago
                            </dt>
                            <dd class="mt-1 text-sm text-gray-800 sm:col-span-2 sm:mt-0 bg-white p-3 rounded-md shadow-sm">{{ $gasto->metodo_pago }}</dd>
                        </div>



                        <!-- Usuario ID -->
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 flex items-center">
                            <dt class="text-sm font-medium text-purple-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                                </svg>
                                Usuario
                            </dt>
                            <dd class="mt-1 text-sm text-gray-800 sm:col-span-2 sm:mt-0 bg-white p-3 rounded-md shadow-sm">{{ $gasto->usuario?->name ?? 'Sin usuario' }}</dd>
                        </div>

                        <!-- Tipo de Gasto -->
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 flex items-center">
                            <dt class="text-sm font-medium text-purple-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 4.75A.75.75 0 016.75 4h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 4.75zM6 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 10zm0 5.25a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75a.75.75 0 01-.75-.75zM1.99 4.75a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1v-.01zM1.99 15.25a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1v-.01zM1.99 10a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1V10z" clip-rule="evenodd" />
                                </svg>
                                Tipo de Gasto
                            </dt>
                            <dd class="mt-1 text-sm text-gray-800 sm:col-span-2 sm:mt-0 bg-white p-3 rounded-md shadow-sm">{{ $gasto->tipoGasto->nombre }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
