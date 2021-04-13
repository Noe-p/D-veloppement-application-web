<?php
session_start();

//CONNEXION A LA BASE
require('../connexionBDD.php');

if(!empty($_POST['mdp'])){
   $mdp=htmlspecialchars(addslashes($_POST['mdp']));

   $reqVerifMdp = "SELECT com_pseudo FROM t_compte_com
                   WHERE com_pseudo = '$_SESSION[login]'
                   AND com_mdp=MD5('$mdp')";
   $resVerifMdp = $mysqli->query($reqVerifMdp);
   if($resVerifMdp){
      if($resVerifMdp->num_rows){
         if(!empty($_POST['pseudo'])){
            $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));

            //verification si le compte existe déjà
            $reqUser = "SELECT com_pseudo FROM t_compte_com WHERE com_pseudo = '$pseudo'";
            $resUser = $mysqli->query($reqUser);

            if($resUser->num_rows == 1){
               //Pseudo existe déjà
               $probleme=1;
            }
            else{
               $reqModif="UPDATE t_compte_com SET com_pseudo ='$pseudo'
                          WHERE com_pseudo = '$_SESSION[login]';";
               $resModif=$mysqli->query($reqModif);

               if($resModif){
                  header("Location: admin_actualite.php?");
                  exit();
               }
               else{
                  //La requete à échoué
                  $probleme=2;
               }
            }
         }
         if(!empty($_POST['nom'])){
            $nom=htmlspecialchars(addslashes($_POST['nom']));

            $reqModif="UPDATE t_profil_pro SET pro_nom = '$nom'
                       WHERE com_pseudo = '$_SESSION[login]';";
            $resModif=$mysqli->query($reqModif);

            if($resModif){
               header("Location: admin_actualite.php?");
               exit();
            }
            else{
               //La requete à échoué
               $probleme=2;
            }
         }

         if(!empty($_POST['prenom'])){
            $prenom=htmlspecialchars(addslashes($_POST['prenom']));

            $reqModif="UPDATE t_profil_pro SET pro_prenom = '$prenom'
                       WHERE com_pseudo = '$_SESSION[login]';";
            $resModif=$mysqli->query($reqModif);

            if($resModif){
               header("Location: admin_actualite.php?");
               exit();
            }
            else{
               //La requete à échoué
               $probleme=2;
            }
         }

         if(!empty($_POST['email'])){
            $email=htmlspecialchars(addslashes($_POST['email']));

            $reqModif="UPDATE t_profil_pro SET pro_mail = '$email'
                       WHERE com_pseudo = '$_SESSION[login]';";
            $resModif=$mysqli->query($reqModif);

            if($resModif){
               header("Location: admin_actualite.php?");
               exit();
            }
            else{
               //La requete à échoué
               $probleme=2;
            }
         }
      }
      else{
         //Mauvais mot de passe
         $probleme=3;
      }
   }
   else{
      //La requete à échoué
      $probleme=2;
   }
}
else{
   //Entrer un mot de passe
   $probleme=2;
}

if($probleme!=0){
   //Information Utilisateur
   $reqInfoUser = "SELECT * FROM t_profil_pro WHERE com_pseudo = '$_SESSION[login]'";
   $resInfoUser = $mysqli->query($reqInfoUser);

   if(!$resInfoUser){
      echo "Error: La requête a echoué \n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit();
   }
   else{
      $infoUser = $resInfoUser->fetch_array(MYSQLI_ASSOC);
   }
echo"
   <!DOCTYPE html>
   <html lang='fr' dir='ltr'>

   <head>
      <meta charset='utf-8'>
      <link rel='stylesheet' href='../../css/connexion.css' />
      <link rel='stylesheet' href='../../css/navBar.css' />
      <link rel='stylesheet' href='../../css/footer.css' />


      <title>Focus</title>
   </head>

   <body>

      <?php require('../navBarConnexion.php'); ?>


      <section class='modifCompte createCompte'>
         <form action='modifUser_action.php' method='post'>
            <h2>Modifier le compte</h2>
            <span id='message4'>
            ";
            if($probleme==1){
               echo "Le pseudo existe déjà";
            }
            elseif($probleme==2){
               echo "La requête à échoué";
            }
            elseif($probleme==3){
               echo "Mauvais mot de passe";
            }
            echo"
            </span>
            <div>
               <label for='pseudo'><B>Pseudo :</B><br/></label>
               <input type='text' id='pseudo' name='pseudo' placeholder='".$_SESSION['login']."'>
            </div>
            <div>
               <label for='nom'><B>Nom :</B><br/></label>
               <input type='text' id='nom' name='nom' placeholder='".$infoUser['pro_nom']."'>
            </div>
            <div>
               <label for='prenom'><B>Prénom :</B><br/></label>
               <input type='text' id='prenom' name='prenom' placeholder='".$infoUser['pro_prenom']."'>
            </div>
            <div>
               <label for='createAdresseMail'><B>Mail :</B><br/></label>
               <input type='email' id='createAdresseMail' name='email' placeholder='".$infoUser['pro_mail']."'>
            </div>
            <div>
               <label for='mdp'><B>Mot de passe pour confirmer :</B><br/></label>
               <input type='password' id='create_mdp' name='mdp' minlength='8' placeholder='8 caractères minimum' required >
            </div>
            <div>
               <input class='buttonConnexion' type='submit' value='Modifier' id='submit'/>
            </div>
         </form>
      </section>



      <script type='text/javascript' src='../../js/navBar.js'></script>
   </body>

   </html>
";
}

$mysqli->close();
?>
