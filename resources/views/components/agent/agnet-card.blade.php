
@props([
    'agent' => []
])
@php
    $profile = json_decode($agent->media->file_path);

    // dd($agent->user);
@endphp
<div class="agent-card rounded-2xl p-6 text-center">
    <div class="w-20 h-20 rounded-full bg-gradient-to-br flex items-center justify-center text-2xl font-bold mx-auto mb-4">
        <img src="{{ asset('storage/'.$agent->media->file_path) }}" alt="" class="w-full h-full rounded-full">
    </div>
    
   
    <h3 class="text-xl font-semibold mb-1">{{ $agent->user->name }}</h3>
   
    <p class="text-[#00ff88] text-sm mb-3">{{ $agent->speciality }}</p>

    <div class="flex justify-center items-center mb-3">
        <div class="star-rating flex mr-2 text-sm">
                    @for ($i = 0; $i < 4; $i++ )
                        ⭐
                    @endfor
        </div>
        <span class="text-gray-400 text-sm">(4.7)</span>
    </div>
    
    {{-- <p class="text-gray-400 text-sm mb-4">5 years experience • Kirkos specialist</p> --}}
    
    <div class="space-y-2 flex flex-col items-center">
        <a href="tel:+251933456789" class="block text-sm text-gray-300 hover:text-[#00ff88] transition-colors">
           <div class="flex items-center">
            <i class="far fa-at w-5 h-5 mr-3 text-[#00ff88]"></i>
            {{ $agent->user->email }}
           </div>
        </a>
        
        <a href="tel:+251933456789" class="block text-sm text-gray-300 hover:text-[#00ff88] transition-colors">
           <div class="flex items-center">
            <svg class="w-5 h-5 mr-3 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            {{ $agent->user->phone }}
           </div>
        </a>
        <button
            onclick="window.location = '/agent/{{ $agent->id }}'" 
            class="w-full bg-[#00ff88] text-[#12181f] py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
            View full Profile
        </button>
    </div>
</div>