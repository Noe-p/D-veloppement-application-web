
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

//Tous les éléments
$reqAllEle = "SELECT DISTINCT ele_intitule, ele_date, ele_date, ele_etat, ele_fichierImage, ele_numero, ele_descriptif FROM t_element_ele
           JOIN tj_relie_rel USING(ele_numero)
           JOIN t_selection_sel USING(sel_numero)
           ORDER BY ele_date DESC;";
$resAllEle = $mysqli->query($reqAllEle);
$resAllEle2 = $mysqli->query($reqAllEle);
$resAllEle3 = $mysqli->query($reqAllEle);
$resAllEle3 = $mysqli->query($reqAllEle);
$resAllEle4 = $mysqli->query($reqAllEle);


if(!$resAllEle){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Toutes les Sélections
$reqSel = "SELECT DISTINCT sel_numero, sel_intitule, sel_texteIntro, sel_date, com_pseudo
           FROM t_selection_sel";
$resSel = $mysqli->query($reqSel);

if(!$resSel){
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
      <a href='admin_element.php#admin' class='button open'>Éléments</a>
      <a href='admin_accueil.php#admin' class='button'>Liens</a>
   </div>

   <section class='profils'>
      <div class='manage'>
         <div class='ajoutActu'>
            <h3>Ajouter un Élément : </h3>
            <span id='message5'>
            <?php
               if(isset($_GET['errorNewEle'])){
                  if(intval($_GET['errorNewEle']) and !empty($_GET['errorNewEle'])){
                     if($_GET['errorNewEle']==1){
                        echo "<p id='ok'>Élément ajouté</p>";
                     }
                     else if($_GET['errorNewEle']==2){
                        echo "La requête à échoué";
                     }
                     else if($_GET['errorNewEle']==3){
                        echo "Entrer une sélection, un titre, une description et une image";
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
            <form action='element_action.php?input=newEle' method='post'>
               <select name='allSel'>
                  <option value=''>Choisir une sélection</option>
                  <?php
                     while ($sel = $resSel->fetch_assoc()) {
                        echo "<option value=".$sel['sel_numero'].">".$sel['sel_intitule']."</option>";
                     }
                  ?>
               </select>
               <div>
                  <label for='newEle'>Titre :<br/></label>
                  <input type='text' id='newEle' name='newEle' required >
               </div>
               <div>
                  <label for='descEle'>Description :<br/></label>
                  <textarea rows='6' cols='32' id='descEle' name='descEle' maxlength='500' required></textarea>
               </div>
               <div>
                  <label for="img">Choisir une image :<br/></label>
                  <input type="file" id="img" name="img" accept="image/png, image/jpeg">
               </div>
               <div>
                  <input type='submit' value='Ajouter' id='ajout'/>
               </div>
            </form>
         </div>

         <div class='modifActu'>
            <h3>Modifier un élément :</h3>
            <span id='message5'>
               <?php
                  if(isset($_GET['errorModifEle'])){
                     if(intval($_GET['errorModifEle']) and !empty($_GET['errorModifEle'])){
                        if($_GET['errorModifEle']==1){
                           echo "<p id='ok'>Élément modifié</p>";
                        }
                        else if($_GET['errorModifEle']==2){
                           echo "La requête a échoué";
                        }
                        else if($_GET['errorModifEle']==3){
                           echo "Entrer un titre, une description ou une photo";
                        }
                        else if($_GET['errorModifEle']==4){
                           echo "L'élément n'existe pas";
                        }
                        else if($_GET['errorModifEle']==5){
                           echo "Pas d'élément sélectionné";
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
            <form action='element_action.php?input=modifEle' method='post'  class='inputPseudoModif'  required>
               <select name='modifEle'>
                  <option value=''>Élément à modifier</option>
                  <?php
                     while ($allEle2 = $resAllEle2->fetch_assoc()) {
                        echo "<option value=".$allEle2['ele_numero'].">".$allEle2['ele_intitule']."</option>";
                     }
                  ?>
               </select>
               <div>
                  <label for='modifEleTitre'>Titre :<br/></label>
                  <input type='text' id='modifEleTitre' name='modifEleTitre' >
               </div>
               <div>
                  <label for='modifEleDesc'>Description :<br/></label>
                  <textarea rows='6' cols='32' id='modifEleDesc' name='modifEleDesc' maxlength='500'></textarea>
               </div>
               <div>
                  <label for="modifImg">Choisir une image :<br/></label>
                  <input type="file" id="modifImg" name="modifImg" accept="image/png, image/jpeg">
               </div>
               <input type='submit' value='Modifier' id='buttonModifier'/>
            </form>
         </div>

         <div class='danger'>
            <h3>Gérer les éléments :</h3>
            <span id='message5'>
            <?php
               if(isset($_GET['error'])){
                  if(intval($_GET['error']) and !empty($_GET['error'])){
                     if($_GET['error']==1){
                        echo "<p id='ok'>Modification effectuée</p>";
                     }
                     else if($_GET['error']==3){
                        echo "L'élément n'existe pas";
                     }
                     elseif($_GET['error']==4) {
                        echo "Entrer un élément";
                     }
                     elseif($_GET['error']==2) {
                        echo "La requête a échoué";
                     }
                     elseif($_GET['error']==5) {
                        echo "<p id='ok'>Élément supprimée</p>";
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

            <form action='element_action.php?input=activeEle' method='post'  class='inputPseudoModif'  required>
               <select name='eleActive'>
                  <option value=''>Élément à activer/désactiver</option>
                  <?php
                     while ($allEle3 = $resAllEle3->fetch_assoc()) {
                        echo "<option value=".$allEle3['ele_numero'].">".$allEle3['ele_intitule']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Activer/Désactiver' id='submit'/>
            </form>

            <form action='element_action.php?input=suppEle' method='post'  class='inputPseudoModif'  required>
               <select name='eleSupp'>
                  <option value=''>Élément à supprimer</option>
                  <?php
                     while ($allEle4 = $resAllEle4->fetch_assoc()) {
                        echo "<option value=".$allEle4['ele_numero'].">".$allEle4['ele_intitule']."</option>";
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
               <th>Description</th>
               <th>Date</th>
               <th>Activé</th>
               <th>Image</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php
            $i=0;
            while ($allEle = $resAllEle->fetch_assoc()) {
               //Test de parité pour l'aternance de couleurs des lignes du tableau
               if(fmod($i,2)==0){
                  echo "<tr>";
                  $i=$i+1;
               }
               else{
                  echo "<tr class='lignePaire'>";
                  $i=$i+1;
               }echo "
                  <form action='element_action.php?input=checkboxEleDes&eleDes=".$allEle['ele_numero']."' method='post'>
                     <td>".$allEle['ele_intitule']."</td>
                     <td>".$allEle['ele_descriptif']."</td>
                     <td>".$allEle['ele_date']."</td>
                     <td>";
                     if($allEle['ele_etat']=='A'){
                        echo "<input type='checkbox' id='checkboxEle' name='checkbox[]' value='A' checked/>";
                     }
                     else{
                        echo "<input type='checkbox' id='checkboxEle' name='checkbox[]' value='A'";
                     }
                     echo "</td>
                     <td>".$allEle['ele_fichierImage']."</td>
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
