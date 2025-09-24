<x-agent-dashboard.dashboard-layout>

<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
        <h1 class="text-4xl font-bold mb-2">Search and filter properties</h1>
        {{-- <p class="text-gray-400 text-lg">Manage all the properties you have listed</p> --}}
    </div>
    <button class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-semibold hover:bg-green-400 transition-all duration-300 shadow-lg hover:shadow-xl mt-4 md:mt-0">
        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Add Property
    </button>
</div>

<!-- Filters and View Toggle -->
<div class="content-card rounded-2xl p-6 mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
        <!-- Filters -->
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <!-- Status Filter -->
            <div class="filter-dropdown">
                <select class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-[#00ff88] focus:outline-none focus:ring-2 focus:ring-[#00ff88] focus:ring-opacity-20" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>

            <!-- Type Filter -->
            <div class="filter-dropdown">
                <select class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-[#00ff88] focus:outline-none focus:ring-2 focus:ring-[#00ff88] focus:ring-opacity-20" id="typeFilter">
                    <option value="all">All Types</option>
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="land">Land</option>
                    <option value="commercial">Commercial</option>
                </select>
            </div>

            <!-- Search -->
            <div class="relative">
                <input type="text" placeholder="Search properties..." class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 pl-12 text-white placeholder-gray-400 focus:border-[#00ff88] focus:outline-none focus:ring-2 focus:ring-[#00ff88] focus:ring-opacity-20 w-full sm:w-64" id="propertySearch">
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="flex items-center space-x-2 bg-[#12181f] rounded-xl p-1">
            <button class="view-toggle active px-4 py-2 rounded-lg font-medium transition-all" id="tableViewBtn">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Table
            </button>
            <button class="view-toggle px-4 py-2 rounded-lg font-medium transition-all text-gray-400" id="cardViewBtn">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Cards
            </button>
        </div>
    </div>
</div>

<!-- Properties Table View -->
<div class="content-card rounded-2xl p-6 mb-8" id="tableView">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="text-left py-4 px-2 font-semibold">Property</th>
                    <th class="text-left py-4 px-2 font-semibold">Location</th>
                    <th class="text-left py-4 px-2 font-semibold">Price</th>
                    <th class="text-left py-4 px-2 font-semibold">Status</th>
                    <th class="text-left py-4 px-2 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="propertiesTableBody">
                @foreach ($properties as $property)
                    <x-agent-dashboard.table-row  :data="$property"/>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Properties Card View -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8 hidden" id="cardView">
        @foreach ($properties as $property)
            <x-agent-dashboard.property-card :data="$property" />
        @endforeach
    {{-- <div class="property-card rounded-2xl overflow-hidden" data-status="sold" data-type="house">
        <div class="property-image h-48 flex items-center justify-center">
            <svg class="w-16 h-16 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-3">
                <span class="status-sold px-3 py-1 rounded-full text-xs font-semibold">Sold</span>
                <span class="text-2xl font-bold text-red-400">ETB 8.2M</span>
            </div>
            <h3 class="text-xl font-bold mb-2">Modern Villa in Kazanchis</h3>
            <p class="text-gray-400 mb-4">Kazanchis, Addis Ababa • 5 bed, 4 bath</p>
            <div class="flex space-x-3">
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="view">View</button>
                <button class="flex-1 bg-[#00ff88] hover:bg-green-400 text-[#12181f] py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="edit">Edit</button>
                <button class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="delete">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="property-card rounded-2xl overflow-hidden" data-status="pending" data-type="apartment">
        <div class="property-image h-48 flex items-center justify-center">
            <svg class="w-16 h-16 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-3">
                <span class="status-pending px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                <span class="text-2xl font-bold text-yellow-400">ETB 3.8M</span>
            </div>
            <h3 class="text-xl font-bold mb-2">Family House in CMC</h3>
            <p class="text-gray-400 mb-4">CMC, Addis Ababa • 4 bed, 3 bath</p>
            <div class="flex space-x-3">
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="view">View</button>
                <button class="flex-1 bg-[#00ff88] hover:bg-green-400 text-[#12181f] py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="edit">Edit</button>
                <button class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="delete">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="property-card rounded-2xl overflow-hidden" data-status="available" data-type="commercial">
        <div class="property-image h-48 flex items-center justify-center">
            <svg class="w-16 h-16 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 21h18M5 21V7l8-4v18M19 21V10l-6-3"/>
            </svg>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-3">
                <span class="status-available px-3 py-1 rounded-full text-xs font-semibold">Available</span>
                <span class="text-2xl font-bold text-[#00ff88]">ETB 12M</span>
            </div>
            <h3 class="text-xl font-bold mb-2">Commercial Building in Piassa</h3>
            <p class="text-gray-400 mb-4">Piassa, Addis Ababa • Office space</p>
            <div class="flex space-x-3">
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="view">View</button>
                <button class="flex-1 bg-[#00ff88] hover:bg-green-400 text-[#12181f] py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="edit">Edit</button>
                <button class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="delete">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="property-card rounded-2xl overflow-hidden" data-status="available" data-type="land">
        <div class="property-image h-48 flex items-center justify-center">
            <svg class="w-16 h-16 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
            </svg>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-3">
                <span class="status-available px-3 py-1 rounded-full text-xs font-semibold">Available</span>
                <span class="text-2xl font-bold text-[#00ff88]">ETB 2.5M</span>
            </div>
            <h3 class="text-xl font-bold mb-2">Residential Land in Lebu</h3>
            <p class="text-gray-400 mb-4">Lebu, Addis Ababa • 1000 sqm</p>
            <div class="flex space-x-3">
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="view">View</button>
                <button class="flex-1 bg-[#00ff88] hover:bg-green-400 text-[#12181f] py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="edit">Edit</button>
                <button class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors property-action" data-action="delete">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div> --}}
</div>

<!-- Pagination -->
{{-- <div class="content-card rounded-2xl p-6">
    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
        <div class="flex items-center space-x-4">
            <span class="text-gray-400">Showing 1-5 of 12 properties</span>
            <div class="filter-dropdown">
                <select class="bg-[#12181f] border border-gray-600 rounded-lg px-3 py-2 text-white text-sm">
                    <option value="5">5 per page</option>
                    <option value="10">10 per page</option>
                    <option value="20">20 per page</option>
                </select>
            </div>
        </div>
        
        <div class="flex items-center space-x-2">
            <button class="pagination-btn px-4 py-2 rounded-lg border border-gray-600 text-gray-400 hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                Previous
            </button>
            <button class="pagination-btn active px-4 py-2 rounded-lg">1</button>
            <button class="pagination-btn px-4 py-2 rounded-lg text-gray-400 hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">2</button>
            <button class="pagination-btn px-4 py-2 rounded-lg text-gray-400 hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">3</button>
            <button class="pagination-btn px-4 py-2 rounded-lg border border-gray-600 text-gray-400 hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                Next
            </button>
        </div>
    </div>
</div> --}}
{{-- <x-dashboard-pagination /> --}}
{{ $properties->links('vendor.pagination.dashboard-pagination') }}
</x-agent-dashboard.dashboard-layout>