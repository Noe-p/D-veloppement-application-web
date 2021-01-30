
//ANIMATION DE LA NAVBAR
let navBar = document.querySelector('.navBar');

//ANIMATION NAVIGATION
window.addEventListener('scroll', () => {
   if (window.scrollY > 60) {
      navBar.classList.add('position');
   } else {
      navBar.classList.remove('position');
   }
});
