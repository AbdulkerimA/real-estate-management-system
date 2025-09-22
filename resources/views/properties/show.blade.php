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
                        <svg class="w-24 h-24 mx-auto mb-4 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        <p class="text-white text-lg opacity-75">Main Property Image</p>
                    </div>
                </div>

                <!-- Property Info -->
                <div class="flex flex-col justify-center">
                    <div class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold mb-4 w-fit">
                        ✅ Available
                    </div>
                    
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">Luxury Apartment in Bole</h1>
                    <p class="text-xl text-gray-400 mb-6">
                        <i class="fa-solid fa-location-dot text-[#00ff88] mr-2"></i>
                        Bole, Addis Ababa, Ethiopia
                    </p>
                    
                    <div class="mb-8">
                        <span class="text-5xl font-bold text-[#00ff88]">ETB 4,500,000</span>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                        <div class="text-center">
                            <div class="flex gap1 items-center justify-center">
                                <i class="fa-solid fa-bed text-xl text-[#00ff88] mb-2 mr-2"></i>
                                <div class="text-2xl font-bold text-[#00ff88]">3</div>
                            </div>
                            <div class="text-sm text-gray-400">Bedrooms</div>
                        </div>
                        <div class="text-center">
                            <div class="flex gap1 items-center justify-center">
                                <i class="fas fa-bath text-xl text-[#00ff88] mb-2 mr-2"></i>
                                <div class="text-2xl font-bold text-[#00ff88]">2</div>
                            </div>
                            <div class="text-sm text-gray-400">Bathrooms</div>
                        </div>
                        <div class="text-center">
                            <div class="flex gap1 items-center justify-center">
                                <i class="fas fa-ruler-combined text-xl text-[#00ff88] mb-2 mr-2"></i>
                                <div class="text-2xl font-bold text-[#00ff88]">120</div>
                            </div>
                            
                            <div class="text-sm text-gray-400">m² Area</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-[#00ff88]">2022</div>
                            <div class="text-sm text-gray-400">Year Built</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="contact-btn bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Schedule Viewing
                        </button>
                        <button class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                            Contact Agent
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery -->
        {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-3xl font-bold mb-6">Property Gallery</h2>
            
            <!-- Main Gallery Image -->
            <div class="mb-6">
                <div id="main-gallery-image" class="hero-image rounded-2xl h-96 flex items-center justify-center cursor-pointer">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-2 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        <p class="text-white opacity-75">Living Room View</p>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Gallery -->
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                <div class="gallery-thumbnail active border-2 border-[#00ff88] rounded-xl h-24 bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center cursor-pointer" data-image="living-room">
                    <span class="text-white text-sm">Living Room</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center cursor-pointer" data-image="kitchen">
                    <span class="text-white text-sm">Kitchen</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center cursor-pointer" data-image="bedroom">
                    <span class="text-white text-sm">Master Bedroom</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center cursor-pointer" data-image="bathroom">
                    <span class="text-white text-sm">Bathroom</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center cursor-pointer" data-image="balcony">
                    <span class="text-white text-sm">Balcony</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center cursor-pointer" data-image="exterior">
                    <span class="text-white text-sm">Exterior</span>
                </div>
            </div>
        </div> --}}
        <x-property.gallary />

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
                                    <div class="text-gray-400">Apartment</div>
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
                                    <div class="text-gray-400">3 Bedrooms</div>
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
                                    <div class="text-gray-400">2 Full Baths</div>
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
                                    <div class="text-gray-400">120 m²</div>
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
                                    <div class="text-gray-400">2022</div>
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
                            This stunning 3-bedroom luxury apartment in the heart of Bole offers modern living at its finest. Built in 2022, this contemporary residence features high-end finishes, spacious layouts, and premium amenities throughout.
                        </p>
                        <p class="text-gray-300 leading-relaxed mb-4">
                            The open-concept living area seamlessly connects the living room, dining area, and modern kitchen, creating an ideal space for both daily living and entertaining. Floor-to-ceiling windows flood the space with natural light and offer beautiful city views.
                        </p>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Located in one of Addis Ababa's most desirable neighborhoods, this property is within walking distance of international schools, shopping centers, restaurants, and business districts. Easy access to Bole International Airport makes it perfect for international professionals.
                        </p>
                        
                        <h4 class="text-lg font-semibold mb-3 text-[#00ff88]">Key Features:</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-300">
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> Modern kitchen with premium appliances</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> Master bedroom with en-suite bathroom</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> Private balcony with city views</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> 24/7 security and concierge</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> Fitness center and swimming pool</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> Underground parking for 2 cars</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> High-speed internet ready</li>
                            <li class="flex items-center"><span class="text-[#00ff88] mr-2">✓</span> Near international schools</li>
                        </ul>
                    </div>
                </div>

                <!-- Agent Information -->
                {{-- <div>
                    <h2 class="text-3xl font-bold mb-6">Listed by</h2>
                    <div class="agent-card rounded-2xl p-6">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                                ST
                            </div>
                            <h3 class="text-xl font-semibold mb-1">Sara Tadesse</h3>
                            <p class="text-[#00ff88] font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center items-center mb-4">
                                <div class="text-yellow-400 flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400">(4.8/5)</span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300">+251 922 345 678</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                                <span class="text-gray-300">sara.tadesse@AnchorHomes.et</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                📞 Call Agent
                            </button>
                            <button class="w-full border-2 border-[#00ff88] text-[#00ff88] py-3 rounded-lg font-semibold hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                                ✉️ Send Message
                            </button>
                            <button class="w-full border border-gray-600 text-gray-300 py-3 rounded-lg font-semibold hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                                👤 View Profile
                            </button>
                        </div>
                    </div>
                </div> --}}
                <x-agent.profile />
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

                @for ($i = 0; $i < 4; $i++)
                    <x-property.property-card />
                @endfor
                {{-- <!-- Similar Property 1 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Modern 2BR Apartment</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Bole, Addis Ababa</p>
                        <p class="text-xl font-bold text-[#00ff88] mb-3">ETB 3,200,000</p>
                        <button class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Similar Property 2 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Luxury 4BR Villa</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Yeka, Addis Ababa</p>
                        <p class="text-xl font-bold text-[#00ff88] mb-3">ETB 8,900,000</p>
                        <button class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Similar Property 3 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Cozy 3BR Condo</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Kirkos, Addis Ababa</p>
                        <p class="text-xl font-bold text-[#00ff88] mb-3">ETB 4,100,000</p>
                        <button class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Similar Property 4 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Executive Penthouse</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Bole, Addis Ababa</p>
                        <p class="text-xl font-bold text-[#00ff88] mb-3">ETB 12,500,000</p>
                        <button class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="cta-section rounded-3xl p-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Interested in this property?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Don't miss out on this amazing opportunity. Schedule a viewing today or contact our agent for more information about this luxury apartment in Bole.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
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
</body>
</html>
