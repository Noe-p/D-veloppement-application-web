<form class="desactiver" action="profil.php" method="post">
   <h3>Désactiver élément(s) : </h3>
   <div>
      <?php
      if($nbEleAct==0 && $nbEle!=0){
         echo "<p class=\"attention\">Toutes les éléments sont désactivés</p>";
      }
      else{
         echo "<p class=\"attention\">Vous avez aucun élément</p>";
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
