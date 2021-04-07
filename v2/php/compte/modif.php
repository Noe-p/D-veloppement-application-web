<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//Input : text
if($_GET['input']=='text'){
   if(!empty($_POST['pseudoActive'])){
      $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo = '$_POST[pseudoActive]';";
      $resModifVal = $mysqli->query($reqModifVal);
   }
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

//Input : checkbox
elseif($_GET['input']=='checkbox') {
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
}


$mysqli->close();
?>
