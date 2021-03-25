
<?php
require('php/requetes.php');
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/selection.css" />
   <link rel="stylesheet" href="css/navBar.css" />
   <link rel="stylesheet" href="css/footer.css" />
   <title>Focus</title>
</head>

<body>

   <aside>
      <ul class="navBar" >
         <li><a href="index.php">Home</a></li>
         <li><a href="selection.php" class="bouton">Sélections</a></li>
         <?php
         if(isset($_SESSION['pseudo'])){
            echo "<li class='menu compte'><a>Compte<img class='lock' src='assets/logos/padlock_bc.png'></img></a>";
         }else{
            echo "<li class='menu compte'><a>Compte<img class='lock' src='assets/logos/padlock_bo.png'></img></a>";
         }
         ?>
            <ul class="sous">
               <?php
               if(isset($_SESSION['pseudo'])){
                  echo "<li><a href='profil.php'>Profil</a></li>
                  <li><a href='ajout.php'>Ajouter</a></li>
                  <li><a href='action.php?action=deconnexion'>Déconnexion</a></li>";
               } else{
                  echo "<li><a href='inscription.php'>Inscription</a></li>
                  <li><a href='connexion.php'>Connexion</a></li>";
               }
               ?>

            </ul>
         </li>
      </ul>
   </aside>

   <table>
      <thead>
         <tr>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Date</th>
            <th>Pseudo</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            $i=0;
            while ($sel = $resSel->fetch_assoc()) {
               if(fmod($i,2)==0){
                  echo "<tr>";
                  $i=$i+1;
               }
               else{
                  echo "<tr class='lignePaire'>";
                  $i=$i+1;
               }
               echo "
                     <td>".$sel['sel_intitule']."</td>
                     <td class='resume'>".$sel['sel_texteIntro']."</td>
                     <td>".$sel['sel_date']."</td>
                     <td>".$sel['com_pseudo']."</td>
                     <td><a href=''><img class='oeil' src='assets/logos/oeil.png'></img></a></td>
                  </tr>
               ";
            }
         ?>
      </tbody>
   </table>

   <?php require('php/footer.php'); ?>

   <script type="text/javascript" src="js/navBar.js"></script>
</body>

</html>
