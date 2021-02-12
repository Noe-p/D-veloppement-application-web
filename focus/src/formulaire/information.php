<form action="profil.php" method="post">
   <h3>Informations : </h3>
   <div>
      <label for="modifNom"><B>Nom :</B><br/></label>
      <input type="text" id="modifNom" name="modifNom" placeholder=<?php echo $profil['pro_nom'] ?>>
   </div>
   <div>
      <label for="ModifPrenom"><B>Prenom :</B><br/></label>
      <input type="text" id="ModifPrenom" name="ModifPrenom" placeholder=<?php echo $profil['pro_prenom'] ?>>
   </div>
   <div>
      <label for="modifMail"><B>Mail :</B><br/></label>
      <input type="text" id="modifMail" name="modifMail" placeholder=<?php echo $profil['pro_mail'] ?>>
   </div>
   <div>
      <input type="submit" value="Modifier" id="submit"/>
   </div>
</form>
