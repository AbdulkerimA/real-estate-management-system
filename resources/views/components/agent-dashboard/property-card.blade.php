@props(['data'])
@php
    
    $images = json_decode($data->media->file_path);
    $firstImage = (is_array($images) && count($images) > 0) ? $images[0] : 'default.jpg';

    // dd($data->media->file_path);
@endphp

<div 
    class="property-card rounded-2xl overflow-hidden" 
    data-status="{{ $data->status }}" 
    data-type="{{ $data->type ?? 'apartment' }}"
>
    {{-- Property Image / Placeholder --}}
    <div class="property-image h-48 flex items-center justify-center bg-gray-200">
        <div class="img h-full w-full">
            <img src="{{ asset('storage/'.$firstImage) }}" alt="{{ $data->title }}" class="w-full h-full object-cover" >
        </div>
    </div>

    {{-- Property Details --}}
    <div class="p-6">
        <div class="flex items-center justify-between mb-3">
            {{-- Status Badge --}}
            <span 
                class="px-3 py-1 rounded-full text-xs font-semibold
                    @if(in_array($data->status, ['available', 'approved'])) status-available
                    @elseif($data->status === 'pending') status-pending
                    @else status-sold
                    @endif
                ">
                {{ ucfirst($data->status) }}
            </span>

            {{-- Price (short format, optional) --}}
            {{-- <span class="text-2xl font-bold text-[#00ff88]">
                ETB {{ short_number($data->price) }}
            </span> --}}
        </div>

        {{-- Title & Location --}}
        <h3 class="text-xl font-bold mb-2">{{ $data->title }}</h3>
        <p class="text-gray-400 mb-2">{{ $data->location }}</p>
        <p class="text-gray-400 mb-4">• 3 bed, 2 bath</p>

        {{-- Actions --}}
        <div class="flex space-x-3">
            <button 
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" 
                data-action="view"
                onclick="viewData({{ $data->id }})"
            >
                <i class="fas fa-eye"></i> 
            </button>

            <button 
                class="flex-1 bg-[#00ff88] hover:bg-green-400 text-[#12181f] py-2 px-4 rounded-lg font-medium transition-colors property-action" 
                data-action="edit"
                onclick="window.location='property/edit/{{ $data->id }}'"    
            >
                <i class="fas fa-edit"></i>
            </button>

            <button 
                class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" 
                data-action="delete"
                type="submit"
                form="delete-{{ $data->id }}"
            >
                <i class="fas fa-trash-alt w-5 h-5"></i>
            </button>

            <form action="/dashbord/property/delete/{{ $data->id }}" method="post" class="hidden" id="delete-{{ $data->id }}">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
