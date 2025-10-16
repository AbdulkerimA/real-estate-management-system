// Checkbox functionality
const selectAllCheckbox = document.getElementById('selectAll');
const buyerCheckboxes = document.querySelectorAll('.buyer-checkbox');
const bulkActions = document.getElementById('bulkActions');
const selectedCount = document.getElementById('selectedCount');

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.buyer-checkbox:checked');
    const count = checkedBoxes.length;
    
    if (count > 0) {
        bulkActions.classList.add('active');
        selectedCount.textContent = `${count} buyers selected`;
    } else {
        selectedCount.textContent = `${count} buyers selected`;
        bulkActions.classList.remove('active');
    }
}

selectAllCheckbox.addEventListener('change', function() {
    buyerCheckboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateBulkActions();
});

buyerCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allChecked = Array.from(buyerCheckboxes).every(cb => cb.checked);
        const someChecked = Array.from(buyerCheckboxes).some(cb => cb.checked);
        
        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
        
        updateBulkActions();
    });
});

// Clear selection
document.getElementById('clearSelection').addEventListener('click', function() {
    selectAllCheckbox.checked = false;
    buyerCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
});

// Modal functionality
const buyerModal = document.getElementById('buyerModal');
const closeModal = document.getElementById('closeModal');

function openModal() {
    buyerModal.classList.add('active');
}

function closeModalFunc() {
    buyerModal.classList.remove('active');
}

closeModal.addEventListener('click', closeModalFunc);
buyerModal.addEventListener('click', function(e) {
    if (e.target === buyerModal) {
        closeModalFunc();
    }
});

// Buyer action functions
function viewBuyer(id) {
    console.log('Viewing buyer:', id);
    openModal();
}

function suspendBuyer(id) {
    if (confirm('Are you sure you want to suspend this buyer account?')) {
        console.log('Suspending buyer:', id);
        alert('Buyer account suspended successfully!');
        // Update status in the table
        const row = document.querySelector(`[data-buyer-id="${id}"]`);
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge status-suspended';
        statusBadge.textContent = 'Suspended';
    }
}

function reactivateBuyer(id) {
    if (confirm('Are you sure you want to reactivate this buyer account?')) {
        console.log('Reactivating buyer:', id);
        alert('Buyer account reactivated successfully!');
        // Update status in the table
        const row = document.querySelector(`[data-buyer-id="${id}"]`);
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge status-active';
        statusBadge.textContent = 'Active';
    }
}

function deleteBuyer(id) {
    if (confirm('Are you sure you want to delete this buyer account? This action cannot be undone.')) {
        console.log('Deleting buyer:', id);
        alert('Buyer account deleted successfully!');
        // Remove row from table
        const row = document.querySelector(`[data-buyer-id="${id}"]`);
        row.remove();
    }
}

// Bulk actions
document.getElementById('bulkSuspend').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.buyer-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Suspend ${checkedBoxes.length} selected buyer accounts?`)) {
        checkedBoxes.forEach(checkbox => {
            suspendBuyer(checkbox.value);
        });
    }
});

document.getElementById('bulkDelete').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.buyer-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Delete ${checkedBoxes.length} selected buyer accounts? This action cannot be undone.`)) {
        checkedBoxes.forEach(checkbox => {
            deleteBuyer(checkbox.value);
        });
    }
});
    // Modal actions
document.getElementById('modalSuspend').addEventListener('click', function() {
    alert('Buyer account suspended from modal!');
    closeModalFunc();
});

document.getElementById('modalDelete').addEventListener('click', function() {
    if (confirm('Are you sure you want to delete this buyer account? This action cannot be undone.')) {
        alert('Buyer account deleted from modal!');
        closeModalFunc();
    }
});


// globalization
window.viewBuyer = viewBuyer;
window.deleteBuyer = deleteBuyer;
window.suspendBuyer = suspendBuyer;
window.reactivateBuyer = reactivateBuyer;