@props([
    'agent' => []
])
@php
    $profile = json_decode($agent->media->file_path);
@endphp
<div class="agent-card rounded-2xl p-6 text-center w-full">
    <div class="w-20 h-20 rounded-full bg-gradient-to-br flex items-center justify-center text-2xl font-bold mx-auto mb-4">
        <img src="{{ asset('storage/'.$agent->media->file_path) }}" alt="" class="w-full h-full rounded-full">
    </div>
    
    <h3 class="text-xl font-semibold mb-1">{{ $agent->user->name }}</h3>
    <p class="text-[#00ff88] text-sm mb-3">speciality: {{ $agent->speciality }}</p>

    <div class="flex justify-center items-center mb-3">
        <div class="star-rating flex mr-2 text-sm">
            @php
                $avg = round($agent->averageRating() ?? 0);
            @endphp
            @for ($i = 1; $i < $avg; $i++)
                ⭐
            @endfor
        </div>
        <span class="text-gray-400 text-sm">⭐
            (
                {{ number_format($agent->averageRating() ?? 1, 1) }}
                /
                {{ number_format($agent->totalRating() ==0 ? 1 : $agent->totalRating() ,0) }}
            )
            
        </span>
    </div>
    
    <div class="space-y-2 flex flex-col items-center w-full">
        <a href="mailto:{{ $agent->user->email }}" class="block text-sm text-gray-300 hover:text-[#00ff88] transition-colors">
           <div class="flex items-center">
                <i class="far fa-at w-5 h-5 mr-3 text-[#00ff88]"></i>
                {{ $agent->user->email }}
           </div>
        </a>
        
        <a href="tel:{{ $agent->user->phone }}" class="block text-sm text-gray-300 hover:text-[#00ff88] transition-colors">
           <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $agent->user->phone }}
           </div>
        </a>

       <div class="grid grid-cols-2 gap-2 w-full">
             <button
                onclick="window.location = '/agent/{{ $agent->id }}'" 
                class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                View Profile
            </button>

            <!-- Rate Agent Button -->
            <button
                onclick="openRateModal({{ $agent->id }}, '{{ $agent->user->name }}')"
                 class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                Rate Agent
            </button>
       </div>
    </div>
</div>

<!-- Rate Agent Modal (add once in your blade layout, not per card) -->
<div id="rateModal" class="hidden fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50">
    <div class="bg-[#12181f] p-6 rounded-2xl w-96 relative">
        <h2 class="text-xl font-bold mb-4 text-white" id="rateModalTitle">Rate Agent</h2>
        <form id="rateAgentForm" method="POST" action="{{ route('agent.rate') }}">
            @csrf
            <input type="hidden" name="agent_id" id="rateAgentId">
            <label class="text-white mb-2 block">Your Rating:</label>
            <select name="rating" class="w-full p-2 rounded-lg mb-4 text-white">
                <option value="1">⭐</option>
                <option value="2">⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
            <label class="text-white mb-2 block">Comment (optional):</label>
            <textarea name="comment" class="w-full p-2 rounded-lg mb-4 text-white" placeholder="Write your feedback..."></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeRateModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-[#00ff88] text-[#12181f] rounded-lg">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRateModal(agentId, agentName) {
    document.getElementById('rateModal').classList.remove('hidden');
    document.getElementById('rateModalTitle').textContent = `Rate Agent: ${agentName}`;
    document.getElementById('rateAgentId').value = agentId;
}

function closeRateModal() {
    document.getElementById('rateModal').classList.add('hidden');
}
</script>
