<x-agent-dashboard.dashboard-layout >
    <script>
        const monthlyEarnings = @json($monthlyEarnings)
    </script>
    <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold mb-2">Welcome back, {{Auth::User()->name}}! 👋</h1>
                <p class="text-gray-400 text-lg">Here's what's happening with your properties today.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Properties Listed -->
                <x-agent-dashboard.status-card 
                    themeColor="green" 
                    statusNum="{{ Number::format($propertiesCount) }}" 
                    notifier="+2 this week">
                    
                    <svg class="w-7 h-7 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>

                    @slot("statusText")
                        Properties Listed
                    @endslot

                </x-agent-dashboard.status-card>
                
                <!-- Active Appointments -->
                <x-agent-dashboard.status-card 
                    themeColor="blue" 
                    statusNum="{{ $balance->current_balance }}" 
                    currency="ETB"
                    notifier="3 today">
                    
                    <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>

                    @slot("statusText")
                        current balacne
                    @endslot

                </x-agent-dashboard.status-card>

                <!-- Messages -->
                <x-agent-dashboard.status-card 
                    themeColor="purple" 
                    statusNum="{{ Number::format($totalCheckout) }}" 
                    notifier="5 unread">
                    
                    <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>

                    @slot("statusText")
                        total checkout
                    @endslot

                </x-agent-dashboard.status-card>
                

                 <!-- Earnings -->
                <x-agent-dashboard.status-card 
                    themeColor="yellow" 
                    statusNum="{{ Number::format($pendingCheckout) }}" 
                    notifier="+15%">
                    
                    <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>

                    @slot("statusText")
                        pending checkouts
                    @endslot

                </x-agent-dashboard.status-card>

            </div>

            <div class="grid grid-cols-1 gap-8">
                <!-- Properties Section -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Properties Table -->
                    <div class="content-card rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold">Top 3 latest Properties</h2>
                            <button class="bg-[#00ff88] text-[#12181f] px-6 py-3 rounded-xl font-semibold hover:bg-green-400 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Add Property
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-600">
                                        <th class="text-left py-4 px-2 font-semibold">Property</th>
                                        <th class="text-left py-4 px-2 font-semibold">Status</th>
                                        <th class="text-left py-4 px-2 font-semibold">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestProperties as $property)
                                        <tr class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors">
                                            <td class="py-4 px-2">
                                                <div class="flex items-center space-x-4">
                                                    <div class="property-image w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0">
                                                        <img src="{{ asset('storage/'.$property->getFirstImage()) }}" 
                                                             alt="image of {{ $property->title[0] }}" />
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-lg">{{ $property->title }}</p>
                                                        <p class="text-sm text-gray-400">
                                                            {{ $property->location }} <br />
                                                            • {{ $property->details->bed_rooms }} bed, 
                                                            {{ $property->details->bath_rooms }} bath
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-2">
                                                <span class="status-{{ $property->status  }} px-4 py-2 rounded-full text-sm font-semibold">
                                                    {{ $property->status }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-2">
                                                <span class="font-bold text-lg">ETB {{ Number::format($property->price) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Performance Chart -->
                    <div class="content-card rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold">Monthly Earnings Performance</h2>
                        </div>
                        <div class="chart-container">
                            <canvas id="dashboardChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <!-- Upcoming Appointments -->
                    <div class="content-card rounded-2xl p-6">
                        <h2 class="text-xl font-bold mb-6">Upcoming Appointments</h2>
                        <div class="space-y-4">
                            @foreach ($appointments as $ap )
                                <div class="flex items-center space-x-4 p-4 bg-[#12181f] rounded-xl hover:bg-opacity-80 transition-colors cursor-pointer">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-sm font-bold">
                                        <image src="{{ asset('storage/'.$ap->property->getFirstImage()) }}"
                                                alt="PI" 
                                                class="w-full h-full object-cover rounded-full"/>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold">{{ $ap->buyer?->name }}</p>
                                        <p class="text-sm text-gray-400">{{ $ap->property?->title }} - {{ $ap->property?->location }}</p>
                                        <p class="text-sm text-[#00ff88] font-medium">{{ $ap->scheduled_date }}, {{ $ap->scheduled_time }}</p>
                                    </div>
                                    <button class="text-[#00ff88] hover:text-green-400 p-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                            
                        </div>
                        <button class="w-full mt-6 text-[#00ff88] hover:text-green-400 font-semibold py-2">
                            View All Appointments
                        </button>
                    </div>
                </div>
            </div>
</x-agent-dashboard.dashboard-layout>
 