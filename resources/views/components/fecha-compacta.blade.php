<div {{ $attributes->merge(['class' => 'w-40 h-48 rounded-xl shadow-lg overflow-hidden relative transition-all hover:scale-105 duration-300']) }}>
    <div class="{{ $bgColor }} h-full flex flex-col">
        <!-- Día de la semana en la parte superior -->
        <div class="pt-3 text-center">
            <span class="text-white font-bold text-sm uppercase tracking-wider">{{ $fecha->translatedFormat('l') }}</span>
        </div>

        <!-- Número de día grande en el centro -->
        <div class="flex-grow flex items-center justify-center">
            <div class="w-20 h-20 rounded-full bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center shadow-inner">
                <span class="text-4xl font-bold text-gray-400">{{ $fecha->format('d') }}</span>
            </div>
        </div>

        <!-- Mes y hora en la parte inferior -->
        <div class="pb-3 text-center">
            <div class="text-white font-medium text-xs uppercase mb-1">{{ $fecha->translatedFormat('M') }}</div>
            <div class="text-white text-xs flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                {{ $fecha->format('h:i A') }}
            </div>
        </div>

        <!-- Detalle decorativo -->

    </div>
</div>
