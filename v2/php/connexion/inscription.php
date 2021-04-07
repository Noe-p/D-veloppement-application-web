<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../../css/connexion.css" />
   <link rel="stylesheet" href="../../css/navBar.css" />
   <link rel="stylesheet" href="../../css/footer.css" />


   <title>Focus</title>
</head>

<body>

   <?php require('../navBarConnexion.php'); ?>

   <div class="utilisateur">
      <a href="session.php"><img src="../../assets/logos/padlock_wo.png"></img>Connexion</a>
   </div>


   <section class="createCompte">
      <form action="action.php" method="post">
         <h2>Créer un compte</h2>
         <div>
            <label for="pseudo"><B>Pseudo :</B><br/></label>
            <input type="text" id="pseudo" name="pseudo" required>
            <span id='message2'></span>
         </div>
         <div>
            <label for="nom"><B>Nom :</B><br/></label>
            <input type="text" id="nom" name="nom" required>
         </div>
         <div>
            <label for="prenom"><B>Prénom :</B><br/></label>
            <input type="text" id="prenom" name="prenom" required>
         </div>
         <div>
            <label for="createAdresseMail"><B>Mail :</B><br/></label>
            <input type="email" id="createAdresseMail" name="email" required>
         </div>
         <div>
            <label for="mdp"><B>Mot de passe :</B><br/></label>
            <input type="password" id="create_mdp" name="mdp" minlength="8" placeholder="8 caractères minimum" onkeyup='check_pass();' required >
         </div>
         <div>
            <label for="confirm_mdp"><B>Confirmer le mot de passe :</B><br/></label>
            <input type="password" id="confirm_mdp" name="confirm_mdp" minlength="8" onkeyup='check_pass();' required>
            <span id='message'></span>
         </div>
         <div>
            <input class="buttonConnexion" type="submit" value="Créer un compte" id="submit" disabled='false'/>
         </div>
      </form>
   </section>



   <script type="text/javascript" src="../../js/checkPass.js"></script>
   <script type="text/javascript" src="../../js/navBar.js"></script>
   <script type="text/javascript" src="../../js/functionCreate.js"></script>
</body>

</html>
