<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/home.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus</title>
</head>

<body>

   <?php require('php/navBar.php'); ?>

   <div class="utilisateur">
      <?php if(isset($_SESSION['pseudo'])==false){
         echo "<a href=\"connexion.php\"><img src=\"assets/logos/padlock.png\"></img>Connexion</a>";
      }
      ?>
      <a href="https://noe-philippe.com/"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <header>
      <h1>Focus</h1>
   </header>

   <h2>Dernière Photos :</h2>

   <section>
      <article class="imgUser">
         <div class="headerPublic">
            <?php echo "<a href=\"autreUser.php?pseudo=".$_SESSION['pseudo']."&amp;selection=Photos\">".$_SESSION['pseudo']."</a>" ?>
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

   <script type="text/javascript" src="js/home.js"></script>
</body>

</html>
