<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Agents - PropertyHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-primary': '#1c252e',
                        'dark-secondary': '#12181f',
                        'accent-green': '#00ff88'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .agent-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .agent-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 255, 136, 0.15);
        }
        
        .featured-card {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.1) 0%, rgba(28, 37, 46, 0.9) 100%);
            border: 2px solid rgba(0, 255, 136, 0.3);
        }
        
        .star-rating {
            color: #fbbf24;
        }
        
        .search-bar {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .filter-btn {
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover {
            background: rgba(0, 255, 136, 0.1);
            border-color: #00ff88;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #1c252e 0%, #12181f 100%);
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%2300ff88" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .shape {
            position: absolute;
            opacity: 0.05;
            animation: float 10s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
    </style>
</head>
<body class="bg-dark-secondary text-white">
    <!-- Navigation -->
    <nav class="bg-dark-primary border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-accent-green rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-accent-green">PropertyHub</span>
                    </div>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Home</a>
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Properties</a>
                    <a href="#" class="text-accent-green font-semibold">Agents</a>
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">About</a>
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Contact</a>
                </div>
                <button class="md:hidden text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

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

    <div class="relative z-10">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Meet Our Trusted Agents</h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Connect with professional real estate agents in Addis Ababa who will help you find your perfect property or sell your current one</p>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="search-bar rounded-2xl p-6">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative">
                            <input 
                                type="text" 
                                placeholder="Search agents by name or location..."
                                class="w-full px-6 py-4 bg-dark-secondary border border-gray-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-accent-green focus:ring-2 focus:ring-accent-green/20"
                                id="agent-search"
                            >
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <select class="filter-btn px-4 py-3 bg-dark-secondary border border-gray-600 rounded-lg text-white focus:outline-none focus:border-accent-green">
                            <option>All Locations</option>
                            <option>Bole</option>
                            <option>Kirkos</option>
                            <option>Yeka</option>
                            <option>Arada</option>
                            <option>Gulele</option>
                        </select>
                        
                        <select class="filter-btn px-4 py-3 bg-dark-secondary border border-gray-600 rounded-lg text-white focus:outline-none focus:border-accent-green">
                            <option>Experience</option>
                            <option>1-3 years</option>
                            <option>3-5 years</option>
                            <option>5-10 years</option>
                            <option>10+ years</option>
                        </select>
                        
                        <select class="filter-btn px-4 py-3 bg-dark-secondary border border-gray-600 rounded-lg text-white focus:outline-none focus:border-accent-green">
                            <option>All Ratings</option>
                            <option>5 Stars</option>
                            <option>4+ Stars</option>
                            <option>3+ Stars</option>
                        </select>
                        
                        <button class="bg-accent-green text-dark-secondary px-6 py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Agents Section -->
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
                            <div class="absolute -top-2 -right-2 bg-accent-green text-dark-secondary px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ TOP
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-2xl font-bold mb-2">Abebe Mekuria</h3>
                            <p class="text-accent-green font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center md:justify-start items-center mb-3">
                                <div class="star-rating flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400">(4.9/5 • 127 reviews)</span>
                            </div>
                            <p class="text-gray-300 mb-4">12+ years of experience in Addis Ababa real estate market. Specialized in luxury properties and commercial spaces.</p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="tel:+251911234567" class="flex items-center justify-center px-4 py-2 bg-dark-secondary rounded-lg hover:bg-gray-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    +251 911 234 567
                                </a>
                                <button class="bg-accent-green text-dark-secondary px-6 py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
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
                            <div class="absolute -top-2 -right-2 bg-accent-green text-dark-secondary px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ TOP
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-2xl font-bold mb-2">Sara Tadesse</h3>
                            <p class="text-accent-green font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center md:justify-start items-center mb-3">
                                <div class="star-rating flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400">(4.8/5 • 98 reviews)</span>
                            </div>
                            <p class="text-gray-300 mb-4">8+ years specializing in residential properties and first-time home buyers. Expert in Bole and Yeka areas.</p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="tel:+251922345678" class="flex items-center justify-center px-4 py-2 bg-dark-secondary rounded-lg hover:bg-gray-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    +251 922 345 678
                                </a>
                                <button class="bg-accent-green text-dark-secondary px-6 py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                    View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="agents-grid">
                <!-- Agent Card 1 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        DH
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Daniel Haile</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.7)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">5 years experience • Kirkos specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251933456789" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 933 456 789
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 2 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        MG
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Meron Girma</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.6)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">3 years experience • Arada specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251944567890" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 944 567 890
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 3 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        TA
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Tekle Assefa</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.8)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">7 years experience • Gulele specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251955678901" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 955 678 901
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 4 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        HM
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Helen Mulugeta</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.5)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">4 years experience • Yeka specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251966789012" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 966 789 012
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 5 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        BT
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Bereket Tesfaye</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.9)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">6 years experience • Bole specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251977890123" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 977 890 123
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 6 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        LW
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Liya Worku</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.4)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">2 years experience • Lideta specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251988901234" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 988 901 234
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 7 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        AG
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Addisu Getachew</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.7)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">9 years experience • Commercial specialist</p>
                    <div class="space-y-2">
                        <a href="tel:+251999012345" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 999 012 345
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>

                <!-- Agent Card 8 -->
                <div class="agent-card rounded-2xl p-6 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        FS
                    </div>
                    <h3 class="text-xl font-semibold mb-1">Firehiwot Solomon</h3>
                    <p class="text-accent-green text-sm mb-3">Real Estate Agent</p>
                    <div class="flex justify-center items-center mb-3">
                        <div class="star-rating flex mr-2 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <span class="text-gray-400 text-sm">(4.6)</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">5 years experience • Luxury properties</p>
                    <div class="space-y-2">
                        <a href="tel:+251900123456" class="block text-sm text-gray-300 hover:text-accent-green transition-colors">
                            📞 +251 900 123 456
                        </a>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center space-x-2 mt-12">
                <button class="px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors disabled:opacity-50" disabled>
                    Previous
                </button>
                <button class="px-4 py-2 bg-accent-green text-dark-secondary rounded-lg font-semibold">1</button>
                <button class="px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors">2</button>
                <button class="px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors">3</button>
                <span class="px-2 text-gray-400">...</span>
                <button class="px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors">8</button>
                <button class="px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors">
                    Next
                </button>
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="cta-section py-20 relative">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Want to become an agent on our platform?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Join our network of professional real estate agents and grow your business with PropertyHub's advanced tools and extensive client base.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-accent-green text-dark-secondary px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                        Join as an Agent
                    </button>
                    <button class="border-2 border-accent-green text-accent-green px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent-green hover:text-dark-secondary transition-colors">
                        Learn More
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark-primary border-t border-gray-700 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-accent-green rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-accent-green">PropertyHub</span>
                        </div>
                        <p class="text-gray-400 mb-6 max-w-md">Your trusted partner in real estate. Connecting buyers, sellers, and agents across Addis Ababa with innovative technology and professional service.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-dark-secondary rounded-lg flex items-center justify-center hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-secondary rounded-lg flex items-center justify-center hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-secondary rounded-lg flex items-center justify-center hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Properties</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Agents</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">FAQs</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>📍 Bole, Addis Ababa, Ethiopia</li>
                            <li>📞 +251 911 000 000</li>
                            <li>✉️ info@propertyhub.et</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 PropertyHub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Search functionality
        document.getElementById('agent-search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            console.log('Searching for:', searchTerm);
            // In a real application, this would filter the agents
        });

        // Filter functionality
        document.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', function() {
                console.log('Filter changed:', this.value);
                // In a real application, this would filter the agents
            });
        });

        // Agent profile buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('View Profile')) {
                button.addEventListener('click', function() {
                    const agentName = this.closest('.agent-card').querySelector('h3').textContent;
                    alert(`Opening profile for: ${agentName}`);
                });
            }
        });

        // Phone number links
        document.querySelectorAll('a[href^="tel:"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const phoneNumber = this.textContent.trim();
                alert(`Calling: ${phoneNumber}`);
            });
        });

        // CTA buttons
        document.querySelector('button').addEventListener('click', function() {
            if (this.textContent.includes('Join as an Agent')) {
                alert('Redirecting to agent registration form...');
            }
        });

        // Pagination
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.match(/^\d+$/)) {
                button.addEventListener('click', function() {
                    // Remove active class from all page buttons
                    document.querySelectorAll('button').forEach(btn => {
                        if (btn.textContent.match(/^\d+$/)) {
                            btn.className = 'px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors';
                        }
                    });
                    // Add active class to clicked button
                    this.className = 'px-4 py-2 bg-accent-green text-dark-secondary rounded-lg font-semibold';
                });
            }
        });

        // Social media links
        document.querySelectorAll('footer a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Social media link clicked');
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'976135dc548ffbc6',t:'MTc1NjM1Njg2My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
