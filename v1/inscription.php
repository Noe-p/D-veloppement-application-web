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

   <section class="createCompte">
      <form action="action.php?action=inscription" method="post">
         <h2>Créer un compte</h2>
         <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" >
            <span id='message2'></span>
         </div>
         <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom">
            <span id="message2"></span>
         </div>
         <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom">
         </div>
         <div>
            <label for="createAdresseMail">Mail :</label>
            <input type="email" id="createAdresseMail" name="email">
         </div>
         <div>
            <label for="mdp">Mot de passe : </label>
            <input type="password" id="create_mdp" name="mdp" minlength="8" placeholder="8 caractères minimum" onkeyup='check_pass();' required >
         </div>
         <div>
            <label for="confirm_mdp">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_mdp" name="confirm_mdp" minlength="8" onkeyup='check_pass();' required>
            <span id='message'></span>
         </div>
         <div>
            <input class="buttonConnexion" type="submit" value="Créer un compte" id="submit" disabled/>
         </div>
      </form>

   </section>

   <script type="text/javascript" src="js/checkPass.js"></script>
   <script type="text/javascript" src="js/functionCreate.js"></script>
</body>

</html>
