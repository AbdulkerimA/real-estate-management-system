<x-admin-dashboard.main-layout>
    <div class="p-6 space-y-6">
    <!-- Welcome Message -->
    {{-- <div class="dashboard-card rounded-2xl p-6">
        <h1 class="text-3xl font-bold text-white mb-2">Welcome back, Admin</h1>
        <p class="text-gray-400">Here's what's happening with your property sales system today.</p>
    </div> --}}

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <x-admin-dashboard.status-card themeColor="green" statusNum="1247" title="Total Properties Listed">
            @slot("subtitle")
                ↗ +12% from last month
            @endslot
            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </x-admin-dashboard.status-card>

        <x-admin-dashboard.status-card themeColor="green" statusNum="89" title="Verified Agents">
            @slot("subtitle")
                ↗ +5% from last month
            @endslot
            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </x-admin-dashboard.status-card>

        <x-admin-dashboard.status-card themeColor="green" statusNum="2156" title="Active Buyers">
            @slot("subtitle")
                ↗ +18% from last month
            @endslot
            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </x-admin-dashboard.status-card>


        <x-admin-dashboard.status-card themeColor="green" statusNum="12.4M" title="Total Revenue">
            @slot("subtitle")
                ↗ +24% from last month
            @endslot
            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
            </svg>
        </x-admin-dashboard.status-card>

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Earnings Chart -->
        <x-admin-dashboard.charts.zig-zag-chart title="Monthly Revenue"/>
        <!-- Property Sales Chart -->
        <x-admin-dashboard.charts.bar-chart title="Property Sales by Catagory" />
    </div>

    <!-- Agent Performance Chart -->
    <div class="dashboard-card rounded-2xl p-6">
        <h3 class="text-xl font-bold mb-4">Agent Performance Distribution</h3>
        <x-admin-dashboard.charts.doghnut-chart />
    </div>

    <!-- Recent Activity & Quick Actions -->
    {{-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 dashboard-card rounded-2xl p-6">
            <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
            <div class="space-y-4">
                <div class="activity-item">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">New Property Listed</p>
                            <p class="text-gray-400 text-sm">3-bedroom apartment in Bole by Sara Tadesse</p>
                            <p class="text-gray-500 text-xs">2 minutes ago</p>
                        </div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">New Agent Registration</p>
                            <p class="text-gray-400 text-sm">Michael Johnson submitted verification documents</p>
                            <p class="text-gray-500 text-xs">15 minutes ago</p>
                        </div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">New Buyer Registration</p>
                            <p class="text-gray-400 text-sm">Aisha Mohammed created an account</p>
                            <p class="text-gray-500 text-xs">1 hour ago</p>
                        </div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">Payment Verified</p>
                            <p class="text-gray-400 text-sm">₹2,50,000 payment confirmed for Property #1234</p>
                            <p class="text-gray-500 text-xs">2 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-card rounded-2xl p-6">
            <h3 class="text-xl font-bold mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button class="action-button w-full py-3 rounded-lg text-[#12181f] font-semibold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add New Property
                </button>
                
                <button class="action-button w-full py-3 rounded-lg text-[#12181f] font-semibold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Verify Agent
                </button>
                
                <button class="action-button w-full py-3 rounded-lg text-[#12181f] font-semibold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Generate Report
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Transactions Table -->
    @php
        $title = 'Recent Transactions';
        $headers = ['Date','User','Property','Amount','status','Actions'];
        $filters = [
            'byStatus'=>['all status','paid','pending','faild'],
        ];
        
    @endphp
    <x-admin-dashboard.table 
        :title="$title"
        :headers="$headers"
        :filters="$filters"
    />
    {{-- <div class="dashboard-card rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold">Recent Transactions</h3>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Search transactions..." class="search-input px-4 py-2 rounded-lg text-white text-sm" id="transactionSearch">
                <select class="search-input px-4 py-2 rounded-lg text-white text-sm">
                    <option>All Status</option>
                    <option>Paid</option>
                    <option>Pending</option>
                    <option>Failed</option>
                </select>
            </div>
        </div>
        
        <div class="table-container">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-600">
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">User</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Property</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Amount</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row border-b border-gray-700">
                        <td class="py-3 px-4 text-white">Jan 15, 2025</td>
                        <td class="py-3 px-4 text-white">Aisha Mohammed</td>
                        <td class="py-3 px-4 text-white">3BR Apartment - Bole</td>
                        <td class="py-3 px-4 text-white">₹2,50,000</td>
                        <td class="py-3 px-4"><span class="status-badge status-paid">Paid</span></td>
                        <td class="py-3 px-4">
                            <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                        </td>
                    </tr>
                    <tr class="table-row border-b border-gray-700">
                        <td class="py-3 px-4 text-white">Jan 15, 2025</td>
                        <td class="py-3 px-4 text-white">David Wilson</td>
                        <td class="py-3 px-4 text-white">Commercial Space - CMC</td>
                        <td class="py-3 px-4 text-white">₹5,00,000</td>
                        <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                        <td class="py-3 px-4">
                            <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                        </td>
                    </tr>
                    <tr class="table-row border-b border-gray-700">
                        <td class="py-3 px-4 text-white">Jan 14, 2025</td>
                        <td class="py-3 px-4 text-white">Sarah Johnson</td>
                        <td class="py-3 px-4 text-white">Villa - Kazanchis</td>
                        <td class="py-3 px-4 text-white">₹8,75,000</td>
                        <td class="py-3 px-4"><span class="status-badge status-paid">Paid</span></td>
                        <td class="py-3 px-4">
                            <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                        </td>
                    </tr>
                    <tr class="table-row border-b border-gray-700">
                        <td class="py-3 px-4 text-white">Jan 14, 2025</td>
                        <td class="py-3 px-4 text-white">Ahmed Hassan</td>
                        <td class="py-3 px-4 text-white">Land Plot - Lebu</td>
                        <td class="py-3 px-4 text-white">₹1,20,000</td>
                        <td class="py-3 px-4"><span class="status-badge status-failed">Failed</span></td>
                        <td class="py-3 px-4">
                            <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <p class="text-gray-400 text-sm">Showing 1-4 of 156 transactions</p>
            <div class="flex items-center space-x-2">
                <button class="pagination-button rounded">Previous</button>
                <button class="pagination-button active rounded">1</button>
                <button class="pagination-button rounded">2</button>
                <button class="pagination-button rounded">3</button>
                <button class="pagination-button rounded">Next</button>
            </div>
        </div>
    </div> --}}
</div>
</x-admin-dashboard.main-layout>