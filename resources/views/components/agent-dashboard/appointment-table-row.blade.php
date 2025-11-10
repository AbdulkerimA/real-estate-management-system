@props(['appointment'])

@php
    $images = json_decode($appointment->property->media->file_path, true);
    $firstImage = (is_array($images) && count($images) > 0) ? $images[0] : 'default.jpg';
   
//    dd($appointment->buyer)
@endphp

{{-- {{ 
    dd($appointment->property->details)
}} --}}

<tr class="border-b border-[#374151] hover:bg-[#12181f] hover:bg-opacity-50 transition-colors" data-status="scheduled">
    <td class="hidden apid">
        {{ $appointment->id }}
    </td>
    <td class="py-4 px-2">
        <div class="flex items-center space-x-3">
            {{-- <div class="w-10 h-10 bg-gradient-to-br from-[#3b82f6] to-[#9333ea] rounded-full flex items-center justify-center text-[#ffffff] font-bold text-sm">
                MB
            </div> --}}
            <img src="{{ asset('storage/'.$firstImage) }}" alt="" class="w-10 h-10 bg-gradient-to-br from-[#3b82f6] to-[#9333ea] rounded-full flex items-center justify-center">
            <div>
                <p class="font-semibold">{{ $appointment->buyer->name }}</p>
                <p class="text-sm text-[#9ca3af]">+{{ $appointment->buyer->phone }}</p>
            </div>
        </div>
    </td>

    <td class="py-4 px-2">
        <div class="flex items-center space-x-4">
            <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0 bg-[#1c252e]">
                {{-- <svg class="w-6 h-6 text-[#ffffff] opacity-60" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg> --}}
                <img src="{{ asset('storage/'.$firstImage) }}" alt="" class="w-full h-full rounded"/>
            </div>
            <div>
                <p class="font-semibold">{{ $appointment->property->title }}</p>
                <p class="text-sm text-[#9ca3af]">{{ $appointment->property->details->bed_rooms }} bed • 
                    {{ $appointment->property->details->bath_rooms }} bath • 
                    ETB {{ numberConverter($appointment->property->price) }}</p>
            </div>
        </div>
    </td>

    <td class="py-4 px-2">
        <p class="font-medium">
            {{-- Today, Dec 28 --}} 
            {{ $appointment->scheduled_date }}
        </p>

        <p class="text-sm text-[#9ca3af]">
            {{-- 2:00 PM - 3:00 PM --}}
            {{ $appointment->scheduled_time}}
        </p>
    </td>

    <td class="py-4 px-2">
        <span class="{{ 'status-'.$appointment->status }} px-4 py-2 rounded-full text-sm font-semibold">
            {{ $appointment->status }}
        </span>
    </td>

    <td class="py-4 px-2">
        <div class="flex space-x-3">
            <button
                onclick="showDetails({{ $appointment->id }})"
                class="text-[#60a5fa] hover:text-[#93c5fd] font-medium appointment-action" data-action="view">
                View
            </button>
            @if ($appointment->status == 'pending')
                <button 
                    type="submit"
                    form="confirm-form"
                    class="text-[#22c55e] hover:text-[#22c55e] font-medium appointment-action" data-action="confirm">
                    Confirm
                </button>
                <button
                    type="submit"
                    form="cancel-form"
                    class="text-[#f87171] hover:text-[#fca5a5] font-medium appointment-action" data-action="cancel">
                    Cancel
                </button>   
            @elseif ($appointment->status == 'confirmed')
                <button
                    type="submit"
                    form="cancel-form"
                    class="text-[#f87171] hover:text-[#fca5a5] font-medium appointment-action" data-action="cancel">
                    Cancel
                </button>
            @else
                
            @endif
        </div>
    </td>
</tr>

<form action="/dashboard/appointment/{{ $appointment->id }}" method="POST" id="confirm-form">
    @csrf
    @method('PUT')
    <input type="text" name="status" value="confirmed">
</form>

<form action="/dashboard/appointment/{{ $appointment->id }}" method="post" id="cancel-form">
    @csrf
    @method('PUT')
    <input type="text" name="status" value="cancelled">
</form>

<script>
    
</script>