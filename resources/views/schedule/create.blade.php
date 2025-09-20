<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Property Viewing - PropertyHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-primary': '#1c252e',
                        'dark-secondary': '#12181f',
                        'accent-green': '#00ff88'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .form-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .property-summary-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .agent-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .confirmation-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .shape {
            position: absolute;
            opacity: 0.03;
            animation: float 15s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: 7s;
        }
        
        .shape:nth-child(3) {
            bottom: 15%;
            left: 15%;
            animation-delay: 3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-50px) rotate(180deg); }
        }
        
        .form-input {
            background: rgba(18, 24, 31, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: #00ff88;
            box-shadow: 0 0 0 3px rgba(0, 255, 136, 0.1);
            outline: none;
        }
        
        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .submit-btn {
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 136, 0.3);
        }
        
        .property-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .success-message {
            background: rgba(0, 255, 136, 0.1);
            border: 1px solid #00ff88;
            color: #00ff88;
        }
        
        .error-message {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid #ff4444;
            color: #ff4444;
        }
    </style>
</head>
<body class="bg-dark-secondary text-white min-h-screen">
    <!-- Navigation -->
    <nav class="bg-dark-primary border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-accent-green rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-accent-green">PropertyHub</span>
                    </div>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Home</a>
                    <a href="#" class="text-accent-green font-semibold">Properties</a>
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Agents</a>
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">About</a>
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Contact</a>
                </div>
                <button class="md:hidden text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

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

    <div class="relative z-10">
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
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>

                    <!-- Property Details -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold mb-2">Luxury Apartment in Bole</h2>
                        <p class="text-gray-400 mb-3">📍 Bole, Addis Ababa, Ethiopia</p>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="mb-4 sm:mb-0">
                                <span class="text-3xl font-bold text-accent-green">ETB 4,500,000</span>
                                <span class="text-gray-400 ml-2">($82,000 USD)</span>
                            </div>
                            <button class="border-2 border-accent-green text-accent-green px-6 py-2 rounded-lg font-semibold hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                View Full Details
                            </button>
                        </div>
                        <div class="flex gap-6 mt-4 text-sm text-gray-400">
                            <span>🛏️ 3 Bedrooms</span>
                            <span>🚿 2 Bathrooms</span>
                            <span>📐 120 m²</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Booking Form -->
                <div class="lg:col-span-2">
                    <div class="form-card rounded-2xl p-8">
                        <h3 class="text-2xl font-bold mb-6">Book Your Viewing</h3>
                        
                        <form id="viewingForm" class="space-y-6">
                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Full Name *</label>
                                    <input type="text" id="fullName" class="form-input w-full px-4 py-3 rounded-xl" placeholder="Enter your full name" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Email Address *</label>
                                    <input type="email" id="email" class="form-input w-full px-4 py-3 rounded-xl" placeholder="your.email@example.com" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold mb-2">Phone Number *</label>
                                <input type="tel" id="phone" class="form-input w-full px-4 py-3 rounded-xl" placeholder="+251 9XX XXX XXX" required>
                            </div>

                            <!-- Date & Time Selection -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Preferred Date *</label>
                                    <input type="date" id="viewingDate" class="form-input w-full px-4 py-3 rounded-xl" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Preferred Time *</label>
                                    <select id="viewingTime" class="form-input w-full px-4 py-3 rounded-xl" required>
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
                                </div>
                            </div>

                            <!-- Contact Preference -->
                            <div>
                                <label class="block text-sm font-semibold mb-2">Preferred Contact Method</label>
                                <select id="contactMethod" class="form-input w-full px-4 py-3 rounded-xl">
                                    <option value="email">Email</option>
                                    <option value="call">Phone Call</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="sms">SMS</option>
                                </select>
                            </div>

                            <!-- Additional Notes -->
                            <div>
                                <label class="block text-sm font-semibold mb-2">Additional Notes</label>
                                <textarea id="notes" class="form-input w-full px-4 py-3 rounded-xl h-24 resize-none" placeholder="Any specific questions or requirements for the viewing?"></textarea>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="flex items-start">
                                <input type="checkbox" id="terms" class="mt-1 mr-3 w-4 h-4 text-accent-green bg-dark-secondary border-gray-600 rounded focus:ring-accent-green" required>
                                <label for="terms" class="text-sm text-gray-300">
                                    I agree to the <a href="#" class="text-accent-green hover:underline">Terms & Conditions</a> and <a href="#" class="text-accent-green hover:underline">Privacy Policy</a>. I consent to being contacted about this property viewing.
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="submit-btn w-full bg-accent-green text-dark-secondary py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                                Confirm Appointment
                            </button>
                        </form>

                        <!-- Success/Error Messages -->
                        <div id="successMessage" class="success-message rounded-xl p-4 mt-6 hidden">
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
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Agent Information -->
                    <div class="agent-card rounded-2xl p-6">
                        <h3 class="text-xl font-bold mb-4">Your Agent</h3>
                        <div class="text-center">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                                ST
                            </div>
                            <h4 class="text-lg font-semibold mb-1">Sara Tadesse</h4>
                            <p class="text-accent-green font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center items-center mb-4">
                                <div class="text-yellow-400 flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400 text-sm">(4.8/5)</span>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300">+251 922 345 678</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                                <span class="text-gray-300">sara.tadesse@propertyhub.et</span>
                            </div>
                        </div>

                        <button class="w-full border-2 border-accent-green text-accent-green py-3 rounded-lg font-semibold hover:bg-accent-green hover:text-dark-secondary transition-colors">
                            💬 Message Agent
                        </button>
                    </div>

                    <!-- Confirmation Info -->
                    <div class="confirmation-card rounded-2xl p-6">
                        <h3 class="text-xl font-bold mb-4">What to Expect</h3>
                        <div class="space-y-4 text-sm text-gray-300">
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-accent-green rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                    <span class="text-dark-secondary text-xs font-bold">1</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-1">Confirmation</h4>
                                    <p>You'll receive email and SMS confirmation within 15 minutes.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-accent-green rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                    <span class="text-dark-secondary text-xs font-bold">2</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-1">Reminder</h4>
                                    <p>We'll send you a reminder 24 hours before your appointment.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-accent-green rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                    <span class="text-dark-secondary text-xs font-bold">3</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-1">Viewing</h4>
                                    <p>Meet Sara at the property for a comprehensive tour and Q&A session.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark-primary border-t border-gray-700 py-12 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-accent-green rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-accent-green">PropertyHub</span>
                        </div>
                        <p class="text-gray-400 mb-6 max-w-md">Your trusted partner in real estate. Connecting buyers, sellers, and agents across Addis Ababa with innovative technology and professional service.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-dark-secondary rounded-lg flex items-center justify-center hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-secondary rounded-lg flex items-center justify-center hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-secondary rounded-lg flex items-center justify-center hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">About</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Properties</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Agents</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">FAQs</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Legal</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Cookie Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Disclaimer</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 PropertyHub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('viewingDate').setAttribute('min', today);

        // Form submission handling
        document.getElementById('viewingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const viewingDate = document.getElementById('viewingDate').value;
            const viewingTime = document.getElementById('viewingTime').value;
            const terms = document.getElementById('terms').checked;
            
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            
            // Hide previous messages
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            
            // Validation
            if (!fullName || !email || !phone || !viewingDate || !viewingTime || !terms) {
                errorText.textContent = 'Please fill in all required fields and accept the terms & conditions.';
                errorMessage.classList.remove('hidden');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errorText.textContent = 'Please enter a valid email address.';
                errorMessage.classList.remove('hidden');
                return;
            }
            
            // Date validation (not in the past)
            const selectedDate = new Date(viewingDate);
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            
            if (selectedDate < currentDate) {
                errorText.textContent = 'Please select a future date for your viewing.';
                errorMessage.classList.remove('hidden');
                return;
            }
            
            // Success
            successMessage.classList.remove('hidden');
            
            // Scroll to success message
            successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Reset form after a delay
            setTimeout(() => {
                this.reset();
                successMessage.classList.add('hidden');
            }, 5000);
        });

        // View Full Details button
        document.querySelector('button').addEventListener('click', function() {
            if (this.textContent.includes('View Full Details')) {
                alert('Returning to property details page...');
            }
        });

        // Message Agent button
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Message Agent')) {
                button.addEventListener('click', function() {
                    alert('Opening message composer for Sara Tadesse...');
                });
            }
        });

        // Navigation links
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                alert(`Navigating to: ${this.textContent}`);
            });
        });

        // Footer links
        document.querySelectorAll('footer a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.querySelector('svg')) {
                    alert('Social media link clicked');
                } else {
                    alert(`Opening: ${this.textContent}`);
                }
            });
        });

        // Terms & Conditions links
        document.querySelectorAll('a[href="#"]').forEach(link => {
            if (link.textContent.includes('Terms') || link.textContent.includes('Privacy')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert(`Opening: ${this.textContent}`);
                });
            }
        });

        // Real-time form validation feedback
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.style.borderColor = '#ff4444';
                } else if (this.type === 'email' && this.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(this.value)) {
                        this.style.borderColor = '#ff4444';
                    } else {
                        this.style.borderColor = '#00ff88';
                    }
                } else if (this.value.trim()) {
                    this.style.borderColor = '#00ff88';
                }
            });
            
            input.addEventListener('focus', function() {
                this.style.borderColor = '#00ff88';
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9769f18eb74af7f3',t:'MTc1NjQ0ODQzOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
