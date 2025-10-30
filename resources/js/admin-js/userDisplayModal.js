// Modal functionality
const agentModal = document.getElementById('modal');
const closeModal = document.getElementById('closeModal');


async function openModal(agentId) {
    try {
        const response = await fetch(`/admin/agents/${agentId}`);
        if (!response.ok) throw new Error('Failed to fetch agent data');

        const agent = await response.json();

        // Populate modal fields
        document.getElementById('modalName').textContent = agent.name;
        document.getElementById('modalEmail').textContent = agent.email;
        document.getElementById('modalPhone').textContent = '+' + agent.phone;
        document.getElementById('modalLocation').textContent = agent.address || 'N/A';
        document.getElementById('modalStatus').textContent = agent.status || 'Pending';
        document.getElementById('modalExperience').textContent = `${agent.experience} years`;
        document.getElementById('modalBio').textContent = agent.bio || 'No bio available';
        document.getElementById('modalProperties').textContent = agent.properties || 0;

        // Update image
        const img = agentModal.querySelector('img');
        img.src = agent.image;
        img.alt = 'Profile of ' + agent.name;
        
        agentModal.classList.add('active');
    } catch (error) {
        console.error('Error loading agent:', error);
        alert('Unable to load agent data');
    }
}

function closeModalFunc() {
    agentModal.classList.remove('active');
}

closeModal.addEventListener('click', closeModalFunc);
agentModal.addEventListener('click', function(e) {
    if (e.target === agentModal) {
        closeModalFunc();
    }
});

window.openModal = openModal;