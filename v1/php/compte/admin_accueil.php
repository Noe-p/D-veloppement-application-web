
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

//Tous les Elements de l'utilisateur
$reqAllEleUser = "SELECT * FROM t_element_ele
                JOIN tj_relie_rel USING(ele_numero)
                JOIN t_selection_sel USING(sel_numero)
                WHERE com_pseudo='$_SESSION[login]'";
$resAllEleUser = $mysqli->query($reqAllEleUser);

if(!$resAllEleUser){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Toutes les actualités de l'utilisateur
$reqAllActuUser = "SELECT * FROM t_actualite_actu
                   WHERE com_pseudo='$_SESSION[login]'";
$resAllActuUser = $mysqli->query($reqAllActuUser);

if(!$resAllActuUser){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Tous les compte utilisateur
$reqAllCpt = "SELECT * FROM t_profil_pro";
$resAllCpt = $mysqli->query($reqAllCpt);

if(!$resAllCpt){
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

   <div class="buttons">
      <a class="button1 open">Photos</a>
      <a class="button2">Actualités</a>
      <?php if($_SESSION['statut']=='A'){ echo "<a class='button3'>Administration</a>";}?>
   </div>


   <section class="publication create open ">
      <?php
      if($resAllEleUser->num_rows==0){
         echo "<h2>Aucun élément de publié</h2>";
      }
      while ($allEleUser = $resAllEleUser->fetch_assoc()) {
         echo "<article class='imgUser'>
                  <div class='headerPublic'>
                     <a href='#'>".$allEleUser['com_pseudo']."</a>
                     <h3>".$allEleUser['ele_intitule']."</h3>
                  </div>
                  <img src='../../assets/img/".$allEleUser['ele_fichierImage']."' alt='img1'>
                  <p>".$allEleUser['ele_descriptif']."</p>
                  <p>".$allEleUser['ele_date']."</p>
               </article>";
      }
      ?>
   </section>

   <section class="actualite create ">
      <?php
         if($resAllActuUser->num_rows==0){
            echo "<h2>Aucune actualité de publié</h2>";
         }
         while ($allActuUser = $resAllActuUser->fetch_assoc()) {
            echo "<article class='actuUser'>
                     <div class='headerPublic'>
                        <a href='#''>".$allActuUser['com_pseudo']."</a>
                        <h3>".$allActuUser['actu_titre']."</h3>
                     </div>
                     <p>".$allActuUser['actu_texte']."</p>
                     <p>".$allActuUser['actu_date']."</p>
                  </article>";
         }
      ?>
   </section>

   <?php
   if($_SESSION['statut']=='A'){
      echo "

      <table class='admin create'>
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
         <tbody>";
               $i=0;
               while ($allCpt = $resAllCpt->fetch_assoc()) {

                  //Test de parité pour l'aternance de couleurs des lignes du tableau
                  if(fmod($i,2)==0){
                     echo "<tr>";
                     $i=$i+1;
                  }
                  else{
                     echo "<tr class='lignePaire'>";
                     $i=$i+1;
                  }echo "
                     <form action='modif.php?loginDes=".$allCpt['com_pseudo']."' method='post'>
                        <td>".$allCpt['com_pseudo']."</td>
                        <td>".$allCpt['pro_nom']."</td>
                        <td>".$allCpt['pro_prenom']."</td>
                        <td>".$allCpt['pro_mail']."</td>
                        <td>";
                        if($allCpt['pro_validite']=='A'){
                           echo "<input type='checkbox' id='checkbox' name='checkbox[]' value='A' checked/>";
                        }
                        else{
                           echo "<input type='checkbox' id='checkbox' name='checkbox[]' value='A'";
                        }
                        echo "</td>
                        <td>".$allCpt['pro_statut']."</td>
                        <td>".$allCpt['pro_date']."</td>
                        <td><input type='submit' value='Modifier' id='submit'/></td>
                     </form>
                  </tr>";
               }
      echo "
         </tbody>
      </table>";
   }
   ?>

   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/createElement.js"></script>
   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
