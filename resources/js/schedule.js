//  alert('');
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
                window.location = '/property/1';
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