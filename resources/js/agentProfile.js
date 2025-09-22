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

        // // Navigation links
        // document.querySelectorAll('nav a').forEach(link => {
        //     link.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         alert(`Navigating to: ${this.textContent}`);
        //     });
        // });

        // // Footer links
        // document.querySelectorAll('footer ul a').forEach(link => {
        //     link.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         alert(`Opening: ${this.textContent}`);
        //     });
        // });