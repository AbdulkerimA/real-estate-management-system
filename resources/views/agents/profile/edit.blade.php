<x-agent-dashboard.dashboard-layout>
<!-- Main Content -->
    <div class=" space-y-6">
        <!-- Profile Overview Card -->
        <div class="profile-card rounded-2xl p-8">
            <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-6 lg:space-y-0 lg:space-x-8">
                <!-- Profile Photo -->
                <div class="profile-photo" id="profilePhoto">
                    <div class="w-32 h-32 bg-gradient-to-br from-[#00ff88] to-green-600 rounded-full flex items-center justify-center text-[#12181f] font-bold text-4xl relative overflow-hidden">
                        <img 
                            src="{{ asset('storage/'.$user->agentProfile->media->file_path) }}" 
                            alt="Profile" 
                            class="w-full h-full object-cover rounded-full hidden" 
                            id="profileImage"
                            >
                        {{-- <span id="profileInitials">ST</span> --}}
                        <div class="photo-overlay">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                    <input type="file" id="photoInput" accept="image/*" class="hidden">
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-white mb-2">{{ $user->agentProfile->user->name }}</h2>
                    <p class="text-[#00ff88] text-lg font-medium mb-4">{{ $user->agentProfile->speciality }}</p>
                    <p class="text-gray-400 mb-6">
                        {{-- Specializing in luxury properties and commercial real estate in Addis Ababa. Helping clients find their perfect property for over 8 years. --}}
                        {{ $user->agentProfile->bio }}
                    </p>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="stat-card rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-[#00ff88] counter" data-target="{{ count($properties) }}">0</p>
                            <p class="text-gray-400 text-sm">Properties Listed</p>
                        </div>
                        <div class="stat-card rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-[#00ff88] counter" data-target="{{ $user->agentProfile->deals_closed }}">0</p>
                            <p class="text-gray-400 text-sm">Deals Closed</p>
                        </div>
                        <div class="stat-card rounded-xl p-4 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <p class="text-2xl font-bold text-[#00ff88]">4.9</p>
                                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-400 text-sm">Agent Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="profile-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6">Personal Information</h3>
                <form method="POST" action="/dashboard/profile/edit" id="personalForm" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Full Name</label>
                        <input 
                            type="text"
                            name="fullName"
                            value="{{ $user->agentProfile->user->name }}" 
                            class="form-input w-full rounded-lg px-4 py-3 text-white" 
                            id="fullName">
                            <x-form-input-error fildName="fullName" />
                        <div class="text-red-400 text-xs mt-1 hidden" id="fullNameError">Please enter your full name</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Email Address</label>
                        <input 
                            type="email"
                            name = "email"
                            class="form-input w-full rounded-lg px-4 py-3 text-white" 
                            value="{{ $user->agentProfile->user->email }}" 
                            id="email">
                            <x-form-input-error fildName="email" />
                        <div class="text-red-400 text-xs mt-1 hidden" id="emailError">Please enter a valid email address</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Phone Number</label>
                        <input 
                            type="tel" 
                            name="phone"
                            class="form-input w-full rounded-lg px-4 py-3 text-white" 
                            value="{{ $user->agentProfile->user->phone }}" 
                            id="phone">
                            <x-form-input-error fildName="phone" />
                        <div class="text-red-400 text-xs mt-1 hidden" id="phoneError">Please enter a valid phone number</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Location</label>
                        <input 
                            type="text" 
                            name="location"
                            class="form-input w-full rounded-lg px-4 py-3 text-white" 
                            value="{{ $user->agentProfile->address}}" 
                            id="location">
                            <x-form-input-error fildName="location" />
                    </div>
                    
                    <button type="submit" class="save-button w-full py-3 rounded-lg text-[#12181f] font-semibold">
                        Save Personal Information
                    </button>
                    
                    <div class="success-message rounded-lg p-3 text-sm hidden" id="personalSuccess">
                        Personal information updated successfully!
                    </div>
                </form>
            </div>

            <!-- Professional Information -->
            <div class="profile-card rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-6">Professional Information</h3>
                <form method="POST" action="/dashboard/profile/edit" id="professionalForm" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Agency/Company Name</label>
                        <input 
                            type="text" 
                            class="form-input w-full rounded-lg px-4 py-3 text-white" value="AnchorHomes" id="agency" disabled>
                    </div>
                    {{-- bio --}}
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Bio / About Me</label>
                        <textarea name="bio" class="form-input w-full rounded-lg px-4 py-3 text-white row-2 resize-none" maxlength="500" id="bio" placeholder="Tell clients about yourself and your expertise...">
                            {{-- Experienced real estate agent specializing in luxury properties and commercial real estate in Addis Ababa. I have successfully helped over 100 families find their dream homes and assisted numerous businesses in securing prime commercial locations. --}}
                            {{ trim($user->agentProfile->bio,'') }}
                        </textarea>
                        <x-form-input-error fildName="bio" />
                        <div class="flex justify-between items-center mt-1">
                            <div class="text-red-400 text-xs hidden" id="bioError">bio is too long</div>
                            <div class="text-gray-400 text-xs" id="bioCounter">
                                <span id="bioCount"></span>/2250
                            </div>
                        </div>
                    </div>

                    {{-- // about me --}}
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Bio / About Me</label>
                        <textarea name="about_me" class="form-input w-full rounded-lg px-4 py-3 text-white h-44 resize-none" maxlength="500" id="about_me" placeholder="Tell clients about yourself and your expertise...">
                            {{-- Experienced real estate agent specializing in luxury properties and commercial real estate in Addis Ababa. I have successfully helped over 100 families find their dream homes and assisted numerous businesses in securing prime commercial locations. --}}
                            {{ $user->agentProfile->about_me }}
                        </textarea>
                        <x-form-input-error fildName="about_me" />
                        <div class="flex justify-between items-center mt-1">
                            <div class="text-red-400 text-xs hidden" id="bioError">about me is too long</div>
                            <div class="text-gray-400 text-xs" id="bioCounter">
                                <span id="bioCount"></span>/2250
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="save-button w-full py-3 rounded-lg text-[#12181f] font-semibold">
                        Save Professional Information
                    </button>
                    
                    <div class="success-message rounded-lg p-3 text-sm hidden" id="professionalSuccess">
                        Professional information updated successfully!
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Section -->
        <div class="profile-card rounded-2xl p-6">
            <h3 class="text-xl font-bold mb-6">Security Settings</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Change Password -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Change Password</h4>
                    <form method="POST" action="/dashboard/profile/edit" id="passwordForm" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">Current Password</label>
                            <input 
                                type="password" 
                                name="current_password"
                                class="form-input w-full rounded-lg px-4 py-3 text-white"
                                id="currentPassword">
                                <x-form-input-error fildName="password" />
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">New Password</label>
                            <input 
                                type="password"
                                name="password"
                                class="form-input w-full rounded-lg px-4 py-3 text-white" 
                                id="newPassword">
                                <x-form-input-error fildName="password" />
                            <div class="mt-2">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs text-gray-400">Password Strength</span>
                                    <span class="text-xs text-gray-400" id="strengthText">Enter password</span>
                                </div>
                                <div class="w-full bg-gray-700 rounded-full h-1">
                                    <div class="password-strength rounded-full" id="strengthBar"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 text-sm font-medium mb-2">Confirm New Password</label>
                            <input 
                                type="password" 
                                name="password_confirmation"
                                class="form-input w-full rounded-lg px-4 py-3 text-white" 
                                id="password_confirmation">
                                <x-form-input-error fildName="password" />
                            <div class="text-red-400 text-xs mt-1 hidden" id="passwordError">Passwords do not match</div>
                        </div>
                        
                        <button type="submit" class="save-button w-full py-3 rounded-lg text-[#12181f] font-semibold">
                            Update Password
                        </button>
                        
                        <div class="success-message rounded-lg p-3 text-sm hidden" id="passwordSuccess">
                            Password updated successfully!
                        </div>
                    </form>
                </div>

                <!-- Two-Factor Authentication -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Two-Factor Authentication</h4>
                    <div class="space-y-4">
                        <x-agent-dashboard.preferences 
                            title='Email Authentication' 
                            subTitle='Receive codes via email'
                            action="/dashboard/profile/edit" 
                            :status="$user->settings->two_factor_authentication" />

                        {{-- <div class="flex items-center justify-between p-4 bg-[#12181f] rounded-lg">
                            <div>
                                <p class="text-white font-medium">SMS Authentication</p>
                                <p class="text-gray-400 text-sm">Receive codes via SMS</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="smsAuth">
                                <span class="toggle-slider"></span>
                            </label>
                        </div> --}}
                        
                        {{-- <div class="flex items-center justify-between p-4 bg-[#12181f] rounded-lg">
                            <div>
                                <p class="text-white font-medium">Email Authentication</p>
                                <p class="text-gray-400 text-sm">Receive codes via email</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="emailAuth" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div> --}}
                        
                        <div class="bg-blue-500/10 border border-blue-500 border-opacity-30 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-blue-400 font-medium text-sm">Security Tip</p>
                                    <p class="text-blue-300 text-xs mt-1">Enable two-factor authentication to add an extra layer of security to your account.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Preferences -->
    </div>
</x-agent-dashboard.dashboard-layout>
