<aside>
   <ul class="navBar" >
      <li><a href="../../index.php">Home</a></li>
      <li><a href="../selections/selection.php">Sélections</a></li>
      <?php
      if(isset($_SESSION['login'])){
         echo "<li class='menu compte'><a class='bouton'>Compte<img class='lock' src='../../assets/logos/padlock_wc.png'></img></a>";
      }else{
         echo "<li class='menu compte'><a class='bouton'>Compte<img class='lock' src='../../assets/logos/padlock_wo.png'></img></a>";
      }
      ?>
         <ul class="sous">
            <?php
            if(isset($_SESSION['login'])){
               echo "<li><a href='../compte/admin_accueil.php'>Profil</a></li>
               <li><a href='ajout.php'>Ajouter</a></li>
               <li><a href='../connexion/deconnexion.php'>Déconnexion</a></li>";
            } else{
               echo "<li><a href='../connexion/inscription.php'>Inscription</a></li>
               <li><a href='../connexion/session.php'>Connexion</a></li>";
            }
            ?>

         </ul>
      </li>
   </ul>
</aside>
