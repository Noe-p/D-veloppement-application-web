<form class="modifInf" action="verification.php?verif=modifInf" method="post" name='test'>
   <h3>Informations : </h3>
   <div>
      <label><B>Nom :</B><br/></label>
      <input type="text" id="modifNom" name="modifNom" placeholder=<?php echo $profil['pro_nom'] ?>>
   </div>
   <div>
      <label for="modifPrenom"><B>Prénom :</B><br/></label>
      <input type="text" id="modifPrenom" name="modifPrenom" placeholder=<?php echo $profil['pro_prenom'] ?>>
   </div>
   <div>
      <label for="modifMail"><B>Mail :</B><br/></label>
      <input type="text" id="modifMail" name="modifMail" placeholder=<?php echo $profil['pro_mail'] ?>>
   </div>

   <div>
      <input type="submit" value="Modifier" id="submit2"/>
   </div>
</form>
