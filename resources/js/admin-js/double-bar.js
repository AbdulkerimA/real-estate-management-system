// Buyer Engagement Chart
function initializeBuyerChart() {
    const ctx = document.getElementById('buyerChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Bookmarks',
                data: [450, 520, 480, 610, 580, 650],
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: '#3b82f6',
                borderWidth: 2
            }, {
                label: 'Purchases',
                data: [45, 52, 48, 61, 58, 65],
                backgroundColor: 'rgba(0, 255, 136, 0.8)',
                borderColor: '#00ff88',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#9ca3af'
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                }
            }
        }
    });
}
initializeBuyerChart();