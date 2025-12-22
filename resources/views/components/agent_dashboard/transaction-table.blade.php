<div class="transaction-table rounded-2xl p-6">
    <form method="GET" class="flex items-center justify-between mb-6 space-x-4">
        <h2 class="text-xl font-bold">Earning History</h2>

        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="search by commition, total"
                    class="bg-[#12181f] border border-gray-600 rounded-lg px-4 py-2 pl-10 text-white placeholder-gray-400 focus:border-[#00ff88] focus:outline-none"
                >
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <!-- Status Filter -->
            {{-- <select
                name="status"
                class="bg-[#12181f] border border-gray-600 rounded-lg px-4 py-2 text-white focus:border-[#00ff88] focus:outline-none"
            >
                <option value="all">All Status</option>
                <option value="paid" @selected(request('status') === 'paid')>Paid</option>
                <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            </select> --}}

            <button type="submit" class="px-4 py-2 rounded-lg bg-[#00ff88] text-[#12181f] font-semibold hover:bg-green-400">
                Filter
            </button>
        </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto mt-8">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">ID</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Total</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Commission</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($earnings as $earning)
                    <tr class="transaction-row border-b border-gray-700" data-status="{{ $earning->status }}">
                        <td class="py-4 px-4 text-white">{{ $earning->id }}</td>
                        <td class="py-4 px-4 text-white font-semibold">ETB {{ Number::format($earning->total_earnings) }}</td>
                        <td class="py-4 px-4 text-white font-semibold">ETB {{ Number::format($earning->commission) }}</td>
                        <td class="py-4 px-4 text-white">{{ $earning->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-400">
                            No transactions found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $earnings->links('vendor.pagination.dashboard-pagination') }}
    </div>
</div>
