{{-- checkout reqest table --}}
{{-- {{dd($checkOutReq );}} --}}
<div class="transaction-table rounded-2xl p-6">
    <form method="GET" class="flex items-center justify-end space-x-4">
        <!-- Search -->
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search transactions..."
                class="bg-[#12181f] border border-gray-600 rounded-lg px-4 py-2 pl-10 text-white placeholder-gray-400 focus:border-[#00ff88] focus:outline-none"
            >
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        <!-- Status -->
        <select
            name="status"
            class="bg-[#12181f] border border-gray-600 rounded-lg px-4 py-2 text-white focus:border-[#00ff88] focus:outline-none"
        >
            <option value="all">All Status</option>
            <option value="approved" @selected(request('status') === 'approved')>approved</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        </select>

        <button
            type="submit"
            class="px-4 py-2 rounded-lg bg-[#00ff88] text-[#12181f] font-semibold hover:bg-green-400"
            >
                Filter
        </button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto mb-8">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Date</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">request amount</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">status</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($checkOutReq  as $req)
                    <tr class="border-b border-gray-700">
                        <td class="py-4 px-4 text-white">
                            {{ $req->created_at->format('M d, Y') }}
                        </td>

                        <td class="py-4 px-4 text-white">
                            {{ Number::format($req->requested_amount) }} ETB
                        </td>

                        <td class="py-4 px-4">
                            <span class="
                                px-3 py-1.5 rounded-full text-xs font-medium
                                {{ $req->request_status === 'approved' ? 'bg-green-500/20' : 'status-pending' }}
                            ">
                                {{ ucfirst($req->request_status) }}
                            </span>
                        </td>

                        <td>
                            @if ($req->request_status === 'pending')
                                <button
                                    type="submit"
                                    form="cancel-form-{{ $req->id }}"
                                    class="px-2 py-1 rounded-lg bg-red-500/20 hover:bg-red-500/40 text-sm"
                                >
                                    <span class="text-red-500 font-semibold">Cancel Request</span>
                                </button>
                            @endif
                        </td>
                    </tr>

                    <form action="/checkout/delete/{{ $req->id }}" method="POST" id="cancel-form-{{ $req->id }}" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-400">
                            No checkout requests found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $checkOutReq->links('vendor.pagination.dashboard-pagination') }}
    </div>

</div>