
<?php
require('php/requetes.php');
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
   <meta charset="utf-8">
   <title>Profil</title>

   <link rel="stylesheet" href="css/profil.css" />
   <link rel="stylesheet" href="css/navBar.css" />
   <link rel="stylesheet" href="css/footer.css" />

</head>
<body>


   <?php require('php/navBar.php'); ?>


   <header>
      <h2>Nono : </h2>
      <article class="infosUser">
         <ul>
            <li>Nom : Philippe</li>
            <li>Pénom : Noé</li>
            <li>Mail : noefrgv@gmail.com</li>
            <li>Nombre publication : 3</li>
            <li>Membre depuis le 30/10/2020</li>
         </ul>
      </article>
   </header>

   <div class="buttons">
      <a class="button1 open">Photos</a>
      <a class="button2">Actualités</a>
   </div>

   <section class="publication create open">
      <article class="imgUser">
         <div class="headerPublic">
            <a href="#">Nono</a>
            <h3>Rue de Brest</h3>
         </div>
         <img src="assets/img/img1.jpg" alt="img1">
         <p>Lors d'une petite ballade dans les rue de brest, du text sk,hjfklebzas:kfhbleajrqskhfcbdlqjdqkhvcb</p>
      </article>
   </section>

   <section class="actualite create">
      <h3>Ca marche</h3>
   </section>

   <?php require('php/footer.php'); ?>


   <script type="text/javascript" src="js/navBar.js"></script>
   <script type="text/javascript" src="js/createElement.js"></script>

</body>
</html>
