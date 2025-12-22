<x-agent-dashboard.dashboard-layout>
@vite(['resources/js/agents/property'])
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
        <h1 class="text-4xl font-bold mb-2">Search and filter properties</h1>
        {{-- <p class="text-gray-400 text-lg">Manage all the properties you have listed</p> --}}
    </div>
    <button class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-semibold hover:bg-green-400 transition-all duration-300 shadow-lg hover:shadow-xl mt-4 md:mt-0"
            onclick="window.location = 'properties/create'">
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
        <form method="GET" action="{{ route('agent.properties.index') }}">
            <div class="content-card rounded-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">

                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">

                        <!-- Status -->
                        <select name="status"
                            class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white">
                            <option value="all">All Status</option>
                            @foreach (['approved', 'pending', 'rejected', 'sold'] as $status)
                                <option value="{{ $status }}" @selected(request('status') === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Type -->
                        <select name="type"
                            class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white">
                            <option value="all">All Types</option>
                            @foreach (['house', 'apartment', 'land', 'commercial'] as $type)
                                <option value="{{ $type }}" @selected(request('type') === $type)>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Search -->
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search properties..."
                            class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white w-full sm:w-64"
                        />
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="bg-[#00ff88] text-[#12181f] px-6 py-3 ml-2 rounded-xl font-semibold hover:bg-green-400">
                        Filter
                    </button>

                </div>
            </div>
        </form>

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
                    <x-agent_dashboard.property-row :data="$property" />
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

{{-- property view modal --}}
<div class="propertyModal flex justify-center items-center" id="propertyModal">
    <div class="propertyModal-content p-6 w-full max-w-4xl mx-4">
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
                {{-- the images will be populated here --}}
            </div>

            <!-- Property Info -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-xl font-bold text-white mb-2" id="modalTitle"></h3>
                    <p class="text-gray-400" id="modalDescription"></p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Location</p>
                        <p class="text-white font-medium" id="modalLocation"></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Price</p>
                        <p class="text-[#00ff88] font-bold text-xl" id="modalPrice">
                            ETB
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Property Type</p>
                        <p class="text-white font-medium" id="modalType"></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Status</p>
                        <span class="status-badge px-1 py-0.5 rounded-md" id="modalStatus"></span>
                    </div>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Agent Information</p>
                    <div class="flex items-center space-x-3 mt-2">
                        <div class="w-10 h-10 bg-[#00ff88] rounded-full flex items-center justify-center text-[#12181f] font-bold">
                            {{-- agent profile here --}}
                            <img src="" alt="" class="w-full h-full rounded-full object-cover agent-image">
                        </div>
                        <div>
                            <p class="text-white font-medium" id="modalAgent"></p>
                            <p class="text-gray-400 text-sm">Licensed Real Estate Agent</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="flex items-center space-x-3 pt-4">
                    <button class="px-6 py-2 rounded-lg text-[#12181f] font-semibold bg-green-400 hover:bg-green-400/50 hover:cursor-pointer" id="modalApprove">
                        Approve Property
                    </button>
                    <button class="btn-reject action-btn px-6 py-2 bg-red-600 rounded-lg hover:bg-red-600/50 hover:cursor-pointer" id="modalReject">
                        Reject Property
                    </button>
                </div> --}}
            </div>
        </div>
    </div>
</div>

</x-agent-dashboard.dashboard-layout>