
<?php
session_start();

//CONNEXION A LA BASE
require('../connexionBDD.php');

//Sélections
$reqSel = "SELECT DISTINCT sel_numero, sel_intitule, sel_texteIntro, sel_date, com_pseudo
           FROM t_selection_sel";
$resSel = $mysqli->query($reqSel);

if(!$resSel){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}
$mysqli->close();
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

   <table>
      <thead>
         <tr>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Date</th>
            <th>Pseudo</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            $i=0;
            while ($sel = $resSel->fetch_assoc()) {
               //CONNEXION A LA BASE
               require('../connexionBDD.php');

               //premier élément d'une sélection particliere
               $reqFirstEleSel = "SELECT ele_numero FROM t_element_ele
                                  JOIN tj_relie_rel USING(ele_numero)
                                  WHERE sel_numero = '$sel[sel_numero]'
                                  ORDER BY ele_numero ASC
                                  LIMIT 1;";
               $resFirstEleSel = $mysqli->query($reqFirstEleSel);

               if(!$resFirstEleSel){
                  echo "Error: La requête a echoué \n";
                  echo "Errno: " . $mysqli->errno . "\n";
                  echo "Error: " . $mysqli->error . "\n";
                  exit();
               }
               else{
                  $firstEleSel = $resFirstEleSel->fetch_array(MYSQLI_ASSOC);
               }
               $mysqli->close();

               //Test de parité pour l'aternance de couleurs des lignes du tableau
               if(fmod($i,2)==0){
                  echo "<tr onclick=\"document.location='affichageSelection.php?sel_id=".$sel['sel_numero']."&elt_id=".$firstEleSel['ele_numero']."#ancre'\" class='contenu'>";
                  $i=$i+1;
               }
               else{
                  echo "<tr onclick=\"document.location='affichageSelection.php?sel_id=".$sel['sel_numero']."&elt_id=".$firstEleSel['ele_numero']."#ancre'\" class='lignePaire contenu'>";
                  $i=$i+1;
               }
               echo "
                     <td>".$sel['sel_intitule']."</td>
                     <td class='resume'>".$sel['sel_texteIntro']."</td>
                     <td>".$sel['sel_date']."</td>
                     <td>".$sel['com_pseudo']."</td>
                     <td><a href='affichageSelection.php?sel_id=".$sel['sel_numero']."&elt_id=".$firstEleSel['ele_numero']."#ancre'><div class='oeil'></div></a></td>
                  </tr>
               ";
            }
         ?>
      </tbody>
   </table>
   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/navBar.js"></script>
</body>

</html>
