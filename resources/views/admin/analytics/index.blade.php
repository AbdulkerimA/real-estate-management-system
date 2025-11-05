<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/analytics.css','resources/js/admin-js/analytics.js']) 
    <!-- Page Content -->
    <div class="p-6 space-y-6">
        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-6 gap-6">
            <!-- Total Properties -->
            <x-admin-dashboard.status-card 
                themeColor="green" 
                statusNum="{{ Number::format($allProperties) }}" 
                title="Total Properties"
                >
                @slot("subtitle")
                    <p class="text-xs text-green-400 mt-1">+15.2% this month</p>
                @endslot
                <svg class="w-5 h-5 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </x-admin-dashboard.status-card>

            <!-- Properties Sold -->
            <x-admin-dashboard.status-card 
                themeColor="blue" 
                statusNum="{{ Number::format($soldProperties) }}" 
                title="Properties Sold"
                >
                @slot("subtitle")
                    <p class="text-xs text-blue-400 mt-1">+8.7% this month</p>
                @endslot
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            <!-- Active Agents -->
            <x-admin-dashboard.status-card 
                themeColor="purple" 
                statusNum="{{ Number::format($agents) }}" 
                title="Active Agents"
                >
                @slot("subtitle")
                    <p class="text-xs text-purple-400 mt-1">+12 new agents</p>
                @endslot
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            <!-- Active Buyers -->
            <x-admin-dashboard.status-card 
                themeColor="orange" 
                statusNum="{{ Number::format($customers) }}" 
                title="Active Buyers"
                >
                @slot("subtitle")
                    <p class="text-xs text-orange-400 mt-1">+23.4% this month</p>
                @endslot
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </x-admin-dashboard.status-card>

            <!-- Total Revenue -->
            <x-admin-dashboard.status-card 
                themeColor="green" 
                statusNum="{{Number::format(2847500)}}" 
                title="Total Revenue"
                >
                @slot("subtitle")
                    <p class="text-xs text-green-400 mt-1">+18.9% this month</p>
                @endslot
                <svg class="w-5 h-5 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </x-admin-dashboard.status-card>

            <!-- Pending Approvals -->
            <x-admin-dashboard.status-card 
                themeColor="yellow" 
                statusNum="{{Number::format(23)}}" 
                title="Pending Approvals">
                @slot("subtitle")
                    <p class="text-xs text-yellow-400 mt-1">Requires attention</p>
                @endslot
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Revenue Growth Chart -->
            {{-- <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Revenue Growth</h3>
                        <p class="text-gray-400 text-sm">Monthly revenue trends</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="export-button px-3 py-1 rounded text-[#12181f] text-sm font-medium" onclick="exportChart('revenue')">
                            Export
                        </button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div> --}}
            <x-admin-dashboard.charts.zig-zag-chart :data="$monthlyRevenue" title="Revenue Growth" subTitle="Monthly revenue trends"/>

            <!-- Properties by Category Chart -->
            {{-- <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Properties by Category</h3>
                        <p class="text-gray-400 text-sm">Sales distribution by property type</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="export-button px-3 py-1 rounded text-[#12181f] text-sm font-medium" onclick="exportChart('category')">
                            Export
                        </button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div> --}}
            <x-admin-dashboard.charts.bar-chart :data="$propertiesByCatagory" title="Properties by Category" subTitle="Sales distribution by property type"/>
        </div>

        <!-- Agent Performance & Market Share -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Agent Market Share -->
            {{-- <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Agent Market Share</h3>
                        <p class="text-gray-400 text-sm">Top performing agents by sales volume</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="export-button px-3 py-1 rounded text-dark-secondary text-sm font-medium" onclick="exportChart('agents')">
                            Export
                        </button>
                    </div>
                </div>
                <div class="small-chart-container">
                    <canvas id="agentChart"></canvas>
                </div>
            </div> --}}
            <x-admin-dashboard.charts.doghnut-chart 
                :data="$topAgents"
                title="Agent Market Share" 
                subTitle="Top performing agents by sales volume"/>

            <!-- Location Heatmap -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Properties by Location</h3>
                        <p class="text-gray-400 text-sm">Addis Ababa neighborhoods activity</p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($propertiesByLocation as $item)

                        @if ($item->count >= 30)
                            <div class="heatmap-cell bg-[#00ff88]/80 rounded p-3 text-center" data-value="45">
                                <p class="text-xs font-medium text-[#12181f]">{{ $item->address }}</p>
                                <p class="text-sm font-bold text-[#12181f]">{{ $item->count }}</p>
                            </div>
                        @elseif ($item->count >= 20)
                            <div class="heatmap-cell bg-[#00ff88]/40 rounded p-3 text-center" data-value="45">
                                <p class="text-xs font-medium text-white">{{ $item->address }}</p>
                                <p class="text-sm font-bold text-white">{{ $item->count }}</p>
                            </div>
                        @else
                            <div class="heatmap-cell bg-[#00ff88]/30 rounded p-3 text-center" data-value="45">
                                <p class="text-xs font-medium text-white">{{ $item->address }}</p>
                                <p class="text-sm font-bold text-white">{{ $item->count }}</p>
                            </div>
                        @endif
                        
                    @endforeach
                    
                    {{-- <div class="heatmap-cell bg-[#00ff88]/60 rounded p-3 text-center" data-value="32">
                        <p class="text-xs font-medium text-white">CMC</p>
                        <p class="text-sm font-bold text-white">32</p>
                    </div>
                    <div class="heatmap-cell bg-[#00ff88]/40 rounded p-3 text-center" data-value="28">
                        <p class="text-xs font-medium text-white">Kazanchis</p>
                        <p class="text-sm font-bold text-white">28</p>
                    </div>
                    <div class="heatmap-cell bg-[#00ff88]/70 rounded p-3 text-center" data-value="38">
                        <p class="text-xs font-medium text-[#12181f]">Piassa</p>
                        <p class="text-sm font-bold text-[#12181f]">38</p>
                    </div>
                    <div class="heatmap-cell bg-[#00ff88]/50 rounded p-3 text-center" data-value="25">
                        <p class="text-xs font-medium text-white">Megenagna</p>
                        <p class="text-sm font-bold text-white">25</p>
                    </div>
                    <div class="heatmap-cell bg-[#00ff88]/30 rounded p-3 text-center" data-value="18">
                        <p class="text-xs font-medium text-white">Gerji</p>
                        <p class="text-sm font-bold text-white">18</p>
                    </div>
                    <div class="heatmap-cell bg-[#00ff88]/35 rounded p-3 text-center" data-value="22">
                        <p class="text-xs font-medium text-white">Sarbet</p>
                        <p class="text-sm font-bold text-white">22</p>
                    </div>
                    <div class="heatmap-cell bg-[#00ff88]/25 rounded p-3 text-center" data-value="15">
                        <p class="text-xs font-medium text-white">Kirkos</p>
                        <p class="text-sm font-bold text-white">15</p>
                    </div> --}}
                </div>
            </div>
        </div>
        

        <!-- Agent Performance Rankings -->
        <div class="dashboard-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-white">Top Performing Agents</h3>
                    <p class="text-gray-400 text-sm">Rankings based on sales volume and client satisfaction</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="export-button px-4 py-2 rounded text-[#12181f] text-sm font-medium" onclick="exportAgentReport()">
                        Export Report
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $i = 1; 
                @endphp
                @foreach ($topAgents as $agent)
                    <div class="agent-rank rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="rank-badge rank-1">{{ $i++ }}</div>
                                <div>
                                    <p class="text-white font-semibold">{{ $agent->agent_name}}</p>
                                    <p class="text-gray-400 text-sm">Senior Agent</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[#00ff88] font-bold">₹1,250,000</p>
                                <p class="text-gray-400 text-xs">{{ $agent->deals_closed }} sales</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Client Satisfaction</span>
                                <span class="text-[#00ff88]">4.9/5</span>
                            </div>
                            <div class="progress-bar h-2">
                                <div class="progress-fill" style="width: 98%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>

        <!-- Buyer Activity Insights -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="insight-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Most Active Buyers</h3>
                        <p class="text-gray-400 text-sm">Top buyers by engagement and purchases</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-[#1c252e] rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                            <div>
                                <p class="text-white font-medium">John Doe</p>
                                <p class="text-gray-400 text-sm">Premium Buyer</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[#00ff88] font-bold">5 Purchases</p>
                            <p class="text-gray-400 text-xs">28 Bookmarks</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-[#1c252e] rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                                SA
                            </div>
                            <div>
                                <p class="text-white font-medium">Sarah Ahmed</p>
                                <p class="text-gray-400 text-sm">Active Buyer</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[#00ff88] font-bold">3 Purchases</p>
                            <p class="text-gray-400 text-xs">45 Bookmarks</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-[#1c252e] rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold">
                                MT
                            </div>
                            <div>
                                <p class="text-white font-medium">Michael Thompson</p>
                                <p class="text-gray-400 text-sm">Investor</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[#00ff88] font-bold">2 Purchases</p>
                            <p class="text-gray-400 text-xs">67 Bookmarks</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Buyer Engagement</h3>
                        <p class="text-gray-400 text-sm">Bookmarks vs Purchases conversion</p>
                    </div>
                </div>
                <div class="small-chart-container">
                    <canvas id="buyerChart"></canvas>
                </div>
            </div> --}}
            <x-admin-dashboard.charts.double-bar title="Buyer Engagement" subTitle="Bookmarks vs Purchases conversion"/> 
        </div>

        <!-- Detailed Reports Section -->
        {{-- <div class="dashboard-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-white">Generated Reports</h3>
                    <p class="text-gray-400 text-sm">Download and manage system reports</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Search reports..." class="search-input pl-10 pr-4 py-2 rounded-lg text-white text-sm w-64" id="reportSearch">
                    </div>
                    <button class="export-button px-4 py-2 rounded text-[#12181f] text-sm font-medium" onclick="generateNewReport()">
                        Generate New Report
                    </button>
                </div>
            </div>

            <div class="report-table">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Report Type</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Description</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Generated By</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Size</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row border-b border-gray-700">
                            <td class="py-3 px-4 text-gray-300">Jan 15, 2025</td>
                            <td class="py-3 px-4">
                                <span class="bg-blue-400/20 text-blue-400 px-2 py-1 rounded text-xs font-medium">
                                    Monthly Sales
                                </span>
                            </td>
                            <td class="py-3 px-4 text-white">December 2024 Sales Performance Report</td>
                            <td class="py-3 px-4 text-gray-300">Admin User</td>
                            <td class="py-3 px-4 text-gray-300">2.4 MB</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewReport('report-1')">View</button>
                                    <button class="action-btn btn-download" onclick="downloadReport('report-1', 'pdf')">PDF</button>
                                    <button class="action-btn btn-download" onclick="downloadReport('report-1', 'csv')">CSV</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700">
                            <td class="py-3 px-4 text-gray-300">Jan 10, 2025</td>
                            <td class="py-3 px-4">
                                <span class="bg-green-400/20 text-green-400 px-2 py-1 rounded text-xs font-medium">
                                    Agent Performance
                                </span>
                            </td>
                            <td class="py-3 px-4 text-white">Q4 2024 Agent Rankings and Commissions</td>
                            <td class="py-3 px-4 text-gray-300">System Auto</td>
                            <td class="py-3 px-4 text-gray-300">1.8 MB</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewReport('report-2')">View</button>
                                    <button class="action-btn btn-download" onclick="downloadReport('report-2', 'pdf')">PDF</button>
                                    <button class="action-btn btn-download" onclick="downloadReport('report-2', 'excel')">Excel</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row border-b border-gray-700">
                            <td class="py-3 px-4 text-gray-300">Jan 5, 2025</td>
                            <td class="py-3 px-4">
                                <span class="bg-purple-400/20 text-purple-400 px-2 py-1 rounded text-xs font-medium">
                                    Financial Summary
                                </span>
                            </td>
                            <td class="py-3 px-4 text-white">2024 Annual Financial Report</td>
                            <td class="py-3 px-4 text-gray-300">Finance Team</td>
                            <td class="py-3 px-4 text-gray-300">5.2 MB</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button class="action-btn btn-view" onclick="viewReport('report-3')">View</button>
                                    <button class="action-btn btn-download" onclick="downloadReport('report-3', 'pdf')">PDF</button>
                                    <button class="action-btn btn-download" onclick="downloadReport('report-3', 'excel')">Excel</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}

        <!-- Export Options -->
        <div class="dashboard-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-white">Export & Download Options</h3>
                    <p class="text-gray-400 text-sm">Export current analytics data in various formats</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- pdf button --}}
                <button class="export-button p-4 rounded-xl text-[#12181f] font-medium flex items-center justify-center space-x-2" onclick="exportData('pdf')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Export as PDF</span>
                </button>

                <button class="export-button p-4 rounded-xl text-[#12181f] font-medium flex items-center justify-center space-x-2" onclick="exportData('excel')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Export as Excel</span>
                </button>
                {{-- csv button --}}
                {{-- <button class="export-button p-4 rounded-xl text-[#12181f] font-medium flex items-center justify-center space-x-2" onclick="exportData('csv')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <span>Export as CSV</span>
                </button> --}}
            </div>
        </div>
    </div>
</x-admin-dashboard.main-layout>