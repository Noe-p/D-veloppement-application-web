
//ANIMATION DE LA DIV NAVIGATION
let header = document.querySelector('header');
let navBar = document.querySelector('.navBar');

//ANIMATION NAVIGATION
window.addEventListener('scroll', () => {
   if (window.scrollY > 60) {
      header.classList.add('position');
      navBar.classList.add('position');
   } else {
      navBar.classList.remove('position');
      header.classList.remove('position');
   }
});
