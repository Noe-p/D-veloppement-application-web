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

   <div class="modifInfo">
      <section class="modifCompte createCompte">
         <form action="action/modifUser_action.php?input=info" method="post">
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
            <div class='mdp_confirm'>
               <label for="mdp_valide"><B>Mot de passe pour confirmer :</B><br/></label>
               <input type="password" id="mdp_valide" name="mdp_valide" minlength="8" placeholder="8 caractères minimum" required >
            </div>
            <div>
               <input class="buttonConnexion" type="submit" value="Modifier" id="submit"/>
            </div>
         </form>
      </section>

      <section class="modifMdp createCompte">
         <form action="action/modifUser_action.php?input=mdp" method="post">
            <h2>Modifier le mot de passe</h2>
            <span id='message4'>
            <?php
            if(isset($_GET['error'])){
               if(intval($_GET['error']) and !empty($_GET['error'])){
                  if($_GET['error']==1){
                     echo "Entrer un mot de passe pour confirmer";
                  }
                  elseif($_GET['error']==2){
                     echo "Le mot de passe n'est pas bon";
                  }
                  elseif($_GET['error']==3){
                     echo "Les mots de passes ne sont pas identiques";
                  }
                  elseif($_GET['error']==4){
                     echo "La reqête à échoué";
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
            <div>
               <label for="mdp"><B>Nouveau de passe :</B><br/></label>
               <input type="password" id="create_mdp" name="mdp" minlength="8" placeholder="8 caractères minimum" onkeyup='check_pass();' required >
            </div>
            <div>
               <label for="confirm_mdp"><B>Confirmer le mot de passe :</B><br/></label>
               <input type="password" id="confirm_mdp" name="confirm_mdp" minlength="8" onkeyup='check_pass();' required>
               <span id='message'></span>
            </div>

            <div class='mdp_confirm'>
               <label for="mdp_valide"><B>Mot de passe pour confirmer :</B><br/></label>
               <input type="password" id="mdp_valide" name="mdp_valide" minlength="8" placeholder="8 caractères minimum" required >
            </div>
            <div>
               <input class="buttonConnexion" type="submit" value="Modifier" id="submit"/>
            </div>
         </form>
      </section>
   </div>

   <script type="text/javascript" src="../../js/checkPass.js"></script>
   <script type="text/javascript" src="../../js/navBar.js"></script>
</body>

</html>
