<!--INFORMATIONS -->
<section>
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

<!--ORGANISATION -->

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

<!--ACTIVER ELEMENTS -->
   <form class="activer" action="profil.php" method="post">
      <h3>Activer éléments(s): </h3>
      <div>
         <?php
            if($nbEleDes==0){
               echo "<p class=\"attention\">Tous les éléments sont activés</p>";
            }

            for ($j=0; $j <$nbEleDes ; $j++) {
               echo "<input type=\"checkbox\" id=\"checkbox\" name=\"".$eleDes['ele_intitule'][$j]."\">
                  <label for=\"checkbox\">".$eleDes['ele_intitule'][$j]."</label>";
            }
         ?>
      </div>
      <div>
         <?php
            if($nbEleDes!=0){
               echo "<input type=\"submit\" value=\"Activer\" id=\"submit\"/>";
            }
         ?>
      </div>
   </form>
</section>


<!--ELEMENTS -->
<section>
   <form action="profil.php" method="post">
      <h3>Elements : </h3>
      <select name="elements" id="elements" onchange='checkSelection();'>
         <option value="">-- Choisir --</option>
         <?php
            for ($i=0; $i < $nbAllEle; $i++) {
               echo "<option value=\"".$allEle['ele_intitule'][$i]."\">".$allEle['ele_intitule'][$i]."</option>";
            }
         ?>
      </select>
      <div>
         <label for="titre">Titre :<br/></label>
         <input type="text" id="titre" name="titre">
      </div>
      <div>
         <label for="descriptionEle">Description :<br/></label>
         <textarea rows="6" cols="32" id="descriptionEle" name="descriptionEle" maxlength="500"></textarea>
      </div>
      <div>
         <input type="submit" value="Modifier" id="submit"/>
      </div>
   </form>

<!--SELECTION -->
   <form action="profil.php" method="post">
      <h3>Sélections : </h3>
      <select name="selection" id="selection">
         <option value="">-- Choisir --</option>
         <?php
            for ($i=0; $i < $nbSel; $i++) {
               echo "<option value=\"".$sel['sel_intitule'][$i]."\">".$sel['sel_intitule'][$i]."</option>";
            }
         ?>
      </select>
      <div>
         <label for="nom">Nom :<br/></label>
         <input type="text" id="nom" name="nom">
      </div>
      <div>
         <label for="descriptionSel">Description :<br/></label>
         <textarea rows="6" cols="32" id="descriptionSel" name="descriptionSel" maxlength="500"></textarea>
      </div>
      <div>
         <input type="submit" value="Modifier" id="submit"/>
      </div>
   </form>

<!--MODIFIER LES ELEMENTS DANS LES SELECTIONS -->
   <form action="profil.php" method="post">
      <h3>Modifier les élements dans les sélections : </h3>
      <div>
         <?php
            require("php/config.php");
            //On affiche les selection
            for ($i=0; $i <$nbSel ; $i++) {
               echo "<p><B>".$sel['sel_intitule'][$i]." :</B></p>";

               //On cherche les éléments de chaque selections
               $selection=$sel['sel_intitule'][$i];
               $resJt = mysqli_query($con, "SELECT ele_intitule FROM t_element_ele
                                          JOIN tj_relie_rel USING(ele_numero)
                                          JOIN t_selection_sel USING(sel_numero)
                                          WHERE com_pseudo = '$_SESSION[pseudo]'
                                          AND sel_intitule = '$selection'");

               //On remplis un tableau avec les elements trouvé
               $nbJt=0;
               while($reqJt = $resJt->fetch_array(MYSQLI_ASSOC)){
                  $jt['ele_intitule'][$nbJt]=$reqJt['ele_intitule'];
                  $nbJt = $nbJt+1;
               }

               //On affiche les éléments
               for ($j=0; $j <$nbAllEle ; $j++) {
                  echo "<input type=\"checkbox\" id=\"checkbox\" name=\"".$allEle['ele_intitule'][$j]."\"";
                  //On Regarde si un element correspond aux elements des selctions, s'il existe on coche la case
                  for ($h=0; $h <$nbJt ; $h++) {
                     if($allEle['ele_intitule'][$j]==$jt['ele_intitule'][$h]){echo "checked>";}
                  }
                  echo "<label for=\"checkbox\">".$allEle['ele_intitule'][$j]."</label>";
               }
            }

            if($nbAllEle==0){
               echo "<p class=\"attention\">Vous n'avez aucun éléments</p>";
            }

            $con->close();
         ?>
      </div>
      <div>
         <?php
         if($nbAllEle!=0){
            echo "<input type=\"submit\" value=\"Modifier\" id=\"submit\"/>";
         }
         ?>
      </div>
   </form>

</section>

<!--ZONE A RISQUE -->
<div class="risque">
   <h2>Zone à risque :</h2>
</div>


<!--DESACTIVER ELEMENTS -->
<section>
   <form class="desactiver" action="profil.php" method="post">
      <h3>Désactiver élément(s) : </h3>
      <div>
         <?php
         if($nbEleAct==0){
            echo "<p class=\"attention\">Toutes les éléments sont désactivés</p>";
         }

         for ($j=0; $j <$nbEleAct ; $j++) {
            echo "<input type=\"checkbox\" id=\"checkbox\" name=\"".$eleAct['ele_intitule'][$j]."\">
                  <label for=\"checkbox\">".$eleAct['ele_intitule'][$j]."</label>";
            }
         ?>
      </div>
      <div>
         <?php
         if($nbEleAct!=0){
            echo "<input type=\"submit\" value=\"Désactiver\" id=\"submit\"/>";
         }
         ?>
      </div>
   </form>

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
</section>

<!--SUPPRIMMER SELECTIONS -->
<section>
   <form class="danger" action="profil.php" method="post">
      <h3>Supprimer sélection(s) : </h3>
      <p class="attention">La selection doit être vide pour pouvoir la supprimer</p>
      <div>
         <?php
         require("php/config.php");

         for ($j=0; $j <$nbSel ; $j++) {
            $sel_intitule = $sel['sel_intitule'][$j];
            $resTj = mysqli_query($con, "SELECT ele_numero FROM tj_relie_rel JOIN t_selection_sel USING(sel_numero) WHERE sel_intitule ='$sel_intitule' and com_pseudo = '$_SESSION[pseudo]'");
            $nbTj = mysqli_num_rows($resTj);

            if($nbTj==0){
               echo "<input type=\"checkbox\" id=\"checkbox\" name=\"".$sel_intitule."\">
                  <label for=\"checkbox\">".$sel_intitule."</label>";
            }
         }
         $con->close();
         ?>
      </div>
      <div>
         <?php
         if($nbTj==0){
            echo "<input type=\"submit\" value=\"Supprimer\" id=\"submit\"/>";
         }
         ?>
      </div>
   </form>

<!--SUPPRIMER ELEMENTS -->
   <form class="danger" action="profil.php" method="post">
      <h3>Supprimer élément(s) : </h3>
      <div>
         <?php
         if($nbAllEle==0){
            echo "<p class=\"attention\">Vous n'avez aucun éléments à supprimer";
         }
         for ($j=0; $j <$nbAllEle ; $j++) {
            echo "<input type=\"checkbox\" id=\"checkbox\" name=\"".$allEle['ele_intitule'][$j]."\">
               <label for=\"checkbox\">".$allEle['ele_intitule'][$j]."</label>";
         }
         ?>
      </div>
      <div>
         <?php
         if($nbAllEle!=0){
            echo "<input type=\"submit\" value=\"Supprimer\" id=\"submit\"/>";
         }
         ?>
      </div>
   </form>
</section>
