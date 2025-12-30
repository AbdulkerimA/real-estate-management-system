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

// Modal fields
const modalName = document.getElementById('modalName');
const modalStatus = document.getElementById('modalStatus');
const modalEmail = document.getElementById('modalEmail');
const modalPhone = document.getElementById('modalPhone');
const modalLocation = document.getElementById('modalLocation');
const modalJoinDate = document.getElementById('modalJoinDate');
// const modalPurchased = document.getElementById('modalPurchased');
const modalBookmarked = document.getElementById('modalBookmarked');
const bookmarkedContainer = document.getElementById('modalBookmarkedProperties');
const purchaseContainer = document.getElementById('modalPurchaseHistory');

// Action buttons inside modal
const modalSuspendBtn = document.getElementById('modalSuspend');
const modalDeleteBtn = document.getElementById('modalDelete');

async function viewBuyer(id) {
    try {
        const res = await fetch(`/admin/customers/${id}`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) throw new Error('Failed to fetch buyer data');
        const data = await res.json();

        // Fill modal fields
        modalName.textContent = data.name;
        modalStatus.textContent = data.status;
        modalStatus.className = `status-badge status-${data.status.toLowerCase()}`;
        modalEmail.textContent = data.email;
        modalPhone.textContent = data.phone;
        modalLocation.textContent = data.location;
        modalJoinDate.textContent = new Date(data.joined_at).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        // modalPurchased.textContent = data.purchased_properties;
        modalBookmarked.textContent = data.bookmarked_properties.length;
        console.log(data);
        renderBookmarkedProperties(data.bookmarked_properties);
        renderPurchaseHistory(data.purchases);
        
        // Attach buyer ID to buttons
        // modalSuspendBtn.dataset.buyerId = id;
        // modalDeleteBtn.dataset.buyerId = id;

        // Show modal
        buyerModal.classList.add('active');
    } catch (err) {
        toast('Failed to load buyer data', 'error');
        console.error(err);
    }
}

function renderPurchaseHistory(purchases) {
    purchaseContainer.innerHTML = '';

    if (!purchases || purchases.length === 0) {
        purchaseContainer.innerHTML = `
            <p class="text-gray-400 text-sm">
                No purchases yet
            </p>`;
        return;
    }

    purchases.forEach(purchase => {
        purchaseContainer.innerHTML += `
            <div class="purchase-item">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-700 flex items-center justify-center">
                            ${
                                purchase.image
                                    ? `<img src="${purchase.image}" class="w-full h-full object-cover">`
                                    : `<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16" />
                                       </svg>`
                            }
                        </div>

                        <div>
                            <p class="text-white font-medium text-sm">${purchase.title}</p>
                            <p class="text-gray-400 text-xs">${purchase.location}</p>
                            <p class="text-gray-400 text-xs">
                                Purchased: ${purchase.date}
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="text-accent-green font-semibold">
                            ₹${Number(purchase.price).toLocaleString()}
                        </p>
                        <span class="text-xs px-2 py-1 rounded
                            ${purchase.status === 'completed'
                                ? 'text-green-400 bg-green-400/20'
                                : 'text-yellow-400 bg-yellow-400/20'}">
                            ${purchase.status}
                        </span>
                    </div>
                </div>
            </div>
        `;
    });
}


function renderBookmarkedProperties(properties) {
    bookmarkedContainer.innerHTML = '';

    if (!properties || properties.length === 0) {
        bookmarkedContainer.innerHTML = `
            <p class="text-gray-400 text-sm col-span-full">
                No bookmarked properties
            </p>`;
        return;
    }

    properties.forEach(property => {
        bookmarkedContainer.innerHTML += `
            <div class="property-card">
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-700 flex items-center justify-center">
                        ${
                            property.image
                                ? `<img src="${property.image}" class="w-full h-full object-cover">`
                                : `<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
                                   </svg>`
                        }
                    </div>

                    <div class="flex-1">
                        <p class="text-white font-medium text-sm">${property.title}</p>
                        <p class="text-gray-400 text-xs">${property.location}</p>
                        <p class="text-accent-green font-semibold text-sm">
                            ETB${Number(property.price).toLocaleString()}
                        </p>
                    </div>
                </div>
            </div>
        `;
    });
}

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


async function suspendBuyer(id) {
    if (!confirm('Suspend this buyer?')) return;

    try {
        const res = await fetch(`/admin/customers/${id}/suspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        if (!res.ok) throw new Error();
        const data = res.json();
        // return;
        const row = document.querySelector(`[data-buyer-id="${id}"]`);
        if (row) {
            const badge = row.querySelector('.status-badge');
            // console.log(res.status);
            if(res.status == 'suspended'){
                badge.className = 'status-badge status-suspended';
                badge.textContent = 'suspended';
                toast("user suspended successfuly",'success');
            }
            else{
                badge.className = 'status-badge status-Verified';
                badge.textContent = 'Verified';
            }
        }
        else{
            window.location.reload();
            toast("user suspended successfuly",'success');
        }

    } catch {
        toast('Suspension failed', 'error');
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

async function deleteBuyer(id) {
    if (!confirm('Delete this buyer? This cannot be undone.')) return;

    try {
        const res = await fetch(`/admin/customers/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        if (!res.ok) throw new Error();

        document.querySelector(`[data-buyer-id="${id}"]`)?.remove();
        window.location.reload();

        toast('Buyer deleted successfully');

    } catch {
        toast('Delete failed', 'error');
    }
}


// Bulk actions
document.getElementById('bulkSuspend').addEventListener('click', async () => {
    const boxes = document.querySelectorAll('.buyer-checkbox:checked');
    if (!boxes.length) return;

    if (!confirm(`Suspend ${boxes.length} buyers?`)) return;

    for (const box of boxes) {
        await suspendBuyer(box.value);
    }
});


document.getElementById('bulkDelete').addEventListener('click', async () => {
    const boxes = document.querySelectorAll('.buyer-checkbox:checked');
    if (!boxes.length) return;

    if (!confirm(`Delete ${boxes.length} buyers?`)) return;

    for (const box of boxes) {
        await deleteBuyer(box.value);
    }
});

    // Modal actions
// document.getElementById('modalSuspend').addEventListener('click', function() {
//     alert('Buyer account suspended from modal!');
//     closeModalFunc();
// });

// document.getElementById('modalDelete').addEventListener('click', function() {
//     if (confirm('Are you sure you want to delete this buyer account? This action cannot be undone.')) {
//         alert('Buyer account deleted from modal!');
//         closeModalFunc();
//     }
// });

function toast(message, type = 'success', duration = 3000) {
    const container = document.getElementById('toastContainer');

    // Create toast element
    const toastEl = document.createElement('div');
    toastEl.className = `
        px-4 py-3 rounded-lg shadow-md text-white flex items-center justify-between
        transition-all transform duration-300
        ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}
    `;
    toastEl.innerHTML = `
        <span>${message}</span>
        <button class="ml-4 font-bold">&times;</button>
    `;

    // Close on click
    toastEl.querySelector('button').addEventListener('click', () => {
        container.removeChild(toastEl);
    });

    // Append to container
    container.appendChild(toastEl);

    // Auto-remove after duration
    setTimeout(() => {
        if (container.contains(toastEl)) {
            container.removeChild(toastEl);
        }
    }, duration);
}



// globalization
window.viewBuyer = viewBuyer;
window.deleteBuyer = deleteBuyer;
window.suspendBuyer = suspendBuyer;
window.reactivateBuyer = reactivateBuyer;