<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Agents - PropertyHub</title>
   <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/agentsPage.css','resources/js/agentsPage.js'])
</head>

<body class="bg-[#12181f] text-white">
    <!-- Navigation -->
    <x-nav.nav-layout /> 

    <!-- Floating Background Shapes -->
    <div class="floating-shapes fixed inset-0">
        <div class="shape">
            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                <rect width="150" height="150" fill="#00ff88" rx="30"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="60" fill="#00ff88"/>
            </svg>
        </div>
    </div>

    <div class="relative z-10 mt-12">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Meet Our Trusted Agents</h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Connect with professional real estate agents in Addis Ababa who will help you find your perfect property or sell your current one</p>
            </div>
        </div>

        

        {{-- <!-- Featured Agents Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <h2 class="text-3xl font-bold mb-8 text-center">Featured Agents</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Featured Agent 1 -->
                <div class="agent-card featured-card rounded-2xl p-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-4xl font-bold">
                                AM
                            </div>
                            <div class="absolute -top-2 -right-2 bg-[#00ff88] text-[#12181f] px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ TOP
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-2xl font-bold mb-2">Abebe Mekuria</h3>
                            <p class="text-[#00ff88] font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center md:justify-start items-center mb-3">
                                <div class="star-rating flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400">(4.9/5 • 127 reviews)</span>
                            </div>
                            <p class="text-gray-300 mb-4">12+ years of experience in Addis Ababa real estate market. Specialized in luxury properties and commercial spaces.</p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="tel:+251911234567" class="flex items-center justify-center px-4 py-2 bg-[#12181f] rounded-lg hover:bg-gray-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    +251 911 234 567
                                </a>
                                <button class="bg-[#00ff88] text-[#12181f] px-6 py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                    View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Agent 2 -->
                <div class="agent-card featured-card rounded-2xl p-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-4xl font-bold">
                                ST
                            </div>
                            <div class="absolute -top-2 -right-2 bg-[#00ff88] text-[#12181f] px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ TOP
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-2xl font-bold mb-2">Sara Tadesse</h3>
                            <p class="text-[#00ff88] font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center md:justify-start items-center mb-3">
                                <div class="star-rating flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400">(4.8/5 • 98 reviews)</span>
                            </div>
                            <p class="text-gray-300 mb-4">8+ years specializing in residential properties and first-time home buyers. Expert in Bole and Yeka areas.</p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="tel:+251922345678" class="flex items-center justify-center px-4 py-2 bg-[#12181f] rounded-lg hover:bg-gray-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    +251 922 345 678
                                </a>
                                <button class="bg-[#00ff88] text-[#12181f] px-6 py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                    View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Search & Filter Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="search-bar rounded-2xl p-6">
                <form method="GET" action="{{ route('agents.index') }}" class="flex flex-col lg:flex-row gap-4">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search agents by name or location..."
                        value="{{ request('search') }}"
                        class="w-full px-6 py-4 bg-[#12181f] border border-gray-600 rounded-xl text-white placeholder-gray-400"
                    >

                    <select name="location" class="filter-btn px-4 py-3 bg-[#12181f] border border-gray-600 rounded-lg text-white">
                        <option>All Locations</option>
                        <option value="Bole" {{ request('location')=='Bole'?'selected':'' }}>Bole</option>
                        <option value="Kirkos" {{ request('location')=='Kirkos'?'selected':'' }}>Kirkos</option>
                        <option value="Yeka" {{ request('location')=='Yeka'?'selected':'' }}>Yeka</option>
                        <option value="Arada" {{ request('location')=='Arada'?'selected':'' }}>Arada</option>
                        <option value="Gulele" {{ request('location')=='Gulele'?'selected':'' }}>Gulele</option>
                    </select>

                    <select name="experience" class="filter-btn px-4 py-3 bg-[#12181f] border border-gray-600 rounded-lg text-white">
                        <option>Experience</option>
                        <option value="1-3 years" {{ request('experience')=='1-3 years'?'selected':'' }}>1-3 years</option>
                        <option value="3-5 years" {{ request('experience')=='3-5 years'?'selected':'' }}>3-5 years</option>
                        <option value="5-10 years" {{ request('experience')=='5-10 years'?'selected':'' }}>5-10 years</option>
                        <option value="10+ years" {{ request('experience')=='10+ years'?'selected':'' }}>10+ years</option>
                    </select>

                    <select name="rating" class="filter-btn px-4 py-3 bg-[#12181f] border border-gray-600 rounded-lg text-white">
                        <option>All Ratings</option>
                        <option value="5 Stars" {{ request('rating')=='5 Stars'?'selected':'' }}>5 Stars</option>
                        <option value="4+ Stars" {{ request('rating')=='4+ Stars'?'selected':'' }}>4+ Stars</option>
                        <option value="3+ Stars" {{ request('rating')=='3+ Stars'?'selected':'' }}>3+ Stars</option>
                    </select>

                    <button type="submit" class="bg-[#00ff88] text-[#12181f] px-6 py-3 rounded-lg font-semibold hover:bg-green-400">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- All Agents Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">All Agents</h2>
                <div class="text-gray-400">
                    Showing <span class="text-white font-semibold">1-12</span> of <span class="text-white font-semibold">47</span> agents
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="agents-grid">
                <!-- Agent Card 1 -->
                @foreach ($agents as $agent)
                    <x-agent.agnet-card :agent="$agent"/>
                @endforeach
                <!-- Agent Card 2 -->
            </div>

            <!-- Pagination -->
            {{-- <x-pagination /> --}}
            <!-- Pagination -->
            {{ $agents->links('vendor.pagination.pagination')}}

        </div>

        <!-- Call-to-Action Section -->
        <div class="cta-section py-20 relative">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Want to become an agent on our platform?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Join our network of professional real estate agents and grow your business with PropertyHub's advanced tools and extensive client base.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button id="join"
                        class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                        Join as an Agent
                    </button>
                    <button class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                        Learn More
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>
</body>
</html>
