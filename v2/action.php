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
   $probleme=0;

   //vérification si formulaire vide
   if(!empty($_POST['pseudo']) || !empty($_POST['mdp']) || !empty($_POST['confirm_mdp']) || !empty($_POST['email']) || !empty($_POST['nom']) || !empty($_POST['prenom'])){
      $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
      $mdp=htmlspecialchars(addslashes($_POST['mdp']));
      $confirm_mdp=htmlspecialchars(addslashes($_POST['confirm_mdp']));
      $email=htmlspecialchars(addslashes($_POST['email']));
      $nom=htmlspecialchars(addslashes($_POST['nom']));
      $prenom=htmlspecialchars(addslashes($_POST['prenom']));

      //verification si le compte existe déjà
      $reqUser = "SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = '$pseudo'";
      $resUser = $mysqli->query($reqUser);

      if($resUser->num_rows == 1){
         $probleme=1;
      }
      else{
         //verification mdp
         if(strcmp($mdp,$confirm_mdp)!==0){
            $probleme=2;
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
               exit();
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
                  exit();
               }
               //Si tout marche :
               else{
                  header("Location: connexion.php");
               }
            }
         }
      }
   }
   else{
      $probleme=3;
   }

   //Réécriture du fomulaire s'il y a des erreurs
   if($probleme==1 || $probleme==2 || $probleme==3){
      echo "
      <!DOCTYPE html>
      <html lang='fr' dir='ltr'>

      <head>
         <meta charset='utf-8'>
         <link rel='stylesheet' href='css/connexion.css' />
         <link rel='stylesheet' href='css/navBar.css' />

         <title>Focus</title>
      </head>

      <body>

      ";
       require('php/navBarConnexion.php');
      echo"
         <div class='utilisateur'>
            <a href='connexion.php'><img src='assets/logos/padlock.png'></img>Connexion</a>
         </div>

         <section class='createCompte'>
         <form action='action.php?action=inscription' method='post'>
            <h2>Créer un compte</h2>
            <div>
               <label for='pseudo'><B>Pseudo :</B><br/></label>
               <input type='text' id='pseudo' name='pseudo' value='".$pseudo."' required>
               <span id='message2'></span>
            </div>
            <div>
               <label for='nom'><B>Nom :</B><br/></label>
               <input type='text' id='nom' name='nom' value='".$nom."' required>
               <span id='message2'></span>
            </div>
            <div>
               <label for='prenom'><B>Prénom :</B><br/></label>
               <input type='text' id='prenom' name='prenom' value='".$prenom."' required>
            </div>
            <div>
               <label for='createAdresseMail'><B>Mail :</B><br/></label>
               <input type='email' id='createAdresseMail' name='email' value='".$email."' required>
            </div>
            <div>
               <label for='mdp'><B>Mot de passe :</B><br/></label>
               <input type='password' id='create_mdp' name='mdp' minlength='8' placeholder='8 caractères minimum' onkeyup='check_pass();' required >
            </div>
            <div>
               <label for='confirm_mdp'><B>Confirmer le mot de passe :</B><br/></label>
               <input type='password' id='confirm_mdp' name='confirm_mdp' minlength='8' onkeyup='check_pass();' required>
               <span id='message'></span>
            </div>
            <div>
               <input class='buttonConnexion' type='submit' value='Créer un compte' id='submit' disabled/>
            </div>
         </form>

         </section>
      ";
      if($probleme==1){
         echo "
            <script>
               document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
               document.getElementById('message2').innerHTML = 'Pseudo déja existant';
               document.getElementById('message2').style.fontSize = '0.8em';
            </script>";
      }
      else if($probleme==2){
         echo "
            <script>
               document.getElementById('message').style.color = 'rgb(210, 28, 28)';
               document.getElementById('message').innerHTML = '✗';
               document.getElementById('message').style.fontSize = '0.8em';
            </script>";
      }
      else if($probleme==3){
         echo "
            <script>
               document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
               document.getElementById('message2').innerHTML = 'Veuiller remplir tous les champs';
               document.getElementById('message2').style.fontSize = '0.8em';
            </script>";
      }

      echo "
         <script type='text/javascript' src='js/checkPass.js'></script>
         <script type='text/javascript' src='js/functionCreate.js'></script>
      </body>

      </html>

      ";
   }
}

//CONNEXION
elseif ($_GET['action']=='connexion') {
   $reqCom = "SELECT com_pseudo, com_mdp, pro_validite FROM t_compte_com JOIN t_profil_pro USING(com_pseudo) WHERE com_pseudo = '$_POST[pseudo]'";
   $resCom = $mysqli->query($reqCom);
   $Com = $resCom->fetch_array(MYSQLI_ASSOC);

   if (!$resCom) {
      echo "Error: La requête a échoué \n";
      echo "Query: " . $sql . "\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit;
   }

   if (($Com['com_pseudo'] != $_POST['pseudo']) and ($Com['com_mdp'] != md5($_POST['mdp']))) {
      include('connexion.php');

      echo "<script>
         document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
         document.getElementById('message3').innerHTML = 'Mauvais pseudo ou mot de passe';
         document.getElementById('message3').style.fontSize = '0.8em';
         </script>";
   }
   else if ($Com['pro_validite']=='D') {
      include('connexion.php');

      echo "<script>
         document.getElementById('message3').style.color = 'rgb(210, 28, 28)';
         document.getElementById('message3').innerHTML = 'La connexion a échoué, compte désactivé';
         document.getElementById('message3').style.fontSize = '0.8em';
         </script>";
   }
   else {
      session_start();
      $_SESSION['pseudo'] = $_POST['pseudo'];
      include('connexion.php');

      header("Location: profil.php");

   }
}

//DECONNEXION
elseif($_GET['action']=='deconnexion'){
   session_start();
   $_SESSION = array();
   session_destroy();

   header("Location: index.php");
}


$mysqli->close();
?>
