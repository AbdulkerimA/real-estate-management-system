@props([
    'images' => [
        [
            'key' => 'living-room',
            'label' => 'Living Room',
            'gradient' => 'from-purple-500 to-blue-600',
            'active' => true,
        ],
        [
            'key' => 'kitchen',
            'label' => 'Kitchen',
            'gradient' => 'from-green-500 to-teal-600',
        ],
        [
            'key' => 'bedroom',
            'label' => 'Master Bedroom',
            'gradient' => 'from-orange-500 to-red-600',
        ],
        [
            'key' => 'bathroom',
            'label' => 'Bathroom',
            'gradient' => 'from-pink-500 to-purple-600',
        ],
        [
            'key' => 'balcony',
            'label' => 'Balcony',
            'gradient' => 'from-yellow-500 to-orange-600',
        ],
        [
            'key' => 'exterior',
            'label' => 'Exterior',
            'gradient' => 'from-cyan-500 to-blue-600',
        ],
    ],
    'mainLabel' => 'Living Room View',
])

<div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8']) }}>
    <h2 class="text-3xl font-bold mb-6">Property Gallery</h2>
    
    <!-- Main Gallery Image -->
    <div class="mb-6">
        <div id="main-gallery-image" class="hero-image rounded-2xl h-96 flex items-center justify-center cursor-pointer">
            <div class="text-center">
                {{-- <svg class="w-16 h-16 mx-auto mb-2 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg> --}}
                <p class="text-white opacity-75">{{ $mainLabel }}</p>
            </div>
        </div>
    </div>

    <!-- Thumbnail Gallery -->
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($images as $image)
            <div 
                class="gallery-thumbnail {{ $image['active'] ?? false ? 'active border-2 border-[#00ff88]' : 'border-2 border-gray-600' }} rounded-xl h-24 bg-gradient-to-br {{ $image['gradient'] }} flex items-center justify-center cursor-pointer" 
                data-image="{{ $image['key'] }}"
            >
                <span class="text-white text-sm">{{ $image['label'] }}</span>
            </div>
        @endforeach
    </div>
</div>