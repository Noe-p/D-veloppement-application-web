<form action="verification.php?verif=verifUser" method="post">
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
<a class="buttonCreate" href="#">Créer un compte...</a>
