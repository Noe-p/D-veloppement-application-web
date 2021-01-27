let buttonCreateCompte = document.querySelector('.buttonCreateCompte');
let compte = document.querySelector('.compte');
let createCompte = document.querySelector('.createCompte');


buttonCreateCompte.onclick = function(){
   createCompte.classList.add('open');
   compte.classList.remove('open');
}
