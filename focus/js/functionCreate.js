
function create(var1, var2, var3, var4) {
   let buttonCreate = document.querySelector(var1);
   let buttonRemove = document.querySelector(var2);
   let elementRemove = document.querySelector(var3);
   let elementCreate = document.querySelector(var4);

   buttonCreate.onclick = function() {
      elementCreate.classList.add('open');
      elementRemove.classList.remove('open');
      buttonCreate.classList.add('open');
      buttonRemove.classList.remove('open');
   }

}

if(document.querySelector('.information')){
   create('.buttonProfil', '.buttonAdmin','.administration', '.information');
   create('.buttonAdmin', '.buttonProfil', '.information', '.administration');
}
else if ('.connexion') {
   create('.buttonCreate','.buttonConnexion','.connexion', '.createCompte');
}


function check_pass() {
   if (document.getElementById('create_mdp').value ==
         document.getElementById('confirm_mdp').value) {
            document.getElementById('message').style.color = 'rgb(128, 205, 79)';
            document.getElementById('message').innerHTML = '✔';
            document.getElementById('submit').disabled = false;
   } else {
      document.getElementById('message').style.color = 'rgb(210, 28, 28)';
      document.getElementById('message').innerHTML = '✗';
      document.getElementById('submit').disabled = true;
   }
}
