<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnchorHomes</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/properties.css','resources/js/properties.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    </style>
</head>
<body class="bg-[#12181f] text-white">
    <!-- Navigation (simplified) -->
    {{-- <nav class="bg-[#1c252e] border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="text-2xl font-bold text-[#00ff88]">PropertyHub</div>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-300 hover:text-[#00ff88] transition-colors">Home</a>
                    <a href="#" class="text-[#00ff88] font-semibold">Properties</a>
                    <a href="#" class="text-gray-300 hover:text-[#00ff88] transition-colors">Agents</a>
                    <a href="#" class="text-gray-300 hover:text-[#00ff88] transition-colors">Contact</a>
                </div>
                <button class="md:hidden text-gray-300" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav> --}}
    <x-nav.nav-layout />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 ">
        <!-- Page Header -->
        <div class="text-center mb-12 mt-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Available Properties</h1>
            <p class="text-xl text-gray-400">Browse and find the perfect property in Addis Ababa</p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="bg-[#1c252e] rounded-2xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Location</label>
                    <select class="w-full px-4 py-3 rounded-lg bg-[#12181f] border border-gray-600 text-white focus:outline-none focus:border-[#00ff88]" id="location-filter">
                        <option value="">All Locations</option>
                        <option value="bole">Bole</option>
                        <option value="kirkos">Kirkos</option>
                        <option value="yeka">Yeka</option>
                        <option value="arada">Arada</option>
                        <option value="gulele">Gulele</option>
                        <option value="addis-ketema">Addis Ketema</option>
                        <option value="lideta">Lideta</option>
                        <option value="kolfe-keranio">Kolfe Keranio</option>
                        <option value="akaky-kaliti">Akaky Kaliti</option>
                        <option value="nifas-silk-lafto">Nifas Silk Lafto</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Property Type</label>
                    <select class="w-full px-4 py-3 rounded-lg bg-[#12181f] border border-gray-600 text-white focus:outline-none focus:border-[#00ff88]" id="type-filter">
                        <option value="">All Types</option>
                        <option value="house">House</option>
                        <option value="apartment">Apartment</option>
                        <option value="land">Land</option>
                        <option value="commercial">Commercial</option>
                        <option value="villa">Villa</option>
                        <option value="condominium">Condominium</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Price Range</label>
                    <select class="w-full px-4 py-3 rounded-lg bg-[#12181f] border border-gray-600 text-white focus:outline-none focus:border-[#00ff88]" id="price-filter">
                        <option value="">Any Price</option>
                        <option value="0-500000">Under 500K ETB</option>
                        <option value="500000-1000000">500K - 1M ETB</option>
                        <option value="1000000-2000000">1M - 2M ETB</option>
                        <option value="2000000-5000000">2M - 5M ETB</option>
                        <option value="5000000+">Above 5M ETB</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Bedrooms</label>
                    <select class="w-full px-4 py-3 rounded-lg bg-[#12181f] border border-gray-600 text-white focus:outline-none focus:border-[#00ff88]" id="bedroom-filter">
                        <option value="">Any</option>
                        <option value="1">1 Bedroom</option>
                        <option value="2">2 Bedrooms</option>
                        <option value="3">3 Bedrooms</option>
                        <option value="4">4 Bedrooms</option>
                        <option value="5+">5+ Bedrooms</option>
                    </select>
                </div>
                <div class="flex flex-col justify-end align-center">
                    <button class="bg-[#00ff88] text-[#12181f] py-2.5 px-6 rounded-lg font-semibold hover:bg-green-400 transition-colors mb-2" id="search-btn">
                        Search
                    </button>
                    {{-- <button class="text-gray-400 hover:text-[#00ff88] transition-colors text-sm" id="reset-btn">
                        Reset Filters
                    </button> --}}
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters (Desktop) -->
            {{-- <div class="lg:w-1/4">
                <div class="bg-[#1c252e] rounded-2xl p-6 sticky top-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold">Filters</h3>
                        <button class="lg:hidden text-gray-400" id="close-sidebar">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Property Type Checkboxes -->
                    <div class="mb-6">
                        <h4 class="font-medium mb-3">Property Type</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-3 accent-[#00ff88]" value="house">
                                <span class="text-gray-300">House</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-3 accent-[#00ff88]" value="apartment">
                                <span class="text-gray-300">Apartment</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-3 accent-[#00ff88]" value="land">
                                <span class="text-gray-300">Land</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-3 accent-[#00ff88]" value="commercial">
                                <span class="text-gray-300">Commercial</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-3 accent-[#00ff88]" value="villa">
                                <span class="text-gray-300">Villa</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range Slider -->
                    <div class="mb-6">
                        <h4 class="font-medium mb-3">Price Range (ETB)</h4>
                        <div class="px-2">
                            <input type="range" min="0" max="10000000" value="5000000" class="range-slider w-full mb-2" id="price-range">
                            <div class="flex justify-between text-sm text-gray-400">
                                <span>0</span>
                                <span id="price-display">5,000,000</span>
                                <span>10M+</span>
                            </div>
                        </div>
                    </div>

                    <!-- Verified Properties Toggle -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-3 accent-[#00ff88]" id="verified-only">
                            <span class="text-gray-300">Only Verified Properties</span>
                        </label>
                    </div>

                    <!-- Results Count -->
                    <div class="text-sm text-gray-400">
                        <span id="results-count">24 properties found</span>
                    </div>
                </div>
            </div> --}}

            <!-- Main Content -->
            <div class="my-8 w-full">
                <!-- Mobile Filter Button -->
                <div class="lg:hidden mb-6">
                    <button class="bg-[#1c252e] px-4 py-2 rounded-lg flex items-center" id="mobile-filter-btn">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        Filters
                    </button>
                </div>

                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-6">
                    <div class="text-gray-400">
                        Showing <span class="text-white font-semibold">1-24</span> of <span class="text-white font-semibold">156</span> properties
                    </div>
                    <select class="bg-[#1c252e] border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-[#00ff88]">
                        <option>Sort by: Newest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Most Popular</option>
                    </select>
                </div>

                <!-- Property Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8" id="properties-grid">
                    <!-- Property Card 1 -->
                    {{-- <div class="property-card bg-[#1c252e] rounded-2xl overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-blue-600 to-blue-800">
                                <svg class="w-full h-full" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="200" fill="#2563eb"/>
                                    <rect x="50" y="40" width="300" height="120" fill="#1d4ed8" rx="8"/>
                                    <rect x="80" y="70" width="60" height="60" fill="#1e40af"/>
                                    <rect x="170" y="70" width="60" height="60" fill="#1e40af"/>
                                    <rect x="260" y="70" width="60" height="60" fill="#1e40af"/>
                                    <circle cx="350" cy="30" r="10" fill="#00ff88" opacity="0.8"/>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="status-available text-white px-3 py-1 rounded-full text-sm font-semibold">Available</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded text-sm">
                                📷 8 photos
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Luxury Apartment in Bole</h3>
                            <p class="text-gray-400 mb-3">📍 Bole, Addis Ababa</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-[#00ff88]">2,500,000 ETB</div>
                                <div class="text-sm text-gray-400">3 bed • 2 bath</div>
                            </div>
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div> --}}
                    @for ($i = 0; $i < 6; $i++)
                    <x-property.property-card />
                    @endfor

                    {{-- <!-- Property Card 2 -->
                    <div class="property-card bg-[#1c252e] rounded-2xl overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-green-600 to-green-800">
                                <svg class="w-full h-full" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="200" fill="#059669"/>
                                    <rect x="40" y="30" width="320" height="140" fill="#047857" rx="12"/>
                                    <rect x="70" y="60" width="70" height="80" fill="#065f46"/>
                                    <rect x="165" y="60" width="70" height="80" fill="#065f46"/>
                                    <rect x="260" y="60" width="70" height="80" fill="#065f46"/>
                                    <circle cx="50" cy="20" r="8" fill="#00ff88"/>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="status-pending text-white px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded text-sm">
                                📷 12 photos
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Modern Villa in Yeka</h3>
                            <p class="text-gray-400 mb-3">📍 Yeka, Addis Ababa</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-[#00ff88]">4,200,000 ETB</div>
                                <div class="text-sm text-gray-400">4 bed • 3 bath</div>
                            </div>
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>

                    <!-- Property Card 3 -->
                    <div class="property-card bg-[#1c252e] rounded-2xl overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-purple-600 to-purple-800">
                                <svg class="w-full h-full" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="200" fill="#7c3aed"/>
                                    <rect x="60" y="50" width="280" height="100" fill="#6d28d9" rx="6"/>
                                    <rect x="90" y="80" width="50" height="40" fill="#5b21b6"/>
                                    <rect x="175" y="80" width="50" height="40" fill="#5b21b6"/>
                                    <rect x="260" y="80" width="50" height="40" fill="#5b21b6"/>
                                    <circle cx="370" cy="40" r="12" fill="#00ff88" opacity="0.6"/>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="status-available text-white px-3 py-1 rounded-full text-sm font-semibold">Available</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded text-sm">
                                📷 6 photos
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Commercial Space in Kirkos</h3>
                            <p class="text-gray-400 mb-3">📍 Kirkos, Addis Ababa</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-[#00ff88]">1,800,000 ETB</div>
                                <div class="text-sm text-gray-400">200 sqm</div>
                            </div>
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>

                    <!-- Property Card 4 -->
                    <div class="property-card bg-[#1c252e] rounded-2xl overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-red-600 to-red-800">
                                <svg class="w-full h-full" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="200" fill="#dc2626"/>
                                    <rect x="50" y="40" width="300" height="120" fill="#b91c1c" rx="10"/>
                                    <rect x="80" y="70" width="60" height="60" fill="#991b1b"/>
                                    <rect x="170" y="70" width="60" height="60" fill="#991b1b"/>
                                    <rect x="260" y="70" width="60" height="60" fill="#991b1b"/>
                                    <circle cx="30" cy="30" r="15" fill="#00ff88" opacity="0.7"/>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="status-sold text-white px-3 py-1 rounded-full text-sm font-semibold">Sold</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded text-sm">
                                📷 15 photos
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Family House in Gulele</h3>
                            <p class="text-gray-400 mb-3">📍 Gulele, Addis Ababa</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-gray-500">3,100,000 ETB</div>
                                <div class="text-sm text-gray-400">5 bed • 4 bath</div>
                            </div>
                            <button class="w-full bg-gray-600 text-gray-300 py-3 rounded-lg font-semibold cursor-not-allowed">
                                Sold
                            </button>
                        </div>
                    </div>

                    <!-- Property Card 5 -->
                    <div class="property-card bg-[#1c252e] rounded-2xl overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-indigo-600 to-indigo-800">
                                <svg class="w-full h-full" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="200" fill="#4f46e5"/>
                                    <rect x="45" y="35" width="310" height="130" fill="#4338ca" rx="8"/>
                                    <rect x="75" y="65" width="65" height="70" fill="#3730a3"/>
                                    <rect x="167" y="65" width="65" height="70" fill="#3730a3"/>
                                    <rect x="260" y="65" width="65" height="70" fill="#3730a3"/>
                                    <circle cx="380" cy="25" r="10" fill="#00ff88" opacity="0.8"/>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="status-available text-white px-3 py-1 rounded-full text-sm font-semibold">Available</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded text-sm">
                                📷 10 photos
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Condominium in Arada</h3>
                            <p class="text-gray-400 mb-3">📍 Arada, Addis Ababa</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-[#00ff88]">1,200,000 ETB</div>
                                <div class="text-sm text-gray-400">2 bed • 1 bath</div>
                            </div>
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>

                    <!-- Property Card 6 -->
                    <div class="property-card bg-[#1c252e] rounded-2xl overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-yellow-600 to-yellow-800">
                                <svg class="w-full h-full" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="200" fill="#d97706"/>
                                    <rect x="40" y="45" width="320" height="110" fill="#b45309" rx="12"/>
                                    <rect x="70" y="75" width="70" height="50" fill="#92400e"/>
                                    <rect x="165" y="75" width="70" height="50" fill="#92400e"/>
                                    <rect x="260" y="75" width="70" height="50" fill="#92400e"/>
                                    <circle cx="50" cy="25" r="12" fill="#00ff88" opacity="0.9"/>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="status-available text-white px-3 py-1 rounded-full text-sm font-semibold">Available</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded text-sm">
                                📷 7 photos
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Land Plot in Lideta</h3>
                            <p class="text-gray-400 mb-3">📍 Lideta, Addis Ababa</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-2xl font-bold text-[#00ff88]">800,000 ETB</div>
                                <div class="text-sm text-gray-400">500 sqm</div>
                            </div>
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- Pagination -->
            <x-pagination></x-pagination>
        </div>
    </div>
    <x-footer />
</body>
</html>
