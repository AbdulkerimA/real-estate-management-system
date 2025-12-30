@forelse ($transactions as $transaction)
<tr class="table-row border-b border-gray-700">
    <td class="py-3 px-4 text-gray-300">
        {{ $transaction->created_at->format('M d, Y') }}
    </td>

    <td class="py-3 px-4 text-white">
        {{ $transaction->buyer->name }}
    </td>

    <td class="py-3 px-4 text-white">
        {{ $transaction->agent->name }}
    </td>

    <td class="py-3 px-4">
        <p class="text-white text-sm">{{ $transaction->property->name }}</p>
        <p class="text-gray-400 text-xs">{{ $transaction->property->address }}</p>
    </td>

    <td class="py-3 px-4 text-[#00ff88] font-semibold">
        {{ Number::format($transaction->property->price) }} ETB
    </td>

    <td class="py-3 px-4">
        <span class="status-badge status-{{ $transaction->status }}">
            {{ ucfirst($transaction->status) }}
        </span>
    </td>

    <td class="py-3 px-4">
        {{-- <button class="action-btn btn-view"
            onclick="viewTransaction({{ $transaction->id }})">
            View
        </button> --}}

        @if ($transaction->status === 'confirmed')
            <button class="action-btn btn-refund"
                onclick="refundTransaction({{ $transaction->id }})">
                Refund
            </button>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center py-6 text-gray-400">
        No transactions found
    </td>
</tr>
@endforelse
