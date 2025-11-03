import Chart from 'chart.js/auto';

// console.log(chartData);

let horizontalData = chartData.map(item=>item.month_name);
let verticalData = chartData.map(item=>item.count);

// console.log(months);
// console.log(transctionCount);

const earningsCtx = document.getElementById('zig-zag').getContext('2d');
new Chart(earningsCtx, {
    type: 'line',
    data: {
        labels: horizontalData,
        datasets: [{
            label: 'Revenue (ETB)',
            data: verticalData,
            borderColor: '#00ff88',
            backgroundColor: 'rgba(0, 255, 136, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: chartOptions
});
