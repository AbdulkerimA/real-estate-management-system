@props(['themeColor'=>'green','statusNum','title'])

@php
    // Map theme colors to Tailwind-safe classes
    $colors = [
        'green' => ['text' => 'text-green-400', 'bg' => 'bg-green-400/30'],
        'blue' => ['text' => 'text-blue-400', 'bg' => 'bg-blue-400/30'],
        'red' => ['text' => 'text-red-400', 'bg' => 'bg-red-400/30'],
        'yellow' => ['text' => 'text-yellow-400', 'bg' => 'bg-yellow-400/30'],
        'purple' => ['text' => 'text-purple-400', 'bg' => 'bg-purple-400/30'],
        'emerald' => ['text' => 'text-emerald-400', 'bg' => 'bg-emerald-400/30'],
    ];

    // fallback if invalid color
    $color = $colors[$themeColor] ?? $colors['green'];
@endphp

@vite(['resources/js/admin-js/status-card.js'])

<div class="stat-card rounded-2xl p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-400 text-sm">
                {{ $title }}
            </p>

            <p class="text-3xl font-bold text-{{ $themeColor }}-400 counter" data-target="{{ $statusNum }}">
                0
            </p>
            <p class="text-{{ $themeColor }}-400 text-sm">{{$subtitle}}</p>
        </div>
        <div class="w-12 h-12 {{ $color['bg'] }} rounded-xl flex items-center justify-center">
            {{$slot}}
        </div>
    </div>
</div>
