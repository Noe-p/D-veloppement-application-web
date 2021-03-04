
<?php
require('php/requetes.php');
session_start();
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

   <?php require('php/navBar.php'); ?>

   <div class="utilisateur">
      <?php
      if(isset($_SESSION['pseudo'])==false){
         echo "<a href='connexion.php'><img src='assets/logos/padlock.png'></img>Connexion</a>";
      }
      ?>
      <a href="#contact"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <header>
      <h1>Focus</h1>
   </header>

   <h2>Dernière Actualités :</h2>

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
