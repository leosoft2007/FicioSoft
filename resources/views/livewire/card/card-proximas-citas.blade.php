<!-- filepath: resources/views/livewire/card/card-proximas-citas.blade.php -->
<div class="bg-white shadow rounded-lg overflow-hidden h-full flex flex-col">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Próximas Citas</h3>
    </div>

    <div class="flex-1 px-4 py-5 sm:p-6">
        <!-- Contenedor responsivo -->
        <div class="overflow-x-auto rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- ...tu tabla aquí... -->
            </table>
        </div>
    </div>

    <!-- Footer con info y enlace -->
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Mostrando <span class="font-medium">{{ $proximasCitas->count() }}</span> de <span class="font-medium">{{ $totalProximasCitas }}</span> próximas citas
            </div>
            <a href="{{ route('agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                Ver todas las citas →
            </a>
        </div>
    </div>
</div>
