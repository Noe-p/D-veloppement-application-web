<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//Input : text
if($_GET['input']=='liste'){
   if(!empty($_POST['selection'])){
      if(!empty($_POST['element'])){
         $elt=htmlspecialchars(addslashes($_POST['element']));

         $reqIdEle="SELECT ele_numero FROM t_element_ele
                    JOIN tj_relie_rel USING(ele_numero)
                    JOIN t_selection_sel USING(sel_numero)
                    WHERE ele_intitule='$elt'";
         $resIdEle=$mysqli->query($reqIdEle);

         if(!$resIdEle or !$resIdEle->num_rows){
            //L'éléments n'est pas dans la sélection
            $error=3;
         }
         else{
            $IdEle = $resIdEle->fetch_array(MYSQLI_ASSOC);
            $reqModifVal="DELETE FROM tj_relie_rel
                          WHERE sel_numero='$_POST[selection]'
                          AND ele_numero='$IdEle[ele_numero]';";
            $resModifVal = $mysqli->query($reqModifVal);

            if(!$resModifVal){
               $error=3;
            }
            else{
               header("Location: admin_selection.php#admin");
               exit();
            }
         }
      }
      else {
         //Entrer un éléments
         $error=2;
      }
   }
   else{
      //Entrer une sélection
      $error=1;
   }
   header("Location: admin_accueil.php?error=".$error."#admin");
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
}

//S'il n'y a pas de $_GET
else{
   header("Location: admin_actualite.php#admin");
   exit();
}

$mysqli->close();

?>
