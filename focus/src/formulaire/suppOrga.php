<form class="danger" action="verification.php?verif=suppOrga" method="post">
   <h3>Supprimer organisation : </h3>
   <div>
      <?php
      if($nbPre==0){
         echo "<p class='attention'>Vous avez aucune organisation à supprimer";
      }
      else{
         echo "<input type='checkbox' name='checkbox[]' value='".$pres['pre_nomStruct']."'>
            <label for='checkbox'>".$pres['pre_nomStruct']."</label>";
      }
      ?>
   </div>
   <div>
      <?php
      if($nbPre!=0){
         echo "<input type='submit' value='Supprimer' id='submit'/>";
      }
      ?>
   </div>
</form>
