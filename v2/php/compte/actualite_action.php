<?php
session_start();

//CONNEXION A LA BASE
require('../connexionBDD.php');

//Input : text
$error=-1;
if($_GET['input']=='liste'){
   if(!empty($_POST['actuActive'])){
      $actu=htmlspecialchars(addslashes($_POST['actuActive']));

      //On verifie que l'actualité existe
      $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_titre='$actu';";
      $resActuExist = $mysqli->query($reqActuExist);

      if($resActuExist->num_rows){
         //On vérifie la validité de l'actu
         $reqValid="SELECT actu_etat FROM t_actualite_actu WHERE actu_titre='$actu';";
         $resValid = $mysqli->query($reqValid);
         $valid = $resValid->fetch_array(MYSQLI_ASSOC);

         // Si c'est valide on le désactive
         if($valid['actu_etat']=='A'){
            $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'D' WHERE actu_titre='$actu';";
            $resModifVal = $mysqli->query($reqModifVal);
         }
         else{
            $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'A' WHERE actu_titre='$actu';";
            $resModifVal = $mysqli->query($reqModifVal);
         }

         if(!$resModifVal){
            $error=2;
            header("Location: admin_actualite.php?error=".$error."#admin");
            exit();
         }
         //Si tout marche
         else{
            header("Location: admin_actualite.php#admin");
            exit();
         }
      }
      //Si l'actualite' n'existe pas
      else{
         $error=3;
         header("Location: admin_actualite.php?error=".$error."#admin");
         exit();
      }
   }
   //Si l'input est vide
   else{
      $error=1;
      header("Location: admin_actualite.php?error=".$error."#admin");
      exit();
   }
}

//Input : checkbox
else if($_GET['input']=='checkbox') {
   //Si la checkbox est cochée, on active le compte
   if(!empty($_POST['checkbox'])){
      $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'A' WHERE actu_titre = '$_GET[actuDes]';";
      $resModifVal = $mysqli->query($reqModifVal);

      if(!$resModifVal){
         $error=2;
         header("Location: admin_actualite.php?error=".$error."#admin");
         exit();
      }
      else{
         header("Location: admin_actualite.php#admin");
         exit();
      }
   }
   else{
      $reqModifVal="UPDATE t_actualite_actu SET actu_etat = 'D' WHERE actu_titre = '$_GET[actuDes]';";
      $resModifVal = $mysqli->query($reqModifVal);

      if(!$resModifVal){
         $error=2;
         header("Location: admin_actualite.php?error=".$error."#admin");
         exit();
      }
      else{
         header("Location: admin_actualite.php#admin");
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
      if(!$resNewActu){
         echo "Error: La requête a echoué \n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error . "\n";
         exit();
      }
      else{
         header("Location: admin_actualite.php#admin");
         exit();
      }
   }
   else{
      header("Location: admin_actualite.php?errorNewActu=1#admin");
      exit();
   }
}



//Supprimer actualite
else if($_GET['input']=='suppActu'){
   if(!empty($_POST['actuSupp'])){
      $actu=htmlspecialchars(addslashes($_POST['actuSupp']));

      //On verifie que l'actualité existe
      $reqActuExist="SELECT actu_titre FROM t_actualite_actu WHERE actu_numero='$actu';";
      $resActuExist = $mysqli->query($reqActuExist);

      if($resActuExist->num_rows){
         $reqSuppActu="DELETE FROM t_actualite_actu WHERE actu_numero = $actu;";
         $resSuppActu=$mysqli->query($reqSuppActu);

         if(!$resSuppActu){
            $error=2;
            header("Location: admin_actualite.php?error=".$error."#admin");
            exit();
         }
         //Si tout marche
         else{
            header("Location: admin_actualite.php?#admin");
            exit();
         }
      }
      //Si l'actualite n'existe pas'
      else{
         $error=3;
         header("Location: admin_actualite.php?error=".$error."#admin");
         exit();
      }
   }
   //Si l'input est vide
   else{
      $error=1;
      header("Location: admin_actualite.php?error=".$error."#admin");
      exit();
   }
}


//S'il n'y a pas de $_GET
else{
   header("Location: admin_actualite.php#admin");
   exit();
}

$mysqli->close();
?>
