import Chart from 'chart.js/auto';

// console.log(barChartData);

let horizontalData = barChartData.map(item=>item.catagory);
let verticalData = barChartData.map(item=>item.count);

const propertySalesCtx = document.getElementById('bar').getContext('2d');
        new Chart(propertySalesCtx, {
            type: 'bar',
            data: {
                labels: horizontalData,
                datasets: [{
                    label: 'Sales Count',
                    data: verticalData,
                    backgroundColor: [
                        'rgba(0, 255, 136, 0.8)',
                        'rgba(0, 255, 136, 0.6)', 
                        'rgba(0, 255, 136, 0.4)',
                        'rgba(0, 255, 136, 0.2)'
                    ],
                    borderColor: '#00ff88',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });
