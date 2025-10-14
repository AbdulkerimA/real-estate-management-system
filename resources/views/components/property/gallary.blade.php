@props([
    'imagesdata' => [
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
    'property'
])

@php
    $images = json_decode($property->media->file_path, true);
    $firstImage = (is_array($images) && count($images) > 0) ? $images[0] : 'default.jpg';
    $i = 0;
@endphp

{{-- <div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8']) }}>
    <h2 class="text-3xl font-bold mb-6">Property Gallery</h2>
    
    <!-- Main Gallery Image -->
    <div class="mb-6">
        <div id="main-gallery-image" class="hero-image rounded-2xl h-96 flex items-center justify-center cursor-pointer">
            <div class="text-center">
                <img src="{{ asset('storage/'.$firstImage) }}" alt="">
                <p class="text-white opacity-75">{{ $mainLabel }}</p>
            </div>
        </div>
    </div>

    <!-- Thumbnail Gallery -->
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($imagesdata as $image)
            <div 
                class="gallery-thumbnail {{ $image['active'] ?? false ? 'active border-2 border-[#00ff88]' : 'border-2 border-gray-600' }} rounded-xl h-24 bg-gradient-to-br {{ $image['gradient'] }} flex items-center justify-center cursor-pointer" 
                data-image="{{ $image['key'] }}"
            >
                @if(isset($images[$i]))
                    <img src="{{ asset('storage/'.$images[$i]) }}" alt="" class="h-full">
                @endif
                @php
                    $i++;
                @endphp
                <span class="text-white text-sm">{{ $image['label'] }}</span>
            </div>
        @endforeach
    </div>
</div> --}}
{{-- @vite(['resources/css/swiperjs.css','resources/js/swiper.js']) --}}
  <!-- Swiper -->
<h3 class="mx-4 px-4 sm:px-6 lg:px-8 py-8 text-4xl">
    property gallary
</h3>
  <div class="m-4">
    @if(count($images) > 0)
        <!-- Main Slider -->
        {{-- The keen-slider__slide divs must be direct children of the keen-slider container. --}}
        <div id="main-keen-slider" class="keen-slider max-w-7xl max-h-[50vh] lg:max-h-[100vh] mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @foreach ($images as $image)
                <div class="keen-slider__slide rounded-xl md:rounded-2xl">
                    <img src="{{ asset('storage/'.$image) }}" class="rounded-xl md:rounded-2xl w-full h-full " alt="Slider image">
                </div>
            @endforeach
        </div>

        <!-- Thumbnail Slider -->
        {{-- The keen-slider__slide divs must be direct children of the keen-slider container. --}}
        <div id="thumbnails" class="keen-slider thumbnail mt-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @foreach ($images as $image)
                <div class="keen-slider__slide rounded-xl md:rounded-2xl">
                    <img src="{{ asset('storage/'.$image) }}" class="rounded-xl md:rounded-2xl w-full h-full object-cover" alt="Thumbnail image">
                </div>
            @endforeach
        </div>
    @else
        <p>No images to display.</p>
    @endif
</div>

  <!-- Swiper JS -->
  {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> --}}

  <!-- Initialize Swiper -->
  {{-- <script>
    var swiper = new Swiper(".mySwiper", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
  </script> --}}