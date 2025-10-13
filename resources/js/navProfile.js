const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown'); 

profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('hidden');
});

// Close dropdowns when clicking outside
document.addEventListener('click', () => {
    profileDropdown.classList.add('hidden');
});