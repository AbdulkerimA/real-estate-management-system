import Chart from 'chart.js/auto';

const labels = buyerEngagementData.map(item => item.month);
const bookmarks = buyerEngagementData.map(item => item.bookmarks);
const purchases = buyerEngagementData.map(item => item.purchases);

const ctx = document.getElementById('buyerChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels,
        datasets: [
            {
                label: 'Bookmarks',
                data: bookmarks,
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: '#3b82f6',
                borderWidth: 2
            },
            {
                label: 'Purchases',
                data: purchases,
                backgroundColor: 'rgba(0, 255, 136, 0.8)',
                borderColor: '#00ff88',
                borderWidth: 2
            }
        ]
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
                ticks: { color: '#9ca3af' },
                grid: { color: 'rgba(255,255,255,0.1)' }
            },
            y: {
                ticks: { color: '#9ca3af' },
                grid: { color: 'rgba(255,255,255,0.1)' }
            }
        }
    }
});