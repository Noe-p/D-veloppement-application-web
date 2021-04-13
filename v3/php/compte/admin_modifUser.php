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
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../../css/connexion.css" />
   <link rel="stylesheet" href="../../css/navBar.css" />
   <link rel="stylesheet" href="../../css/footer.css" />


   <title>Focus</title>
</head>

<body>

   <?php require('../navBarConnexion.php'); ?>


   <section class="modifCompte createCompte">
      <form action="modifUser_action.php" method="post">
         <h2>Modifier le compte</h2>
         <div>
            <label for="pseudo"><B>Pseudo :</B><br/></label>
            <?php echo "<input type='text' id='pseudo' name='pseudo' placeholder='".$_SESSION['login']."'>";?>
            <span id='message2'></span>
         </div>
         <div>
            <label for="nom"><B>Nom :</B><br/></label>
            <?php echo "<input type='text' id='nom' name='nom' placeholder='".$infoUser['pro_nom']."'>";?>
         </div>
         <div>
            <label for="prenom"><B>Prénom :</B><br/></label>
            <?php echo "<input type='text' id='prenom' name='prenom' placeholder='".$infoUser['pro_prenom']."'>";?>
         </div>
         <div>
            <label for="createAdresseMail"><B>Mail :</B><br/></label>
            <?php echo "<input type='email' id='createAdresseMail' name='email' placeholder='".$infoUser['pro_mail']."'>";?>
         </div>
         <div>
            <label for="mdp"><B>Mot de passe pour confirmer :</B><br/></label>
            <input type="password" id="create_mdp" name="mdp" minlength="8" placeholder="8 caractères minimum" required >
         </div>
         <div>
            <input class="buttonConnexion" type="submit" value="Modifier" id="submit"/>
         </div>
      </form>
   </section>



   <script type="text/javascript" src="../../js/navBar.js"></script>
</body>

</html>
