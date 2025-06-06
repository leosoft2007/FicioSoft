@props([
    'name',
    'options' => [],
    'label' => null,
    'variant' => 'primary', // 'primary', 'secondary', 'success'
    'inline' => false,
    'selected' => null,
])

@php
    $variants = [
        'primary' => [
            'ring' => 'focus:ring-blue-500',
            'border' => 'border-blue-400 peer-checked:border-blue-500',
            'bg' => 'peer-checked:bg-blue-50',
            'dot' => 'peer-checked:bg-blue-600 peer-checked:border-blue-600',
        ],
        'secondary' => [
            'ring' => 'focus:ring-purple-500',
            'border' => 'border-purple-400 peer-checked:border-purple-500',
            'bg' => 'peer-checked:bg-purple-50',
            'dot' => 'peer-checked:bg-purple-600 peer-checked:border-purple-600',
        ],
        'success' => [
            'ring' => 'focus:ring-green-500',
            'border' => 'border-green-400 peer-checked:border-green-500',
            'bg' => 'peer-checked:bg-green-50',
            'dot' => 'peer-checked:bg-green-600 peer-checked:border-green-600',
        ],
    ];
    $v = $variants[$variant] ?? $variants['primary'];
@endphp

<div class="radio-group">
    @if($label)
        <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif

    <div class="flex {{ $inline ? 'flex-row flex-wrap gap-3' : 'flex-col gap-2' }} w-full">
        @foreach($options as $idx => $option)
            @php
                $radioId = $name . '-' . $option['value'];
                $isChecked = old($name, $selected ?? '') == $option['value'];
            @endphp
            <label for="{{ $radioId }}" class="flex-1 cursor-pointer">
                <div class="flex items-center p-4 border rounded-lg transition-all duration-200 shadow-sm
                    bg-white dark:bg-gray-800
                    {{ $v['border'] }} {{ $v['bg'] }} hover:shadow-md
                    ">
                    <input
                        id="{{ $radioId }}"
                        type="radio"
                        name="{{ $name }}"
                        value="{{ $option['value'] }}"
                        wire:model="{{ $attributes->wire('model')->value() }}"
                        @checked($isChecked)
                        class="peer hidden"
                    >
                    <span class="w-5 h-5 mr-3 flex items-center justify-center border rounded-full
                        border-gray-400 bg-white {{ $v['dot'] }} transition">
                        <span class="w-2.5 h-2.5 rounded-full bg-transparent peer-checked:bg-current transition"></span>
                    </span>
                    @if(isset($option['icon']))
                        <span class="mr-3 text-gray-500 dark:text-gray-400">
                            {!! $option['icon'] !!}
                        </span>
                    @endif
                    <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                        {{ $option['label'] }}
                    </span>
                    @if(isset($option['description']))
                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                            {{ $option['description'] }}
                        </span>
                    @endif
                </div>
            </label>
        @endforeach
    </div>
</div>
