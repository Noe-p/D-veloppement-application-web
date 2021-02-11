<?php
   if($nbPre==0){
      echo "<style type=\"text/css\">.information.open .organisation {display: none;} </style>";
      echo "<style type=\"text/css\">.information.open .organisationNew {display: flex;} </style>";
   }
   else{
      echo "<style type=\"text/css\">.information.open .organisation {display: flex;} </style>";
      echo "<style type=\"text/css\">.information.open .organisationNew {display: none;} </style>";
   }
?>
<section>
   <h2>
      <?php echo $_SESSION['pseudo'] . ' :'; ?>
   </h2>
      <article class="infosUser">
         <ul>
            <li><B>Nom :</B> <?php echo $profil['pro_nom'] ?> </li>
            <li><B>Pénom :</B> <?php echo $profil['pro_prenom'] ?></li>
            <li><B>Mail :</B> <?php echo $profil['pro_mail'] ?></li>
            <li><B>Membre depuis le :</B> <?php echo $profil['pro_date'] ?></li>
         </ul>
      </article>
</section>

<section class="organisationNew">
   <h2>Vous faites partie d'une organisation ? </h2>
   <form action="profil.php" method="post">
      <article class="infosOrga">
         <div>
            <label for="nomOrga"><B>Nom :</B><br/></label>
            <input type="text" id="nomOrga" name="nomOrga" >
         </div>
         <div>
            <label for="adresseOrga"><B>Adresse :</B><br/></label>
            <input type="text" id="adresseOrga" name="adresseOrga" >
         </div>
         <div>
            <label for="mailOrga"><B>Mail :</B><br/></label>
            <input type="email" id="mailOrga" name="mailOrga" >
         </div>
         <div>
            <label for="telOrga"><B>Téléphone :</B><br/></label>
            <input type="text" id="telOrga" name="telOrga" >
         </div>
         <div>
            <label for="horaireOrga"><B>Horaire d'ouverture :</B><br/></label>
            <input type="text" id="horaireOrga" name="horaireOrga" >
         </div>
         <div>
            <label for="descriptionOrga"><B>Description :</B><br/></label>
            <input type="text" id="descriptionOrga" name="descriptionOrga" >
         </div>
         <div>
            <input class="buttonConnexionOrga" type="submit" value="Ajouter une organisation" id="submit"/>
         </div>
      </article>
   </form>
</section>

<section class="organisation">
   <h2>Où nous trouver : </h2>
      <article class="infosUser">
         <ul>
            <li><B>Nom :</B> <?php echo $pres['pre_nomStruct'] ?> </li>
            <li><B>Adresse :</B> <?php echo $pres['pre_adresse'] ?> </li>
            <li><B>Mail :</B> <?php echo $pres['pre_adresseMail'] ?> </li>
            <li><B>Téléphone :</B> <?php echo $pres['pre_numeroTel'] ?> </li>
            <li><B>Horaire d'ouverture :</B> <?php echo $pres['pre_horaireOuverture'] ?> </li>
            <li><B>Decription :</B> <?php echo $pres['pre_texte'] ?></li>
         </ul>
      </article>
</section>
