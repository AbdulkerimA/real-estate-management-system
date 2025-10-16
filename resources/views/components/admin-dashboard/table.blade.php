@props([
    'headers'=>[],
    'filters' => [],
    'title'=>'',
    'subTitle'=>'',
    'checkBox' => false,
])
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

            <tbody id="transactionsTableBody">
                <tr class="table-row border-b border-gray-700">
                    @if ($checkBox)
                        <td class="py-3 px-4">
                            <input type="checkbox" class="checkbox-custom property-checkbox" value="1">
                        </td>
                    @endif
                    <td class="py-3 px-4 text-gray-300">Jan 15, 2025</td>
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-white">John Doe</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-white">Mike Johnson</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <div>
                            <p class="text-white text-sm">Luxury 3BR Apartment</p>
                            <p class="text-gray-400 text-xs">Bole, Addis Ababa</p>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-accent-green font-semibold">₹2,50,000</td>
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-300 text-sm">Credit Card</span>
                        </div>
                    </td>
                    <td class="py-3 px-4"><span class="status-badge status-completed">Completed</span></td>
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-2">
                            <button class="action-btn btn-view" onclick="viewTransaction('tx-1')">View</button>
                            {{-- <button class="action-btn btn-refund" onclick="refundTransaction('tx-1')">Refund</button> --}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>