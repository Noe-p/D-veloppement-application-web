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
               if($_SESSION['statut']=='A'){
                  echo "<li><a href='../compte/admin_accueil.php?'>Profil</a></li>";
               }
               echo"
               <li><a href='../compte/admin_actualite.php?#admin'>Actualités</a></li>
               <li><a href='../compte/admin_selection.php?#admin'>Sélections</a></li>
               <li><a href='../compte/admin_element.php?#admin'>Éléments</a></li>
               <li><a href='../compte/admin_lien.php?#admin'>Liens</a></li>
               <li><a id='deconnexion' href='../connexion/deconnexion.php?#admin'>Déconnexion</a></li>";
            } else{
               echo "<li><a href='../connexion/inscription.php'>Inscription</a></li>
               <li><a href='../connexion/session.php'>Connexion</a></li>";
            }
            ?>

         </ul>
      </li>
   </ul>
</aside>
