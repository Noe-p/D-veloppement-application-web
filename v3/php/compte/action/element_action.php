<?php
session_start();

//CONNEXION A LA BASE
require('../../connexionBDD.php');

//Input : text
if($_GET['input']=='activeEle'){
   if(!empty($_POST['eleActive'])){
      $ele=htmlspecialchars(addslashes($_POST['eleActive']));

      //On verifie que l'élé existe
      $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_numero='$ele';";
      $resEleExist = $mysqli->query($reqEleExist);

      if($resEleExist){
         if($resEleExist->num_rows){
            //On vérifie la validité de l'élé
            $reqValid="SELECT ele_etat FROM t_element_ele WHERE ele_numero='$ele';";
            $resValid = $mysqli->query($reqValid);

            if($resValid){
               $valid = $resValid->fetch_array(MYSQLI_ASSOC);

               // Si le compte est activé on le désactive
               if($valid['ele_etat']=='A'){
                  $reqModifVal="UPDATE t_element_ele SET ele_etat = 'D' WHERE ele_numero='$ele';";
                  $resModifVal = $mysqli->query($reqModifVal);
               }
               else{
                  $reqModifVal="UPDATE t_element_ele SET ele_etat = 'A' WHERE ele_numero='$ele';";
                  $resModifVal = $mysqli->query($reqModifVal);
               }

               //Si l'élément est désactivé on l'active
               if($resModifVal){
                  //Si tout marche
                  header("Location: ../admin_element.php?error=1#admin");
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
         //Si l'elealite' n'existe pas
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
   header("Location: ../admin_element.php?error=".$error."#admin");
   exit();
}

//Input : checkbox
else if($_GET['input']=='checkboxEleDes') {
   $ele=htmlspecialchars(addslashes($_GET['eleDes']));

   //On verifie que l'élé existe
   $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_numero='$ele';";
   $resEleExist = $mysqli->query($reqEleExist);

   if($resEleExist){
      if($resEleExist->num_rows){
         //Si la checkbox est cochée, on active le compte
         if(!empty($_POST['checkbox'])){
            $reqModifVal="UPDATE t_element_ele SET ele_etat = 'A' WHERE ele_numero = '$ele';";
            $resModifVal = $mysqli->query($reqModifVal);

            if(!$resModifVal){
               //LA requete a echoue
               $error=2;
            }
            else{
               header("Location: ../admin_element.php#admin");
               exit();
            }
         }
         else{
            $reqModifVal="UPDATE t_element_ele SET ele_etat = 'D' WHERE ele_numero = '$ele';";
            $resModifVal = $mysqli->query($reqModifVal);

            if(!$resModifVal){
               //LA requete a echoue
               $error=2;
            }
            else{
               header("Location: ../admin_element.php#admin");
               exit();
            }
         }
         header("Location: ../admin_element.php?error=".$error."#admin");
         exit();
      }
   }
}


//Ajout Élément
else if($_GET['input']=='newEle') {
   if(!empty($_POST['newEle']) and !empty($_POST['descEle']) and !empty($_POST['allSel']) and !empty($_POST['img'])){
      $sel=htmlspecialchars(addslashes($_POST['allSel']));
      $titre=htmlspecialchars(addslashes($_POST['newEle']));
      $desc=htmlspecialchars(addslashes($_POST['descEle']));
      $fichier=htmlspecialchars(addslashes($_POST['img']));

      $reqNewEle="INSERT INTO t_element_ele (ele_intitule, ele_descriptif, ele_date, ele_fichierImage, ele_etat)
                  VALUES ('$titre', '$desc', CURDATE(), '$fichier', 'D');
                  SET @id_ele=(SELECT MAX(ele_numero) FROM t_element_ele);
                  INSERT INTO tj_relie_rel (sel_numero, ele_numero) VALUES ($sel, @id_ele);";
      $resNewEle = $mysqli->multi_query($reqNewEle);
      if($resNewEle){
         header("Location: ../admin_element.php?errorNewEle=1#admin");
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
   header("Location: ../admin_element.php?errorNewEle=".$error."#admin");
   exit();
}

//Verif élément
elseif($_GET['input']=='id') {
   $ele=htmlspecialchars(addslashes($_POST['modifEle']));

   $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_numero='$ele';";
   $resEleExist = $mysqli->query($reqEleExist);

   if($resEleExist){
      if($resEleExist->num_rows){
         header("Location: ../admin_element.php?ele=".$ele."#admin");
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
   header("Location: ../admin_element.php?errorModifEle=".$error."#admin");
   exit();
}


//Modifer élément
else if($_GET['input']=='modifEle'){
   if(!empty($_GET['ele'])){
      $ele=htmlspecialchars(addslashes($_GET['ele']));

      //On verifie que l'élément existe
      $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_numero = '$ele';";
      $resEleExist = $mysqli->query($reqEleExist);

      if($resEleExist){
         if($resEleExist->num_rows){
            if(!empty($_POST['modifEleTitre']) or !empty($_POST['modifEleDesc']) or !empty($_POST['modifImg'])){
               if(!empty($_POST['modifEleTitre'])){
                  $titre=htmlspecialchars(addslashes($_POST['modifEleTitre']));

                  $reqModifTitre="UPDATE t_element_ele SET ele_intitule = '$titre' WHERE ele_numero = '$ele';";
                  $resModifTitre = $mysqli->query($reqModifTitre);

                  if(!$resModifTitre){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifEleDesc'])){
                  $desc=htmlspecialchars(addslashes($_POST['modifEleDesc']));

                  $reqModifDesc="UPDATE t_element_ele SET ele_descriptif='$desc' WHERE ele_numero = '$ele';";
                  $resModifDesc = $mysqli->query($reqModifDesc);
                  if(!$resModifDesc){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifImg'])){
                  $img=htmlspecialchars(addslashes($_POST['modifImg']));

                  $reqModifDesc="UPDATE t_element_ele SET ele_fichierImage='$img' WHERE ele_numero = '$ele';";
                  $resModifDesc = $mysqli->query($reqModifDesc);
                  if(!$resModifDesc){
                     //La requete a échoué
                     $error=2;
                  }
               }
               header("Location: ../admin_element.php?errorModifEle=1#admin");
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
   header("Location: ../admin_element.php?errorModifEle=".$error."#admin");
   exit();
}


//Supprimer élément
else if($_GET['input']=='suppEle'){
   if(!empty($_POST['eleSupp'])){
      $ele=htmlspecialchars(addslashes($_POST['eleSupp']));

      //On verifie que l'élément existe
      $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_numero='$ele';";
      $resEleExist = $mysqli->query($reqEleExist);

      if($resEleExist){
         if($resEleExist->num_rows){
            $reqSuppEle="DELETE FROM t_lien_lie
                         WHERE ele_numero = '$ele';
                         DELETE FROM tj_relie_rel
                         WHERE ele_numero = '$ele';
                         DELETE FROM t_element_ele
                         WHERE ele_numero = '$ele';";
            $resSuppEle=$mysqli->multi_query($reqSuppEle);

            if($resSuppEle){
               header("Location: ../admin_element.php?error=5;#admin");
               exit();
            }
            //Si tout marche
            else{
               //La reqeutes a échoué
               $error=2;
            }
         }
         //Si l'element n'existe pas'
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
   header("Location: ../admin_element.php?error=".$error."#admin");
   exit();
}


//S'il n'y a pas de $_GET
else{
   header("Location: ../admin_element.php#admin");
   exit();
}

$mysqli->close();
?>
