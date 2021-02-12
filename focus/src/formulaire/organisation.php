<form action="profil.php" method="post">
   <?php
      if($nbPre==0){
         echo "<h3>Ajouter une organisation : </h3>";
      }
      else{
         echo "<h3>Organisation : </h3>";
      }
   ?>
   <div>
      <label for="modifNomOrga"><B>Nom :</B><br/></label>
      <input type="text" id="modifNomOrga" name="modifNomOrga" placeholder=<?php echo $pres['pre_nomStruct'] ?>>
   </div>
   <div>
      <label for="modifAdressOrga"><B>Adresse :</B><br/></label>
      <input type="text" id="modifAdressOrga" name="modifAdressOrga" placeholder=<?php echo $pres['pre_adresse'] ?>>
   </div>
   <div>
      <label for="modifMailOrga"><B>Mail :</B><br/></label>
      <input type="text" id="modifMailOrga" name="modifMailOrga" placeholder=<?php echo $pres['pre_adresseMail'] ?>>
   </div>
   <div>
      <label for="modifTelOrga"><B>Téléphone :</B><br/></label>
      <input type="text" id="modifTelOrga" name="modifTelOrga" placeholder=<?php echo $pres['pre_numeroTel'] ?>>
   </div>
   <div>
      <label for="modifHoraireOrga"><B>Horaire d'ouverture :</B><br/></label>
      <input type="text" id="modifHoraireOrga" name="modifHoraireOrga" placeholder=<?php echo $pres['pre_horaireOuverture'] ?>>
   </div>
   <div>
      <?php
         if($nbPre==0){
            echo "<input type=\"submit\" value=\"Ajouter une organisation\" id=\"submit\"/>";
         }
         else{
            echo "<input type=\"submit\" value=\"Modifier\" id=\"submit\"/>";
         }
      ?>
   </div>
</form>
