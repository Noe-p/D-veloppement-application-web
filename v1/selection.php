
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
         <li class="menu compte"><a>Compte</a>
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

   <?php require('php/footer.php'); ?>

   <script type="text/javascript" src="js/navBar.js"></script>
</body>

</html>
