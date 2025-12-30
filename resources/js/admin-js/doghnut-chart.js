import Chart from 'chart.js/auto';

// console.log(dChartData);
// console.log(others);

const row = dChartData.map(item=>item.agent_name); 
const col = dChartData.map(item=>item.deals_closed);

console.log(row);
console.log(col);
const agentPerformanceCtx = document.getElementById('doghnut').getContext('2d');
new Chart(agentPerformanceCtx, {
    type: 'doughnut',
    data: {
        labels: row,
        datasets: [{
            data: col,
            backgroundColor: [
                '#00ff88',
                '#00cc6a',
                '#00aa55',
                '#008844',
                '#006633'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    color: '#9ca3af',
                    usePointStyle: true,
                    padding: 20
                }
            }
        }
    }
});