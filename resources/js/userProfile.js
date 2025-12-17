const defaultConfig = {
    page_title: "My Profile",
    page_subtitle: "Manage your account and personal information",
    customer_name: "John Smith",
    customer_email: "john.smith@email.com",
    footer_copyright: "© 2025 Property Sales System. All rights reserved.",
    primary_color: "#00ff88",
    background_color: "#1c252e",
    surface_color: "#1f2937",
    text_color: "#e0e0e0",
    secondary_action_color: "#a0a0a0",
    font_family: "Inter",
    font_size: 16
};

function showToast(message, isError = false) {
    const toast = document.createElement('div');
    toast.className = `toast ${isError ? 'error' : ''}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => toast.classList.add('show'), 100);
    setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
    }, 3000);
}
window.showToast = showToast;

async function updateTwoFactorAuth(enabled) {
    try {
        const res = await fetch('/profile/security/2fa', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                setting: 'two_factor_authentication',
                value: enabled
            })
        });

        const data = await res.json();
        showToast(data.message);
    } catch {
        showToast('Failed to update security setting', true);
    }
}

// Track preference states
const preferences = {
    email_notification: document.getElementById('emailNotifications').classList.contains('active'),
    sms_notification: document.getElementById('smsNotifications').classList.contains('active'),
    appointment_reminder: document.getElementById('appointmentReminders').classList.contains('active'),
};

function toggleSwitch(id) {
    const toggle = document.getElementById(id);
    toggle.classList.toggle('active');

    if (id === 'twoFactorToggle') {
        const enabled = toggle.classList.contains('active');
        updateTwoFactorAuth(enabled);
    }
    // Update local state
    if (id === 'emailNotifications') preferences.email_notification = toggle.classList.contains('active');
    if (id === 'smsNotifications') preferences.sms_notification = toggle.classList.contains('active');
    if (id === 'appointmentReminders') preferences.appointment_reminder = toggle.classList.contains('active');
}
window.toggleSwitch = toggleSwitch;

async function savePreferences() {
    try {
        const updates = Object.entries(preferences);
        for (let [key, value] of updates) {
            const res = await fetch('/profile/preferences', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ setting: key, value: value })
            });

            const data = await res.json();
            if (!res.ok) throw new Error(data.message);
        }

        showToast('Preferences updated successfully!');
    } catch (err) {
        showToast(err.message || 'Failed to update preferences', true);
    }
}
window.savePreferences = savePreferences;

function changePhoto() {
    document.getElementById('photoInput').click();
}
window.changePhoto = changePhoto;

function updateAvatarInitials(name) {
    const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
    document.getElementById('avatarInitials').textContent = initials;
}
window.updateAvatarInitials = updateAvatarInitials;


function initiateAccountDeletion() {
    const deleteBtn = document.getElementById('deleteAccountBtn');
    deleteBtn.innerHTML = `
    <div style="display: flex; flex-direction: column; gap: 1rem; width: 100%;">
        <p style="color: #fca5a5; font-weight: 600; margin-bottom: 0.5rem;">Are you absolutely sure?</p>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <button class="btn btn-danger" onclick="confirmAccountDeletion()" style="flex: 1;">Yes, Delete Forever</button>
            <button class="btn btn-secondary" onclick="cancelAccountDeletion()" style="flex: 1;">Cancel</button>
        </div>
    </div>`;
}
window.initiateAccountDeletion = initiateAccountDeletion;

async function confirmAccountDeletion() {
    try {
        const res = await fetch('/profile/delete', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
        });

        const data = await res.json();

        if (!res.ok) throw new Error(data.message || 'Failed to delete account');

        showToast('Account deleted successfully!', true);

        // Redirect to home or login page
        setTimeout(() => window.location.href = '/', 1500);

    } catch (err) {
        showToast(err.message, true);
        cancelAccountDeletion();
    }
}
window.confirmAccountDeletion = confirmAccountDeletion;

function cancelAccountDeletion() {
    const deleteBtn = document.getElementById('deleteAccountBtn');
    deleteBtn.innerHTML = 'Delete My Account';
}

window.cancelAccountDeletion = cancelAccountDeletion;

// Form submissions
document.getElementById('personalInfoForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const payload = {
        name: fullName.value,
        email: email.value,
        phone: phone.value,
        address: address.value,
    };
    // console.log(payload);
    const res = await fetch('/profile/update', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(payload)
    });

    const data = await res.json();
    // console.log(data.postlog); //for debuging only
    showToast(data.message);
});


document.getElementById('securityForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const payload = {
        current_password: document.getElementById('currentPassword').value,
        new_password: document.getElementById('newPassword').value,
        new_password_confirmation: document.getElementById('confirmPassword').value,
    };

    try {
        const res = await fetch('/profile/security/password', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload)
        });

        const data = await res.json();

        if (!res.ok) {
            showToast(data.message, true);
            return;
        }

        showToast(data.message);
        e.target.reset();
    } catch {
        showToast('Failed to update password', true);
    }
});


// Photo upload
document.getElementById('photoInput').addEventListener('change', async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('profilePic', file);

    try {
        const res = await fetch('/profile/photo', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        const data = await res.json();

        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById('avatarCircle').innerHTML =
                `<img src="${reader.result}" class="w-full h-full object-cover rounded-full">`;
        };
        reader.readAsDataURL(file);

        showToast(data.message);
    } catch {
        showToast('Photo upload failed', true);
    }
});



// // Document upload
// document.getElementById('documentInput').addEventListener('change', (e) => {
//     const files = Array.from(e.target.files);
//     files.forEach(file => {
//     const fileItem = document.createElement('div');
//     fileItem.className = 'file-item';
//     fileItem.innerHTML = `
//         <div class="file-info">
//         <div class="file-icon">📄</div>
//         <div class="file-details">
//             <div class="file-name">${file.name}</div>
//             <div class="file-size">${(file.size / 1024 / 1024).toFixed(1)} MB</div>
//         </div>
//         </div>
//         <span class="status-badge status-pending">Pending</span>
//     `;
//     document.getElementById('uploadedFiles').appendChild(fileItem);
//     });
//     showToast(`${files.length} document(s) uploaded successfully!`);
// });

// Drag and drop
// const uploadArea = document.getElementById('uploadArea');

// uploadArea.addEventListener('dragover', (e) => {
//     e.preventDefault();
//     uploadArea.classList.add('dragover');
// });

// uploadArea.addEventListener('dragleave', () => {
//     uploadArea.classList.remove('dragover');
// });

// uploadArea.addEventListener('drop', (e) => {
//     e.preventDefault();
//     uploadArea.classList.remove('dragover');
//     const files = Array.from(e.dataTransfer.files);

//     files.forEach(file => {
//     const fileItem = document.createElement('div');
//     fileItem.className = 'file-item';
//     fileItem.innerHTML = `
//         <div class="file-info">
//         <div class="file-icon">📄</div>
//         <div class="file-details">
//             <div class="file-name">${file.name}</div>
//             <div class="file-size">${(file.size / 1024 / 1024).toFixed(1)} MB</div>
//         </div>
//         </div>
//         <span class="status-badge status-pending">Pending</span>
//     `;
//     document.getElementById('uploadedFiles').appendChild(fileItem);
//     });

//     showToast(`${files.length} document(s) uploaded successfully!`);
// });

// async function onConfigChange(config) {
//     const customFont = config.font_family || defaultConfig.font_family;
//     const baseSize = config.font_size || defaultConfig.font_size;
//     const baseFontStack = '-apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';

//     document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;
//     document.body.style.fontSize = `${baseSize}px`;

//     const primaryColor = config.primary_color || defaultConfig.primary_color;
//     const backgroundColor = config.background_color || defaultConfig.background_color;
//     const surfaceColor = config.surface_color || defaultConfig.surface_color;
//     const textColor = config.text_color || defaultConfig.text_color;
//     const secondaryActionColor = config.secondary_action_color || defaultConfig.secondary_action_color;

//     document.body.style.background = `linear-gradient(135deg, ${backgroundColor} 0%, #12181f 100%)`;
//     document.body.style.color = textColor;

//     document.querySelectorAll('.stat-number, .email, .btn-primary, .toggle-switch.active').forEach(el => {
//     if (el.classList.contains('btn-primary')) {
//         el.style.background = `linear-gradient(135deg, ${primaryColor}, #00cc6a)`;
//     } else if (el.classList.contains('toggle-switch')) {
//         el.style.background = primaryColor;
//     } else {
//         el.style.color = primaryColor;
//     }
//     });

//     document.querySelectorAll('.form-section, .profile-overview, .footer').forEach(el => {
//     el.style.background = surfaceColor;
//     });

//     document.querySelectorAll('.stat-label, .footer-links a, .upload-subtext').forEach(el => {
//     el.style.color = secondaryActionColor;
//     });

//     document.getElementById('page-title').textContent = config.page_title || defaultConfig.page_title;
//     document.getElementById('page-subtitle').textContent = config.page_subtitle || defaultConfig.page_subtitle;
//     document.getElementById('customer-name').textContent = config.customer_name || defaultConfig.customer_name;
//     document.getElementById('customer-email').textContent = config.customer_email || defaultConfig.customer_email;
//     document.getElementById('footer-copyright').textContent = config.footer_copyright || defaultConfig.footer_copyright;

//     updateAvatarInitials(config.customer_name || defaultConfig.customer_name);
// }