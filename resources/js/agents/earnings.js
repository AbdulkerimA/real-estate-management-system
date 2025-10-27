const messageCard = document.getElementById('message');


function showMessageCard(key,message) {

    const messageText = document.getElementById('message-text');  

    // Show message modal modal
    messageCard.classList.remove('hidden');

    if(key == 'success'){
        
        messageCard.classList.add('bg-green-400/10','text-green-500', 'border-green-600');
        messageText.classList.add('a'); 
        
        messageText.textContent = message;

    }else{
        messageCard.classList.add('bg-red-400/10', 'text-red-500', 'border-red-600');
        messageText.classList.add('a'); 
        
        messageText.textContent = message;
    }

    setTimeout(() => {
        messageCard.classList.add('hidden')
    }, 5000);
}

let requestCheckOutBtn = document.getElementById('requestPayoutBtn');
let checkOutModal = document.getElementById('checkOutModal');


function showInputModal(onConfirm) {

    // Show modal
    checkOutModal.classList.add('active');

    // Confirm
    inputModalConfirm.onclick = () => {
        const inputValue = inputModalField.value.trim();
        checkOutModal.classList.remove('active');
        onConfirm(inputValue);
    };

    // Cancel
    inputModalCancel.onclick = () => {
        checkOutModal.classList.remove('active');
    };
}

requestCheckOutBtn.addEventListener('click', function () {
    // Second confirmation for delete
    showInputModal(
        async (inputValue) => {

            const url = '/dashboard/earnings';

            if(inputValue){
                const formData = new FormData();
                formData.append('amount',inputValue)

                try {
                    const response = await fetch(url, {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body:formData,
                    });

                    if (response.ok) {
                        const result = await response.json();
                        // console.log(result);
                        showMessageCard(result.res,result.message);
                    } else {
                        showMessageCard('error','something went wrong try again');
                        console.error(await response.text());
                    }
                } catch (error) {
                    showMessageCard('error','! there is a network issue');
                }
            }else{
                alert('input error: '.inputValue);
            }
            
        }
    );
});
