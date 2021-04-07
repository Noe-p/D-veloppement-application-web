<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//Input : text
$error=-1;
if($_GET['input']=='liste'){
   if(!empty($_POST['pseudoActive'])){
      $pseudo=htmlspecialchars(addslashes($_POST['pseudoActive']));

      //On verifie que le profil existe
      $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
      $resPseudoExist = $mysqli->query($reqPseudoExist);

      if($resPseudoExist->num_rows){
         //On vérifie la validité du profil
         $reqValid="SELECT pro_validite FROM t_profil_pro WHERE com_pseudo='$pseudo';";
         $resValid = $mysqli->query($reqValid);
         $valid = $resValid->fetch_array(MYSQLI_ASSOC);

         // Si c'est valide on le désactive
         if($valid['pro_validite']=='A'){
            $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'D' WHERE com_pseudo='$pseudo';";
            $resModifVal = $mysqli->query($reqModifVal);
         }
         else{
            $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo='$pseudo';";
            $resModifVal = $mysqli->query($reqModifVal);
         }

         if(!$resModifVal){
            $error=2;
            header("Location: admin_accueil.php?error=".$error."#admin");
            exit();
         }
         //Si tout marche
         else{
            header("Location: admin_accueil.php#admin");
            exit();
         }
      }
      //Si le profil n'existe pas
      else{
         $error=3;
         header("Location: admin_accueil.php?error=".$error."#admin");
         exit();
      }
   }
   //Si l'input est vide
   else{
      $error=1;
      header("Location: admin_accueil.php?error=".$error."#admin");
      exit();
   }
}

//Input : checkbox
elseif($_GET['input']=='checkbox') {
   //Si la checkbox est cochée, on active le compte
   if(!empty($_POST['checkbox'])){
      $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo = '$_GET[loginDes]';";
      $resModifVal = $mysqli->query($reqModifVal);

      if(!$resModifVal){
         $error=2;
         header("Location: admin_accueil.php?error=".$error."#admin");
         exit();
      }
      else{
         header("Location: admin_accueil.php#admin");
         exit();
      }
   }
   else{
      $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'D' WHERE com_pseudo = '$_GET[loginDes]';";
      $resModifVal = $mysqli->query($reqModifVal);

      if(!$resModifVal){
         $error=2;
         header("Location: admin_accueil.php?error=".$error."#admin");
         exit();
      }
      else{
         header("Location: admin_accueil.php#admin");
         exit();
      }
   }
}
else{
   header("Location: admin_accueil.php#admin");
   exit();
}


$mysqli->close();
?>
