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
if (document.querySelector('.infosUser')) {
   create('.button1', '.publication');
   create('.button2', '.actualite');
   create('.button3', '.admin');
}
