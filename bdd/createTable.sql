create table t_compte_com(
   com_pseudo VARCHAR(60) not null,
   com_mdp CHAR(32) not null,

   primary key (com_pseudo)
);
create table t_profil_pro(
   pro_nom VARCHAR(60) not null,
   pro_prenom VARCHAR(60) not null,
   pro_mail VARCHAR(30) not null,
   pro_validite CHAR(1) not null,
   pro_statut CHAR(1) not null,
   pro_date DATE not null,
   com_pseudo VARCHAR(60) not null,

   primary key (com_pseudo)
);
create table t_presentation_pre(
   pre_numero INTEGER not null,
   pre_nomStruct VARCHAR(80) not null,
   pre_adresse VARCHAR(100) not null,
   pre_adresseMail VARCHAR(100) not null,
   pre_numeroTel VARCHAR(10) not null,
   pre_horaireOuverture VARCHAR(10) not null,
   pre_texte VARCHAR(500) not null,
   com_pseudo VARCHAR(60) not null,

   primary key (pre_numero)
);

create table t_actualite_actu(
   actu_numero INTEGER not null,
   actu_titre VARCHAR(500) not null,
   actu_texte VARCHAR(500) not null,
   actu_date DATE not null,
   actu_etat CHAR(1) not null,
   com_pseudo VARCHAR(60) not null,

   primary key (actu_numero)
);

create table t_selection_sel(
   sel_numero INTEGER not null,
   sel_intitule VARCHAR(100) not null,
   sel_texteIntro VARCHAR(500) not null,
   sel_date DATE not null,
   com_pseudo VARCHAR(60) not null,

   primary key (sel_numero)
);

create table t_element_ele(
   ele_numero INTEGER not null,
   ele_intitule VARCHAR(200) not null,
   ele_descriptif VARCHAR(500) not null,
   ele_date DATE not null,
   ele_fichierImage VARCHAR(100) not null,
   ele_etat CHAR(1) not null,

   primary key (ele_numero)
);

create table tj_relie_rel(
   sel_numero INTEGER not null,
   ele_numero INTEGER not null,

   primary key (sel_numero, ele_numero)
);

create table t_lien_lie(
   lie_numero INTEGER not null,
   lie_titre VARCHAR(100) not null,
   lie_url VARCHAR(200) not null,
   lie_auteur VARCHAR(80) not null,
   lie_date DATE not null,
   ele_numero INTEGER not null,

   primary key (lie_numero)
);



Alter table t_lien_lie modify lie_numero int AUTO_INCREMENT;
Alter table t_presentation_pre modify pre_numero int AUTO_INCREMENT;
Alter table t_actualite_actu modify actu_numero int AUTO_INCREMENT;
Alter table t_selection_sel modify sel_numero int AUTO_INCREMENT;
Alter table t_element_ele modify ele_numero int AUTO_INCREMENT;

Alter table t_lien_lie
add foreign key (ele_numero) references t_element_ele (ele_numero);

Alter table t_profil_pro
add foreign key (com_pseudo) references t_compte_com (com_pseudo);

Alter table t_presentation_pre
add foreign key (com_pseudo) references t_compte_com (com_pseudo);

Alter table t_selection_sel
add foreign key (com_pseudo) references t_compte_com (com_pseudo);

Alter table t_actualite_actu
add foreign key (com_pseudo) references t_compte_com (com_pseudo);

Alter table tj_relie_rel
add CONSTRAINT fk_sel_numero foreign key (sel_numero) references t_selection_sel(sel_numero),
add CONSTRAINT fk_ele_numero foreign key (ele_numero) references t_element_ele(ele_numero);

ALTER TABLE `t_compte_com` CHANGE `com_mdp` `com_mdp` CHAR(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
