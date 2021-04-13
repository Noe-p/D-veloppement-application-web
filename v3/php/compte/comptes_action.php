<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//Input : text
if($_GET['input']=='liste'){
   if(!empty($_POST['pseudoActive'])){
      $pseudo=htmlspecialchars(addslashes($_POST['pseudoActive']));

      //On verifie que le profil existe
      $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
      $resPseudoExist = $mysqli->query($reqPseudoExist);

      if($resPseudoExist){
         if($resPseudoExist->num_rows){
            //On vérifie la validité du profil
            $reqValid="SELECT pro_validite FROM t_profil_pro WHERE com_pseudo='$pseudo';";
            $resValid = $mysqli->query($reqValid);

            if($resValid){
               $valid = $resValid->fetch_array(MYSQLI_ASSOC);

               // Si c'est valide on le désactive
               if($valid['pro_validite']=='A'){
                  $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'D' WHERE com_pseudo='$pseudo';";
                  $resModifVal = $mysqli->query($reqModifVal);

                  if($resModifVal){
                     header("Location: admin_accueil.php?error=1#admin");
                     exit();
                  }else{
                     $error=2;
                  }
               }
               else{
                  $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo='$pseudo';";
                  $resModifVal = $mysqli->query($reqModifVal);

                  if($resModifVal){
                     header("Location: admin_accueil.php?error=1#admin");
                     exit();
                  }else{
                     $error=2;
                  }
               }
            }
            else{
               //La requete à échoué
               $error=2;
            }
         }
         else{
            //Le pseudo n'existe pas
            $error=3;
         }
      }
      else{
         //La requete à échoué
         $error=2;
      }
   }
   //Entrer un pseudo
   else{
      $error=4;
   }
   header("Location: admin_accueil.php?error=".$error."#admin");
   exit();
}

//Input : checkbox
elseif($_GET['input']=='checkbox') {
   //Si la checkbox est cochée, on active le compte
   if(!empty($_POST['checkbox'])){
      $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo = '$_GET[loginDes]';";
      $resModifVal = $mysqli->query($reqModifVal);

      if($resModifVal){
         header("Location: admin_accueil.php#admin");
         exit();
      }
      else{
         //Erreur requète
         $error=2;
      }
   }
   else{
      $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'D' WHERE com_pseudo = '$_GET[loginDes]';";
      $resModifVal = $mysqli->query($reqModifVal);

      if(!$resModifVal){
         $error=2;
      }
      else{
         header("Location: admin_accueil.php#admin");
         exit();
      }
   }
   header("Location: admin_accueil.php?error=".$error."#admin");
   exit();
}

//Modifier le statut
elseif($_GET['input']=='modifStatut'){
   if(!empty($_POST['modifStatut'])){
      if(!empty($_POST['modifStatutA']) or !empty($_POST['modifStatutR'])){
         if((empty($_POST['modifStatutA']) and !empty($_POST['modifStatutR'])) or (!empty($_POST['modifStatutA']) and empty($_POST['modifStatutR']))){
            $pseudo=htmlspecialchars(addslashes($_POST['modifStatut']));

            //On verifie que le profil existe
            $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
            $resPseudoExist = $mysqli->query($reqPseudoExist);

            if($resPseudoExist->num_rows){
               if(!empty($_POST['modifStatutA'])){
                  $status='A';
               }
               elseif(!empty($_POST['modifStatutR'])) {
                  $status='R';
               }

               $reqModifStatut="UPDATE t_profil_pro SET pro_statut = '$status' WHERE com_pseudo = '$pseudo';";
               $resModifStatut = $mysqli->query($reqModifStatut);

               if($resModifStatut){
                  header("Location: admin_accueil.php?error=1#admin");
                  exit();
               }
               else{
                  //La requete a échoué
                  $error=2;
               }
            }
            else{
               //Le profil n'existe pas
               $error=3;
            }
         }
         else{
            //Plusieurs cases sont cochées
            $error=6;
         }
      }
      else{
         //Aucune cases sont cochées
         $error=5;
      }
   }
   else{
      //Pseudo vide
      $error=4;
   }
   header("Location: admin_accueil.php?error=".$error."#admin");
   exit();
}

//Supprimer compte
elseif($_GET['input']=='suppCompte'){
   if(!empty($_POST['suppCompte'])){
      $pseudo=htmlspecialchars(addslashes($_POST['suppCompte']));

      //On verifie que le profil existe
      $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
      $resPseudoExist = $mysqli->query($reqPseudoExist);

      if($resPseudoExist->num_rows){
         echo "On supprime le compte ???";

         if(!$resSuppCompte){
            //La requète a échoué
            $error=7;
         }
         else{
            header("Location: admin_accueil.php#admin");
            exit();
         }
      }
      else{
         //Le profil n'existe pas
         $error=3;
      }
   }
   else{
      //Pseudo vide
      $error=1;
   }
   header("Location: admin_accueil.php?error=".$error."#admin");
   exit();
}



//S'il n'y a pas de $_GET
else{
   header("Location: admin_actualite.php#admin");
   exit();
}

$mysqli->close();
?>
