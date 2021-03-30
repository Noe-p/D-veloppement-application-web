<?php
//CONNEXION A LA BASE
require('connexionBDD.php');

//REQUETES


//actualités
$reqActu = "SELECT actu_titre, actu_texte, actu_date, com_pseudo
            FROM t_actualite_actu;";
$resActu = $mysqli->query($reqActu);

if(!$resActu){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Info Structure
$reqStruc = "SELECT pre_nomStruct, pre_adresse, pre_adresseMail, pre_numeroTel, pre_horaireOuverture, pre_texte
             FROM t_presentation_pre;";
$resStruc = $mysqli->query($reqStruc);

if(!$resStruc){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}
else{
   $struc = $resStruc->fetch_array(MYSQLI_ASSOC);
}

//Sélections
$reqSel = "SELECT DISTINCT sel_numero, sel_intitule, sel_texteIntro, sel_date, com_pseudo
           FROM t_selection_sel";
$resSel = $mysqli->query($reqSel);

if(!$resSel){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

$mysqli->close();
?>
