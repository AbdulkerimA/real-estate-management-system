<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/agents.css','resources/js/admin-js/agents.js']) 
    <!-- Page Content -->
    <div class="p-6 space-y-6"> 
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Total Agents --}}
            <x-admin-dashboard.status-card 
                themeColor="green" 
                statusNum="{{ Number::format($numOfAllAgents) }}" 
                title="Total Agents"
                >

                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2
                            c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857
                            M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002
                            0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2
                            0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Verified Agents --}}
            <x-admin-dashboard.status-card 
                themeColor="green" 
                statusNum="{{ Number::format($verifiedAgents) }}" 
                title="Verified Agents"
                >
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Pending Verification --}}
            <x-admin-dashboard.status-card 
                themeColor="yellow" 
                statusNum="{{ Number::format($pendingAgents) }}" 
                title="Pending Verification"
                >
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </x-admin-dashboard.status-card>

            {{-- Suspended Agents --}}
            <x-admin-dashboard.status-card 
                themeColor="red" 
                statusNum="{{ Number::format($suspendedAgents) }}" 
                title="Suspended Agents"
                >
                @slot("subtitle")
                @endslot
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636
                            m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                </svg>
            </x-admin-dashboard.status-card>

        </div>

        <!-- Bulk Actions Bar -->
        <div class="bulk-actions rounded-lg p-4 mb-4" id="bulkActions">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-white font-medium" id="selectedCount">0 agents selected</span>
                    <div class="flex items-center space-x-2">
                        <button class="btn-verify action-btn" id="bulkVerify">Verify Selected</button>
                        <button class="btn-suspend action-btn" id="bulkSuspend">Suspend Selected</button>
                        <button class="btn-delete action-btn" id="bulkDelete">Delete Selected</button>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-white" id="clearSelection">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Agents Table -->
        <div class="dashboard-card rounded-2xl p-6">
            <div class="table-container">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left py-3 px-4">
                                <input type="checkbox" class="checkbox-custom" id="selectAll">
                            </th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Photo</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Full Name</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Email</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Phone</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Properties</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Status</th>
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="agentsTableBody">
                        @foreach ($agents as $agent)
                            <tr class="table-row border-b border-gray-700" data-agent-id="{{ $agent->id }}">
                                <td class="py-3 px-4">
                                    <input 
                                        type="checkbox"
                                        class="checkbox-custom agent-checkbox"
                                        value="{{ $agent->id }}"
                                    >
                                </td>
                                <td class="py-3 px-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        <img 
                                            src="{{ asset('storage/'.$agent->media->file_path) }}" 
                                            alt="{{ 'profile of'.$agent->user->name }}"
                                            class="w-full h-full object-cover rounded-full"
                                        >
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-white font-medium">{{ $agent->user->name }}</p>
                                        <p class="text-gray-400 text-sm">{{ $agent->years_of_experience }} years experience</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-white">{{ $agent->user->email }}</td>
                                <td class="py-3 px-4 text-white">+{{ $agent->user->phone}}</td>
                                <td class="py-3 px-4 text-[#00ff88] font-semibold">23</td>
                                <td class="py-3 px-4"><span class="status-badge status-{{ $agent->user->status  }}">{{ $agent->user->status }}</span></td>
                                <td class="py-3 px-4">
                                    <div class="flex w-40 items-center flex-wrap space-x-2 gap-2">
                                        <button class="action-btn btn-view" onclick="viewAgent({{ $agent->id }})">
                                            View Profile
                                        </button>
                                            @if ($agent->user->status == 'suspended')
                                                <button class="action-btn btn-suspend bg-green-400/40 text-green-800" 
                                                        onclick="suspendAgent({{ $agent->id }})"
                                                >
                                                    unsuspend
                                                </button>
                                            @elseif ($agent->user->status == 'pending')
                                                <button class="action-btn btn-verify" 
                                                        onclick="verifyAgent({{ $agent->id }})"
                                                >
                                                    verifie
                                                </button>
                                            @else
                                                @if ($agent->user->status != 'Suspended')
                                                    <button class="action-btn btn-suspend" 
                                                            onclick="suspendAgent({{ $agent->id }})"
                                                    >
                                                        suspend
                                                    </button>
                                                @else
                                                    <button class="action-btn btn-verify" 
                                                            onclick="suspendAgent({{ $agent->id }})"
                                                    >
                                                        unsuspend
                                                    </button>
                                                @endif
                                            @endif
                                        <button class="action-btn btn-delete" 
                                                onclick="deleteAgent({{ $agent->id}})">
                                                Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $agents->links('vendor.pagination.dashboard-pagination') }}
        </div>
    </div>
    <div id="toastContainer" class="toast-container"></div>
    
    <!-- Agent Profile Preview Modal -->
    <x-admin-dashboard.profile-modal />

</x-admin-dashboard.main-layout>

