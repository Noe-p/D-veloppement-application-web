<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');
if(!empty($_POST['checkbox'])){
   $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo = '$_GET[loginDes]';";
   $resModifVal = $mysqli->query($reqModifVal);

   if(!$resModifVal){
      echo "Error: La requête a echoué \n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit();
   }
   else{
      header("Location: admin_accueil.php");
      exit();
   }
}
else{
   $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'D' WHERE com_pseudo = '$_GET[loginDes]';";
   $resModifVal = $mysqli->query($reqModifVal);

   if(!$resModifVal){
      echo "Error: La requête a echoué \n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit();
   }
   else{
      header("Location: admin_accueil.php");
      exit();
   }
}

$mysqli->close();
?>
