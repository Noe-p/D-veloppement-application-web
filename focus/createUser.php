<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/connexion.css" />
   <link rel="stylesheet" href="css/navBar.css" />

   <title>Focus</title>
</head>

<body>
   <aside>
      <ul class="navBar" >
         <li><a href="index.html">Home</a></li>
         <li class="menu"><a>Sélections</a>
            <ul class="sous">
               <li><a href="selections.html">Paysage</a></li>
               <li><a href="#">Portrait</a></li>
               <li><a href="#">Monochrome</a></li>
               <li><a href="#">Foret</a></li>
               <li><a href="#">Mer</a></li>
               <li><a href="#">Brest</a></li>
               <li><a href="#">Rennes</a></li>
               <li><a href="#">Rennes</a></li>
               <li><a href="#">Rennes</a></li>
               <li><a href="#">Rennes</a></li>
               <li><a href="#">Rennes</a></li>
               <li><a href="#">Rennes</a></li>
               <li><a href="#">Rennesardssss</a></li>
            </ul>
         </li>
         <li><a href="actualite.html">Actualités</a></li>
         <li class="menu compte"><a class="bouton">Compte</a>
            <ul class="sous">
               <li><a href="profil.html">Profil</a></li>
               <li><a href="connexion.html">Connexion</a></li>
               <li><a href="ajout.html">Ajouter</a></li>
            </ul>
         </li>
      </ul>
   </aside>
   <div class="utilisateur">
      <a href="connexion.html"><img src="assets/logos/padlock.png"></img>Connexion</a>
      <a href="https://noe-philippe.com/"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <section class="connexion open">

      <?php
         require('php/config.php');

         $nbUser = mysqli_num_rows(mysqli_query($con, "SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = 'Clem'"));

         if($nbUser == 1){
            header('Location: erreurConnexion.php');
            exit();
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
      <a href="connexion.html">Vous pouvez maintenant vous connecter</a>
   </section>

</body>

</html>
