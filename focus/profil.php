<?php
session_start();
require('src/sql/reqPro.php');
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Focus-Compte</title>

      <link rel="stylesheet" href="css/profil.css" />
      <link rel="stylesheet" href="css/navBar.css" />
   </head>
   <body>


      <?php require('src/navBar.php'); ?>

      <!-- HEADER -->

      <header>
         <?php
            if($profil['pro_statut']=='R'){
               echo "<style type=\"text/css\"> .button2{display: none;} </style>";
            }
         ?>
         <div class="buttonsHeader">
            <a class="button1 open" href="#">Profil</a>
            <a class="button2" href="#">Administration</a>
            <a class="button3" href="#">Modifier</a>
         </div>

         <div class="administration create">
            <?php require('src/administration.php'); ?>
         </div>

         <div class="information create open">
            <?php require('src/information.php'); ?>
         </div>

         <div class="modifier create">
            <?php require('src/modifier.php'); ?>
         </div>

      </header>

      <!-- PUBLICATION -->

      <div id="selProfil" class="buttonsSelection">
         <a href="profil.php?selection=Photos#selProfil">Photos</a>
         <?php
         for ($j=0; $j <$nbSel ; $j++) {
            echo "<a href=\"profil.php?selection=".$sel['sel_intitule'][$j]."#selProfil\">".$sel['sel_intitule'][$j]."</a>";
         }
         ?>
      </div>

      <h2><?php echo $_GET['selection']; ?> :</h2>
      <p>
         <?php
         if($_GET['selection'] != 'Photos'){
            echo $texteSel['sel_texteIntro']." :";
         }
         else{
            echo "Dernière photos publiées : ";
         }
         ?>
      </p>

      <section class="publication">
         <?php
         if($_GET['selection']!='Photos'){
            for ($j=0; $j <$nbEle ; $j++) {
               echo "<article class=\"imgUser\">
                        <div class=\"headerPublic\">
                           <a href=\"#\">"; echo $_SESSION['pseudo']; echo " </a>
                           <h3>"; echo $ele['ele_intitule'][$j]; echo "</h3>
                        </div>
                        <img src=\"assets/img/".$ele['ele_fichierImage'][$j]."\">
                        <p>"; echo $ele['ele_descriptif'][$j]; echo "</p>
                     </article>";
            }
         }
         else{
            for ($j=0; $j <$nbAllEle ; $j++) {
               echo "<article class=\"imgUser\">
                        <div class=\"headerPublic\">
                           <a href=\"#\">"; echo $_SESSION['pseudo']; echo " </a>
                           <h3>"; echo $allEle['ele_intitule'][$j]; echo "</h3>
                        </div>
                        <img src=\"assets/img/".$allEle['ele_fichierImage'][$j]."\">
                        <p>"; echo $allEle['ele_descriptif'][$j]; echo "</p>
                     </article>";
            }
         }
         ?>
      </section>

      <script type="text/javascript" src="js/createElement.js"></script>
      <script type="text/javascript" src="js/navBar.js"></script>
      <script type="text/javascript" src="js/checkPass.js"></script>

   </body>
</html>
