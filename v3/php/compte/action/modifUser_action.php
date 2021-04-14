<?php
session_start();

//CONNEXION A LA BASE
require('../../connexionBDD.php');

if($_GET['input']=='info'){
   $probleme=0;
   if(!empty($_POST['mdp_valide'])){
      $mdp=htmlspecialchars(addslashes($_POST['mdp_valide']));

      $reqVerifMdp = "SELECT com_pseudo FROM t_compte_com
                      WHERE com_pseudo = '$_SESSION[login]'
                      AND com_mdp=MD5('$mdp');";
      $resVerifMdp = $mysqli->query($reqVerifMdp);
      if($resVerifMdp){
         if($resVerifMdp->num_rows){
            if(!empty($_POST['nom'])){
               $nom=htmlspecialchars(addslashes($_POST['nom']));

               $reqModif="UPDATE t_profil_pro SET pro_nom = '$nom'
                          WHERE com_pseudo = '$_SESSION[login]';";
               $resModif=$mysqli->query($reqModif);

               if(!$resModif){
                  //La requete à échoué
                  $probleme=2;
               }
            }
            if(!empty($_POST['prenom'])){
               $prenom=htmlspecialchars(addslashes($_POST['prenom']));

               $reqModif="UPDATE t_profil_pro SET pro_prenom = '$prenom'
                          WHERE com_pseudo = '$_SESSION[login]';";
               $resModif=$mysqli->query($reqModif);

               if(!$resModif){
                  //La requete à échoué
                  $probleme=2;
               }
            }
            if(!empty($_POST['email'])){
               $email=htmlspecialchars(addslashes($_POST['email']));

               $reqModif="UPDATE t_profil_pro SET pro_mail = '$email'
                          WHERE com_pseudo = '$_SESSION[login]';";
               $resModif=$mysqli->query($reqModif);

               if(!$resModif){
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

   if($probleme==0){
      header("Location: ../admin_accueil.php");
      exit();
   }
   else{
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
         <link rel='stylesheet' href='../../../css/connexion.css' />
         <link rel='stylesheet' href='../../../css/navBar.css' />
         <link rel='stylesheet' href='../../../css/footer.css' />


         <title>Focus</title>
      </head>

      <body>

         ";require('../../navBarConnexion.php'); echo"

         <div class='modifInfo'>
            <section class='modifCompte createCompte'>
               <form action='modifUser_action.php?input=info' method='post'>
                  <h2>Modifier le compte</h2>
                  <span id='message4'>
                  ";
                  if($probleme==2){
                     echo "La requête à échoué";
                  }
                  elseif($probleme==3){
                     echo "Mauvais mot de passe";
                  }
                  echo"
                  </span>
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
                  <div class='mdp_confirm'>
                     <label for='mdp_valide'><B>Mot de passe pour confirmer :</B><br/></label>
                     <input type='password' id='mdp_valide' name='mdp_valide' minlength='8' placeholder='8 caractères minimum' required >
                  </div>
                  <div>
                     <input class='buttonConnexion' type='submit' value='Modifier' id='submit'/>
                  </div>
               </form>
            </section>

            <section class='modifMdp createCompte'>
               <form action='modifUser_action.php?input=mdp' method='post'>
                  <h2>Modifier le mot de passe</h2>
                  <span id='message4'>
                  ";
                  if(isset($_GET['error'])){
                     if(intval($_GET['error']) and !empty($_GET['error'])){
                        if($_GET['error']==1){
                           echo "Entrer un mot de passe pour confirmer";
                        }
                        elseif($_GET['error']==2){
                           echo "Le mot de passe n'est pas bon";
                        }
                        elseif($_GET['error']==3){
                           echo "Les mots de passes ne sont pas identiques";
                        }
                        elseif($_GET['error']==4){
                           echo "La reqête à échoué";
                        }
                        else{
                           echo "Erreur non reconnue";
                        }
                     }
                     else{
                        echo "Erreur non reconnue";
                     }
                  }
                  echo"
                  </span>
                  <div>
                     <label for='mdp'><B>Nouveau de passe :</B><br/></label>
                     <input type='password' id='create_mdp' name='mdp' minlength='8' placeholder='8 caractères minimum' onkeyup='check_pass();' required >
                  </div>
                  <div>
                     <label for='confirm_mdp'><B>Confirmer le mot de passe :</B><br/></label>
                     <input type='password' id='confirm_mdp' name='confirm_mdp' minlength='8' onkeyup='check_pass();' required>
                     <span id='message'></span>
                  </div>

                  <div class='mdp_confirm'>
                     <label for='mdp_valide'><B>Mot de passe pour confirmer :</B><br/></label>
                     <input type='password' id='mdp_valide' name='mdp_valide' minlength='8' placeholder='8 caractères minimum' required >
                  </div>
                  <div>
                     <input class='buttonConnexion' type='submit' value='Modifier' id='submit'/>
                  </div>
               </form>
            </section>
         </div>


         <script type='text/javascript' src='../../../js/navBar.js'></script>
      </body>

      </html>
   ";
   }
}


//Mot de passe
elseif($_GET['input']=='mdp'){
   if(!empty($_POST['mdp_valide'])){
      $mdp=htmlspecialchars(addslashes($_POST['mdp_valide']));

      $reqVerifMdp = "SELECT com_pseudo FROM t_compte_com
                      WHERE com_pseudo = '$_SESSION[login]'
                      AND com_mdp=MD5('$mdp')";
      $resVerifMdp = $mysqli->query($reqVerifMdp);
      if($resVerifMdp){
         if($resVerifMdp->num_rows){
            $mdp=htmlspecialchars(addslashes($_POST['mdp']));
            $confirm_mdp=htmlspecialchars(addslashes($_POST['confirm_mdp']));

            //verification mdp
            if(strcmp($mdp,$confirm_mdp)==0){
               $reqModif="UPDATE t_compte_com SET com_mdp = MD5('$mdp')
                          WHERE com_pseudo = '$_SESSION[login]';";
               $resModif=$mysqli->query($reqModif);

               if($resModif){
                  header("Location: ../../connexion/session.php");
                  exit();
               }
               else{
                  //requete a échoué
                  $error=4;
               }
            }
            else{
               //Les mot de passes ne sont pas identique
               $error=3;
            }
         }
         else{
            //Le mot de passe n'est pas bon
            $error=2;
         }
      }
      else{
         //La requête à échoué
         $error=4;
      }
   }
   else{
      //entrer un mot de passe pour Confirmer
      $error=1;
   }
   header("Location: ../admin_modifUser.php?error=".$error."");
   exit();
}


$mysqli->close();
?>
