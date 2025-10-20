<x-agent-dashboard.dashboard-layout>
@vite(['resources/js/agents/property'])
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
                <select class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-[#00ff88] focus:outline-none focus:ring-2 focus:ring-[#00ff88] focus:ring-opacity-20" id="apStatusFilter">
                    <option value="all">All Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">rejected</option>
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
            <button class="view-toggle px-4 py-2 rounded-lg font-medium transition-all" id="tableViewBtn">
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
                    <th class="text-left py-4 px-2 font-semibold hidden"> ID</th>
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
</div>

<!-- Pagination -->
{{ $properties->links('vendor.pagination.dashboard-pagination') }}

</x-agent-dashboard.dashboard-layout>