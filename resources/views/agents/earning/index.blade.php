<x-agent-dashboard.dashboard-layout>
    
    <div class="p-2 space-y-6">
        <!-- Earnings Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Earnings -->
            <div class="earnings-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00ff88] to-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#12181f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <span class="text-xs text-[#00ff88] font-medium">+12.5%</span>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-2">Total Earnings</h3>
                <p class="text-2xl font-bold text-white counter" data-target="2847500">ETB 0</p>
                <div class="mt-3 bg-gray-700 rounded-full h-2">
                    <div class="progress-bar h-2 rounded-full" style="width: 0%" data-width="78%"></div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="earnings-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-yellow-400 font-medium">3 pending</span>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-2">Pending Payments</h3>
                <p class="text-2xl font-bold text-white counter" data-target="485000">ETB 0</p>
                <p class="text-xs text-gray-400 mt-2">Expected: Dec 30, 2024</p>
            </div>

            <!-- Completed Payments -->
            <div class="earnings-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-xs text-green-400 font-medium">15 deals</span>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-2">Completed Payments</h3>
                <p class="text-2xl font-bold text-white counter" data-target="2362500">ETB 0</p>
                <p class="text-xs text-gray-400 mt-2">Last payment: Dec 15, 2024</p>
            </div>

            <!-- Current Month -->
            <div class="earnings-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-blue-400 font-medium">December</span>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-2">Current Month</h3>
                <p class="text-2xl font-bold text-white counter" data-target="675000">ETB 0</p>
                <div class="mt-3 bg-gray-700 rounded-full h-2">
                    <div class="progress-bar h-2 rounded-full" style="width: 0%" data-width="65%"></div>
                </div>
            </div>
        </div>

        <!-- Charts and Commission Summary Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Earnings Chart -->
            <div class="lg:col-span-3 earning-chart-container rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold">Earnings Trend</h2>
                    <div class="flex space-x-2">
                        {{-- <button class="px-3 py-1 bg-[#00ff88] text-[#12181f] rounded-lg text-sm font-medium">Weekly</button> --}}
                        <button class="px-3 py-1 bg-[#00ff88] text-[#12181f] rounded-lg text-sm font-medium">Monthly</button>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="earningsChart"></canvas>
                </div>
            </div>

            <!-- Commission Summary -->
            {{-- <div class="earnings-card rounded-2xl p-6">
                <h2 class="text-xl font-bold mb-6">Commission Summary</h2>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-400 text-sm">Commission Rate</span>
                            <span class="text-[#00ff88] font-bold">3.5%</span>
                        </div>
                        <div class="bg-gray-700 rounded-full h-2">
                            <div class="bg-[#00ff88] h-2 rounded-full" style="width: 35%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-400 text-sm">Total Commission</span>
                            <span class="text-white font-bold">ETB 2,847,500</span>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-400 text-sm">Closed Deals</span>
                            <span class="text-white font-bold">18</span>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-400 text-sm">Avg. Deal Value</span>
                            <span class="text-white font-bold">ETB 4.2M</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-600">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-[#00ff88]">Top 5%</p>
                            <p class="text-xs text-gray-400">Agent Ranking</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Payout Section -->
        <div class="payout-card rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">Payout Management</h2>
                    <p class="text-gray-400 text-sm">Last payout: ETB 1,250,000 on Dec 15, 2024</p>
                    <p class="text-gray-400 text-sm">Next scheduled payout: Dec 30, 2024</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400 mb-2">Available for payout</p>
                    <p class="text-2xl font-bold text-[#00ff88] mb-4">ETB 485,000</p>
                    <button class="bg-[#00ff88] text-[#12181f] px-6 py-3 rounded-xl font-semibold hover:bg-green-400 transition-colors" id="requestPayoutBtn">
                        Request Payout
                    </button>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="transaction-table rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold">Transaction History</h2>
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Search transactions..." class="bg-[#12181f] border border-gray-600 rounded-lg px-4 py-2 pl-10 text-white placeholder-gray-400 focus:border-[#00ff88] focus:outline-none" id="transactionSearch">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <!-- Status Filter -->
                    <select class="bg-[#12181f] border border-gray-600 rounded-lg px-4 py-2 text-white focus:border-[#00ff88] focus:outline-none" id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Property</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Buyer Name</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Amount</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                        
                        <tr class="transaction-row border-b border-gray-700" data-status="pending">
                            <td class="py-4 px-4 text-white">Dec 18, 2024</td>
                            <td class="py-4 px-4 text-white">Modern Apartment - Bole</td>
                            <td class="py-4 px-4 text-white">Meron Bekele</td>
                            <td class="py-4 px-4 text-white font-semibold">ETB 157,500</td>
                            <td class="py-4 px-4">
                                <span class="status-pending px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                            </td>
                        </tr>
                        <tr class="transaction-row border-b border-gray-700" data-status="paid">
                            <td class="py-4 px-4 text-white">Dec 15, 2024</td>
                            <td class="py-4 px-4 text-white">Family House - CMC</td>
                            <td class="py-4 px-4 text-white">Selamawit Mulu</td>
                            <td class="py-4 px-4 text-white font-semibold">ETB 210,000</td>
                            <td class="py-4 px-4">
                                <span class="status-paid px-3 py-1 rounded-full text-xs font-medium">Paid</span>
                            </td>
                        </tr>
                        @for ($i = 0; $i < 5; $i++)
                            <x-agent-dashboard.earnings-table-row />
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <p class="text-gray-400 text-sm">Showing 1-7 of 18 transactions</p>
                <div class="flex items-center space-x-2">
                    <button class="pagination-button px-3 py-2 rounded-lg text-sm font-medium bg-gray-600 text-gray-300">Previous</button>
                    <button class="pagination-button active px-3 py-2 rounded-lg text-sm font-medium">1</button>
                    <button class="pagination-button px-3 py-2 rounded-lg text-sm font-medium bg-gray-600 text-gray-300">2</button>
                    <button class="pagination-button px-3 py-2 rounded-lg text-sm font-medium bg-gray-600 text-gray-300">3</button>
                    <button class="pagination-button px-3 py-2 rounded-lg text-sm font-medium bg-gray-600 text-gray-300">Next</button>
                </div>
            </div>
        </div>
    </div>
</x-agent-dashboard.dashboard-layout>