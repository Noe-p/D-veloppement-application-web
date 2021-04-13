<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//Input : text
if($_GET['input']=='liste'){
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
                  header("Location: admin_selection.php?error=1#admin");
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
   header("Location: admin_selection.php?error=".$error."#admin");
   exit();
}

//Input : checkbox
else if($_GET['input']=='checkbox') {
   if(empty($_POST['checkbox'])){
      header("Location: admin_selection.php#admin");
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
      header("Location: admin_selection.php#admin");
      exit();
   }
   header("Location: admin_selection.php?error=".$error."#admin");
   exit();
}

//S'il n'y a pas de $_GET
else{
   header("Location: admin_actualite.php#admin");
   exit();
}

$mysqli->close();

?>
