// Counter animation
import Chart from 'chart.js/auto';

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
        element.textContent = shortForm(Math.floor(current));
    }, 16);
}
// number converter
function shortForm(num){
    let shortNum = 0 ;
    if(num > 1000000){
        shortNum = (num/1000000).toFixed(2);
        shortNum = `${shortNum}M`;
    }
    else if(num > 100000){
        shortNum = (num/100000).toFixed(2);
        shortNum = `${shortNum}K`;
    }else{
        shortNum = num;
    }

    return shortNum;
}
// Initialize counter animations
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        animateCounter(counter, target);
    });
});