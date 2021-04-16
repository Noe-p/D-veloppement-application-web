-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 16 avr. 2021 à 10:19
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

--
-- Déchargement des données de la table `tj_relie_rel`
--

INSERT INTO `tj_relie_rel` (`sel_numero`, `ele_numero`) VALUES
(1, 1),
(1, 3),
(1, 5),
(1, 6),
(1, 12),
(1, 19),
(1, 22),
(2, 3),
(2, 5),
(2, 6),
(2, 7),
(2, 92),
(3, 3),
(3, 5),
(3, 6),
(3, 7),
(3, 12),
(3, 19),
(3, 22),
(4, 1),
(4, 92),
(6, 93),
(6, 94),
(11, 1),
(19, 113),
(19, 114),
(19, 115),
(19, 116);

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

--
-- Déchargement des données de la table `t_actualite_actu`
--

INSERT INTO `t_actualite_actu` (`actu_numero`, `actu_titre`, `actu_texte`, `actu_date`, `actu_etat`, `com_pseudo`) VALUES
(3, 'Exposition', 'Nous organisons une exposition Au marché de st Martin', '2021-02-01', 'A', 'Martin29'),
(4, 'Portait', 'Recherche d\'un modèle pour un portrait dans les alentours de Brest', '2021-02-01', 'A', 'Jojo'),
(5, 'Cours', 'J\'organise des cours de photograpie le 10/05/2021 à Brest', '2021-04-06', 'A', 'Clem'),
(13, 'Sortie photo', 'J\'organise une sortie photo dans les rue de Brest ce week-end', '2021-04-09', 'A', 'Clem'),
(26, 'Informations', 'Bonjour, je suis nouveau sur ce showRoom et j\'aimerai me renseigner sur les appareils photos hybrides.', '2021-04-15', 'D', 'Nono');

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_com`
--

CREATE TABLE `t_compte_com` (
  `com_pseudo` varchar(60) NOT NULL,
  `com_mdp` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_compte_com`
--

INSERT INTO `t_compte_com` (`com_pseudo`, `com_mdp`) VALUES
('Claire', '7dc22330fb76c8818179908f9620c179'),
('Clem', '433729221beffc6b9005ae3c8a2b81a9'),
('gestionnaire1', '388d4ca7d89f912a8fe96b04fb3d8e22'),
('Jojo', '75232da3f3a8b16fbcd30fae1c8cc561'),
('Martin29', '101081cdde29d4b27b50a6b41c26c723'),
('Mumu', '77f2c853da3918c2e12ec2404e16b119'),
('noel', '8bb9260e4d670bd2269224ac2286e1ac'),
('Nono', '18e00cfdb927b86bc34f22ca1647f47b'),
('OSS117', '4de222d9cddcb74b9656eb41ad08c74c'),
('Roro', '0f0f8433b45219ef88675af6f6802327'),
('tri_32', 'b919d239f40c22143b3e0998cfcb6e53');

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

--
-- Déchargement des données de la table `t_element_ele`
--

INSERT INTO `t_element_ele` (`ele_numero`, `ele_intitule`, `ele_descriptif`, `ele_date`, `ele_fichierImage`, `ele_etat`) VALUES
(1, 'Stangala', 'Photo prise dans la forêt du Stangala près de Quimper', '2021-01-27', 'img29.jpg', 'D'),
(2, 'Grues de Brest', 'Voici deux grues du port de commerce de Brest', '2021-01-27', 'img2.jpg', 'A'),
(3, 'Sortie photo', 'Petite sortie photo aux alentours de Brest', '2021-02-01', 'img3.jpg', 'A'),
(4, 'Phare du Portzic', 'Lors d\'une balade au phare du portzic', '2021-02-01', 'img4.jpg', 'D'),
(5, 'Phare du Portzic 2', 'Lors d\'une balade au phare du portzic', '2021-03-04', 'img5.jpg', 'A'),
(6, 'Phare du Portzic 3', 'Lors d\'une balade au phare du portzic', '2021-03-04', 'img6.jpg', 'A'),
(7, 'Josiane', 'Premier portait ', '2021-02-08', 'img7.jpg', 'A'),
(12, 'Brest', 'Pont de Brest', '2021-02-01', 'img8.jpg', 'A'),
(19, 'Prison ', 'Photo de la prison abandonnée aux Capucins', '2021-02-07', 'img9.jpg', 'A'),
(22, 'Bateau ', 'Bateau dans le port de Brest', '2021-02-08', 'img22.jpg', 'A'),
(85, 'Stair', 'Sortie photo près des Capucins à Brest', '2021-02-11', 'img10.jpg', 'D'),
(86, 'Usine', 'Photo des usines de Brest', '2021-03-01', 'img11.jpg', 'A'),
(87, 'Brest', 'Photo du port de commerce de Brest', '2021-03-01', 'img12.jpg', 'A'),
(88, 'Les Capucins', 'Photo des Capucins à Brest', '2021-03-01', 'img15.jpg', 'A'),
(92, 'newTitre2', 'newTexte', '2021-04-06', 'img28.jpg', 'A'),
(93, 'Couché de soleil', 'Coucher de soleil à Brest', '2021-04-06', 'img23.jpg', 'A'),
(94, 'Immeuble', 'Cartier de Brest lors d\'un choucher de soleil', '2021-04-06', 'img27.jpg', 'A'),
(95, 'newTitre', 'newTexte', '2021-04-13', 'newImg.jpg', 'A'),
(101, 'qrsdg', 'sdgv', '2021-04-13', 'img10.jpg', 'D'),
(102, 'dgr', 'qdsgf', '2021-04-13', 'img12.jpg', 'D'),
(113, 'Baklava', 'Spécialité Turque ', '2021-04-15', 'tur1.jpg', 'A'),
(114, 'Lac', 'Lors d\'une randonné autour d\'un lac', '2021-04-15', 'tur3.jpg', 'A'),
(115, 'Camping Sauvage', 'Camping sauvage sur les bords de la mer noire', '2021-04-15', 'tur4.jpg', 'A'),
(116, 'La Cappadoce', 'Randonnée en Cappadoce', '2021-04-15', 'tur5.jpg', 'A'),
(118, 'ghfj', 'gyfhjnf', '2021-04-16', 'img6.jpg', 'A');

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

--
-- Déchargement des données de la table `t_lien_lie`
--

INSERT INTO `t_lien_lie` (`lie_numero`, `lie_titre`, `lie_url`, `lie_auteur`, `lie_date`, `ele_numero`) VALUES
(6, 'Usine', 'https://www.instagram.com/p/CMFVqKZgY9dp9oPXGbVXl7rFYxpmHMFI3mLKZw0/', 'Noé', '2021-04-14', 86),
(7, 'Brest', 'https://www.instagram.com/p/CMFVqKZgY9dp9oPXGbVXl7rFYxpmHMFI3mLKZw0/', 'Noé', '2021-04-14', 87),
(8, 'Stangala', 'https://www.instagram.com/p/CMFVqKZgY9dp9oPXGbVXl7rFYxpmHMFI3mLKZw0/', 'Noé', '2021-04-14', 1),
(9, 'Abeille', 'https://www.instagram.com/p/CJ_nutOgpep2dGHkaMe4AKPQLrOMvANkNTyc9A0/', 'Noé', '2021-04-14', 22),
(11, 'Grues', 'https://www.instagram.com/p/CJ391FJgJebyyyIbacvKiR37s6keorAp2_mtHg0/', 'Noé', '2021-04-14', 2),
(16, 'Manger', 'https://www.instagram.com/p/B1pEbHiAwNnxaGEVExQWv_UpKH3uhl3PGn4nJU0/', 'Noé', '2021-04-15', 113);

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

--
-- Déchargement des données de la table `t_presentation_pre`
--

INSERT INTO `t_presentation_pre` (`pre_numero`, `pre_nomStruct`, `pre_adresse`, `pre_adresseMail`, `pre_numeroTel`, `pre_horaireOuverture`, `pre_texte`, `com_pseudo`) VALUES
(3, 'Focus', '63  rue de verdun - 29000 - Quimper', 'focus@gmail.com', '0731554525', '9h-17h', 'Focus est une organisation qui se charge de diffuser le contenu de photographe afin de mettre en relation l\'artiste et le client.\r\n', 'Jojo');

-- --------------------------------------------------------

--
-- Structure de la table `t_profil_pro`
--

CREATE TABLE `t_profil_pro` (
  `pro_nom` varchar(60) NOT NULL,
  `pro_prenom` varchar(60) NOT NULL,
  `pro_mail` varchar(30) NOT NULL,
  `pro_validite` char(1) NOT NULL,
  `pro_statut` char(1) NOT NULL,
  `pro_date` date NOT NULL,
  `com_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_profil_pro`
--

INSERT INTO `t_profil_pro` (`pro_nom`, `pro_prenom`, `pro_mail`, `pro_validite`, `pro_statut`, `pro_date`, `com_pseudo`) VALUES
('PHILIPPE', 'Claire', 'clairephilippe@gmail.com', 'A', 'R', '2021-02-03', 'Claire'),
('Philippe', 'Clémentine', 'clementine@gmail.com', 'A', 'A', '2021-03-04', 'Clem'),
('Marc', 'Valérie', 'Valerie.Marc@univ-brest.fr', 'A', 'A', '2021-01-27', 'gestionnaire1'),
('Philippe', 'Joris', 'jojmail@gmail.com', 'A', 'R', '2021-01-27', 'Jojo'),
('Le Floch', 'Martin', 'martin.lefloch@gmail.com', 'A', 'R', '2021-01-27', 'Martin29'),
('Nicolas', 'Muriel', 'muriel@gmail.com', 'A', 'R', '2021-04-15', 'Mumu'),
('Flantier', 'Noël', 'noel@gmail.com', 'A', 'R', '2021-04-15', 'noel'),
('Philippe', 'Noé', 'noephilippe29@gmail.com', 'A', 'A', '2021-04-15', 'Nono'),
('Bonisseur De La Bath', 'Hubert', 'hubert@gmail.com', 'A', 'R', '2021-04-15', 'OSS117'),
('Tirilly', 'Romain', 'romain.Tirilly@gmail.com', 'A', 'R', '2021-01-27', 'Roro'),
('De La  Fondu', 'Arthur', 'tristan@gmail.com', 'D', 'R', '2021-04-15', 'tri_32');

-- --------------------------------------------------------

--
-- Structure de la table `t_selection_sel`
--

CREATE TABLE `t_selection_sel` (
  `sel_numero` int(11) NOT NULL,
  `sel_intitule` varchar(100) NOT NULL,
  `sel_texteIntro` varchar(500) NOT NULL,
  `sel_date` date NOT NULL,
  `com_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_selection_sel`
--

INSERT INTO `t_selection_sel` (`sel_numero`, `sel_intitule`, `sel_texteIntro`, `sel_date`, `com_pseudo`) VALUES
(1, 'Paysage', 'Toutes les photos de paysage', '2021-01-27', 'gestionnaire1'),
(2, 'Portait', 'Toutes les photos de portait', '2021-02-01', 'Claire'),
(3, 'Brest', 'Toutes les photos de Brest', '2021-02-01', 'Roro'),
(4, 'Quimper', 'Toutes les photos de Quimper', '2021-02-01', 'Martin29'),
(6, 'Couché de soleil', 'Toutes les photos de coucher de soleil', '2021-04-06', 'Clem'),
(11, 'Monochrome', 'Toutes les photos en monochromes', '2021-04-14', 'Clem'),
(19, 'Voyage en Turquie ', 'Quelques photos d\'un voyage en Turquie.', '2021-04-15', 'Nono');

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
  ADD PRIMARY KEY (`com_pseudo`);

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
  MODIFY `actu_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `t_element_ele`
--
ALTER TABLE `t_element_ele`
  MODIFY `ele_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT pour la table `t_lien_lie`
--
ALTER TABLE `t_lien_lie`
  MODIFY `lie_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  MODIFY `pre_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  MODIFY `sel_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
