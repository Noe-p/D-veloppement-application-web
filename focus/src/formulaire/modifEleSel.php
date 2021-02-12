<form action="profil.php" method="post">
   <h3>Modifier les élements dans les sélections : </h3>
   <div>
      <?php
         require("config.php");
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
            echo "<p class=\"attention\">Vous avez aucun élément</p>";
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
