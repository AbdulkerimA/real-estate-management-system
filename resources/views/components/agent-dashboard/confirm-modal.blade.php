@vite(['resources/js/confirmModal'])

<div class="modal" id="confirmModal">
    <div class="modal-content">
        <h3 class="text-xl font-bold mb-4" id="modalTitle">Confirm Action</h3>
        <p class="text-gray-400 mb-6" id="modalMessage">Are you sure you want to proceed?</p>
        <div class="flex space-x-4">
            <button class="flex-1 bg-gray-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-gray-500" id="modalCancel">
                Cancel
            </button>
            <button class="flex-1 danger-button px-4 py-3 rounded-lg text-white font-semibold" id="modalConfirm">
                Confirm
            </button>
        </div>
    </div>
</div>