<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/payment.css','resources/js/admin-js/payment.js'])
    <div class="p-6 space-y-6">
            <!-- Financial Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Revenue -->
                <x-admin-dashboard.status-card 
                    themeColor="green" 
                    statusNum="{{ Number::format($pendingTransactions) }} ETB" 
                    title="Total Revenue"
                    >
                    @slot("subtitle")
                        <p class="text-xs text-green-400 mt-1">+12.5% from last month</p>
                    @endslot
                    <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </x-admin-dashboard.status-card> 

                <!-- Pending Payments -->
                <x-admin-dashboard.status-card 
                    themeColor="yellow" 
                    statusNum="{{ Number::format($pendingTransactions) }}" 
                    title="Pending Payments"
                    >
                    @slot("subtitle")
                        <p class="text-xs text-yellow-400 mt-1">{{ $pendingTransactions }} transactions pending</p>
                    @endslot
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </x-admin-dashboard.status-card>

                <!-- Completed Transactions -->
                <x-admin-dashboard.status-card 
                    themeColor="green" 
                    statusNum="{{ Number::format($completedTransactions) }}" 
                    title="Completed Transactions"
                    >
                    @slot("subtitle")
                        <p class="text-xs text-green-400 mt-1">+8.2% from last month</p>
                    @endslot
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </x-admin-dashboard.status-card>

                <!-- Refunds Issued -->
                <x-admin-dashboard.status-card 
                    themeColor="red" 
                    statusNum="{{ Number::format($refundIssued) }}" 
                    title="Refunds Issued"
                    >
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
            <x-admin-dashboard.charts.zig-zag-chart :data="$monthlyTransactions" title="Revenue Analytics" subTitle="Monthly revenue breakdown"/>
            
            <!-- Search and Filters -->

            <!-- Pending Approvals Section -->

            <!-- Payout Requests Section -->
            <div class="dashboard-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex gap-4 items-center">
                        <div class="">
                            <h3 class="text-xl font-bold text-white">Agent Payout Requests</h3>
                            <p class="text-gray-400 text-sm">Commission payouts awaiting approval</p>
                        </div>
                        <span class="bg-blue-400/20 text-blue-400 px-3 py-1 rounded-full text-sm font-medium hidden lg:block">
                            {{ count($checkOuts) }} Requests
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-4">
                        <input
                            type="text"
                            id="payoutSearch"
                            placeholder="Search agent..."
                            class="px-4 py-2 rounded-lg bg-[#12181f] border border-gray-600 text-white w-72"
                        >

                        <select
                            id="payoutStatus"
                            class="px-4 py-2 rounded-lg bg-[#12181f] border border-gray-600 text-white"
                        >
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Agent</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Amount Requested</th>
                                {{-- <th class="text-left py-3 px-4 text-gray-400 font-medium">Commission From</th> --}}
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Date Requested</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="payoutTableBody">
                            @include('admin.payment.partials.payouts-table')
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
                    <div class="flex flex-wrap gap-4 mb-6">
                    <!-- Search -->
                    <input
                        type="text"
                        id="transactionSearch"
                        placeholder="Search buyer, agent, property..."
                        class="px-4 py-2 rounded-lg bg-[#12181f] border border-gray-600 text-white w-72"
                    >

                    <!-- Status Filter -->
                    <select
                        id="statusFilter"
                        class="px-4 py-2 rounded-lg bg-[#12181f] border border-gray-600 text-white"
                    >
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Confirmed</option>
                        <option value="refunded">Refunded</option>
                    </select>
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
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                {{-- <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody id="transactionsTableBody">
                            
                            @include('admin.payment.partials.transactions-table')

                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
</x-admin-dashboard.main-layout>