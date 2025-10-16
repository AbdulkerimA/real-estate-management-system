// Payout action functions
function approvePayout(id) {
    if (confirm('Are you sure you want to approve this payout request?')) {
        console.log('Approving payout:', id);
        alert('Payout approved and processed successfully!');
        // Update payout status
    }
}

function rejectPayout(id) {
    if (confirm('Are you sure you want to reject this payout request?')) {
        console.log('Rejecting payout:', id);
        alert('Payout request rejected.');
        // Update payout status
    }
}

window.approvePayout = approvePayout;
window.rejectPayout = rejectPayout;