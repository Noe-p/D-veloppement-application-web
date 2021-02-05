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

   <section class="verificationConnexion open">
      <?php
         require('php/config.php');

         $req = "SELECT com_mdp FROM t_compte_com WHERE com_pseudo = '$_POST[pseudo]'";
         $res = $con -> query($req);

         if ((mysqli_num_rows($res) == 0)) {
            echo "<script>
               let elementRemove = document.querySelector('.verificationConnexion');
               let elementCreate = document.querySelector('.connexion');

               elementCreate.classList.add('open');
               elementRemove.classList.remove('open');
               document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
               document.getElementById('message3').innerHTML = 'Mauvais pseudo ou mot de passe';
               document.getElementById('message3').style.fontSize = '0.8em';
             </script>";
         }
         else{
            while ($ligne = $res -> fetch_assoc()) {
               if ($ligne['com_mdp'] != md5($_POST['mdp'])){
                  echo "<script>
                     let elementRemove = document.querySelector('.verificationConnexion');
                     let elementCreate = document.querySelector('.connexion');

                     elementCreate.classList.add('open');
                     elementRemove.classList.remove('open');
                     document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
                     document.getElementById('message3').innerHTML = 'Mauvais pseudo ou mot de passe';
                     document.getElementById('message3').style.fontSize = '0.8em';
                     </script>";
               }
               else {
                  echo 'Vous êtes Connecté !';
               }
            }
         }



         $con->close();
      ?>
</section>

<script type="text/javascript" src="js/createElement.js"></script>

</body>

</html>
