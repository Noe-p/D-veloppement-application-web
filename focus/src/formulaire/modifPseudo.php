<form class="desactiver" action="profil.php" method="post">
   <h3>Modifier Pseudo/Mot de passe : </h3>
   <div>
      <label for="pseudo"><B>Pseudo :</B><br/></label>
      <input type="text" id="pseudo" name="pseudo" >
      <span id='message2'></span>
   </div>

   <div>
      <label for="mdp"><B>Mot de passe : </B><br/></label>
      <input type="password" id="create_mdp" name="mdp" minlength="8" placeholder="8 caractères minimum" onkeyup='check_pass();' required >
   </div>
   <div>
      <label for="confirm_mdp"><B>Confirmer le mot de passe :</B><br/></label>
      <input type="password" id="confirm_mdp" name="confirm_mdp" minlength="8" onkeyup='check_pass();' required>
      <span id='message'></span>
   </div>
   <div>
      <input class="buttonConnexion" type="submit" value="Modifier" id="submit" disabled/>
   </div>
</form>
