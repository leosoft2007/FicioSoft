<div wire:poll.5s class="p-6 bg-blue-50 rounded-xl shadow-md border border-blue-200 max-w-3xl mx-auto">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-blue-700 mb-2 flex items-center">
            <svg class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.504M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Actividad de Usuarios Hoy
        </h2>
        <div class="flex gap-4">
            <div class="bg-white px-4 py-2 rounded shadow text-blue-800 font-medium">
                Total conectados hoy: {{ $usuarios->count() }}
            </div>

            <div class="bg-green-100 px-4 py-2 rounded shadow text-green-700 font-medium">
                En línea ahora: {{ $usuariosConectados }}
            </div>
        </div>
    </div>

    @forelse($usuarios as $usuario)
        <div class="flex justify-between items-center bg-white px-4 py-2 rounded-md shadow-sm mb-2 border border-gray-200">
            <div>
                <p class="text-gray-800 font-medium">{{ $usuario->name }}</p>
                <p class="text-sm text-gray-500">{{ $usuario->email }}</p>
            </div>
            <div class="text-right text-sm">
                @if(\Carbon\Carbon::parse($usuario->last_seen)->gt(now()->subMinute()))
                    <span class="text-green-600 font-semibold">● En línea</span>
                @else
                    <span class="block text-gray-400">Última conexión:</span>
                    <span class="font-mono text-gray-500">
                        {{ \Carbon\Carbon::parse($usuario->last_seen)->format('H:i:s') }}
                    </span>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center">Ningún usuario se ha conectado hoy</p>
    @endforelse

</div>
