const tsearchInput = document.getElementById('transactionSearch');
const tstatusFilter = document.getElementById('statusFilter');
const TransactionTableBody = document.getElementById('transactionsTableBody');

let debounceTimer;

//Fetch transactions
function fetchTransactions() {
    const search = tsearchInput.value;
    const status = tstatusFilter.value;

    fetch(`?tsearch=${search}&tstatus=${status}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        TransactionTableBody.innerHTML = data.html;
    });
}

//Debounced search
tsearchInput.addEventListener('keyup', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(fetchTransactions, 400);
});

// Status filter
tstatusFilter.addEventListener('change', fetchTransactions);

// View Transaction
function viewTransaction(id) {
    window.location.href = `/admin/transactions/${id}`;
}

//Refund Transaction
function refundTransaction(id) {
    if (!confirm('Are you sure you want to refund this transaction?')) return;

    fetch(`/admin/transactions/${id}/refund`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(() => fetchTransactions());
}

window.viewTransaction = viewTransaction;
window.refundTransaction = refundTransaction;

const payoutSearch = document.getElementById('payoutSearch');
const payoutStatus = document.getElementById('payoutStatus');
const payoutTable = document.getElementById('payoutTableBody');

let payoutTimer;

function fetchPayouts() {
    fetch(`?payout=1&payout_search=${payoutSearch.value}&payout_status=${payoutStatus.value}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => payoutTable.innerHTML = data.html);
}

// Search
payoutSearch.addEventListener('keyup', () => {
    clearTimeout(payoutTimer);
    payoutTimer = setTimeout(fetchPayouts, 400);
});

// Filter
payoutStatus.addEventListener('change', fetchPayouts);


// Payout action functions
// Approve checkout
function approvePayout(id) {
    if (!confirm('Are you sure you want to approve this payout request?')) return;

    fetch(`/admin/checkouts/${id}/approve`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const statusSpan = document.querySelector(`#payout-${id} .status-badge`);
            if (statusSpan) {
                statusSpan.textContent = data.new_status;
                statusSpan.className = `status-badge status-${data.new_status}`;
            }
            else{
                window.location.reload();
            }
            fetchPayouts(); // refresh table via AJAX
        }
    });
}

// Reject checkout
function rejectPayout(id) {
    if (!confirm('Are you sure you want to reject this payout request?')) return;

    fetch(`/admin/checkouts/${id}/reject`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const statusSpan = document.querySelector(`#payout-${id} .status-badge`);
            if (statusSpan) {
                statusSpan.textContent = data.new_status;
                statusSpan.className = `status-badge status-${data.new_status}`;
            }
            else{
                window.location.reload();
            }
            fetchPayouts(); // refresh table via AJAX
        }
    });
}

window.approvePayout = approvePayout;
window.rejectPayout = rejectPayout;

window.approvePayout = approvePayout;
window.rejectPayout = rejectPayout; 
window.approvePayout = approvePayout;
window.rejectPayout = rejectPayout;