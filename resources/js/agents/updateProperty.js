// add properties form scripts
let uploadedImages = [];
let mainImageIndex = 0;

// Form progress tracking
// function updateProgress() {
//     const form = document.getElementById('propertyForm');
//     const inputs = form?form.querySelectorAll('input[required], select[required], textarea[required]'):"";
//     let filledInputs = 0;

//     inputs?inputs.forEach(input => {
//         if (input.value.trim() !== '') {
//             filledInputs++;
//         }
//     }):'';

//     // const progress = Math.round((filledInputs / inputs.length) * 100);
//     // // document.getElementById('progressFill').style.width = progress + '%';
//     // // document.getElementById('progressText').textContent = progress + '%';
// }

// Add event listeners to form inputs
// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.getElementById('propertyForm');
//     const inputs = form?form.querySelectorAll('input, select, textarea'):'';

//     inputs?inputs.forEach(input => {
//         // input.addEventListener('input', updateProgress);
//         // input.addEventListener('change', updateProgress);
//     }):'';

//     // Initial progress update
//     // updateProgress();
// });

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