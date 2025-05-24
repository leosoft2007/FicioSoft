<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-lg overflow-hidden border border-purple-100']) }}>
    <!-- Encabezado con mes -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-4 text-center">
        <h2 class="text-xl md:text-2xl font-bold text-white uppercase tracking-wider">{{ $fecha->format('F Y') }}</h2>
    </div>

    <!-- Cuerpo de la tarjeta -->
    <div class="p-4 md:p-6">
        <!-- Día de la semana grande -->
        <div class="text-center mb-4 md:mb-6">
            <span class="text-3xl md:text-5xl font-extrabold text-purple-900">{{ $fecha->translatedFormat('l') }}</span>
        </div>

        <!-- Fecha circular -->
        <div class="relative flex justify-center mb-4 md:mb-6">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-purple-300 bg-gradient-to-br from-purple-100 to-indigo-100 flex flex-col items-center justify-center shadow-inner">
                <span class="text-2xl md:text-4xl font-bold text-purple-800">{{ $fecha->format('d') }}</span>
                <span class="text-xs md:text-sm uppercase text-purple-600 mt-1">{{ $fecha->translatedFormat('M') }}</span>
            </div>

            <!-- Decoración esquinas -->
            <div class="absolute -top-2 -left-2 w-6 h-6 md:w-8 md:h-8 border-t-4 border-l-4 border-purple-400 rounded-tl-lg"></div>
            <div class="absolute -top-2 -right-2 w-6 h-6 md:w-8 md:h-8 border-t-4 border-r-4 border-purple-400 rounded-tr-lg"></div>
            <div class="absolute -bottom-2 -left-2 w-6 h-6 md:w-8 md:h-8 border-b-4 border-l-4 border-purple-400 rounded-bl-lg"></div>
            <div class="absolute -bottom-2 -right-2 w-6 h-6 md:w-8 md:h-8 border-b-4 border-r-4 border-purple-400 rounded-br-lg"></div>
        </div>

        <!-- Detalles adicionales -->
        <div class="grid grid-cols-3 gap-2 md:gap-4 text-center text-xs md:text-sm">
            <div class="bg-purple-50 p-2 rounded-lg">
                <div class="text-purple-500 uppercase">Día</div>
                <div class="font-semibold text-purple-800">{{ $fecha->format('jS') }}</div>
            </div>
            <div class="bg-purple-50 p-2 rounded-lg">
                <div class="text-purple-500 uppercase">Semana</div>
                <div class="font-semibold text-purple-800">#{{ $fecha->weekOfYear }}</div>
            </div>
            <div class="bg-purple-50 p-2 rounded-lg">
                <div class="text-purple-500 uppercase">Año</div>
                <div class="font-semibold text-purple-800">{{ $fecha->format('Y') }}</div>
            </div>
        </div>
    </div>

    <!-- Pie de tarjeta con hora -->
    <div class="bg-gray-50 px-4 py-2 md:py-3 text-center border-t border-purple-100">
        <span class="text-xs md:text-sm font-medium text-purple-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
            </svg>
            {{ $fecha->format('h:i A') }}
        </span>
    </div>
</div>
