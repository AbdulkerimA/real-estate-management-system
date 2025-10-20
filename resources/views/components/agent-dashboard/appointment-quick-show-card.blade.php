@props(['action'=>'view details', 'status'=>'Scheduled','appointment'=>[],])



<div class="appointment-card rounded-xl p-6 border-l-4" style="border-color: #00ff88;">
    <div class="flex items-center justify-between mb-4">
        <span class="{{$status != 'Pending' ?'status-scheduled':'status-pending' }} px-3 py-1 rounded-full text-xs font-semibold">{{ $status }}</span>
        <span class="countdown-timer text-lg font-bold">
            {{-- In {{ }} hours --}}
            {{ remainingTime($appointment->scheduled_time,$appointment->scheduled_date) }}
        </span>
    </div>

    <div class="flex items-center space-x-4 mb-4">
        <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: #1c252e;">
            {{$slot}}
        </div>
        <div>
            <p class="font-semibold">{{ $appointment->property->title }}</p>
            <p class="text-sm" style="color: #9ca3af;">Client: {{ $appointment->buyer->name }}</p>
        </div>
    </div>

    <div class="flex items-center justify-between text-sm">
        <span style="color: #9ca3af;">
            {{
                "scheduled at: ".date('M d, Y', strtotime($appointment->scheduled_date))
            }}
        </span>

        <button class="font-medium {{ $status == 'Pending' ? 'text-yellow-400 hover:text-yellow-300' : 'text-[#00ff88] hover:text-green-300' }}" 
                style="transition: color 0.2s;">
            {{ $action }}
        </button>
    </div>
</div>
