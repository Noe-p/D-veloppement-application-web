//Compte - Profile
INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('gestionnaire1', MD5('gesWOSH_!21'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Philippe', 'Noé', 'noephilippe29@gmail.com', 'A', 'A', '2021-01-27', 'gestionnaire1');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Martin29', MD5('mdpmartin'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Le Floch', 'Martin', 'martin.lefloch@gmail.com', 'A', 'R', '2021-01-27', 'Martin29');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Roro', MD5('mdproro'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Tirilly', 'Romain', 'romain.Tirilly@gmail.com', 'A', 'R', '2021-01-27', 'Roro');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Claire', 'mdpclaire');

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Nicolas', 'Claire', 'claire.philippe@gmail.com', 'A', 'R', '2021-01-27', 'Claire');


INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`)
VALUES ('Jojo', MD5('mdpjojo'));

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`)
VALUES ('Philippe', 'Joris', 'joris.philippe@gmail.com', 'A', 'R', '2021-01-27', 'Jojo');


//Actualités
INSERT INTO `t_actualite_actu` (`actu_titre`, `actu_texte`, `actu_date`, `actu_etat`, `com_pseudo`)
VALUES ('La première actualité', 'Ceci est la première actualité de Jojo', CURDATE(), 'A', 'Jojo');

INSERT INTO `t_actualite_actu` (`actu_titre`, `actu_texte`, `actu_date`, `actu_etat`, `com_pseudo`)
VALUES ('Sortie Photo', 'J\'organise une sortie photo dans les rues de Brest', CURDATE(), 'A', 'Claire');

INSERT INTO `t_actualite_actu` (`actu_titre`, `actu_texte`, `actu_date`, `actu_etat`, `com_pseudo`)
VALUES ('Exposition', 'Nous organisons une exposition', CURDATE(), 'A', 'Martin29');

INSERT INTO `t_actualite_actu` (`actu_titre`, `actu_texte`, `actu_date`, `actu_etat`, `com_pseudo`)
VALUES ('Vente', 'J\'organise ma premiere vente ce vendredi', CURDATE(), 'A', 'Jojo');

//Présentation
INSERT INTO `t_presentation_pre` (`pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`)
VALUES ('Galerie Photo', '1 rue des lilas - 29200 - Brest', 'galeriephotos@gmail.com', '0733894383', '8h', 'Exposition de photos dans la belle ville de Brest', 'Claire');

INSERT INTO `t_presentation_pre` (`pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`)
VALUES ('PhotoByBrest', ' rue des loges - 29200 - Brest', 'photoByBrest@gmail.com', '0745894847', '8h', 'Echange de photos', 'Claire');

INSERT INTO `t_presentation_pre` (`pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`)
VALUES ('Les photographes', '63  rue de verdun - 29000 - Quimper', 'nonozozo@gmail.com', '0731554525', '9h', 'Donnation de photos', 'Jojo');

INSERT INTO `t_presentation_pre` (`pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`)
VALUES ('PhotoPaysage', '9 rue des palmiers - 29200 - Brest', 'photoPayage@gmail.com', '0733894383', '8h', 'Exposition de photos', 'Claire');

//Elements
INSERT INTO `t_element_ele` (`ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`)
VALUES ('photo teste', 'La première photos postée sur le site', '2021-01-27', 'photo.jpg', 'A');

INSERT INTO `t_element_ele` (`ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`)
VALUES ('photo Brest', 'Sortie photo dans les rue de Brest', '2021-01-27', 'brest.jpg', 'A');

INSERT INTO `t_element_ele` (`ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`)
VALUES ('portait', 'Portait d\'une personne dans la rue', CURDATE(), 'portait.jpg', 'A');

INSERT INTO `t_element_ele` (`ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`)
VALUES ('paysage', 'Brest la nuit', CURDATE(), 'brestNuit.jpg', 'A');


//Selection
INSERT INTO `t_selection_sel` (`sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`)
VALUES ('Paysage', 'Toute les photos de paysage', '2021-01-27', 'gestionnaire1');

INSERT INTO `t_selection_sel` (`sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`)
VALUES ('Portait', 'Toute les photos de portait', CURDATE(), 'Claire');

INSERT INTO `t_selection_sel` (`sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`)
VALUES ('Brest', 'Toute les photos de Brest', CURDATE(), 'Roro');

INSERT INTO `t_selection_sel` (`sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`)
VALUES ('Quimper', 'Toute les photos de Quimper', CURDATE(), 'Martin29');

//table jointure
INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('1', '1');

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('1', '2');

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('3', '2');

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('1', '4');

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('3', '4');

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('2', '3');

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`)
VALUES ('4', '3');

//liens
INSERT INTO `t_lien_lie` (`lie_numero`, `lie_titre`, `lie_url`, `lie_auteur`, `lie_date`, `ele_numero`)
VALUES ('1', 'Article', 'https://photographie-bretagne.fr', 'Jean Michel ', '2021-02-01', '4');

INSERT INTO `t_lien_lie` (`lie_titre`, `lie_url`, `lie_auteur`, `lie_date`, `ele_numero`)
VALUES ('Concour', 'https://concour-photos.fr', 'Arthur Toupin ', CURDATE(), '1');

INSERT INTO `t_lien_lie` (`lie_titre`, `lie_url`, `lie_auteur`, `lie_date`, `ele_numero`)
VALUES ('Prix photographie', 'https://photo-amateur.fr', 'Alexandre Astier ', CURDATE(), '2');
