<!-- Botones de filtro por profesional -->
<div class="w-full px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex justify-center items-center space-x-2 overflow-x-auto pt-2 pb-2">
    <!-- Botón "Mostrar todos" -->
    <button 
        type="button"
        wire:click="filtrarPorProfesional(null)"
        class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center text-gray-800 font-medium text-sm"
        title="Mostrar todas las citas">
        T
    </button>

    <!-- Botones por profesional -->
    @foreach($profesionales as $profesional)
        @php
            // Obtener iniciales del nombre y apellido
            $iniciales = substr($profesional->nombre, 0, 1) . substr($profesional->apellido ?? '', 0, 1);
        @endphp

        <button 
            type="button"
            wire:click="filtrarPorProfesional({{ $profesional->id }})"
            class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center text-white font-medium text-sm
        {{ $profesional->id == $profesionalSeleccionado ? 'ring-2 ring-offset-2 ring-blue-500' : '' }}"
            style="background-color: {{ $profesional->color }};"
            title="Filtrar por {{ $profesional->nombre }}">
            {{ $iniciales }}
        </button>
    @endforeach
</div>
</div>