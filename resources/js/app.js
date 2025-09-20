import './bootstrap';
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
                    window.location = '/signup'
                });
            }
        });