import Chart from 'chart.js/auto';

const earningsCtx = document.getElementById('zig-zag').getContext('2d');
new Chart(earningsCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Revenue (₹ Lakhs)',
            data: [85, 92, 78, 105, 98, 112, 125, 118, 135, 142, 128, 155],
            borderColor: '#00ff88',
            backgroundColor: 'rgba(0, 255, 136, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: chartOptions
});
