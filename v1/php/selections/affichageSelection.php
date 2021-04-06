
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../../css/selection.css" />
   <link rel="stylesheet" href="../../css/navBar.css" />
   <link rel="stylesheet" href="../../css/footer.css" />
   <title>Focus</title>
</head>

<body>

   <aside>
      <ul class="navBar" >
         <li><a href="../../index.php">Home</a></li>
         <li><a href="selection.php" class="bouton">Sélections</a></li>
         <?php
         if(isset($_SESSION['login'])){
            echo "<li class='menu compte'><a>Compte<img class='lock' src='../../assets/logos/padlock_bc.png'></img></a>";
         }else{
            echo "<li class='menu compte'><a>Compte<img class='lock' src='../../assets/logos/padlock_bo.png'></img></a>";
         }
         ?>
            <ul class="sous">
               <?php
               if(isset($_SESSION['login'])){
                  echo "<li><a href='../compte/admin_accueil.php'>Profil</a></li>
                  <li><a href='../ajout.php'>Ajouter</a></li>
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

   <?php
   //CONNEXION A LA BASE
   require('../connexionBDD.php');
   $nbRowsPrec=0;
   $nbRowsSuiv=0;
   $nbEle=0;

   if(!empty($_GET['elt_id']) and is_int((int)$_GET['elt_id']) and is_int((int)$_GET['sel_id']) and isset($_GET['sel_id']) and isset($_GET['elt_id'])){
      $sel_id=(int)htmlspecialchars($_GET['sel_id']);
      $elt_id=(int)htmlspecialchars($_GET['elt_id']);

      //Element
      $reqEle = "SELECT sel_intitule, ele_intitule, ele_descriptif, ele_date, ele_fichierImage, com_pseudo, ele_etat
                 FROM t_element_ele
                 JOIN tj_relie_rel USING(ele_numero)
                 JOIN t_selection_sel USING(sel_numero)
                 WHERE ele_numero=$elt_id
                 AND sel_numero=$sel_id";
      $resEle = $mysqli->query($reqEle);
      $nbEle = $resEle->num_rows;

      if(!$resEle){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
      }
      else{
         $ele = $resEle->fetch_array(MYSQLI_ASSOC);
      }

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

      //Compte tous les elements d'une selection
      $reqCptEle = "SELECT ele_numero
                    FROM t_element_ele
                    JOIN tj_relie_rel USING(ele_numero)
                    WHERE sel_numero='$_GET[sel_id]'";
      $resCptEle = $mysqli->query($reqCptEle);

      if(!$resCptEle){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
      }

   }
   $mysqli->close();
   ?>

   <?php
      //Affichage de l'élément
      if(!empty($elt_id) and $nbEle){
         echo "
            <h2 id='ancre'>".$ele['sel_intitule']." :</h2>
            <section>
               <article class='imgUser'>
                  <div class='headerPublic'>
                     <a href='#'>".$ele['com_pseudo']."</a>
                     <h3>".$ele['ele_intitule']."</h3>
                  </div>
                  <img src='../../assets/img/".$ele['ele_fichierImage']."' alt='img1'>
                  <p>".$ele['ele_descriptif']."</p>
                  <p>".$ele['ele_date']."</p>
               </article>
            </section>";
      }

      //Affichage des fleches si les éléments suiv/prec existent
      if($nbEle){
         if($nbRowsSuiv){
            echo "<a href='affichageSelection.php?sel_id=".$sel_id."&elt_id=".$eleSuiv['ele_numero']."#ancre'><img class='flecheDroite' src='../../assets/logos/flecheDroite.png' alt='flecheDroite'></a>";
         }
         if($nbRowsPrec){
            echo "<a href='affichageSelection.php?sel_id=".$sel_id."&elt_id=".$elePrec['ele_numero']."#ancre'><img class='flecheGauche' src='../../assets/logos/flecheGauche.png' alt='flecheGauche'></a>";
         }

         //Indice elements
         echo "<section class='indice'>";
         while ($cptEle = $resCptEle->fetch_assoc()) {
            if($cptEle['ele_numero']==$elt_id){
               echo "<a class='indiceB' href='affichageSelection.php?sel_id=".$sel_id."&elt_id=".$cptEle['ele_numero']."#ancre'></a>";
            }
            else{
               echo "<a class='indiceG' href='affichageSelection.php?sel_id=".$sel_id."&elt_id=".$cptEle['ele_numero']."#ancre'></a>";
            }
         }
         echo "</section>";
      }
      elseif(!isset($_GET['elt_id']) or !isset($_GET['sel_id'])){
         echo "<h1 class='emptySel'>Vous devez mentionner une sélection et un élément</h1>";
      }
      elseif (empty($_GET['sel_id'])) {
         echo "<h1 class='emptySel'>La sélection n'existe pas</h1>";
      }
      elseif(empty($_GET['elt_id'])){
         echo "<h1 class='emptySel'>La sélection est vide</h1>";
      }
      elseif(!is_int($_GET['elt_id']) or !is_int($_GET['sel_id'])){
         echo "<h1 class='emptySel'>Le numéro de l'élément/sélection est invalide</h1>";
      }
      else{
         echo "<h1 class='emptySel'>Element inconnu</h1>";
      }
   ?>

   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>

</html>
