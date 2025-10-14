import KeenSlider from 'keen-slider';
import 'keen-slider/keen-slider.min.css';

 function initializeKeenSlider() {
        if (document.getElementById('main-keen-slider') && document.getElementById('thumbnails')) {
            function ThumbnailPlugin(main) {
                return (slider) => {
                    function removeActive() {
                        slider.slides.forEach((slide) => {
                            slide.classList.remove("active");
                        });
                    }
                    function addActive(idx) {
                        slider.slides[idx].classList.add("active");
                    }

                    function addClickEvents() {
                        slider.slides.forEach((slide, idx) => {
                            slide.addEventListener("click", () => {
                                main.moveToIdx(idx);
                            });
                        });
                    }

                    slider.on("created", () => {
                        addActive(slider.track.details.rel);
                        addClickEvents();
                        main.on("animationStarted", (main) => {
                            removeActive();
                            const next = main.animator.targetIdx || 0;
                            addActive(main.track.absToRel(next));
                            slider.moveToIdx(Math.min(slider.track.details.maxIdx, next));
                        });
                    });
                };
            }

            var slider = new KeenSlider("#main-keen-slider");
            var thumbnails = new KeenSlider(
                "#thumbnails",
                {
                    initial: 0,
                    slides: {
                        perView: 4,
                        spacing: 10,
                    },
                },
                [ThumbnailPlugin(slider)]
            );
        }
    }

    // Call the initialization function after the component is rendered
    document.addEventListener('DOMContentLoaded', initializeKeenSlider);

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
