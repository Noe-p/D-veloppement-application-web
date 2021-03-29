
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

   <?php
   //CONNEXION A LA BASE
   require('php/connexionBDD.php');

   $sel_id=htmlspecialchars(addslashes($_GET['sel_id']));
   $elt_id=htmlspecialchars(addslashes($_GET['elt_id']));
   $nbRowsPrec=0;
   $nbRowsSuiv=0;

   if(!empty($elt_id)){
      //Element suivant :
      $reqEleSuiv = "SELECT ele_numero FROM t_element_ele
                     JOIN tj_relie_rel USING(ele_numero)
                     JOIN t_selection_sel USING(sel_numero)
                     WHERE sel_numero = $sel_id
                     AND ele_numero > $elt_id
                     LIMIT 1";
      $resEleSuiv = $mysqli->query($reqEleSuiv);
      $nbRowsSuiv = $resEleSuiv->num_rows;


      if(!$resEleSuiv){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
      }
      else{
         $eleSuiv = $resEleSuiv->fetch_array(MYSQLI_ASSOC);
      }

      //Element précédent :
      $reqElePrec = "SELECT ele_numero FROM t_element_ele
                     JOIN tj_relie_rel USING(ele_numero)
                     JOIN t_selection_sel USING(sel_numero)
                     WHERE sel_numero = $sel_id
                     AND ele_numero < $elt_id
                     ORDER BY ele_numero DESC
                     LIMIT 1";
      $resElePrec = $mysqli->query($reqElePrec);
      $nbRowsPrec = $resElePrec->num_rows;

      if(!$resElePrec){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
      }
      else{
         $elePrec = $resElePrec->fetch_array(MYSQLI_ASSOC);
      }

   }

   $mysqli->close();
   ?>

   <?php
      if(!empty($elt_id) and $nbRowsSuiv==1){
         echo "
            <h1>".$ele['sel_intitule']."</h1>
            <section>
               <article class='imgUser'>
                  <div class='headerPublic'>
                     <a href='#'>".$ele['com_pseudo']."</a>
                     <h3>".$ele['ele_intitule']."</h3>
                  </div>
                  <img src='assets/img/".$ele['ele_fichierImage']."' alt='img1'>
                  <p>".$ele['ele_descriptif']."</p>
                  <p>".$ele['ele_date']."</p>
               </article>
            </section>";
      }

      //Affichage des fleches si les éléments suiv/prec existent
      if($nbEle){
         if($nbRowsSuiv){
            echo "<a href='affichageSelection.php?sel_id=".$sel_id."&elt_id=".$eleSuiv['ele_numero']."'><img class='flecheDroite' src='assets/logos/flecheDroite.png' alt='flecheDroite'></a>";
         }
         if($nbRowsPrec){
            echo "<a href='affichageSelection.php?sel_id=".$sel_id."&elt_id=".$elePrec['ele_numero']."'><img class='flecheGauche' src='assets/logos/flecheGauche.png' alt='flecheGauche'></a>";
         }
      }
      elseif(empty($elt_id)){
         echo "<h1 class='emptySel'>La sélection est vide</h1>";
      }
      else{
         echo "<h1 class='emptySel'>Element inconnu</h1>";
      }

   ?>

   <?php require('php/footer.php'); ?>

   <script type="text/javascript" src="js/navBar.js"></script>
   <script type="text/javascript" src="js/animCarousel.js"></script>

</body>

</html>
