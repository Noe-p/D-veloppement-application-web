<?php
session_start();
require('src/sql/reqAutreUser.php');
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

      <header>

         <div class="buttonInfos">
            <a class="buttonProfil open" href="#">Profil</a>
         </div>

         <?php
            if($nbPre==0){
               echo "<style type=\"text/css\">.information.open .organisation {display: none;} </style>";
            }
            else{
               echo "<style type=\"text/css\">.information.open .organisation {display: flex;} </style>";
            }
         ?>
         <div class="information open">
            <section>
               <h2>
                  <?php echo $_GET['pseudo'] . ' :'; ?>
               </h2>
                  <article class="infosUser">
                     <ul>
                        <li><B>Nom :</B> <?php echo $profil['pro_nom'] ?> </li>
                        <li><B>Pénom :</B> <?php echo $profil['pro_prenom'] ?></li>
                        <li><B>Mail :</B> <?php echo $profil['pro_mail'] ?></li>
                        <li><B>Membre depuis le :</B> <?php echo $profil['pro_date'] ?></li>
                     </ul>
                  </article>
            </section>

            <section class="organisation">
               <h2>Où nous trouver : </h2>
                  <article class="infosUser">
                     <ul>
                        <li><B>Nom :</B> <?php echo $pres['pre_nomStruct'] ?> </li>
                        <li><B>Adresse :</B> <?php echo $pres['pre_adresse'] ?> </li>
                        <li><B>Mail :</B> <?php echo $pres['pre_adresseMail'] ?> </li>
                        <li><B>Téléphone :</B> <?php echo $pres['pre_numeroTel'] ?> </li>
                        <li><B>Horaire d'ouverture :</B> <?php echo $pres['pre_horaireOuverture'] ?> </li>
                        <li><B>Decription :</B> <?php echo $pres['pre_texte'] ?></li>
                     </ul>
                  </article>
            </section>
         </div>

      </header>

      <div id="selProfil" class="buttonsSelection">
         <?php echo "<a href=\"autreUser.php?pseudo=".$_GET['pseudo']."&amp;selection=Photos#selProfil\">Photos</a>" ?>
         <?php
         while($sel = $resSel->fetch_array(MYSQLI_ASSOC)){
            echo "<a href=\"autreUser.php?pseudo=".$_GET['pseudo']."&amp;selection=".$sel['sel_intitule']."#selProfil\">".$sel['sel_intitule']."</a>";
         }
         ?>
      </div>
      <h2><?php echo $_GET['selection']; ?> :</h2>

      <section class="publication">
         <?php
         if($_GET['selection']!='Photos'){
            while($ele = $resEle->fetch_array(MYSQLI_ASSOC)){
               echo "<article class=\"imgUser\">
                        <div class=\"headerPublic\">
                           <a href=\"#\">"; echo $_GET['pseudo']; echo " </a>
                           <h3>"; echo $ele['ele_intitule']; echo "</h3>
                        </div>
                        <img src=\"assets/img/".$ele['ele_fichierImage']."\">
                        <p>"; echo $ele['ele_descriptif']; echo "</p>
                     </article>";
            }
         }
         else{
            while($ele = $resAllEle->fetch_array(MYSQLI_ASSOC)){
               echo "<article class=\"imgUser\">
                        <div class=\"headerPublic\">
                           <a href=\"#\">"; echo $_GET['pseudo']; echo " </a>
                           <h3>"; echo $ele['ele_intitule']; echo "</h3>
                        </div>
                        <img src=\"assets/img/".$ele['ele_fichierImage']."\">
                        <p>"; echo $ele['ele_descriptif']; echo "</p>
                     </article>";
            }
         }
         ?>
      </section>
      <script type="text/javascript" src="js/createElement.js"></script>
      <script type="text/javascript" src="js/navBar.js"></script>
   </body>
</html>
