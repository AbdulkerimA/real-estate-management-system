import 'keen-slider/keen-slider.min.css'
import KeenSlider from 'keen-slider'

// View toggle functionality
const tableViewBtn = document.getElementById('tableViewBtn');
const cardViewBtn = document.getElementById('cardViewBtn');

const tableView = document.getElementById('tableView');
const cardView = document.getElementById('cardView');

if(sessionStorage.getItem('cardView') == null){
    sessionStorage.setItem('cardView',"false");
}

function switchToTableView () {
    sessionStorage.setItem('cardView',"false");

    tableViewBtn.classList.add('active');
    cardViewBtn.classList.remove('active');
    tableViewBtn.classList.remove('text-gray-400');
    cardViewBtn.classList.add('text-gray-400');
    
    tableView.classList.remove('hidden');
    cardView.classList.add('hidden');
}

function switchToCardView (){
    sessionStorage.setItem('cardView',"true");

    cardViewBtn.classList.add('active');
    tableViewBtn.classList.remove('active');
    cardViewBtn.classList.remove('text-gray-400');
    tableViewBtn.classList.add('text-gray-400');
    
    cardView.classList.remove('hidden');
    tableView.classList.add('hidden');
}


let cardViewSession = sessionStorage.getItem('cardView');

console.log(cardViewSession);

if(cardViewSession == "true"){
    switchToCardView();
}else{
    tableViewBtn.classList.add('active');
}

if(tableViewBtn){
    tableViewBtn.addEventListener('click', () => {
       switchToTableView();   
    });
}

if(cardViewBtn){
    cardViewBtn.addEventListener('click', () => {
        switchToCardView();
    });
}
 

// propertyModal functionality
const propertyModal = document.getElementById('propertyModal');
const closeModal = document.getElementById('closeModal');

async function openModal(propertyId) {
    try {
        const response = await fetch(`/dashboard/property/${propertyId}`);
        if (!response.ok) throw new Error('Failed to fetch property data');

        const property = await response.json();

        // Populate property info
        document.getElementById('modalTitle').textContent = property.title;
        document.getElementById('modalDescription').textContent = property.description || 'No description available';
        document.getElementById('modalLocation').textContent = property.location || 'N/A';
        document.getElementById('modalPrice').textContent = `${property.price.toLocaleString()} ETB`;
        document.getElementById('modalType').textContent = property.type;
        document.getElementById('modalStatus').textContent = property.status;
        document.getElementById('modalStatus').classList.add(`status-${property.status}`);

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

window.viewData = viewData;