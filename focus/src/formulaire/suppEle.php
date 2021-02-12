<form class="danger" action="profil.php" method="post">
   <h3>Supprimer élément(s) : </h3>
   <div>
      <?php
      if($nbAllEle==0){
         echo "<p class=\"attention\">Vous avez aucun éléments à supprimer";
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
