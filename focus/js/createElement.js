function create(var1, var2) {
   let long = document.querySelectorAll('.create').length;
   let buttonCreate =  document.querySelector(var1);
   let elementCreate =  document.querySelector(var2);

   buttonCreate.onclick = function() {
      for (var i = 1; i <= long ; i++) {
         let button = document.querySelector('.button' + i);
         button.classList.remove('open');
      }
      document.querySelector('.create.open').classList.remove('open');

      buttonCreate.classList.add('open');
      elementCreate.classList.add('open');
   }

}

//create(bouton a creer, element a creer)
if (document.querySelector('.information')) {
   create('.button1', '.information');
   create('.button2', '.administration');
   create('.button3', '.modifier');
}
else if(document.querySelector('.photo')){
   create('.button2', '.selection');
   create('.button1', '.photo');
}
else if(document.querySelector('.connexion')){
   let buttonCreate =  document.querySelector('.buttonCreate');

   buttonCreate.onclick = function() {
      document.querySelector('.connexion').classList.remove('open');
      document.querySelector('.createCompte').classList.add('open');
   }
}
