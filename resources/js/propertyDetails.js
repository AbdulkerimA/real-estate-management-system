// Gallery functionality

// const galleryThumbnails = document.querySelectorAll('.gallery-thumbnail');
// const mainGalleryImage = document.getElementById('main-gallery-image');

// const imageData = {
//     'living-room': {
//         gradient: 'from-purple-500 to-blue-600',
//         title: 'Living Room View'
//     },
//     'kitchen': {
//         gradient: 'from-green-500 to-teal-600',
//         title: 'Modern Kitchen'
//     },
//     'bedroom': {
//         gradient: 'from-orange-500 to-red-600',
//         title: 'Master Bedroom'
//     },
//     'bathroom': {
//         gradient: 'from-pink-500 to-purple-600',
//         title: 'Luxury Bathroom'
//     },
//     'balcony': {
//         gradient: 'from-yellow-500 to-orange-600',
//         title: 'Private Balcony'
//     },
//     'exterior': {
//         gradient: 'from-cyan-500 to-blue-600',
//         title: 'Building Exterior'
//     }
// };

// galleryThumbnails.forEach(thumbnail => {
//     thumbnail.addEventListener('click', function() {
//         // Remove active class from all thumbnails
//         galleryThumbnails.forEach(t => t.classList.remove('active', 'border-[#00ff88]'));
//         galleryThumbnails.forEach(t => t.classList.add('border-gray-600'));
        
//         // Add active class to clicked thumbnail
//         this.classList.add('active', 'border-[#00ff88]');
//         this.classList.remove('border-gray-600');
        
//         // Update main image
//         const imageKey = this.dataset.image;
//         const imageInfo = imageData[imageKey];
        
//         mainGalleryImage.className = `hero-image rounded-2xl h-96 flex items-center justify-center cursor-pointer bg-gradient-to-br ${imageInfo.gradient}`;
//         mainGalleryImage.innerHTML = `
//             <div class="text-center">
//                 <svg class="w-16 h-16 mx-auto mb-2 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
//                     <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
//                 </svg>
//                 <p class="text-white opacity-75">${imageInfo.title}</p>
//             </div>
//         `;
//     });
// });

// // Main gallery image click to enlarge
// mainGalleryImage.addEventListener('click', function() {
//     alert('Opening full-size image viewer...');
// });

// Schedule Viewing buttons
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('Schedule Viewing') || button.textContent.includes('Schedule a Viewing')) {
        button.addEventListener('click', function() {
            if(button.classList.contains('deactivated')){
                alert('you have alrady scheduled an appointment to this appartment :)');
            }else{
                alert('Opening viewing scheduler for this luxury apartment...');
                window.location = `/schedule/${propertyId}`;
            }
        });
    }
});

// Contact Agent buttons
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('Contact Agent')) {
        button.addEventListener('click', function() {
            alert('go to agent page');
        });
    }
});

// Agent action buttons
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('Call Agent')) {
        button.addEventListener('click', function() {
            // made call to the agent  
        });
    }
    if (button.textContent.includes('Send Message')) {
        button.addEventListener('click', function() {
            alert('direct message function will be implemented comming soon');
        });
    }
    if (button.textContent.includes('View Profile')) {
        button.addEventListener('click', function() {
            // alert('Opening Sara Tadesse\'s agent profile...');
        });
    }
});

// Similar properties buttons
document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('View Details') && button.closest('.property-card')) {
        button.addEventListener('click', function() {
            const propertyTitle = this.closest('.property-card').querySelector('h3').textContent;
            alert(`Opening details for: ${propertyTitle}`);
        });
    }
});
