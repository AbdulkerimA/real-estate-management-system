<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sara Tadesse - PropertyHub Agent</title>
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
        
        .profile-banner {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.1) 0%, rgba(28, 37, 46, 0.9) 100%),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 400"><defs><pattern id="buildings" x="0" y="0" width="200" height="200" patternUnits="userSpaceOnUse"><rect width="40" height="120" x="20" y="80" fill="%23ffffff" opacity="0.03"/><rect width="30" height="100" x="70" y="100" fill="%23ffffff" opacity="0.03"/><rect width="35" height="140" x="110" y="60" fill="%23ffffff" opacity="0.03"/><rect width="25" height="80" x="155" y="120" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="1200" height="400" fill="url(%23buildings)"/></svg>');
            background-size: cover;
            background-position: center;
        }
        
        .profile-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .stat-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 255, 136, 0.1);
        }
        
        .property-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .property-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 255, 136, 0.15);
        }
        
        .review-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .cta-section {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.1) 0%, rgba(28, 37, 46, 0.9) 100%);
            border: 2px solid rgba(0, 255, 136, 0.3);
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
            animation: float 12s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            top: 70%;
            right: 10%;
            animation-delay: 6s;
        }
        
        .shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(180deg); }
        }
        
        .star-rating {
            color: #fbbf24;
        }
        
        .contact-btn {
            transition: all 0.3s ease;
        }
        
        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 136, 0.3);
        }
        
        .message-btn {
            transition: all 0.3s ease;
        }
        
        .message-btn:hover {
            background: rgba(0, 255, 136, 0.1);
            border-color: #00ff88;
        }
    </style>
</head>
<body class="bg-dark-secondary text-white">
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
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Properties</a>
                    <a href="#" class="text-accent-green font-semibold">Agents</a>
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
        <!-- Profile Header -->
        <div class="profile-banner min-h-[400px] flex items-end pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="profile-card rounded-3xl p-8">
                    <div class="flex flex-col lg:flex-row items-center lg:items-end gap-8">
                        <!-- Profile Photo -->
                        <div class="relative">
                            <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-5xl lg:text-6xl font-bold border-4 border-accent-green">
                                ST
                            </div>
                            <div class="absolute -top-2 -right-2 bg-accent-green text-dark-secondary px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ VERIFIED
                            </div>
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-1 text-center lg:text-left">
                            <h1 class="text-4xl lg:text-5xl font-bold mb-2">Sara Tadesse</h1>
                            <p class="text-accent-green text-xl font-semibold mb-4">Senior Real Estate Agent</p>
                            
                            <!-- Contact Info -->
                            <div class="flex flex-col sm:flex-row gap-4 mb-6 justify-center lg:justify-start">
                                <div class="flex items-center justify-center lg:justify-start">
                                    <svg class="w-5 h-5 mr-2 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span class="text-gray-300">+251 922 345 678</span>
                                </div>
                                <div class="flex items-center justify-center lg:justify-start">
                                    <svg class="w-5 h-5 mr-2 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                    <span class="text-gray-300">sara.tadesse@propertyhub.et</span>
                                </div>
                                <div class="flex items-center justify-center lg:justify-start">
                                    <svg class="w-5 h-5 mr-2 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-gray-300">Bole Office, Addis Ababa</span>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <button class="contact-btn bg-accent-green text-dark-secondary px-8 py-3 rounded-xl font-bold hover:bg-green-400 transition-colors">
                                    Contact Agent
                                </button>
                                <button class="message-btn border-2 border-gray-600 text-white px-8 py-3 rounded-xl font-bold hover:border-accent-green transition-colors">
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
                    <div class="text-4xl font-bold text-accent-green mb-2">47</div>
                    <div class="text-gray-300 font-semibold">Properties Listed</div>
                    <div class="text-sm text-gray-400 mt-1">Active listings</div>
                </div>

                <!-- Years of Experience -->
                <div class="stat-card rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-accent-green mb-2">8+</div>
                    <div class="text-gray-300 font-semibold">Years Experience</div>
                    <div class="text-sm text-gray-400 mt-1">In real estate</div>
                </div>

                <!-- Customer Rating -->
                <div class="stat-card rounded-2xl p-6 text-center">
                    <div class="flex justify-center items-center mb-2">
                        <span class="text-4xl font-bold text-accent-green mr-2">4.8</span>
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
                <div>
                    <h2 class="text-3xl font-bold mb-6">Specialties</h2>
                    <div class="space-y-4">
                        <div class="profile-card rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
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
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
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
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
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
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
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
                </div>
            </div>
        </div>

        <!-- Agent's Properties -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Sara's Properties</h2>
                <button class="text-accent-green hover:text-green-400 font-semibold">View All (47)</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Property Card 1 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Modern 3BR Apartment</h3>
                        <p class="text-gray-400 mb-3">📍 Bole, Addis Ababa</p>
                        <p class="text-2xl font-bold text-accent-green mb-4">ETB 4,500,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Property Card 2 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Luxury Villa</h3>
                        <p class="text-gray-400 mb-3">📍 Yeka, Addis Ababa</p>
                        <p class="text-2xl font-bold text-accent-green mb-4">ETB 12,800,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Property Card 3 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Cozy 2BR Condo</h3>
                        <p class="text-gray-400 mb-3">📍 Bole, Addis Ababa</p>
                        <p class="text-2xl font-bold text-accent-green mb-4">ETB 2,900,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Property Card 4 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Family House</h3>
                        <p class="text-gray-400 mb-3">📍 Yeka, Addis Ababa</p>
                        <p class="text-2xl font-bold text-accent-green mb-4">ETB 6,200,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Property Card 5 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Studio Apartment</h3>
                        <p class="text-gray-400 mb-3">📍 Bole, Addis Ababa</p>
                        <p class="text-2xl font-bold text-accent-green mb-4">ETB 1,800,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Property Card 6 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Penthouse Suite</h3>
                        <p class="text-gray-400 mb-3">📍 Bole, Addis Ababa</p>
                        <p class="text-2xl font-bold text-accent-green mb-4">ETB 8,500,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Reviews -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <h2 class="text-3xl font-bold mb-8 text-center">What Clients Say</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Review 1 -->
                <div class="review-card rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            AM
                        </div>
                        <div>
                            <h4 class="font-semibold">Alemayehu Mekonen</h4>
                            <div class="star-rating text-sm">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Sara helped us find our dream home in Bole. Her knowledge of the area and patience throughout the process was exceptional. Highly recommended!"</p>
                </div>

                <!-- Review 2 -->
                <div class="review-card rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            RH
                        </div>
                        <div>
                            <h4 class="font-semibold">Ruth Haile</h4>
                            <div class="star-rating text-sm">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Professional, knowledgeable, and always available to answer questions. Sara made buying our first home stress-free and enjoyable."</p>
                </div>

                <!-- Review 3 -->
                <div class="review-card rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            DG
                        </div>
                        <div>
                            <h4 class="font-semibold">Daniel Gebru</h4>
                            <div class="star-rating text-sm">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Sara's expertise in the Yeka area helped us find the perfect investment property. Her market analysis was spot-on!"</p>
                </div>

                <!-- Review 4 -->
                <div class="review-card rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            ST
                        </div>
                        <div>
                            <h4 class="font-semibold">Selamawit Tekle</h4>
                            <div class="star-rating text-sm">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Excellent service from start to finish. Sara went above and beyond to ensure we got the best deal on our new apartment."</p>
                </div>

                <!-- Review 5 -->
                <div class="review-card rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            MT
                        </div>
                        <div>
                            <h4 class="font-semibold">Meron Tadesse</h4>
                            <div class="star-rating text-sm">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Sara's honesty and transparency made all the difference. She truly cares about her clients and it shows in her work."</p>
                </div>

                <!-- Review 6 -->
                <div class="review-card rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            BW
                        </div>
                        <div>
                            <h4 class="font-semibold">Bereket Wolde</h4>
                            <div class="star-rating text-sm">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"Working with Sara was a pleasure. She understood our needs perfectly and found us exactly what we were looking for."</p>
                </div>
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="cta-section rounded-3xl p-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Interested in working with Sara Tadesse?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Ready to find your dream property or sell your current one? Sara is here to guide you through every step of the process with her expertise and personalized service.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-accent-green text-dark-secondary px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                        Schedule Appointment
                    </button>
                    <button class="border-2 border-accent-green text-accent-green px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent-green hover:text-dark-secondary transition-colors">
                        Get Free Consultation
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark-primary border-t border-gray-700 py-12">
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
        // Contact Agent button
        document.querySelector('.contact-btn').addEventListener('click', function() {
            alert('Opening contact form for Sara Tadesse...');
        });

        // Send Message button
        document.querySelector('.message-btn').addEventListener('click', function() {
            alert('Opening messaging interface...');
        });

        // Property View Details buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('View Details')) {
                button.addEventListener('click', function() {
                    const propertyTitle = this.closest('.property-card').querySelector('h3').textContent;
                    alert(`Opening details for: ${propertyTitle}`);
                });
            }
        });

        // Schedule Appointment button
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Schedule Appointment')) {
                button.addEventListener('click', function() {
                    alert('Opening appointment scheduler for Sara Tadesse...');
                });
            }
        });

        // Get Free Consultation button
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Get Free Consultation')) {
                button.addEventListener('click', function() {
                    alert('Booking free consultation with Sara Tadesse...');
                });
            }
        });

        // View All Properties link
        document.querySelector('button').addEventListener('click', function() {
            if (this.textContent.includes('View All')) {
                alert('Showing all 47 properties listed by Sara Tadesse...');
            }
        });

        // Social media links
        document.querySelectorAll('footer a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Social media link clicked');
            });
        });

        // Navigation links
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                alert(`Navigating to: ${this.textContent}`);
            });
        });

        // Footer links
        document.querySelectorAll('footer ul a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                alert(`Opening: ${this.textContent}`);
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'976159cc57e07545',t:'MTc1NjM1ODMzNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
