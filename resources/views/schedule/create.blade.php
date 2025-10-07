<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Property Viewing - AnchorHomes</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/schedule.css','resources/js/schedule.js'])
    
</head>
<body class="bg-[#12181f] text-white min-h-screen">
    <!-- Navigation -->
    <x-nav.nav-layout />

    <!-- Floating Background Shapes -->
    <div class="floating-shapes fixed inset-0">
        <div class="shape">
            <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="200" fill="#00ff88" rx="40"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                <circle cx="75" cy="75" r="75" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="180" height="180" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
                <polygon points="90,20 160,140 20,140" fill="#00ff88"/>
            </svg>
        </div>
    </div>

    <div class="relative z-10 mt-12">
        <!-- Page Header -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">Schedule a Property Viewing</h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Book an appointment to view this property in person. Our agent will guide you through the property and answer all your questions.</p>
            </div>

            <!-- Property Summary Card -->
            <div class="property-summary-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Property Image -->
                    <div class="property-image rounded-xl w-full md:w-48 h-32 flex items-center justify-center flex-shrink-0">
                        {{-- <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg> --}}
                        <img src="{{ asset('storage/'.(json_decode($property->media->file_path,true)[0] ?? 'default.png')) }}" 
                            alt=""
                            class="rounded-lg h-full w-full"
                        >
                    </div>

                    <!-- Property Details -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold mb-2">{{ $property->name }}</h2>
                        <p class="text-gray-400 mb-3"><i class="fa-solid fa-location-dot text-[#00ff88] mr-2"></i> 
                            {{ $property->location }}    
                        </p>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="mb-4 sm:mb-0">
                                <span class="text-3xl font-bold text-[#00ff88]">ETB {{ number_format($property->price) }}</span>
                            </div>
                            <button
                                onclick="window.location = '/property/{{ $property->id }}'" 
                                class="border-2 border-[#00ff88] text-[#00ff88] px-6 py-2 rounded-lg font-semibold hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                                View Full Details
                            </button>
                        </div>
                        <div class="flex gap-6 mt-4 text-sm text-gray-400">
                            <span><i class="fa-solid fa-bed text-md text-[#00ff88]"></i> {{ $property->details->bed_rooms }} Bedrooms</span>
                            <span><i class="fas fa-bath text-md text-[#00ff88]"></i> {{ $property->details->bath_rooms }} Bathrooms</span>
                            <span><i class="fas fa-ruler-combined text-md text-[#00ff88]"></i> {{ $property->details->area_size }} m²</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Booking Form -->
                <div class="lg:col-span-2">
                    <div class="form-card rounded-2xl p-8">
                        <h3 class="text-2xl font-bold mb-6">Book Your Viewing</h3>
                        
                        <form action="/schedule" method="POST" id="viewingForm" class="space-y-6">
                            @csrf
                            <input type="hidden" name="propertyId" value="{{ $property->id }}">
                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Full Name *</label>
                                    <input 
                                        type="text" 
                                        id="fullName" 
                                        name="fullName" 
                                        value="{{  Auth::user()->name }}"
                                        class="form-input w-full px-4 py-3 rounded-xl" placeholder="Enter your full name" disabled>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Email Address *</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="{{ Auth::user()->email }}"
                                        class="form-input w-full px-4 py-3 rounded-xl" placeholder="your.email@example.com" disabled>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold mb-2">Phone Number *</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone"
                                    value="{{ '+'.Auth::user()->phone }}"
                                    class="form-input w-full px-4 py-3 rounded-xl" placeholder="+251 9XX XXX XXX" disabled>
                            </div>

                            <!-- Date & Time Selection -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Preferred Date *</label>
                                    <input 
                                        type="date" 
                                        name="prefDate" 
                                        value="old('prefDate')"
                                        id="viewingDate" class="form-input w-full px-4 py-3 rounded-xl" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Preferred Time *</label>
                                    <select id="viewingTime" name="prefTime" class="form-input w-full px-4 py-3 rounded-xl" >
                                        <option value="">Select time slot</option>
                                        <option value="09:00">9:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="13:00">1:00 PM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                        <option value="17:00">5:00 PM</option>
                                    </select>
                                    <x-form-input-error fildName="prefTime"/>
                                </div>
                            </div>

                            <!-- Contact Preference -->
                            <div>
                                <label class="block text-sm font-semibold mb-2">Preferred Contact Method</label>
                                <select id="contactMethod" name="contactMethod" class="form-input w-full px-4 py-3 rounded-xl">
                                    <option value="email">Email</option>
                                    <option value="call">Phone Call</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="sms">SMS</option>
                                </select>
                                <x-form-input-error fildName="contactMethod"/>
                            </div>

                            <!-- Additional Notes -->
                            <div>
                                <label class="block text-sm font-semibold mb-2">Additional Notes</label>
                                <textarea id="notes" name="note" class="form-input w-full px-4 py-3 rounded-xl h-24 resize-none" placeholder="Any specific questions or requirements for the viewing?"></textarea>
                                <x-form-input-error fildName="note"/>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="flex items-start">
                                <input type="checkbox" id="terms" class="mt-1 mr-3 w-4 h-4 text-[#00ff88] bg-[#12181f] border-gray-600 rounded focus:ring-[#00ff88]" required>
                                <label for="terms" class="text-sm text-gray-300">
                                    I agree to the <a href="#" class="text-[#00ff88] hover:underline">Terms & Conditions</a> and <a href="#" class="text-[#00ff88] hover:underline">Privacy Policy</a>. I consent to being contacted about this property viewing.
                                </label>
                                {{-- <x-form-input-error fildName=""/> --}}
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="submit-btn w-full bg-[#00ff88] text-[#12181f] py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                                Confirm Appointment
                            </button>
                        </form>

                        <!-- Success/Error Messages -->
                        {{-- <div id="successMessage" class="success-message rounded-xl p-4 mt-6 hidden">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                <div>
                                    <h4 class="font-semibold">Appointment Confirmed!</h4>
                                    <p class="text-sm mt-1">Your viewing has been scheduled. You'll receive confirmation details shortly.</p>
                                </div>
                            </div>
                        </div>

                        <div id="errorMessage" class="error-message rounded-xl p-4 mt-6 hidden">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <div>
                                    <h4 class="font-semibold">Please check your information</h4>
                                    <p class="text-sm mt-1" id="errorText">All required fields must be completed.</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Agent Information -->
                    {{-- <div class="agent-card rounded-2xl p-6">
                        <h3 class="text-xl font-bold mb-4">Your Agent</h3>
                        <div class="text-center">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                                ST
                            </div>
                            <h4 class="text-lg font-semibold mb-1">Sara Tadesse</h4>
                            <p class="text-[#00ff88] font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center items-center mb-4">
                                <div class="text-yellow-400 flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400 text-sm">(4.8/5)</span>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300">+251 922 345 678</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                                <span class="text-gray-300">sara.tadesse@AnchorHomes.et</span>
                            </div>
                        </div>

                        <button class="w-full border-2 border-[#00ff88] text-[#00ff88] py-3 rounded-lg font-semibold hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                            💬 Message Agent
                        </button>
                    </div> --}}
                    {{-- <x-agent.profile /> --}}

                    <!-- Confirmation Info -->
                    <div class="confirmation-card rounded-2xl p-6">
                        <h3 class="text-xl font-bold mb-4">What to Expect</h3>
                        <div class="space-y-4 text-sm text-gray-300">
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-[#00ff88] rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                    <span class="text-[#12181f] text-xs font-bold">1</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-1">Confirmation</h4>
                                    <p>You'll receive email and SMS confirmation within 15 minutes.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-[#00ff88] rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                    <span class="text-[#12181f] text-xs font-bold">2</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-1">Reminder</h4>
                                    <p>We'll send you a reminder 24 hours before your appointment.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-[#00ff88] rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                    <span class="text-[#12181f] text-xs font-bold">3</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-1">Viewing</h4>
                                    <p>Meet [agent name] at the property for a comprehensive tour and Q&A session.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>
</body>
</html>
