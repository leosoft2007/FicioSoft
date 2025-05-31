<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Gestión Integral para Clínicas de Fisioterapia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN (si no lo tienes en local) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
                <h1 class="text-2xl font-bold text-blue-600">{{ config('app.name') }}</h1>
            </div>

            <nav class="hidden md:flex space-x-8">
                <a href="#features" class="text-gray-700 hover:text-blue-600 transition">Características</a>
                <a href="#benefits" class="text-gray-700 hover:text-blue-600 transition">Beneficios</a>
                <a href="#pricing" class="text-gray-700 hover:text-blue-600 transition">Precios</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600 transition">Contacto</a>
            </nav>

            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition">Iniciar
                        Sesión</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                        Registrar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-10 md:mb-0">
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 text-gray-900">
                Optimiza tu clínica con <span class="text-blue-600">{{ config('app.name') }}</span>
            </h2>
            <p class="text-lg text-gray-600 mb-8">
                La solución todo-en-uno para gestión de citas, pacientes, facturación y más. Diseñado específicamente
                para profesionales de fisioterapia.
            </p>
            <div class="flex flex-wrap gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                            Ir al Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                            Prueba Gratis 14 Días
                        </a>
                        <a href="#demo"
                            class="px-6 py-3 bg-white text-blue-600 font-semibold border border-blue-600 rounded-lg shadow hover:bg-blue-50 transition">
                            Ver Demostración
                        </a>
                    @endauth
                @endif
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                alt="Fisioterapeuta trabajando con paciente" class="rounded-lg shadow-xl border border-gray-200">
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Todo lo que necesitas en un solo sistema
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">Características diseñadas para simplificar la
                    gestión de tu clínica</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-gray-900">Gestión de Citas Inteligente</h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        Programa sesiones individuales, grupales y terapias específicas asignando automáticamente al
                        profesional más adecuado con nuestro sistema de agenda avanzado.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-gray-900">Historial de Pacientes</h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        Registra historiales médicos completos, planes de tratamiento personalizados y realiza
                        seguimiento detallado del progreso de cada paciente.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-gray-900">Gestión de Equipamiento</h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        Controla disponibilidad, mantenimiento e inventario de todos tus equipos y recursos. Programa
                        alertas para mantenimientos preventivos.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-gray-900">Marketing y Comunicación</h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        Envía boletines, gestiona contactos, automatiza recordatorios de citas y promociones. Todo
                        integrado en el sistema.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-gray-900">Gestión de Pagos</h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        Soporte para diferentes estructuras de precios, descuentos y procesos de pago. Integración con
                        pasarelas de pago populares.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-medium text-gray-900">Reportes y Análisis</h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        Evalúa la eficacia de tratamientos, productividad del equipo y rendimiento de servicios con
                        reportes personalizables.
                    </p>
                </div>
            </div>
            <div class="mt-12 max-w-3xl mx-auto">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 shadow flex items-center space-x-4">
                    <svg class="w-10 h-10 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-700 mb-1">Facturación electrónica incluida</h3>
                        <p class="text-gray-700">
                            Todos los planes incluyen módulo de facturación electrónica para tus servicios, generación de facturas en PDF, envío por email y gestión de historial de cobros. Cumple con la normativa vigente y ahorra tiempo en tu administración.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center text-gray-500">
                <p>Todos los planes incluyen prueba gratuita de 14 días sin necesidad de tarjeta de crédito.</p>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Beneficios para tu clínica</h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">Descubre cómo {{ config('app.name') }} puede transformar tu
                    práctica</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Fisioterapeuta analizando datos" class="rounded-lg shadow-lg">
                </div>
                <div>
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Reducción de tiempo administrativo</h3>
                                <p class="mt-1 text-gray-600">Automatiza procesos y reduce el papeleo en hasta un 60%.
                                </p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Mejora en la satisfacción del paciente
                                </h3>
                                <p class="mt-1 text-gray-600">Comunicación más fluida y seguimiento personalizado.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Acceso desde cualquier lugar</h3>
                                <p class="mt-1 text-gray-600">Trabaja desde la clínica, en casa o en movimiento.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Cumplimiento normativo</h3>
                                <p class="mt-1 text-gray-600">Diseñado para cumplir con regulaciones de privacidad de
                                    datos.</p>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-10 bg-white p-6 rounded-lg shadow-sm">
                        <p class="italic text-gray-600">{{ config('app.name') }} ha transformado nuestra clínica. Ahora gestionamos
                            el doble de pacientes con menos esfuerzo administrativo.</p>
                        <p class="mt-4 font-medium text-gray-900">- Dra. María González, Clínica FisioPlus</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Planes a tu medida</h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">Elige el plan que mejor se adapte a las
                    necesidades de tu clínica</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Plan Básico -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="px-6 py-8">
                        <h3 class="text-lg font-medium text-gray-900">Básico</h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-gray-900">€59</span>
                            <span class="ml-1 text-lg font-medium text-gray-600">/mes</span>
                        </div>
                        <p class="mt-2 text-gray-600">Perfecto para clínicas pequeñas</p>
                        <div class="mt-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Hasta 3 profesionales</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Gestión de hasta 100 pacientes</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Soporte por email</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-100">
                        <a href="{{ route('register') }}"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Comenzar prueba
                        </a>
                    </div>
                </div>

                <!-- Plan Profesional (Destacado) -->
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-blue-600 transform md:scale-105 z-10">
                    <div class="px-6 py-8">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Profesional</h3>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">Popular</span>
                        </div>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-gray-900">€199</span>
                            <span class="ml-1 text-lg font-medium text-gray-600">/mes</span>
                        </div>
                        <p class="mt-2 text-gray-600">Ideal para clínicas en crecimiento</p>
                        <div class="mt-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Hasta 10 profesionales</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Pacientes ilimitados</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Reportes avanzados</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Soporte prioritario</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Integración con pasarelas de pago</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-blue-600">
                        <a href="{{ route('register') }}"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-600 bg-white hover:bg-gray-100">
                            Comenzar prueba
                        </a>
                    </div>
                </div>

                <!-- Plan Empresa -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="px-6 py-8">
                        <h3 class="text-lg font-medium text-gray-900">Empresa</h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-gray-900">€349</span>
                            <span class="ml-1 text-lg font-medium text-gray-600">/mes</span>
                        </div>
                        <p class="mt-2 text-gray-600">Para grandes clínicas y cadenas</p>
                        <div class="mt-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Profesionales ilimitados</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Sucursales múltiples</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Soporte 24/7</p>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="ml-2 text-gray-600">Personalización avanzada</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-100">
                        <a href="#contact"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Contactar ventas
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center text-gray-500">
                <p>Todos los planes incluyen prueba gratuita de 14 días sin necesidad de tarjeta de crédito.</p>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section id="demo" class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-3xl font-extrabold sm:text-4xl mb-4">¿Quieres verlo en acción?</h2>
                    <p class="text-lg text-gray-300 mb-6">Agenda una demostración personalizada con nuestro equipo y
                        descubre cómo {{ config('app.name') }} puede optimizar tu clínica.</p>
                    <a href="#contact"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-blue-700 bg-white hover:bg-gray-100">
                        Solicitar demostración
                    </a>
                </div>
                <div class="md:w-1/2">
                    <div class="relative aspect-w-16 aspect-h-9 bg-gray-800 rounded-lg overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-20 w-20 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">¿Listo para transformar tu clínica?</h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 mx-auto">
                    Contáctanos para más información o una demostración personalizada
                </p>
            </div>
            <div class="flex justify-center">
                <div class="w-full max-w-lg">
                    <form action="/contact" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="tel" id="phone" name="phone"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label>
                            <textarea id="message" name="message" rows="4" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                                Enviar mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
            <div class="mt-4">
                <a href="#" class="text-gray-400 hover:text-white mx-2">Política de privacidad</a>
                <span class="text-gray-400">|</span>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Términos de servicio</a>
            </div>
        </div>
    </footer>
