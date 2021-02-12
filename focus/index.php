<?php
session_start();
require("src/sql/reqIndex.php");


//Element
$resAllEle = mysqli_query($con, "SELECT * FROM t_element_ele NATURAL JOIN tj_relie_rel NATURAL JOIN t_selection_sel ORDER BY ele_numero DESC");

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/home.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus</title>
</head>

<body>

   <?php require('src/navBar.php'); ?>

   <div class="utilisateur">
      <?php if(isset($_SESSION['pseudo'])==false){
         echo "<a href=\"connexion.php\"><img src=\"assets/logos/padlock.png\"></img>Connexion</a>";
      }
      ?>
      <a href="https://noe-philippe.com/"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <header>
      <h1>Focus</h1>
   </header>

   <h2>Dernière Photos :</h2>

   <section>
      <?php
      while($ele = $resAllEle->fetch_array(MYSQLI_ASSOC)){
         echo "<article class=\"imgUser\">
                  <div class=\"headerPublic\">
                     <a href=\"autreUser.php?pseudo=".$ele['com_pseudo']."&amp;selection=Photos\">".$ele['com_pseudo']; echo " </a>
                     <h3>"; echo $ele['ele_intitule']; echo "</h3>
                  </div>
                  <img src=\"assets/img/".$ele['ele_fichierImage']."\">
                  <p>"; echo $ele['ele_descriptif']; echo "</p>
               </article>";
      }

      ?>

   </section>

   <script type="text/javascript" src="js/home.js"></script>
</body>

</html>
