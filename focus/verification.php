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

   <section class="verificationConnexion open">
      <?php
         require('php/config.php');

         //Vérification Déconnexion :
         if($_GET['verif']=='deconnexion'){
            $_SESSION = array();
            session_destroy();

            echo "<p>Vous êtes déconnecté.</p>";
         }
         //Vérification creation de compte et profil :
         elseif ($_GET['verif']=='createCpt') {
            $nbUser = mysqli_num_rows(mysqli_query($con, "SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = '$_POST[pseudo]'"));

            if($nbUser == 1){
               include('php/sectionCreateCompte.php');
               echo "<script>
                  document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
                  document.getElementById('message2').innerHTML = 'Pseudo déjà utilisé';
                  document.getElementById('message2').style.fontSize = '0.8em';
                </script>";
            }
            else{
               $sqlCom="INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`) VALUES ('$_POST[pseudo]', MD5('$_POST[mdp]'))";
               $resCom= mysqli_query($con, $sqlCom);

               $sqlPro="INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[email]', 'A', 'R', CURDATE(), '$_POST[pseudo]');";
               $resPro=mysqli_query($con, $sqlPro);

               if ($resCom and $resPro) {
                  echo "<p style=\"text-align: center;\">Nouveau compte créé avec succès.<br/>Vous pouvez maintenant vous connecter.</p>";
               }
               else {
                  echo "Erreur Compte: " . $sqlCom . "<br>" . mysqli_error($con);
                  echo "Erreur Profil: " . $sqlPro . "<br>" . mysqli_error($con);
                  mysqli_close($con);
               }
            }

         }
         //Vérification si utilisateur existe
         elseif ($_GET['verif']=='verifUser') {
            $reqCom = "SELECT com_pseudo, com_mdp, pro_validite FROM t_compte_com JOIN t_profil_pro USING(com_pseudo) WHERE com_pseudo = '$_POST[pseudo]'";
            $resCom = mysqli_query($con, $reqCom);
            $Com = mysqli_fetch_assoc($resCom);

            if (($Com['com_pseudo'] != $_POST['pseudo']) and ($Com['com_mdp'] != md5($_POST['mdp']))) {
               include('php/sectionConnexion.php');
               echo "<script>
                  document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
                  document.getElementById('message3').innerHTML = 'Mauvais pseudo ou mot de passe';
                  document.getElementById('message3').style.fontSize = '0.8em';
                </script>";
            }
            else if ($Com['pro_validite']=='D') {
               echo "<p>La connexion a échoué : votre compte a été désactivé.</p>";
            }
            else {
               echo '<p>Bonjour, ' . $_POST['pseudo'] . ' vous êtes connecté !</p>';
               $_SESSION['pseudo'] = $_POST['pseudo'];
               $con->close();
            }
         }
         //Vérification publication photo :
         elseif ($_GET['verif']=='publiPhoto') {
            $sqlEle="INSERT INTO `t_element_ele` (`ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`) VALUES ('$_POST[titre]', '$_POST[description]', CURDATE(), '$_POST[img]', 'A')";
            $resEle=mysqli_query($con, $sqlEle);

            if($resEle) {
               $i=0;
               foreach($_POST['check'] as $check){
                  //On cherche l'ID de la (les) selection(s) cochée(s)
                  $sqlSel="SELECT sel_numero FROM t_selection_sel where sel_intitule = '$check' and com_pseudo = '$_SESSION[pseudo]'";
                  $resSel=mysqli_query($con, $sqlSel);
                  while($sel = $resSel->fetch_array(MYSQLI_ASSOC)){
                     $test['sel_numero'][$i]=$sel['sel_numero'];
                  }
                  $i=$i+1;
               }

               //On cherche l'ID du dernier element créé
               $sqlLastEle="SELECT ele_numero FROM t_element_ele GROUP BY ele_numero DESC LIMIT 1";
               $resLastEle=mysqli_query($con, $sqlLastEle);
               $newEle = mysqli_fetch_assoc($resLastEle);

               //On  met en lien la (les) selection(s) et l'élément
               for ($j=0; $j < $i; $j++) {
                  $test2 =$test['sel_numero'][$j];
                  $sqlJt="INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`) VALUES ('$test2', '$newEle[ele_numero]');";
                  $resJt=mysqli_query($con, $sqlJt);
               }

               if($resJt) {
                  echo "<p>Photo publiée.</p>";
               }
               else{
                  echo "Erreur: " . $sqlJt . "<br>" . mysqli_error($con);
                  mysqli_close($con);
               }
            }
            else {
               echo "Erreur: " . $sqlEle . "<br>" . mysqli_error($con);
               mysqli_close($con);
            }
         }
         //Vérification Ajout selection :
         elseif ($_GET['verif']=='publiSel') {
            $sqlSel="INSERT INTO `t_selection_sel` (`sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`) VALUES ('$_POST[nom]', '$_POST[descriptionSel]', CURDATE(), '$_SESSION[pseudo]')";
            $resSel=mysqli_query($con, $sqlSel);

            if($resSel) {
               echo "<p>Selection ajoutée</p>";
            }
            else{
               echo "Erreur: " . $sqlSel . "<br>" . mysqli_error($con);
               mysqli_close($con);
            }
         }
      ?>

   </section>

   <script type="text/javascript" src="js/checkPass.js"></script>
</body>

</html>
