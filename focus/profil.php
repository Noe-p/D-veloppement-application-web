<?php
session_start();
require("php/config.php");

//information User
$resProfil = mysqli_query($con, "SELECT * FROM t_profil_pro WHERE com_pseudo = '$_SESSION[pseudo]'");
$profil = $resProfil->fetch_array(MYSQLI_ASSOC);

//information Organisation
$resPre = mysqli_query($con, "SELECT * FROM t_presentation_pre WHERE com_pseudo = '$_SESSION[pseudo]'");
$nbPre = mysqli_num_rows($resPre);

$pres = $resPre->fetch_array(MYSQLI_ASSOC);

//Creation d'une organisation
if($nbPre==0 and empty($_POST['nomOrga'])==false){
   $sqlOrga="INSERT INTO `t_presentation_pre` (`pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`) VALUES ('$_POST[nomOrga]', '$_POST[adresseOrga]', '$_POST[mailOrga]', '$_POST[telOrga]', '$_POST[horaireOrga]', '$_POST[descriptionOrga]', '$_SESSION[pseudo]');";

   if (mysqli_query($con, $sqlOrga)) {
      header("Refresh: 0;");
   }
   else {
      echo "Erreur Compte: " . $sqlOrga . "<br>" . mysqli_error($con);
      mysqli_close($con);
   }
}

//Selection utilisateur
$resSel = mysqli_query($con, "SELECT * FROM t_selection_sel WHERE com_pseudo = '$_SESSION[pseudo]'");
$nbSel=0;
while($reqSel = $resSel->fetch_array(MYSQLI_ASSOC)){
   $sel['sel_intitule'][$nbSel]=$reqSel['sel_intitule'];
   $nbSel++;
}

$resTexteSel = mysqli_query($con,"SELECT sel_texteIntro FROM t_selection_sel WHERE com_pseudo = '$_SESSION[pseudo]' AND sel_intitule = '$_GET[selection]'");
$texteSel = mysqli_fetch_assoc($resTexteSel);

//Element
$resEle = mysqli_query($con, "SELECT * FROM t_element_ele NATURAL JOIN tj_relie_rel NATURAL JOIN t_selection_sel WHERE com_pseudo = '$_SESSION[pseudo]' and sel_intitule='$_GET[selection]'");
$nbEle=0;
while($reqEle = $resEle->fetch_array(MYSQLI_ASSOC)){
   $ele['ele_intitule'][$nbEle]=$reqEle['ele_intitule'];
   $ele['ele_fichierImage'][$nbEle]=$reqEle['ele_fichierImage'];
   $ele['ele_descriptif'][$nbEle]=$reqEle['ele_descriptif'];
   $nbEle++;
}

$resAllEle = mysqli_query($con, "SELECT DISTINCT ele_intitule, ele_fichierImage, ele_descriptif, ele_etat FROM t_element_ele NATURAL JOIN tj_relie_rel NATURAL JOIN t_selection_sel WHERE com_pseudo = '$_SESSION[pseudo]' ORDER BY ele_numero DESC");
$nbAllEle=0;
while($reqAllEle = $resAllEle->fetch_array(MYSQLI_ASSOC)){
   $allEle['ele_intitule'][$nbAllEle]=$reqAllEle['ele_intitule'];
   $allEle['ele_fichierImage'][$nbAllEle]=$reqAllEle['ele_fichierImage'];
   $allEle['ele_descriptif'][$nbAllEle]=$reqAllEle['ele_descriptif'];
   $allEle['ele_etat'][$nbAllEle]=$reqAllEle['ele_etat'];
   $nbAllEle++;
}


//Element activé
$resEleAct= mysqli_query($con, "SELECT ele_intitule FROM t_element_ele JOIN tj_relie_rel USING(ele_numero) JOIN t_selection_sel USING(sel_numero) WHERE ele_etat='A' AND com_pseudo='$_SESSION[pseudo]'");
$nbEleAct=0;
while($reqEleAct = $resEleAct->fetch_array(MYSQLI_ASSOC)){
   $eleAct['ele_intitule'][$nbEleAct]=$reqEleAct['ele_intitule'];
   $nbEleAct++;
}

//Element désativé
$resEleDes= mysqli_query($con, "SELECT ele_intitule FROM t_element_ele JOIN tj_relie_rel USING(ele_numero) JOIN t_selection_sel USING(sel_numero) WHERE ele_etat='D' AND com_pseudo='$_SESSION[pseudo]'");
$nbEleDes=0;
while($reqEleDes = $resEleDes->fetch_array(MYSQLI_ASSOC)){
   $eleDes['ele_intitule'][$nbEleDes]=$reqEleDes['ele_intitule'];
   $nbEleDes++;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Focus-Compte</title>

      <link rel="stylesheet" href="css/profil.css" />
      <link rel="stylesheet" href="css/navBar.css" />
   </head>
   <body>


      <?php require('php/navBar.php'); ?>

      <!-- HEADER -->

      <header>
         <?php
            if($profil['pro_statut']=='R'){
               echo "<style type=\"text/css\"> .button2{display: none;} </style>";
            }
         ?>
         <div class="buttonsHeader">
            <a class="button1 open" href="#">Profil</a>
            <a class="button2" href="#">Administration</a>
            <a class="button3" href="#">Modifier</a>
         </div>

         <div class="administration create">
            <?php require('php/administration.php'); ?>
         </div>

         <div class="information create open">
            <?php require('php/information.php'); ?>
         </div>

         <div class="modifier create">
            <?php require('php/modifier.php'); ?>
         </div>

      </header>

      <!-- PUBLICATION -->

      <div id="selProfil" class="buttonsSelection">
         <a href="profil.php?selection=Photos#selProfil">Photos</a>
         <?php
         for ($j=0; $j <$nbSel ; $j++) {
            echo "<a href=\"profil.php?selection=".$sel['sel_intitule'][$j]."#selProfil\">".$sel['sel_intitule'][$j]."</a>";
         }
         ?>
      </div>

      <h2><?php echo $_GET['selection']; ?> :</h2>
      <p>
         <?php
         if($_GET['selection'] != 'Photos'){
            echo $texteSel['sel_texteIntro']." :";
         }
         else{
            echo "Dernière photos publiées : ";
         }
         ?>
      </p>

      <section class="publication">
         <?php
         if($_GET['selection']!='Photos'){
            for ($j=0; $j <$nbEle ; $j++) {
               echo "<article class=\"imgUser\">
                        <div class=\"headerPublic\">
                           <a href=\"#\">"; echo $_SESSION['pseudo']; echo " </a>
                           <h3>"; echo $ele['ele_intitule'][$j]; echo "</h3>
                        </div>
                        <img src=\"assets/img/".$ele['ele_fichierImage'][$j]."\">
                        <p>"; echo $ele['ele_descriptif'][$j]; echo "</p>
                     </article>";
            }
         }
         else{
            for ($j=0; $j <$nbAllEle ; $j++) {
               echo "<article class=\"imgUser\">
                        <div class=\"headerPublic\">
                           <a href=\"#\">"; echo $_SESSION['pseudo']; echo " </a>
                           <h3>"; echo $allEle['ele_intitule'][$j]; echo "</h3>
                        </div>
                        <img src=\"assets/img/".$allEle['ele_fichierImage'][$j]."\">
                        <p>"; echo $allEle['ele_descriptif'][$j]; echo "</p>
                     </article>";
            }
         }
         ?>
      </section>

      <script type="text/javascript" src="js/createElement.js"></script>
      <script type="text/javascript" src="js/navBar.js"></script>
      <script type="text/javascript" src="js/checkPass.js"></script>

   </body>
</html>
