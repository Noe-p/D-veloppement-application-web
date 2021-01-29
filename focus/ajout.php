<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">

      <link rel="stylesheet" href="css/navBar.css" />
      <link rel="stylesheet" href="css/ajout.css" />
      <title>Focus-Ajout</title>
   </head>
   <body>

      <?php include("navBar.php"); ?>


      <section class="ajout">
         <h2>Publier une photo : </h2>
         <form action="/my-handling-form-page" method="post">
            <div>
               <label for="titre">Titre:</label>
               <input type="text" id="titre" name="titre">
            </div>
            <div>
               <label for="description">Description :</label>
               <input type="text" id="description" name="password" maxlength="500">
            </div>
            <div>
               <label for="img">Choisir une image :</label>
               <input type="file" id="img" name="img" accept="image/png, image/jpeg">
            </div>
            <div>
               <label for="selectionImg">Choisir une selection :</label>
               <select name="selectionImg" id="selectionImg">
                  <option value="Paysage">Paysage</option>
                  <option value="Portrait">Portrait</option>
                  <option value="Monochrome">Monochrome</option>
                  <option value="Foret">Foret</option>
                  <option value="Mer">Mer</option>
                  <option value="Brest">Brest</option>
               </select>
            </div>

            <div>
               <input class="buttonConnexion" type="submit" value="Publier">
            </div>
         </form>
      </section>
   </body>
</html>
