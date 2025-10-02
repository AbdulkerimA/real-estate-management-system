@props(['property'])

@php
    $images = json_decode($property->media->file_path, true);
@endphp

<div class="property-card bg-[#1c252e] rounded-2xl shadow-lg overflow-hidden">

    <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 relative">
    
        <div class="absolute inset-0 bg-black bg-opacity-20">        
            @if(!empty($images))
                <img src="{{ asset('storage/' . $images[0]) }}" alt="Property Image" class="h-full w-full">
            @endif
        </div>
    
        <x-property.tag status="{{ $property->status }}">
            {{ $property->status }}
        </x-property.tag>

    </div>
    
    <div class="p-6">
        <h3 class="text-xl font-bold text-white mb-2">{{ $property->title }}</h3>
        <p class="text-gray-400 mb-4">
            <i class="fas text-green-400 fa-map-marker-alt mr-2"></i>
            {{ $property->location }}
        </p>
    
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-4 text-sm text-gray-400">
                <span><i class="fa text-green-400 fa-bed mr-1"></i>{{ $property->details->bed_rooms }} Beds</span>
                <span><i class="fas text-green-400 fa-bath mr-1"></i>{{ $property->details->bath_rooms }} Baths</span> 
                <span><i class="fas text-green-400 fa-ruler-combined mr-1"></i>{{ $property->area_size }}m²</span>
            </div>
        </div>
        
        <div class="my-4 text-green-400 font-bold">
            <div class="text-2xl font-bold">{{ number_format($property->price) }} ETB</div>
        </div>
    
        <button
            onclick="window.location = '/property/{{ $property->id }}'"
            class="w-full bg-[#00ff88] text-gray-900 py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
            View Details
        </button>
    
    </div>
</div>