<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/connexion.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus-Connexion</title>
</head>

<body>

   <?php require('src/navBar.php'); ?>

   <div class="utilisateur">
      <a href="connexion.php"><img src="assets/logos/padlock.png"></img>Connexion</a>
      <a href="https://noe-philippe.com/"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <section class="connexion open">
      <?php require('src/sectionConnexion.php'); ?>
   </section>

   <section class="createCompte">
      <?php require('src/sectionCreateCompte.php'); ?>
   </section>

   <script type="text/javascript" src="js/createElement.js"></script>
   <script type="text/javascript" src="js/checkPass.js"></script>
</body>

</html>
