@props(['title'=>'','subtitle'=>'','status'=>'checked'])

<div class="notification-item">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-white font-medium">{{ $title }}</p>
            <p class="text-gray-400 text-sm">{{ $subtitle }}</p>
        </div>
        <label class="toggle-switch">
            <input type="checkbox" {{ $status }}>
            <span class="toggle-slider"></span>
        </label>
    </div>
</div>