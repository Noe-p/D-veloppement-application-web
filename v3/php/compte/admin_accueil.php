
<?php
session_start();

if(!isset($_SESSION['login'])){
   header("Location: ../connexion/session.php");
   exit();
}

if($_SESSION['statut']=='R'){
   header("Location: admin_actualite.php");
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

//Information Profil
if(isset($_GET['pseudo'])){
   $pseudo=htmlspecialchars(addslashes($_GET['pseudo']));

   //On verifie que le profil existe
   $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
   $resPseudoExist = $mysqli->query($reqPseudoExist);

   if($resPseudoExist){
      if($resPseudoExist->num_rows){
         $reqInfoPro = "SELECT pro_nom, pro_prenom, pro_mail FROM t_profil_pro WHERE com_pseudo = '$pseudo'";
         $resInfoPro = $mysqli->query($reqInfoPro);

         if(!$resInfoPro){
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit();
         }
         else{
            $infoPro = $resInfoPro->fetch_array(MYSQLI_ASSOC);
         }
      }
      else{
         header("Location: admin_accueil.php?errorModifPro=4#admin");
         exit();
      }
   }
   else{
      header("Location: admin_accueil.php?errorModifPro=2#admin");
      exit();
   }
}

//Tous les compte utilisateur
$reqAllCpt = "SELECT * FROM t_profil_pro
              WHERE com_pseudo != '$_SESSION[login]'
              ORDER BY pro_date DESC";
$resAllCpt = $mysqli->query($reqAllCpt);
$resAllCpt2 = $mysqli->query($reqAllCpt);
$resAllCpt3 = $mysqli->query($reqAllCpt);
$resAllCpt4 = $mysqli->query($reqAllCpt);
$resAllCpt5 = $mysqli->query($reqAllCpt);
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

if(!$resAllCpt or !$resCptDes or ! $resCptActif or !$resCptAdmin){
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
         <a href="admin_modifUser.php"><button type="button" id="modifUser" name="button">Modifier</button></a>
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
      <a href='admin_element.php#admin' class='button'>Éléments</a>
      <a href='admin_lien.php#admin' class='button'>Liens</a>
   </div>
   <section class='profils'>
      <div class='manage managePro'>
         <div class='modifActu'>
            <h3>Modifier un profil :</h3>
            <span id='message5'>
               <?php
                  if(isset($_GET['errorModifPro'])){
                     if(intval($_GET['errorModifPro']) and !empty($_GET['errorModifPro'])){
                        if($_GET['errorModifPro']==1){
                           echo "<p id='ok'>Profil modifié</p>";
                        }
                        else if($_GET['errorModifPro']==2){
                           echo "La requête a échoué";
                        }
                        else if($_GET['errorModifPro']==3){
                           echo "Entrer un nom, un prénom ou un mail";
                        }
                        else if($_GET['errorModifPro']==4){
                           echo "Le profil n'existe pas";
                        }
                        else if($_GET['errorModifPro']==5){
                           echo "Pas de profil sélectionné";
                        }
                        else{
                           echo "Erreur non reconnue";
                        }
                     }
                     else{
                        echo "Erreur non reconnue";
                     }
                  }
               ?>
            </span>
            <form action='action/comptes_action.php?input=id' method='post'  id='selectModif'>
               <select name='modifPro'>
                  <?php
                     if(isset($_GET['pseudo'])){
                        echo "<option value=''>".$pseudo."</option>";
                     }
                     else{
                        echo "<option value=''>Profil à modifier</option>";
                     }

                     while ($allCpt5 = $resAllCpt5->fetch_assoc()) {
                        echo "<option value=".$allCpt5['com_pseudo'].">".$allCpt5['com_pseudo']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Valider' id='buttonValider'/>
            </form>
            <?php
            if(isset($_GET['pseudo'])){
               echo "<form action='action/comptes_action.php?input=modifPro&pseudo=".$pseudo."' method='post'>";
               $val=1;
            }
            else{
               echo "<form action='action/comptes_action.php?input=modifPro' method='post'>";
               $val=0;
            }
            ?>
               <div>
                  <label for='modifNom'>Nom :<br/></label>
                  <input type='text' id='modifNom' name='modifNom' <?php if($val)echo "placeholder='".$infoPro['pro_nom']."'"; ?>>
               </div>
               <div>
                  <label for='modifPrenom'>Prénom:<br/></label>
                  <input type='text' id='modifPrenom' name='modifPrenom' <?php if($val)echo "placeholder='".$infoPro['pro_prenom']."'"; ?>>
               </div>
               <div>
                  <label for='modifMail'>Mail :<br/></label>
                  <input type='text' id='modifMail' name='modifMail' <?php if($val)echo "placeholder='".$infoPro['pro_mail']."'"; ?>>
               </div>
               <input type='submit' value='Modifier' id='buttonModifier'/>
            </form>
         </div>

         <div class='gereCompte'>
            <h3>Gérer les profils :</h3>
            <span id='message4'>
            <?php
            if(isset($_GET['error'])){
               if(intval($_GET['error']) and !empty($_GET['error'])){
                  if($_GET['error']==1){
                     echo "<p id='ok'>Modification effectuée</p>";
                  }
                  elseif($_GET['error']==8) {
                     echo "<p id='ok'>Compte supprimé</p>";
                  }
                  elseif($_GET['error']==3) {
                     echo "Le pseudo n'existe pas";
                  }
                  elseif($_GET['error']==4) {
                     echo "Entrer un pseudo";
                  }
                  elseif($_GET['error']==2) {
                     echo "La requête a échoué";
                  }
                  elseif($_GET['error']==6) {
                     echo "Cocher une seule case";
                  }
                  elseif($_GET['error']==5) {
                     echo "Cocher une case";
                  }
                  elseif($_GET['error']==7) {
                     echo "Les sélections doivent être vides";
                  }
                  else{
                     echo "Erreur non reconnue";
                  }
               }
               else{
                  echo "Erreur non reconnue";
               }
            }
            ?>
            </span>

            <form action='action/comptes_action.php?input=liste' method='post'  class='inputPseudoModif'>
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

            <form action='action/comptes_action.php?input=modifStatut' method='post'  class='modifSatut'>
               <select name='modifStatut'>
                  <option value=''>Choisir un compte</option>
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

            <form action='action/comptes_action.php?input=suppCompte' method='post'  class='inputPseudoModif'>
               <select name='suppCompte'>
                  <option value=''>Compte à supprimer</option>
                  <?
                  while ($allCpt3 = $resAllCpt3->fetch_assoc()) {
                     echo "<option value='".$allCpt3['com_pseudo']."'>".$allCpt3['com_pseudo']."</option>";
                  }
                  ?>
               </select>
               <input type='submit' value='Supprimer un compte' id='supprimer' class="suppCompte"/>
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
                     <form action='action/comptes_action.php?input=checkbox&loginDes=".$allCpt2['com_pseudo']."' method='post'>
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
   </section>


   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
