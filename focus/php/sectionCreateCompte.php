<form action="verification.php?verif=createCpt" method="post">
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
