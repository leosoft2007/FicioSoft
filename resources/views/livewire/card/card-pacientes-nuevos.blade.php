<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:p-6 flex items-center">
        <div class="rounded-full bg-purple-100 p-3 mr-4">
            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-900">Pacientes Nuevos</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ $pacientesNuevosMes }}</p>
            <p class="text-sm text-gray-500">Total: {{ $totalPacientes }} pacientes</p>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <a href="{{ route('pacientes.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500">
            Gestionar pacientes
        </a>
    </div>
</div>
