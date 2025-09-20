@props(['propertyObj'])

<div class="property-card bg-[#1c252e] rounded-2xl shadow-lg overflow-hidden">

    <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 relative">
    
        <div class="absolute inset-0 bg-black bg-opacity-20">
            <img src="" alt="">
        </div>
    
        <x-property.tag status="available">
            available
        </x-property.tag>
    
        
    
    </div>
    
    <div class="p-6">
        <h3 class="text-xl font-bold text-white mb-2">Modern Apartment in Bole</h3>
        <p class="text-gray-400 mb-4"><i class="fas text-green-400 fa-map-marker-alt mr-2"></i>Bole, Addis Ababa</p>
    
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-4 text-sm text-gray-400">
                <span><i class="fa text-green-400 fa-bed mr-1"></i>3 Beds</span>
                <span><i class="fas text-green-400 fa-bath mr-1"></i>2 Baths</span> 
                <span><i class="fas text-green-400 fa-ruler-combined mr-1"></i>120m²</span>
            </div>
        </div>
        
        <div class="my-4 text-green-400 font-bold">
            <div class="text-2xl font-bold">3,200,0000 ETB</div>
        </div>
    
        <button class="w-full bg-[#00ff88] text-gray-900 py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
            View Details
        </button>
    
    </div>
</div>