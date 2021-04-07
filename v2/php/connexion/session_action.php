<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//CONNEXION
if ($_POST["pseudo"] && $_POST["mdp"]){
   $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
   $mdp=htmlspecialchars(addslashes($_POST['mdp']));

   $reqCom = "SELECT com_pseudo, com_mdp, pro_statut, pro_validite
              FROM t_compte_com
              JOIN t_profil_pro USING(com_pseudo)
              WHERE com_pseudo = '$pseudo'
              AND com_mdp=MD5('$mdp')";
   $resCom = $mysqli->query($reqCom);
   $nbCom = $resCom->num_rows;
   echo $nbCom;

   if (!$resCom) {
      echo "Error: La requête a échoué \n";
      echo "Query: " . $sql . "\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit;
   }
   else{
      $com = $resCom->fetch_array(MYSQLI_ASSOC);

      //Si un compte existe
      if($nbCom==1 && $com['pro_validite']=='A'){
         session_start();
         $_SESSION['login'] = $pseudo;
         $_SESSION['statut'] = $com['pro_statut'];

         header("Location: ../compte/admin_accueil.php");
         exit();
      }
      else if ($com['pro_validite']=='D') {
         include('session.php');

         echo "<script>
            document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
            document.getElementById('message3').innerHTML = 'La connexion a échoué, compte désactivé';
            document.getElementById('message3').style.fontSize = '0.8em';
            </script>";
      }
      else{
         include('session.php');

         echo "<script>
            document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
            document.getElementById('message3').innerHTML = 'Mauvais pseudo ou mot de passe';
            document.getElementById('message3').style.fontSize = '0.8em';
            </script>";
      }
   }
}
else{
   include('session.php');

   echo "<script>
      document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
      document.getElementById('message3').innerHTML = 'Entrer un pseudo et un mot de passe';
      document.getElementById('message3').style.fontSize = '0.8em';
      </script>";
}

$mysqli->close();
?>
