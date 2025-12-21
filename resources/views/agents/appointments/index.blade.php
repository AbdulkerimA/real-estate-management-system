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

function remainingTime($scheduledTime, $scheduledDate) {
    $now = new DateTime();                      // current time
    $scheduled = new DateTime($scheduledTime);  // scheduled time

    // Check if the scheduled date is in the past
    if ($scheduledDate < date('Y-m-d')) {
        return "passed";
    }

    // Check if the scheduled date is today
    if ($scheduledDate == date('Y-m-d')) {

        // Calculate remaining time until scheduled time
        if ($now > $scheduled) {
            return "Time passed";
        }

        $interval = $now->diff($scheduled); // get difference
        return $interval->format('%h hours %i minutes remaining');
    }

    // If the scheduled date is not today, return the formatted date
    return date('M d, Y', strtotime($scheduledDate)); 
}


@endphp
@vite(['resources/js/agents/appointments'])
<script>
    let appointments = @json($appointments_); 
</script>

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
    </div>
</div>

<!-- Filters and Calendar Section -->
<div class="">
    <!-- Mini Calendar -->
        <!-- Filters -->
    {{-- <div class="">
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
    </div> --}}
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
                    <th class="text-left py-4 px-2 font-semibold hidden">ID</th>
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
            </tbody>
        </table>
        <div class="my-4">
            {{-- pagination goes here --}}
            {{ $appointments->links('vendor.pagination.dashboard-pagination') }}
        </div>
    </div>
</div>
{{-- display an appointment modla --}}
<div class="modal" id="apmodal">
    <div class="apmodal-content">
    <div class="apmodal-header">
        <h2 id="modalTitle">Appointment Details</h2>
        <button class="close-btn" id="closeModal">×</button>
    </div>
    <div class="apmodal-body">
        <div class="property-carousel" >
        <img src="" alt="" id="modalImage" class="w-full h-full object-cover rounded-2xl">
        </div>
        <div class="apmodal-details">
        <div class="detail-section">
            <h3>Property Information</h3>
            <p>
            <strong>Property:</strong> <span id="modalPropertyName"></span>
            </p>
            <p><strong>Price:</strong> <span id="modalPrice"></span></p>
            <p><strong>Location:</strong> <span id="modalLocation"></span></p>
        </div>
        <div class="detail-section">
            <h3>Agent Contact</h3>
            <p><strong>Agent:</strong> <span id="modalAgent"></span></p>
            <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
            <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        </div>
        <div class="detail-section">
            <h3>Appointment Details</h3>
            <p>
            <strong>Date &amp; Time:</strong>
            <span id="modalDateTime"></span>
            </p>
            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
        </div>
        <div class="detail-section">
            <h3>Notes</h3>
            <p id="modalNotes">
            Please arrive 5 minutes early. Bring valid ID for verification.
            </p>
        </div>
        </div>
        <div class="apmodal-actions">
        <button class="btn btn-primary py-2 px-4 rounded-lg font-semibold">Contact Agent</button>
        <button class="btn btn-secondary py-2 px-4 rounded-lg font-semibold">Mark as Completed</button>
        </div>
    </div>
    </div>
</div>
</div>
</x-agent-dashboard.dashboard-layout>
            
