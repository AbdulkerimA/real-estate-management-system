@php
    // $blalance = $agent->first()->blalance;
    // $
    // dd($weeklyReport)
    // $week = filter_key
@endphp
<x-agent-dashboard.dashboard-layout>
    @vite(['resources/js/agents/earnings'])
    <div class="p-2 space-y-6 relative">
        <!-- Earnings Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Earnings --> 
            <x-agent-dashboard.status-card 
                themeColor="green" 
                statusNum="{{ $agent->balance->current_balance }}" 
                notifier="+12.5%">
                <svg class="w-7 h-7 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>

                @slot("statusText")
                    Total Earnings
                @endslot
            </x-agent-dashboard.status-card>


            <!-- Pending Payments -->
            <x-agent-dashboard.status-card 
                themeColor="yellow" 
                statusNum="{{ $pendingTotal != null ? $pendingTotal : 0 }}" 
                notifier="
                        {{ 
                            $agent->checkoutRequest!= null ? count($agent->checkoutRequest) : 0
                        }} 
                        pending">
                <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                @slot("statusText")
                    Pending Payments
                @endslot
            </x-agent-dashboard.status-card>


            <!-- Completed Payments -->
            <x-agent-dashboard.status-card 
                themeColor="green" 
                statusNum="{{ $agent->balance->total_check_out }}" 
                notifier="15 deals">
                <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>

                @slot("statusText")
                    Completed Payments
                @endslot
            </x-agent-dashboard.status-card>


            <!-- Current Month -->
            <x-agent-dashboard.status-card 
                themeColor="blue" 
                statusNum="{{ $thisMonthTotal }}" 
                notifier="December">
                <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>

                @slot("statusText")
                    Current Month
                @endslot
            </x-agent-dashboard.status-card>

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

        </div>

        <!-- Payout Section -->
        <div class="payout-card rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">Payout Management</h2>
                    <p class="text-gray-400 text-sm ">
                        Last payout:  
                       <span class="font-bold">
                        {{ 
                            // dd($agent->lastApprovedCheckout->first()) 
                            $agent->lastApprovedCheckout->first() != null
                            ?
                                Number::format($agent->lastApprovedCheckout->first()->requested_amount,2)
                            :
                                0
                        }}
                        ETB
                       </span>
                        
                        {{ 
                            $agent->lastApprovedCheckout->first() 
                            ?
                               'on '.date('M d, Y', strtotime($agent->lastApprovedCheckout->first()->created_at)) 
                            :
                            ''
                        }}
                    </p>
                    {{-- <p class="text-gray-400 text-sm">Next scheduled payout: Dec 30, 2024</p> --}}
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400 mb-2">Available for payout</p>
                    <p class="text-2xl font-bold text-[#00ff88] mb-4">ETB {{ Number::format($agent->balance->current_balance,2) }}</p>
                    <button 
                        class="bg-[#00ff88] text-[#12181f] px-6 py-3 rounded-xl font-semibold hover:bg-green-400 transition-colors" 
                        id="requestPayoutBtn">
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

        {{-- message diaply modal --}}
        <div id="message" 
            class="fixed top-22 right-0 flex justify-evenly items-center text-md font-semibold px-4 py-2 m-2 border rounded-2xl shadow-lg z-50 hidden">
            <i class="fa fa-exclamation-triangle text-xl mx-2" aria-hidden="true"></i>
            <p class="mx-2" id="message-text">
                
            </p>
            <button onclick="hideError()" class="px-2 rounded bg-red-200 mx-2 text-xl">
                <i class="fa fa-times text-red-500" aria-hidden="true"></i>
            </button>
        </div>
    </div>


    <div class="modal" id="checkOutModal">
        <div class="modal-content">
            {{-- <h3 class="text-xl font-bold mb-4" id="inputModalTitle">Final Confirmation</h3> --}}
            <p class="text-gray-400 mb-4" id="inputModalMessage">Type How Much You Want To Withdraw.</p>
            <input 
                type="number" 
                id="inputModalField" 
                class="w-full p-3 rounded-lg bg-gray-700 text-white mb-6 outline-none focus:ring-2 focus:ring-red-500" 
                placeholder='Type the Number Here'
                reuiqred
            >
            <div class="flex space-x-4">
                <button class="flex-1 bg-gray-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-gray-500" id="inputModalCancel">
                    Cancel
                </button>
                <button class="flex-1 danger-button px-4 py-3 rounded-lg text-white font-semibold" id="inputModalConfirm">
                    Send Request
                </button>
            </div>
        </div>
    </div>

    <script>
        let weeklyReport = @json($weeklyReport);

        // Extract weeks and totals for Chart.js
        const weekLabels = weeklyReport.map(item => item.week);
        const weekTotals = weeklyReport.map(item => item.total);

        const ctx = document.getElementById('earningsChart').getContext('2d');
        const earningsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: weekLabels,
                datasets: [{
                    label: 'Earnings (ETB)',
                    data: weekTotals,
                    borderColor: '#00ff88',
                    backgroundColor: 'rgba(0, 255, 136, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#00ff88',
                    pointBorderColor: '#1c252e',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(28, 37, 46, 0.9)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#00ff88',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `Earnings: ETB ${context.parsed.y.toLocaleString()}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                            borderColor: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                            borderColor: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#9ca3af',
                            callback: function(value) {
                                return 'ETB ' + (value / 1000) + 'K';
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

    </script>
</x-agent-dashboard.dashboard-layout>