<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="flex min-h-screen items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-md rounded-2xl border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-lg p-8 space-y-6">
            <!-- Logo / Nombre -->
            <div class="text-center">
                <a href="{{ route('home') }}" wire:navigate>
                    <span class="inline-block bg-pink-100 dark:bg-pink-800 text-pink-900 dark:text-white px-4 py-2 rounded-xl text-2xl font-bold">
                        FisioSistem
                    </span>
                </a>
            </div>

            <!-- Slot de contenido del login -->
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>
</html>
