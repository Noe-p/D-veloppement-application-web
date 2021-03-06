<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Focus-Actus</title>

      <link rel="stylesheet" href="css/photos.css" />
      <link rel="stylesheet" href="css/navBar.css" />
   </head>
   <body>

      <aside>
         <ul class="navBar" >
            <li><a href="index.php">Home</a></li>
            <li class="menu"><a>Sélections</a>
               <ul class="sous">
                  <li><a href="selections.php">Paysage</a></li>
                  <li><a href="#">Portrait</a></li>
                  <li><a href="#">Monochrome</a></li>
                  <li><a href="#">Foret</a></li>
                  <li><a href="#">Mer</a></li>
                  <li><a href="#">Brest</a></li>
                  <li><a href="#">Rennes</a></li>
                  <li><a href="#">Rennes</a></li>
                  <li><a href="#">Rennes</a></li>
                  <li><a href="#">Rennes</a></li>
                  <li><a href="#">Rennes</a></li>
                  <li><a href="#">Rennes</a></li>
                  <li><a href="#">Rennesardssss</a></li>
               </ul>
            </li>
            <li><a href="photos.php" class="bouton">Photos</a></li>
            <li class="menu compte"><a>Compte</a>
               <ul class="sous">
                  <?php
                  if(isset($_SESSION['pseudo'])){
                     echo "<li><a href='profil.php>Profil</a></li>
                     <li><a href='ajout.php'>Ajouter</a></li>
                     <li><a href='action.php?action=deconnexion'>Déconnexion</a></li>";
                  } else{
                     echo "<li><a href='connexion.php'>Connexion</a></li>";
                  }
                  ?>

               </ul>
            </li>
         </ul>
      </aside>



      <section>
         <article class="imgUser">
            <div class="headerPublic">
               <a href="#">Nono</a>
               <h3>Rue de Brest</h3>
            </div>
            <img src="assets/img/img1.jpg" alt="img1">
            <p>Lors d'une petite ballade dans les rue de brest</p>
         </article>

         <article class="imgUser">
            <div class="headerPublic">
               <a href="#">Tata</a>
               <h3>Pluie sur les grues</h3>
            </div>
            <img src="assets/img/img2.jpg" alt="img2">
            <p>Quand la tempête fait rage à brest</p>
         </article>

         <article class="imgUser">
            <div class="headerPublic">
               <a href="#">Zozo</a>
               <h3>Rue de Brest</h3>
            </div>
            <img src="assets/img/img3.jpg" alt="img3">
            <p></p>
         </article>

      </section>
      <script type="text/javascript" src="js/navBar.js"></script>


   </body>
</html>
