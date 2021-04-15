
<?php
session_start();

if(!isset($_SESSION['login'])){
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

//Information Lien
if(isset($_GET['lie'])){
   $lie=htmlspecialchars(addslashes($_GET['lie']));

   //On verifie que l'actualité existe
   $reqLienExist="SELECT lie_titre FROM t_lien_lie WHERE lie_numero='$lie';";
   $resLienExist = $mysqli->query($reqLienExist);

   if($resLienExist){
      if($resLienExist->num_rows){
         $reqInfoLien = "SELECT lie_titre, lie_url, lie_auteur FROM t_lien_lie WHERE lie_numero = '$lie'";
         $resInfoLien = $mysqli->query($reqInfoLien);

         if(!$resInfoLien){
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit();
         }
         else{
            $infoLien = $resInfoLien->fetch_array(MYSQLI_ASSOC);
         }
      }
      else{
         header("Location: admin_lien.php?errorModifLien=4#admin");
         exit();
      }
   }
   else{
      header("Location: admin_lien.php?errorModifLien=2#admin");
      exit();
   }
}

// Tous les liens
$reqAllLien = "SELECT DISTINCT lie_numero, lie_titre, lie_url, lie_auteur, lie_date, ele_numero
               FROM t_lien_lie
               ORDER BY lie_date DESC";
$resAllLien = $mysqli->query($reqAllLien);
$resAllLien2 = $mysqli->query($reqAllLien);
$resAllLien3 = $mysqli->query($reqAllLien);
$resAllLien4 = $mysqli->query($reqAllLien);

$reqAllEle = "SELECT DISTINCT ele_intitule, ele_numero
              FROM t_element_ele";
$resAllEle = $mysqli->query($reqAllEle);


if(!$resAllEle){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}
//Nb Compte
$reqAllCpt = "SELECT * FROM t_profil_pro";
$resAllCpt = $mysqli->query($reqAllCpt);
$nbCpt = $resAllCpt->num_rows;

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

      <?php
      if($_SESSION['statut']=='A'){
         echo "
            <article class='infosUser'>
               <h2>Informations : </h2>
               <ul>
                  <li><B>Inscrits : </B>".$nbCpt."</li>
                  <li><B>Comptes Administrateur : </B>".$nbCptAdmin."</li>
                  <li><B>Comptes activés : </B>".$nbCptActif."</li>
                  <li><B>Comptes désactivés : </B>".$nbCptDes."</li>
               </ul>
            </article>
         ";
      }
      ?>



   </header>

   <h2 id='admin'>Administration :</h2>

   <div class='buttons'>
      <?php
      if($_SESSION['statut']=='A'){
         echo "<a href='admin_accueil.php#admin' class='button'>Profils</a>";
      }
      ?>
      <a href='admin_actualite.php#admin' class='button'>Actualités</a>
      <a href='admin_selection.php#admin' class='button'>Sélections</a>
      <a href='admin_element.php#admin' class='button'>Éléments</a>
      <a href='admin_lien.php#admin' class='button open'>Liens</a>
   </div>

   <section class='profils'>
      <div class='manage'>

         <!--AJOUTER LIEN-->

         <div>
            <h3>Ajouter un lien : </h3>
            <span id='message5'>
            <?php
               if(isset($_GET['errorNewLien'])){
                  if(intval($_GET['errorNewLien']) and !empty($_GET['errorNewLien'])){
                     if($_GET['errorNewLien']==1){
                        echo "<p id='ok'>Lien ajoutée</p>";
                     }
                     else if($_GET['errorNewLien']==2){
                        echo "La requête à échoué";
                     }
                     else if($_GET['errorNewLien']==3){
                        echo "Entrer un élément, un titre, une description et un auteur";
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
            <form action='action/lien_action.php?input=newLien' method='post'>
               <select name='allEle'>
                  <option value=''>Choisir un élément</option>
                  <?php
                     while ($ele = $resAllEle->fetch_assoc()) {
                        echo "<option value=".$ele['ele_numero'].">".$ele['ele_intitule']."</option>";
                     }
                  ?>
               </select>
               <div>
                  <label for='newLien'>Titre :<br/></label>
                  <input type='text' id='newLien' name='newLien' required >
               </div>
               <div>
                  <label for='url'>URL :<br/></label>
                  <input type='text' id='url' name='url' required >
               </div>
               <div>
                  <label for='auteur'>Auteur:<br/></label>
                  <input type='text' id='auteur' name='auteur' required >
               </div>
               <div>
                  <input type='submit' value='Ajouter' id='ajout'/>
               </div>
            </form>
         </div>

         <!--MODIFIER LIEN-->

         <div>
            <h3>Modifier un lien :</h3>
            <span id='message5'>
               <?php
                  if(isset($_GET['errorModifLien'])){
                     if(intval($_GET['errorModifLien']) and !empty($_GET['errorModifLien'])){
                        if($_GET['errorModifLien']==1){
                           echo "<p id='ok'>Lien modifié</p>";
                        }
                        else if($_GET['errorModifLien']==2){
                           echo "La requête a échoué";
                        }
                        else if($_GET['errorModifLien']==3){
                           echo "Entrer un titre, un url ou un auteur";
                        }
                        else if($_GET['errorModifLien']==4){
                           echo "Le lien n'existe pas";
                        }
                        else if($_GET['errorModifLien']==5){
                           echo "Pas de lien sélectionné";
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
            <form action='action/lien_action.php?input=id' method='post' id='selectModif'>
               <select name='modifLien' onchange='valideButton();'>
                  <?php
                     if(isset($_GET['lie'])){
                        echo "<option value=''>".$infoLien['lie_titre']."</option>";
                     }
                     else{
                        echo "<option value=''>Lien à modifier</option>";
                     }

                     while ($allLien4 = $resAllLien4->fetch_assoc()) {
                        echo "<option value=".$allLien4['lie_numero'].">".$allLien4['lie_titre']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Valider' id='buttonValider'/>
            </form>
            <?php
            if(isset($_GET['lie'])){
               echo "<form action='action/lien_action.php?input=modifLien&lie=".$_GET['lie']."' method='post'>";
               $val=1;
            }
            else{
               echo "<form action='action/lien_action.php?input=modifLien' method='post'>";
               $val=0;
            }
            ?>
               <div>
                  <label for='modifLienTitre'>Titre :<br/></label>
                  <input type='text' id='modifLienTitre' name='modifLienTitre' <?php if($val)echo "placeholder='".$infoLien['lie_titre']."'"; ?> >
               </div>
               <div>
                  <label for='modifLienUrl'>URL :<br/></label>
                  <input type='text' id='modifLienUrl' name='modifLienUrl' <?php if($val)echo "placeholder='".$infoLien['lie_url']."'"; ?> >
               </div>
               <div>
                  <label for='modifLienAuteur'>Auteur :<br/></label>
                  <input type='text' id='modifLienAuteur' name='modifLienAuteur' <?php if($val)echo "placeholder='".$infoLien['lie_auteur']."'"; ?> >
               </div>
               <input type='submit' value='Modifier' id='buttonModifier'/>
            </form>
         </div>

         <!--SUPPRMER LIEN-->

         <div>
            <h3>Supprimer les liens :</h3>
            <span id='message5'>
            <?php
               if(isset($_GET['error'])){
                  if(intval($_GET['error']) and !empty($_GET['error'])){
                     if($_GET['error']==1){
                        echo "<p id='ok'>Modification effectuée</p>";
                     }
                     else if($_GET['error']==3){
                        echo "Le lien n'existe pas";
                     }
                     elseif($_GET['error']==4) {
                        echo "Entrer un lien";
                     }
                     elseif($_GET['error']==2) {
                        echo "La requête a échoué";
                     }
                     elseif($_GET['error']==5) {
                        echo "<p id='ok'>Lien supprimé</p>";
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

            <form action='action/lien_action.php?input=suppLien' method='post'  class='inputPseudoModif'  required>
               <select name='lieSupp'>
                  <option value=''>Lien à supprimer</option>
                  <?php
                     while ($allLien3 = $resAllLien3->fetch_assoc()) {
                        echo "<option value=".$allLien3['lie_numero'].">".$allLien3['lie_titre']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Supprimer' id='supprimer'/>
            </form>
         </div>
      </div>

      <table>
         <thead>
            <tr>
               <th>Titre</th>
               <th>URL</th>
               <th>Auteur</th>
               <th>Date</th>
               <th>Élément</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $i=0;
            while ($allLien = $resAllLien->fetch_assoc()) {
               //CONNEXION A LA BASE
               require('../connexionBDD.php');

               $reqEle2="SELECT ele_intitule, ele_numero FROM t_element_ele
                        WHERE ele_numero='$allLien[ele_numero]';";
               $resEle2=$mysqli->query($reqEle2);

               if(!$resEle2){
                  echo "Error: La requête a echoué \n";
                  echo "Errno: " . $mysqli->errno . "\n";
                  echo "Error: " . $mysqli->error . "\n";
                  exit();
               }
               else{
                  $ele2 = $resEle2->fetch_array(MYSQLI_ASSOC);
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
                     <td>".$allLien['lie_titre']."</td>
                     <td id='urlTab'>".$allLien['lie_url']."</td>
                     <td>".$allLien['lie_auteur']."</td>
                     <td>".$allLien['lie_date']."</td>
                     <td>".$ele2['ele_intitule']."</td>
               </tr>";
            }
            ?>
         </tbody>
      </table>
   </section>

   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/valideButton.js"></script>
   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
