// Transaction action functions
function viewTransaction(id) {
    console.log('Viewing transaction:', id);
    alert('Transaction details modal would open here.');
}

function verifyTransaction(id) {
    if (confirm('Are you sure you want to verify this transaction?')) {
        console.log('Verifying transaction:', id);
        alert('Transaction verified successfully!');
        // Update status in the table or pending approvals
    }
}

function rejectTransaction(id) {
    if (confirm('Are you sure you want to reject this transaction?')) {
        console.log('Rejecting transaction:', id);
        alert('Transaction rejected successfully!');
        // Remove from pending approvals or update status
    }
}

function refundTransaction(id) {
    if (confirm('Are you sure you want to process a refund for this transaction?')) {
        console.log('Processing refund for transaction:', id);
        alert('Refund processed successfully!');
        // Update transaction status to refunded
    }
}