@vite(['resources/js/navProfile.js'])
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
                        <x-nav.link href="/">Home</x-nav.link>
                        <x-nav.link href="/properties">Properties</x-nav.link>
                        <x-nav.link href="/schedules">Appointments</x-nav.link>
                        <x-nav.link href="/agents">Agents</x-nav.link>
                        <x-nav.link href="/about">About us</x-nav.link>
                        <x-nav.link href="/faq">FAQs</x-nav.link>
                        @guest
                            <x-nav.link href="/login">Login</x-nav.link>
                        @endguest
                    </div>
                </div>

                {{-- if the user is loged in display the following --}}
                @auth
                    <div class="relative hidden md:block">
                        <button class="flex items-center space-x-3 text-gray-300 hover:text-[#00ff88]" id="profileBtn">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#00ff88] to-green-600 rounded-full flex items-center justify-center text-[#12181f] font-bold">
                                <img src="" alt="">
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">welcome</p>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <!-- Profile Dropdown -->
                        <div class="dropdown absolute right-0 mt-2 w-56 rounded-xl shadow-2xl hidden bg-[#1a1f27]" id="profileDropdown">
                            <div class="p-2">
                                {{-- <div class="px-4 py-3 border-b border-gray-600">
                                    <p class="font-semibold">Sara Tadesse</p>
                                    <p class="text-sm text-gray-400">sara.tadesse@propertyhub.com</p>
                                </div> --}}
                                <a href="/profile/id" class="block px-4 py-3 text-sm hover:bg-[#12181f] rounded-lg mt-2">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    View Profile
                                </a>
                                <a href="/dashboard/settings/" class="block px-4 py-3 text-sm hover:bg-[#12181f] rounded-lg">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Account Settings
                                </a>
                                <a href="/support" class="block px-4 py-3 text-sm hover:bg-[#12181f] rounded-lg">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Help & Support
                                </a>
                                <hr class="my-2 border-gray-600">
                                <button type="logout" form="logoutForm" class="w-full block px-1 py-3 text-sm text-red-400 hover:bg-[#12181f] rounded-lg">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                                <form action="/logout" method="post" class="hidden" id="logoutForm">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

            {{-- if the user is not loged in display the get started button --}}

                @guest
                <div class="hidden md:block">
                    <button
                    onclick="()=>{window.location('/signup')}" 
                    class="bg-[#00ff88] text-[#12181f] px-6 py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                        Get Started
                    </button>
                </div>
                @endguest
                
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