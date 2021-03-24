<aside>
   <ul class="navBar" >
      <li><a href="index.php">Home</a></li>
      <li><a href="selection.php">Sélections</a></li>
      <li class="menu compte"><a class="bouton">Compte</a>
         <ul class="sous">
            <?php
            if(isset($_SESSION['pseudo'])){
               echo "<li><a href='profil.php'>Profil</a></li>
               <li><a href='ajout.php'>Ajouter</a></li>
               <li><a href='action.php?action=deconnexion'>Déconnexion</a></li>";
            } else{
               echo "<li><a href='inscription.php'>Inscription</a></li>";
            }
            ?>

         </ul>
      </li>
   </ul>
</aside>
