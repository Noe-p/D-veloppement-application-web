
<?php
session_start();

if(!isset($_SESSION['login'])){
   ("Location: ../connexion/session.php");
   exit();
}

//CONNEXION A LA BASE
require('../connexionBDD.php');

//Information Utilisateur
$reqInfoUser = "SELECT * FROM t_profil_pro WHERE com_pseudo = '$_SESSION[login]'";
$resInfoUser = $mysqli->query($reqInfoUser);

if(!$resInfoUser){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}
else{
   $infoUser = $resInfoUser->fetch_array(MYSQLI_ASSOC);
}

//Sélections
$reqSel = "SELECT DISTINCT sel_numero, sel_intitule, sel_texteIntro, sel_date, com_pseudo
           FROM t_selection_sel";
$resSel = $mysqli->query($reqSel);
$resSel2 = $mysqli->query($reqSel);

if(!$resSel){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

// Tous les éléments:
$reqAllEle = "SELECT DISTINCT ele_numero, ele_intitule
              FROM t_element_ele";
$resAllEle = $mysqli->query($reqAllEle);
if(!$resAllEle){
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
   <title>Profil</title>

   <link rel="stylesheet" href="../../css/admin.css" />
   <link rel="stylesheet" href="../../css/navBar.css" />
   <link rel="stylesheet" href="../../css/footer.css" />

</head>
<body>
   <?php require('../navBarConnexion.php'); ?>


   <header>
      <h2><?php echo $_SESSION['login'];?> :</h2>
      <article class='infosUser'>
         <ul>
            <li><B>Nom : </B><?php echo $infoUser['pro_nom'];?></li>
            <li><B>Pénom : </B><?php echo $infoUser['pro_prenom'];?></li>
            <li><B>Mail : </B><?php echo $infoUser['pro_mail'];?></li>
            <li><B>Statut : </B><?php if($infoUser['pro_statut']=='A'){
                                          echo "Administrateur";}
                                       else{echo "Responsable";}?></li>
            <li><B>Membre depuis le : </B><?php echo $infoUser['pro_date'];?></li>
         </ul>
      </article>
   </header>

   <?php
   if($_SESSION['statut']=='A'){
      echo "
      <h2 id='admin'>Administration :</h2>

      <div class='buttons'>
      <a href='admin_accueil.php#admin' class='button'>Profils</a>
      <a href='admin_accueil.php#admin' class='button'>Actualités</a>
      <a href='admin_selection.php#admin' class='button open'>Sélections</a>
      <a href='admin_accueil.php#admin' class='button'>Éléments</a>
      <a href='admin_accueil.php#admin' class='button'>Liens</a>
      </div>

      <section class='selections'>
      <span id='message4'>";
      if(isset($_GET['error'])){
         if(intval($_GET['error']) and !empty($_GET['error'])){
            if($_GET['error']==3){
               echo "l'élément n'est pas dans la sélection";
            }
            elseif($_GET['error']==1) {
               echo "Entrer une sélection";
            }
            elseif($_GET['error']==2) {
               echo "Entrer un élément";
            }
            else{
               echo "Erreur non reconnue";
            }
         }
         else{
            echo "Erreur non reconnue";
         }
      }echo "</span>
      <form action='selection_action.php?input=liste' method='post' class='inputPseudoModif' required>
         <select name='selection'>
            <option value=''>Sélection</option>";
         while ($sel2 = $resSel2->fetch_assoc()) {
            echo "<option value=".$sel2['sel_numero'].">".$sel2['sel_intitule']."</option>";
         }echo"
         </select>
         <input type='text' id='element' name='element' required placeholder='Éléments'>
         <input type='submit' value='Enlever éléments' id='submit'/>
      </form>

      <table>
         <thead>
            <tr>
               <th>Titre</th>
               <th>Date</th>
               <th>Pseudo</th>
               <th>Élements activés</th>
               <th>Élements désactivés</th>
               <th></th>
            </tr>
         </thead>
         <tbody>";
               $i=0;
               while ($sel = $resSel->fetch_assoc()) {
                  //CONNEXION A LA BASE
                  require('../connexionBDD.php');

                  //premier élément d'une sélection particliere
                  $reqEleSel = "SELECT * FROM t_element_ele
                                     JOIN tj_relie_rel USING(ele_numero)
                                     WHERE sel_numero = '$sel[sel_numero]'";
                  $resEleSel = $mysqli->query($reqEleSel);
                  $resEleSel2 = $mysqli->query($reqEleSel);

                  if(!$resEleSel){
                     echo "Error: La requête a echoué \n";
                     echo "Errno: " . $mysqli->errno . "\n";
                     echo "Error: " . $mysqli->error . "\n";
                     exit();
                  }
                  $mysqli->close();

                  //Test de parité pour l'aternance de couleurs des lignes du tableau
                  if(fmod($i,2)==0){
                     echo "<tr>";
                     $i=$i+1;
                  }
                  else{
                     echo "<tr class='lignePaire'>";
                     $i=$i+1;
                  }echo "
                     <form action='selection_action.php?input=checkbox' method='post'>
                        <td>".$sel['sel_intitule']."</td>
                        <td>".$sel['sel_date']."</td>
                        <td>".$sel['com_pseudo']."</td>
                        <td class='checkEle'>";
                        while ($eleSel = $resEleSel->fetch_assoc()) {
                           if($eleSel['ele_etat']=='A'){
                              echo "<div><input type='checkbox' id='checkbox' value=".$eleSel['ele_numero']." name='checkbox[]'/>
                                    <label for='checkbox'>".$eleSel['ele_intitule']."</label></div>";
                           }
                        }
                        echo "</td>
                        <td>";
                        while ($eleSel2 = $resEleSel2->fetch_assoc()) {
                           if($eleSel2['ele_etat']=='D'){
                              echo "<div><input type='checkbox' id='checkbox' name='checkbox[]' />
                                    <label for='checkbox'>".$eleSel2['ele_intitule']."</label></div>";
                           }
                        }
                        echo "</td>
                        <td><input type='submit' value='Enlever' id='submit'/></td>
                     </form>
                  </tr>";
               }
      echo "
         </tbody>
      </table>
      </section>";

   }
   ?>

   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
