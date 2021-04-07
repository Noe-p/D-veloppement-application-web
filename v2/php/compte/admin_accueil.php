
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

   <?php
   if($_SESSION['statut']=='A'){
      echo "
      <h2>Administration :</h2>

      <div class='buttons'>
         <a class='button1 open'>Profils</a>
         <a class='button2'>Actualités</a>
         <a class='button3'>Sélections</a>
         <a class='button4'>Éléments</a>
         <a class='button5'>Liens</a>
      </div>

      <section class='actualite create'>
         <h3>Aucune actualité</h3>
      </section>

      <section class='selections create'>
         <h3>Aucune sélection</h3>
      </section>

      <section class='elements create'>
         <h3>Aucun élément</h3>
      </section>

      <section class='liens create'>
         <h3>Aucun lien</h3>
      </section>

      <section class='profils create open'>
         <form action='modif.php?input=text' method='post' class='inputPseudoModif'>
            <td><input type='text' id='pseudoActive' name='pseudoActive' placeholder='Pseudo à activer' required></td>
            <td><input type='submit' value='Modifier' id='submit'/></td>
         </form>

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
                        <form action='modif.php?input=checkbox&loginDes=".$allCpt['com_pseudo']."' method='post'>
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
         </table>
      </section>";
   }
   ?>

   <?php require('../footer.php'); ?>

   <script type="text/javascript" src="../../js/createElement.js"></script>
   <script type="text/javascript" src="../../js/navBar.js"></script>

</body>
</html>
