<?php
//CONNEXION A LA BASE
require('../connexionBDD.php');

//INSCRIPTION

   $probleme=0;
   $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
   $mdp=htmlspecialchars(addslashes($_POST['mdp']));
   $confirm_mdp=htmlspecialchars(addslashes($_POST['confirm_mdp']));
   $email=htmlspecialchars(addslashes($_POST['email']));
   $nom=htmlspecialchars(addslashes($_POST['nom']));
   $prenom=htmlspecialchars(addslashes($_POST['prenom']));

   //vérification si formulaire vide
   if(!empty($pseudo) and !empty($mdp) and !empty($confirm_mdp) and !empty($email) and !empty($prenom) and !empty($nom)){

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
               $probleme=4;
            }
            //création profil
            else{
               $reqPro="INSERT INTO t_profil_pro (pro_nom, pro_prenom, pro_mail, pro_validite, pro_statut, pro_date, com_pseudo) VALUES ('$nom', '$prenom', '$email', 'D', 'R', CURDATE(), '$pseudo');";
               $resPro=$mysqli->query($reqPro);

               if (!$resPro) {
                  $probleme=4;

                  //Suppression du compte si la requete profil a échoué
                  $reqSuppCmp="DELETE FROM t_compte_com WHERE com_pseudo='$pseudo'";
                  $resSuppCmp=$mysqli->query($reqSuppCmp);
               }
               //Si tout marche :
               else{
                  header("Location: session.php");
               }
            }
         }
      }
   }
   else{
      $probleme=3;
   }

   //Réécriture du fomulaire s'il y a des erreurs
   if($probleme!=0){
      echo "
      <!DOCTYPE html>
      <html lang='fr' dir='ltr'>

      <head>
         <meta charset='utf-8'>
         <link rel='stylesheet' href='../../css/connexion.css' />
         <link rel='stylesheet' href='../../css/navBar.css' />

         <title>Focus</title>
      </head>

      <body>

      ";
       require('../navBarConnexion.php');
      echo"
         <div class='utilisateur'>
            <a href='session.php'><img src='../../assets/logos/padlock_wo.png'></img>Connexion</a>
         </div>

         <section class='createCompte'>
         <form action='action.php' method='post'>
            <h2>Créer un compte</h2>
            <div>
               <label for='pseudo'><B>Pseudo :</B><br/></label>
               <input type='text' id='pseudo' name='pseudo' value='".$pseudo."' required>
               <span id='message2'></span>
            </div>
            <div>
               <label for='nom'><B>Nom :</B><br/></label>
               <input type='text' id='nom' name='nom' value='".$nom."' required>
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
               <input class='buttonConnexion' type='submit' value='Créer un compte' id='submit' disabled='false'/>
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
      else if($probleme==4){
         echo "
            <script>
               document.getElementById('message2').style.color = 'rgb(210, 28, 28)';
               document.getElementById('message2').innerHTML = 'Erreur lors de la création du compte';
               document.getElementById('message2').style.fontSize = '0.8em';
            </script>";
      }

      echo "
         <script type='text/javascript' src='../../js/checkPass.js'></script>
         <script type='text/javascript' src='../../js/functionCreate.js'></script>
      </body>

      </html>

      ";
   }

$mysqli->close();
?>
