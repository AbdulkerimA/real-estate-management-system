@props(['title' => '', 'subtitle' => '', 'action' =>'' ,'status' => false])

@vite(['resources/js/toggleSwitch.js'])

<div {{ $attributes->merge(['class' => 'notification-item setting-item']) }}>
    <div class="flex items-center justify-between w-full h-full">
        <div>
            <p class="text-white font-medium">{{ $title }}</p>
            <p class="text-gray-400 text-sm">{{ $subtitle }}</p>
        </div>

        <label class="toggle-switch ">
            <input 
                type="checkbox" 
                name="{{ Str::slug($title, '_') }}" 
                {{ $status ? 'checked' : '' }}
                class="toggle-input "
                data-url="{{ $action }}"
            >
            <span class="toggle-slider slider"></span>
        </label>
    </div>
</div>
