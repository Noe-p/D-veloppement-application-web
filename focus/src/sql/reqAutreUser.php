<?php
require("config.php");

//information user
$resProfil = mysqli_query($con, "SELECT * FROM t_profil_pro WHERE com_pseudo = '$_GET[pseudo]'");
$profil = $resProfil->fetch_array(MYSQLI_ASSOC);

//information Organisation
$resPre = mysqli_query($con, "SELECT * FROM t_presentation_pre WHERE com_pseudo = '$_GET[pseudo]'");
$nbPre = mysqli_num_rows($resPre);

$pres = $resPre->fetch_array(MYSQLI_ASSOC);

//Creation d'une organisation
if($nbPre==0 and empty($_POST['nomOrga'])==false){
   $sqlOrga="INSERT INTO `t_presentation_pre` (`pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`) VALUES ('$_POST[nomOrga]', '$_POST[adresseOrga]', '$_POST[mailOrga]', '$_POST[telOrga]', '$_POST[horaireOrga]', '$_POST[descriptionOrga]', '$_GET[pseudo]');";

   if (mysqli_query($con, $sqlOrga)) {
      header("Refresh: 0;");
   }
   else {
      echo "Erreur Compte: " . $sqlOrga . "<br>" . mysqli_error($con);
      mysqli_close($con);
   }
}

//Selection utilisateur
$resSel = mysqli_query($con, "SELECT * FROM t_selection_sel WHERE com_pseudo = '$_GET[pseudo]'");

//Element
$resEle = mysqli_query($con, "SELECT * FROM t_element_ele NATURAL JOIN tj_relie_rel NATURAL JOIN t_selection_sel WHERE com_pseudo = '$_GET[pseudo]' and sel_intitule='$_GET[selection]'");
$resAllEle = mysqli_query($con, "SELECT * FROM t_element_ele NATURAL JOIN tj_relie_rel NATURAL JOIN t_selection_sel WHERE com_pseudo = '$_GET[pseudo]' ORDER BY ele_numero DESC");


$con->close();
?>
