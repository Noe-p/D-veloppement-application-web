-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 21 jan. 2021 à 14:55
-- Version du serveur :  10.3.9-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zfl2-zphilipno`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_relie_rel`
--

CREATE TABLE `tj_relie_rel` (
  `sel_numero` int(11) NOT NULL,
  `ele_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_actualite_actu`
--

CREATE TABLE `t_actualite_actu` (
  `actu_numero` int(11) NOT NULL,
  `actu_titre` varchar(500) NOT NULL,
  `actu_texte` varchar(500) NOT NULL,
  `actu_date` date NOT NULL,
  `actu_etat` char(1) NOT NULL,
  `com_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_com`
--

CREATE TABLE `t_compte_com` (
  `com_pseudo` varchar(60) NOT NULL,
  `com_mdp` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_element_ele`
--

CREATE TABLE `t_element_ele` (
  `ele_numero` int(11) NOT NULL,
  `ele_intitule` varchar(200) NOT NULL,
  `ele_descriptif` varchar(500) NOT NULL,
  `ele_date` date NOT NULL,
  `ele_fichierImage` varchar(100) NOT NULL,
  `ele_etat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_lien_lie`
--

CREATE TABLE `t_lien_lie` (
  `lie_numero` int(11) NOT NULL,
  `lie_titre` varchar(100) NOT NULL,
  `lie_url` varchar(200) NOT NULL,
  `lie_auteur` varchar(80) NOT NULL,
  `lie_date` date NOT NULL,
  `ele_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_presentation_pre`
--

CREATE TABLE `t_presentation_pre` (
  `pre_numero` int(11) NOT NULL,
  `pre_nomStruct` varchar(80) NOT NULL,
  `pre_adresse` varchar(100) NOT NULL,
  `pre_adresseMail` varchar(100) NOT NULL,
  `pre_numeroTel` varchar(10) NOT NULL,
  `pre_horaireOuverture` varchar(10) NOT NULL,
  `pre_texte` varchar(500) NOT NULL,
  `com_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_profil_pro`
--

CREATE TABLE `t_profil_pro` (
  `pro_nom` varchar(60) NOT NULL,
  `pro_prenom` varchar(60) NOT NULL,
  `pro_mail` varchar(30) NOT NULL,
  `pro_validite` varchar(30) NOT NULL,
  `pro_statut` char(1) NOT NULL,
  `pro_date` date NOT NULL,
  `com_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_selection_sel`
--

CREATE TABLE `t_selection_sel` (
  `sel_numero` int(11) NOT NULL,
  `sel_intitule` varchar(100) NOT NULL,
  `sel_texteIntro` varchar(500) NOT NULL,
  `sel_date` varchar(10) NOT NULL,
  `com_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tj_relie_rel`
--
ALTER TABLE `tj_relie_rel`
  ADD PRIMARY KEY (`sel_numero`,`ele_numero`),
  ADD KEY `fk_ele_numero` (`ele_numero`);

--
-- Index pour la table `t_actualite_actu`
--
ALTER TABLE `t_actualite_actu`
  ADD PRIMARY KEY (`actu_numero`),
  ADD KEY `com_pseudo` (`com_pseudo`);

--
-- Index pour la table `t_compte_com`
--
ALTER TABLE `t_compte_com`
  ADD PRIMARY KEY (`com_pseudo`);

--
-- Index pour la table `t_element_ele`
--
ALTER TABLE `t_element_ele`
  ADD PRIMARY KEY (`ele_numero`);

--
-- Index pour la table `t_lien_lie`
--
ALTER TABLE `t_lien_lie`
  ADD PRIMARY KEY (`lie_numero`),
  ADD KEY `ele_numero` (`ele_numero`);

--
-- Index pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  ADD PRIMARY KEY (`pre_numero`),
  ADD KEY `com_pseudo` (`com_pseudo`);

--
-- Index pour la table `t_profil_pro`
--
ALTER TABLE `t_profil_pro`
  ADD PRIMARY KEY (`pro_nom`),
  ADD KEY `com_pseudo` (`com_pseudo`);

--
-- Index pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  ADD PRIMARY KEY (`sel_numero`),
  ADD KEY `com_pseudo` (`com_pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_actualite_actu`
--
ALTER TABLE `t_actualite_actu`
  MODIFY `actu_numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_lien_lie`
--
ALTER TABLE `t_lien_lie`
  MODIFY `lie_numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  MODIFY `pre_numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  MODIFY `sel_numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tj_relie_rel`
--
ALTER TABLE `tj_relie_rel`
  ADD CONSTRAINT `fk_ele_numero` FOREIGN KEY (`ele_numero`) REFERENCES `t_element_ele` (`ele_numero`),
  ADD CONSTRAINT `fk_sel_numero` FOREIGN KEY (`sel_numero`) REFERENCES `t_selection_sel` (`sel_numero`);

--
-- Contraintes pour la table `t_actualite_actu`
--
ALTER TABLE `t_actualite_actu`
  ADD CONSTRAINT `t_actualite_actu_ibfk_1` FOREIGN KEY (`com_pseudo`) REFERENCES `t_compte_com` (`com_pseudo`);

--
-- Contraintes pour la table `t_lien_lie`
--
ALTER TABLE `t_lien_lie`
  ADD CONSTRAINT `t_lien_lie_ibfk_1` FOREIGN KEY (`ele_numero`) REFERENCES `t_element_ele` (`ele_numero`);

--
-- Contraintes pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  ADD CONSTRAINT `t_presentation_pre_ibfk_1` FOREIGN KEY (`com_pseudo`) REFERENCES `t_compte_com` (`com_pseudo`);

--
-- Contraintes pour la table `t_profil_pro`
--
ALTER TABLE `t_profil_pro`
  ADD CONSTRAINT `t_profil_pro_ibfk_1` FOREIGN KEY (`com_pseudo`) REFERENCES `t_compte_com` (`com_pseudo`);

--
-- Contraintes pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  ADD CONSTRAINT `t_selection_sel_ibfk_1` FOREIGN KEY (`com_pseudo`) REFERENCES `t_compte_com` (`com_pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
