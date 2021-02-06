<aside>
   <ul class="navBar" >
      <li><a href="index.php">Home</a></li>
      <li class="menu"><a>Sélections</a>
         <ul class="sous">
            <li><a href="selections.php">Paysage</a></li>
            <li><a href="#">Portrait</a></li>
            <li><a href="#">Monochrome</a></li>
            <li><a href="#">Foret</a></li>
            <li><a href="#">Mer</a></li>
            <li><a href="#">Brest</a></li>
            <li><a href="#">Rennes</a></li>
            <li><a href="#">Rennes</a></li>
            <li><a href="#">Rennes</a></li>
            <li><a href="#">Rennes</a></li>
            <li><a href="#">Rennes</a></li>
            <li><a href="#">Rennes</a></li>
            <li><a href="#">Rennesardssss</a></li>
         </ul>
      </li>
      <li><a href="actualite.php">Actualités</a></li>
      <li class="menu compte"><a class="bouton">Compte</a>
         <ul class="sous">
            <?php
            if(isset($_SESSION['pseudo'])){
               echo "<li><a href=\"profil.php?selection=Photos\">Profil</a></li>
               <li><a href=\"ajout.php\">Ajouter</a></li>
               <li><a href=\"deconnexion.php\">Déconnexion</a></li>";
            } else{
               echo "<li><a href=\"connexion.php\">Connexion</a></li>";
            }
            ?>

         </ul>
      </li>
   </ul>
</aside>
