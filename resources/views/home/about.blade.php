<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PropertyHub</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/about.css','resources/js/about.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    </style>
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
                <div class="">
                    <!-- Company Story -->
                    <div>
                        <h2 class="text-4xl lg:text-5xl font-bold mb-6">Who We Are</h2>
                        <p class="text-gray-300 text-lg leading-relaxed mb-6">
                            PropertyHub was founded in 2020 with a simple yet powerful vision: to revolutionize the real estate market in Ethiopia by creating a transparent, secure, and user-friendly digital platform.
                            Starting in Addis Ababa, we've grown to become one of Ethiopia's most trusted property marketplaces, connecting thousands of buyers, sellers, and professional agents across the country.
                            Our team combines deep local market knowledge with cutting-edge technology to deliver an exceptional real estate experience that puts our users first.
                        </p>
                        <button class="btn-primary bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="py-20 bg-[#1c252e]">
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
                        <div class="w-16 h-16 bg-[#00ff88] rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-[#00ff88]">Our Mission</h3>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            To simplify property transactions with complete transparency, security, and trust. We empower every Ethiopian to make informed real estate decisions through innovative technology and exceptional service.
                        </p>
                    </div>

                    <!-- Vision -->
                    <div class="mission-card rounded-3xl p-8">
                        <div class="w-16 h-16 bg-[#00ff88] rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-[#00ff88]">Our Vision</h3>
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
                        <div class="w-16 h-16 bg-[#00ff88] rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
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
                        <div class="w-16 h-16 bg-[#00ff88] rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shield-alt text-3xl text-[#12181f]"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Secure Transactions</h3>
                        <p class="text-gray-400">
                            Advanced security measures protect your personal information and financial transactions.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-[#00ff88] rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user-tie text-3xl text-[#12181f]"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Expert Agents</h3>
                        <p class="text-gray-400">
                            Work with certified and experienced real estate professionals who know the local market.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="feature-card rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-[#00ff88] rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#12181f]" fill="currentColor" viewBox="0 0 24 24">
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
        <section class="py-20 bg-[#1c252e]">
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
                        <h3 class="text-xl font-bold mb-2">nuredin muhammed</h3>
                        <p class="text-[#00ff88] font-semibold mb-3">CEO & Founder</p>
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
                        <p class="text-[#00ff88] font-semibold mb-3">Head of Sales</p>
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
                        <p class="text-[#00ff88] font-semibold mb-3">CTO</p>
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
                        <p class="text-[#00ff88] font-semibold mb-3">Lead Agent</p>
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
                        <button id="propertiescta" class="btn-primary bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-xl font-bold text-lg hover:bg-green-400 transition-colors">
                            Browse Properties
                        </button>
                        <button class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                            Contact Us
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <x-footer />
    </div>

    {{-- <script>
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
    </script> --}}
</body>
</html>
