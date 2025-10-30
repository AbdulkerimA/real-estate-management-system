import Chart from 'chart.js/auto';

const propertySalesCtx = document.getElementById('bar').getContext('2d');
        new Chart(propertySalesCtx, {
            type: 'bar',
            data: {
                labels: ['Apartments', 'Houses', 'Commercial', 'Land'],
                datasets: [{
                    label: 'Sales Count',
                    data: [456, 234, 123, 89],
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
