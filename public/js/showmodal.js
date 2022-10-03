
const showModal = () => {
   let modal = document.getElementById('modal');
   modal.classList.remove('d-none')
} ;

const closeModal = () => {
    let modal = document.getElementById('modal');
    modal.classList.add('d-none');
}

const setPop = () => {
    // preventDefault();
    let pop = document.getElementById('pop'); 
    pop.classList.remove('d-none')
}

