<!-- Modal cuando selecciono una cita grupal para editarla y decidir si modifiar una o el grupo -->
<div x-data="{
    show: false,
    eventData: null,
    init() {
        Livewire.on('show-grupal-modal-choice', (eventData) => {
            this.eventData = eventData;
            this.show = true;
        });
    }
}"
x-show="show"
x-transition:enter="ease-out duration-300"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="ease-in duration-200"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
style="display: none;">
    <div
        @click.away="show = false"
        class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden"
    >
        <div class="px-6 py-4 bg-indigo-600 text-white">
            <h3 class="text-lg font-semibold">Modificar cita grupal</h3>
        </div>

        <div class="p-6">
            <p class="text-gray-600 mb-6">¿Qué deseas modificar?</p>

            <div class="space-y-3">
                <button
                    @click="
                        Livewire.dispatch('openCitaGrupalModal', eventData);
                        show = false;
                    "
                    class="w-full px-4 py-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-800 rounded-md transition flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Todo el grupo de citas
                </button>

                <button
                    @click="
                        Livewire.dispatch('abrirOcurrencia', eventData);
                        show = false;
                    "
                    class="w-full px-4 py-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-800 rounded-md transition flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Solo esta día
                </button>
            </div>
        </div>

        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex justify-end">
            <button
                @click="show = false"
                class="px-4 py-2 text-gray-600 hover:text-gray-800 transition"
            >
                Cancelar
            </button>
        </div>
    </div>
</div>
