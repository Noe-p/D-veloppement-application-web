<?php
session_start();

//CONNEXION A LA BASE
require('../../connexionBDD.php');

//Input : text
if($_GET['input']=='liste'){
   if(!empty($_POST['actuActive'])){
      $actu=htmlspecialchars(addslashes($_POST['actuActive']));

      //On verifie que l'actualité existe
      $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_numero='$actu';";
      $resActuExist = $mysqli->query($reqActuExist);

      if($resActuExist){
         if($resActuExist->num_rows){
            //On vérifie la validité de l'actu
            $reqValid="SELECT actu_etat FROM t_actualite_actu WHERE actu_numero='$actu';";
            $resValid = $mysqli->query($reqValid);

            if($resValid){
               $valid = $resValid->fetch_array(MYSQLI_ASSOC);

               // Si le compte est activé on le désactive
               if($valid['actu_etat']=='A'){
                  $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'D' WHERE actu_numero='$actu';";
                  $resModifVal = $mysqli->query($reqModifVal);
               }
               else{
                  $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'A' WHERE actu_numero='$actu';";
                  $resModifVal = $mysqli->query($reqModifVal);
               }

               //Si le compte est désactivé on l'active
               if($resModifVal){
                  //Si tout marche
                  header("Location: ../admin_actualite.php?error=1#admin");
                  exit();
               }
               else{
                  //La requête à échoué
                  $error=2;
               }
            }
            else{
               //La requete à échoué
               $error=2;
            }
         }
         //Si l'actualite' n'existe pas
         else{
            $error=3;
         }
      }
      else{
         //La requete à échoué
         $error=2;
      }
   }
   //Si l'input est vide
   else{
      $error=4;
   }
   header("Location: ../admin_actualite.php?error=".$error."#admin");
   exit();
}

//Input : checkbox
else if($_GET['input']=='checkbox') {
   $actu=htmlspecialchars(addslashes($_POST['actuDes']));

   //On verifie que l'actualité existe
   $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_numero='$actu';";
   $resActuExist = $mysqli->query($reqActuExist);

   if($resActuExist){
      if($resActuExist->num_rows){
         //Si la checkbox est cochée, on active le compte
         if(!empty($_POST['checkbox'])){
            $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'A' WHERE actu_numero = '$actu';";
            $resModifVal = $mysqli->query($reqModifVal);

            if(!$resModifVal){
               //LA requete a echoue
               $error=2;
            }
            else{
               header("Location: ../admin_actualite.php#admin");
               exit();
            }
         }
         else{
            $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'D' WHERE actu_numero = '$actu';";
            $resModifVal = $mysqli->query($reqModifVal);

            if(!$resModifVal){
               //LA requete a echoue
               $error=2;
            }
            else{
               header("Location: ../admin_actualite.php#admin");
               exit();
            }
         }
         header("Location: ../admin_actualite.php?error=".$error."#admin");
         exit();
      }
   }
}


//Ajout actualité
else if($_GET['input']=='newActu') {
   if(!empty($_POST['newActu']) and !empty($_POST['descriptionActu'])){
      $titre=htmlspecialchars(addslashes($_POST['newActu']));
      $desc=htmlspecialchars(addslashes($_POST['descriptionActu']));

      $reqNewActu="INSERT INTO t_actualite_actu (actu_titre, actu_texte, actu_date, actu_etat, com_pseudo)
                   VALUES ('$titre', '$desc', CURDATE(), 'D', '$_SESSION[login]');";
      $resNewActu = $mysqli->query($reqNewActu);
      if($resNewActu){
         header("Location: ../admin_actualite.php?errorNewActu=1#admin");
         exit();
      }
      else{
         //La requête à échoué
         $error=2;
      }
   }
   else{
      //Entrer un titre et une description
      $error=3;
   }
   header("Location: ../admin_actualite.php?errorNewActu=1#admin");
   exit();
}

//Verif Actualité
elseif($_GET['input']=='id') {
   $actu=htmlspecialchars(addslashes($_POST['modifActu']));

   //On verifie que l'actualité existe
   $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_numero='$actu';";
   $resActuExist = $mysqli->query($reqActuExist);

   if($resActuExist){
      if($resActuExist->num_rows){
         header("Location: ../admin_actualite.php?actu=".$actu."#admin");
         exit();
      }
      else{
         //L'actu' n'existe pas
         $error=4;
      }
   }
   else{
      //La requête à echoué
      $error=2;
   }
   header("Location: ../admin_actualite.php?errorModifActu=".$error."#admin");
   exit();
}

//Modifer actualité
else if($_GET['input']=='modifActu'){
   if(!empty($_GET['actu'])){
      $actu=htmlspecialchars(addslashes($_GET['actu']));

      //On verifie que l'actualité existe
      $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_numero = '$actu';";
      $resActuExist = $mysqli->query($reqActuExist);

      if($resActuExist){
         if($resActuExist->num_rows){
            if(!empty($_POST['modifActuTitre']) or !empty($_POST['modifActuDesc'])){
               if(!empty($_POST['modifActuTitre'])){
                  $titre=htmlspecialchars(addslashes($_POST['modifActuTitre']));

                  $reqModifTitre="UPDATE t_actualite_actu SET actu_titre = '$titre' WHERE actu_numero = '$actu';";
                  $resModifTitre = $mysqli->query($reqModifTitre);

                  if(!$resModifTitre){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifActuDesc'])){
                  $desc=htmlspecialchars(addslashes($_POST['modifActuDesc']));

                  $reqModifDesc="UPDATE t_actualite_actu SET actu_texte='$desc' WHERE actu_numero = '$actu';";
                  $resModifDesc = $mysqli->query($reqModifDesc);
                  if(!$resModifDesc){
                     //La requete a échoué
                     $error=2;

                  }
               }
               header("Location: ../admin_actualite.php?errorModifActu=1#admin");
               exit();
            }
            else{
               //Entrer Un titre ou une description
               $error=3;
            }
         }
         else{
            //L'actualité n'existe pas
            $error=4;
         }
      }
      else{
         //La requête à échoué
         $error=2;
      }
   }
   else{
      //Pas d'actualité sélectionné
      $error=5;
   }
   header("Location: ../admin_actualite.php?errorModifActu=".$error."#admin");
   exit();
}


//Supprimer actualite
else if($_GET['input']=='suppActu'){
   if(!empty($_POST['actuSupp'])){
      $actu=htmlspecialchars(addslashes($_POST['actuSupp']));

      //On verifie que l'actualité existe
      $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_numero='$actu';";
      $resActuExist = $mysqli->query($reqActuExist);

      if($resActuExist){
         if($resActuExist->num_rows){
            $reqSuppActu="DELETE FROM t_actualite_actu WHERE actu_numero = $actu;";
            $resSuppActu=$mysqli->query($reqSuppActu);

            if($resSuppActu){
               header("Location: ../admin_actualite.php?error=5;#admin");
               exit();
            }
            //Si tout marche
            else{
               //La reqeutes a échoué
               $error=2;
            }
         }
         //Si l'actualite n'existe pas'
         else{
            $error=3;
         }
      }
      else{
         //La requete à échoué
         $error=2;
      }
   }
   //Si l'input est vide
   else{
      $error=4;
   }
   header("Location: ../admin_actualite.php?error=".$error."#admin");
   exit();
}


//S'il n'y a pas de $_GET
else{
   header("Location: ../admin_actualite.php#admin");
   exit();
}

$mysqli->close();
?>
