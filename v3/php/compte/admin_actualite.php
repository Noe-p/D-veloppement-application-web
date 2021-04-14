
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

// Toutes les Actualités:
$reqAllActu = "SELECT DISTINCT *
               FROM t_actualite_actu
               ORDER BY actu_date DESC";
$resAllActu = $mysqli->query($reqAllActu);
$resAllActu2 = $mysqli->query($reqAllActu);
$resAllActu3 = $mysqli->query($reqAllActu);
$resAllActu4 = $mysqli->query($reqAllActu);



if(!$resAllActu){
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
      <a href='admin_actualite.php#admin' class='button open'>Actualités</a>
      <a href='admin_selection.php#admin' class='button'>Sélections</a>
      <a href='admin_element.php#admin' class='button'>Éléments</a>
      <a href='admin_accueil.php#admin' class='button'>Liens</a>
   </div>

   <section class='profils'>
      <div class='manage'>
         <div class='ajoutActu'>
            <h3>Ajouter une actualité : </h3>
            <span id='message5'>
            <?php
               if(isset($_GET['errorNewActu'])){
                  if(intval($_GET['errorNewActu']) and !empty($_GET['errorNewActu'])){
                     if($_GET['errorNewActu']==1){
                        echo "<p id='ok'>Actualité ajoutée</p>";
                     }
                     else if($_GET['errorNewActu']==2){
                        echo "La requête à échoué";
                     }
                     else if($_GET['errorNewActu']==3){
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
            <form action='action/actualite_action.php?input=newActu' method='post'>
               <div>
                  <label for='newActu'>Titre :<br/></label>
                  <input type='text' id='newActu' name='newActu' required >
               </div>
               <div>
                  <label for='descriptionActu'>Description :<br/></label>
                  <textarea rows='6' cols='32' id='descriptionActu' name='descriptionActu' maxlength='500' required></textarea>
               </div>
               <div>
                  <input type='submit' value='Ajouter' id='ajout'/>
               </div>
            </form>
         </div>

         <div class="modifActu">
            <h3>Modifier une actualité :</h3>
            <span id='message5'>
               <?php
                  if(isset($_GET['errorModifActu'])){
                     if(intval($_GET['errorModifActu']) and !empty($_GET['errorModifActu'])){
                        if($_GET['errorNewActu']==1){
                           echo "<p id='ok'>Actualité modifiée</p>";
                        }
                        else if($_GET['errorModifActu']==2){
                           echo "La requête a échoué";
                        }
                        else if($_GET['errorModifActu']==3){
                           echo "Entrer un titre ou une description";
                        }
                        else if($_GET['errorModifActu']==4){
                           echo "L'actualité n'existe pas";
                        }
                        else if($_GET['errorModifActu']==5){
                           echo "Pas d'actualité sélectionnée";
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
            <form action='action/actualite_action.php?input=modifActu' method='post'  class='inputPseudoModif'  required>
               <select name='modifActu'>
                  <option value=''>Actualité à modifier</option>
                  <?php
                     while ($allActu4 = $resAllActu4->fetch_assoc()) {
                        echo "<option value=".$allActu4['actu_numero'].">".$allActu4['actu_titre']."</option>";
                     }
                  ?>
               </select>
               <div>
                  <label for='modifActuTitre'>Titre :<br/></label>
                  <input type='text' id='modifActuTitre' name='modifActuTitre' >
               </div>
               <div>
                  <label for='modifActuDesc'>Description :<br/></label>
                  <textarea rows='6' cols='32' id='modifActuDesc' name='modifActuDesc' maxlength='500'></textarea>
               </div>
               <input type='submit' value='Modifier' id='buttonModifier'/>
            </form>
         </div>

         <div class='danger'>
            <h3>Gérer les actualités :</h3>
            <span id='message5'>
            <?php
               if(isset($_GET['error'])){
                  if(intval($_GET['error']) and !empty($_GET['error'])){
                     if($_GET['error']==1){
                        echo "<p id='ok'>Modification effectuée</p>";
                     }
                     else if($_GET['error']==3){
                        echo "L'actualité' n'existe pas";
                     }
                     elseif($_GET['error']==4) {
                        echo "Entrer une actualité";
                     }
                     elseif($_GET['error']==2) {
                        echo "La requête a échoué";
                     }
                     elseif($_GET['error']==5) {
                        echo "<p id='ok'>Actualité supprimée</p>";
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

            <form action='action/actualite_action.php?input=liste' method='post'  class='inputPseudoModif'  required>
               <select name='actuActive'>
                  <option value=''>Actualité à activer/désactiver</option>
                  <?php
                     while ($allActu2 = $resAllActu2->fetch_assoc()) {
                        echo "<option value=".$allActu2['actu_numero'].">".$allActu2['actu_titre']."</option>";
                     }
                  ?>
               </select>
               <input type='submit' value='Activer/Désactiver' id='submit'/>
            </form>

            <form action='action/actualite_action.php?input=suppActu' method='post'  class='inputPseudoModif'  required>
               <select name='actuSupp'>
                  <option value=''>Actualité à supprimer</option>
                  <?php
                     while ($allActu3 = $resAllActu3->fetch_assoc()) {
                        echo "<option value=".$allActu3['actu_numero'].">".$allActu3['actu_titre']."</option>";
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
               <th>Activée</th>
               <th>Pseudo</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php
            $i=0;
            while ($allActu = $resAllActu->fetch_assoc()) {
               //Test de parité pour l'aternance de couleurs des lignes du tableau
               if(fmod($i,2)==0){
                  echo "<tr>";
                  $i=$i+1;
               }
               else{
                  echo "<tr class='lignePaire'>";
                  $i=$i+1;
               }echo "
                  <form action='action/actualite_action.php?input=checkbox&actuDes=".$allActu['actu_numero']."' method='post'>
                     <td>".$allActu['actu_titre']."</td>
                     <td>".$allActu['actu_texte']."</td>
                     <td>".$allActu['actu_date']."</td>
                     <td>";
                     if($allActu['actu_etat']=='A'){
                        echo "<input type='checkbox' id='checkboxActu' name='checkbox[]' value='A' checked/>";
                     }
                     else{
                        echo "<input type='checkbox' id='checkboxActu' name='checkbox[]' value='A'";
                     }
                     echo "</td>
                     <td>".$allActu['com_pseudo']."</td>
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
