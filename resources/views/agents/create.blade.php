<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as an Agent - AnchorHomes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/agents.css','resources/js/agents.js'])
</head>
<body class="bg-[#12181f] text-white min-h-screen">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape">
            <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="200" fill="#00ff88" rx="50"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="160" height="160" viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
                <circle cx="80" cy="80" r="80" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="180" height="180" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
                <polygon points="90,20 160,140 20,140" fill="#00ff88"/>
            </svg>
        </div>
    </div>
    <div class="text-red-500">
        {{-- {{ count($errors) > 0 ? dd($errors) : '' }} --}}
        {{-- @foreach ($errors as $item)
            <p>
                {{ $item }}
            </p>
        @endforeach --}}
    </div>
    <!-- Main Container -->
    <div class="relative z-10 min-h-screen py-12 px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Join as an Agent</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Register to list and manage properties with us</p>
        </div>

        <!-- Registration Form -->
        <div class="max-w-4xl mx-auto">
            <form action="/agent/register" method="POST" enctype="multipart/form-data" id="signupForm" class="space-y-8">
                @csrf
                
                <!-- Personal Information -->
                <div class="form-card rounded-2xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-accent-green/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Personal Information</h3>
                            <p class="text-gray-400">Tell us about yourself</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Profile Photo -->
                        <div class="lg:col-span-1">
                            <label class="block text-gray-300 text-sm font-medium mb-4">Profile Photo</label>
                            <div class="upload-area rounded-xl p-6 text-center" id="photoUploadArea">
                                <div id="photoPreview" class="hidden">
                                    <img id="previewImage" class="profile-preview mx-auto mb-4" src="" alt="Profile Preview">
                                    <button type="button" class="text-accent-green text-sm hover:underline" onclick="changePhoto()">Change Photo</button>
                                </div>
                                <div id="photoUploadPrompt">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-400 text-sm mb-4">Upload your photo</p>
                                    <button type="button" class="primary-button px-4 py-2 rounded-lg text-[#12181f] font-medium text-sm" onclick="document.getElementById('photoInput').click()">
                                        Choose Photo
                                    </button>
                                </div>
                                <input 
                                    type="file" 
                                    id="photoInput" 
                                    name='profilePic' 
                                    accept="image/*" 
                                    class="hidden"
                                    {{-- value = "{{ old('profilePic') }}"   --}}
                                    required>
                            </div>
                        </div>

                        <!-- Personal Details -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2">Full Name *</label>
                                    <input 
                                        type="text" 
                                        name="fullName" 
                                        class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                        placeholder="Enter your full name" 
                                        value="{{ old('fullName') }}"
                                        required
                                        >
                                    <x-form-input-error fildName="fullName" />
                                </div>
                                
                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2">Email Address *</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                        placeholder="your.email@example.com" 
                                        value="{{ old('email') }}"
                                        required
                                        >
                                    <x-form-input-error fildName="email" />
                                </div>

                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2">Phone Number *</label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                        placeholder="+251 911 123 456" 
                                        value="{{ old('phone') }}"
                                        required>
                                    <x-form-input-error fildName="phone" />
                                </div>

                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2">Location *</label>
                                    <input 
                                        type="text" 
                                        name="location" 
                                        class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                        placeholder="City, Country" 
                                        value="{{ old('location') }}"
                                        required>
                                    <x-form-input-error fildName="location" />
                                </div>
                            </div>

                            {{-- <div>
                                <label class="block text-gray-300 text-sm font-medium mb-2">Agency/Company Name</label>
                                <input type="text" name="company" class="form-input w-full px-4 py-3 rounded-lg text-white" placeholder="Your agency or company name (optional)">
                            </div> --}}

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2">Password *</label>
                                    <input 
                                        type="password" 
                                        name="password"
                                        id="password" 
                                        class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                        placeholder="Create a strong password" 
                                        {{-- value="{{ old('pa') }}" --}}
                                        required>
                                    <div class="password-strength mt-2" id="passwordStrength"></div>
                                    <p class="text-gray-400 text-xs mt-1">Minimum 8 characters with letters and numbers</p>
                                    <x-form-input-error fildName="password" />
                                </div>

                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2">Confirm Password *</label>
                                    <input type="password" name="password_confirmation" id="confirmPassword" class="form-input w-full px-4 py-3 rounded-lg text-white" placeholder="Confirm your password" required>
                                    <div id="passwordMatch" class="text-xs mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Details -->
                <div class="form-card rounded-2xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-inbox text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Professional Details</h3>
                            <p class="text-gray-400">Your experience and expertise</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Years of Experience *</label>
                            <input 
                                type="number" 
                                name="experience" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                placeholder="0" min="0" max="50" 
                                value="{{ old('experience') }}"
                                required>
                            <x-form-input-error fildName="experience" />
                        </div>

                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Specialty *</label>
                            <select name="speciality" class="form-input w-full px-4 py-3 rounded-lg text-white" required>
                                <option value="">Select your specialty</option>
                                <option value="apartments">Apartments</option>
                                <option value="houses">Houses</option>
                                <option value="lands">Lands</option>
                                <option value="commercial">Commercial Properties</option>
                                <option value="luxury">Luxury Properties</option>
                                <option value="all">All Property Types</option>
                            </select>
                            <x-form-input-error fildName="speciality" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Bio</label>
                        <textarea name="bio" rows="1" class="form-input w-full px-4 py-3 rounded-lg text-white resize-none" placeholder="Tell potential clients about your background, expertise, and approach to real estate in short terms..."></textarea>
                        <x-form-input-error fildName="bio" />
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">About Me</label>
                        <textarea name="about" rows="6" class="form-input w-full px-4 py-3 rounded-lg text-white resize-none" placeholder="Explain yourself in more details"></textarea>
                        <x-form-input-error fildName="about" />
                    </div>
                </div>

                <!-- Document Upload -->
                <div class="form-card rounded-2xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-purple-400/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Document Verification</h3>
                            <p class="text-gray-400">Upload required documents for verification</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-300 text-sm mb-4">Please upload your professional license or ID for verification. Accepted formats: PDF, JPG, PNG (Max 5MB each)</p>
                        
                        <div class="upload-area rounded-xl p-8 text-center mb-6" id="documentUploadArea">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <h4 class="text-white font-medium mb-2">Drop documents here or click to upload</h4>
                            <p class="text-gray-400 text-sm mb-4">Professional license, ID, certifications</p>
                            <input type="file" id="documentInput" name="documentInput[]" multiple accept=".pdf,.jpg,.jpeg,.png" class="hidden" required>
                            <button type="button" class="primary-button px-6 py-3 rounded-lg text-[#12181f] font-medium" onclick="document.getElementById('documentInput').click()">
                                Choose Documents
                            </button>
                        </div>

                        <div id="documentList" class="space-y-3 hidden">
                            <!-- Uploaded documents will appear here --> 
                        </div>
                    </div>
                </div>

                <!-- Agreement & Terms -->
                <div class="form-card rounded-2xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Agreement & Verification</h3>
                            <p class="text-gray-400">Confirm your agreement to our terms</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="flex items-start">
                            <input type="checkbox" name="agreeTerms" class="checkbox-custom mt-1 mr-3" required>
                            <div>
                                <span class="text-white">I agree to the <a href="#" class="text-accent-green hover:underline">Terms & Conditions</a> and <a href="#" class="text-accent-green hover:underline">Privacy Policy</a> *</span>
                                <p class="text-gray-400 text-sm mt-1">By checking this box, you agree to our terms of service and privacy policy</p>
                            </div>
                        </label>

                        <label class="flex items-start">
                            <input type="checkbox" name="confirmAccuracy" class="checkbox-custom mt-1 mr-3" required>
                            <div>
                                <span class="text-white">I confirm all information provided is accurate *</span>
                                <p class="text-gray-400 text-sm mt-1">False information may result in account suspension</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="primary-button px-12 py-4 rounded-xl text-[#12181f] font-bold text-lg" id="submitBtn">
                        Sign Up as Agent
                    </button>
                    <p class="text-gray-400 text-sm mt-4">
                        Already have an account? 
                        <a href="/login" class="text-accent-green hover:underline font-medium">Log in here</a>
                    </p>
                </div>

            </form>

            <!-- Social Signup -->
            <div class="divider">
                <span>Or Sign Up With</span>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <button class="social-button flex-1 flex items-center justify-center px-6 py-3 rounded-lg text-white font-medium">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>
                <button class="social-button flex-1 flex items-center justify-center px-6 py-3 rounded-lg text-white font-medium">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-16 pb-8">
            <p class="text-gray-400 text-sm">© 2025 AnchorHomes</p>
        </footer>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
        <div class="form-card rounded-2xl p-8 w-full max-w-md mx-4 text-center">
            <div class="w-16 h-16 bg-accent-green bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Registration Successful!</h3>
            <p class="text-gray-400 mb-6">Welcome to AnchorHomes! Your account is being reviewed and you'll receive a confirmation email shortly.</p>
            
            <button class="primary-button w-full px-6 py-3 rounded-lg text-[#12181f] font-medium" onclick="closeModal()">
                Continue to Dashboard
            </button>
        </div>
    </div>
</body>
</html>
