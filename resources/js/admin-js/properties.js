import KeenSlider from 'keen-slider';
import 'keen-slider/keen-slider.min.css';

// Create a new slider instance
document.addEventListener('DOMContentLoaded', () => {
    var slider = new KeenSlider("#my-keen-slider", {
        loop: true,
        detailsChanged: (s) => {
            const slides = s.track.details.slides
            s.slides.forEach((element, idx) => {
                scaleElement(element.querySelector("div"), slides[idx].portion)
            })
        },
        initial: 2,
    });

    function scaleElement(element, portion) {
        var scale_size = 0.7;
        var scale = 1 - (scale_size - scale_size * portion);
        var style = `scale(${scale})`;
        element.style.transform = style;
        element.style["-webkit-transform"] = style;
    }
});

// Checkbox functionality
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

selectAllCheckbox.addEventListener('change', function() {
    propertyCheckboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateBulkActions();
});

propertyCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allChecked = Array.from(propertyCheckboxes).every(cb => cb.checked);
        const someChecked = Array.from(propertyCheckboxes).some(cb => cb.checked);
        
        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
        
        updateBulkActions();
    });
});

// Clear selection
document.getElementById('clearSelection').addEventListener('click', function() {
    selectAllCheckbox.checked = false;
    propertyCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
});

// Modal functionality
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
            slide.innerHTML = `
                <div>
                    <img src="/storage/${imagePath}" alt="property image" class="rounded-lg object-cover w-full h-full">
                </div>
            `;
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
propertyModal.addEventListener('click', function(e) {
    if (e.target === propertyModal) {
        closeModalFunc();
    }
});

// Property action functions
function viewData(id) {
    console.log('Viewing property:', id);
    openModal(id);
}
function approve(id) {
    if (confirm('Are you sure you want to approve this property?')) {
        console.log('Approving property:', id);
        alert('Property approved successfully!');
        // Update status in the table
        const row = document.querySelector(`[data-property-id="${id}"]`);
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge status-approved';
        statusBadge.textContent = 'Approved';
    }
}

function reject(id) {
    if (confirm('Are you sure you want to reject this property?')) {
        console.log('Rejecting property:', id);
        alert('Property rejected successfully!');
        // Update status in the table
        const row = document.querySelector(`[data-property-id="${id}"]`);
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge status-rejected';
        statusBadge.textContent = 'Rejected';
    }
}

function edit(id) {
    console.log('Editing property:', id);
    alert('Edit property functionality would open here.');
}

function deleteAction(id) {
    if (confirm('Are you sure you want to delete this property? This action cannot be undone.')) {
        console.log('Deleting property:', id);
        alert('Property deleted successfully!');
        // Remove row from table
        const row = document.querySelector(`[data-property-id="${id}"]`);
        row.remove();
    }
}

// Bulk actions
document.getElementById('bulkApprove').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.property-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Approve ${checkedBoxes.length} selected properties?`)) {
        checkedBoxes.forEach(checkbox => {
            approve(checkbox.value);
        });
    }
});
// Modal actions
document.getElementById('modalApprove').addEventListener('click', function() {
    alert('Property approved from modal!');
    closeModalFunc();
});

document.getElementById('modalReject').addEventListener('click', function() {
    alert('Property rejected from modal!');
    closeModalFunc();
});

document.getElementById('bulkReject').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.property-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Reject ${checkedBoxes.length} selected properties?`)) {
        checkedBoxes.forEach(checkbox => {
            reject(checkbox.value);
        });
    }
});

document.getElementById('bulkDelete').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.property-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Delete ${checkedBoxes.length} selected properties? This action cannot be undone.`)) {
        checkedBoxes.forEach(checkbox => {
            deleteAction(checkbox.value);
        });
    }
});





// making globaly scoped
window.viewData = viewData;
window.approve = approve;
window.reject = reject;
window.edit = edit;
window.deleteAction = deleteAction;