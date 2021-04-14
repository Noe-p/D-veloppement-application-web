
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

//Information sélection
if(isset($_GET['sel'])){
   $sel=htmlspecialchars(addslashes($_GET['sel']));

   //On verifie que la sélection existe
   $reqSelExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero='$sel';";
   $resSelExist = $mysqli->query($reqSelExist);

   if($resSelExist){
      if($resSelExist->num_rows){
         $reqInfoSel = "SELECT sel_intitule, sel_texteIntro FROM t_selection_sel WHERE sel_numero = '$sel'";
         $resInfoSel = $mysqli->query($reqInfoSel);

         if(!$resInfoSel){
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit();
         }
         else{
            $infoSel = $resInfoSel->fetch_array(MYSQLI_ASSOC);
         }
      }
      else{
         header("Location: admin_selection.php?errorModifSel=4#admin");
         exit();
      }
   }
   else{
      header("Location: admin_selection.php?errorModifSel=2#admin");
      exit();
   }
}

//Sélections
$reqSel = "SELECT DISTINCT sel_numero, sel_intitule, sel_texteIntro, sel_date, com_pseudo
           FROM t_selection_sel";
$resSel = $mysqli->query($reqSel);
$resSel2 = $mysqli->query($reqSel);
$resSel3 = $mysqli->query($reqSel);
$resSel4 = $mysqli->query($reqSel);
$resSel5 = $mysqli->query($reqSel);



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
$resAllEle2 = $mysqli->query($reqAllEle);
$resAllEle3 = $mysqli->query($reqAllEle);

if(!$resAllEle){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Element dans sélection
if(isset($_GET['sel'])){
   if(intval($_GET['sel']) and !empty($_GET['sel'])){
      $sel=htmlspecialchars(addslashes($_GET['sel']));

      $reqSelNom="SELECT sel_intitule FROM t_selection_sel
                  WHERE sel_numero='$sel'";
      $resSelNom = $mysqli->query($reqSelNom);
      if(!$resSelNom){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
      }
      else{
         $selNom = $resSelNom->fetch_array(MYSQLI_ASSOC);
      }

      $reqEleSel = "SELECT DISTINCT ele_numero, ele_intitule
                    FROM t_element_ele
                    JOIN tj_relie_rel USING(ele_numero)
                    WHERE sel_numero='$sel'
                    AND ele_etat='A'";
      $resEleSel = $mysqli->query($reqEleSel);
   }
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
      <a href='admin_selection.php#admin' class='button open'>Sélections</a>
      <a href='admin_element.php#admin' class='button'>Éléments</a>
      <a href='admin_lien.php#admin' class='button'>Liens</a>
   </div>

   <section class='selections'>
      <div class='manage'>

         <div class='ajoutActu'>
            <h3>Ajouter une sélection : </h3>
            <span id='message5'>
            <?php
               if(isset($_GET['errorNewSel'])){
                  if(intval($_GET['errorNewSel']) and !empty($_GET['errorNewSel'])){
                     if($_GET['errorNewSel']==1){
                        echo "<p id='ok'>Sélection ajoutée</p>";
                     }
                     else if($_GET['errorNewSel']==2){
                        echo "La requête à échoué";
                     }
                     else if($_GET['errorNewSel']==3){
                        echo "Entrer un titre et une description";
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
            <form action='action/selection_action.php?input=newSel' method='post'>
               <div>
                  <label for='newSel'>Titre :<br/></label>
                  <input type='text' id='newSel' name='newSel' required >
               </div>
               <div>
                  <label for='descSel'>Description :<br/></label>
                  <textarea rows='6' cols='32' id='descSel' name='descSel' maxlength='500' required></textarea>
               </div>
               <div>
                  <input type='submit' value='Ajouter' id='ajout'/>
               </div>
            </form>
         </div>

         <div class='modifActu'>
            <h3>Modifier une sélection :</h3>
            <span id='message5'>
               <?php
                  if(isset($_GET['errorModifSel'])){
                     if(intval($_GET['errorModifSel']) and !empty($_GET['errorModifSel'])){
                        if($_GET['errorModifSel']==1){
                           echo "<p id='ok'>Sélection modifiée</p>";
                        }
                        else if($_GET['errorModifSel']==2){
                           echo "La requête a échoué";
                        }
                        else if($_GET['errorModifSel']==3){
                           echo "Entrer un titre ou une description";
                        }
                        else if($_GET['errorModifSel']==4){
                           echo "La sélection n'existe pas";
                        }
                        else if($_GET['errorModifSel']==5){
                           echo "Pas de sélection sélectionnée";
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
            <form action='action/selection_action.php?input=id' method='post'  id='selectModif'>
               <select name='modifSel'>
                  <?php
                     if(isset($_GET['sel'])){
                        echo "<option value=''>".$infoSel['sel_intitule']."</option>";
                     }
                     else{
                        echo "<option value=''>Sélection à modifier</option>";
                     }

                     while ($sel5 = $resSel5->fetch_assoc()) {
                        echo "<option value=".$sel5['sel_numero'].">".$sel5['sel_intitule']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Valider' id='buttonValider'/>
            </form>
            <?php
            if(isset($_GET['sel'])){
               echo "<form action='action/selection_action.php?input=modifSel&sel=".$sel."' method='post'>";
               $val=1;
            }
            else{
               echo "<form action='action/selection_action.php?input=modifSel' method='post'>";
               $val=0;
            }
            ?>
               <div>
                  <label for='modifSelTitre'>Titre :<br/></label>
                  <input type='text' id='modifSelTitre' name='modifSelTitre' <?php if($val)echo "placeholder='".$infoSel['sel_intitule']."'"; ?> >
               </div>
               <div>
                  <label for='modifSelDesc'>Description :<br/></label>
                  <textarea rows='6' cols='32' id='modifSelDesc' name='modifSelDesc' maxlength='500' <?php if($val)echo "placeholder='".htmlspecialchars($infoSel['sel_texteIntro'], ENT_QUOTES, 'UTF-8')."'"; ?>></textarea>
               </div>
               <input type='submit' value='Modifier' id='buttonModifier'/>
            </form>
         </div>

         <div class='gereSel'>
            <h3>Gérer les sélections :</h3>
            <span id='message4'>
            <?php
               if(isset($_GET['error'])){
                  if(intval($_GET['error']) and !empty($_GET['error'])){
                     if($_GET['error']==1){
                        echo "<p id='ok'>L'élément à été enlevé de sa sélection</p>";
                     }
                     elseif($_GET['error']==8){
                        echo "<p id='ok'>L'élément à été ajouté dans la sélection</p>";
                     }
                     elseif($_GET['error']==3){
                        echo "l'élément n'est pas dans la sélection";
                     }
                     elseif($_GET['error']==7) {
                        echo "Entrer une sélection";
                     }
                     elseif($_GET['error']==2) {
                        echo "Entrer un élément";
                     }
                     elseif($_GET['error']==4) {
                        echo "La sélection n'existe pas";
                     }
                     elseif($_GET['error']==5) {
                        echo "L'éléments n'existe pas";
                     }
                     elseif($_GET['error']==6) {
                        echo "La requête a échoué";
                     }
                     elseif($_GET['error']==9) {
                        echo "<p id='ok'>La sélection à été supprimée</p>";
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
            <form action='action/selection_action.php?input=activSel' method='post' class='inputPseudoModif' required>
               <select name='selection'>
                  <?php
                  if(isset($_GET['sel'])){
                     if(intval($_GET['sel']) and !empty($_GET['sel'])){
                        echo "<option value='$sel'>".$selNom['sel_intitule']."</option>";
                     }
                  }
                  else{
                     echo "<option value=''>Choisir une sélection</option>";
                  }
                  while ($sel2 = $resSel2->fetch_assoc()) {
                     echo "<option value='".$sel2['sel_numero']."' onclick=\"window.location.href='admin_selection.php?sel=".$sel2['sel_numero']."#admin';\">".$sel2['sel_intitule']."</option>";
                  }
                  ?>
               </select>

               <select name='element'>
                  <option value=''>Choisir un élément à enlever</option>
                  <?php
                  if(isset($_GET['sel'])){
                     if(intval($_GET['sel']) and !empty($_GET['sel'])){
                        while ($eleSel = $resEleSel->fetch_assoc()) {
                           echo "<option value=".$eleSel['ele_numero'].">".$eleSel['ele_intitule']."</option>";
                        }
                     }
                  }
                  else{
                     while ($allEle2 = $resAllEle2->fetch_assoc()) {
                        echo "<option value=".$allEle2['ele_numero'].">".$allEle2['ele_intitule']."</option>";
                     }
                  }
                  ?>
               </select>
               <input type='submit' value='Enlever éléments' id='submit'/>
            </form>

            <form action='action/selection_action.php?input=ajoutEleSel' method='post'>
               <select name='ajoutEleSel_sel'>
                  <option value=''>Choisir une sélection</option>
                  <?php
                     while ($sel3 = $resSel3->fetch_assoc()) {
                        echo "<option value=".$sel3['sel_numero'].">".$sel3['sel_intitule']."</option>";
                     }
                  ?>
               </select>
               <select name='ajoutEleSel_ele'>
                  <option value=''>Choisir un élément à ajouter</option>
                  <?php
                  while ($allEle3 = $resAllEle3->fetch_assoc()) {
                     echo "<option value=".$allEle3['ele_numero'].">".$allEle3['ele_intitule']."</option>";
                  }
                  ?>
               </select>
               <input type='submit' value='Ajouter éléments' id='ajoutEleSel'/>
            </form>

            <form action='action/selection_action.php?input=suppSel' method='post'>
               <select name='suppSel_sel'>
                  <option value=''>Choisir une sélection à supprimer</option>
                  <?php
                     while ($sel4 = $resSel4->fetch_assoc()) {
                        echo "<option value=".$sel4['sel_numero'].">".$sel4['sel_intitule']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Supprimer sélection' id='supprimer'/>
            </form>
         </div>
      </div>

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
         <tbody>
            <?php
               $i=0;
               while ($sel = $resSel->fetch_assoc()) {
                  //CONNEXION A LA BASE
                  require('../connexionBDD.php');

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
                     <form action='action/selection_action.php?input=checkbox' method='post'>
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
            ?>
         </tbody>
      </table>
   </section>

   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
