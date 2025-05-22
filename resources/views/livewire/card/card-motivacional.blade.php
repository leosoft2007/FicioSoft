<!-- filepath: resources/views/livewire/card/card-motivacional.blade.php -->
<div class="bg-yellow-50 shadow rounded-lg overflow-hidden h-full flex flex-col">
    <div class="flex-1 px-4 py-5 sm:p-6 flex flex-row items-center">
        <div class="rounded-full bg-yellow-200 p-3 mr-4 animate-bounce flex-shrink-0">
            <svg class="h-8 w-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-width="2" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 15s1.5 2 4 2 4-2 4-2" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h.01M15 9h.01" />
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <h3 class="text-lg font-medium text-yellow-900">¡Frase del día!</h3>
            <p class="text-lg font-semibold text-yellow-800 italic break-words">
                "{{ $frase }}"
            </p>
        </div>
    </div>
    <div class="bg-yellow-100 px-4 py-2 flex justify-center">
        <!-- Gráfico decorativo SVG -->
        <svg class="h-6 w-32 text-yellow-300" fill="currentColor" viewBox="0 0 100 10">
            <ellipse cx="50" cy="5" rx="48" ry="4"/>
        </svg>
    </div>
</div>
