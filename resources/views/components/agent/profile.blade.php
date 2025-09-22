@props([
    'agent' => [
        "profileImg" => '',
        'name' => 'sara Tadese',
        'profesion' => 'Senior Real Estate Agent',
        'stars' => 5,
        'rating' => 4.8,
        'phone' => '+251 922 345 678',
        'email' => 'sara.tadesse@AnchorHomes.et', 
    ]
])

<div>
    <h2 class="text-3xl font-bold mb-6">Listed by</h2>
    <div class="agent-card rounded-2xl p-6">
        <div class="text-center mb-6">
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                ST
            </div>
            <h3 class="text-xl font-semibold mb-1">{{ $agent['name'] }}</h3>
            <p class="text-[#00ff88] font-semibold mb-3">{{ $agent['profesion']}}</p>
            <div class="flex justify-center items-center mb-4">
                <div class="text-yellow-400 flex mr-2">
                    {{--  --}}
                    @for ($i = 0; $i < $agent['stars']; $i++ )
                        ⭐
                    @endfor
                </div>
                <span class="text-gray-400">{{ $agent['rating']}}/5</span>
            </div>
        </div>

        <div class="space-y-3 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span class="text-gray-300">{{ $agent['phone']}}</span>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
                <span class="text-gray-300">{{ $agent['email']}}</span>
            </div>
        </div>

        <div class="space-y-3">
            <button class="w-full border-2 border-[#00ff88] text-[#00ff88] py-3 rounded-lg font-semibold hover:bg-green-400 hover:text-[#12181f] transition-colors">
                <i class="fas fa-phone mr-3 w-5 h-5"></i> Call Agentf
            </button>
            
            <button class="w-full border-2 border-[#00ff88] text-[#00ff88] py-3 rounded-lg font-semibold hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                <i class="fas fa-envelope mr-3 w-5 h-5"></i> Send Message
            </button>
            
            <button class="w-full border border-gray-600 text-[#00ff88]  py-3 rounded-lg font-semibold hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                <i class="fas fa-user mr-3 w-5 h-5"></i> View Profile
            </button>
        </div>
    </div>
</div>