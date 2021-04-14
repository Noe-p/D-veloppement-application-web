<?php
session_start();

//CONNEXION A LA BASE
require('../../connexionBDD.php');


//Ajout Lien
if($_GET['input']=='newLien') {
   if(!empty($_POST['newLien']) and !empty($_POST['url']) and !empty($_POST['auteur']) and !empty($_POST['allEle'])){
      $titre=htmlspecialchars(addslashes($_POST['newLien']));
      $url=htmlspecialchars(addslashes($_POST['url']));
      $auteur=htmlspecialchars(addslashes($_POST['auteur']));
      $ele=htmlspecialchars(addslashes($_POST['allEle']));

      $reqNewLien="INSERT INTO t_lien_lie (lie_titre, lie_url, lie_auteur, lie_date, ele_numero)
                   VALUES ('$titre', '$url', '$auteur', CURDATE(), '$ele');";
      $resNewLien = $mysqli->query($reqNewLien);
      if($resNewLien){
         header("Location: ../admin_lien.php?errorNewLien=1#admin");
         exit();
      }
      else{
         //La requête à échoué
         $error=2;
      }
   }
   else{
      //Entrer un titre, un url, un auteur et un élément
      $error=3;
   }
   header("Location: ../admin_lien.php?errorNewLien=1#admin");
   exit();
}

//Verif lien
elseif($_GET['input']=='id') {
   $lie=htmlspecialchars(addslashes($_POST['modifLien']));

   $reqLieExist="SELECT lie_titre FROM t_lien_lie WHERE lie_numero='$lie';";
   $resLieExist = $mysqli->query($reqLieExist);

   if($resLieExist){
      if($resLieExist->num_rows){
         header("Location: ../admin_lien.php?lie=".$lie."#admin");
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
   header("Location: ../admin_lien.php?errorModifLien=".$error."#admin");
   exit();
}


//Modifer Lien
else if($_GET['input']=='modifLien'){
   if(!empty($_GET['lie'])){
      $lie=htmlspecialchars(addslashes($_GET['lie']));

      //On verifie que l'élément existe
      $reqLieExist="SELECT lie_titre FROM t_lien_lie WHERE lie_numero = '$lie';";
      $resLieExist = $mysqli->query($reqLieExist);

      if($resLieExist){
         if($resLieExist->num_rows){
            if(!empty($_POST['modifLienTitre']) or !empty($_POST['modifLieUrl']) or !empty($_POST['modifAuteur'])){
               if(!empty($_POST['modifLienTitre'])){
                  $titre=htmlspecialchars(addslashes($_POST['modifLienTitre']));

                  $reqModifTitre="UPDATE t_lien_lie SET lie_titre = '$titre' WHERE lie_numero = '$lie';";
                  $resModifTitre = $mysqli->query($reqModifTitre);

                  if(!$resModifTitre){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifLienUrl'])){
                  $url=htmlspecialchars(addslashes($_POST['modifLienUrl']));

                  $reqModifUrl="UPDATE t_lien_lie SET lie_url='$url' WHERE lie_numero = '$lie';";
                  $resModifUrl = $mysqli->query($reqModifUrl);
                  if(!$resModifUrl){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifLienAuteur'])){
                  $img=htmlspecialchars(addslashes($_POST['modifLienAuteur']));

                  $reqModifAuteur="UPDATE t_lien_lie SET lie_auteur='$auteur' WHERE lie_numero = '$lie';";
                  $resModifAuteur = $mysqli->query($reqModifAuteur);
                  if(!$resModifAuteur){
                     //La requete a échoué
                     $error=2;
                  }
               }
               header("Location: ../admin_lien.php?errorModifLien=1#admin");
               exit();
            }
            else{
               //Entrer Un titre ou une description
               $error=3;
            }
         }
         else{
            //L'élément n'existe pas
            $error=4;
         }
      }
      else{
         //La requête à échoué
         $error=2;
      }
   }
   else{
      //Pas d'élément sélectionné
      $error=5;
   }
   header("Location: ../admin_lien.php?errorModifLien=".$error."#admin");
   exit();
}


//Supprimer Lien
else if($_GET['input']=='suppLien'){
   if(!empty($_POST['lieSupp'])){
      $lie=htmlspecialchars(addslashes($_POST['lieSupp']));

      //On verifie que l'élément existe
      $reqLienExist="SELECT lie_numero FROM t_lien_lie WHERE lie_numero='$lie';";
      $resLienExist = $mysqli->query($reqLienExist);

      if($resLienExist){
         if($resLienExist->num_rows){
            $reqSuppLien="DELETE FROM t_lien_lie
                         WHERE lie_numero = '$lie';";
            $resSuppLien=$mysqli->multi_query($reqSuppLien);

            if($resSuppLien){
               header("Location: ../admin_lien.php?error=5;#admin");
               exit();
            }
            //Si tout marche
            else{
               //La reqeutes a échoué
               $error=2;
            }
         }
         //Si l'lien n'existe pas'
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
   header("Location: ../admin_lien.php?error=".$error."#admin");
   exit();
}


//S'il n'y a pas de $_GET
else{
   header("Location: ../admin_element.php#admin");
   exit();
}

$mysqli->close();
?>
