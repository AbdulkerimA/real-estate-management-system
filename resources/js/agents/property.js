// View toggle functionality
const tableViewBtn = document.getElementById('tableViewBtn');
const cardViewBtn = document.getElementById('cardViewBtn');

const tableView = document.getElementById('tableView');
const cardView = document.getElementById('cardView');

if(sessionStorage.getItem('cardView') == null){
    sessionStorage.setItem('cardView',"false");
}

function switchToTableView () {
    sessionStorage.setItem('cardView',"false");

    tableViewBtn.classList.add('active');
    cardViewBtn.classList.remove('active');
    tableViewBtn.classList.remove('text-gray-400');
    cardViewBtn.classList.add('text-gray-400');
    
    tableView.classList.remove('hidden');
    cardView.classList.add('hidden');
}

function switchToCardView (){
    sessionStorage.setItem('cardView',"true");

    cardViewBtn.classList.add('active');
    tableViewBtn.classList.remove('active');
    cardViewBtn.classList.remove('text-gray-400');
    tableViewBtn.classList.add('text-gray-400');
    
    cardView.classList.remove('hidden');
    tableView.classList.add('hidden');
}


let cardViewSession = sessionStorage.getItem('cardView');

console.log(cardViewSession);

if(cardViewSession == "true"){
    switchToCardView();
}else{
    tableViewBtn.classList.add('active');
}

if(tableViewBtn){
    tableViewBtn.addEventListener('click', () => {
       switchToTableView();   
    });
}

if(cardViewBtn){
    cardViewBtn.addEventListener('click', () => {
        switchToCardView();
    });
}
