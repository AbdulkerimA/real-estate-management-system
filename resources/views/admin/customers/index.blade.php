<x-admin-dashboard.main-layout>
     @vite(['resources/css/admin-style/customers.css','resources/js/admin-js/customers.js']) 
    <!-- Page Content -->
    <div class="p-6 space-y-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-admin-dashboard.status-card themeColor="green-400" statusNum="1247" title="Total Buyers">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </x-admin-dashboard.status-card>

            <x-admin-dashboard.status-card themeColor="green" statusNum="1189" title="Active Buyers">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            <x-admin-dashboard.status-card themeColor="red" statusNum="58" title="Suspended Buyers">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                </svg>
            </x-admin-dashboard.status-card>

            <x-admin-dashboard.status-card themeColor="blue" statusNum="89" title="Recently Registered">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

        </div>

        <!-- Filters & Search -->
        {{-- <div class="dashboard-card rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="lg:col-span-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Search by name, email, or phone..." class="search-input w-full pl-10 pr-4 py-3 rounded-lg text-white" id="buyerSearch">
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <select class="filter-select w-full px-4 py-3 rounded-lg text-white" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>

                <!-- Registration Date Filter -->
                <div>
                    <select class="filter-select w-full px-4 py-3 rounded-lg text-white" id="dateFilter">
                        <option value="">Registration Date</option>
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>

                <!-- Location Filter -->
                <div>
                    <select class="filter-select w-full px-4 py-3 rounded-lg text-white" id="locationFilter">
                        <option value="">All Locations</option>
                        <option value="addis-ababa">Addis Ababa</option>
                        <option value="dire-dawa">Dire Dawa</option>
                        <option value="bahir-dar">Bahir Dar</option>
                        <option value="hawassa">Hawassa</option>
                        <option value="mekelle">Mekelle</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 flex items-center space-x-4">
                <button class="action-button px-4 py-2 rounded text-dark-secondary font-medium text-sm" id="applyFilters">
                    Apply Filters
                </button>
                <button class="text-gray-400 hover:text-green-400 text-sm" id="clearFilters">
                    Clear All
                </button>
            </div>
        </div> --}}

        <!-- Bulk Actions Bar -->
        <div class="bulk-actions rounded-lg p-4 mb-4" id="bulkActions">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-white font-medium" id="selectedCount">0 buyers selected</span>
                    <div class="flex items-center space-x-2">
                        <button class="btn-suspend action-btn" id="bulkSuspend">Suspend Selected</button>
                        <button class="btn-delete action-btn" id="bulkDelete">Delete Selected</button>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-white" id="clearSelection">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Buyers Table -->
        <div class="dashboard-card rounded-2xl p-6">
            <div class="table-container">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left py-3 px-4">
                                <input type="checkbox" class="checkbox-custom" id="selectAll">
                            </th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Photo</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Full Name</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Email</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Phone</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Properties</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="buyersTableBody">
                        <tr class="table-row border-b border-gray-700" data-buyer-id="1">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom buyer-checkbox" value="1">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    JD
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">John Doe</p>
                                    <p class="text-gray-400 text-sm">Joined Dec 2024</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">john.doe@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-123456</td>
                            <td class="py-3 px-4">
                                <div class="text-center">
                                    <p class="text-green-400 font-semibold">2</p>
                                    <p class="text-gray-400 text-xs">Purchased</p>
                                    <p class="text-blue-400 text-xs">5 Bookmarked</p>
                                </div>
                            </td>
                            <td class="py-3 px-4"><span class="status-badge status-active">Active</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewBuyer(1)">View Profile</button>
                                    <button class="action-btn btn-suspend" onclick="suspendBuyer(1)">Suspend</button>
                                    <button class="action-btn btn-delete" onclick="deleteBuyer(1)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-buyer-id="2">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom buyer-checkbox" value="2">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    SA
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Sarah Ahmed</p>
                                    <p class="text-gray-400 text-sm">Joined Nov 2024</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">sarah.ahmed@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-789012</td>
                            <td class="py-3 px-4">
                                <div class="text-center">
                                    <p class="text-green-400 font-semibold">1</p>
                                    <p class="text-gray-400 text-xs">Purchased</p>
                                    <p class="text-blue-400 text-xs">12 Bookmarked</p>
                                </div>
                            </td>
                            <td class="py-3 px-4"><span class="status-badge status-active">Active</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewBuyer(2)">View Profile</button>
                                    <button class="action-btn btn-suspend" onclick="suspendBuyer(2)">Suspend</button>
                                    <button class="action-btn btn-delete" onclick="deleteBuyer(2)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-buyer-id="3">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom buyer-checkbox" value="3">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    MT
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Michael Thompson</p>
                                    <p class="text-gray-400 text-sm">Joined Oct 2024</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">michael.t@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-345678</td>
                            <td class="py-3 px-4">
                                <div class="text-center">
                                    <p class="text-green-400 font-semibold">0</p>
                                    <p class="text-gray-400 text-xs">Purchased</p>
                                    <p class="text-blue-400 text-xs">8 Bookmarked</p>
                                </div>
                            </td>
                            <td class="py-3 px-4"><span class="status-badge status-suspended">Suspended</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewBuyer(3)">View Profile</button>
                                    <button class="action-btn btn-view" onclick="reactivateBuyer(3)">Reactivate</button>
                                    <button class="action-btn btn-delete" onclick="deleteBuyer(3)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-buyer-id="4">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom buyer-checkbox" value="4">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    EW
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Emily Wilson</p>
                                    <p class="text-gray-400 text-sm">Joined Jan 2025</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">emily.wilson@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-567890</td>
                            <td class="py-3 px-4">
                                <div class="text-center">
                                    <p class="text-green-400 font-semibold">3</p>
                                    <p class="text-gray-400 text-xs">Purchased</p>
                                    <p class="text-blue-400 text-xs">15 Bookmarked</p>
                                </div>
                            </td>
                            <td class="py-3 px-4"><span class="status-badge status-active">Active</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewBuyer(4)">View Profile</button>
                                    <button class="action-btn btn-suspend" onclick="suspendBuyer(4)">Suspend</button>
                                    <button class="action-btn btn-delete" onclick="deleteBuyer(4)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
        </div>
    </div>

    <div class="modal" id="buyerModal">
        <div class="modal-content p-6 w-full max-w-5xl mx-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Buyer Profile</h2>
                <button class="text-gray-400 hover:text-white" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Buyer Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Photo -->
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                            JD
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2" id="modalName">John Doe</h3>
                        <span class="status-badge status-active" id="modalStatus">Active</span>
                    </div>

                    <!-- Contact Info -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">Contact Information</h4>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalEmail">john.doe@email.com</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalPhone">+251-911-123456</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalLocation">Addis Ababa, Ethiopia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Account Stats -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">Account Statistics</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-400 text-sm">Member Since</p>
                                <p class="text-white font-medium" id="modalJoinDate">December 2024</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Properties Purchased</p>
                                <p class="text-accent-green font-bold text-xl" id="modalPurchased">2</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Bookmarked Properties</p>
                                <p class="text-blue-400 font-bold text-xl" id="modalBookmarked">5</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <button class="btn-suspend action-btn w-full px-4 py-3" id="modalSuspend">
                            Suspend Account
                        </button>
                        <button class="btn-delete action-btn w-full px-4 py-3" id="modalDelete">
                            Delete Account
                        </button>
                    </div>
                </div>

                <!-- Purchase History & Bookmarks -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Purchase History -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-4">Purchase History</h4>
                        <div class="space-y-3">
                            <div class="purchase-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm">Luxury 3BR Apartment</p>
                                            <p class="text-gray-400 text-xs">Bole, Addis Ababa</p>
                                            <p class="text-gray-400 text-xs">Purchased: Dec 15, 2024</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-accent-green font-semibold">₹2,50,000</p>
                                        <span class="text-xs text-green-400 bg-green-400/20 px-2 py-1 rounded">Completed</span>
                                    </div>
                                </div>
                            </div>

                            <div class="purchase-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm">Modern Office Space</p>
                                            <p class="text-gray-400 text-xs">CMC, Addis Ababa</p>
                                            <p class="text-gray-400 text-xs">Purchased: Nov 28, 2024</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-accent-green font-semibold">₹1,80,000</p>
                                        <span class="text-xs text-green-400 bg-green-400/20 px-2 py-1 rounded">Completed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bookmarked Properties -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-4">Bookmarked Properties</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Residential Land</p>
                                        <p class="text-gray-400 text-xs">Lebu, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹95,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Family Villa</p>
                                        <p class="text-gray-400 text-xs">Kazanchis, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹4,20,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Studio Apartment</p>
                                        <p class="text-gray-400 text-xs">Piassa, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹85,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Commercial Building</p>
                                        <p class="text-gray-400 text-xs">Merkato, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹6,50,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Townhouse</p>
                                        <p class="text-gray-400 text-xs">Old Airport, Addis Ababa</p>
                                        <p class="text-accent-green font-semibold text-sm">₹3,20,000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-dashboard.main-layout>