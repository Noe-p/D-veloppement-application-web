
<?php
require('php/requetes.php');
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/selection.css" />
   <link rel="stylesheet" href="css/navBar.css" />
   <link rel="stylesheet" href="css/footer.css" />
   <title>Focus</title>
</head>

<body>

   <aside>
      <ul class="navBar" >
         <li><a href="index.php">Home</a></li>
         <li><a href="selection.php" class="bouton">Sélections</a></li>
         <?php
         if(isset($_SESSION['pseudo'])){
            echo "<li class='menu compte'><a>Compte<img class='lock' src='assets/logos/padlock_bc.png'></img></a>";
         }else{
            echo "<li class='menu compte'><a>Compte<img class='lock' src='assets/logos/padlock_bo.png'></img></a>";
         }
         ?>
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

   <h1><?php echo "$ele[sel_intitule] :"; ?></h1>
   <section>
      <article class='imgUser'>
         <div class="headerPublic">
            <a href='#'><?php echo "$ele[com_pseudo]"; ?></a>
            <h3><?php echo "$ele[ele_intitule]"; ?></h3>
         </div>
         <img <?php echo "src='assets/img/".$ele['ele_fichierImage']."'"; ?> alt="img1">
         <p><?php echo "$ele[ele_descriptif]"; ?></p>
         <p><?php echo "$ele[ele_date]"; ?></p>
      </article>
   </section>

   <a href="#"><img class="flecheDroite" src="assets/logos/flecheDroite.png" alt="flecheDroite"></a>
   <a href="#"><img class="flecheGauche" src="assets/logos/flecheGauche.png" alt="flecheGauche"></a>

   <?php require('php/footer.php'); ?>

   <script type="text/javascript" src="js/navBar.js"></script>
</body>

</html>
