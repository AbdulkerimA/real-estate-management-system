<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PropertyHub</title>
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
        
        .hero-banner {
            background: linear-gradient(135deg, rgba(28, 37, 46, 0.9) 0%, rgba(18, 24, 31, 0.8) 100%),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23667eea" width="1200" height="600"/><g fill="%23764ba2" opacity="0.3"><rect x="0" y="400" width="200" height="200"/><rect x="300" y="350" width="150" height="250"/><rect x="500" y="300" width="180" height="300"/><rect x="750" y="250" width="160" height="350"/><rect x="950" y="200" width="140" height="400"/></g></svg>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .feature-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 255, 136, 0.15);
            border-color: rgba(0, 255, 136, 0.3);
        }
        
        .mission-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .team-card {
            backdrop-filter: blur(10px);
            background: rgba(28, 37, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 255, 136, 0.1);
        }
        
        .stats-card {
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
        
        .company-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .counter {
            font-size: 3rem;
            font-weight: 700;
            color: #00ff88;
        }
        
        .btn-primary {
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 136, 0.3);
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
                    <a href="#" class="text-gray-300 hover:text-accent-green transition-colors">Agents</a>
                    <a href="#" class="text-accent-green font-semibold">About</a>
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
        <!-- Hero Banner -->
        <section class="hero-banner min-h-[60vh] flex items-center justify-center">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl lg:text-7xl font-bold mb-6">About Us</h1>
                <p class="text-xl lg:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Connecting buyers, sellers, and agents in a secure and transparent property marketplace across Ethiopia
                </p>
            </div>
        </section>

        <!-- Company Overview -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Company Image -->
                    <div class="company-image rounded-3xl h-96 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-24 h-24 mx-auto mb-4 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <p class="text-white text-lg opacity-75">PropertyHub Office</p>
                        </div>
                    </div>

                    <!-- Company Story -->
                    <div>
                        <h2 class="text-4xl lg:text-5xl font-bold mb-6">Who We Are</h2>
                        <p class="text-gray-300 text-lg leading-relaxed mb-6">
                            PropertyHub was founded in 2020 with a simple yet powerful vision: to revolutionize the real estate market in Ethiopia by creating a transparent, secure, and user-friendly digital platform.
                        </p>
                        <p class="text-gray-300 text-lg leading-relaxed mb-6">
                            Starting in Addis Ababa, we've grown to become one of Ethiopia's most trusted property marketplaces, connecting thousands of buyers, sellers, and professional agents across the country.
                        </p>
                        <p class="text-gray-300 text-lg leading-relaxed mb-8">
                            Our team combines deep local market knowledge with cutting-edge technology to deliver an exceptional real estate experience that puts our users first.
                        </p>
                        <button class="btn-primary bg-accent-green text-dark-secondary px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="py-20 bg-dark-primary">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-4">Our Purpose</h2>
                    <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                        Driven by our commitment to excellence and innovation in real estate
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Mission -->
                    <div class="mission-card rounded-3xl p-8">
                        <div class="w-16 h-16 bg-accent-green rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-accent-green">Our Mission</h3>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            To simplify property transactions with complete transparency, security, and trust. We empower every Ethiopian to make informed real estate decisions through innovative technology and exceptional service.
                        </p>
                    </div>

                    <!-- Vision -->
                    <div class="mission-card rounded-3xl p-8">
                        <div class="w-16 h-16 bg-accent-green rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-accent-green">Our Vision</h3>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            To be Ethiopia's leading digital property marketplace, setting the standard for innovation, reliability, and customer satisfaction in the real estate industry across East Africa.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-4">Why Choose PropertyHub</h2>
                    <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                        We're committed to providing the best real estate experience in Ethiopia
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="feature-card rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-accent-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Verified Listings</h3>
                        <p class="text-gray-400">
                            Every property is thoroughly verified by our team to ensure accuracy and authenticity.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-accent-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18,8A6,6 0 0,0 12,2A6,6 0 0,0 6,8H4A2,2 0 0,0 2,10V20A2,2 0 0,0 4,22H20A2,2 0 0,0 22,20V10A2,2 0 0,0 20,8H18M12,4A4,4 0 0,1 16,8H8A4,4 0 0,1 12,4Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Secure Transactions</h3>
                        <p class="text-gray-400">
                            Advanced security measures protect your personal information and financial transactions.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-accent-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2 1l-3 4v2h2l2.54-3.4L16.5 18H20z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Expert Agents</h3>
                        <p class="text-gray-400">
                            Work with certified and experienced real estate professionals who know the local market.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="feature-card rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-accent-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-dark-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Easy Platform</h3>
                        <p class="text-gray-400">
                            Intuitive design and powerful search tools make finding your perfect property effortless.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-20 bg-dark-primary">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-4">Meet Our Team</h2>
                    <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                        The passionate professionals behind PropertyHub's success
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Team Member 1 -->
                    <div class="team-card rounded-2xl p-6 text-center">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            AM
                        </div>
                        <h3 class="text-xl font-bold mb-2">Abebe Mekuria</h3>
                        <p class="text-accent-green font-semibold mb-3">CEO & Founder</p>
                        <p class="text-gray-400 text-sm">
                            15+ years in real estate and technology, leading PropertyHub's vision and strategy.
                        </p>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="team-card rounded-2xl p-6 text-center">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            ST
                        </div>
                        <h3 class="text-xl font-bold mb-2">Sara Tadesse</h3>
                        <p class="text-accent-green font-semibold mb-3">Head of Sales</p>
                        <p class="text-gray-400 text-sm">
                            Expert in luxury properties with a track record of successful high-value transactions.
                        </p>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="team-card rounded-2xl p-6 text-center">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            DH
                        </div>
                        <h3 class="text-xl font-bold mb-2">Daniel Haile</h3>
                        <p class="text-accent-green font-semibold mb-3">CTO</p>
                        <p class="text-gray-400 text-sm">
                            Technology leader ensuring our platform remains cutting-edge and user-friendly.
                        </p>
                    </div>

                    <!-- Team Member 4 -->
                    <div class="team-card rounded-2xl p-6 text-center">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            MG
                        </div>
                        <h3 class="text-xl font-bold mb-2">Meron Getachew</h3>
                        <p class="text-accent-green font-semibold mb-3">Lead Agent</p>
                        <p class="text-gray-400 text-sm">
                            Top-performing agent specializing in residential properties across Addis Ababa.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-4">Our Impact</h2>
                    <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                        Numbers that reflect our commitment to excellence and growth
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Stat 1 -->
                    <div class="stats-card rounded-2xl p-8 text-center">
                        <div class="counter mb-2">2,500+</div>
                        <h3 class="text-xl font-semibold mb-2">Properties Sold</h3>
                        <p class="text-gray-400">Successfully completed transactions across Ethiopia</p>
                    </div>

                    <!-- Stat 2 -->
                    <div class="stats-card rounded-2xl p-8 text-center">
                        <div class="counter mb-2">150+</div>
                        <h3 class="text-xl font-semibold mb-2">Verified Agents</h3>
                        <p class="text-gray-400">Professional agents in our network</p>
                    </div>

                    <!-- Stat 3 -->
                    <div class="stats-card rounded-2xl p-8 text-center">
                        <div class="counter mb-2">10,000+</div>
                        <h3 class="text-xl font-semibold mb-2">Active Users</h3>
                        <p class="text-gray-400">Buyers and sellers using our platform</p>
                    </div>

                    <!-- Stat 4 -->
                    <div class="stats-card rounded-2xl p-8 text-center">
                        <div class="counter mb-2">4+</div>
                        <h3 class="text-xl font-semibold mb-2">Years Experience</h3>
                        <p class="text-gray-400">Serving the Ethiopian real estate market</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call-to-Action -->
        <section class="py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="cta-section rounded-3xl p-12 text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">Ready to Find Your Dream Property?</h2>
                    <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                        Join thousands of satisfied customers who have found their perfect home through PropertyHub. Start your journey today.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="btn-primary bg-accent-green text-dark-secondary px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Browse Properties
                        </button>
                        <button class="border-2 border-accent-green text-accent-green px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent-green hover:text-dark-secondary transition-colors">
                            Contact Us
                        </button>
                    </div>
                </div>
            </div>
        </section>

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
                        <p class="text-gray-400 mb-6 max-w-md">Your trusted partner in real estate. Connecting buyers, sellers, and agents across Ethiopia with innovative technology and professional service.</p>
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
                            <li><a href="#" class="text-gray-400 hover:text-accent-green transition-colors">Home</a></li>
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
        // Learn More button
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Learn More')) {
                button.addEventListener('click', function() {
                    alert('Opening detailed company information...');
                });
            }
        });

        // Browse Properties button
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Browse Properties')) {
                button.addEventListener('click', function() {
                    alert('Redirecting to properties page...');
                });
            }
        });

        // Contact Us button
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Contact Us')) {
                button.addEventListener('click', function() {
                    alert('Opening contact page...');
                });
            }
        });

        // Team member interactions
        document.querySelectorAll('.team-card').forEach(card => {
            card.addEventListener('click', function() {
                const name = this.querySelector('h3').textContent;
                alert(`Opening profile for ${name}...`);
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

        // Animate counters on scroll
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseInt(counter.textContent.replace(/[^0-9]/g, ''));
                        const increment = target / 50;
                        let current = 0;
                        
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                counter.textContent = counter.textContent.replace(/[0-9,]+/, target.toLocaleString());
                                clearInterval(timer);
                            } else {
                                counter.textContent = counter.textContent.replace(/[0-9,]+/, Math.floor(current).toLocaleString());
                            }
                        }, 30);
                        
                        observer.unobserve(counter);
                    }
                });
            });
            
            counters.forEach(counter => observer.observe(counter));
        }

        // Initialize counter animation
        animateCounters();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'976a01cf2300f7f3',t:'MTc1NjQ0OTEwNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
