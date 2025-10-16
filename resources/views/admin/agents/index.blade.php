<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/agents.css','resources/js/admin-js/agents.js']) 
    <!-- Page Content -->
    <div class="p-6 space-y-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Total Agents --}}
            <x-admin-dashboard.status-card themeColor="green" statusNum="342" title="Total Agents">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2
                            c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857
                            M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002
                            0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2
                            0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Verified Agents --}}
            <x-admin-dashboard.status-card themeColor="green" statusNum="298" title="Verified Agents">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Pending Verification --}}
            <x-admin-dashboard.status-card themeColor="yellow" statusNum="31" title="Pending Verification">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Suspended Agents --}}
            <x-admin-dashboard.status-card themeColor="red" statusNum="13" title="Suspended Agents">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636
                            m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                </svg>
            </x-admin-dashboard.status-card>

        </div>

        <!-- Bulk Actions Bar -->
        <div class="bulk-actions rounded-lg p-4 mb-4" id="bulkActions">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-white font-medium" id="selectedCount">0 agents selected</span>
                    <div class="flex items-center space-x-2">
                        <button class="btn-verify action-btn" id="bulkVerify">Verify Selected</button>
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

        <!-- Agents Table -->
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
                    <tbody id="agentsTableBody">
                        <tr class="table-row border-b border-gray-700" data-agent-id="1">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom agent-checkbox" value="1">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    ST
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Sara Tadesse</p>
                                    <p class="text-gray-400 text-sm">5 years experience</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">sara.tadesse@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-123456</td>
                            <td class="py-3 px-4 text-[#00ff88] font-semibold">23</td>
                            <td class="py-3 px-4"><span class="status-badge status-verified">Verified</span></td>
                            <td class="py-3 px-4">
                                <div class="flex w-40 items-center flex-wrap space-x-2 gap-2">
                                    <button class="action-btn btn-view" onclick="viewAgent(1)">View Profile</button>
                                    <button class="action-btn btn-suspend" onclick="suspendAgent(1)">Suspend</button>
                                    <button class="action-btn btn-delete" onclick="deleteAgent(1)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-agent-id="2">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom agent-checkbox" value="2">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    MJ
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Michael Johnson</p>
                                    <p class="text-gray-400 text-sm">3 years experience</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">michael.j@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-789012</td>
                            <td class="py-3 px-4 text-[#00ff88] font-semibold">18</td>
                            <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                            <td class="py-3 px-4">
                                <div class="flex w-40 items-center flex-wrap space-x-2 gap-2">
                                    <button class="action-btn btn-view" onclick="viewAgent(2)">View Profile</button>
                                    <button class="action-btn btn-verify" onclick="verifyAgent(2)">Verify</button>
                                    <button class="action-btn btn-delete" onclick="deleteAgent(2)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-agent-id="3">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom agent-checkbox" value="3">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    AM
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Aisha Mohammed</p>
                                    <p class="text-gray-400 text-sm">7 years experience</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">aisha.m@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-345678</td>
                            <td class="py-3 px-4 text-[#00ff88] font-semibold">31</td>
                            <td class="py-3 px-4"><span class="status-badge status-verified">Verified</span></td>
                            <td class="py-3 px-4">
                                <div class="flex w-40 items-center flex-wrap space-x-2 gap-2">
                                    <button class="action-btn btn-view" onclick="viewAgent(3)">View Profile</button>
                                    <button class="action-btn btn-suspend" onclick="suspendAgent(3)">Suspend</button>
                                    <button class="action-btn btn-delete" onclick="deleteAgent(3)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-agent-id="4">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom agent-checkbox" value="4">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    DW
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">David Wilson</p>
                                    <p class="text-gray-400 text-sm">2 years experience</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">david.wilson@email.com</td>
                            <td class="py-3 px-4 text-white">+251-911-567890</td>
                            <td class="py-3 px-4 text-[#00ff88] font-semibold">8</td>
                            <td class="py-3 px-4"><span class="status-badge status-suspended">Suspended</span></td>
                            <td class="py-3 px-4">
                                <div class="flex w-40 items-center flex-wrap space-x-2 gap-2">
                                    <button class="action-btn btn-view" onclick="viewAgent(4)">View Profile</button>
                                    <button class="action-btn btn-verify" onclick="verifyAgent(4)">Reactivate</button>
                                    <button class="action-btn btn-delete" onclick="deleteAgent(4)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->

        </div>
    </div>

    <!-- Agent Profile Preview Modal -->
    <div class="modal" id="modal">
        <div class="modal-content p-6 w-full max-w-5xl mx-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Agent Profile</h2>
                <button class="text-gray-400 hover:text-white" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Agent Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Photo -->
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                            ST
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2" id="modalName">Sara Tadesse</h3>
                        <span class="status-badge status-verified" id="modalStatus">Verified</span>
                    </div>

                    <!-- Contact Info -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">Contact Information</h4>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-300 text-sm" id="modalEmail">sara.tadesse@email.com</span>
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

                    <!-- Experience & Rating -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">Professional Info</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-400 text-sm">Experience</p>
                                <p class="text-white font-medium" id="modalExperience">5 years</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Rating</p>
                                <div class="flex items-center space-x-2">
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <span class="text-white text-sm">4.8 (127 reviews)</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Properties Listed</p>
                                <p class="text-[#00ff88] font-bold text-xl" id="modalProperties">23</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <button class="action-button w-full px-4 py-3 rounded-lg text-[#12181f] font-semibold" id="modalVerify">
                            Verify Agent
                        </button>
                        <button class="btn-suspend action-btn w-full px-4 py-3" id="modalSuspend">
                            Suspend Agent
                        </button>
                    </div>
                </div>

                <!-- Agent Details & Properties -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Bio -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-3">About</h4>
                        <p class="text-gray-300 text-sm leading-relaxed" id="modalBio">
                            Experienced real estate agent with over 5 years in the Ethiopian property market. Specializes in residential and commercial properties in Addis Ababa. Known for excellent customer service and deep market knowledge. Licensed and certified with the Ethiopian Real Estate Association.
                        </p>
                    </div>

                    <!-- Recent Properties -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-4">Recent Properties Listed</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Luxury 3BR Apartment</p>
                                        <p class="text-gray-400 text-xs">Bole, Addis Ababa</p>
                                        <p class="text-[#00ff88] font-semibold text-sm">₹2,50,000</p>
                                    </div>
                                </div>
                            </div>

                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Modern Office Space</p>
                                        <p class="text-gray-400 text-xs">CMC, Addis Ababa</p>
                                        <p class="text-[#00ff88] font-semibold text-sm">₹1,80,000</p>
                                    </div>
                                </div>
                            </div>

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
                                        <p class="text-[#00ff88] font-semibold text-sm">₹95,000</p>
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
                                        <p class="text-[#00ff88] font-semibold text-sm">₹4,20,000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Reviews -->
                    <div class="dashboard-card rounded-xl p-4">
                        <h4 class="text-white font-semibold mb-4">Recent Reviews</h4>
                        <div class="space-y-4">
                            <div class="border-b border-gray-600 pb-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            AB
                                        </div>
                                        <span class="text-white font-medium text-sm">Abebe Bekele</span>
                                    </div>
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                </div>
                                <p class="text-gray-300 text-sm">Excellent service! Sara helped me find the perfect apartment in Bole. Very professional and knowledgeable about the market.</p>
                            </div>

                            <div class="border-b border-gray-600 pb-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            MH
                                        </div>
                                        <span class="text-white font-medium text-sm">Meron Haile</span>
                                    </div>
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star empty">★</span>
                                    </div>
                                </div>
                                <p class="text-gray-300 text-sm">Great experience working with Sara. She was very responsive and helped negotiate a good price for our office space.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-dashboard.main-layout>

