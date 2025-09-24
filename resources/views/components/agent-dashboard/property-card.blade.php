@props(['data'])

<div 
    class="property-card rounded-2xl overflow-hidden" 
    data-status="{{ $data->status }}" 
    data-type="{{ $data->type ?? 'apartment' }}"
>
    {{-- Property Image / Placeholder --}}
    <div class="property-image h-48 flex items-center justify-center bg-gray-200">
        <svg class="w-16 h-16 text-gray-500 opacity-60" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
        </svg>
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
            >
                <i class="fas fa-eye"></i> 
            </button>

            <button 
                class="flex-1 bg-[#00ff88] hover:bg-green-400 text-[#12181f] py-2 px-4 rounded-lg font-medium transition-colors property-action" 
                data-action="edit"
            >
                <i class="fas fa-edit"></i>
            </button>

            <button 
                class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" 
                data-action="delete"
            >
                <i class="fas fa-trash-alt w-5 h-5"></i>
            </button>
        </div>
    </div>
</div>
