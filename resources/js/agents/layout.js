
// Mobile menu toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

mobileMenuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('open');
    sidebarOverlay.classList.toggle('active');
});

sidebarOverlay.addEventListener('click', () => {
    sidebar.classList.remove('open');
    sidebarOverlay.classList.remove('active');
});

// Dropdown toggles
// const notificationBtn = document.getElementById('notificationBtn');
// const notificationDropdown = document.getElementById('notificationDropdown');
const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown'); 

// notificationBtn.addEventListener('click', (e) => {
//     e.stopPropagation();
//     notificationDropdown.classList.toggle('hidden');
//     profileDropdown.classList.add('hidden');
// });

profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('hidden');
    // notificationDropdown.classList.add('hidden');
});

// Close dropdowns when clicking outside
document.addEventListener('click', () => {
    // notificationDropdown.classList.add('hidden');
    profileDropdown.classList.add('hidden');
});

// Sidebar navigation
document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Get the page name
        const pageName = this.textContent.trim();
        
        if (pageName === 'Logout') {
            alert('Logging out...');
        } else {
            // alert(`Navigating to: ${pageName}`);

            if (pageName === 'My Properties') {
                window.location = '/dashboard/properties';
            } else if (pageName === 'Dashboard') {
                window.location = '/dashboard/';
            } else {
                window.location = `/dashboard/${pageName.replace(/\s+/g, '-').toLowerCase()}`;
            }
        }
    });
});



// Property actions
// remove me
document.querySelectorAll('table button').forEach(button => {
    button.addEventListener('click', function() {
        const action = this.textContent;
        const row = this.closest('tr');
        const propertyName = row.querySelector('p.font-semibold').textContent;
        
        alert(`${action} action for: ${propertyName}`);
    });
});

// Appointment contact buttons
document.querySelectorAll('.content-card button svg').forEach(button => {
    button.parentElement.addEventListener('click', function(e) {
        e.stopPropagation();
        const appointmentCard = this.closest('.flex');
        // const clientName = appointmentCard.querySelector('.font-semibold').textContent;
        const phoneNumber = appointmentCard.querySelector('.text-gray-400').textContent;
        window.location.href = `tel:${phoneNumber}`;
    });
});

// Appointment card clicks
document.querySelectorAll('.content-card .cursor-pointer').forEach(card => {
    card.addEventListener('click', function() {
        const clientName = this.querySelector('.font-semibold').textContent;
        const property = this.querySelector('.text-gray-400').textContent;
        alert(`Opening appointment details for ${clientName} - ${property}`);
    });
});

// Message interactions
document.querySelectorAll('.content-card .bg-dark-secondary').forEach(messageCard => {
    messageCard.addEventListener('click', function() {
        const senderName = this.querySelector('.font-semibold').textContent;
        alert(`Opening conversation with ${senderName}...`);
    });
});

// View All buttons
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('View All')) {
        button.addEventListener('click', function() {
            const section = this.textContent.replace('View All ', '');
            const page = section.trim().toLowerCase();

            window.location = page;
            // alert(`Opening ${section} page...`);
        });
    }
});

// Add Property button
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('Add Property')) {
        button.addEventListener('click', function() {
            alert('Opening Add Property form...');
            window.location = '/dashboard/property/create';
        });
    }
});

// Search functionality
const searchInput = document.querySelector('input[placeholder*="Search"]');
searchInput.addEventListener('input', function() {
    if (this.value.length > 2) {
        console.log(`Searching for: ${this.value}`);
    }
});

// Initialize Chart
// console.log(monthlyEarnings);
let monthlyEarnings = []; // fix this 
const earned = monthlyEarnings?monthlyEarnings.map(item=>item.earned):[];
const months = monthlyEarnings?monthlyEarnings.map(item=>item.month_name):[];

const earningsChartElem = document.getElementById('dashboardChart');
if (earningsChartElem) {
    const ctx = earningsChartElem.getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Monthly Earnings (ETB)',
                data: earned,
                borderColor: '#00ff88',
                backgroundColor: 'rgba(0, 255, 136, 0.1)',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#00ff88',
                pointBorderColor: '#1c252e',
                pointBorderWidth: 3,
                pointRadius: 8,
                pointHoverRadius: 10,
                pointHoverBackgroundColor: '#00ff88',
                pointHoverBorderColor: '#1c252e',
                pointHoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(28, 37, 46, 0.95)',
                    titleColor: '#00ff88',
                    bodyColor: '#ffffff',
                    borderColor: '#00ff88',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Earnings: ETB ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        callback: function(value) {
                            return 'ETB ' + (value / 1000) + 'K';
                        }
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#00ff88'
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

// Stat card hover effects
document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// property related script

// Filter functionality
const statusFilter = document.getElementById('apStatusFilter');
const typeFilter = document.getElementById('typeFilter');
const propertySearch = document.getElementById('propertySearch');

function filterProperties() {
    const statusValue = statusFilter.value;
    const typeValue = typeFilter.value;
    const searchValue = propertySearch.value.toLowerCase();

    // Filter table rows
    const tableRows = document.querySelectorAll('#propertiesTableBody tr');
    tableRows.forEach(row => {
        const status = row.getAttribute('data-status');
        const type = row.getAttribute('data-type');
        const title = row.querySelector('.font-semibold').textContent.toLowerCase();
        
        const statusMatch = statusValue === 'all' || status === statusValue;
        const typeMatch = typeValue === 'all' || type === typeValue;
        const searchMatch = searchValue === '' || title.includes(searchValue);
        
        if (statusMatch && typeMatch && searchMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Filter cards
    const cards = document.querySelectorAll('#cardView .property-card');
    cards.forEach(card => {
        const status = card.getAttribute('data-status');
        const type = card.getAttribute('data-type');
        const title = card.querySelector('h3').textContent.toLowerCase();
        
        const statusMatch = statusValue === 'all' || status === statusValue;
        const typeMatch = typeValue === 'all' || type === typeValue;
        const searchMatch = searchValue === '' || title.includes(searchValue);
        
        if (statusMatch && typeMatch && searchMatch) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

statusFilter?statusFilter.addEventListener('change', filterProperties):'';
typeFilter?typeFilter.addEventListener('change', filterProperties):'';
propertySearch?propertySearch.addEventListener('input', filterProperties):'';

// Property actions
document.querySelectorAll('.property-action').forEach(button => {
    button.addEventListener('click', function() {
        const action = this.getAttribute('data-action');
        const propertyCard = this.closest('tr, .property-card');
        const propertyName = propertyCard.querySelector('.font-semibold, h3').textContent;
        const propertyId = propertyCard.querySelector('.pid').textContent;
        
        switch(action) {
            case 'view':
                alert(`Viewing details for: ${propertyId}`);
                break;
            case 'edit':
                alert(`Opening edit form for: ${propertyId}`);
                break;
            case 'delete':
                if (confirm(`Are you sure you want to delete: ${propertyName}?`)) {
                    alert(`Property deleted: ${propertyId}`);
                    // In a real app, you would remove the element and update the backend
                }
                break;
        }
    });
});

// // Add Property button
// document.getElementById('addPropertyBtn').addEventListener('click', function() {
//     alert('Opening Add New Property form...');
// });

// Pagination
// document.querySelectorAll('.pagination-btn').forEach(button => {
//     button.addEventListener('click', function() {
//         if (this.textContent === 'Previous' || this.textContent === 'Next') {
//             alert(`${this.textContent} page`);
//         } else if (!isNaN(this.textContent)) {
//             // Remove active from all page buttons
//             document.querySelectorAll('.pagination-btn').forEach(btn => {
//                 if (!isNaN(btn.textContent)) {
//                     btn.classList.remove('active');
//                 }
//             });
//             // Add active to clicked page
//             this.classList.add('active');
//             alert(`Loading page ${this.textContent}`);
//         }
//     });
// });

// Search functionality
const tableSearchInput = document.querySelector('input[placeholder*="Search properties"]');
tableSearchInput?tableSearchInput.addEventListener('input', function() {
    if (this.value.length > 2) {
        console.log(`Searching for: ${this.value}`);
    }
}):"";

// Property card hover effects
document.querySelectorAll('.property-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});


// add properties form scripts
let uploadedImages = [];
let mainImageIndex = 0;

// Image upload functionality
const uploadArea = document.getElementById('uploadArea');
const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');

// Drag and drop functionality
uploadArea?uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
}):"";

uploadArea?uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
}):'';

uploadArea?uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    const files = Array.from(e.dataTransfer.files);
    handleImageUpload(files);
}):'';

imageInput?imageInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    handleImageUpload(files);
}):'';

function handleImageUpload(files) {
    files.forEach(file => {
        if (file.type.startsWith('image/') && file.size <= 5 * 1024 * 1024) {
            const reader = new FileReader();
            reader.onload = (e) => {
                uploadedImages.push({
                    file: file,
                    url: e.target.result,
                    name: file.name
                });
                updateImagePreview();
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please upload valid image files under 5MB.');
        }
    });
}

function updateImagePreview() {
    if (uploadedImages.length === 0) {
        imagePreview.classList.add('hidden');
        return;
    }

    imagePreview.classList.remove('hidden');
    imagePreview.innerHTML = uploadedImages.map((img, index) => `
        <div class="image-preview">
            <img src="${img.url}" alt="${img.name}">
            <button class="remove-btn" onclick="removeImage(${index})">×</button>
            ${index === mainImageIndex ? '<div class="main-badge">Main</div>' : ''}
            <button class="absolute bottom-2 right-2 bg-[#1c252e]/80 text-white text-xs px-2 py-1 rounded" onclick="setMainImage(${index})">
                Set Main
            </button>
        </div>
    `).join('');
}

function removeImage(index) {
    uploadedImages.splice(index, 1);
    if (mainImageIndex >= uploadedImages.length) {
        mainImageIndex = Math.max(0, uploadedImages.length - 1);
    }
    updateImagePreview();
}

function setMainImage(index) {
    mainImageIndex = index;
    updateImagePreview();
}

// Checkbox functionality
document.querySelectorAll('.checkbox-item').forEach(item => {
    item.addEventListener('click', function() {
        const checkbox = this.querySelector('input[type="checkbox"]');
        const icon = this.querySelector('.checkbox-icon');
        
        checkbox.checked = !checkbox.checked;
        
        if (checkbox.checked) {
            icon.style.background = '#00ff88';
            icon.style.color = '#1c252e';
        } else {
            icon.style.background = '#4b5563';
            icon.style.color = '#ffffff';
        }
    });
});

// Form submission
let propertyForm = document.getElementById('propertyForm');
propertyForm?propertyForm.addEventListener('submit', function(e) {
    // e.preventDefault();
    
    // Validate required fields
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            e.preventDefault();
            field.classList.add('error');
            isValid = false;
        } else {
            field.classList.remove('error');
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
        return;
    }

    // Show success modal
    // document.getElementById('successModal').classList.remove('hidden');
}):'';

// Modal functions
function viewProperty() {
    // document.getElementById('successModal').classList.add('hidden');
    alert('Redirecting to property view...');
    window.location = "/dashboard/properties";
}

function addAnother() {
    document.getElementById('successModal').classList.add('hidden');
    document.getElementById('propertyForm').reset();
    uploadedImages = [];
    mainImageIndex = 0;
    updateImagePreview();
    updateProgress();
    window.scrollTo(0, 0);
}

function cancelForm() {
    if (confirm('Are you sure you want to cancel? All entered data will be lost.')) {
        window.history.back();
    }
}

function openMapPicker() {
    alert('Map picker would open here to select precise location coordinates.');
}

// Form validation
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.hasAttribute('required') && this.value.trim() === '') {
            this.classList.add('error');
        } else {
            this.classList.remove('error');
        }
    });

    input.addEventListener('focus', function() {
        this.classList.remove('error');
    });
});

// Sidebar navigation
document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        const pageName = this.textContent.trim();
        
        if (pageName !== 'My Properties') {
            // alert(`Navigating to: ${pageName}`);
        }
    });
});

// Auto-save draft functionality (optional)
let autoSaveTimer;
propertyForm?propertyForm.addEventListener('input', function() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        console.log('Auto-saving draft...');
        // Here you would typically save to localStorage or send to server
    }, 2000);
}) : ""; 


// appointments page script
// Filter functionality
const appointmentStatusFilter = document.getElementById('apstatusFilter');
const appointmentSearch = document.getElementById('appointmentSearch');
const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');

function filterAppointments() {
    const statusValue = statusFilter.value;
    const searchValue = appointmentSearch.value.toLowerCase();

    const tableRows = document.querySelectorAll('#appointmentsTableBody tr');
    let visibleCount = 0;

    tableRows.forEach(row => {
        const status = row.getAttribute('data-status');
        const clientName = row.querySelector('.font-semibold').textContent.toLowerCase();
        const propertyName = row.querySelectorAll('.font-semibold')[1].textContent.toLowerCase();
        
        const statusMatch = statusValue === 'all' || status === statusValue;
        const searchMatch = searchValue === '' || 
            clientName.includes(searchValue) || 
            propertyName.includes(searchValue);
        
        if (statusMatch && searchMatch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update count display
    const countDisplay = document.querySelector('.text-sm.text-gray-400');
    countDisplay.textContent = `Showing ${visibleCount} appointments`;
}

statusFilter?statusFilter.addEventListener('change', filterAppointments):'';
appointmentSearch?appointmentSearch.addEventListener('input', filterAppointments):'';
startDate?startDate.addEventListener('change', filterAppointments):'';
endDate?endDate.addEventListener('change', filterAppointments):'';

// Appointment actions
document.querySelectorAll('.appointment-action').forEach(button => {
    button.addEventListener('click', function() {
        const action = this.getAttribute('data-action');
        const row = this.closest('tr');
        const clientName = row.querySelector('.font-semibold').textContent;
        const propertyName = row.querySelectorAll('.font-semibold')[1].textContent;
        const appointmentId = row.querySelector('.apid').textContent.trim();
        
        switch(action) {
            case 'view':
                // window.location = `/dashboard/appointment/${appointmentId}`
                break;
            case 'confirm':
                if (confirm(`Confirm appointment with ${clientName} for ${propertyName}?`)) {
                    alert('Appointment confirmed! Client will be notified.');
                    // Update status to scheduled
                    const statusBadge = row.querySelector('[class*="status-"]');
                    statusBadge.className = 'status-scheduled px-4 py-2 rounded-full text-sm font-semibold';
                    statusBadge.textContent = 'Scheduled';
                    row.setAttribute('data-status', 'scheduled');
                }
                break;
            case 'cancel':
                if (confirm(`Cancel appointment with ${clientName} for ${propertyName}?`)) {
                    alert('Appointment canceled. Client will be notified.');
                    // Update status to canceled
                    const statusBadge = row.querySelector('[class*="status-"]');
                    statusBadge.className = 'status-canceled px-4 py-2 rounded-full text-sm font-semibold';
                    statusBadge.textContent = 'Canceled';
                    row.setAttribute('data-status', 'canceled');
                    
                    // Update action buttons
                    const actionsCell = this.closest('td');
                    actionsCell.innerHTML = `
                        <div class="flex space-x-3">
                            <button class="text-blue-400 hover:text-blue-300 font-medium appointment-action" data-action="view">View</button>
                            <button class="text-gray-500 font-medium cursor-not-allowed">Canceled</button>
                        </div>
                    `;
                }
                break;
        }
    });
});

// Calendar functionality
document.querySelectorAll('.calendar-day').forEach(day => {
    day.addEventListener('click', function() {
        if (this.classList.contains('has-appointment')) {
            const dayNumber = this.textContent;
            alert(`Viewing appointments for December ${dayNumber}, 2024`);
        }
    });
});

// Sidebar navigation
document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Get the page name
        const pageName = this.textContent.trim();
        
        if (pageName === 'Logout') {
            alert('Logging out...');
        } else if (pageName !== 'Appointments') {
            // alert(`Navigating to: ${pageName}`);
        }
    });
});

// Search functionality
const appointmentSearchInput = document.querySelector('input[placeholder*="Search appointments"]');
appointmentSearchInput?appointmentSearchInput.addEventListener('input', function() {
    if (this.value.length > 2) {
        console.log(`Searching for: ${this.value}`);
    }
}):'';

// Upcoming appointments interactions
document.querySelectorAll('.appointment-card button').forEach(button => {
    button.addEventListener('click', function() {
        const card = this.closest('.appointment-card');
        const propertyName = card.querySelector('.font-semibold').textContent;
        const clientName = card.querySelector('.text-gray-400').textContent.replace('Client: ', '');
        
        if (this.textContent === 'View Details') {
            alert(`Viewing details for appointment:\nClient: ${clientName}\nProperty: ${propertyName}`);
        } else if (this.textContent === 'Confirm') {
            if (confirm(`Confirm appointment with ${clientName}?`)) {
                alert('Appointment confirmed!');
                // Update status
                const statusBadge = card.querySelector('[class*="status-"]');
                statusBadge.className = 'status-scheduled px-3 py-1 rounded-full text-xs font-semibold';
                statusBadge.textContent = 'Scheduled';
                this.textContent = 'View Details';
                this.className = 'text-[#12181f] hover:text-green-400 font-medium';
            }
        }
    });
});

// Auto-update countdown timers (simulation)
function updateCountdowns() {
    const countdownElements = document.querySelectorAll('.countdown-timer');
    countdownElements.forEach(element => {
        // This is a simulation - in a real app, you'd calculate actual time differences
        if (element.textContent === 'In 2 hours') {
            // Simulate countdown
            setTimeout(() => {
                element.textContent = 'In 1 hour 59 min';
            }, 60000); // Update after 1 minute
        }
    });
}

// Initialize countdown updates
updateCountdowns();

// Set default dates for date inputs
const today = new Date();
const nextWeek = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000);

startDate ? startDate.value = today.toISOString().split('T')[0] : '';
endDate ? endDate.value = nextWeek.toISOString().split('T')[0] : '';


// earnings page script
// Counter animation
function earningsAnimateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = `ETB ${Math.floor(current).toLocaleString()}`;
    }, 16);
}

// Progress bar animation
function animateProgressBar(element, targetWidth) {
    setTimeout(() => {
        element.style.width = targetWidth;
    }, 500);
}

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate counters
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        earningsAnimateCounter(counter, target);
    });

    // Animate progress bars
    document.querySelectorAll('.progress-bar').forEach(bar => {
        const targetWidth = bar.getAttribute('data-width');
        animateProgressBar(bar, targetWidth);
    });
});

// Earnings Chart
// Date range filter
document.querySelectorAll('.filter-button').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.filter-button').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.add('bg-gray-600', 'text-gray-300');
        });
        
        // Add active class to clicked button
        this.classList.add('active');
        this.classList.remove('bg-gray-600', 'text-gray-300');
        
        const range = this.getAttribute('data-range');
        console.log(`Filtering by: ${range}`);
        
        // Update chart data based on range
        if (range === 'today') {
            earningsChart.data.labels = ['9 AM', '12 PM', '3 PM', '6 PM', '9 PM'];
            earningsChart.data.datasets[0].data = [15000, 25000, 18000, 32000, 28000];
        } else if (range === 'month') {
            earningsChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            earningsChart.data.datasets[0].data = [125000, 180000, 220000, 195000];
        } else {
            // Custom range - show date picker
            alert('Custom date range picker would open here');
        }
        
        earningsChart.update();
    });
});

// Transaction search
const transactionSearch = document.getElementById('transactionSearch');
const earningsStatusFilter = document.getElementById('statusFilter');
const transactionRows = document.querySelectorAll('.transaction-row');

function filterTransactions() {
    const searchTerm = transactionSearch.value.toLowerCase();
    const statusValue = earningsStatusFilter.value;
    
    transactionRows.forEach(row => {
        const property = row.cells[1].textContent.toLowerCase();
        const buyer = row.cells[2].textContent.toLowerCase();
        const amount = row.cells[3].textContent.toLowerCase();
        const status = row.getAttribute('data-status');
        
        const matchesSearch = property.includes(searchTerm) || 
                            buyer.includes(searchTerm) || 
                            amount.includes(searchTerm);
        const matchesStatus = statusValue === 'all' || status === statusValue;
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

transactionSearch ? transactionSearch.addEventListener('input', filterTransactions) : '';
earningsStatusFilter ? earningsStatusFilter.addEventListener('change', filterTransactions) : '';

// Pagination
document.querySelectorAll('.pagination-button').forEach(button => {
    button.addEventListener('click', function() {
        if (this.textContent === 'Previous' || this.textContent === 'Next') {
            console.log(`${this.textContent} page`);
        } else {
            // Remove active class from all page buttons
            document.querySelectorAll('.pagination-button').forEach(btn => {
                if (!isNaN(btn.textContent)) {
                    btn.classList.remove('active');
                    btn.classList.add('bg-gray-600', 'text-gray-300');
                }
            });
            
            // Add active class to clicked page
            this.classList.add('active');
            this.classList.remove('bg-gray-600', 'text-gray-300');
            
            console.log(`Page ${this.textContent}`);
        }
    });
});

// Request payout
// const requestPayoutBtn = document.getElementById('requestPayoutBtn');
// requestPayoutBtn ? requestPayoutBtn.addEventListener('click', function() {
//     // if (confirm('Request payout of ETB 485,000? This will be processed within 2-3 business days.')) {
//     //     alert('Payout request submitted successfully! You will receive a confirmation email shortly.');
//     // }
//     checkOutModal.classList.add('active');
// }):'';


// profile page script
// Counter animation
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 16);
}

// Initialize counter animations
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        animateCounter(counter, target);
    });
});

// Profile photo upload
// const profilePhoto = document.getElementById('profilePhoto');
// const photoInput = document.getElementById('photoInput');
// const profileImage = document.getElementById('profileImage');

// profilePhoto?profilePhoto.addEventListener('click', () => {
//     photoInput.click();
// }):'';

// photoInput ? photoInput.addEventListener('change', function(e) {
//     const file = e.target.files[0];
//     if (file) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             profileImage.src = e.target.result;
//             profileImage.classList.remove('hidden');
//         };
//         reader.readAsDataURL(file);
//     }
// }) : '';

// // Form validation
// function validateEmail(email) {
//     const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return re.test(email);
// }

// function validatePhone(phone) {
//     const re = /^[\+]?[1-9][\d]{0,15}$/;
//     return re.test(phone.replace(/\s/g, ''));
// }

// // Personal form validation
// const personalForm = document.getElementById('personalForm');
// const fullNameInput = document.getElementById('fullName');
// const emailInput = document.getElementById('email');
// const phoneInput = document.getElementById('phone');

// function validatePersonalForm() {
//     let isValid = true;

//     if(fullNameInput){
//         // Full name validation
//         if (fullNameInput.value.trim().length < 2) {
//             fullNameInput.classList.add('error');
//             document.getElementById('fullNameError').classList.remove('hidden');
//             isValid = false;
//         } else {
//             fullNameInput.classList.remove('error');
//             fullNameInput.classList.add('success');
//             document.getElementById('fullNameError').classList.add('hidden');
//         }
//     }

//     if(emailInput){
//         // Email validation
//         if (!validateEmail(emailInput.value)) {
//             emailInput.classList.add('error');
//             document.getElementById('emailError').classList.remove('hidden');
//             isValid = false;
//         } else {
//             emailInput.classList.remove('error');
//             emailInput.classList.add('success');
//             document.getElementById('emailError').classList.add('hidden');
//         }
//     }

//     if(phoneInput){
//         // Phone validation
//         if (!validatePhone(phoneInput.value)) {
//             phoneInput.classList.add('error');
//             document.getElementById('phoneError').classList.remove('hidden');
//             isValid = false;
//         } else {
//             phoneInput.classList.remove('error');
//             phoneInput.classList.add('success');
//             document.getElementById('phoneError').classList.add('hidden');
//         }
//     }

//     return isValid;
// }

// personalForm ? personalForm.addEventListener('submit', function(e) {
//     // e.preventDefault();
//     if (validatePersonalForm()) {
//         // Simulate saving
//         const button = this.querySelector('button[type="submit"]');
//         button.disabled = true;
//         button.textContent = 'Saving...';
        
//         setTimeout(() => {
//             button.disabled = false;
//             button.textContent = 'Save Personal Information';
//             document.getElementById('personalSuccess').classList.remove('hidden');
//             setTimeout(() => {
//                 document.getElementById('personalSuccess').classList.add('hidden');
//             }, 3000);
//         }, 1000);
//     }
// }) : '';

// // Real-time validation
// fullNameInput ? fullNameInput.addEventListener('input', validatePersonalForm):'';
// emailInput ? emailInput.addEventListener('input', validatePersonalForm):'';
// phoneInput ? phoneInput.addEventListener('input', validatePersonalForm) : '';

// // Professional form
// const professionalForm = document.getElementById('professionalForm');
// professionalForm ? professionalForm.addEventListener('submit', function(e) {
    
//     const button = this.querySelector('button[type="submit"]');
//     button.disabled = true;
//     button.textContent = 'Saving...';
    
//     // setTimeout(() => {
//     //     button.disabled = false;
//     //     button.textContent = 'Save Professional Information';
//     //     document.getElementById('professionalSuccess').classList.remove('hidden');
//     //     setTimeout(() => {
//     //         document.getElementById('professionalSuccess').classList.add('hidden');
//     //     }, 3000);
//     // }, 1000);
// }) : '';

// // Specialty tags
// document.querySelectorAll('.specialty-tag').forEach(tag => {
//     tag.addEventListener('click', function() {
//         this.classList.toggle('selected');
//     });
// });

// // Bio character counter
// const bioTextarea = document.getElementById('bio');
// const bioCounter = document.getElementById('bioCounter');
// const bioError = document.getElementById('bioError');

// function updateBioCounter() {
//     const length = bioTextarea?bioTextarea.value.length:0;
//     const maxLength = 500;
//     bioCounter?bioCounter.textContent = `${length}/${maxLength}`:'';
    
//     if (length > maxLength) {
//         bioError?bioError.classList.remove('hidden'):'';
//         bioTextarea?bioTextarea.classList.add('error'):'';
//     } else {
//         bioError?bioError.classList.add('hidden'):'';
//         bioTextarea?bioTextarea.classList.remove('error'):'';
//     }
// }

// bioTextarea ? bioTextarea.addEventListener('input', updateBioCounter) : '';

// // Password strength checker
// const newPasswordInput = document.getElementById('newPassword');
// const confirmPasswordInput = document.getElementById('confirmPassword');
// const strengthBar = document.getElementById('strengthBar');
// const strengthText = document.getElementById('strengthText');
// const passwordError = document.getElementById('passwordError');

// function checkPasswordStrength(password) {
//     let strength = 0;
//     let text = 'Weak';
//     let className = 'strength-weak';

//     if (password.length >= 8) strength++;
//     if (/[a-z]/.test(password)) strength++;
//     if (/[A-Z]/.test(password)) strength++;
//     if (/[0-9]/.test(password)) strength++;
//     if (/[^A-Za-z0-9]/.test(password)) strength++;

//     if (strength >= 4) {
//         text = 'Strong';
//         className = 'strength-strong';
//     } else if (strength >= 3) {
//         text = 'Good';
//         className = 'strength-good';
//     } else if (strength >= 2) {
//         text = 'Fair';
//         className = 'strength-fair';
//     }

//     strengthBar.className = `password-strength ${className}`;
//     strengthText.textContent = password.length > 0 ? text : 'Enter password';
// }

// function validatePasswordMatch() {
//     if (confirmPasswordInput.value && newPasswordInput.value !== confirmPasswordInput.value) {
//         passwordError.classList.remove('hidden');
//         confirmPasswordInput.classList.add('error');
//         return false;
//     } else {
//         passwordError.classList.add('hidden');
//         confirmPasswordInput.classList.remove('error');
//         return true;
//     }
// }

// newPasswordInput ? newPasswordInput.addEventListener('input', function() {
//     checkPasswordStrength(this.value);
//     validatePasswordMatch();
// }) : '';

// confirmPasswordInput ? confirmPasswordInput.addEventListener('input', validatePasswordMatch) : '';

// // Password form
// const passwordForm = document.getElementById('passwordForm');
// passwordForm ? passwordForm.addEventListener('submit', function(e) {
//     // e.preventDefault();
//     if (validatePasswordMatch() && newPasswordInput.value.length >= 6) {
//         const button = this.querySelector('button[type="submit"]');
//         button.disabled = true;
//         button.textContent = 'Updating...';
        
//         // setTimeout(() => {
//         //     button.disabled = false;
//         //     button.textContent = 'Update Password';
//         //     document.getElementById('passwordSuccess').classList.remove('hidden');
//         //     this.reset();
//         //     strengthBar.className = 'password-strength';
//         //     strengthText.textContent = 'Enter password';
//         //     setTimeout(() => {
//         //         document.getElementById('passwordSuccess').classList.add('hidden');
//         //     }, 3000);
//         // }, 1000);
//     }else{
//         e.preventDefault();
//     }
// }) : '';

// Sidebar navigation
document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all items
        document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Get the page name
        const pageName = this.textContent.trim();
        
        if (pageName === 'Logout') {
            alert('Logging out...');
        } else if (pageName !== 'Profile') {
            // alert(`Navigating to: ${pageName}`);
        }
    });
});

// Initialize bio counter
// updateBioCounter();

// settings page script
// Account form validation
const accountForm = document.getElementById('accountForm');
const accountEmail = document.getElementById('accountEmail');
const accountPhone = document.getElementById('accountPhone');

function validateAccountForm() {
    let isValid = true;

    // Email validation
    if (!validateEmail(accountEmail.value)) {
        accountEmail.classList.add('error');
        document.getElementById('emailError').classList.remove('hidden');
        isValid = false;
    } else {
        accountEmail.classList.remove('error');
        document.getElementById('emailError').classList.add('hidden');
    }

    // Phone validation
    if (!validatePhone(accountPhone.value)) {
        accountPhone.classList.add('error');
        document.getElementById('phoneError').classList.remove('hidden');
        isValid = false;
    } else {
        accountPhone.classList.remove('error');
        document.getElementById('phoneError').classList.add('hidden');
    }

    return isValid;
}

accountForm ? accountForm.addEventListener('submit', function(e) {
    // e.preventDefault();
    if (validateAccountForm()) {
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.textContent = 'Saving...';
        
        setTimeout(() => {
            button.disabled = false;
            button.textContent = 'Save Account Settings';
            document.getElementById('accountSuccess').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('accountSuccess').classList.add('hidden');
            }, 3000);
        }, 1000);
    }
}) : '';

accountEmail ? accountEmail.addEventListener('input', validateAccountForm) : '';
accountPhone ? accountPhone.addEventListener('input', validateAccountForm) : '';

// Change password button
const changePasswordRedirectBtn = document.getElementById('changePasswordBtn');
changePasswordRedirectBtn ? changePasswordRedirectBtn.addEventListener('click', function() {
    alert('from settings page Redirecting to Profile > Security section...');
}) : '';

// Theme selection
document.querySelectorAll('.theme-preview').forEach(preview => {
    preview.addEventListener('click', function() {
        document.querySelectorAll('.theme-preview').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        
        const theme = this.getAttribute('data-theme');
        if (theme === 'light') {
            alert('Light mode will be available in a future update!');
            // For now, keep dark theme active
            document.querySelector('.theme-preview.dark').classList.add('active');
            this.classList.remove('active');
        }
    });
});

// Save preferences
const savePreferencesBtn = document.getElementById('savePreferences');
savePreferencesBtn ? savePreferencesBtn.addEventListener('click', function() {
    this.disabled = true;
    this.textContent = 'Saving...';
    
    showConfirmModal(
        'coming soon',
        'localization feature will be implemented soon',
        ()=>{
            this.disabled = false;
            this.textContent = 'Save Preferences';
        });

    // setTimeout(() => {
    //     this.disabled = false;
    //     this.textContent = 'Save Preferences';
    //     document.getElementById('preferencesSuccess').classList.remove('hidden');
    //     setTimeout(() => {
    //         document.getElementById('preferencesSuccess').classList.add('hidden');
    //     }, 3000);
    // }, 1000);
}) : '';

// Auto-save notification toggles 
document.querySelectorAll('.toggle-switch input[type="checkbox"]').forEach(toggle => {
    toggle.addEventListener('change', function() {
        // Auto-save notification preferences
        console.log(`${this.id}: ${this.checked}`);
        
        // Show brief feedback
        const setting = this.closest('.setting-item');
        if (setting) {
            setting.style.background = 'rgba(0, 255, 136, 0.1)';
            setTimeout(() => {
                setting.style.background = '';
            }, 500);
        }
    });
});

// Download data functionality
const downloadDataBtn = document.getElementById('donloadDataBtn');
downloadDataBtn ? downloadDataBtn.addEventListener('click', function() {
    const modal = document.getElementById('downloadModal');
    const progress = document.getElementById('downloadProgress');
    const status = document.getElementById('downloadStatus');
    
    modal.classList.add('active');
    
    let currentProgress = 0;
    const statuses = [
        'Collecting profile information...',
        'Gathering property listings...',
        'Compiling transaction history...',
        'Packaging messages and communications...',
        'Finalizing data export...',
        'Download ready!'
    ];
    
    const interval = setInterval(() => {
        currentProgress += 20;
        progress.style.width = currentProgress + '%';
        
        if (currentProgress <= 100) {
            status.textContent = statuses[Math.floor(currentProgress / 20) - 1] || statuses[0];
        }
        
        if (currentProgress >= 100) {
            clearInterval(interval);
            setTimeout(() => {
                modal.classList.remove('active');
                // Simulate file download
                const link = document.createElement('a');
                link.href = 'data:text/plain;charset=utf-8,Sample%20Data%20Export';
                link.download = 'my-data-export.json';
                link.click();
                
                // Reset progress
                progress.style.width = '0%';
                status.textContent = 'Initializing...';
            }, 1000);
        }
    }, 800);
}) : '';
