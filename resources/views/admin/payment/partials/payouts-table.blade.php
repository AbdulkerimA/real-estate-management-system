@forelse ($checkOuts as $req)
<tr class="table-row border-b border-gray-700">
    <td class="py-3 px-4">
        <div class="flex items-center space-x-3">
            <img
                src="{{ asset('storage/'.$req->agent->media->file_path) }}"
                class="w-10 h-10 rounded-full"
            >
            <span class="text-white font-medium">
                {{ $req->agent->user->name }}
            </span>
        </div>
    </td>

    <td class="py-3 px-4 text-[#00ff88] font-semibold">
        {{ Number::format($req->requested_amount) }} ETB
    </td>

    <td class="py-3 px-4 text-gray-300">
        {{ $req->created_at->format('M d, Y') }}
    </td>

    <td class="py-3 px-4">
        <span class="status-badge status-{{ $req->request_status }}">
            {{ ucfirst($req->request_status) }}
        </span>
    </td>

    <td class="py-3 px-4">
        @if ($req->request_status === 'pending')
            <button
                class="action-btn btn-approve"
                onclick="approvePayout({{ $req->id }})">
                Approve
            </button>

            <button
                class="action-btn btn-reject"
                onclick="rejectPayout({{ $req->id }})">
                Reject
            </button>
        @else
            <span class="text-gray-400 text-sm">—</span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center py-6 text-gray-400">
        No payout requests found
    </td>
</tr>
@endforelse
