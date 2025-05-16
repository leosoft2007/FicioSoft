<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FisioSistem</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net ">
    <link href="https://fonts.bunny.net/css?family=inter :400,500,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN (si no lo tienes en local) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">FisioSistem</h1>

            <nav class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                        Registrar
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Hero Section -->
    <main class="flex flex-col items-center justify-center min-h-screen px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 text-gray-900">
            Bienvenido a <span class="text-blue-600">FisioSistem</span>
        </h2>
        <p class="text-lg text-gray-600 max-w-xl mx-auto mb-8">
            Sistema integral para gestión de clínicas de fisioterapia. Administra tus citas, pacientes, servicios y facturación desde una sola plataforma.
        </p>

        <div class="flex flex-wrap justify-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                        Ir al Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-blue-600 font-semibold border border-blue-600 rounded-lg shadow hover:bg-blue-50 transition">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                        Regístrate Gratis
                    </a>
                @endauth
            @endif
        </div>
    </main>

    <!-- Footer (opcional) -->
    <footer class="bg-white py-6 border-t border-gray-200 text-center text-sm text-gray-500">
        &copy; {{ now()->year }} FisioSistem. Todos los derechos reservados.
    </footer>

</body>
</html>
