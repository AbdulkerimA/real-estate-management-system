<x-admin-dashboard.main-layout>
    <div class="p-6 space-y-6">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <x-admin-dashboard.status-card themeColor="green" :statusNum="$totalProperties" title="Properties Listed">
                @slot("subtitle")
                    ↗ +12% from last month
                @endslot
            </x-admin-dashboard.status-card>

            <x-admin-dashboard.status-card themeColor="green" :statusNum="$verifiedAgents" title="Verified Agents">
                @slot("subtitle")
                    ↗ +5% from last month
                @endslot
            </x-admin-dashboard.status-card>

            <x-admin-dashboard.status-card themeColor="green" :statusNum="$activeBuyers" title="Active Buyers">
                @slot("subtitle")
                    ↗ +18% from last month
                @endslot
            </x-admin-dashboard.status-card>

            <x-admin-dashboard.status-card themeColor="green" :statusNum="number_format($totalRevenue, 2)" title="Total Revenue">
                @slot("subtitle")
                    ↗ +24% from last month
                @endslot
            </x-admin-dashboard.status-card>

        </div>

        {{-- monthly revenue --}}
        <div class="dashboard-card rounded-2xl p-6">
            <h2 class="text-lg font-semibold mb-4">Monthly Revenue</h2>
            <canvas id="monthlyRevenueChart" height="120"></canvas>
        </div>

        <!-- Charts Section (Placeholder) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="dashboard-card rounded-2xl p-6 h-full">
                <h2 class="text-lg font-semibold mb-4">Property Sales by Category</h2>
                <canvas id="propertySalesChart" height="250"></canvas>
            </div>

            {{-- agent performance distribution --}}
            <div class="dashboard-card rounded-2xl flex flex-col items-center h-120 p-4">
                <h3 class="text-xl font-bold mb-4 w-full">Agent Performance Distribution</h3>

                @if(!empty($agentValues))
                    <canvas id="agentPerformanceChart"></canvas>
                @else
                    <p class="text-gray-400">No performance data available.</p>
                @endif
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="dashboard-card rounded-2xl p-6" id="table">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold">Recent Transactions</h3>
                <div class="flex items-center space-x-4">
                    <form method="GET" class="flex items-center space-x-4 mb-4">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search transactions..."
                            class="search-input px-4 py-2 rounded-lg text-white text-sm"
                        >

                        <select
                            name="status"
                            class="search-input px-4 py-2 rounded-lg text-white text-sm"
                            onchange="this.form.submit()"
                        >
                            <option value="all">All Status</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-lg bg-[#00ff88] text-[#12181f] text-sm font-semibold"
                        >
                            Apply
                        </button>
                    </form>

                </div>
            </div>

            <div class="table-container overflow-x-auto">
                <table class="w-full min-w-max">
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
                        @foreach($recentTransactions as $transaction)
                        <tr class="table-row border-b border-gray-700">
                            <td class="py-3 px-4 text-white">
                                {{ optional($transaction->created_at)->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 text-white">{{ $transaction->buyer->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-white">{{ $transaction->property->title ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-white">₹{{ number_format($transaction->offer_amount, 2) }}</td>
                            <td class="py-3 px-4">
                                <span class="status-badge 
                                    @if($transaction->status == 'approved') status-paid
                                    @elseif($transaction->status == 'pending') status-pending
                                    @else status-failed
                                    @endif
                                ">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="text-[#00ff88] hover:text-green-400 text-sm">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <p class="text-gray-400 text-sm">Showing {{ $recentTransactions->firstItem() }}-{{ $recentTransactions->lastItem() }} of {{ $recentTransactions->total() }} transactions</p>
                <div class="flex items-center space-x-2">
                    {{ $recentTransactions->links() }}
                </div>
            </div>
        </div>

    </div>

    <!-- Include Charts.js and initialize charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example chart initializations (replace with dynamic data)
        // const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        // new Chart(monthlyRevenueCtx, {
        //     type: 'line',
        //     data: {
        //         labels: @json($monthlyRevenueLabels ?? []),
        //         datasets: [{
        //             label: 'Revenue',
        //             data: @json($monthlyRevenueData ?? []),
        //             borderColor: '#00ff88',
        //             backgroundColor: 'rgba(0,255,136,0.2)',
        //             tension: 0.4
        //         }]
        //     }
        // });

        // const propertySalesCtx = document.getElementById('propertySalesChart').getContext('2d');
        // new Chart(propertySalesCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: @json($propertySalesLabels ?? []),
        //         datasets: [{
        //             label: 'Properties Sold',
        //             data: @json($propertySalesData ?? []),
        //             backgroundColor: '#00ff88'
        //         }]
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function () {
            // property sales chart
            const salesCtx = document.getElementById('propertySalesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: @json($categories),
                    datasets: [{
                        label: 'Sales',
                        data: @json($salesCounts),
                        backgroundColor: 'rgba(0, 255, 136, 0.6)',
                        borderColor: 'rgba(0, 255, 136, 1)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => ctx.raw + ' sales'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // monthly revenue chart
            const revenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Revenue',
                        data: @json($revenues),
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => 'ETB ' + ctx.raw.toLocaleString()
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: value => 'ETB ' + value.toLocaleString()
                            }
                        }
                    }
                }
            });

            // agents performance chart
            const chartEl = document.getElementById('agentPerformanceChart');
            if (!chartEl) return;

            new Chart(chartEl, {
                type: 'doughnut',
                data: {
                    labels: @json($agentLabels),
                    datasets: [{
                        data: @json($agentValues),
                        backgroundColor: [
                            '#00ff88',
                            '#4f46e5',
                            '#f97316',
                            '#ef4444',
                            '#22d3ee',
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#ffffff'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin-dashboard.main-layout>
