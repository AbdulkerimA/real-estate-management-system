<tr 
    class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors"
    data-status="{{ $data->status }}"
    data-type="{{ $data->type ?? 'apartment' }}"
>
    {{-- Property ID (hidden) --}}
    <td class="pid hidden">
        {{ $data->id }}
    </td>

    {{-- Property Info --}}
    <td class="py-4 px-2">
        <div class="flex items-center space-x-4">
            <div class="property-image w-20 h-16 rounded-xl flex items-center justify-center flex-shrink-0 bg-gray-800">
                <img 
                    src="{{ asset('storage/' . $data->getFirstImage()) }}" 
                    alt="{{ $data->title }}" 
                    class="rounded-lg object-cover w-full h-full"
                >
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
    </td>

    {{-- Price --}}
    <td class="py-4 px-2">
        <span class="font-bold text-md">
            ETB {{ number_format($data->price, 2) }}
        </span>
    </td>

    {{-- Status --}}
    <td class="py-4 px-2">
        <span 
            class="px-4 py-2 rounded-full text-sm font-semibold
                @class([
                    'status-available' => in_array($data->status, ['available', 'approved']),
                    'status-pending' => $data->status === 'pending',
                    'status-sold' => !in_array($data->status, ['available', 'approved', 'pending']),
                ])
            "
        >
            {{ ucfirst($data->status) }}
        </span>
    </td>

    {{-- Actions --}}
    <td class="py-4 px-2">
        <div class="flex space-x-3">

            <button 
                class="text-blue-400 hover:text-blue-300 font-medium"
                onclick="viewData({{ $data->id }})"
            >
                view <i class="fas fa-eye"></i>
            </button>

            <a 
                href="{{ url('dashboard/property/edit/' . $data->id) }}"
                class="text-[#00ff88] hover:text-green-400 font-medium"
            >
                edit <i class="fas fa-edit"></i>
            </a>

            <button 
                class="text-red-400 hover:text-red-300 font-medium"
                form="delete-{{ $data->id }}"
            >
                delete <i class="fas fa-trash-alt"></i>
            </button>

            <form 
                action="{{ url('/dashbord/property/delete/' . $data->id) }}" 
                method="POST" 
                id="delete-{{ $data->id }}" 
                class="hidden"
            >
                @csrf
                @method('DELETE')
            </form>

        </div>
    </td>
</tr>
