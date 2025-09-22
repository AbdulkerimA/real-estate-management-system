<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sara Tadesse - AnchorHomes</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/agentProfile.css','resources/js/agentProfile.js'])
</head>
<body class="bg-[#12181f] text-white">
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
        <!-- Profile Header -->
        <div class="profile-banner min-h-[400px] flex items-end pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="profile-card rounded-3xl p-8">
                    <div class="flex flex-col lg:flex-row items-center lg:items-end gap-8">
                        <!-- Profile Photo -->
                        <div class="relative">
                            <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-5xl lg:text-6xl font-bold border-4 border-[#00ff88]">
                                ST
                            </div>
                            <div class="absolute -top-2 -right-2 bg-[#00ff88] text-[#12181f] px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ VERIFIED
                            </div>
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-1 text-center lg:text-left">
                            <h1 class="text-4xl lg:text-5xl font-bold mb-2">Sara Tadesse</h1>
                            <p class="text-[#00ff88] text-xl font-semibold mb-4">Senior Real Estate Agent</p>
                            
                            <!-- Contact Info -->
                            <div class="flex flex-col sm:flex-row gap-4 mb-6 justify-center lg:justify-start">
                                <div class="flex items-center justify-center lg:justify-start">
                                    <svg class="w-5 h-5 mr-2 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span class="text-gray-300">+251 922 345 678</span>
                                </div>
                                <div class="flex items-center justify-center lg:justify-start">
                                    <svg class="w-5 h-5 mr-2 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                    <span class="text-gray-300">sara.tadesse@AnchorHomes.et</span>
                                </div>
                                <div class="flex items-center justify-center lg:justify-start">
                                    <svg class="w-5 h-5 mr-2 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-gray-300">Bole Office, Addis Ababa</span>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <button class="contact-btn bg-[#00ff88] text-[#12181f] px-8 py-3 rounded-xl font-bold hover:bg-green-400 transition-colors">
                                    Contact Agent
                                </button>
                                <button class="message-btn border-2 border-gray-600 text-white px-8 py-3 rounded-xl font-bold hover:border-[#00ff88] transition-colors">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agent Stats -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Properties Listed -->
                <div class="stat-card rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-[#00ff88] mb-2">47</div>
                    <div class="text-gray-300 font-semibold">Properties Listed</div>
                    <div class="text-sm text-gray-400 mt-1">Active listings</div>
                </div>

                <!-- Years of Experience -->
                <div class="stat-card rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-[#00ff88] mb-2">8+</div>
                    <div class="text-gray-300 font-semibold">Years Experience</div>
                    <div class="text-sm text-gray-400 mt-1">In real estate</div>
                </div>

                <!-- Customer Rating -->
                <div class="stat-card rounded-2xl p-6 text-center">
                    <div class="flex justify-center items-center mb-2">
                        <span class="text-4xl font-bold text-[#00ff88] mr-2">4.8</span>
                        <div class="star-rating text-2xl">⭐</div>
                    </div>
                    <div class="text-gray-300 font-semibold">Customer Rating</div>
                    <div class="text-sm text-gray-400 mt-1">98 reviews</div>
                </div>
            </div>
        </div>

        <!-- About Agent -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- About Section -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold mb-6">About Sara</h2>
                    <div class="profile-card rounded-2xl p-8">
                        <p class="text-gray-300 leading-relaxed mb-6">
                            With over 8 years of experience in the Addis Ababa real estate market, Sara Tadesse has established herself as one of the most trusted and knowledgeable agents in the city. She specializes in residential properties and has a particular expertise in helping first-time home buyers navigate the complex process of purchasing their dream home.
                        </p>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Sara's deep understanding of the Bole and Yeka areas, combined with her commitment to personalized service, has earned her numerous satisfied clients and referrals. She believes in building long-term relationships with her clients and providing them with honest, professional advice throughout their real estate journey.
                        </p>
                        <p class="text-gray-300 leading-relaxed">
                            When she's not helping clients find their perfect property, Sara enjoys exploring new neighborhoods in Addis Ababa, staying updated on market trends, and volunteering with local community organizations.
                        </p>
                    </div>
                </div>

                <!-- Specialties -->
                {{-- <div>
                    <h2 class="text-3xl font-bold mb-6">Specialties</h2>
                    <div class="space-y-4">
                        <div class="profile-card rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">Residential Properties</h3>
                                    <p class="text-sm text-gray-400">Apartments & Houses</p>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">First-Time Buyers</h3>
                                    <p class="text-sm text-gray-400">Guidance & Support</p>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">Bole & Yeka Areas</h3>
                                    <p class="text-sm text-gray-400">Local Expert</p>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-[#00ff88] rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">Investment Properties</h3>
                                    <p class="text-sm text-gray-400">ROI Analysis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Agent's Properties -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Sara's Properties</h2>
                <button class="text-[#00ff88] hover:text-green-400 font-semibold">View All (47)</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Property Card 1 -->
                @for ($i = 0; $i < 6; $i++)
                    <x-property.property-card />
                @endfor
            </div>
            <div class="w-full flex justify-center">
                <button class="w-fit bg-[#00ff88] text-gray-900 text-xl py-4 px-8 mt-6 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                    view more <i class="fa fa-arrow-right " aria-hidden="true"></i> 
                </button>
            </div>
        </div>

        <!-- Client Reviews -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <h2 class="text-3xl font-bold mb-8 text-center">What Clients Say</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
               @for ($i = 0; $i < 6; $i++ )
                   <x-customer-review />
               @endfor
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="cta-section rounded-3xl p-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Interested in working with Sara Tadesse?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Ready to find your dream property or sell your current one? Sara is here to guide you through every step of the process with her expertise and personalized service.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                        Schedule Appointment
                    </button>
                    <button class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                        Get Free Consultation
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        {{-- <footer class="bg-[#1c252e] border-t border-gray-700 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-[#00ff88] rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-[#00ff88]">AnchorHomes</span>
                        </div>
                        <p class="text-gray-400 mb-6 max-w-md">Your trusted partner in real estate. Connecting buyers, sellers, and agents across Addis Ababa with innovative technology and professional service.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-[#12181f] rounded-lg flex items-center justify-center hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-[#12181f] rounded-lg flex items-center justify-center hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-[#12181f] rounded-lg flex items-center justify-center hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
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
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">About</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Properties</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Agents</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">FAQs</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Legal</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Cookie Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-[#00ff88] transition-colors">Disclaimer</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 AnchorHomes. All rights reserved.</p>
                </div>
            </div>
        </footer> --}}
        <x-footer />
    </div>
</body>
</html>
