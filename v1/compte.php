<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Focus-Compte</title>

      <link rel="stylesheet" href="css/compte.css" />
      <link rel="stylesheet" href="css/navBar.css" />
   </head>
   <body>


      <?php require('php/navBar.php'); ?>


      <header>
         <div class="buttonInfos">
            <a class="buttonProfil open" href="#">Profil</a>
            <a class="buttonAdmin" href="#">Administration</a>
         </div>

         <div class="administration">
            <form action="/my-handling-form-page" method="post">
               <h2>Connexion administrateur :</h2>
               <div>
                  <label for="adresseMail">Mail :</label>
                  <input type="email" id="adresseMail" name="email">
               </div>
               <div>
                  <label for="pass">Mot de passe :</label>
                  <input type="current-password" id="pass" name="password" minlength="8" required>
               </div>
               <div>
                  <input class="buttonConnexion" type="submit" value="Connexion">
               </div>
            </form>
         </div>

         <div class="information open">
            <section>
               <h2>Nono : </h2>
                  <article class="infosUser">
                     <ul>
                        <li>Nom : Philippe</li>
                        <li>Pénom : Noé</li>
                        <li>Mail : noefrgv@gmail.com</li>
                        <li>Nombre publication : 3</li>
                     </ul>
                  </article>
            </section>
         </div>

      </header>

      <h2>Publications : </h2>

      <section class="publication">
         <article class="imgUser">
            <div class="headerPublic">
               <a href="#">Nono</a>
               <h3>Rue de Brest</h3>
            </div>
            <img src="assets/img/img1.jpg" alt="img1">
            <p>Lors d'une petite ballade dans les rue de brest, du text sk,hjfklebzas:kfhbleajrqskhfcbdlqjdqkhvcb</p>
         </article>

         <article class="imgUser">
            <div class="headerPublic">
               <a href="#">Tata</a>
               <h3>Pluie sur les grues</h3>
            </div>
            <img src="assets/img/img2.jpg" alt="img2">
            <p>Quand la tempête fait rage à brest</p>
         </article>

         <article class="imgUser">
            <div class="headerPublic">
               <a href="#">Zozo</a>
               <h3>Rue de Brest</h3>
            </div>
            <img src="assets/img/img3.jpg" alt="img3">
            <p></p>
         </article>

      </section>

      <script type="text/javascript" src="js/functionCreate.js"></script>
      <script type="text/javascript" src="js/navBar.js"></script>
   </body>
</html>
