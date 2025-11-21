<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anchor Homes </title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#12181f] text-white">
    <!-- Navigation -->
    {{ 
        $navLink
    }}

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    A Great Way — To Buy And<br>
                    <span class="text-[#00ff88]">Sell Your Property</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto">
                    Fast, secure, and commission-free property marketplace
                </p>
                
                <!-- Search Bar -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 max-w-4xl mx-auto mb-8">
                    <form method="POST" action="/properties" class="grid grid-cols-3 gap-4">
                        @csrf
                        
                        <div class="col-span-2 flex flex-col items-baseline">
                            <input type="text" name="location" placeholder="Enter city or area" class="w-full px-4 py-3 rounded-lg bg-white/20 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-[#00ff88]">
                        </div>
                        <div class="flex items-end">
                            <button class="w-full bg-[#00ff88] text-[#12181f] py-3 px-6 rounded-lg font-semibold hover:bg-green-400 transition-colors cursor-pointer">
                                Search
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                {{-- <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-[#00ff88] text-[#12181f] px-8 py-4 rounded-lg font-semibold text-lg hover:bg-green-400 transition-colors">
                        Buy
                    </button>
                    <button class="border-2 border-[#00ff88] text-[#00ff88] px-8 py-4 rounded-lg font-semibold text-lg hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">
                        Sell
                    </button>
                    <button class="border-2 border-gray-400 text-gray-300 px-8 py-4 rounded-lg font-semibold text-lg hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                        Rent
                    </button>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-[#1c252e]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="stat-counter">
                    <div class="text-5xl font-bold text-[#00ff88] mb-2">8.93%</div>
                    <div class="text-xl text-gray-300">Profit Return Rate</div>
                </div>
                <div class="stat-counter">
                    <div class="text-5xl font-bold text-[#00ff88] mb-2">12K+</div>
                    <div class="text-xl text-gray-300">Properties Listed</div>
                </div>
                <div class="stat-counter">
                    <div class="text-5xl font-bold text-[#00ff88] mb-2">12K+</div>
                    <div class="text-xl text-gray-300">Customers</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="py-20 bg-[#12181f]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Featured Properties</h2>
                <p class="text-xl text-gray-400">Discover our handpicked premium properties</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{ $properties }}
                
                <!-- Property Card 1 -->

            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-[#1c252e]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">What Our Clients Say</h2>
                <p class="text-xl text-gray-400">Trusted by thousands of satisfied customers</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                {{$testimonials}}
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-[#00ff88]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-bold text-[#12181f] mb-6">
                Are You Ready To Do Business With Us?
            </h2>
            <p class="text-xl text-[#12181f]/80 mb-8 max-w-2xl mx-auto">
                Join thousands of satisfied customers who have found their dream properties through our platform
            </p>
            <button
                onclick="window.location='/signup'" 
                class="bg-[#12181f] text-[#00ff88] px-12 py-4 rounded-lg font-bold text-xl hover:bg-gray-800 transition-colors">
                Get Started
            </button>
        </div>
    </section>

    <!-- Footer -->
    {{ $footer }}

    {{-- <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.md\\:hidden button');
        const mobileMenu = document.createElement('div');
        mobileMenu.className = 'md:hidden bg-[#1c252e] border-t border-gray-700';
        mobileMenu.innerHTML = `
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 text-gray-300 hover:text-[#00ff88]">Properties</a>
                <a href="#" class="block px-3 py-2 text-gray-300 hover:text-[#00ff88]">Invest</a>
                <a href="#" class="block px-3 py-2 text-gray-300 hover:text-[#00ff88]">Agents</a>
                <a href="#" class="block px-3 py-2 text-gray-300 hover:text-[#00ff88]">About</a>
                <a href="#" class="block px-3 py-2 text-gray-300 hover:text-[#00ff88]">Login</a>
                <button class="w-full mt-2 bg-[#00ff88] text-[#12181f] px-4 py-2 rounded-lg font-semibold">Get Started</button>
            </div>
        `;
        mobileMenu.style.display = 'none';
        
        mobileMenuButton.addEventListener('click', () => {
            if (mobileMenu.style.display === 'none') {
                mobileMenu.style.display = 'block';
                mobileMenuButton.parentNode.parentNode.parentNode.appendChild(mobileMenu);
            } else {
                mobileMenu.style.display = 'none';
            }
        });

        // Animate stats on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-counter').forEach(stat => {
            observer.observe(stat);
        });

        // Search functionality
        document.querySelector('.hero-bg button').addEventListener('click', () => {
            const location = document.querySelector('input[placeholder="Enter city or area"]').value;
            const type = document.querySelector('select').value;
            const priceRange = document.querySelectorAll('select')[1].value;
            
            if (location || type || priceRange) {
                alert(`Searching for properties...\nLocation: ${location || 'Any'}\nType: ${type || 'Any'}\nPrice: ${priceRange || 'Any'}`);
            } else {
                alert('Please enter at least one search criteria');
            }
        });

        // Property contact buttons
        document.querySelectorAll('.property-card button').forEach(button => {
            button.addEventListener('click', (e) => {
                const propertyName = e.target.closest('.property-card').querySelector('h3').textContent;
                alert(`Thank you for your interest in ${propertyName}! Our agent will contact you within 24 hours.`);
            });
        });

        // CTA buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Get Started')) {
                button.addEventListener('click', () => {
                    alert('Welcome to PropertyHub! Sign up process would begin here.');
                });
            }
        });
    </script> --}}
</body>
</html>
