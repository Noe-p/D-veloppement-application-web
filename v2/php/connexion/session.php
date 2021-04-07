<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../../css/connexion.css" />
   <link rel="stylesheet" href="../../css/navBar.css" />

   <title>Focus</title>
</head>

<body>

   <?php require('../navBarConnexion.php'); ?>

   <div class="utilisateur">
      <a href="session.php"><img src="../../assets/logos/padlock_wo.png"></img>Connexion</a>
   </div>

   <section class="connexion">

      <form action="session_action.php" method="post">
         <h2>Connexion</h2>
         <span id='message3'></span>
         <div>
            <label for="pseudo"><B>Pseudo :</B><br/></label>
            <input type="text" id="pseudo" name="pseudo" required>
         </div>
         <div>
            <label for="mdp"><B>Mot de passe :</B><br/></label>
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
