// alert('');
let uploadedPhoto = null;
let uploadedDocuments = [];

// Form progress tracking
// function updateProgress() {
//     const form = document.getElementById('signupForm');
//     const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
//     let filledInputs = 0;

//     inputs.forEach(input => {
//         if (input.type === 'checkbox') {
//             if (input.checked) filledInputs++;
//         } else if (input.value.trim() !== '') {
//             filledInputs++;
//         }
//     });

//     const progress = Math.round((filledInputs / inputs.length) * 100);
//     document.getElementById('progressFill').style.width = progress + '%';
//     document.getElementById('progressText').textContent = progress + '%';
// }

// Add event listeners to form inputs
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const inputs = form.querySelectorAll('input, select, textarea');

    // inputs.forEach(input => {
    //     input.addEventListener('input', updateProgress);
    //     input.addEventListener('change', updateProgress);
    // });

    // updateProgress();
});

// Photo upload functionality
const photoUploadArea = document.getElementById('photoUploadArea');
const photoInput = document.getElementById('photoInput');
const photoPreview = document.getElementById('photoPreview');
const photoUploadPrompt = document.getElementById('photoUploadPrompt');
const previewImage = document.getElementById('previewImage');

photoUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    photoUploadArea.classList.add('dragover');
});

photoUploadArea.addEventListener('dragleave', () => {
    photoUploadArea.classList.remove('dragover');
});

photoUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    photoUploadArea.classList.remove('dragover');
    const files = Array.from(e.dataTransfer.files);
    if (files.length > 0 && files[0].type.startsWith('image/')) {
        handlePhotoUpload(files[0]);
    }
});

photoInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        handlePhotoUpload(e.target.files[0]);
    }
});

function handlePhotoUpload(file) {
    if (file.size > 5 * 1024 * 1024) {
        alert('Please upload an image smaller than 5MB.');
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        uploadedPhoto = file;
        previewImage.src = e.target.result;
        photoPreview.classList.remove('hidden');
        photoUploadPrompt.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

function changePhoto() {
    photoInput.click();
}

// Document upload functionality
const documentUploadArea = document.getElementById('documentUploadArea');
const documentInput = document.getElementById('documentInput');
const documentList = document.getElementById('documentList');

documentUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    documentUploadArea.classList.add('dragover');
});

documentUploadArea.addEventListener('dragleave', () => {
    documentUploadArea.classList.remove('dragover');
});

documentUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    documentUploadArea.classList.remove('dragover');
    const files = Array.from(e.dataTransfer.files);
    handleDocumentUpload(files);
});

documentInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    handleDocumentUpload(files);
});

function handleDocumentUpload(files) {
    files.forEach(file => {
        if (file.size > 5 * 1024 * 1024) {
            alert(`File ${file.name} is too large. Please upload files smaller than 5MB.`);
            return;
        }

        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert(`File ${file.name} is not supported. Please upload PDF, JPG, or PNG files.`);
            return;
        }

        uploadedDocuments.push(file);
        updateDocumentList();
    });
}

function updateDocumentList() {
    if (uploadedDocuments.length === 0) {
        documentList.classList.add('hidden');
        return;
    }

    documentList.classList.remove('hidden');
    documentList.innerHTML = uploadedDocuments.map((file, index) => `
        <div class="file-item">
            <div class="flex items-center flex-1">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <div>
                    <p class="text-white text-sm font-medium">${file.name}</p>
                    <p class="text-gray-400 text-xs">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                </div>
            </div>
            <button type="button" class="text-red-400 hover:text-red-300 ml-3" onclick="removeDocument(${index})">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    `).join('');
}

function removeDocument(index) {
    uploadedDocuments.splice(index, 1);
    updateDocumentList();
}

// Password strength checker
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const passwordStrength = document.getElementById('passwordStrength');
const passwordMatch = document.getElementById('passwordMatch');

passwordInput.addEventListener('input', function() {
    const password = this.value;
    const strength = checkPasswordStrength(password);
    
    passwordStrength.className = 'password-strength mt-2 ' + strength.class;
    passwordStrength.style.width = strength.width;
    
    checkPasswordMatch();
});

confirmPasswordInput.addEventListener('input', checkPasswordMatch);

function checkPasswordStrength(password) {
    if (password.length < 6) {
        return { class: 'strength-weak', width: '33%' };
    } else if (password.length < 8 || !/(?=.*[a-zA-Z])(?=.*\d)/.test(password)) {
        return { class: 'strength-medium', width: '66%' };
    } else {
        return { class: 'strength-strong', width: '100%' };
    }
}

function checkPasswordMatch() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    
    if (confirmPassword === '') {
        passwordMatch.textContent = '';
        confirmPasswordInput.classList.remove('error', 'success');
    } else if (password === confirmPassword) {
        passwordMatch.textContent = '✓ Passwords match';
        passwordMatch.className = 'text-accent-green text-xs mt-1';
        confirmPasswordInput.classList.remove('error');
        confirmPasswordInput.classList.add('success');
    } else {
        passwordMatch.textContent = '✗ Passwords do not match';
        passwordMatch.className = 'text-red-400 text-xs mt-1';
        confirmPasswordInput.classList.remove('success');
        confirmPasswordInput.classList.add('error');
    }
}

// Form submission
document.getElementById('signupForm').addEventListener('submit', function(e) {
    // e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating Account...';

    // Validate required fields
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (field.type === 'checkbox') {
            if (!field.checked) {
                e.preventDefault();
                isValid = false;
            }
        } else if (!field.value.trim()) {
            e.preventDefault();
            field.classList.add('error');
            isValid = false;
        } else {
            field.classList.remove('error');
        }
    });

    // Check password match
    if (passwordInput.value !== confirmPasswordInput.value) {
        e.preventDefault();
        confirmPasswordInput.classList.add('error');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields and ensure passwords match.');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Sign Up as Agent';
        return;
    }

    // // Simulate API call
    // setTimeout(() => {
    //     document.getElementById('successModal').classList.remove('hidden');
    //     submitBtn.disabled = false;
    //     submitBtn.textContent = 'Sign Up as Agent';
    // }, 2000);
});

function closeModal() {
    document.getElementById('successModal').classList.add('hidden');
    alert('Redirecting to dashboard...');
}

// Form validation
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.hasAttribute('required') && this.value.trim() === '') {
            this.classList.add('error');
        } else {
            this.classList.remove('error');
        }
    });

    input.addEventListener('focus', function() {
        this.classList.remove('error');
    });
});

// Social signup buttons
document.querySelectorAll('.social-button').forEach(button => {
    button.addEventListener('click', function() {
        const provider = this.textContent.trim();
        alert(`${provider} signup would be implemented here.`);
    });
});