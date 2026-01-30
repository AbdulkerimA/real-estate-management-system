// Password modal functions
function openPasswordModal() {
    document.getElementById('passwordModal').classList.remove('hidden');
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.add('hidden');
}

function changePassword(){
    fetch('/admin/settings/password', {
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            current_password: document.getElementById('current_password').value,
            new_password: document.getElementById('new_password').value,
            new_password_confirmation: document.getElementById('new_password_confirmation').value
        })
    })
    .then(res=>res.json())
    .then(data=>{
        alert(data.message);
        if(data.success) closePasswordModal();
    });
}

// Settings functions
document.getElementById('accountSettingsForm').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch('/admin/settings/account', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => console.error(err));
});

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