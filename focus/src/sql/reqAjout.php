<?php
require("config.php");

//Selection utilisateur
$resSel = mysqli_query($con, "SELECT sel_intitule FROM t_selection_sel WHERE com_pseudo = '$_SESSION[pseudo]'");
$nbSel=0;
while($reqSel = $resSel->fetch_array(MYSQLI_ASSOC)){
   $sel['sel_intitule'][$nbSel]=$reqSel['sel_intitule'];
   $nbSel++;
}
$con->close();
?>
