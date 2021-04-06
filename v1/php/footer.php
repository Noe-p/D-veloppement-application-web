<?php
//CONNEXION A LA BASE
require('connexionBDD.php');

//Info Structure
$reqStruc = "SELECT pre_nomStruct, pre_adresse, pre_adresseMail, pre_numeroTel, pre_horaireOuverture, pre_texte
             FROM t_presentation_pre;";
$resStruc = $mysqli->query($reqStruc);

if(!$resStruc){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}
else{
   $struc = $resStruc->fetch_array(MYSQLI_ASSOC);
}
$mysqli->close();
?>

<footer id="contact">
   <article class="infosOrga">
      <h2>Où nous trouver : </h2>
      <ul>
         <li><B>Nom : </B><?php echo $struc['pre_nomStruct'] ?></li>
         <li><B>Adresse : </B><?php echo $struc['pre_adresse'] ?></li>
         <li><B>Mail : </B><?php echo $struc['pre_adresseMail'] ?></li>
         <li><B>Téléphone : </B><?php echo $struc['pre_numeroTel'] ?></li>
         <li><B>Horaire ouverture : </B><?php echo $struc['pre_horaireOuverture'] ?></li>
      </ul>
   </article>
   <article class="infosOrga">
      <h2>Description :</h2>
      <ul>
         <li class="description"><?php echo $struc['pre_texte'] ?></li>
      </ul>
   </article>
</footer>
