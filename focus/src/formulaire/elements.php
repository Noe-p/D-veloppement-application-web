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
