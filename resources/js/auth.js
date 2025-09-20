// tailwind.config = {
//             theme: {
//                 extend: {
//                     colors: {
//                         'dark-primary': '#1c252e',
//                         'dark-secondary': '#12181f',
//                         'accent-green': '#00ff88'
//                     }
//                 }
//             }
//         }
        // console.log(document.getElementById('password'));
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

// Form submission
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('remember-me').checked;
    
    if (!email || !password) {
        alert('Please fill in all required fields.');
        return;
    }
    
    // Simulate login process
    const loginBtn = this.querySelector('button[type="submit"]');
    const originalText = loginBtn.textContent;
    
    loginBtn.textContent = 'Logging in...';
    loginBtn.disabled = true;
    
    setTimeout(() => {
        alert(`Login successful!\nEmail: ${email}\nRemember Me: ${rememberMe ? 'Yes' : 'No'}`);
        loginBtn.textContent = originalText;
        loginBtn.disabled = false;
    }, 2000);
});

// Google login
document.getElementById('google-login').addEventListener('click', function() {
    const originalText = this.textContent;
    this.textContent = 'Connecting to Google...';
    this.disabled = true;
    
    setTimeout(() => {
        alert('Google login would redirect to Google OAuth here.');
        this.textContent = originalText;
        this.disabled = false;
    }, 1500);
});

// Facebook login
document.getElementById('facebook-login').addEventListener('click', function() {
    const originalText = this.textContent;
    this.textContent = 'Connecting to Facebook...';
    this.disabled = true;
    
    setTimeout(() => {
        alert('Facebook login would redirect to Facebook OAuth here.');
        this.textContent = originalText;
        this.disabled = false;
    }, 1500);
});

// Forgot password
document.getElementById('forgot-password').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Forgot password functionality would open a password reset form or send you to a reset page.');
});

// Sign up link
document.getElementById('signup-link').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Sign up page would open here.');
});

// Input field animations
document.querySelectorAll('.input-field').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Form validation feedback
document.getElementById('email').addEventListener('input', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value && !emailRegex.test(this.value) && !this.value.includes('@')) {
        // Assume it's a username if no @ symbol
        this.style.borderColor = '#00ff88';
    } else if (this.value && emailRegex.test(this.value)) {
        this.style.borderColor = '#00ff88';
    } else if (this.value) {
        this.style.borderColor = '#ef4444';
    } else {
        this.style.borderColor = '#4b5563';
    }
});

document.getElementById('password').addEventListener('input', function() {
    if (this.value.length >= 6) {
        this.style.borderColor = '#00ff88';
    } else if (this.value.length > 0) {
        this.style.borderColor = '#f59e0b';
    } else {
        this.style.borderColor = '#4b5563';
    }
});