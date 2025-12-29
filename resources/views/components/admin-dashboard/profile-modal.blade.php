<div class="modal" id="modal">
    @vite(['resources/js/admin-js/userDisplayModal'])    
    <div class="modal-content p-6 w-full max-w-5xl mx-4">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Agent Profile</h2>
            <button class="text-gray-400 hover:text-white" id="closeModal">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Agent Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Photo -->
                <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                        <img 
                            src="" 
                            alt=""
                            class="w-full h-full object-cover rounded-full"
                        >
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2" id="modalName"></h3>
                    <span class="status-badge status-verified" id="modalStatus"></span>
                </div>

                <!-- Contact Info -->
                <div class="dashboard-card rounded-xl p-4">
                    <h4 class="text-white font-semibold mb-3">Contact Information</h4>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-300 text-sm" id="modalEmail"></span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-gray-300 text-sm" id="modalPhone"></span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-300 text-sm" id="modalLocation"></span>
                        </div>
                    </div>
                </div>

                <!-- Experience & Rating -->
                <div class="dashboard-card rounded-xl p-4">
                    <h4 class="text-white font-semibold mb-3">Professional Info</h4>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-400 text-sm">Experience</p>
                            <p class="text-white font-medium" id="modalExperience"></p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Rating</p>
                            <div class="flex items-center space-x-2">
                                <div class="rating-stars text-amber-300">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                                <span class="text-white text-sm">4.8 (127 reviews)</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Properties Listed</p>
                            <p class="text-[#00ff88] font-bold text-xl" id="modalProperties">23</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2">
                    {{-- <button class="action-button w-full px-4 py-3 rounded-lg text-[#12181f] font-semibold" id="modalVerify">
                        Verify Agent
                    </button>
                    <button class="btn-suspend action-btn w-full px-4 py-3" id="modalSuspend">
                        Suspend Agent
                    </button> --}}
                </div>
            </div>

            <!-- Agent Details & Properties -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Bio -->
                <div class="dashboard-card rounded-xl p-4">
                    <h4 class="text-white font-semibold mb-3">About</h4>
                    <p class="text-gray-300 text-sm leading-relaxed" id="modalBio">
                        
                    </p>
                </div>

                <!-- Recent Properties -->
                <div class="dashboard-card rounded-xl p-4">
                    <h4 class="text-white font-semibold mb-4">Recent Properties Listed</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- @foreach ($properties as $property)
                            <div class="property-card">
                                <div class="flex items-center space-x-3">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium text-sm">Luxury 3BR Apartment</p>
                                        <p class="text-gray-400 text-xs">Bole, Addis Ababa</p>
                                        <p class="text-[#00ff88] font-semibold text-sm">₹2,50,000</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                    </div>
                </div>

                <!-- Recent Reviews -->
                <div class="dashboard-card rounded-xl p-4">
                    <h4 class="text-white font-semibold mb-4">Recent Reviews</h4>
                    <div class="space-y-4 recent-reviews-container">
                        <!-- Reviews will be injected here by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>