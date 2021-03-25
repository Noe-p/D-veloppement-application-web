<?php
//CONNEXION A LA BASE
$mysqli = new mysqli("obiwan2.univ-brest.fr", "zphilipno", "j98pkj9m", "zfl2-zphilipno");
if ($mysqli->connect_errno) {
   echo "Error: Problème de connexion à la BDD \n";
   echo "Errno: " . $mysqli->connect_errno . "\n";
   echo "Error: " . $mysqli->connect_error . "\n";

   exit();
}

if (!$mysqli->set_charset("utf8")) {
   printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
   exit();
}


//REQUETES INDEXE.PHP


//actualités
$reqActu = "SELECT actu_titre, actu_texte, actu_date, com_pseudo FROM t_actualite_actu;";
$resActu = $mysqli->query($reqActu);

if(!$resActu){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Info Structure
$reqStruc = "SELECT pre_nomStruct, pre_adresse, pre_adresseMail, pre_numeroTel, pre_horaireOuverture, pre_texte FROM t_presentation_pre;";
$resStruc = $mysqli->query($reqStruc);
$struc = $resStruc->fetch_array(MYSQLI_ASSOC);

if(!$resStruc){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

//Sélections
$reqSel = "SELECT sel_intitule, sel_texteIntro, sel_date, com_pseudo FROM t_selection_sel;";
$resSel = $mysqli->query($reqSel);

if(!$resActu){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}

$mysqli->close();
?>
