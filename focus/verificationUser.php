<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/connexion.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus</title>
</head>

<body>

   <?php require('php/navBar.php'); ?>

   <div class="utilisateur">
      <a href="connexion.php"><img src="assets/logos/padlock.png"></img>Connexion</a>
      <a href="https://noe-philippe.com/"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <section class="connexion">
      <?php require('php/sectionConnexion.php'); ?>
   </section>

   <section class="createCompte">
      <?php require('php/sectionCreateCompte.php'); ?>
   </section>

   <section class="verificationUser open">

      <?php
         require('php/config.php');

         $nbUser = mysqli_num_rows(mysqli_query($con, "SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = '$_POST[pseudo]'"));

         if($nbUser == 1){
            echo "<script>
               let elementRemove = document.querySelector('.verificationUser');
               let elementCreate = document.querySelector('.createCompte');

               elementCreate.classList.add('open');
               elementRemove.classList.remove('open');
               document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
               document.getElementById('message2').innerHTML = 'Pseudo déjà utilisé';
               document.getElementById('message2').style.fontSize = '0.8em';
             </script>";
         }
         else{
            $sqlCompte="INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`) VALUES ('$_POST[pseudo]', MD5('$_POST[mdp]'));";
            $sqlProfil="INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[email]', 'A', 'R', CURDATE(), '$_POST[pseudo]');";


            if (mysqli_query($con, $sqlCompte) and mysqli_query($con, $sqlProfil)) {
               echo "Nouveau compte créé avec succès.";
            }
            else {
               echo "Erreur Compte: " . $sqlCompte . "<br>" . mysqli_error($con);
               echo "Erreur Profil: " . $sqlProfil . "<br>" . mysqli_error($con);
               mysqli_close($con);
            }
         }

      ?>

      <p>Vous pouvez maintenant vous <a href="connexion.php"> connecter</a></p>
   </section>

   <script type="text/javascript" src="js/createElement.js"></script>
   <script type="text/javascript" src="js/checkPass.js"></script>

</body>

</html>
