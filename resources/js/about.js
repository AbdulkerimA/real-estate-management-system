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
                    // alert('Redirecting to properties page...');
                    window.location = '/properties';
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