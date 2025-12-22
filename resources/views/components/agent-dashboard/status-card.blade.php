@props(['themeColor','statusNum','notifier','currency'=>''])

@vite(['resources/js/agents/status-card'])

<div class="stat-card rounded-2xl p-6">

    <div class="flex items-center justify-between mb-4">
    
        <div class="w-14 h-14 bg-{{ $themeColor }}-400/20 rounded-2xl flex items-center justify-center">
            {{ $slot }}
        </div>
    
        <span class="text-xs text-{{ $themeColor }}-400 bg-{{ $themeColor }}-400/20 px-3 py-1 rounded-full font-semibold">
            {{ $notifier }}
        </span>
        
    </div>
    
    <h3 class="text-3xl font-bold text-{{ $themeColor }}-400 mb-2">
        {{ 
             Number::format($statusNum)
        }}
        {{ $currency }}
    </h3>
    
    <p class="text-gray-400">
        {{ $statusText }}
    </p>
</div>