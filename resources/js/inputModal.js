import './confirmModal';

// input modal functionality
const inputModal = document.getElementById('inputModal');
const inputModalTitle = document.getElementById('inputModalTitle');
const inputModalMessage = document.getElementById('inputModalMessage');
const inputModalField = document.getElementById('inputModalField');
const inputModalConfirm = document.getElementById('inputModalConfirm');
const inputModalCancel = document.getElementById('inputModalCancel');

function showInputModal(title, message, onConfirm) {
    // Set modal text
    inputModalTitle.textContent = title;
    inputModalMessage.textContent = message;
    inputModalField.value = ''; // clear input

    // Show modal
    inputModal.classList.add('active');

    // Confirm
    inputModalConfirm.onclick = () => {
        const inputValue = inputModalField.value.trim();
        inputModal.classList.remove('active');
        onConfirm(inputValue);
    };

    // Cancel
    inputModalCancel.onclick = () => {
        inputModal.classList.remove('active');
    };
}


// Delete account
const deleteAccountBtn = document.getElementById('deleteBtn');

if (deleteAccountBtn) {
    deleteAccountBtn.addEventListener('click', function () {
        showConfirmModal(
            'Delete Account Permanently',
            'This action cannot be undone. All your data, properties, and messages will be permanently deleted. Are you absolutely sure?',
            () => {
                // Second confirmation for delete
                showInputModal(
                    'Final Confirmation',
                    'Type "DELETE MY ACCOUNT" to confirm permanent account deletion.',
                    async (inputValue) => {
                        if (inputValue.trim().toUpperCase() === 'DELETE') {
                            const url = '/dashboard/settings/delete';

                            try {
                                const response = await fetch(url, {
                                    method: "DELETE",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                    },
                                });

                                if (response.ok) {
                                    alert('Account deletion initiated. You will receive a confirmation email.');
                                    window.location.href = '/'; 
                                } else {
                                    alert('Failed to delete account. Please try again.');
                                    console.error(await response.text());
                                }
                            } catch (error) {
                                console.error("Error deleting account:", error);
                                alert("Something went wrong. Please try again later.");
                            }
                        } else {
                            alert('You must type "DELETE" to confirm.');
                        }
                    }
                );
            }
        );
    });
}
