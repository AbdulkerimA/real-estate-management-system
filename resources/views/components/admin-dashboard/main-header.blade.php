@php
    $pathTitles = [
        'admin' => [
            'title' => 'Welcome back',
            'subtitle' => "Here's what's happening with your property sales system today."
        ],
        'admin/home' => [
            'title' => 'Welcome back',
            'subtitle' => "Here's what's happening with your property sales system today."
        ],
        'admin/properties' => [
            'title' => 'Manage Properties',
            'subtitle' => 'Manage all the properties you have listed'
        ],
        'admin/agents' => [
            'title' => 'Manage Agents',
            'subtitle' => 'View, verify, and manage all registered agents'
        ],
        'admin/customers' => [
            'title' => 'Manage Customers',
            'subtitle' => 'View and manage all registered buyers'
        ],
        'admin/transactions' => [
            'title' => 'Payment & Transactions',
            'subtitle' => 'View and manage all payment activities across the platform'
        ],
        'admin/analytics' => [
            'title' => 'Reports & Analytics',
            'subtitle' => 'View system performance and generate detailed reports'
        ],
        'admin/profile/edit' => [
            'title' => 'Edit your Profile',
            'subtitle' => 'Manage your account and professional details'
        ],
        'admin/profile' => [
            'title' => 'Manage your Profile',
            'subtitle' => 'Manage your account and professional details'
        ],
        'admin/settings' => [
            'title' => 'Settings',
            'subtitle' => 'Manage your account and system preferences'
        ],
        'admin/property/create' => [
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
            <!-- Profile -->
            <div class="relative">
                <button class="flex items-center space-x-3 text-gray-300 hover:text-[#00ff88]" id="profileBtn">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#00ff88] to-green-600 rounded-full flex items-center justify-center text-[#12181f] font-bold">
                        AD
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold">Admin User</p>
                        <p class="text-xs text-gray-400">System Administrator</p>
                    </div>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <!-- Profile Dropdown -->
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="p-2">
                        <a href="/profile" class="flex items-center px-3 py-2 text-gray-300 hover:text-[#00ff88] hover:bg-gray-700 rounded">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </a>
                        <a href="/admin/settings" class="flex items-center px-3 py-2 text-gray-300 hover:text-[#00ff88] hover:bg-gray-700 rounded">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>
                        <hr class="my-2 border-gray-600">
                        <a href="#" class="flex items-center px-3 py-2 text-red-400 hover:bg-gray-700 rounded">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <button type="submit" form="logout">
                                Logout
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>