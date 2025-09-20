<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - PropertyHub</title>
    @vite(['resources/css/auth.css','resources/js/auth.js'])
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape">
            <svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                <rect width="120" height="120" fill="#00ff88" rx="25"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="90" height="90" viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg">
                <circle cx="45" cy="45" r="45" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="140" height="140" viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg">
                <polygon points="70,15 125,105 15,105" fill="#00ff88"/>
            </svg>
        </div>
        <div class="shape">
            <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <rect width="100" height="100" fill="#00ff88" rx="50"/>
            </svg>
        </div>
    </div>

    <div class="w-full max-w-lg relative z-10">
        <!-- Sign Up Card -->
        <div class="signup-card rounded-3xl p-8 shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Create Your Account</h2>
                <p class="text-gray-400">Start your real estate journey today</p>
            </div>

            <!-- Sign Up Form -->
            <form class="space-y-6" id="signup-form">
                @csrf
                <!-- Full Name Field -->
                <div>
                    <x-form.lable for="fullName">
                        Full Name
                    </x-form.lable>

                    <div class="relative">
                        <x-form.input 
                            type="text" 
                            id="fullName" 
                            name="fullName"
                            placeholder="Enter your full name"
                        />
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="text-xs text-red-400 mt-1 hidden" id="fullName-error"></div>
                </div>


                <!-- Email Field -->
                <div>
                    <x-form.lable for="email">
                        Email Address
                    </x-form.lable>

                    <div class="relative">
                        <x-form.input 
                            type="email" 
                            id="email" 
                            name="email"
                            placeholder="Enter your email address"
                        />

                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-xs text-red-400 mt-1 hidden" id="email-error"></div>
                </div>

                <!-- Phone Number Field -->
                <div>
                    <x-form.lable for="phone">
                        Phone Number
                    </x-form.lable>
                    <div class="relative">
                        <x-form.input 
                            type="tel" 
                            id="phone" 
                            name="phone"
                            placeholder="Enter your phone number"
                        />

                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-xs text-red-400 mt-1 hidden" id="phone-error"></div>
                </div>

                <!-- Role Selection -->
                {{-- <div>
                    <x-form.lable for="role">
                        Select Your Role
                    </x-form.lable>
                    <div class="relax-form.tive">
                        <x-form.select 
                            id="role" 
                            name="role"
                        >
                            <option value="">Choose your role</option>
                            <option value="buyer">🏠 Buyer - Looking for properties</option>
                            <option value="seller">💰 Seller - Selling properties</option>
                            <option value="agent">🤝 Agent - Real estate professional</option>
                        </x-form.select>

                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div> --}}

                <!-- Password Field -->
                <div>
                    <x-form.lable for="password">
                        Password
                    </x-form.lable>
                    <div class="relative">
                        <x-form.input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="Create a strong password"
                        />
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center"
                            id="toggle-password"
                        >
                            <svg class="w-5 h-5 text-gray-400 hover:text-accent-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="bg-gray-600 h-1 rounded-full">
                            <div class="password-strength rounded-full" id="password-strength"></div>
                        </div>
                        <div class="text-xs text-gray-400 mt-1" id="password-strength-text">Password strength</div>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <x-form.lable for="confirmPassword">
                        Confirm Password
                    </x-form.lable>
                    <div class="relative">
                        <x-form.input 
                            type="password" 
                            id="confirmPassword" 
                            name="confirmPassword"
                            placeholder="Confirm your password"
                        />
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-xs text-red-400 mt-1 hidden" id="confirmPassword-error"></div>
                </div>

                <!-- Terms & Conditions -->
                <div class="x-form.flex items-start">
                    <input 
                        type="checkbox" 
                        class="w-4 h-4 text-accent-green bg-dark-secondary border-gray-600 rounded focus:ring-accent-green focus:ring-2 mt-1"
                        id="terms"
                    >
                    <lable for="terms" class="ml-3 text-sm text-gray-300">
                        I agree to the 
                        <a href="#" class="text-accent-green hover:text-green-400 transition-colors" id="terms-link">Terms & Conditions</a> 
                        and 
                        <a href="#" class="text-accent-green hover:text-green-400 transition-colors" id="privacy-link">Privacy Policy</a>
                    </lable>
                </div>

                <!-- Sign Up Button -->
                <button 
                    type="submit" 
                    class="signup-btn w-full py-4 px-6 text-dark-secondary font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-green focus:ring-offset-2 focus:ring-offset-dark-primary"
                >
                    Create Account
                </button>
            </form>

            <!-- Divider -->
            <div class="my-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-dark-primary text-gray-400 w-fit login-card">Or sign up with</span>
                    </div>
                </div>
            </div>

            <!-- Social Sign Up Buttons -->
            <div class="space-y-4">
                <!-- Google Sign Up -->
                <button class="social-btn w-full flex items-center justify-center px-6 py-4 bg-white text-gray-800 rounded-xl font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300" id="google-signup">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Sign Up with Google
                </button>

                <!-- Facebook Sign Up -->
                <button class="social-btn w-full flex items-center justify-center px-6 py-4 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" id="facebook-signup">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Sign Up with Facebook
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-400">
                Already have an account? 
                <x-nav.link href="/login">
                    Login
                </x-nav.link>
            </p>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            // Toggle icon
            this.innerHTML = type === 'password' 
                ? `<svg class="w-5 h-5 text-gray-400 hover:text-accent-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                   </svg>`
                : `<svg class="w-5 h-5 text-gray-400 hover:text-accent-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                   </svg>`;
        });

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const strengthBar = document.getElementById('password-strength');
            const strengthText = document.getElementById('password-strength-text');
            
            strengthBar.className = 'password-strength rounded-full';
            
            switch(strength) {
                case 0:
                case 1:
                    strengthBar.classList.add('strength-weak');
                    feedback = 'Weak password';
                    break;
                case 2:
                    strengthBar.classList.add('strength-fair');
                    feedback = 'Fair password';
                    break;
                case 3:
                case 4:
                    strengthBar.classList.add('strength-good');
                    feedback = 'Good password';
                    break;
                case 5:
                    strengthBar.classList.add('strength-strong');
                    feedback = 'Strong password';
                    break;
            }
            
            strengthText.textContent = feedback;
        }

        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        // Form validation
        function validateField(fieldId, validator, errorMessage) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '-error');
            
            if (validator(field.value)) {
                field.classList.remove('field-error');
                field.classList.add('field-success');
                errorDiv.classList.add('hidden');
                return true;
            } else {
                field.classList.remove('field-success');
                field.classList.add('field-error');
                errorDiv.textContent = errorMessage;
                errorDiv.classList.remove('hidden');
                return false;
            }
        }

        // Real-time validation
        document.getElementById('fullName').addEventListener('blur', function() {
            validateField('fullName', 
                value => value.trim().length >= 2,
                'Full name must be at least 2 characters long'
            );
        });

        document.getElementById('email').addEventListener('blur', function() {
            validateField('email',
                value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
                'Please enter a valid email address'
            );
        });

        document.getElementById('phone').addEventListener('blur', function() {
            validateField('phone',
                value => /^[\+]?[1-9][\d]{0,15}$/.test(value.replace(/\s/g, '')),
                'Please enter a valid phone number'
            );
        });

        document.getElementById('confirmPassword').addEventListener('blur', function() {
            const password = document.getElementById('password').value;
            validateField('confirmPassword',
                value => value === password && value.length > 0,
                'Passwords do not match'
            );
        });

        // Form submission
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formx-form.Data);
      x-form.      
            // Validate all x-form.fields
            let isValid = true;
            isValid &= validateField('fullName', value => value.trim().length >= 2, 'Full name');
            isValid &= validateField('email', value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value), 'Valid email');
            isValid &= validateField('phone', value => /^[\+]?[1-9][\d]{0,15}$/.test(value.replace(/\s/g, '')), 'Valid phone');
            
            if (!data.role) {
                alert('Please select your role');
                return;
            }
            
            if (data.password.length < 6) {
                alert('Password must be at least 6 characters long');
                return;
            }
            
            if (data.password !== data.confirmPassword) {
                alert('Passwords do not match');
                return;
            }
            
            if (!document.getElementById('terms').checked) {
                alert('Please agree to the Terms & Conditions');
                return;
            }
            
            // Simulate account creation
            const signupBtn = this.querySelector('button[type="submit"]');
            const originalText = signupBtn.textContent;
            
            signupBtn.textContent = 'Creating Account...';
            signupBtn.disabled = true;
            
            setTimeout(() => {
                alert(`Account created successfully!\n\nName: ${data.fullName}\nEmail: ${data.email}\nPhone: ${data.phone}\nRole: ${data.role}`);
                signupBtn.textContent = originalText;
                signupBtn.disabled = false;
            }, 2500);
        });

        // Social sign up buttons
        document.getElementById('google-signup').addEventListener('click', function() {
            const originalText = this.textContent;
            this.textContent = 'Connecting to Google...';
            this.disabled = true;
            
            setTimeout(() => {
                alert('Google sign up would redirect to Google OAuth here.');
                this.textContent = originalText;
                this.disabled = false;
            }, 1500);
        });

        document.getElementById('facebook-signup').addEventListener('click', function() {
            const originalText = this.textContent;
            this.textContent = 'Connecting to Facebook...';
            this.disabled = true;
            
            setTimeout(() => {
                alert('Facebook sign up would redirect to Facebook OAuth here.');
                this.textContent = originalText;
                this.disabled = false;
            }, 1500);
        });

        // Links
        document.getElementById('login-link').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Redirecting to login page...');
        });

        document.getElementById('terms-link').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Terms & Conditions would open here.');
        });

        document.getElementById('privacy-link').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Privacy Policy would open here.');
        });

        // Input field animations and validation feedback
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>
