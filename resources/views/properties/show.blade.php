<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Apartment in Bole - PropertyHub</title>
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
        
        .detail-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .agent-card {
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
        
        .gallery-thumbnail {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .gallery-thumbnail:hover {
            transform: scale(1.05);
            border-color: #00ff88;
        }
        
        .gallery-thumbnail.active {
            border-color: #00ff88;
            border-width: 3px;
        }
        
        .hero-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .status-badge {
            background: rgba(0, 255, 136, 0.2);
            border: 1px solid #00ff88;
            color: #00ff88;
        }
        
        .contact-btn {
            transition: all 0.3s ease;
        }
        
        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 136, 0.3);
        }
        
        .map-placeholder {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            position: relative;
        }
        
        .map-placeholder::after {
            content: '📍';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: #ff4444;
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
        <!-- Property Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Hero Image -->
                <div class="hero-image rounded-3xl h-96 lg:h-[500px] flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-24 h-24 mx-auto mb-4 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        <p class="text-white text-lg opacity-75">Main Property Image</p>
                    </div>
                </div>

                <!-- Property Info -->
                <div class="flex flex-col justify-center">
                    <div class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold mb-4 w-fit">
                        ✅ Available
                    </div>
                    
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">Luxury Apartment in Bole</h1>
                    <p class="text-xl text-gray-400 mb-6">📍 Bole, Addis Ababa, Ethiopia</p>
                    
                    <div class="mb-8">
                        <span class="text-5xl font-bold text-accent-green">ETB 4,500,000</span>
                        <span class="text-gray-400 ml-2">($82,000 USD)</span>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-accent-green">3</div>
                            <div class="text-sm text-gray-400">Bedrooms</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-accent-green">2</div>
                            <div class="text-sm text-gray-400">Bathrooms</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-accent-green">120</div>
                            <div class="text-sm text-gray-400">m² Area</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-accent-green">2022</div>
                            <div class="text-sm text-gray-400">Year Built</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="contact-btn bg-accent-green text-dark-secondary px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Schedule Viewing
                        </button>
                        <button class="border-2 border-accent-green text-accent-green px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent-green hover:text-dark-secondary transition-colors">
                            Contact Agent
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-3xl font-bold mb-6">Property Gallery</h2>
            
            <!-- Main Gallery Image -->
            <div class="mb-6">
                <div id="main-gallery-image" class="hero-image rounded-2xl h-96 flex items-center justify-center cursor-pointer">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-2 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        <p class="text-white opacity-75">Living Room View</p>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Gallery -->
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                <div class="gallery-thumbnail active border-2 border-accent-green rounded-xl h-24 bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center cursor-pointer" data-image="living-room">
                    <span class="text-white text-sm">Living Room</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center cursor-pointer" data-image="kitchen">
                    <span class="text-white text-sm">Kitchen</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center cursor-pointer" data-image="bedroom">
                    <span class="text-white text-sm">Master Bedroom</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center cursor-pointer" data-image="bathroom">
                    <span class="text-white text-sm">Bathroom</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center cursor-pointer" data-image="balcony">
                    <span class="text-white text-sm">Balcony</span>
                </div>
                <div class="gallery-thumbnail border-2 border-gray-600 rounded-xl h-24 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center cursor-pointer" data-image="exterior">
                    <span class="text-white text-sm">Exterior</span>
                </div>
            </div>
        </div>

        <!-- Property Details -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Details -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold mb-6">Property Overview</h2>
                    
                    <!-- Details Grid -->
                    <div class="detail-card rounded-2xl p-6 mb-8">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm6 14H8a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h2v1a1 1 0 0 0 2 0V9h2v10a1 1 0 0 1-1 1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Property Type</div>
                                    <div class="text-gray-400">Apartment</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Bedrooms</div>
                                    <div class="text-gray-400">3 Bedrooms</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9,2V8H7V10H9V14A4,4 0 0,0 13,18H15V16H13A2,2 0 0,1 11,14V10H15V8H11V2H9Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Bathrooms</div>
                                    <div class="text-gray-400">2 Full Baths</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2,2V4H4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V4H22V2H2M16,10V12H14V10H16M10,10V12H8V10H10M16,6V8H14V6H16M10,6V8H8V6H10M16,14V16H14V14H16M10,14V16H8V14H10Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Floor Area</div>
                                    <div class="text-gray-400">120 m²</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M16.2,16.2L11,13V7H12.5V12.2L17,15.4L16.2,16.2Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Year Built</div>
                                    <div class="text-gray-400">2022</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-accent-green rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18,15H16V17H18M18,11H16V13H18M20,19H12V17H14V15H12V13H14V11H12V9H20M10,7H8V5H10M10,11H8V9H10M10,15H8V13H10M10,19H8V17H10M6,7H4V5H6M6,11H4V9H6M6,15H4V13H6M6,19H4V17H6M12,7V3H2V21H22V7H12Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Parking</div>
                                    <div class="text-gray-400">2 Spaces</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Full Description -->
                    <h3 class="text-2xl font-bold mb-4">Description</h3>
                    <div class="detail-card rounded-2xl p-6">
                        <p class="text-gray-300 leading-relaxed mb-4">
                            This stunning 3-bedroom luxury apartment in the heart of Bole offers modern living at its finest. Built in 2022, this contemporary residence features high-end finishes, spacious layouts, and premium amenities throughout.
                        </p>
                        <p class="text-gray-300 leading-relaxed mb-4">
                            The open-concept living area seamlessly connects the living room, dining area, and modern kitchen, creating an ideal space for both daily living and entertaining. Floor-to-ceiling windows flood the space with natural light and offer beautiful city views.
                        </p>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Located in one of Addis Ababa's most desirable neighborhoods, this property is within walking distance of international schools, shopping centers, restaurants, and business districts. Easy access to Bole International Airport makes it perfect for international professionals.
                        </p>
                        
                        <h4 class="text-lg font-semibold mb-3 text-accent-green">Key Features:</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-300">
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> Modern kitchen with premium appliances</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> Master bedroom with en-suite bathroom</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> Private balcony with city views</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> 24/7 security and concierge</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> Fitness center and swimming pool</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> Underground parking for 2 cars</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> High-speed internet ready</li>
                            <li class="flex items-center"><span class="text-accent-green mr-2">✓</span> Near international schools</li>
                        </ul>
                    </div>
                </div>

                <!-- Agent Information -->
                <div>
                    <h2 class="text-3xl font-bold mb-6">Listed by</h2>
                    <div class="agent-card rounded-2xl p-6">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-pink-500 to-red-600 flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                                ST
                            </div>
                            <h3 class="text-xl font-semibold mb-1">Sara Tadesse</h3>
                            <p class="text-accent-green font-semibold mb-3">Senior Real Estate Agent</p>
                            <div class="flex justify-center items-center mb-4">
                                <div class="text-yellow-400 flex mr-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-gray-400">(4.8/5)</span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300">+251 922 345 678</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                                <span class="text-gray-300">sara.tadesse@propertyhub.et</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button class="w-full bg-accent-green text-dark-secondary py-3 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                                📞 Call Agent
                            </button>
                            <button class="w-full border-2 border-accent-green text-accent-green py-3 rounded-lg font-semibold hover:bg-accent-green hover:text-dark-secondary transition-colors">
                                ✉️ Send Message
                            </button>
                            <button class="w-full border border-gray-600 text-gray-300 py-3 rounded-lg font-semibold hover:border-accent-green hover:text-accent-green transition-colors">
                                👤 View Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-3xl font-bold mb-6">Location</h2>
            <div class="detail-card rounded-2xl p-6">
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">📍 Bole, Addis Ababa, Ethiopia</h3>
                    <p class="text-gray-400">Prime location in the heart of Bole district</p>
                </div>
                
                <!-- Map Placeholder -->
                <div class="map-placeholder rounded-xl h-64 flex items-center justify-center">
                    <div class="text-center text-white">
                        <p class="text-lg font-semibold mb-2">Interactive Map</p>
                        <p class="opacity-75">Property Location in Addis Ababa</p>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="flex items-center">
                        <span class="text-accent-green mr-2">🏫</span>
                        <span>International School - 5 min</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-accent-green mr-2">🛒</span>
                        <span>Shopping Mall - 3 min</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-accent-green mr-2">✈️</span>
                        <span>Bole Airport - 15 min</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Properties -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-3xl font-bold mb-8">Similar Properties</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Similar Property 1 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Modern 2BR Apartment</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Bole, Addis Ababa</p>
                        <p class="text-xl font-bold text-accent-green mb-3">ETB 3,200,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Similar Property 2 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Luxury 4BR Villa</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Yeka, Addis Ababa</p>
                        <p class="text-xl font-bold text-accent-green mb-3">ETB 8,900,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Similar Property 3 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Cozy 3BR Condo</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Kirkos, Addis Ababa</p>
                        <p class="text-xl font-bold text-accent-green mb-3">ETB 4,100,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Similar Property 4 -->
                <div class="property-card rounded-2xl overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Executive Penthouse</h3>
                        <p class="text-gray-400 text-sm mb-2">📍 Bole, Addis Ababa</p>
                        <p class="text-xl font-bold text-accent-green mb-3">ETB 12,500,000</p>
                        <button class="w-full bg-accent-green text-dark-secondary py-2 rounded-lg font-semibold hover:bg-green-400 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="cta-section rounded-3xl p-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Interested in this property?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Don't miss out on this amazing opportunity. Schedule a viewing today or contact our agent for more information about this luxury apartment in Bole.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-accent-green text-dark-secondary px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                        Schedule a Viewing
                    </button>
                    <button class="border-2 border-accent-green text-accent-green px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent-green hover:text-dark-secondary transition-colors">
                        Contact Agent
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
        // Gallery functionality
        const galleryThumbnails = document.querySelectorAll('.gallery-thumbnail');
        const mainGalleryImage = document.getElementById('main-gallery-image');
        
        const imageData = {
            'living-room': {
                gradient: 'from-purple-500 to-blue-600',
                title: 'Living Room View'
            },
            'kitchen': {
                gradient: 'from-green-500 to-teal-600',
                title: 'Modern Kitchen'
            },
            'bedroom': {
                gradient: 'from-orange-500 to-red-600',
                title: 'Master Bedroom'
            },
            'bathroom': {
                gradient: 'from-pink-500 to-purple-600',
                title: 'Luxury Bathroom'
            },
            'balcony': {
                gradient: 'from-yellow-500 to-orange-600',
                title: 'Private Balcony'
            },
            'exterior': {
                gradient: 'from-cyan-500 to-blue-600',
                title: 'Building Exterior'
            }
        };

        galleryThumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Remove active class from all thumbnails
                galleryThumbnails.forEach(t => t.classList.remove('active', 'border-accent-green'));
                galleryThumbnails.forEach(t => t.classList.add('border-gray-600'));
                
                // Add active class to clicked thumbnail
                this.classList.add('active', 'border-accent-green');
                this.classList.remove('border-gray-600');
                
                // Update main image
                const imageKey = this.dataset.image;
                const imageInfo = imageData[imageKey];
                
                mainGalleryImage.className = `hero-image rounded-2xl h-96 flex items-center justify-center cursor-pointer bg-gradient-to-br ${imageInfo.gradient}`;
                mainGalleryImage.innerHTML = `
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-2 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        <p class="text-white opacity-75">${imageInfo.title}</p>
                    </div>
                `;
            });
        });

        // Main gallery image click to enlarge
        mainGalleryImage.addEventListener('click', function() {
            alert('Opening full-size image viewer...');
        });

        // Schedule Viewing buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Schedule Viewing') || button.textContent.includes('Schedule a Viewing')) {
                button.addEventListener('click', function() {
                    alert('Opening viewing scheduler for this luxury apartment...');
                });
            }
        });

        // Contact Agent buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Contact Agent')) {
                button.addEventListener('click', function() {
                    alert('Opening contact form for Sara Tadesse...');
                });
            }
        });

        // Agent action buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Call Agent')) {
                button.addEventListener('click', function() {
                    alert('Calling Sara Tadesse at +251 922 345 678...');
                });
            }
            if (button.textContent.includes('Send Message')) {
                button.addEventListener('click', function() {
                    alert('Opening message composer for Sara Tadesse...');
                });
            }
            if (button.textContent.includes('View Profile')) {
                button.addEventListener('click', function() {
                    alert('Opening Sara Tadesse\'s agent profile...');
                });
            }
        });

        // Similar properties buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('View Details') && button.closest('.property-card')) {
                button.addEventListener('click', function() {
                    const propertyTitle = this.closest('.property-card').querySelector('h3').textContent;
                    alert(`Opening details for: ${propertyTitle}`);
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
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'976174fd30c8e6b4',t:'MTc1NjM1OTQ0OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
