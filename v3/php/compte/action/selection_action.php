<?php
session_start();

//CONNEXION A LA BASE
require('../../connexionBDD.php');

//Input : text
if($_GET['input']=='activSel'){
   if(!empty($_POST['selection'])){
      //On verifie que la sélection existe
      $reqSelExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero='$sel';";
      $resSelExist = $mysqli->query($reqSelExist);

      if($resSelExist){
         if(!empty($_POST['element'])){
            //On verifie que la sélection existe
            $reqEleExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero='$sel';";
            $resEleExist = $mysqli->query($reqEleExist);

            if($resEleExist){
               $reqModifVal="DELETE FROM tj_relie_rel
                             WHERE sel_numero='$_POST[selection]'
                             AND ele_numero='$_POST[element]';";
               $resModifVal = $mysqli->query($reqModifVal);

               if($resModifVal){
                  header("Location: ../../admin_selection.php?error=1#admin");
                  exit();
               }
               else{
                  //La requete à échoué
                  $error=6;
               }
            }
            else{
               //La requete à échoué
               $error=6;
            }
         }
         else {
            //Entrer un éléments
            $error=2;
         }
      }
      else{
         //La requete à échoué
         $error=6;
      }
   }
   else{
      //Entrer une sélection
      $error=7;
   }
   header("Location: ../admin_selection.php?error=".$error."#admin");
   exit();
}

//Input : checkbox
else if($_GET['input']=='checkbox') {
   if(empty($_POST['checkbox'])){
      header("Location: ../admin_selection.php#admin");
      exit();
   }
   else{
      foreach($_POST['checkbox'] as $check){
         $reqModifVal="DELETE FROM tj_relie_rel WHERE ele_numero='$check';";
         $resModifVal = $mysqli->query($reqModifVal);

         if(!$resModifVal){
            //LA requète a échoué
            $error=3;
         }
      }
      header("Location: ../admin_selection.php#admin");
      exit();
   }
   header("Location: ../admin_selection.php?error=".$error."#admin");
   exit();
}

//Input : Ajouter un éléments dans une sélection
else if($_GET['input']=='ajoutEleSel'){
   if(!empty($_POST['ajoutEleSel_sel'])){
      $sel=htmlspecialchars(addslashes($_POST['ajoutEleSel_sel']));

      //On verifie que la sélection existe
      $reqSelExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero='$sel';";
      $resSelExist = $mysqli->query($reqSelExist);

      if($resSelExist){
         if($resSelExist->num_rows){
            if(!empty($_POST['ajoutEleSel_ele'])){
               $elt=htmlspecialchars(addslashes($_POST['ajoutEleSel_ele']));

               //On verifie que la l'élément existe
               $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_numero='$elt';";
               $resEleExist = $mysqli->query($reqEleExist);

               if($resEleExist){
                  if($resEleExist->num_rows){
                     $reqAjoutEleSel="INSERT INTO tj_relie_rel (sel_numero, ele_numero) VALUES ('$sel', '$elt');";
                     $resAjoutEleSel=$mysqli->query($reqAjoutEleSel);

                     if($resAjoutEleSel){
                        header("Location: ../admin_selection.php?error=8#admin");
                        exit();
                     }
                     else{
                        //La requete à échoué
                        $error=6;
                     }
                  }
                  else{
                     //L'éléments n'existe pas
                     $error=5;
                  }
               }
               else{
                  //La requete à échoué
                  $error=6;
               }
            }
            else{
               //Entrer un élément
               $error=2;
            }
         }
         else{
            //La sélection n'existe pas
            $error=4;
         }
      }
      else{
         //La reqeuet à échoué
         $error=6;
      }
   }
   else{
      //Entrer une sélection
      $error=7;
   }
   header("Location: ../admin_selection.php?error=".$error."#admin");
   exit();
}

//Ajout Élément
else if($_GET['input']=='newSel') {
   if(!empty($_POST['newSel']) and !empty($_POST['descSel'])){
      $titre=htmlspecialchars(addslashes($_POST['newSel']));
      $desc=htmlspecialchars(addslashes($_POST['descSel']));

      $reqNewSel="INSERT INTO t_selection_sel (sel_intitule, sel_texteIntro, sel_date, com_pseudo)
                  VALUES ('$titre', '$desc', CURDATE(), '$_SESSION[login]');";
      $resNewSel = $mysqli->query($reqNewSel);
      if($resNewSel){
         header("Location: ../admin_selection.php?errorNewSel=1#admin");
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
   header("Location: ../admin_selection.php?errorNewSel=".$error."#admin");
   exit();
}

//Modifer sélection
else if($_GET['input']=='modifSel'){
   if(!empty($_POST['modifSel'])){
      $sel=htmlspecialchars(addslashes($_POST['modifSel']));

      //On verifie que la sélection existe
      $reqSelExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero = '$sel';";
      $resSelExist = $mysqli->query($reqSelExist);

      if($resSelExist){
         if($resSelExist->num_rows){
            if(!empty($_POST['modifSelTitre']) or !empty($_POST['modifSelDesc'])){
               if(!empty($_POST['modifSelTitre'])){
                  $titre=htmlspecialchars(addslashes($_POST['modifSelTitre']));

                  $reqModifTitre="UPDATE t_selection_sel SET sel_intitule = '$titre' WHERE sel_numero = '$sel';";
                  $resModifTitre = $mysqli->query($reqModifTitre);

                  if(!$resModifTitre){
                     //La requete a échoué
                     $error=2;
                  }
               }
               if(!empty($_POST['modifSelDesc'])){
                  $desc=htmlspecialchars(addslashes($_POST['modifSelDesc']));

                  $reqModifDesc="UPDATE t_selection_sel SET sel_descriptif='$desc' WHERE sel_numero = '$sel';";
                  $resModifDesc = $mysqli->query($reqModifDesc);
                  if(!$resModifDesc){
                     //La requete a échoué
                     $error=2;
                  }
               }

               header("Location: ../admin_selection.php?errorModifSel=1#admin");
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
      //Pas de sélection sélectionné
      $error=5;
   }
   header("Location: ../admin_selection.php?errorModifSel=".$error."#admin");
   exit();
}


//Suppresion sélection
else if($_GET['input']=='suppSel'){
   if(!empty($_POST['suppSel_sel'])){
      $sel=htmlspecialchars(addslashes($_POST['suppSel_sel']));

      //On verifie que la sélection existe
      $reqSelExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero='$sel';";
      $resSelExist = $mysqli->query($reqSelExist);

      if($resSelExist){
         if($resSelExist->num_rows){
            $reqSuppSel="DELETE FROM tj_relie_rel
                         WHERE sel_numero = '$sel';
                        DELETE FROM t_selection_sel
                        WHERE sel_numero = '$sel';";
            $resSuppSel=$mysqli->multi_query($reqSuppSel);

            if($resSuppSel){
               header("Location: ../admin_selection.php?error=9;#admin");
               exit();
            }
            //Si tout marche
            else{
               //La reqeutes a échoué
               $error=6;
            }
         }
         //Si la sélection n'existe pas'
         else{
            $error=4;
         }
      }
      else{
         //La requete à échoué
         $error=6;
      }
   }
   //Si l'input est vide
   else{
      $error=7;
   }
   header("Location: ../admin_selection.php?error=".$error."#admin");
   exit();
}

//S'il n'y a pas de $_GET
else{
   header("Location: admin_actualite.php#admin");
   exit();
}

$mysqli->close();

?>
