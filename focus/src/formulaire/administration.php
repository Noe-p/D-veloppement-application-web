<form action="/my-handling-form-page" method="post">
   <h2>Connexion administrateur :</h2>
   <div>
      <label for="adresseMail">Mail :</label>
      <input type="email" id="adresseMail" name="email">
   </div>
   <div>
      <label for="pass">Mot de passe :</label>
      <input type="current-password" id="pass" name="password" minlength="8" required>
   </div>
   <div>
      <input class="buttonConnexion" type="submit" value="Connexion">
   </div>
</form>
