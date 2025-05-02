@php
    $colorClasses = [
        'blue' => 'bg-blue-50 border-blue-200 text-blue-900',
        'green' => 'bg-green-50 border-green-200 text-green-900',
        'pink' => 'bg-pink-50 border-pink-200 text-pink-900',
        'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-900',
        'purple' => 'bg-purple-50 border-purple-200 text-purple-900',
    ];

    $selectedColor = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="border rounded-2xl shadow-md p-6 mb-6 {{ $selectedColor }}">
    <div class="relative w-full">
        <flux:heading size="xl" level="1">{{ $title }}</flux:heading>
        @if($subtitle)
            <flux:subheading size="lg" class="mb-6">{{ $subtitle }}</flux:subheading>
        @endif
        <flux:separator variant="subtle" />
    </div>
</div>