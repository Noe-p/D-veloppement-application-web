<?php
session_start();

$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/connexion.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus</title>
</head>

<body>

   <?php require('php/navBar.php'); ?>

   <section class="verificationConnexion open">
      <p>Vous êtes déconnecté</p>
   </section>


</body>

</html>
