@php
function numberConverter($num) {
    if ($num >= 1000000000) {
        return round($num / 1000000000, 1) . 'B';
    }
    if ($num >= 1000000) {
        return round($num / 1000000, 1) . 'M';
    }
    if ($num >= 1000) {
        return round($num / 1000, 1) . 'K';
    }
    return $num;
}

function remainingTime($scheduledTime,$scheduledDate) {
    $now = new DateTime();                      // current time
    $scheduled = new DateTime($scheduledTime);  // scheduled time
    
    $interval = $now->diff($scheduled);         // get difference
    
    if ($scheduledDate != date('Y-m-d')) {
        return date('M d, Y', strtotime($scheduledDate)); 
    }

    if ($scheduled < $now) {
        return "Time passed";
    }

    // format remaining time as "H hours i minutes"
    return $interval->format('%h hours %i minutes');
}

function displayDate($scheduledDate,$appointment) {
    if ($scheduledDate != date('Y-m-d')) {
        return date('M d, Y', strtotime($scheduledDate)); 
    }else{
        return "Today " .$appointment->scheduled_time;
    }
}  
@endphp
<x-agent-dashboard.dashboard-layout>

<!-- Upcoming Appointments Highlight -->
<div class="content-card rounded-2xl p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Upcoming Appointments</h2>
        <div class="flex items-center space-x-2 text-green-400">
            <div class="w-2 h-2 bg-green-400 rounded-full pulse-animation"></div>
            <span class="text-sm font-medium">Live Updates</span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Next Appointment -->
        @foreach ($appointments->take(3) as $appointment )
            <x-agent-dashboard.appointment-quick-show-card status="next" action="view details" :appointment="$appointment">
                {{-- <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg> --}}
                <img src="{{ asset('storage/'.(json_decode($appointment->property->media->file_path,true)[0] ?? 'default.png')) }}" 
                    alt=""
                    class="w-full h-full rounded"
                >
            </x-agent-dashboard.appointment-quick-show-card>
        @endforeach

        {{-- <!-- Second Appointment -->
        <x-agent-dashboard.appointment-quick-show-card >
            <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </x-agent-dashboard.appointment-quick-show-card>

        <!-- Third Appointment -->
        <x-agent-dashboard.appointment-quick-show-card status="Pending" action="confirm">
            <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </x-agent-dashboard.appointment-quick-show-card> --}}
    </div>
</div>

<!-- Filters and Calendar Section -->
<div class="">
    <!-- Mini Calendar -->
        <!-- Filters -->
    <div class="">
        <div class="content-card rounded-2xl p-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Status Filter -->
                    <div class="filter-dropdown">
                        <select class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-[#12181f] focus:outline-none focus:ring-2 focus:ring-[#12181f] focus:ring-opacity-20" id="apstatusFilter">
                            <option value="all">All Status</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    <!-- Date Range -->
                    <div class="flex space-x-2">
                        <input type="date" class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-[#12181f] focus:outline-none focus:ring-2 focus:ring-[#12181f] focus:ring-opacity-20" id="startDate">
                        <input type="date" class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-[#12181f] focus:outline-none focus:ring-2 focus:ring-[#12181f] focus:ring-opacity-20" id="endDate">
                    </div>

                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Search client or property..." class="bg-[#12181f] border border-gray-600 rounded-xl px-4 py-3 pl-12 text-white placeholder-gray-400 focus:border-[#12181f] focus:outline-none focus:ring-2 focus:ring-[#12181f] focus:ring-opacity-20 w-full sm:w-64 col-span-2" id="appointmentSearch">
                        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <button class="bg-[#00ff88] text-[#12181f] px-6 py-3 rounded-xl font-semibold hover:bg-green-400 transition-all duration-300 shadow-lg hover:shadow-xl">
                        search           
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointments Table -->
<div class="content-card rounded-2xl p-6 my-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">All Appointments</h2>
        <div class="text-sm text-gray-400">
            Showing {{ Count($appointments) }} appointments
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="text-left py-4 px-2 font-semibold">Client</th>
                    <th class="text-left py-4 px-2 font-semibold">Property</th>
                    <th class="text-left py-4 px-2 font-semibold">Date & Time</th>
                    <th class="text-left py-4 px-2 font-semibold">Status</th>
                    <th class="text-left py-4 px-2 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="appointmentsTableBody">
                @foreach ($appointments as $appointment)
                    <x-agent-dashboard.appointment-table-row :appointment="$appointment"/>
                @endforeach
                
                {{-- <tr class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors" data-status="scheduled">
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                DH
                            </div>
                            <div>
                                <p class="font-semibold">Daniel Haile</p>
                                <p class="text-sm text-gray-400">+251 922 654 321</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-4">
                            <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Modern Villa in Kazanchis</p>
                                <p class="text-sm text-gray-400">5 bed • 4 bath • ETB 8.2M</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <p class="font-medium">Tomorrow, Dec 29</p>
                        <p class="text-sm text-gray-400">10:00 AM - 11:30 AM</p>
                    </td>
                    <td class="py-4 px-2">
                        <span class="status-scheduled px-4 py-2 rounded-full text-sm font-semibold">Scheduled</span>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex space-x-3">
                            <button class="text-blue-400 hover:text-blue-300 font-medium appointment-action" data-action="view">View</button>
                            <button class="text-[#12181f] hover:text-green-400 font-medium appointment-action" data-action="confirm">Confirm</button>
                            <button class="text-red-400 hover:text-red-300 font-medium appointment-action" data-action="cancel">Cancel</button>
                        </div>
                    </td>
                </tr>
                
                <tr class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors" data-status="pending">
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                HA
                            </div>
                            <div>
                                <p class="font-semibold">Hanan Ahmed</p>
                                <p class="text-sm text-gray-400">+251 933 789 012</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-4">
                            <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 21h18M5 21V7l8-4v18M19 21V10l-6-3"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Commercial Building in Piassa</p>
                                <p class="text-sm text-gray-400">Office space • ETB 12M</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <p class="font-medium">Dec 31, 2024</p>
                        <p class="text-sm text-gray-400">3:00 PM - 4:00 PM</p>
                    </td>
                    <td class="py-4 px-2">
                        <span class="status-pending px-4 py-2 rounded-full text-sm font-semibold">Pending</span>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex space-x-3">
                            <button class="text-blue-400 hover:text-blue-300 font-medium appointment-action" data-action="view">View</button>
                            <button class="text-[#12181f] hover:text-green-400 font-medium appointment-action" data-action="confirm">Confirm</button>
                            <button class="text-red-400 hover:text-red-300 font-medium appointment-action" data-action="cancel">Cancel</button>
                        </div>
                    </td>
                </tr>
                
                <tr class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors" data-status="completed">
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                SM
                            </div>
                            <div>
                                <p class="font-semibold">Selamawit Mulu</p>
                                <p class="text-sm text-gray-400">+251 944 567 890</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-4">
                            <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Family House in CMC</p>
                                <p class="text-sm text-gray-400">4 bed • 3 bath • ETB 3.8M</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <p class="font-medium">Dec 26, 2024</p>
                        <p class="text-sm text-gray-400">11:00 AM - 12:00 PM</p>
                    </td>
                    <td class="py-4 px-2">
                        <span class="status-completed px-4 py-2 rounded-full text-sm font-semibold">Completed</span>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex space-x-3">
                            <button class="text-blue-400 hover:text-blue-300 font-medium appointment-action" data-action="view">View</button>
                            <button class="text-gray-500 font-medium cursor-not-allowed">Completed</button>
                        </div>
                    </td>
                </tr>
                
                <tr class="border-b border-gray-700 hover:bg-[#12181f] hover:bg-opacity-50 transition-colors" data-status="canceled">
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                AT
                            </div>
                            <div>
                                <p class="font-semibold">Abebe Tesfaye</p>
                                <p class="text-sm text-gray-400">+251 955 234 567</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-4">
                            <div class="property-image w-16 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Residential Land in Lebu</p>
                                <p class="text-sm text-gray-400">1000 sqm • ETB 2.5M</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2">
                        <p class="font-medium">Dec 25, 2024</p>
                        <p class="text-sm text-gray-400">4:00 PM - 5:00 PM</p>
                    </td>
                    <td class="py-4 px-2">
                        <span class="status-canceled px-4 py-2 rounded-full text-sm font-semibold">Canceled</span>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex space-x-3">
                            <button class="text-blue-400 hover:text-blue-300 font-medium appointment-action" data-action="view">View</button>
                            <button class="text-gray-500 font-medium cursor-not-allowed">Canceled</button>
                        </div>
                    </td>
                </tr> --}}
            </tbody>
        </table>
        <div class="my-4">
            {{-- pagination goes here --}}
            {{ $appointments->links('vendor.pagination.dashboard-pagination') }}
        </div>
    </div>
</div>
</x-agent-dashboard.dashboard-layout>
            
