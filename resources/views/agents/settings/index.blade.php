<x-agent-dashboard.dashboard-layout>
<div class="space-y-6">
            <!-- Account Settings -->
            {{-- <div class="settings-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6">Account Settings</h3>
                <form id="accountForm" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">Email Address</label>
                            <input type="email" class="form-input w-full rounded-lg px-4 py-3 text-white" value="sara.tadesse@propertyhub.et" id="accountEmail">
                            <div class="text-red-400 text-xs mt-1 hidden" id="emailError">Please enter a valid email address</div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">Phone Number</label>
                            <input type="tel" class="form-input w-full rounded-lg px-4 py-3 text-white" value="+251 911 234 567" id="accountPhone">
                            <div class="text-red-400 text-xs mt-1 hidden" id="phoneError">Please enter a valid phone number</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-600">
                        <button type="button" class="text-[#00ff88] hover:text-green-400 font-medium" id="changePasswordBtn">
                            Change Password →
                        </button>
                        <button type="submit" class="save-button px-6 py-3 rounded-lg text-[#12181f] font-semibold">
                            Save Account Settings
                        </button>
                    </div>
                    
                    <div class="success-message rounded-lg p-3 text-sm hidden" id="accountSuccess">
                        Account settings updated successfully!
                    </div>
                </form>
            </div> --}}

            <!-- Dashboard Preferences -->
            <div class="settings-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6">Dashboard Preferences</h3>
                <div class="space-y-6">
                    <!-- Language Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">Language</label>
                            <select class="form-input w-full rounded-lg px-4 py-3 text-white" id="language">
                                <option value="en" selected>English</option>
                                <option value="am">አማርኛ (Amharic)</option>
                                <option value="or">Afaan Oromoo (Oromo)</option>
                                <option value="ti">ትግርኛ (Tigrinya)</option>
                                <option value="so">Soomaali (Somali)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">Time Zone</label>
                            <select class="form-input w-full rounded-lg px-4 py-3 text-white" id="timezone">
                                <option value="Africa/Addis_Ababa" selected>East Africa Time (EAT)</option>
                                <option value="UTC">UTC</option>
                                <option value="America/New_York">Eastern Time (ET)</option>
                                <option value="Europe/London">Greenwich Mean Time (GMT)</option>
                                <option value="Asia/Dubai">Gulf Standard Time (GST)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button class="save-button px-6 py-3 rounded-lg text-[#12181f] font-semibold" id="savePreferences">
                            Save Preferences
                        </button>
                    </div>
                    
                    <div class="success-message rounded-lg p-3 text-sm hidden" id="preferencesSuccess">
                        Dashboard preferences updated successfully!
                    </div>
                </div>
            </div>

            <!-- Notifications Settings -->
            <div class="settings-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6">Notification Settings</h3>
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
                        title="Appointment Reminder" 
                        subtitle="Receive updates via email" 
                        action="/dashboard/settings" 
                        :status="$user->settings->appointment_reminder"/>

                    {{-- <x-agent-dashboard.preferences 
                        title="Push Notifications" 
                        subtitle="Receive browser push notifications"
                        :status="$user->settings->appointment_reminder"/> --}}
                    
                </div>
            </div>

            <!-- Privacy & Security -->
            <div class="settings-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6">Privacy & Security</h3>
                <div class="space-y-4">
                    <x-agent-dashboard.preferences 
                        title="Two Factor Authentication" 
                        subtitle="Add an extra layer of security to your account" 
                        action="/dashboard/settings" 
                        :status="$user->settings->two_factor_authentication" />

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
                    
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-600">
                        <div>
                            <p class="text-white font-medium">Download My Data</p>
                            <p class="text-gray-400 text-sm">Export all your account data</p>
                        </div>
                        <button class="save-button px-6 py-3 rounded-lg text-[#12181f] font-semibold" id="downloadDataBtn">
                            Download Data
                        </button>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="danger-zone rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6 text-red-400">Danger Zone</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-white font-medium">Deactivate Account</p>
                            <p class="text-gray-400 text-sm">Temporarily disable your account (can be reactivated)</p>
                        </div>
                        <button class="danger-button px-6 py-3 rounded-lg text-white font-semibold" id="deactivateBtn">
                            Deactivate
                        </button>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-red-500/30">
                        <div>
                            <p class="text-white font-medium">Delete Account Permanently</p>
                            <p class="text-gray-400 text-sm">Permanently delete your account and all data</p>
                        </div>
                        <button class="danger-button px-6 py-3 rounded-lg text-white font-semibold" id="deleteBtn">
                            Delete Forever
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Confirmation Modal -->

    <x-agent-dashboard.confirm-modal />
    
    {{-- <div class="modal" id="confirmModal">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4" id="modalTitle">Confirm Action</h3>
            <p class="text-gray-400 mb-6" id="modalMessage">Are you sure you want to proceed?</p>
            <div class="flex space-x-4">
                <button class="flex-1 bg-gray-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-gray-500" id="modalCancel">
                    Cancel
                </button>
                <button class="flex-1 danger-button px-4 py-3 rounded-lg text-white font-semibold" id="modalConfirm">
                    Confirm
                </button>
            </div>
        </div>
    </div> --}}
    
    <!-- Input Modal -->
    <x-agent-dashboard.input-modal />
    {{-- <div class="modal" id="inputModal">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4" id="inputModalTitle">Final Confirmation</h3>
            <p class="text-gray-400 mb-4" id="inputModalMessage">Type "DELETE" to confirm permanent account deletion.</p>
            <input 
                type="text" 
                id="inputModalField" 
                class="w-full p-3 rounded-lg bg-gray-700 text-white mb-6 outline-none focus:ring-2 focus:ring-red-500" 
                placeholder='Type "DELETE" here...'>
            <div class="flex space-x-4">
                <button class="flex-1 bg-gray-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-gray-500" id="inputModalCancel">
                    Cancel
                </button>
                <button class="flex-1 danger-button px-4 py-3 rounded-lg text-white font-semibold" id="inputModalConfirm">
                    Confirm
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Data Download Progress Modal -->
    <div class="modal" id="downloadModal">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">Preparing Your Data</h3>
            <p class="text-gray-400 mb-4">We're collecting and packaging your data for download...</p>
            <div class="bg-gray-700 rounded-full h-2 mb-4">
                <div class="progress-bar rounded-full" style="width: 0%" id="downloadProgress"></div>
            </div>
            <p class="text-sm text-gray-400 text-center" id="downloadStatus">Initializing...</p>
        </div>
    </div>

</x-agent-dashboard.dashboard-layout>

