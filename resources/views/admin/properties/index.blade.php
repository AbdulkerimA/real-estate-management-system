<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/properties.css','resources/js/admin-js/properties.js']) 
    <!-- Page Content -->
    <div class="p-6 space-y-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <x-admin-dashboard.status-card themeColor="green" statusNum="1247" title="Total Properties Listed">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Pending Approvals --}}
            <x-admin-dashboard.status-card themeColor="yellow" statusNum="23" title="Pending Approvals">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Approved Properties --}}
            <x-admin-dashboard.status-card themeColor="green" statusNum="1156" title="Approved Properties">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Sold Properties --}}
            <x-admin-dashboard.status-card themeColor="purple" statusNum="68" title="Sold Properties">
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2
                            m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1
                            c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </x-admin-dashboard.status-card>

        </div>

        <!-- Bulk Actions Bar -->
        <div class="bulk-actions rounded-lg p-4 mb-4" id="bulkActions">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-white font-medium" id="selectedCount">0 properties selected</span>
                    <div class="flex items-center space-x-2">
                        <button class="btn-approve action-btn" id="bulkApprove">Approve Selected</button>
                        <button class="btn-reject action-btn" id="bulkReject">Reject Selected</button>
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

        <!-- Properties Table -->
        <div class="dashboard-card rounded-2xl p-6">
            <div class="table-container">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left py-3 px-4">
                                <input type="checkbox" class="checkbox-custom" id="selectAll">
                            </th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Image</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Title</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Location</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Price</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Agent</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="propertiesTableBody">
                        <tr class="table-row border-b border-gray-700" data-property-id="1">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom property-checkbox" value="1">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Luxury 3BR Apartment</p>
                                    <p class="text-gray-400 text-sm">Modern amenities, city view</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">Bole, Addis Ababa</td>
                            <td class="py-3 px-4 text-white font-semibold">₹2,50,000</td>
                            <td class="py-3 px-4 text-white">Sara Tadesse</td>
                            <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewData(1)">View</button>
                                    <button class="action-btn btn-approve" onclick="approve(1)">Approve</button>
                                    <button class="action-btn btn-reject" onclick="reject(1)">Reject</button>
                                    <button class="action-btn btn-edit" onclick="edit(1)">Edit</button>
                                    <button class="action-btn btn-delete" onclick="deleteAction(1)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-property-id="2">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom property-checkbox" value="2">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Family Villa with Garden</p>
                                    <p class="text-gray-400 text-sm">5 bedrooms, swimming pool</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">Kazanchis, Addis Ababa</td>
                            <td class="py-3 px-4 text-white font-semibold">₹8,75,000</td>
                            <td class="py-3 px-4 text-white">Michael Johnson</td>
                            <td class="py-3 px-4"><span class="status-badge status-approved">Approved</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewData(2)">View</button>
                                    <button class="action-btn btn-edit" onclick="edit(2)">Edit</button>
                                    <button class="action-btn btn-delete" onclick="deleteAction(2)">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-property-id="3">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom property-checkbox" value="3">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Commercial Office Space</p>
                                    <p class="text-gray-400 text-sm">Prime location, parking available</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">CMC, Addis Ababa</td>
                            <td class="py-3 px-4 text-white font-semibold">₹5,00,000</td>
                            <td class="py-3 px-4 text-white">Aisha Mohammed</td>
                            <td class="py-3 px-4"><span class="status-badge status-sold">Sold</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewData(3)">View</button>
                                    <button class="action-btn btn-edit" onclick="edit(3)">Edit</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700" data-property-id="4">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="checkbox-custom property-checkbox" value="4">
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="text-white font-medium">Residential Land Plot</p>
                                    <p class="text-gray-400 text-sm">500 sqm, ready for construction</p>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-white">Lebu, Addis Ababa</td>
                            <td class="py-3 px-4 text-white font-semibold">₹1,20,000</td>
                            <td class="py-3 px-4 text-white">David Wilson</td>
                            <td class="py-3 px-4"><span class="status-badge status-rejected">Rejected</span></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewData(4)">View</button>
                                    <button class="action-btn btn-approve" onclick="approve(4)">Approve</button>
                                    <button class="action-btn btn-edit" onclick="edit(4)">Edit</button>
                                    <button class="action-btn btn-delete" onclick="deleteAction(4)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <p class="text-gray-400 text-sm">Showing 1-4 of 1,247 properties</p>
                <div class="flex items-center space-x-2">
                    <button class="pagination-button rounded">Previous</button>
                    <button class="pagination-button active rounded">1</button>
                    <button class="pagination-button rounded">2</button>
                    <button class="pagination-button rounded">3</button>
                    <button class="pagination-button rounded">...</button>
                    <button class="pagination-button rounded">312</button>
                    <button class="pagination-button rounded">Next</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Property Preview Modal -->
    <div class="modal flex justify-center items-center" id="modal">
        <div class="modal-content p-6 w-full max-w-4xl mx-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Property Details</h2>
                <button class="text-gray-400 hover:text-white" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Property Image -->
                <div class="space-y-4 keen-slider zoom-out" id="my-keen-slider">
                    <div class="keen-slider__slide zoom-out__slide w-full h-64 rounded-lg flex items-center justify-center">
                        <div>
                            <img
                                src="https://images.unsplash.com/photo-1590004953392-5aba2e72269a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=500&w=800&q=80"
                            />
                        </div>
                    </div>
                    <div class="keen-slider__slide zoom-out__slide w-full h-64 rounded-lg flex items-center justify-center">
                        <div>
                            <img
                                src="https://images.unsplash.com/photo-1590004845575-cc18b13d1d0a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=500&w=800&q=80"
                            />
                        </div>
                    </div>
                    <div class="keen-slider__slide zoom-out__slide w-full h-64 rounded-lg flex items-center justify-center">
                        <div>
                            <img
                                src="https://images.unsplash.com/photo-1590004987778-bece5c9adab6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=500&w=800&q=80"
                            />
                        </div>
                    </div>
                </div>

                <!-- Property Info -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2" id="modalTitle">Luxury 3BR Apartment</h3>
                        <p class="text-gray-400" id="modalDescription">Modern amenities with stunning city views. This luxury apartment features spacious rooms, high-end finishes, and premium location access.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">Location</p>
                            <p class="text-white font-medium" id="modalLocation">Bole, Addis Ababa</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Price</p>
                            <p class="text-[#00ff88] font-bold text-xl" id="modalPrice">₹2,50,000</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Property Type</p>
                            <p class="text-white font-medium" id="modalType">Apartment</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Status</p>
                            <span class="status-badge status-pending" id="modalStatus">Pending</span>
                        </div>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm">Agent Information</p>
                        <div class="flex items-center space-x-3 mt-2">
                            <div class="w-10 h-10 bg-[#00ff88] rounded-full flex items-center justify-center text-[#12181f] font-bold">
                                ST
                            </div>
                            <div>
                                <p class="text-white font-medium" id="modalAgent">Sara Tadesse</p>
                                <p class="text-gray-400 text-sm">Licensed Real Estate Agent</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 pt-4">
                        <button class="action-button px-6 py-2 rounded-lg text-[#12181f] font-semibold" id="modalApprove">
                            Approve Property
                        </button>
                        <button class="btn-reject action-btn px-6 py-2" id="modalReject">
                            Reject Property
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-dashboard.main-layout>