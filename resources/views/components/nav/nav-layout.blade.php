<nav class="bg-[#1c252e]/95 backdrop-blur-sm fixed top-0 w-full z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="text-2xl font-bold text-[#00ff88]">AnchorHomes</div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <x-nav.link href="/properties">Properties</x-nav.link>
                        {{-- <x-nav.link href="/inves">Invest</x-nav.link> --}}
                        <x-nav.link href="/agents">Agents</x-nav.link>
                        <x-nav.link href="/about">About</x-nav.link>
                        <x-nav.link href="/login">Login</x-nav.link>
                    </div>
                </div>
                <div class="hidden md:block">
                    <button
                    onclick="()=>{window.location('/signup')}" 
                    class="bg-[#00ff88] text-[#12181f] px-6 py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                        Get Started
                    </button>
                </div>
                <div class="md:hidden">
                    <button class="text-gray-300 hover:text-[#00ff88]">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>