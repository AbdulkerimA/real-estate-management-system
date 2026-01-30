<x-admin-dashboard.main-layout>
    @vite(['resources/css/admin-style/settings.css','resources/js/admin-js/settings.js'])
    
    @php
        $user = Auth::user(); 
        // dd($user);
    @endphp
    
    <!-- Page Content -->
    <div class="p-6 space-y-6">
        <!-- Account Settings -->
        <div class="settings-card rounded-2xl p-6"> 
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-[#00ff88]/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Account Settings</h3>
                    <p class="text-gray-400 text-sm">Update your personal information and credentials</p>
                </div>
            </div>

            <form id="accountSettingsForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Admin Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" 
                            class="form-input w-full px-4 py-3 rounded-lg text-white">
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" 
                            class="form-input w-full px-4 py-3 rounded-lg text-white">
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ $user->phone }}" 
                            class="form-input w-full px-4 py-3 rounded-lg text-white">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="save-button px-6 py-3 rounded-lg text-[#12181f] font-medium">
                        Save Changes
                    </button>
                </div>
            </form>


            <div class="section-divider"></div>

            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-white font-medium">Change Password</h4>
                    <p class="text-gray-400 text-sm">Update your account password for security</p>
                </div>
                <button class="secondary-button px-4 py-2 rounded-lg font-medium" onclick="openPasswordModal()">
                    Change Password
                </button>
            </div>

            <div class="flex justify-end mt-6">
                <button class="save-button px-6 py-3 rounded-lg text-[#12181f] font-medium" onclick="saveAccountSettings()">
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Platform Preferences -->
        {{-- <div class="settings-card rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Platform Preferences</h3>
                    <p class="text-gray-400 text-sm">Customize your dashboard experience</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="setting-item">
                    <div>
                        <h4 class="text-white font-medium">Theme</h4>
                        <p class="text-gray-400 text-sm">Choose your preferred interface theme</p>
                    </div>
                    <select class="form-input px-4 py-2 rounded-lg text-white">
                        <option value="dark" selected>Dark Mode</option>
                        <option value="light">Light Mode</option>
                        <option value="auto">Auto (System)</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div>
                        <h4 class="text-white font-medium">Language</h4>
                        <p class="text-gray-400 text-sm">Select your preferred language</p>
                    </div>
                    <select class="form-input px-4 py-2 rounded-lg text-white">
                        <option value="en" selected>English</option>
                        <option value="am">አማርኛ (Amharic)</option>
                        <option value="or">Oromiffa</option>
                        <option value="ti">ትግርኛ (Tigrinya)</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div>
                        <h4 class="text-white font-medium">Time Zone</h4>
                        <p class="text-gray-400 text-sm">Set your local time zone</p>
                    </div>
                    <select class="form-input px-4 py-2 rounded-lg text-white">
                        <option value="Africa/Addis_Ababa" selected>East Africa Time (EAT)</option>
                        <option value="UTC">UTC</option>
                        <option value="America/New_York">Eastern Time</option>
                        <option value="Europe/London">Greenwich Mean Time</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div>
                        <h4 class="text-white font-medium">Date Format</h4>
                        <p class="text-gray-400 text-sm">Choose how dates are displayed</p>
                    </div>
                    <select class="form-input px-4 py-2 rounded-lg text-white">
                        <option value="dd/mm/yyyy" selected>DD/MM/YYYY</option>
                        <option value="mm/dd/yyyy">MM/DD/YYYY</option>
                        <option value="yyyy-mm-dd">YYYY-MM-DD</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="save-button px-6 py-3 rounded-lg text-[#12181f] font-medium" onclick="savePreferences()">
                    Save Preferences
                </button>
            </div>
        </div> --}}

        <!-- Notification Settings -->
        <div class="settings-card rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v5c0 5.25-3.5 9.75-8 11-4.5-1.25-8-5.75-8-11V7l8-4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Notification Settings</h3>
                    <p class="text-gray-400 text-sm">Control what notifications you receive</p>
                </div>
            </div>

            <div class="space-y-4">
                 <x-agent-dashboard.preferences 
                        title="Email Notification" 
                        subtitle="Receive updates via email" 
                        action="/dashboard/settings"
                        :status="$user->settings->email_notification" />

                    <x-agent-dashboard.preferences 
                        title="SMS Notification" 
                        subtitle="Receive updates via SMS"  
                        action="/dashboard/settings"
                        :status="$user->settings->sms_notification" />
                    <x-agent-dashboard.preferences 
                        title="Show Online Status" 
                        subtitle="Let clients see when you're online" 
                        action="/dashboard/settings" 
                        :status="$user->settings->show_online_status"
                         />
                        
                    <x-agent-dashboard.preferences 
                        title="Allow Direct Message" 
                        subtitle="Allow clients to send you direct messages" 
                        status="checked" 
                        action="/dashboard/settings" 
                        :status="$user->settings->allow_direct_message"/>

            </div>
        </div>

        <!-- Security & Privacy -->
        <div class="settings-card rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-red-400/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Security & Privacy</h3>
                    <p class="text-gray-400 text-sm">Manage security settings and privacy controls</p>
                </div>
            </div>

            <div class="space-y-4">
                <x-agent-dashboard.preferences 
                    title="Two-Factor Authentication"
                    subtitle="Add an extra layer of security to your account"
                    action="/dashboard/settings"
                    :status="$user->settings->two_factor_authentication" 
                />

                <x-agent-dashboard.preferences 
                    title="Admin Activity Logs"
                    subtitle="Track all administrative actions"
                    action="/dashboard/settings"
                    :status="$user->settings->admin_activity_logs" 
                />

                <x-agent-dashboard.preferences 
                    title="Auto-Logout"
                    subtitle="Automatically logout after 30 minutes of inactivity"
                    action="/dashboard/settings"
                    :status="$user->settings->auto_logout" 
                />

                <x-agent-dashboard.preferences 
                    title="Login Notifications"
                    subtitle="Get notified of new login attempts"
                    action="/dashboard/settings"
                    :status="$user->settings->login_notifications" 
                />

            </div>

            <div class="section-divider"></div>

            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-white font-medium">Download System Logs</h4>
                    <p class="text-gray-400 text-sm">Export security and activity logs</p>
                </div>
                <button class="secondary-button px-4 py-2 rounded-lg font-medium" onclick="downloadLogs()">
                    Download Logs
                </button>
            </div>
        </div>

        <!-- System Controls -->
        {{-- <div class="settings-card rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-purple-400/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">System Controls</h3>
                    <p class="text-gray-400 text-sm">Administrative system management tools</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <button class="secondary-button p-4 rounded-xl font-medium text-center" onclick="backupDatabase()">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                    Backup Database
                </button>

                <button class="secondary-button p-4 rounded-xl font-medium text-center" onclick="restoreDatabase()">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Restore Backup
                </button>

                <button class="secondary-button p-4 rounded-xl font-medium text-center" onclick="clearCache()">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Clear Cache
                </button>
            </div>

            <div class="section-divider"></div>

            <div>
                <h4 class="text-white font-medium mb-4">API Keys & Integrations</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-[#12181f] rounded-lg">
                        <div>
                            <p class="text-white font-medium">Payment Gateway API</p>
                            <p class="text-gray-400 text-sm">Chapa Payment Integration</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="api-key-display px-3 py-1 rounded text-sm text-gray-300">
                                CAPI_••••••••••••••••••••••••••••••••
                            </div>
                            <button class="copy-button px-3 py-1 rounded text-sm font-medium" onclick="copyApiKey('payment')">
                                Copy
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-[#12181f] rounded-lg">
                        <div>
                            <p class="text-white font-medium">SMS Service API</p>
                            <p class="text-gray-400 text-sm">Notification Service</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="api-key-display px-3 py-1 rounded text-sm text-gray-300">
                                SMS_••••••••••••••••••••••••••••••••
                            </div>
                            <button class="copy-button px-3 py-1 rounded text-sm font-medium" onclick="copyApiKey('sms')">
                                Copy
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-[#12181f] rounded-lg">
                        <div>
                            <p class="text-white font-medium">Maps Integration</p>
                            <p class="text-gray-400 text-sm">Google Maps API</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="api-key-display px-3 py-1 rounded text-sm text-gray-300">
                                GMAP_••••••••••••••••••••••••••••••••
                            </div>
                            <button class="copy-button px-3 py-1 rounded text-sm font-medium" onclick="copyApiKey('maps')">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Danger Zone -->
        <div class="danger-zone rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-red-400">Danger Zone</h3>
                    <p class="text-gray-400 text-sm">Irreversible and destructive actions</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-dark-secondary rounded-lg border border-red-500 border-opacity-30">
                    <div>
                        <h4 class="text-white font-medium">Deactivate Platform</h4>
                        <p class="text-gray-400 text-sm">Temporarily disable the entire platform</p>
                    </div>
                    <button class="danger-button px-4 py-2 rounded-lg text-white font-medium" id="deactivateBtn">
                        Deactivate
                    </button>
                </div>

                <div class="flex items-center justify-between p-4 bg-dark-secondary rounded-lg border border-red-500 border-opacity-30">
                    <div>
                        <h4 class="text-white font-medium">Delete Admin Account</h4>
                        <p class="text-gray-400 text-sm">Permanently delete your administrator account</p>
                    </div>
                    <button class="danger-button px-4 py-2 rounded-lg text-white font-medium" id="deleteBtn">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Password Change Modal -->
    <div id="passwordModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="settings-card rounded-2xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Change Password</h3>
                <button onclick="closePasswordModal()" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Current Password</label>
                    <input type="password" id="current_password" class="form-input w-full px-4 py-3 rounded-lg text-white" placeholder="Enter current password">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">New Password</label>
                    <input type="password" id="new_password" class="form-input w-full px-4 py-3 rounded-lg text-white" placeholder="Enter new password">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" class="form-input w-full px-4 py-3 rounded-lg text-white" placeholder="Confirm new password">
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="closePasswordModal()" class="secondary-button px-4 py-2 rounded-lg font-medium">
                    Cancel
                </button>
                <button onclick="changePassword()" class="save-button px-4 py-2 rounded-lg text-dark-secondary font-medium">
                    Update Password
                </button>
            </div>
        </div>
    </div>

    {{-- // delete account modal --}}
    <x-agent-dashboard.input-modal />

    {{-- deactivate account modal --}}
    <x-agent-dashboard.confirm-modal />
    
</x-admin-dashboard.main-layout>