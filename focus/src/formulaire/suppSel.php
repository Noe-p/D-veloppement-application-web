<form class="danger" action="profil.php" method="post">
   <h3>Supprimer sélection(s) : </h3>
   <?php
   if($nbAllEle!=0){
      echo "<p class=\"attention\">La selection doit être vide pour pouvoir la supprimer</p>";
   }
   else{
      echo "<p class=\"attention\">Vous avez aucune sélection</p>";
   }
   ?>
   <div>
      <?php
      require("config.php");

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
      if($nbAllEle!=0){
         echo "<input type=\"submit\" value=\"Supprimer\" id=\"submit\"/>";
      }
      ?>
   </div>
</form>
