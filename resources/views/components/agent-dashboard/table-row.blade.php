@props(['data'])
@php
    
    $images = json_decode($data->media->file_path);
    $firstImage = (is_array($images) && count($images) > 0) ? $images[0] : 'default.jpg';

    // dd($data->media->file_path);
@endphp
<tr 
    class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors"
    data-status="{{ $data->status }}"
    data-type="{{ $data->type ?? 'apartment' }}"
>
    {{-- Property Info --}}
    <td class="pid hidden">
        {{ $data->id }}
    </td>
    <td class="py-4 px-2">
        <div class="flex items-center space-x-4">
            <div class="property-image w-20 h-16 rounded-xl flex items-center justify-center flex-shrink-0 bg-gray-800">
                <img src="{{ asset('storage/'.$firstImage) }}" alt="{{ $data->title }}" class="rounded-xl">
            </div>
            <div>
                <p class="font-semibold text-md">{{ $data->title }}</p>
                <p class="text-sm text-gray-400">3 bed • 2 bath • 150 sqm</p>
            </div>
        </div>
    </td>

    {{-- Location --}}
    <td class="py-4 px-2">
        <p class="font-medium">{{ $data->location }}</p>
        {{-- <p class="text-sm text-gray-400">Near Bole Airport</p> --}}
    </td>

    {{-- Price --}}
    <td class="py-4 px-2">
        <span class="font-bold text-md">
            ETB {{ number_format($data->price, 2) }}
            {{-- Or short format: ETB {{ short_number($data->price) }} --}}
        </span>
    </td>

    {{-- Status --}}
    <td class="py-4 px-2">
        <span 
            class="px-4 py-2 rounded-full text-sm font-semibold
                @if(in_array($data->status, ['available', 'approved'])) status-available
                @elseif($data->status === 'pending') status-pending
                @else status-sold
                @endif
            "
        >
            {{ ucfirst($data->status) }}
        </span>
    </td>

    {{-- Actions --}}
    <td class="py-4 px-2">
        <div class="flex space-x-3">
            <button 
                class="text-blue-400 hover:text-blue-300 font-medium property-action" 
                data-action="view"
            >
                <i class="fas fa-eye">view</i>
            </button>

            <button 
                class="text-[#00ff88] hover:text-green-400 font-medium property-action" 
                data-action="edit"
            >
                <i class="fas fa-edit">edit</i>
            </button>

            <button 
                class="text-red-400 hover:text-red-300 font-medium property-action" 
                data-action="delete"
            >
                delete
            <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </td>
</tr>
