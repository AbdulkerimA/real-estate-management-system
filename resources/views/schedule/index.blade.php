<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Appointments - Property Sales System</title>
    @vite(['resources/css/schedules.css','resources/js/schedules.js'])
  </head>
  <body>
    <!-- Page Header -->
    <x-nav.nav-layout />

    <div class="container">  
      <div class="page-header mt-12">
        <div class="header-content">
          <h1 id="page-title">My Appointments</h1>
          <p id="page-subtitle">
            Track and manage your scheduled property viewings
          </p>
        </div>
        <div class="header-icon">📅</div>
    </div>
      <!-- Overview Cards -->
      <div class="overview-grid">
        <div class="overview-card">
          <h3>Total</h3>
          <div class="number">{{Number::format($allAp)}}</div>
          <div class="label">All Appointments</div>
        </div>
        <div class="overview-card">
          <h3>Upcoming</h3>
          <div class="number">{{Number::format($pendingAp)}}</div>
          <div class="label">Scheduled Viewings</div>
        </div>
        <div class="overview-card">
          <h3>Completed</h3>
          <div class="number">{{Number::format($completedAp)}}</div>
          <div class="label">Finished Viewings</div>
        </div>
        <div class="overview-card">
          <h3>Cancelled</h3>
          <div class="number">{{Number::format($cancelledAp)}}</div>
          <div class="label">Cancelled Viewings</div>
        </div>
      </div>
      <!-- Reminder Card -->
      {{-- <div class="reminder-card">
        <div class="reminder-icon">⏰</div>
        <div class="reminder-content">
          <h3>Upcoming Reminder</h3>
          <p>
            Your next appointment is tomorrow at 2:00 PM for Luxury Condo in
            Sarbet.
          </p>
        </div>
      </div> --}}
      <!-- Search and Filter Bar -->
      <div class="filter-bar">
        <div class="search-box">
          <input
            type="text"
            id="searchInput"
            placeholder="Search by property name or agent..."
          />
        </div>
        <div class="filter-group">
          <select class="filter-select" id="statusFilter">
            <option value="all">All Status</option>
            <option value="confirmed">Confirmed</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
          </select>
          {{-- <select class="filter-select" id="dateFilter">
            <option value="all">All Dates</option>
            <option value="today">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
          </select> --}}
        </div> 
      </div>
      <!-- Appointments List -->
      <section class="appointments-section">
        <div class="appointments-grid" id="appointmentsList">
          <!-- Appointment cards will be rendered here -->
        </div>
        <!-- Empty State (hidden by default) -->
        <div class="empty-state" id="emptyState" style="display: none">
          <div class="empty-state-icon">📭</div>
          <h2>No Appointments Found</h2>
          <p id="empty-state-message">
            No appointments yet. Schedule your first property viewing!
          </p>
          <button class="btn btn-primary" id="empty-state-button">
            Book Now
          </button>
        </div>
      </section>
    </div>
    <!-- Footer -->
    <x-footer />

    <!-- Modal -->
    <div class="modal" id="detailsModal">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="modalTitle">Appointment Details</h2>
          <button class="close-btn" id="closeModal">×</button>
        </div>
        <div class="modal-body">
          <div class="property-carousel" >
            <img src="" alt="" id="modalImage">
          </div>
          <div class="modal-details">
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
          <div class="modal-actions">
            <button class="btn btn-primary">Contact Agent</button>
            <button class="btn btn-secondary" 
                    onclick="markAsCompleted()" 
                    id="markCompletedBtn">
                    Mark as Completed
                  </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Reschedule Modal -->
    <div class="modal" id="rescheduleModal">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Reschedule Appointment</h2>
          <button class="close-btn" onclick="closeRescheduleModal()">×</button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>New Date</label>
            <input type="date" id="rescheduleDate" class="input-field">
          </div>

          <div class="form-group">
            <label>New Time</label>
            <input type="time" id="rescheduleTime" class="input-field">
          </div>

          <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeRescheduleModal()">
              Cancel
            </button>
            <button class="btn btn-primary" onclick="submitReschedule()">
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </div>

    {{-- {{ dd($appointments) }} --}}
    <script>
        const appointments = @json($appointments);
        window.userRole = "{{ auth()->user()->role }}";
    </script>
  </body>
</html>
