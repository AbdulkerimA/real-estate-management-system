@props(['data'=>[]])
{{-- {{ dd($data->agent) }} --}}
<tr class="transaction-row border-b border-gray-700" data-status="paid">
    <td class="py-4 px-4 text-white">{{ date('M d, Y',strtotime($data->crated_at)) }}</td>
    <td class="py-4 px-4 text-white">{{ $data->property?->title }}</td>
    <td class="py-4 px-4 text-white">{{ $data->buyer?->name }}</td>
    <td class="py-4 px-4 text-white font-semibold">ETB {{ Number::format($data->property?->price) }}</td>
    <td class="py-4 px-4">
        <span class="status-paid px-3 py-1 rounded-full text-xs font-medium">{{ $data->status }}</span>
    </td>
</tr>