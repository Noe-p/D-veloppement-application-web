

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
