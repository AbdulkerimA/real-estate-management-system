<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>My Profile - Property Sales System</title>
  @vite(['resources/js/userProfile.js','resources/css/userProfile.css'])
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-nav.nav-layout />
    <div class="container">
        <!-- Page Header -->
        <header class="page-header">
            <div class="header-content">
                <h1 id="page-title">My Profile</h1>
                <p id="page-subtitle">Manage your account and personal information</p>
            </div>
        </header>
        <!-- Profile Overview Card -->
        <div class="profile-overview">
            <div class="profile-avatar">
                <div class="avatar-circle" id="avatarCircle">
                    @if($user->customer?->media)
                        <img src="{{ asset('storage/'.$user->customer->media->file_path) }}"
                            class="w-full h-full object-cover rounded-full">
                    @else
                        <span id="avatarInitials">
                            {{ strtoupper(substr($user->name,0,1)) }}
                        </span>
                    @endif
                    {{--  --}}
                </div>
                <button class="change-photo-btn" onclick="changePhoto()">📷</button> 
                <input type="file" id="photoInput" class="file-input" accept="image">
            </div>
            <div class="profile-info">
                <h2 id="customer-name">John Smith</h2>
                <div class="email" id="customer-email">
                john.smith@email.com
                </div>
                <div class="profile-stats">
                <div class="stat-item"><span class="stat-number">12</span>
                    <div class="stat-label">
                    Total Appointments
                    </div>
                </div>
                <div class="stat-item"><span class="stat-number">8</span>
                    <div class="stat-label">
                    Properties Viewed
                    </div>
                </div>
                <div class="stat-item"><span class="stat-number">5</span>
                    <div class="stat-label">
                    Saved Properties
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        {{-- {{ dump($user->customer->address) }} --}}
        <div class="form-section">
            <h3 class="section-title">Personal Information</h3>
            <form id="personalInfoForm">
                <div class="form-grid">
                    <input type="text" id="fullName" value="{{ $user->name }}" class="form-input" placeholder="fullname" required>

                    <input type="email" id="email" value="{{ $user->email }}" class="form-input" placeholder="email" required>

                    <input type="tel" id="phone" value="{{ $user->phone }}" class="form-input" placeholder="phone" required>

                    <input type="text" id="address" value="{{ $user->customer->address }}" class="form-input" placeholder="address" required>
                </div>
                <button type="submit" class="btn btn-primary"> Save Changes </button>
            </form>
        </div>
        <!-- Security Settings Section -->
        <div class="form-section">
            <h3 class="section-title"> Security Settings</h3>
            <form id="securityForm">
                <div class="form-grid">
                <div class="form-group"><label for="currentPassword">Current Password</label> <input type="password"
                    id="currentPassword" class="form-input" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password</label> 
                    <input type="password" id="newPassword"
                        class="form-input" placeholder="Enter new password">
                </div>
                <div class="form-group"><label for="confirmPassword">Confirm New Password</label> <input type="password"
                    id="confirmPassword" class="form-input" placeholder="Confirm new password">
                </div>
                </div>
                <div class="toggle-group"><span class="toggle-label">Two-Factor Authentication</span>
                <div class="toggle-switch {{ $user->settings?->two_factor_authentication ? 'active' : '' }}"
                    id="twoFactorToggle"
                    onclick="toggleSwitch('twoFactorToggle')">
                    <div class="toggle-slider"></div>
                </div>
                </div><button type="submit" class="btn btn-primary" style="margin-top: 1.5rem;">Update Security </button>
            </form>
        </div>
        <!-- Preferences Section -->
        <div class="form-section">
            <h3 class="section-title"> Preferences</h3>
            <div class="toggle-group">
                <span class="toggle-label">Email Notifications</span>
                <div class="toggle-switch {{ $user->settings?->email_notification ? 'active' : '' }}" 
                    id="emailNotifications" 
                    onclick="toggleSwitch('emailNotifications')">
                    <div class="toggle-slider"></div>
                </div>
            </div>

            <div class="toggle-group">
                <span class="toggle-label">SMS Notifications</span>
                <div class="toggle-switch {{ $user->settings?->sms_notification ? 'active' : '' }}" 
                    id="smsNotifications" 
                    onclick="toggleSwitch('smsNotifications')">
                    <div class="toggle-slider"></div>
                </div>
            </div>

            <div class="toggle-group">
                <span class="toggle-label">Appointment Reminders</span>
                <div class="toggle-switch {{ $user->settings?->appointment_reminder ? 'active' : '' }}" 
                    id="appointmentReminders" 
                    onclick="toggleSwitch('appointmentReminders')">
                    <div class="toggle-slider"></div>
                </div>
            </div>

            <button class="btn btn-primary" onclick="savePreferences()" style="margin-top: 1.5rem;">
                Save Preferences
            </button>
        </div>

        <!-- Delete Account Section -->
        <div class="px-4 py-8 bg-red-600/20 border border-red-600 rounded-2xl">
            <h3 class="section-title"> Delete Account</h3>
            <p class="warning-text">Once you delete your account, there is no going back. This will permanently delete your
                profile, appointments, saved properties, and all associated data. Please be certain.</p>
            <button class="btn btn-danger" id="deleteAccountBtn" onclick="initiateAccountDeletion()"> 
                Delete My Account
            </button>
        </div>

    </div>
    <x-footer />

</html>