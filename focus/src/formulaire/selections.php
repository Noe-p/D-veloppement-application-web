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
