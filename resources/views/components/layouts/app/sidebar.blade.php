{{-- filepath: resources/views/components/layouts/app/sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    @stack('styles')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        {{-- Plataforma --}}
        @include('components.layouts.app.sidebar._nav_platform')

        {{-- Facturación --}}
        @include('components.layouts.app.sidebar._nav_facturacion')

        {{-- Agenda --}}
        <flux:menu.item icon="document-text" :href="route('grupo')" :current="request()->routeIs('grupo')" wire:navigate>
            {{ __('Agenda') }}
        </flux:menu.item>

        {{-- Administración (solo para administradores) --}}
        @role('Administrador')
            @include('components.layouts.app.sidebar._nav_admin')
        @endrole

        <flux:spacer/>

        {{-- Menú de usuario --}}
        @include('components.layouts.app.sidebar._user_menu')

        <div class="flex justify-center my-4">
            <x-fecha-compacta />
        </div>
    </flux:sidebar>

    {{-- Menú móvil --}}

    @include('components.layouts.app.sidebar._movil')

    {{ $slot }}
    @fluxScripts
    @stack('scripts')
</body>
</html>
