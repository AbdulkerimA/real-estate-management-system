@props(['action'=>'view details', 'status'=>'Scheduled'])

<div class="appointment-card rounded-xl p-6 border-l-4" style="border-color: #00ff88;">
    <div class="flex items-center justify-between mb-4">
        <span class="{{$status != 'Pending' ?'status-scheduled':'status-pending' }} px-3 py-1 rounded-full text-xs font-semibold">{{ $status }}</span>
        <span class="countdown-timer text-lg font-bold">In 2 hours</span>
    </div>

    <div class="flex items-center space-x-4 mb-4">
        <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: #1c252e;">
            {{$slot}}
        </div>
        <div>
            <p class="font-semibold">Luxury Apartment in Bole</p>
            <p class="text-sm" style="color: #9ca3af;">Client: Meron Bekele</p>
        </div>
    </div>

    <div class="flex items-center justify-between text-sm">
        <span style="color: #9ca3af;">Today, 2:00 PM</span>
        <button class="font-medium {{ $status == 'Pending' ? 'text-yellow-400 hover:text-yellow-300' : 'text-[#00ff88] hover:text-green-300' }}" 
                style="transition: color 0.2s;">
            {{ $action }}
        </button>
    </div>
</div>
