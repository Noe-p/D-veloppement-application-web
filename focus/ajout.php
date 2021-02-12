<?php
session_start();
require('src/sql/reqAjout.php');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">

      <link rel="stylesheet" href="css/navBar.css" />
      <link rel="stylesheet" href="css/ajout.css" />
      <title>Focus-Ajout</title>
   </head>
   <body>

   <?php require('src/navBar.php'); ?>

   <header>
      <div class="buttonsHeader">
         <a class="button1 open" href="#">Photo</a>
         <a class="button2" href="#">Selection</a>
      </div>

      <section class="photo create open">
         <h2>Publier une photo : </h2>
         <form action="verification.php?verif=publiPhoto" method="post">
            <div>
               <label for="titre">Titre :<br/></label>
               <input type="text" id="titre" name="titre">
            </div>
            <div>
               <label for="description">Description :<br/></label>
               <textarea rows="6" cols="32" id="description" name="description" maxlength="500"></textarea>
            </div>
            <div>
               <label for="img">Choisir une image :<br/></label>
               <input type="file" id="img" name="img" accept="image/png, image/jpeg">
            </div>
            <div class="checkbox">
               <label for="selectionImg">Selection(s) :<br/></label>
               <?php
               for ($i=0; $i < $nbSel; $i++) {
                  echo "<input id=\"checkbox\" type=\"checkbox\" name=\"check[]\" value=\"".$sel['sel_intitule'][$i]."\"/>".$sel['sel_intitule'][$i]."";
               }
               ?>
               <br/>
            </div>
            <div>
               <input class="buttonPub" name="publier" type="submit" value="Publier">
            </div>
         </form>
      </section>

      <section class="selection create">
         <h2>Ajouter une selection : </h2>
         <form action="verification.php?verif=publiSel" method="post">
            <div>
               <label for="nom">Nom :<br/></label>
               <input type="text" id="nom" name="nom">
            </div>
            <div>
               <label for="descriptionSel">Description :<br/></label>
               <textarea rows="6" cols="32" id="descriptionSel" name="descriptionSel" maxlength="500"></textarea>
            </div>
            <div>
               <input class="buttonSel" name="ajouterSel" type="submit" value="Publier">
            </div>
         </form>
      </section>

   </header>

   <script type="text/javascript" src="js/createElement.js"></script>

   </body>
</html>
