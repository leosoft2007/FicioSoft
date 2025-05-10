@php
    // Definición de esquemas de color
    $colorClasses = [
        'blue' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-200',
            'text' => 'text-blue-900',
            'hover' => 'hover:bg-blue-100',
            'dark' => [
                'bg' => 'dark:bg-blue-900/20',
                'border' => 'dark:border-blue-800',
                'text' => 'dark:text-blue-100'
            ]
        ],
        'orange' => [
    'bg' => 'bg-orange-50',
    'border' => 'border-orange-200',
    'text' => 'text-orange-900',
    'hover' => 'hover:bg-orange-100',
    'dark' => [
        'bg' => 'dark:bg-orange-900/20',
        'border' => 'dark:border-orange-800',
        'text' => 'dark:text-orange-100'
    ]
],
        'red' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-200',
            'text' => 'text-red-900',
            'hover' => 'hover:bg-red-100',
            'dark' => [
                'bg' => 'dark:bg-red-900/20',
                'border' => 'dark:border-red-800',
                'text' => 'dark:text-red-100'
            ]
        ],
        'gray' => [
            'bg' => 'bg-gray-50',
            'border' => 'border-gray-200',
            'text' => 'text-gray-900',
            'hover' => 'hover:bg-gray-100',
            'dark' => [
                'bg' => 'dark:bg-gray-900/20',
                'border' => 'dark:border-gray-800',
                'text' => 'dark:text-gray-100'
            ]
        ],
        'indigo' => [
            'bg' => 'bg-indigo-50',
            'border' => 'border-indigo-200',
            'text' => 'text-indigo-900',
            'hover' => 'hover:bg-indigo-100',
            'dark' => [
                'bg' => 'dark:bg-indigo-900/20',
                'border' => 'dark:border-indigo-800',
                'text' => 'dark:text-indigo-100'
            ]
        ],
        'teal' => [
            'bg' => 'bg-teal-50',
            'border' => 'border-teal-200',
            'text' => 'text-teal-900',
            'hover' => 'hover:bg-teal-100',
            'dark' => [
                'bg' => 'dark:bg-teal-900/20',
                'border' => 'dark:border-teal-800',
                'text' => 'dark:text-teal-100'
            ]
        ],
        'lime' => [
            'bg' => 'bg-lime-50',
            'border' => 'border-lime-200',
            'text' => 'text-lime-900',
            'hover' => 'hover:bg-lime-100',
            'dark' => [
                'bg' => 'dark:bg-lime-900/20',
                'border' => 'dark:border-lime-800',
                'text' => 'dark:text-lime-100'
            ]
        ],
        'emerald' => [
            'bg' => 'bg-emerald-50',
            'border' => 'border-emerald-200',
            'text' => 'text-emerald-900',
            'hover' => 'hover:bg-emerald-100',
            'dark' => [
                'bg' => 'dark:bg-emerald-900/20',
                'border' => 'dark:border-emerald-800',
                'text' => 'dark:text-emerald-100'
            ]
        ],
        'cyan' => [
            'bg' => 'bg-cyan-50',
            'border' => 'border-cyan-200',
            'text' => 'text-cyan-900',
            'hover' => 'hover:bg-cyan-100',
            'dark' => [
                'bg' => 'dark:bg-cyan-900/20',
                'border' => 'dark:border-cyan-800',
                'text' => 'dark:text-cyan-100'
            ]
        ],
        'green' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-200',
            'text' => 'text-green-900',
            'hover' => 'hover:bg-green-100',
            'dark' => [
                'bg' => 'dark:bg-green-900/20',
                'border' => 'dark:border-green-800',
                'text' => 'dark:text-green-100'
            ]
        ],
        'pink' => [
            'bg' => 'bg-pink-50',
            'border' => 'border-pink-200',
            'text' => 'text-pink-900',
            'hover' => 'hover:bg-pink-100',
            'dark' => [
                'bg' => 'dark:bg-pink-900/20',
                'border' => 'dark:border-pink-800',
                'text' => 'dark:text-pink-100'
            ]
        ],
        'yellow' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-200',
            'text' => 'text-yellow-900',
            'hover' => 'hover:bg-yellow-100',
            'dark' => [
                'bg' => 'dark:bg-yellow-900/20',
                'border' => 'dark:border-yellow-800',
                'text' => 'dark:text-yellow-100'
            ]
        ],
        'purple' => [
            'bg' => 'bg-purple-50',
            'border' => 'border-purple-200',
            'text' => 'text-purple-900',
            'hover' => 'hover:bg-purple-100',
            'dark' => [
                'bg' => 'dark:bg-purple-900/20',
                'border' => 'dark:border-purple-800',
                'text' => 'dark:text-purple-100'
            ]
        ],
    ];

    // Valores por defecto para variables opcionales
    $color = $color ?? 'blue';
    $clickable = $clickable ?? false;
    $clickAction = $clickAction ?? '';
    $badge = $badge ?? null;
    $icon = $icon ?? null;
    $footer = $footer ?? null;
    $subtitle = $subtitle ?? null;
    
    $selectedColor = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div 
    class="border rounded-2xl shadow-md p-6 mb-6 transition-all duration-200 ease-in-out 
           {{ $selectedColor['bg'] }} {{ $selectedColor['border'] }} {{ $selectedColor['text'] }} 
           @if($clickable) {{ $selectedColor['hover'] }} cursor-pointer @endif
           {{ $selectedColor['dark']['bg'] }} {{ $selectedColor['dark']['border'] }} {{ $selectedColor['dark']['text'] }}"
    @if($clickable) onclick="{{ $clickAction }}" @endif
>
    <div class="relative w-full">
        <div class="flex justify-between items-start">
            <div>
                <flux:heading size="xl" level="1" class="mb-2">{{ $title }}</flux:heading>
                @if($subtitle)
                    <flux:subheading size="lg" class="mb-4 text-opacity-80">{{ $subtitle }}</flux:subheading>
                @endif
            </div>
            
            @if($badge)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                            {{ $selectedColor['bg'] }} {{ $selectedColor['text'] }}">
                    {{ $badge }}
                </span>
            @endif
            
            @if($icon)
                <div class="p-2 rounded-lg {{ $selectedColor['bg'] }} opacity-80">
                    <x-icon name="{{ $icon }}" class="w-5 h-5 {{ $selectedColor['text'] }}" />
                </div>
            @endif
        </div>
        
        <flux:separator variant="subtle" class="my-4" />
        
        @if(isset($slot) && trim($slot))
            <div class="mt-4 {{ $selectedColor['text'] }} opacity-90">
                {{ $slot }}
            </div>
        @endif
        
        @if($footer)
            <div class="mt-6 pt-4 border-t {{ $selectedColor['border'] }} opacity-50">
                <p class="text-sm {{ $selectedColor['text'] }}">{{ $footer }}</p>
            </div>
        @endif
    </div>
</div>