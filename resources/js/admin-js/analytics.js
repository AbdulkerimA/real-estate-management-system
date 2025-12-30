
document.querySelectorAll('.progress-fill').forEach(bar => {
    const width = bar.style.width;
    bar.style.width = '0';
    setTimeout(() => {
        bar.style.width = width;
    }, 100);
});

// Export functions
function exportChart(chartType) {
    console.log('Exporting chart:', chartType);
    alert(`Exporting ${chartType} chart data...`);
}

function exportAgentReport() {
    window.location = "agents/export";
}

function exportData(format) {
    console.log('Exporting data as:', format);
    alert(`Exporting analytics data as ${format.toUpperCase()}...`);
}

// Report functions
function viewReport(reportId) {
    console.log('Viewing report:', reportId);
    alert('Opening report viewer...');
}

function downloadReport(reportId, format) {
    console.log('Downloading report:', reportId, 'as', format);
    alert(`Downloading report as ${format.toUpperCase()}...`);
}

function generateNewReport() {
    console.log('Generating new report');
    alert('Opening report generator...');
}

// Heatmap interactions
document.querySelectorAll('.heatmap-cell').forEach(cell => {
    cell.addEventListener('click', function() {
        const location = this.querySelector('p').textContent;
        const value = this.getAttribute('data-value');
        alert(`${location}: ${value} properties listed`);
    });
});

window.exportAgentReport = exportAgentReport;
window.exportChart = exportChart;
window.exportData = exportData;
window.viewReport = viewReport;
window.downloadReport = downloadReport;
window.generateNewReport = generateNewReport;