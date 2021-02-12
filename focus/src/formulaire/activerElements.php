<form class="activer" action="profil.php" method="post">
   <h3>Activer éléments(s): </h3>
   <div>
      <?php
      if($nbEleDes==0 && $nbEle!=0){
         echo "<p class=\"attention\">Toutes les éléments sont activés</p>";
      }
      else{
         echo "<p class=\"attention\">Vous avez aucun élément</p>";
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
