
@vite(['resources/js/inputModal'])

<div class="modal" id="inputModal">
    <div class="modal-content">
        <h3 class="text-xl font-bold mb-4" id="inputModalTitle">Final Confirmation</h3>
        <p class="text-gray-400 mb-4" id="inputModalMessage">Type "DELETE" to confirm permanent account deletion.</p>
        <input 
            type="text" 
            id="inputModalField" 
            class="w-full p-3 rounded-lg bg-gray-700 text-white mb-6 outline-none focus:ring-2 focus:ring-red-500" 
            placeholder='Type "DELETE" here...'>
        <div class="flex space-x-4">
            <button class="flex-1 bg-gray-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-gray-500" id="inputModalCancel">
                Cancel
            </button>
            <button class="flex-1 danger-button px-4 py-3 rounded-lg text-white font-semibold" id="inputModalConfirm">
                Confirm
            </button>
        </div>
    </div>
</div>