/*************************
 * CHECKBOX FUNCTIONALITY
 *************************/
const selectAllCheckbox = document.getElementById('selectAll');
const agentCheckboxes = document.querySelectorAll('.agent-checkbox');
const bulkActions = document.getElementById('bulkActions');
const selectedCount = document.getElementById('selectedCount');

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
    const count = checkedBoxes.length;

    selectedCount.textContent = `${count} agents selected`;

    if (count > 0) {
        bulkActions.classList.add('active');
    } else {
        bulkActions.classList.remove('active');
    }
}

selectAllCheckbox?.addEventListener('change', function () {
    agentCheckboxes.forEach(cb => cb.checked = this.checked);
    updateBulkActions();
});

agentCheckboxes.forEach(cb => {
    cb.addEventListener('change', function () {
        const allChecked = [...agentCheckboxes].every(c => c.checked);
        const someChecked = [...agentCheckboxes].some(c => c.checked);

        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;

        updateBulkActions();
    });
});

// Clear selection
document.getElementById('clearSelection')?.addEventListener('click', () => {
    selectAllCheckbox.checked = false;
    selectAllCheckbox.indeterminate = false;
    agentCheckboxes.forEach(cb => cb.checked = false);
    updateBulkActions();
});

/********************
 * MODAL FUNCTIONALITY
 ********************/
const agentModal = document.getElementById('modal');
const closeModalBtn = document.getElementById('closeModal');

async function openModal(agentId) {
    try {
        const response = await fetch(`/admin/agents/${agentId}`);
        if (!response.ok) throw new Error('Failed to load agent');

        const agent = await response.json();

        document.getElementById('modalName').textContent = agent.name;
        document.getElementById('modalEmail').textContent = agent.email;
        document.getElementById('modalPhone').textContent = agent.phone ? `+${agent.phone}` : 'N/A';
        document.getElementById('modalLocation').textContent = agent.address ?? 'N/A';
        document.getElementById('modalStatus').textContent = agent.status ?? 'Pending';
        document.getElementById('modalExperience').textContent = `${agent.experience ?? 0} years`;
        document.getElementById('modalBio').textContent = agent.bio ?? 'No bio available';
        document.getElementById('modalProperties').textContent = agent.properties ?? 0;

        const img = agentModal.querySelector('img');
        if (img) {
            img.src = agent.image ?? '/images/default-avatar.png';
            img.alt = agent.name;
        }

        // Populate Recent Properties
        const recentPropertiesContainer = agentModal.querySelector('.dashboard-card .grid');
        recentPropertiesContainer.innerHTML = ''; // clear previous content

        console.log(Object.values(agent.recentProperties));
        // return
        Object.values(agent.recentProperties).forEach(property => {
            
            const div = document.createElement('div');
            div.className = 'property-card';
            div.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <img src="${property.propertyImage}" alt="${property.title}" class='w-full h-full object-cover rounded-lg'  />
                    </div>
                    <div class="flex-1">
                        <p class="text-white font-medium text-sm">${property.title}</p>
                        <p class="text-gray-400 text-xs">${property.location}</p>
                        <p class="text-[#00ff88] font-semibold text-sm">ETB ${property.price}</p>
                    </div>
                </div>
            `;
            recentPropertiesContainer.appendChild(div);
        });

        // recent reviews
        const reviewsContainer = document.querySelector('#modal .recent-reviews-container');
        reviewsContainer.innerHTML = ''; // clear old reviews

        agent.recentReviews.forEach(review => {
            const reviewerAvatar = review.reviewer_avatar 
                ? `<img src="${review.reviewer_avatar}" alt="${review.reviewer_name}" class="w-8 h-8 rounded-full"/>`
                : `<div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white text-xs">${review.reviewer_name[0]}</div>`;

            const reviewHtml = `
                <div class="border-b border-gray-600 pb-3">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            ${reviewerAvatar}
                            <span class="text-white font-medium text-sm">${review.reviewer_name}</span>
                        </div>
                        <div class="rating-stars text-amber-300">
                            ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm">${review.comment}</p>
                </div>
            `;
            reviewsContainer.insertAdjacentHTML('beforeend', reviewHtml);
        });

        updateRatingSection(agent.ratings);

        agentModal.classList.add('active');
    } catch (err) {
        console.error(err);
        alert('Unable to load agent details');
    }
}

function updateRatingSection(ratings) {
    const ratingStarsContainer = document.querySelector('.rating-stars');
    const ratingText = ratingStarsContainer.nextElementSibling;

    if (!ratings || ratings.length === 0) {
        ratingStarsContainer.innerHTML = '★★★★★'; // default 5 stars
        ratingText.textContent = 'No reviews yet';
        return;
    }

    // Calculate average rating
    const totalRating = ratings.reduce((sum, r) => sum + r.rating, 0);
    const avgRating = totalRating / ratings.length;

    // Fill stars
    const fullStars = Math.floor(avgRating);
    const halfStar = avgRating % 1 >= 0.5 ? 1 : 0;
    const emptyStars = 5 - fullStars - halfStar;

    let starsHtml = '';
    for (let i = 0; i < fullStars; i++) starsHtml += '★';
    if (halfStar) starsHtml += '☆'; // can be used as half star
    for (let i = 0; i < emptyStars; i++) starsHtml += '☆';

    ratingStarsContainer.innerHTML = starsHtml;

    // Text: average rating + total reviews
    ratingText.textContent = `${avgRating.toFixed(1)} (${ratings.length} reviews)`;
}



function closeModalFunc() {
    agentModal.classList.remove('active');
}

closeModalBtn?.addEventListener('click', closeModalFunc);
agentModal?.addEventListener('click', e => {
    if (e.target === agentModal) closeModalFunc();
});

/********************
 * AGENT ACTIONS
 ********************/
function viewAgent(id) {
    openModal(id);
}

async function verifyAgent(agentId) {
    console.log(agentId);
    try {
        const response = await fetch(`/admin/agents/${agentId}/verify`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf(), 
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error('Verification failed');
        }

        const data = await response.json();

        // console.log(data.POST);
        // return
        showToast(data.message, 'success');

        // Update UI
        const row = document.querySelector(`[data-agent-id="${agentId}"]`);

        if (!row) {
            console.error('Row not found for agent:', agentId);
            showToast('UI update failed (row not found)', 'error');
            return;
        }


    } catch (error) {
        showToast('Verification failed', 'error');
        console.error(error);
    }
}



async function suspendAgent(agentId) {
    // if (!confirm('Suspend this agent?')) return;

    try {
        const response = await fetch(`/admin/agents/${agentId}/suspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json',
            },
        });

        const data = await response.json();
        if (!response.ok) throw data;

        showToast(data.message, 'success');

        const row = document.querySelector(`[data-agent-id="${agentId}"]`);
        if (!row) return;

        const badge = row.querySelector('.status-badge');
        badge.className = `status-badge status-${data.status}`;
        badge.textContent = data.status;

    } catch (error) {
        console.error(error);
        showToast(error.message || 'Suspension failed', 'error');
    }
}


async function deleteAgent(id) {
    if (!confirm('Delete this agent? This cannot be undone.')) return;

    try {
        const response = await fetch(`/admin/agents/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrf(),
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            console.log(response.message)
            throw new Error('Failed to delete agent');
        }

        // Remove row from table
        const row = document.querySelector(`[data-agent-id="${id}"]`);
        row?.remove();

        showToast('Agent deleted successfully', 'success');

    } catch (error) {
        console.error(error);
        showToast('Failed to delete agent', 'error');
    }
}


/********************
 * BULK ACTIONS
 ********************/
document.getElementById('bulkVerify')?.addEventListener('click', () => {
    const checked = document.querySelectorAll('.agent-checkbox:checked');
    if (checked.length && confirm(`Verify ${checked.length} agents?`)) {
        checked.forEach(cb => verifyAgent(cb.value));
    }
});

document.getElementById('bulkSuspend')?.addEventListener('click', () => {
    const checked = document.querySelectorAll('.agent-checkbox:checked');
    if (checked.length && confirm(`Suspend ${checked.length} agents?`)) {
        checked.forEach(cb => suspendAgent(cb.value));
    }
});

document.getElementById('bulkDelete')?.addEventListener('click', () => {
    const checked = document.querySelectorAll('.agent-checkbox:checked');
    if (checked.length && confirm(`Delete ${checked.length} agents?`)) {
        checked.forEach(cb => deleteAgent(cb.value));
    }
});

/********************
 * MODAL BUTTONS
 ********************/
document.getElementById('modalVerify')?.addEventListener('click', () => {
    alert('Agent verified from modal');
    closeModalFunc();
});

document.getElementById('modalSuspend')?.addEventListener('click', () => {
    alert('Agent suspended from modal');
    closeModalFunc();
});

function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');

    toast.className = `toast ${type}`;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}

function csrf() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}


/********************
 * EXPOSE FUNCTIONS
 ********************/
window.showToast = showToast;
window.viewAgent = viewAgent;
window.verifyAgent = verifyAgent;
window.suspendAgent = suspendAgent;
window.deleteAgent = deleteAgent;
