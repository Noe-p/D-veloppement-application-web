<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/connexion.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus-Connexion</title>
</head>

<body>

   <aside>
      <ul class="navBar" >
         <li><a href="index.html">Home</a></li>
         <li class="menu"><a>Sélections</a>
            <ul class="sous">
               <li><a href="selections.html">Paysage</a></li>
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
         <li><a href="actualite.html">Actualités</a></li>
         <li class="menu compte"><a class="bouton">Compte</a>
            <ul class="sous">
               <li><a href="profil.html">Profil</a></li>
               <li><a href="connexion.html">Connexion</a></li>
               <li><a href="ajout.html">Ajouter</a></li>
            </ul>
         </li>
      </ul>
   </aside>

   <div class="utilisateur">
      <a href="connexion.html"><img src="assets/logos/padlock.png"></img>Connexion</a>
      <a href="https://noe-philippe.com/"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <section class="connexion">
      <form action="/my-handling-form-page" method="post">
         <h2>Connexion</h2>
         <div>
            <label for="adresseMail">Mail :</label>
            <input type="email" id="adresseMail" name="email">
         </div>
         <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="pass" name="mdp" minlength="8" required>
         </div>
         <div>
            <input class="buttonConnexion" type="submit" value="Connexion">
         </div>
      </form>
      <a class="buttonCreate" href="#">Créer un compte...</a>
   </section>


   <section class="createCompte open">
      <form action="createUser.php" method="post">
         <h2>Créer un compte</h2>
         <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo">
            <span id="message2">Pseudo déjà utilisé</span>
         </div>
         <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom">
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
   <script type="text/javascript" src="js/functionCreate.js"></script>

</body>

</html>
