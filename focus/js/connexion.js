let buttonCreateCompte = document.querySelector('.buttonCreateCompte');
let connexion = document.querySelector('.connexion');
let createCompte = document.querySelector('.createCompte');


buttonCreateCompte.onclick = function(){
   createCompte.classList.add('open');
   connexion.classList.remove('open');
}
