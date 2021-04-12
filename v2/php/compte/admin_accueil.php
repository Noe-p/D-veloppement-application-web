
<?php
session_start();

if((!isset($_SESSION['login'])) or ($_SESSION['statut']=='R')){
   header("Location: ../connexion/session.php");
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

//Tous les compte utilisateur
$reqAllCpt = "SELECT * FROM t_profil_pro";
$resAllCpt = $mysqli->query($reqAllCpt);
$resAllCpt2 = $mysqli->query($reqAllCpt);
$resAllCpt3 = $mysqli->query($reqAllCpt);
$resAllCpt4 = $mysqli->query($reqAllCpt);
$nbCpt = $resAllCpt->num_rows;


if(!$resAllCpt){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Nb compte actif
$reqCptActif= "SELECT * FROM t_profil_pro WHERE pro_validite='A'";
$resCptActif = $mysqli->query($reqCptActif);
$nbCptActif = $resCptActif->num_rows;

//Nb compte désactivé
$reqCptDes= "SELECT * FROM t_profil_pro WHERE pro_validite='D'";
$resCptDes = $mysqli->query($reqCptDes);
$nbCptDes = $resCptDes->num_rows;

//Nb compte Admin
$reqCptAdmin= "SELECT * FROM t_profil_pro WHERE pro_statut='A'";
$resCptAdmin = $mysqli->query($reqCptAdmin);
$nbCptAdmin = $resCptAdmin->num_rows;

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
      <article class='infosUser'>
         <h2><?php echo $_SESSION['login'];?> :</h2>
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
      <article class='infosUser'>
         <h2>Informations : </h2>
         <ul>
            <li><B>Inscrits : </B><?php echo $nbCpt; ?></li>
            <li><B>Comptes Administrateur : </B><?php echo $nbCptAdmin; ?></li>
            <li><B>Comptes activés : </B><?php echo $nbCptActif; ?></li>
            <li><B>Comptes désactivés : </B><?php echo $nbCptDes; ?></li>
         </ul>
      </article>


   </header>

   <h2 id='admin'>Administration :</h2>

   <div class='buttons'>
      <a href='admin_accueil.php#admin' class='button open'>Profils</a>
      <a href='admin_actualite.php#admin' class='button'>Actualités</a>
      <a href='admin_selection.php#admin' class='button'>Sélections</a>
      <a href='admin_accueil.php#admin' class='button'>Éléments</a>
      <a href='admin_accueil.php#admin' class='button'>Liens</a>
   </div>

   <section class='profils'>
      <div class='manage'>
         <div class='gereCompte'>
            <h3>Gérer les comptes :</h3>
            <span id='message4'>
            <?php
            if(isset($_GET['error'])){
               if(intval($_GET['error']) and !empty($_GET['error'])){
                  if($_GET['error']==3){
                     echo "Le pseudo n'existe pas";
                  }
                  elseif($_GET['error']==1) {
                     echo "Entrer un pseudo";
                  }
                  elseif($_GET['error']==2) {
                     echo "La requête a échoué";
                  }
                  elseif($_GET['error']==4) {
                     echo "Cocher une seule case";
                  }
                  elseif($_GET['error']==5) {
                     echo "Cocher une case";
                  }
                  else{
                     echo "Erreur non reconnue";
                  }
               }
               else{
                  echo "Erreur non reconnue";
               }
            }?>
            </span>

            <form action='comptes_action.php?input=liste' method='post'  class='inputPseudoModif'>
               <select name='pseudoActive'>
                  <option value=''>Compte à activer/désactiver</option>
                  <?php
                  while ($allCpt = $resAllCpt->fetch_assoc()) {
                     echo "<option value=".$allCpt['com_pseudo'].">".$allCpt['com_pseudo']."</option>";
                  }
                  ?>
               </select>
               <input type='submit' value='Activer/Désactiver' id='submit'/>
            </form>

            <form action='comptes_action.php?input=modifStatut' method='post'  class='modifSatut'>
               <select name='modifStatut'>
                  <option value=''>Pseudo</option>
                  <?php
                  while ($allCpt4 = $resAllCpt4->fetch_assoc()) {
                     echo "<option value=".$allCpt4['com_pseudo'].">".$allCpt4['com_pseudo']."</option>";
                  }
                  ?>
               </select>
               <div>
                 <input type='checkbox' id='modifStatutA' name='modifStatutA'>
                 <label for='modifStatutA'>A</label>
               </div>
               <div>
                 <input type='checkbox' id='modifStatutR' name='modifStatutR'>
                 <label for='modifStatutR'>R</label>
               </div>
               <input type='submit' value='Modifier' id='submit'/>
            </form>

            <form action='comptes_action.php?input=suppCompte' method='post'  class='inputPseudoModif'>
               <select name='suppCompte'>
                  <option value=''>Compte à supprimer</option>
                  <?php
                  while ($allCpt3 = $resAllCpt3->fetch_assoc()) {
                     echo "<option value=".$allCpt3['com_pseudo'].">".$allCpt3['com_pseudo']."</option>";
                  }
                  ?>
               </select>
               <input type='submit' value='Supprimer' id='submit'/>
            </form>
         </div>
      </div>

      <table>
         <thead>
            <tr>
               <th>Pseudo</th>
               <th>Nom</th>
               <th>Prénom</th>
               <th>Mail</th>
               <th class='vs'>Actif</th>
               <th class='vs'>Statut</th>
               <th>Date</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php
               $i=0;
               while ($allCpt2 = $resAllCpt2->fetch_assoc()) {

                  //Test de parité pour l'aternance de couleurs des lignes du tableau
                  if(fmod($i,2)==0){
                     echo "<tr>";
                     $i=$i+1;
                  }
                  else{
                     echo "<tr class='lignePaire'>";
                     $i=$i+1;
                  }echo "
                     <form action='comptes_action.php?input=checkbox&loginDes=".$allCpt2['com_pseudo']."' method='post'>
                        <td>".$allCpt2['com_pseudo']."</td>
                        <td>".$allCpt2['pro_nom']."</td>
                        <td>".$allCpt2['pro_prenom']."</td>
                        <td>".$allCpt2['pro_mail']."</td>
                        <td>";
                        if($allCpt2['pro_validite']=='A'){
                           echo "<input type='checkbox' id='checkbox' name='checkbox[]' value='A' checked/>";
                        }
                        else{
                           echo "<input type='checkbox' id='checkbox' name='checkbox[]' value='A'";
                        }
                        echo "</td>
                        <td>".$allCpt2['pro_statut']."</td>
                        <td>".$allCpt2['pro_date']."</td>
                        <td><input type='submit' value='Modifier' id='submit'/></td>
                     </form>
                  </tr>";
               }
            ?>
         </tbody>
      </table>
   </section>"


   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
