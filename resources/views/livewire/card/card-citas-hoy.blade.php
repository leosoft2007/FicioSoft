<!-- filepath: resources/views/livewire/card/card-citas-hoy.blade.php -->
<div class="bg-white shadow rounded-lg overflow-hidden h-full flex flex-col">
    <div class="flex-1 px-4 py-5 sm:p-6 flex items-center">
        <div class="rounded-full bg-blue-100 p-3 mr-4">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-900">Citas Hoy</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ $citasHoy }}</p>
            <p class="text-sm text-gray-500">{{ $citasConfirmadasHoy }} confirmadas</p>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <a href="{{ route('agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
            Ver todas las citas
        </a>
    </div>
</div>
