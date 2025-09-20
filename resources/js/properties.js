// Price range slider functionality
        const priceRange = document.getElementById('price-range');
        const priceDisplay = document.getElementById('price-display');
        
        priceRange.addEventListener('input', function() {
            const value = parseInt(this.value);
            priceDisplay.textContent = value.toLocaleString();
        });

        // Search functionality
        document.getElementById('search-btn').addEventListener('click', function() {
            const location = document.getElementById('location-filter').value;
            const type = document.getElementById('type-filter').value;
            const price = document.getElementById('price-filter').value;
            const bedrooms = document.getElementById('bedroom-filter').value;
            
            // Simulate search
            alert(`Searching properties...\nLocation: ${location || 'All'}\nType: ${type || 'All'}\nPrice: ${price || 'Any'}\nBedrooms: ${bedrooms || 'Any'}`);
        });

        // Reset filters
        document.getElementById('reset-btn').addEventListener('click', function() {
            document.getElementById('location-filter').value = '';
            document.getElementById('type-filter').value = '';
            document.getElementById('price-filter').value = '';
            document.getElementById('bedroom-filter').value = '';
            priceRange.value = 5000000;
            priceDisplay.textContent = '5,000,000';
            
            // Reset checkboxes
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
        });

        // Mobile filter sidebar toggle
        const mobileFilterBtn = document.getElementById('mobile-filter-btn');
        const sidebar = document.querySelector('.lg\\:w-1\\/4');
        const closeSidebar = document.getElementById('close-sidebar');
        
        if (mobileFilterBtn) {
            mobileFilterBtn.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
            });
        }
        
        if (closeSidebar) {
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.add('hidden');
            });
        }

        // Property card interactions
        document.querySelectorAll('.property-card button').forEach(button => {
            if (button.textContent.includes('View Details')) {
                button.addEventListener('click', function() {
                    const propertyTitle = this.closest('.property-card').querySelector('h3').textContent;
                    alert(`Opening details for: ${propertyTitle}`);
                });
            }
        });

        // Sidebar filter checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Simulate filtering
                console.log(`Filter changed: ${this.value} - ${this.checked}`);
            });
        });

        // Pagination
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.match(/^\d+$/)) {
                button.addEventListener('click', function() {
                    // Remove active class from all page buttons
                    document.querySelectorAll('button').forEach(btn => {
                        if (btn.textContent.match(/^\d+$/)) {
                            btn.className = 'px-4 py-2 bg-dark-primary rounded-lg hover:bg-gray-600 transition-colors';
                        }
                    });
                    // Add active class to clicked button
                    this.className = 'px-4 py-2 bg-accent-green text-dark-secondary rounded-lg font-semibold';
                });
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                alert('Mobile menu would open here');
            });
        }

        // Sort functionality
        document.querySelector('select').addEventListener('change', function() {
            alert(`Sorting by: ${this.value}`);
        });