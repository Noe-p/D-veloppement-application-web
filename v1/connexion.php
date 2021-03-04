<?php
session_start();
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


   <div class="utilisateur">
      <a href="connexion.php"><img src="assets/logos/padlock.png"></img>Connexion</a>
   </div>

   <section class="connexion">

      <form action="action.php?verif=connexion" method="post">
         <h2>Connexion</h2>
         <span id='message3'></span>
         <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" >
         </div>
         <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="pass" name="mdp" minlength="8" required>
         </div>
         <div>
            <input class="buttonConnexion" type="submit" value="Connexion">
         </div>
      </form>
      <a href="inscription.php">Créer un compte...</a>
   </section>

</body>

</html>
