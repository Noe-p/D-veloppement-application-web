
<?php
require('php/requetes.php');
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/home.css" />
   <link rel="stylesheet" href="css/navBar.css" />
   <link rel="stylesheet" href="css/footer.css" />
   <title>Focus</title>
</head>

<body>

   <aside>
      <ul class="navBar" >
         <li><a href="index.php" class="bouton">Home</a></li>
         <li><a href="selection.php">Sélections</a></li>
         <li class='menu compte'><a>Compte</a>
            <ul class="sous">
               <?php
               if(isset($_SESSION['pseudo'])){
                  echo "<li><a href='profil.php'>Profil</a></li>
                  <li><a href='ajout.php'>Ajouter</a></li>
                  <li><a href='action.php?action=deconnexion'>Déconnexion</a></li>";
               } else{
                  echo "<li><a href='inscription.php'>Inscription</a></li>
                  <li><a href='connexion.php'>Connexion</a></li>";
               }
               ?>

            </ul>
         </li>
      </ul>
   </aside>


   <div class="utilisateur">
      <?php
      if(isset($_SESSION['pseudo'])==false){
         echo "<a href='inscription.php'><img src='assets/logos/padlock.png'></img>Inscription</a>";
      }
      else{
         echo "<a href='connexion.php'><img src='assets/logos/padlock.png'></img>Connexion</a>";
      }
      ?>
      <a href="#contact"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <header>
      <h1>Focus</h1>
   </header>

   <h2>Dernières Actualité :</h2>

   <section>
      <?php
         while ($actu = $resActu->fetch_assoc()) {
            echo "<article class='actuUser'>
                     <div class='headerPublic'>
                        <a href='#''>".$actu['com_pseudo']."</a>
                        <h3>".$actu['actu_titre']."</h3>
                     </div>
                     <p>".$actu['actu_texte']."</p>
                     <p>date : ".$actu['actu_date']."</p>
                  </article>";
         }

      ?>
   </section>

   <?php require('php/footer.php'); ?>

   <script type="text/javascript" src="js/home.js"></script>
</body>

</html>
