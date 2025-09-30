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

function showError(message) {
  const errorBox = document.getElementById("error-message");
  const errorText = document.getElementById("error-text");

  // Set the dynamic message
  errorText.textContent = message;

  // Make it visible
  errorBox.classList.remove("hidden");

  // Restart animation (important if triggered multiple times)
  errorBox.classList.remove("animate-slideDownFade");
  void errorBox.offsetWidth; // forces reflow to restart animation
  errorBox.classList.add("animate-slideDownFade");

  // Auto-hide after 3s
  setTimeout(() => {
    errorBox.classList.add("hidden");
  }, 3000);
}

function hideError() {
    // alert('');
  const errorBox = document.getElementById("error-message");
  errorBox.classList.add("hidden");
}

// Form submission
document.getElementById('signup-form').addEventListener('submit', function(e) {
    // e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Validate all fields
    let isValid = true;
    isValid &= validateField('fullName', value => value.trim().length >= 2, 'Full name is required');
    isValid &= validateField('email', value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value), 'Valid email is required');
    isValid &= validateField('phone', value => /^[\+]?[1-9][\d]{0,15}$/.test(value.replace(/\s/g, '')), 'Valid phone is required');
    
    if (data.password.length < 6) {
        e.preventDefault();
        showError('Password must be at least 6 characters long');
        return;
    }
    
    if (data.password !== data.password_confirmation) {
        e.preventDefault();
        showError('Passwords do not match');
        return;
    }
    
    if (!document.getElementById('terms').checked) {
        e.preventDefault();
        showError('Please agree to the Terms & Conditions');
        return;
    }
    
    // Simulate account creation
    const signupBtn = this.querySelector('button[type="submit"]');
    const originalText = signupBtn.textContent;
    
    signupBtn.textContent = 'Creating Account...';
    signupBtn.disabled = true;
    
    // setTimeout(() => {
    //     alert(`Account created successfully!\n\nName: ${data.fullName}\nEmail: ${data.email}\nPhone: ${data.phone}`);
    //     signupBtn.textContent = originalText;
    //     signupBtn.disabled = false;
    // }, 2500);
    // Send POST request
    // fetch('/signup', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',   // we’re sending JSON
    //     },
    //     body: JSON.stringify(data),              // convert form data to JSON
    // })
    // .then(response => {
    //     if (!response.ok) {
    //         throw new Error('Signup failed');
    //     }
    //     return response.json(); // assuming your backend responds with JSON
    // })
    // .then(result => {
    //     // success
    //     showError('Account created successfully!');
    //     console.log('Signup success:', result);

    //     // Reset form fields (optional)
    //     this.reset();
    // })
    // .catch(error => {
    //     showError(error.message || 'Something went wrong during signup');
    //     console.error('Signup error:', error);
    // })
    // .finally(() => {
    //     // Restore button
    //     signupBtn.textContent = originalText;
    //     signupBtn.disabled = false;
    // });
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

// // Links
// document.getElementById('login-link').addEventListener('click', function(e) {
//     e.preventDefault();
//     alert('Redirecting to login page...');
// });

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