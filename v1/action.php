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

//INSCRIPTION
if ($_GET['action']=='inscription') {
   //verification si le compte existe déjà
   $reqUser = "SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = '$_POST[pseudo]'";
   $resUser = $mysqli->query($reqUser);


   if($resUser->num_rows == 1){
      include('inscription.php');
      echo "<script>
         document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
         document.getElementById('message2').innerHTML = 'Pseudo déjà utilisé';
         document.getElementById('message2').style.fontSize = '0.8em';
         </script>";
      }
   else{
      $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
      $mdp=htmlspecialchars(addslashes($_POST['mdp']));
      $confirm_mdp=htmlspecialchars(addslashes($_POST['confirm_mdp']));
      $email=htmlspecialchars(addslashes($_POST['email']));
      $nom=htmlspecialchars(addslashes($_POST['nom']));
      $prenom=htmlspecialchars(addslashes($_POST['prenom']));

      //verification mdp
      if(strcmp($mdp,$confirm_mdp)!==0){
         include('inscription.php');
         echo "<script>
            document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
            document.getElementById('message2').innerHTML = 'Pseudo déjà utilisé';
            document.getElementById('message2').style.fontSize = '0.8em';
            </script>";
      }
      //création compte
      else{
         $reqCom="INSERT INTO t_compte_com (com_pseudo, com_mdp) VALUES ('$pseudo', MD5('$mdp'))";
         $resCom= $mysqli->query($reqCom);

         if(!$resCom){
            echo "Error: La requête a échoué \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";

            $reqSuppCmp="DELETE FROM t_compte_com WHERE com_pseudo='$pseudo'";
            $resSuppCmp=$mysqli->query($reqSuppCmp);
            exit;
         }
         //création profil
         else{
            $reqPro="INSERT INTO t_profil_pro (pro_nom, pro_prenom, pro_mail, pro_validite, pro_statut, pro_date, com_pseudo) VALUES ('$nom', '$prenom', '$email', 'A', 'R', CURDATE(), '$pseudo');";
            $resPro=$mysqli->query($reqPro);

            if (!$resPro) {
               echo "Error: La requête a échoué \n";
               echo "Query: " . $sql . "\n";
               echo "Errno: " . $mysqli->errno . "\n";
               echo "Error: " . $mysqli->error . "\n";
               exit;
            }
            else{
               header("Location: connexion.php");
            }
         }
      }
   }
}

$mysqli->close();
?>
