<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
