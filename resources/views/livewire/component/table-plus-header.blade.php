{{--
Encabezado de la tabla:
- Título con icono
- Botón "Nuevo" (si $addRoute está definido)
--}}



<div class="sm:flex sm:items-center mb-6">
    <div class="sm:flex-auto">
        <h3 class="text-lg font-bold text-indigo-800 flex items-center">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path
                    d="M9 17V15M12 17V13M15 17V11M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14.5858C14.851 3 15.1054 3.10536 15.2929 3.29289L18.7071 6.70711C18.8946 6.89464 19 7.149 19 7.41421V19C19 20.1046 18.1046 21 17 21Z"
                    stroke="#4F46E5" stroke-width="2" stroke-linecap="round" />
            </svg>
            {{ $title }}
        </h3>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        @isset($addRoute)
        <a href="{{ $addRoute }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-full hover:bg-indigo-700 focus:outline-none transition">
            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M12 4V20M4 12H20" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" />
            </svg>
            Nuevo
        </a>
        @endisset
    </div>
</div>
