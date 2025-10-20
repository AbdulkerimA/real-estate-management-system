// Confirmation modal functionality
const confirmModal = document.getElementById('confirmModal');
const modalTitle = document.getElementById('modalTitle');
const modalMessage = document.getElementById('modalMessage');
const modalCancel = document.getElementById('modalCancel');
const modalConfirm = document.getElementById('modalConfirm');

function showConfirmModal(title, message, onConfirm) {
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    confirmModal.classList.add('active');
    
    modalConfirm.onclick = () => {
        confirmModal.classList.remove('active');
        onConfirm();
    };
}

modalCancel ? modalCancel.addEventListener('click', () => {
    confirmModal.classList.remove('active');
}) : '';

// Deactivate account
const deactivateBtn = document.getElementById('deactivateBtn');

if (deactivateBtn) {
    deactivateBtn.addEventListener('click', function () {
        const url = '/dashboard/settings';

        showConfirmModal(
            'Deactivate Account',
            'Your account will be temporarily disabled. You can reactivate it by logging in again. Continue?',
            async () => { // make this async so we can await fetch
                try {
                    const response = await fetch(url, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            setting: 'deactivated',
                            value: 1
                        }),
                    });

                    if (response.ok) {
                        const data = await response.json();
                        console.log("Preference updated:", data);

                        // // Optionally show a message or redirect
                        // alert("Your account has been deactivated. Logging out...");
                        // window.location.href = '/logout'; // optional
                    } else {
                        console.error("Update failed:", await response.text());
                        alert("Failed to deactivate account.");
                    }
                } catch (error) {
                    console.error("Error sending request:", error);
                    alert("Something went wrong while deactivating your account.");
                }
            }
        );
    });
}

window.showConfirmModal = showConfirmModal;