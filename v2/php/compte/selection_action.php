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
               header("Location: admin_selection.php?error=1#admin");
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
      $error=7;
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
   exit();
}

//Input : Ajouter un éléments dans une sélection
else if($_GET['input']=='ajoutEleSel'){
   if(!empty($_POST['ajoutEleSel_sel'])){
      $sel=htmlspecialchars(addslashes($_POST['ajoutEleSel_sel']));

      //On verifie que la sélection existe
      $reqSelExist="SELECT sel_intitule FROM t_selection_sel WHERE sel_numero='$sel';";
      $resSelExist = $mysqli->query($reqSelExist);

      if($resSelExist->num_rows){
         if(!empty($_POST['ajoutEleSel_ele'])){
            $elt=htmlspecialchars(addslashes($_POST['ajoutEleSel_ele']));

            //On verifie que la l'élément existe
            $reqEleExist="SELECT ele_intitule FROM t_element_ele WHERE ele_intitule='$elt';";
            $resEleExist = $mysqli->query($reqEleExist);

            if($resEleExist->num_rows){
               $reqIdEle="SELECT ele_numero FROM t_element_ele
                          WHERE ele_intitule='$elt'";
               $resIdEle=$mysqli->query($reqIdEle);

               if($resIdEle){
                  $IdEle = $resIdEle->fetch_array(MYSQLI_ASSOC);
                  $reqAjoutEleSel="INSERT INTO tj_relie_rel (sel_numero, ele_numero) VALUES ('$sel', '$IdEle[ele_numero]');";
                  $resAjoutEleSel=$mysqli->query($reqAjoutEleSel);

                  if($resAjoutEleSel){
                     header("Location: admin_selection.php?error=1#admin");
                     exit();
                  }
                  else{
                     //La requete à échoué
                     $error=6;
                  }
               }
               else{
                  //La requète a échoué
                  $error=6;
               }
            }
            else{
               //L'éléments n'existe pas
               $error=5;
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
      //Entrer une sélection
      $error=7;
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
