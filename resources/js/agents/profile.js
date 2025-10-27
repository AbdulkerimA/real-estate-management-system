const profilePhoto = document.getElementById('profilePhoto');
const photoInput = document.getElementById('photoInput');
const profileImage = document.getElementById('profileImage');

// open file explorer
profilePhoto.addEventListener('click', () => {
    photoInput.click();
});

photoInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            profileImage.src = e.target.result;
            profileImage.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
    // Create FormData object to hold the file
        const formData = new FormData();
        formData.append('profilePic', file); // Append the file to the FormData object

        fetch('/dashboard/media', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Assuming your server returns JSON
        })
        .then(data => {
            // Handle success (you can also show a success message here)
            console.log('Profile picture updated successfully:', data);
        })
        .catch(error => {
            // Handle error
            console.error('There was a problem with the fetch operation:', error);
        });
    
});

// Form validation
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^[\+]?[1-9][\d]{0,15}$/;
    return re.test(phone.replace(/\s/g, ''));
}

// Personal form validation
const personalForm = document.getElementById('personalForm');
const fullNameInput = document.getElementById('fullName');
const emailInput = document.getElementById('email');
const phoneInput = document.getElementById('phone');

function validatePersonalForm() {
    let isValid = true;

    if(fullNameInput){
        // Full name validation
        if (fullNameInput.value.trim().length < 2) {
            fullNameInput.classList.add('error');
            document.getElementById('fullNameError').classList.remove('hidden');
            isValid = false;
        } else {
            fullNameInput.classList.remove('error');
            fullNameInput.classList.add('success');
            document.getElementById('fullNameError').classList.add('hidden');
        }
    }

    if(emailInput){
        // Email validation
        if (!validateEmail(emailInput.value)) {
            emailInput.classList.add('error');
            document.getElementById('emailError').classList.remove('hidden');
            isValid = false;
        } else {
            emailInput.classList.remove('error');
            emailInput.classList.add('success');
            document.getElementById('emailError').classList.add('hidden');
        }
    }

    if(phoneInput){
        // Phone validation
        if (!validatePhone(phoneInput.value)) {
            phoneInput.classList.add('error');
            document.getElementById('phoneError').classList.remove('hidden');
            isValid = false;
        } else {
            phoneInput.classList.remove('error');
            phoneInput.classList.add('success');
            document.getElementById('phoneError').classList.add('hidden');
        }
    }

    return isValid;
}

personalForm ? personalForm.addEventListener('submit', function(e) {
    // e.preventDefault();
    if (validatePersonalForm()) {
        // Simulate saving
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.textContent = 'Saving...';
        
        setTimeout(() => {
            button.disabled = false;
            button.textContent = 'Save Personal Information';
            document.getElementById('personalSuccess').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('personalSuccess').classList.add('hidden');
            }, 3000);
        }, 1000);
    }
}) : '';

// Real-time validation
fullNameInput ? fullNameInput.addEventListener('input', validatePersonalForm):'';
emailInput ? emailInput.addEventListener('input', validatePersonalForm):'';
phoneInput ? phoneInput.addEventListener('input', validatePersonalForm) : '';

// Professional form
const professionalForm = document.getElementById('professionalForm');
professionalForm ? professionalForm.addEventListener('submit', function(e) {
    
    const button = this.querySelector('button[type="submit"]');
    button.disabled = true;
    button.textContent = 'Saving...';
}) : '';

// Specialty tags
document.querySelectorAll('.specialty-tag').forEach(tag => {
    tag.addEventListener('click', function() {
        this.classList.toggle('selected');
    });
});

// Bio character counter
const bioTextarea = document.getElementById('bio');
const bioCounter = document.getElementById('bioCounter');
const bioError = document.getElementById('bioError');

function updateBioCounter() {
    const length = bioTextarea?bioTextarea.value.length:0;
    const maxLength = 500;
    bioCounter?bioCounter.textContent = `${length}/${maxLength}`:'';
    
    if (length > maxLength) {
        bioError?bioError.classList.remove('hidden'):'';
        bioTextarea?bioTextarea.classList.add('error'):'';
    } else {
        bioError?bioError.classList.add('hidden'):'';
        bioTextarea?bioTextarea.classList.remove('error'):'';
    }
}

bioTextarea ? bioTextarea.addEventListener('input', updateBioCounter) : '';

// Password strength checker
const newPasswordInput = document.getElementById('newPassword');
const confirmPasswordInput = document.getElementById('confirmPassword');
const strengthBar = document.getElementById('strengthBar');
const strengthText = document.getElementById('strengthText');
const passwordError = document.getElementById('passwordError');

function checkPasswordStrength(password) {
    let strength = 0;
    let text = 'Weak';
    let className = 'strength-weak';

    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    if (strength >= 4) {
        text = 'Strong';
        className = 'strength-strong';
    } else if (strength >= 3) {
        text = 'Good';
        className = 'strength-good';
    } else if (strength >= 2) {
        text = 'Fair';
        className = 'strength-fair';
    }

    strengthBar.className = `password-strength ${className}`;
    strengthText.textContent = password.length > 0 ? text : 'Enter password';
}

function validatePasswordMatch() {
    if (confirmPasswordInput.value && newPasswordInput.value !== confirmPasswordInput.value) {
        passwordError.classList.remove('hidden');
        confirmPasswordInput.classList.add('error');
        return false;
    } else {
        passwordError.classList.add('hidden');
        confirmPasswordInput.classList.remove('error');
        return true;
    }
}

newPasswordInput ? newPasswordInput.addEventListener('input', function() {
    checkPasswordStrength(this.value);
    validatePasswordMatch();
}) : '';

confirmPasswordInput ? confirmPasswordInput.addEventListener('input', validatePasswordMatch) : '';

// Password form
const passwordForm = document.getElementById('passwordForm');
passwordForm ? passwordForm.addEventListener('submit', function(e) {
    // e.preventDefault();
    if (validatePasswordMatch() && newPasswordInput.value.length >= 6) {
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.textContent = 'Updating...';
    }else{
        e.preventDefault();
    }
}) : '';