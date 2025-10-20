// Password modal functions
function openPasswordModal() {
    document.getElementById('passwordModal').classList.remove('hidden');
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.add('hidden');
}

function changePassword() {
    alert('Password updated successfully!');
    closePasswordModal();
}

// Settings functions
function saveAccountSettings() {
    alert('Account settings saved successfully!');
}

function savePreferences() {
    alert('Preferences saved successfully!');
}

function downloadLogs() {
    alert('Downloading system logs...');
}

function backupDatabase() {
    if (confirm('Are you sure you want to create a database backup?')) {
        alert('Database backup initiated...');
    }
}

function restoreDatabase() {
    if (confirm('Are you sure you want to restore from backup? This will overwrite current data.')) {
        alert('Database restore initiated...');
    }
}

function clearCache() {
    if (confirm('Are you sure you want to clear the system cache?')) {
        alert('System cache cleared successfully!');
    }
}

function copyApiKey(type) {
    const keys = {
        payment: 'CAPI_sk_test_1234567890abcdef1234567890abcdef',
        sms: 'SMS_api_key_1234567890abcdef1234567890abcdef',
        maps: 'GMAP_AIzaSyC1234567890abcdef1234567890abcdef'
    };
    
    navigator.clipboard.writeText(keys[type]).then(() => {
        alert(`${type.toUpperCase()} API key copied to clipboard!`);
    });
}

// // working with input and confirm modals

// const inputModal = document.getElementById('inputModal');
// const confirmModal = document.getElementById('confirmModal');


// function deactivatePlatform() {
//     // inputModal.style.height = `${window.innerHeight}px`;
//     inputModal.classList.add('active');
// }

// function deleteAccount() {
//     // modal.style.height = `${window.innerHeight}px`;
//     confirmModal.classList.add('active');
// }

// making all functions global scoped 
window.openPasswordModal = openPasswordModal;
window.closePasswordModal = closePasswordModal;
window.changePassword = changePassword;
window.saveAccountSettings = saveAccountSettings;
window.savePreferences = savePreferences;
window.downloadLogs = downloadLogs;
window.backupDatabase = backupDatabase;
window.restoreDatabase = restoreDatabase;
window.clearCache = clearCache;
window.copyApiKey = copyApiKey;
// window.deactivatePlatform = deactivatePlatform;
// window.deleteAccount = deleteAccount;

// Form validation
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            this.style.borderColor = '#ef4444';
        } else {
            this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
        }
    });
});

// Auto-save preferences
document.querySelectorAll('select.form-input').forEach(select => {
    select.addEventListener('change', function() {
        const setting = this.closest('.setting-item').querySelector('h4').textContent;
        console.log(`${setting} changed to: ${this.value}`);
        
        // Show temporary save indicator
        const indicator = document.createElement('div');
        indicator.className = 'fixed top-4 right-4 bg-accent-green text-dark-secondary px-4 py-2 rounded-lg font-medium z-50';
        indicator.textContent = 'Setting saved';
        document.body.appendChild(indicator);
        
        setTimeout(() => {
            indicator.remove();
        }, 2000);
    });
});