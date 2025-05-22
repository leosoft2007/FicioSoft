<!-- filepath: resources/views/livewire/card/card-profesionales-activos.blade.php -->
<div class="bg-white shadow rounded-lg overflow-hidden h-full flex flex-col">
    <div class="flex-1 px-4 py-5 sm:p-6 flex items-center">
        <div class="rounded-full bg-yellow-100 p-3 mr-4">
            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-900">Profesionales Activos</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ $profesionalesActivos }}</p>
            <p class="text-sm text-gray-500">{{ $profesionalesDisponibles }} disponibles hoy</p>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <a href="{{ route('profesionals.index') }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-500">
            Ver equipo médico
        </a>
    </div>
</div>
