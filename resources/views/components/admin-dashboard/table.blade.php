@props([
    'headers'=>[],
    'filters' => [],
    'title'=>'',
    'subTitle'=>'',
    'checkBox' => false,
    'recenttransaction'=>[]
])
@php
    dd()
@endphp
@vite(['resources/css/admin-style/transaction.css','resources/js/admin-js/transaction.js'])

<div class="dashboard-card rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
            <p class="text-gray-400 text-sm">{{ $subTitle }}</p>
        </div>

        <div class="flex items-center space-x-4">
            <input type="text" placeholder="Search transactions..." class="search-input px-4 py-2 rounded-lg text-white text-sm" id="transactionSearch">
            @foreach ($filters as $name => $options)
                <select name="{{ $name }}" class="search-input px-4 py-2 rounded-lg text-white text-sm">
                    @foreach ($options as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            @endforeach
        </div>
    </div>
    <div class="table-container">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-600">
                    @foreach ($headers as $header)
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">{{ $header }}</th>
                    @endforeach
            </thead>

            <tbody>
                @foreach($recenttransaction as $transaction)
                <tr class="table-row border-b border-gray-700">
                    <td class="py-3 px-4 text-white">{{ $transaction->created_at->format('M d, Y') }}</td>
                    <td class="py-3 px-4 text-white">{{ $transaction->buyer->name }}</td>
                    <td class="py-3 px-4 text-white">{{ $transaction->property->title }}</td>
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
                        <button class="text-[#00ff88] hover:text-green-400 text-sm">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>