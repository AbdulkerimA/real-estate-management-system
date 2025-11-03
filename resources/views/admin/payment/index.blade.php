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
                        <p class="text-xs text-yellow-400 mt-1">23 transactions pending</p>
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

                            @foreach ($checkOuts as $req)
                               <tr class="table-row border-b border-gray-700">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                <img src="{{ asset('storage/'.$req->agent->media->file_path) }}" alt="{{ $req->agent->user->name }}">
                                            </div>
                                            <div>
                                                <p class="text-white font-medium">{{ $req->agent->user->name }}</p>
                                                <p class="text-gray-400 text-xs">Senior Agent</p>
                                            </div>
                                        </div>
                                    </td> 
                                    <td class="py-3 px-4 text-[#00ff88] font-semibold">{{ $req->requested_amount }}</td>
                                    <td class="py-3 px-4 text-gray-300">3 Property Sales</td>
                                    <td class="py-3 px-4 text-gray-300">{{ date('M d, Y', strtotime($req->created_at)) }}</td>
                                    <td class="py-3 px-4"><span class="status-badge status-{{ $req->request_status }}">
                                        {{ $req->request_status }}
                                    </span></td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-2">
                                            <button class="action-btn btn-approve" onclick="approvePayout('{{ $req->id }}')">Approve</button>
                                            <button class="action-btn btn-reject" onclick="rejectPayout('{{ $req->id }}')">Reject</button>
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach
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
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="transactionsTableBody">
                            
                            @foreach ($transactions as $transaction)
                                <tr class="table-row border-b border-gray-700">
                                    <td class="py-3 px-4 text-gray-300">{{ date('M d, Y' , strtotime($transaction->created_at)) }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                                <img src="{{ asset('storage/'.$transaction->buyer->id) }}" alt="customer profile pic">
                                            </div>
                                            <span class="text-white">{{ $transaction->buyer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                                {{ $transaction->agent->name[0] }}
                                                {{-- <img src="{{ asset('storage/'.$transaction->agnet->agentProfile->media->file_path) }}" alt="agent profile pic"> --}}
                                            </div>
                                            <span class="text-white">{{ $transaction->agent->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div>
                                            <p class="text-white text-sm">{{ $transaction->property->name }}</p>
                                            <p class="text-gray-400 text-xs">{{ $transaction->property->address }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-[#00ff88] font-semibold">{{ Number::format($transaction->property->price) }} ETB</td>
                                    <td class="py-3 px-4"><span class="status-badge status-completed">{{ $transaction->status }}</span></td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-2">
                                            <button class="action-btn btn-view" onclick="viewTransaction('{{ $transaction->id }}')">View</button>
                                            <button class="action-btn btn-refund" onclick="refundTransaction('{{ $transaction->id }}')">Refund</button>
                                        </div>
                                    </td>
                                </tr>
    
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
</x-admin-dashboard.main-layout>