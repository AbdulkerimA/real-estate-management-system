<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/payment.css','resources/js/admin-js/payment.js'])
    <div class="p-6 space-y-6">
            <!-- Financial Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Revenue -->
                <x-admin-dashboard.status-card themeColor="green" statusNum="2847500" title="Total Revenue">
                    @slot("subtitle")
                        <p class="text-xs text-green-400 mt-1">+12.5% from last month</p>
                    @endslot
                    <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </x-admin-dashboard.status-card>

                <!-- Pending Payments -->
                <x-admin-dashboard.status-card themeColor="yellow" statusNum="156800" title="Pending Payments">
                    @slot("subtitle")
                        <p class="text-xs text-yellow-400 mt-1">23 transactions pending</p>
                    @endslot
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </x-admin-dashboard.status-card>

                <!-- Completed Transactions -->
                <x-admin-dashboard.status-card themeColor="green" statusNum="1847" title="Completed Transactions">
                    @slot("subtitle")
                        <p class="text-xs text-green-400 mt-1">+8.2% from last month</p>
                    @endslot
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </x-admin-dashboard.status-card>

                <!-- Refunds Issued -->
                <x-admin-dashboard.status-card themeColor="red" statusNum="45200" title="Refunds Issued">
                    @slot("subtitle")
                        <p class="text-xs text-red-400 mt-1">12 refunds this month</p>
                    @endslot
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/>
                    </svg>
                </x-admin-dashboard.status-card>

            </div>

            <!-- Revenue Chart -->
            <x-admin-dashboard.charts.zig-zag-chart title="Revenue Analytics" subTitle="Monthly revenue breakdown"/>
            
            <!-- Search and Filters -->

            <!-- Pending Approvals Section -->

            <!-- Payout Requests Section -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Agent Payout Requests</h3>
                        <p class="text-gray-400 text-sm">Commission payouts awaiting approval</p>
                    </div>
                    <span class="bg-blue-400/20 text-blue-400 px-3 py-1 rounded-full text-sm font-medium">
                        5 Requests
                    </span>
                </div>

                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Agent</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Amount Requested</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Commission From</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Date Requested</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            MJ
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Mike Johnson</p>
                                            <p class="text-gray-400 text-xs">Senior Agent</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-[#00ff88] font-semibold">₹45,000</td>
                                <td class="py-3 px-4 text-gray-300">3 Property Sales</td>
                                <td class="py-3 px-4 text-gray-300">Jan 15, 2025</td>
                                <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-approve" onclick="approvePayout('payout-1')">Approve</button>
                                        <button class="action-btn btn-reject" onclick="rejectPayout('payout-1')">Reject</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            LW
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Lisa Wilson</p>
                                            <p class="text-gray-400 text-xs">Property Specialist</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-[#00ff88] font-semibold">₹32,500</td>
                                <td class="py-3 px-4 text-gray-300">2 Property Sales</td>
                                <td class="py-3 px-4 text-gray-300">Jan 14, 2025</td>
                                <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-approve" onclick="approvePayout('payout-2')">Approve</button>
                                        <button class="action-btn btn-reject" onclick="rejectPayout('payout-2')">Reject</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Recent Transactions</h3>
                        <p class="text-gray-400 text-sm">Complete transaction history</p>
                    </div>
                </div>

                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Buyer</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Agent</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Property</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Amount</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Method</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="transactionsTableBody">
                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-gray-300">Jan 15, 2025</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            JD
                                        </div>
                                        <span class="text-white">John Doe</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            MJ
                                        </div>
                                        <span class="text-white">Mike Johnson</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white text-sm">Luxury 3BR Apartment</p>
                                        <p class="text-gray-400 text-xs">Bole, Addis Ababa</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-[#00ff88] font-semibold">₹2,50,000</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="payment-method-icon method-card text-[#00ff88]">💳</div>
                                        <span class="text-gray-300 text-sm">Credit Card</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4"><span class="status-badge status-completed">Completed</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewTransaction('tx-1')">View</button>
                                        <button class="action-btn btn-refund" onclick="refundTransaction('tx-1')">Refund</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-gray-300">Jan 14, 2025</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            SA
                                        </div>
                                        <span class="text-white">Sarah Ahmed</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            LW
                                        </div>
                                        <span class="text-white">Lisa Wilson</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white text-sm">Modern Office Space</p>
                                        <p class="text-gray-400 text-xs">CMC, Addis Ababa</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-accent-green font-semibold">₹1,80,000</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="payment-method-icon method-bank text-blue-400">🏦</div>
                                        <span class="text-gray-300 text-sm">Bank Transfer</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4"><span class="status-badge status-pending">Pending</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewTransaction('tx-2')">View</button>
                                        <button class="action-btn btn-verify" onclick="approvePayout('tx-2')">Verify</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-gray-300">Jan 13, 2025</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            MT
                                        </div>
                                        <span class="text-white">Michael Thompson</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            DJ
                                        </div>
                                        <span class="text-white">David Johnson</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white text-sm">Family Villa</p>
                                        <p class="text-gray-400 text-xs">Kazanchis, Addis Ababa</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-accent-green font-semibold">₹4,20,000</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="payment-method-icon method-mobile text-yellow-400">📱</div>
                                        <span class="text-gray-300 text-sm">Mobile Money</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4"><span class="status-badge status-completed">Completed</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewTransaction('tx-3')">View</button>
                                        <button class="action-btn btn-refund" onclick="refundTransaction('tx-3')">Refund</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row border-b border-gray-700">
                                <td class="py-3 px-4 text-gray-300">Jan 12, 2025</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            EW
                                        </div>
                                        <span class="text-white">Emily Wilson</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            AB
                                        </div>
                                        <span class="text-white">Alex Brown</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white text-sm">Studio Apartment</p>
                                        <p class="text-gray-400 text-xs">Piassa, Addis Ababa</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-red-400 font-semibold">-₹85,000</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="payment-method-icon method-card text-accent-green">💳</div>
                                        <span class="text-gray-300 text-sm">Credit Card</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4"><span class="status-badge status-refunded">Refunded</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="action-btn btn-view" onclick="viewTransaction('tx-4')">View</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
</x-admin-dashboard.main-layout>