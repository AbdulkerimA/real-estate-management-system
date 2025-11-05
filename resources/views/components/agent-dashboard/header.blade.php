@php
    $pathTitles = [
        'dashboard' => [
            'title' => 'Dashboard',
            'subtitle' => 'manage everything from here'
        ],
        'dashboard/home' => [
            'title' => 'Dashboard',
            'subtitle' => 'manage everything from here'
        ],
        'dashboard/properties' => [
            'title' => 'properties',
            'subtitle' => 'Manage all the properties you have listed'
        ],
        'dashboard/appointments' => [
            'title' => 'Appointments',
            'subtitle' => 'View and manage all scheduled property viewings'
        ],
        'dashboard/earnings' => [
            'title' => 'Earning',
            'subtitle' => 'Track your commissions and income'
        ],
        'dashboard/profile' => [
            'title' => 'My Profile',
            'subtitle' => 'Manage your account and professional details'
        ],
        'dashboard/profile/edit' => [
            'title' => 'Edit your Profile',
            'subtitle' => 'Manage your account and professional details'
        ],
        'dashboard/settings' => [
            'title' => 'Settings',
            'subtitle' => 'Manage your account and system preferences'
        ],
        'dashboard/property/create' => [
            'title' => 'Add New Property',
            'subtitle' => 'Enter property details to create a new listing'
        ],
        
    ];
    $path = request()->path();
    // 
@endphp

<header class="bg-[#1c252e] border-b border-gray-700 px-6 py-4 sticky top-0 z-20">
    <div class="flex items-center justify-between">
        <!-- Mobile Menu Button -->
        <button class="lg:hidden text-gray-300 hover:text-[#00ff88]" id="mobileMenuBtn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold">
                {{ $pathTitles[$path]['title'] }}
            </h1>
            <p class="text-gray-400 text-sm">
                {{ $pathTitles[$path]['subtitle'] }}
            </p>
        </div>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            {{-- <div class="relative">
                <button class="text-gray-300 hover:text-[#00ff88] relative p-2" id="notificationBtn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-[#00ff88] text-[#12181f] text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">3</span>
                </button>
                <!-- Notification Dropdown -->
                <div class="dropdown absolute right-0 mt-2 w-80 rounded-xl shadow-2xl hidden" id="notificationDropdown">
                    <div class="p-4">
                        <h3 class="text-lg font-bold mb-4">Notifications</h3>
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3 p-3 rounded-lg bg-[#12181f]">
                                <div class="w-2 h-2 bg-[#00ff88] rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <p class="text-sm font-medium">New appointment scheduled</p>
                                    <p class="text-xs text-gray-400">Abebe Mekuria - Luxury Apartment</p>
                                    <p class="text-xs text-gray-500">2 minutes ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 rounded-lg bg-[#12181f]">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <p class="text-sm font-medium">Property inquiry received</p>
                                    <p class="text-xs text-gray-400">Modern Villa - Kazanchis</p>
                                    <p class="text-xs text-gray-500">1 hour ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 rounded-lg bg-[#12181f]">
                                <div class="w-2 h-2 bg-yellow-400 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <p class="text-sm font-medium">Commission payment processed</p>
                                    <p class="text-xs text-gray-400">ETB 15,000 deposited</p>
                                    <p class="text-xs text-gray-500">3 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-4 text-[#00ff88] hover:text-green-400 text-sm font-semibold">
                            View All Notifications
                        </button>
                    </div>
                </div>
            </div> --}}

            <!-- Profile -->
            @php
                $user = Auth::user();
                // dd($user->agentProfile->media->file_path);
            @endphp
            <div class="relative">
                <button class="flex items-center space-x-3 text-gray-300 hover:text-[#00ff88]" id="profileBtn">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00ff88] to-green-600 rounded-full flex items-center justify-center text-[#12181f] font-bold">
                        <img src="{{ asset('storage/'.$user->agentProfile->media->file_path) }}" 
                            alt="{{ $user->name[0] }}"
                            class="w-full h-full object-cover rounded-full m-1"
                            >
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold">Sara Tadesse</p>
                        <p class="text-xs text-gray-400">Senior Agent</p>
                    </div>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <!-- Profile Dropdown -->
                <div class="dropdown absolute right-0 mt-2 w-56 rounded-xl shadow-2xl hidden" id="profileDropdown">
                    <div class="p-2">
                        {{-- <div class="px-4 py-3 border-b border-gray-600">
                            <p class="font-semibold">Sara Tadesse</p>
                            <p class="text-sm text-gray-400">sara.tadesse@propertyhub.com</p>
                        </div> --}}
                        <a href="/dashboard/profile/" class="block px-4 py-3 text-sm hover:bg-[#12181f] rounded-lg mt-2">
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
                        <div class="flex items-center px-3 py-2 text-red-400 hover:bg-gray-700 rounded">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <button type="submit" form="logout">
                                Logout
                            </button>
                        </div>
                        <form action="/logout" method="post" id="logout" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>