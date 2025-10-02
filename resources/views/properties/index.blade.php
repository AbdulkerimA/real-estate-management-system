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

    <x-nav.nav-layout />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    
                    @foreach ($properties as $property)
                        <x-property.property-card :property="$property" />
                    @endforeach


            </div>
            <!-- Pagination -->
            {{ $properties->links('vendor.pagination.pagination')}}
            {{-- <x-pagination /> --}}
        </div>
    </div>

    <div class="w-full">
        <x-footer />
    </div>
</body>
</html>
