import KeenSlider from 'keen-slider';
import 'keen-slider/keen-slider.min.css';

// ---------------- Checkbox & Bulk Actions ----------------
const selectAllCheckbox = document.getElementById('selectAll');
const propertyCheckboxes = document.querySelectorAll('.property-checkbox');
const bulkActions = document.getElementById('bulkActions');
const selectedCount = document.getElementById('selectedCount');

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.property-checkbox:checked');
    const count = checkedBoxes.length;
    
    if (count > 0) {
        bulkActions.classList.add('active');
        selectedCount.textContent = `${count} properties selected`;
    } else {
        selectedCount.textContent = `${count} properties selected`;
        bulkActions.classList.remove('active');
    }
}

if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', function() {
        propertyCheckboxes.forEach(cb => cb.checked = this.checked);
        updateBulkActions();
    });
}

propertyCheckboxes.forEach(cb => {
    cb.addEventListener('change', function() {
        const allChecked = Array.from(propertyCheckboxes).every(c => c.checked);
        const someChecked = Array.from(propertyCheckboxes).some(c => c.checked);

        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;

        updateBulkActions();
    });
});

// Clear selection
document.getElementById('clearSelection')?.addEventListener('click', function() {
    selectAllCheckbox.checked = false;
    propertyCheckboxes.forEach(cb => cb.checked = false);
    updateBulkActions();
});

// ---------------- Modal ----------------
const propertyModal = document.getElementById('modal');
const closeModal = document.getElementById('closeModal');

async function openModal(propertyId) {
    try {
        const response = await fetch(`/admin/properties/${propertyId}`);
        if (!response.ok) throw new Error('Failed to fetch property data');

        const property = await response.json();

        // Populate property info
        document.getElementById('modalTitle').textContent = property.title;
        document.getElementById('modalDescription').textContent = property.description || 'No description available';
        document.getElementById('modalLocation').textContent = property.location || 'N/A';
        document.getElementById('modalPrice').textContent = `${property.price.toLocaleString()} ETB`;
        document.getElementById('modalType').textContent = property.type;
        document.getElementById('modalStatus').textContent = property.status;

        // Agent info
        document.getElementById('modalAgent').textContent = property.agent.name;
        const agentImg = propertyModal.querySelector('.agent-image');
        if (agentImg) agentImg.src = property.agent.image;

        // Populate Keen slider dynamically
        const sliderContainer = document.getElementById('my-keen-slider');
        sliderContainer.innerHTML = ''; // Clear old slides

        property.images.forEach(imagePath => {
            const slide = document.createElement('div');
            slide.classList.add('keen-slider__slide', 'zoom-out__slide', 'w-full', 'h-64', 'rounded-lg', 'flex', 'items-center', 'justify-center');
            slide.innerHTML = `<div><img src="/storage/${imagePath}" alt="property image" class="rounded-lg object-cover w-full h-full"></div>`;
            sliderContainer.appendChild(slide);
        });

        // Initialize Keen Slider after content is added
        if (window.sliderInstance) window.sliderInstance.destroy();
        window.sliderInstance = new KeenSlider("#my-keen-slider", {
            loop: true,
            slides: { perView: 1 },
        });

        // Open modal
        propertyModal.classList.add('active');
    } catch (error) {
        console.error('Error loading property:', error);
        alert('Unable to load property data');
    }
}

function closeModalFunc() {
    propertyModal.classList.remove('active');
}

closeModal.addEventListener('click', closeModalFunc);
propertyModal.addEventListener('click', e => {
    if (e.target === propertyModal) closeModalFunc();
});

// ---------------- Property Actions ----------------
function viewData(id) {
    console.log('Viewing property:', id);
    openModal(id);
}

async function approve(id) {
    // if (!confirm('Are you sure you want to approve this property?')) return;

    // console.log(id);
    await fetch(`/admin/properties/${id}/approve`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: 'approved' })
    })
    .then(response => {
        if (!response.ok) throw new Error('Failed to approve property');
        return response.json();
    })
    .then(data => {
        alert('Property approved successfully!');
        // Update status in the table dynamically
        const row = document.querySelector(`[data-property-id="${id}"]`);
        if (row) {
            const statusBadge = row.querySelector('.status-badge');
            statusBadge.className = 'status-badge status-approved';
            statusBadge.textContent = 'Approved';
        }else{
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to approve property. Please try again.');
    });
}


function reject(id) {
    // if (!confirm('Are you sure you want to reject this property?')) return;

    fetch(`/admin/properties/${id}/reject`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: 'rejected' })
    })
    .then(response => {
        if (!response.ok) throw new Error('Failed to reject property');
        return response.json();
    })
    .then(data => {
        alert('Property rejected successfully!');
        // Update status in the table dynamically
        const row = document.querySelector(`[data-property-id="${id}"]`);
        if (row) {
            const statusBadge = row.querySelector('.status-badge');
            statusBadge.className = 'status-badge status-rejected';
            statusBadge.textContent = 'Rejected';
        }else{
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to reject property. Please try again.');
    });
}


function edit(id) {
    console.log('Editing property:', id);
    // alert('Edit property functionality would open here.');
}

function deleteAction(id) {
    if (!confirm('Are you sure you want to delete this property? This action cannot be undone.')) return;

    fetch(`/admin/properties/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Failed to delete property');
        return response.json();
    })
    .then(data => {
        alert('Property deleted successfully!');
        const row = document.querySelector(`[data-property-id="${id}"]`);
        if (row) row.remove();
        else window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to delete property. Please try again.');
    });
}


// ---------------- Bulk Actions ----------------
// Bulk Approve
document.getElementById('bulkApprove')?.addEventListener('click', async function() {
    const checkedBoxes = Array.from(document.querySelectorAll('.property-checkbox:checked'));
    if (checkedBoxes.length === 0) return;

    if (!confirm(`Approve ${checkedBoxes.length} selected properties?`)) return;

    for (let cb of checkedBoxes) {
        await approve(cb.value); // make approve async and return fetch promise
    }
    alert('Selected properties approved!');
});

// Bulk Reject
document.getElementById('bulkReject')?.addEventListener('click', async function() {
    const checkedBoxes = Array.from(document.querySelectorAll('.property-checkbox:checked'));
    if (checkedBoxes.length === 0) return;

    if (!confirm(`Reject ${checkedBoxes.length} selected properties?`)) return;

    for (let cb of checkedBoxes) {
        await reject(cb.value); // make reject async and return fetch promise
    }
    alert('Selected properties rejected!');
});

// Bulk Delete
document.getElementById('bulkDelete')?.addEventListener('click', async function() {
    const checkedBoxes = Array.from(document.querySelectorAll('.property-checkbox:checked'));
    if (checkedBoxes.length === 0) return;

    if (!confirm(`Delete ${checkedBoxes.length} selected properties? This action cannot be undone.`)) return;

    for (let cb of checkedBoxes) {
        await deleteAction(cb.value); // make deleteAction async and return fetch promise
    }
    alert('Selected properties deleted!');
});


// ---------------- Expose globally ----------------
window.viewData = viewData;
window.openModal = openModal;
window.approve = approve;
window.reject = reject;
window.edit = edit;
window.deleteAction = deleteAction;
