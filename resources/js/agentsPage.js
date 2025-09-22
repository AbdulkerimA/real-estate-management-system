 // Search functionality
//  alert('');
document.getElementById('join').addEventListener('click',function () {
    window.location = '/agent/register';
});
document.getElementById('agent-search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    console.log('Searching for:', searchTerm);
    // In a real application, this would filter the agents
});

// Filter functionality
document.querySelectorAll('select').forEach(select => {
    select.addEventListener('change', function() {
        console.log('Filter changed:', this.value);
        // In a real application, this would filter the agents
    });
});

// Agent profile buttons
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('View Profile')) {
        button.addEventListener('click', function() {
            const agentName = this.closest('.agent-card').querySelector('h3').textContent;
            alert(`Opening profile for: ${agentName}`);
        });
    }
});

// Phone number links
document.querySelectorAll('a[href^="tel:"]').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const phoneNumber = this.textContent.trim();
        alert(`Calling: ${phoneNumber}`);
    });
});

// CTA buttons
document.querySelector('button').addEventListener('click', function() {
    if (this.textContent.includes('Join as an Agent')) {
        alert('Redirecting to agent registration form...');
    }
});

// Pagination
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.match(/^\d+$/)) {
        button.addEventListener('click', function() {
            // Remove active class from all page buttons
            document.querySelectorAll('button').forEach(btn => {
                if (btn.textContent.match(/^\d+$/)) {
                    btn.className = 'px-4 py-2 bg-[#1c252e] rounded-lg hover:bg-gray-600 transition-colors';
                }
            });
            // Add active class to clicked button
            this.className = 'px-4 py-2 bg-[#00ff88] text-[#12181f] rounded-lg font-semibold';
        });
    }
});

// Social media links
document.querySelectorAll('footer a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        alert('Social media link clicked');
    });
});