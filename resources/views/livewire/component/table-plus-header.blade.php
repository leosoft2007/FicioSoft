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
    <!-- Botones alineados a la derecha en una sola fila -->
    <div class="sm:ml-auto flex items-center space-x-2 mt-4 sm:mt-0">
        @isset($addRoute)
        <a href="{{ $addRoute }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-full hover:bg-indigo-700 focus:outline-none transition shadow"
        >
            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M12 4V20M4 12H20" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" />
            </svg>
            Nuevo
        </a>
        @endisset
        @if ($showExportExcel)
            <button
                wire:click="exportExcel"
                class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full hover:bg-green-200 focus:outline-none transition shadow"
                title="Exportar a Excel"
            >
                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 13H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 9H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Excel
            </button>
        @endif
        @if ($showExportPdf)
            <button
                wire:click="exportPdf"
                class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 text-sm font-medium rounded-full hover:bg-red-200 focus:outline-none transition shadow"
                title="Exportar a PDF"
            >
                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                PDF
            </button>
        @endif
    </div>
</div>
