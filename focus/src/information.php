<?php
   if($nbPre==0){
      echo "<style type=\"text/css\">.information.open .organisation {display: none;} </style>";
   }
   else{
      echo "<style type=\"text/css\">.information.open .organisation {display: flex;} </style>";
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
