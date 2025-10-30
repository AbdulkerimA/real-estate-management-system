// Checkbox functionality
const selectAllCheckbox = document.getElementById('selectAll');
const agentCheckboxes = document.querySelectorAll('.agent-checkbox');
const bulkActions = document.getElementById('bulkActions');
const selectedCount = document.getElementById('selectedCount');

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
    const count = checkedBoxes.length;
    
    if (count > 0) {
        bulkActions.classList.add('active');
        selectedCount.textContent = `${count} agents selected`;
    } else {
        selectedCount.textContent = `${count} agents selected`;
        bulkActions.classList.remove('active');
    }
}

selectAllCheckbox.addEventListener('change', function() {
    agentCheckboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateBulkActions();
});

agentCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allChecked = Array.from(agentCheckboxes).every(cb => cb.checked);
        const someChecked = Array.from(agentCheckboxes).some(cb => cb.checked);
        
        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
        
        updateBulkActions();
    });
});
// Clear selection
document.getElementById('clearSelection').addEventListener('click', function() {
    selectAllCheckbox.checked = false;
    agentCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
});
// // Modal functionality
// const agentModal = document.getElementById('modal');
// const closeModal = document.getElementById('closeModal');


// async function openModal(agentId) {
//     try {
//         const response = await fetch(`/admin/agents/${agentId}`);
//         if (!response.ok) throw new Error('Failed to fetch agent data');

//         const agent = await response.json();

//         // Populate modal fields
//         document.getElementById('modalName').textContent = agent.name;
//         document.getElementById('modalEmail').textContent = agent.email;
//         document.getElementById('modalPhone').textContent = '+' + agent.phone;
//         document.getElementById('modalLocation').textContent = agent.address || 'N/A';
//         document.getElementById('modalStatus').textContent = agent.status || 'Pending';
//         document.getElementById('modalExperience').textContent = `${agent.experience} years`;
//         document.getElementById('modalBio').textContent = agent.bio || 'No bio available';
//         document.getElementById('modalProperties').textContent = agent.properties || 0;

//         // Update image
//         const img = agentModal.querySelector('img');
//         img.src = agent.image;
//         img.alt = 'Profile of ' + agent.name;
        
//         agentModal.classList.add('active');
//     } catch (error) {
//         console.error('Error loading agent:', error);
//         alert('Unable to load agent data');
//     }
// }

// function closeModalFunc() {
//     agentModal.classList.remove('active');
// }

// closeModal.addEventListener('click', closeModalFunc);
// agentModal.addEventListener('click', function(e) {
//     if (e.target === agentModal) {
//         closeModalFunc();
//     }
// });

// Agent action functions
function viewAgent(id) {
    console.log('Viewing agent:', id);
    openModal(id);
}

function verifyAgent(id) {
    if (confirm('Are you sure you want to verify this agent?')) {
        console.log('Verifying agent:', id);
        alert('Agent verified successfully!');
        // Update status in the table
        const row = document.querySelector(`[data-agent-id="${id}"]`);
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge status-verified';
        statusBadge.textContent = 'Verified';
    }
}

function suspendAgent(id) {
    if (confirm('Are you sure you want to suspend this agent?')) {
        console.log('Suspending agent:', id);
        alert('Agent suspended successfully!');
        // Update status in the table
        const row = document.querySelector(`[data-agent-id="${id}"]`);
        const statusBadge = row.querySelector('.status-badge');
        statusBadge.className = 'status-badge status-suspended';
        statusBadge.textContent = 'Suspended';
    }
}

function deleteAgent(id) {
    if (confirm('Are you sure you want to delete this agent? This action cannot be undone.')) {
        console.log('Deleting agent:', id);
        alert('Agent deleted successfully!');
        // Remove row from table
        const row = document.querySelector(`[data-agent-id="${id}"]`);
        row.remove();
    }
}

// Bulk actions
document.getElementById('bulkVerify').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Verify ${checkedBoxes.length} selected agents?`)) {
        checkedBoxes.forEach(checkbox => {
            verifyAgent(checkbox.value);
        });
    }
});

document.getElementById('bulkSuspend').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Suspend ${checkedBoxes.length} selected agents?`)) {
        checkedBoxes.forEach(checkbox => {
            suspendAgent(checkbox.value);
        });
    }
});

document.getElementById('bulkDelete').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.agent-checkbox:checked');
    if (checkedBoxes.length > 0 && confirm(`Delete ${checkedBoxes.length} selected agents? This action cannot be undone.`)) {
        checkedBoxes.forEach(checkbox => {
            deleteAgent(checkbox.value);
        });
    }
});

// Add new agent
// document.getElementById('addAgentBtn').addEventListener('click', function() {
//     alert('Add new agent form would open here.');
// });
    // Modal actions
document.getElementById('modalVerify').addEventListener('click', function() {
    alert('Agent verified from modal!');
    closeModalFunc();
});

document.getElementById('modalSuspend').addEventListener('click', function() {
    alert('Agent suspended from modal!');
    closeModalFunc();
});


window.viewAgent = viewAgent;
window.verifyAgent = verifyAgent;
window.deleteAgent = deleteAgent;
window.suspendAgent = suspendAgent;