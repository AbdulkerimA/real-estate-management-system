import Chart from 'chart.js/auto';

const agentPerformanceCtx = document.getElementById('doghnut').getContext('2d');
        new Chart(agentPerformanceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sara Tadesse', 'Michael Johnson', 'Aisha Mohammed', 'David Wilson', 'Others'],
                datasets: [{
                    data: [25, 20, 18, 15, 22],
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