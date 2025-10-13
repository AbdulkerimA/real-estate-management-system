<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Apartment in Bole - AnchorHomes</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/properties.css','resources/js/propertyDetails.js'])
</head>
@php
    $id = json_encode($property->id);
@endphp
<body class="bg-[#12181f] text-white">
    <!-- Navigation -->
    <x-nav.nav-layout />

    <!-- Floating Background Shapes -->
    <div class="floating-shapes fixed inset-0">
        <div class="shape">
            <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="200" fill="#00ff88" rx="40"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                <circle cx="75" cy="75" r="75" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="180" height="180" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
                <polygon points="90,20 160,140 20,140" fill="#00ff88"/>
            </svg>
        </div>
    </div>

    <div class="relative z-10 mt-12">
        <!-- Property Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Hero Image -->
                <div class="hero-image rounded-3xl h-96 lg:h-[500px] flex items-center justify-center">
                    <div class="text-center">
                        @php
                            $encodedImages = $property->media->file_path;
                            $images = json_decode($encodedImages, true);
                            $firstImage = (is_array($images) && count($images) > 0) ? $images[0] : 'default.jpg';
                        @endphp

                        <img src="{{ asset('storage/' . $firstImage) }}" alt="property Image" class="h-96 lg:h-[500px]">
                    </div>
                </div>

                <!-- Property Info -->
                <div class="flex flex-col justify-center">
                    <div class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold mb-4 w-fit">
                        ✅ {{ $property->status }}
                    </div>
                    
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $property->title }}</h1>
                    <p class="text-xl text-gray-400 mb-6">
                        <i class="fa-solid fa-location-dot text-[#00ff88] mr-2"></i>
                        {{ $property->location }}
                    </p>
                    
                    <div class="mb-8">
                        <span class="text-5xl font-bold text-[#00ff88]">ETB {{ number_format($property->price) }}</span>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                        <div class="text-center">
                            <div class="flex gap1 items-center justify-center">
                                <i class="fa-solid fa-bed text-xl text-[#00ff88] mb-2 mr-2"></i>
                                <div class="text-2xl font-bold text-[#00ff88]">{{ $property->details->bed_rooms }}</div>
                            </div>
                            <div class="text-sm text-gray-400">Bedrooms</div>
                        </div>
                        <div class="text-center">
                            <div class="flex gap1 items-center justify-center">
                                <i class="fas fa-bath text-xl text-[#00ff88] mb-2 mr-2"></i>
                                <div class="text-2xl font-bold text-[#00ff88]">{{ $property->details->bath_rooms }}</div>
                            </div>
                            <div class="text-sm text-gray-400">Bathrooms</div>
                        </div>
                        <div class="text-center">
                            <div class="flex gap1 items-center justify-center">
                                <i class="fas fa-ruler-combined text-xl text-[#00ff88] mb-2 mr-2"></i>
                                <div class="text-2xl font-bold text-[#00ff88]">{{ $property->details->area_size }}</div>
                            </div>
                            
                            <div class="text-sm text-gray-400">m² Area</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-[#00ff88]">{{ $property->details->year_built }}</div>
                            <div class="text-sm text-gray-400">Year Built</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button
                            {{-- onclick="window.location = '/schedule/{{ $property->id }}'"  --}}
                            class=" {{ $scheduled ? 'deactivated' : '' }}
                                contact-btn bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Schedule Viewing
                        </button>
                        <button
                            onclick="window.location = '/contant/agent'" 
                            class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                            Contact Agent
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <x-property.gallary :property="$property"/>

        <!-- Property Details -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Details -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold mb-6">Property Overview</h2>
                    
                    <!-- Details Grid -->
                    <div class="detail-card rounded-2xl p-6 mb-8">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm6 14H8a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h2v1a1 1 0 0 0 2 0V9h2v10a1 1 0 0 1-1 1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Property Type</div>
                                    <div class="text-gray-400">{{ $property->type }}</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Bedrooms</div>
                                    <div class="text-gray-400">{{ $property->details->bed_rooms }} Bedrooms</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9,2V8H7V10H9V14A4,4 0 0,0 13,18H15V16H13A2,2 0 0,1 11,14V10H15V8H11V2H9Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Bathrooms</div>
                                    <div class="text-gray-400">{{ $property->details->bath_rooms }} Full Baths</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2,2V4H4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V4H22V2H2M16,10V12H14V10H16M10,10V12H8V10H10M16,6V8H14V6H16M10,6V8H8V6H10M16,14V16H14V14H16M10,14V16H8V14H10Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Floor Area</div>
                                    <div class="text-gray-400">{{ $property->details->area_size }} m²</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M16.2,16.2L11,13V7H12.5V12.2L17,15.4L16.2,16.2Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Year Built</div>
                                    <div class="text-gray-400">{{ $property->details->year_built }}</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18,15H16V17H18M18,11H16V13H18M20,19H12V17H14V15H12V13H14V11H12V9H20M10,7H8V5H10M10,11H8V9H10M10,15H8V13H10M10,19H8V17H10M6,7H4V5H6M6,11H4V9H6M6,15H4V13H6M6,19H4V17H6M12,7V3H2V21H22V7H12Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Parking</div>
                                    <div class="text-gray-400">2 Spaces</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Full Description -->
                    <h3 class="text-2xl font-bold mb-4">Description</h3>
                    <div class="detail-card rounded-2xl p-6">
                        <p class="text-gray-300 leading-relaxed mb-4">
                           {{ $property->description }}
                        </p>
                    </div>
                </div>

                <x-agent.profile :agent="$agent" />
            </div>
        </div>

        <!-- Map Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-3xl font-bold mb-6">Location</h2>
            <div class="detail-card rounded-2xl p-6">
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">📍 Bole, Addis Ababa, Ethiopia</h3>
                    <p class="text-gray-400">Prime location in the heart of Bole district</p>
                </div>
                
                <!-- Map Placeholder -->
                <div class="map-placeholder rounded-xl h-64 flex items-center justify-center">
                    <div class="text-center text-white">
                        <p class="text-lg font-semibold mb-2">Interactive Map</p>
                        <p class="opacity-75">Property Location in Addis Ababa</p>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="flex items-center">
                        <span class="text-[#00ff88] mr-2">🏫</span>
                        <span>International School - 5 min</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-[#00ff88] mr-2">🛒</span>
                        <span>Shopping Mall - 3 min</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-[#00ff88] mr-2">✈️</span>
                        <span>Bole Airport - 15 min</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Properties -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-3xl font-bold mb-8">Similar Properties</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                @foreach ($properties as $property)
                    {{-- <x-property.property-card :property="$property"/> --}}
                @endforeach
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="cta-section rounded-3xl p-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Interested in this property?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Don't miss out on this amazing opportunity. Schedule a viewing today or contact our agent for more information about this luxury apartment in Bole.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button 
                        {{-- onclick="window.location = '/schedule/{{ $property->id }}'" --}}
                        class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                        Schedule a Viewing
                    </button>
                    <button class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                        Contact Agent
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>
    <script>
        let propertyId = @json($id);
    </script>
</body>
</html>
