<?php
session_start();

//CONNEXION A LA BASE
require('../../connexionBDD.php');

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
                     header("Location: ../admin_accueil.php?error=1#admin");
                     exit();
                  }else{
                     $error=2;
                  }
               }
               else{
                  $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo='$pseudo';";
                  $resModifVal = $mysqli->query($reqModifVal);

                  if($resModifVal){
                     header("Location: ../admin_accueil.php?error=1#admin");
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
   header("Location: ../admin_accueil.php?error=".$error."#admin");
   exit();
}

//Verif pseudo
elseif($_GET['input']=='id') {
   $pseudo=htmlspecialchars(addslashes($_POST['modifPro']));

   //On verifie que le profil existe
   $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
   $resPseudoExist = $mysqli->query($reqPseudoExist);

   if($resPseudoExist){
      if($resPseudoExist->num_rows){
         header("Location: ../admin_accueil.php?pseudo=".$pseudo."#admin");
         exit();
      }
      else{
         //Le pseudo n'existe pas
         $error=4;
      }
   }
   else{
      //La requête à echoué
      $error=2;
   }
   header("Location: ../admin_accueil.php?errorModifPro=".$error."#admin");
   exit();
}

//Input : checkbox
elseif($_GET['input']=='checkbox') {
   $pseudo=htmlspecialchars(addslashes($_GET['loginDes']));

   //On verifie que le profil existe
   $reqPseudoExist="SELECT com_pseudo FROM t_profil_pro WHERE com_pseudo='$pseudo';";
   $resPseudoExist = $mysqli->query($reqPseudoExist);

   if($resPseudoExist){
      if($resPseudoExist->num_rows){

         //Si la checkbox est cochée, on active le compte
         if(!empty($_POST['checkbox'])){
            $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'A' WHERE com_pseudo = '$pseudo';";
            $resModifVal = $mysqli->query($reqModifVal);

            if($resModifVal){
               header("Location: ../admin_accueil.php#admin");
               exit();
            }
            else{
               //Erreur requète
               $error=2;
            }
         }
         else{
            $reqModifVal="UPDATE t_profil_pro SET pro_validite = 'D' WHERE com_pseudo = '$pseudo';";
            $resModifVal = $mysqli->query($reqModifVal);

            if(!$resModifVal){
               $error=2;
            }
            else{
               header("Location: ../admin_accueil.php#admin");
               exit();
            }
         }
         header("Location: ../admin_accueil.php?error=".$error."#admin");
         exit();
      }
   }
}

//Modifer profil
else if($_GET['input']=='modifPro'){
   if(!empty($_GET['pseudo'])){
      $pseudo=htmlspecialchars(addslashes($_GET['pseudo']));

      //On verifie que l'élément existe
      $reqProExist="SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = '$pseudo';";
      $resProExist = $mysqli->query($reqProExist);

      if($resProExist){
         if($resProExist->num_rows){
            if(!empty($_POST['modifNom']) or !empty($_POST['modifPrenom']) or !empty($_POST['modifMail'])){
               if(!empty($_POST['modifNom'])){
                  $nom=htmlspecialchars(addslashes($_POST['modifNom']));

                  $reqModifNom="UPDATE t_profil_pro SET pro_nom = '$nom' WHERE com_pseudo = '$pseudo';";
                  $resModifNom = $mysqli->query($reqModifNom);

                  if(!$resModifNom){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifPrenom'])){
                  $prenom=htmlspecialchars(addslashes($_POST['modifPrenom']));

                  $reqModifPrenom="UPDATE t_profil_pro SET pro_prenom='$prenom' WHERE com_pseudo = '$pseudo';";
                  $resModifPrenom = $mysqli->query($reqModifPrenom);
                  if(!$resModifPrenom){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifMail'])){
                  $mail=htmlspecialchars(addslashes($_POST['modifMail']));

                  $reqModifMail="UPDATE t_profil_pro SET pro_mail='$mail' WHERE com_pseudo = '$pseudo';";
                  $resModifMail = $mysqli->query($reqModifMail);
                  if(!$resModifMail){
                     //La requete a échoué
                     $error=2;
                  }
               }
               header("Location: ../admin_accueil.php?errorModifPro=1#admin");
               exit();
            }
            else{
               //Entrer Un nom, prenom ou mail
               $error=3;
            }
         }
         else{
            //Le profil n'existe pas
            $error=4;
         }
      }
      else{
         //La requête à échoué
         $error=2;
      }
   }
   else{
      //Pas de profil sélectionné
      $error=5;
   }
   header("Location: ../admin_accueil.php?errorModifPro=".$error."#admin");
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
                  header("Location: ../admin_accueil.php?error=1#admin");
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
   header("Location: ../admin_accueil.php?error=".$error."#admin");
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
         $reqNbEle="SELECT ele_numero FROM tj_relie_rel
                    JOIN t_selection_sel USING(sel_numero)
                    WHERE com_pseudo ='$pseudo'";
         $resNbSel=$mysqli->query($reqNbEle);
         if($resNbSel->num_rows==0){
            $reqSuppCompte="DELETE FROM t_selection_sel WHERE com_pseudo = '$pseudo';
                           DELETE FROM t_actualite_actu WHERE com_pseudo = '$pseudo';
                           DELETE FROM t_presentation_pre WHERE com_pseudo = '$pseudo';
                           DELETE FROM t_profil_pro WHERE com_pseudo = '$pseudo';";
            $resSuppCompte = $mysqli->multi_query($reqSuppCompte);

            if($resSuppCompte){
               header("Location: ../admin_accueil.php?error=8#admin");
               exit();
            }
            else{
               //La requète a échoué
               $error=2;
            }
         }
         else{
            //Sélection pas vide
            $error=7;
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
   header("Location: ../admin_accueil.php?error=".$error."#admin");
   exit();
}



//S'il n'y a pas de $_GET
else{
   header("Location: ../admin_accueil.php#admin");
   exit();
}

$mysqli->close();
?>
