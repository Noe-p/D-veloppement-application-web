//Compte - Profile
INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('gestionnaire1', MD5('gesWOSH_!21'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Philippe', 'Noé', 'noephilippe29@gmail.com', '1', '1', '2021-01-27', 'gestionnaire1');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Martin29', MD5('mdpmartin'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Le Floch', 'Martin', 'martin.lefloch@gmail.com', '1', '0', '2021-01-27', 'Martin29');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Roro', MD5('mdproro'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Tirilly', 'Romain', 'romain.Tirilly@gmail.com', '1', '0', '2021-01-27', 'Roro');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Claire', 'mdpclaire');

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Nicolas', 'Claire', 'claire.philippe@gmail.com', '1', '0', '2021-01-27', 'Claire');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Jojo', MD5('mdpjojo'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Philippe', 'Joris', 'joris.philippe@gmail.com', '1', '0', '2021-01-27', 'Jojo');


//Actualités
INSERT INTO `t_actualite_actu` (`actu_numero`, `actu_titre`, `actu_texte`, `actu_date`, `actu_etat`, `com_pseudo`)
VALUES ('1', 'La première actualité', 'Ceci est la première actualité de Jojo', '2021-01-27', '1', 'Jojo');

//Présentation
INSERT INTO `t_presentation_pre` (`pre_numero`, `pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`)
VALUES ('1', 'Galerie Photo', '1 rue des lilas - 29200 - Brest', 'galeriephotos@gmail.com', '0733894383', '8h', 'Exposition de photos dans la belle ville de Brest', 'Claire');

//Elements
INSERT INTO `t_element_ele` (`ele_numero`, `ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`)
VALUES ('1', 'photo teste', 'La première photos postée sur le site', '2021-01-27', '', '1');

//Selection
INSERT INTO `t_selection_sel` (`sel_numero`, `sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`)
VALUES ('1', 'Paysage', 'Toute les photos de paysage', '2021-01-27', 'gestionnaire1');

//table jointure
INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('1', '1'); 
