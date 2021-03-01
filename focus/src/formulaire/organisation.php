   <?php
      if($nbPre==0){
         echo "<form action='verification.php?verif=ajoutOrga' method='post'>";
         echo "<h3>Ajouter une organisation : </h3>";
      }
      else{
         echo "<form action='verification.php?verif=modifOrga' method='post'>";
         echo "<h3>Organisation : </h3>";
      }
   ?>
   <div>
      <label for="nomOrga"><B>Nom :</B><br/></label>
      <input type="text" id="nomOrga" name="nomOrga" placeholder=<?php echo $pres['pre_nomStruct'] ?>>
   </div>
   <div>
      <label for="adresseOrga"><B>Adresse :</B><br/></label>
      <input type="text" id="adresseOrga" name="adresseOrga" placeholder=<?php echo $pres['pre_adresse'] ?>>
   </div>
   <div>
      <label for="mailOrga"><B>Mail :</B><br/></label>
      <input type="text" id="mailOrga" name="mailOrga" placeholder=<?php echo $pres['pre_adresseMail'] ?>>
   </div>
   <div>
      <label for="telOrga"><B>Téléphone :</B><br/></label>
      <input type="text" id="telOrga" name="telOrga" placeholder=<?php echo $pres['pre_numeroTel'] ?>>
   </div>
   <div>
      <label for="horaireOrga"><B>Horaire d'ouverture :</B><br/></label>
      <input type="text" id="horaireOrga" name="horaireOrga" placeholder=<?php echo $pres['pre_horaireOuverture'] ?>>
   </div>
   <div>
      <label for="texteOrga"><B>Horaire d'ouverture :</B><br/></label>
      <input type="text" id="texteOrga" name="texteOrga" placeholder=<?php echo $pres['pre_horaireOuverture'] ?>>
   </div>
   <div>
      <?php
         if($nbPre==0){
            echo "<input type=\"submit\" value=\"Ajouter une organisation\" id=\"submit2\"/>";
         }
         else{
            echo "<input type=\"submit\" value=\"Modifier\" id=\"submit2\"/>";
         }
      ?>
   </div>
</form>
