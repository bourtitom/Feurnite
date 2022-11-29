-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 29 nov. 2022 à 17:19
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `melcarpg`
--

-- --------------------------------------------------------

--
-- Structure de la table `category_produit`
--

CREATE TABLE `category_produit` (
  `CATEGORY_PRODUIT_ID` int(11) NOT NULL,
  `CATEGORY_PRODUIT_NOM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category_produit`
--

INSERT INTO `category_produit` (`CATEGORY_PRODUIT_ID`, `CATEGORY_PRODUIT_NOM`) VALUES
(1, 'forgeron'),
(2, 'marchand'),
(3, 'dompteur'),
(4, 'boulanger'),
(5, 'alchimiste'),
(6, 'chasseurs'),
(7, 'quest');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `CLASS_ID` int(11) NOT NULL,
  `CLASS_NOM` varchar(50) NOT NULL,
  `CLASS_AVATAR` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`CLASS_ID`, `CLASS_NOM`, `CLASS_AVATAR`) VALUES
(1, 'guerrier', 'warrior.png'),
(2, 'archer', 'archer.png'),
(3, 'voleur', 'voleur.png'),
(4, 'mage', 'wizard.png');

-- --------------------------------------------------------

--
-- Structure de la table `perssonage`
--

CREATE TABLE `perssonage` (
  `PERSO_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `CLASS_ID` int(11) NOT NULL,
  `TITLE_ID` int(11) DEFAULT NULL,
  `PERSO_NOM` char(10) NOT NULL,
  `PERSO_LEVEL` int(11) NOT NULL,
  `PERSO_MONEY` decimal(10,0) NOT NULL,
  `PERSO_SEXE` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pnj`
--

CREATE TABLE `pnj` (
  `PNJ_ID` int(11) NOT NULL,
  `CATEGORY_PRODUIT_ID` int(11) NOT NULL,
  `PNJ_NAME` varchar(50) NOT NULL,
  `PNJ_AVATAR` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `PRODUIT_ID` int(11) NOT NULL,
  `CATEGORY_PRODUIT_ID` int(11) NOT NULL,
  `PRODUIT_NOM` varchar(50) NOT NULL,
  `PRODUIT_PRIX` decimal(10,0) NOT NULL,
  `PRODUIT_IMG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produit_recompense`
--

CREATE TABLE `produit_recompense` (
  `PRODUIT_ID` int(11) NOT NULL,
  `RECOMPENSE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `quest`
--

CREATE TABLE `quest` (
  `QUEST_ID` int(11) NOT NULL,
  `RECOMPENSE_ID` int(11) DEFAULT NULL,
  `QUEST_TITLE` varchar(50) NOT NULL,
  `QUEST_RECOMPENSE` longtext NOT NULL,
  `QUEST_DESC` varchar(250) NOT NULL,
  `QUEST_LEVEL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `quest_pnj`
--

CREATE TABLE `quest_pnj` (
  `PNJ_ID` int(11) NOT NULL,
  `QUEST_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `recompense`
--

CREATE TABLE `recompense` (
  `RECOMPENSE_ID` int(11) NOT NULL,
  `RECOMPENSE_LEVEL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `title`
--

CREATE TABLE `title` (
  `TITLE_ID` int(11) NOT NULL,
  `TITLE_NAME` varchar(50) NOT NULL,
  `TITLE_LOGO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `title`
--

INSERT INTO `title` (`TITLE_ID`, `TITLE_NAME`, `TITLE_LOGO`) VALUES
(1, 'Noob', 'noob.png'),
(2, 'Chasseurs de slime', 'chasseurslime.png'),
(3, 'dieu de la lame', 'ddll.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_PSEUDO` varchar(50) NOT NULL,
  `USER_MAIL` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(200) NOT NULL,
  `USER_CODE` mediumint(50) DEFAULT NULL,
  `USER_ROLE` enum('USER','ADMIN') NOT NULL DEFAULT 'USER',
  `USER_STATUT` enum('check','uncheck') NOT NULL DEFAULT 'uncheck'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`USER_ID`, `USER_PSEUDO`, `USER_MAIL`, `USER_PASSWORD`, `USER_CODE`, `USER_ROLE`, `USER_STATUT`) VALUES
(8, 'Pedro', 'tbourti@edenschool.fr', '$2y$10$dkJndRDkNFkwKdGKnBxvNuEuzCazbFHwgpy/l0mIXLJsyt2UfBnVG', 8388607, 'USER', 'uncheck'),
(9, 'feur', 'feur@nite', '$2y$10$bN.NQ2ef4yTkXOBJrVVX7O2PPqC25SNekyb3VhTK4pb31TYFIQn46', 8388607, 'USER', 'uncheck');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category_produit`
--
ALTER TABLE `category_produit`
  ADD PRIMARY KEY (`CATEGORY_PRODUIT_ID`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`CLASS_ID`);

--
-- Index pour la table `perssonage`
--
ALTER TABLE `perssonage`
  ADD PRIMARY KEY (`PERSO_ID`),
  ADD KEY `FK_AVOIR` (`USER_ID`),
  ADD KEY `FK_CLASSER` (`CLASS_ID`),
  ADD KEY `FK_HONORER` (`TITLE_ID`);

--
-- Index pour la table `pnj`
--
ALTER TABLE `pnj`
  ADD PRIMARY KEY (`PNJ_ID`),
  ADD KEY `FK_PNJTYPER` (`CATEGORY_PRODUIT_ID`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`PRODUIT_ID`),
  ADD KEY `FK_PRODUITTYPER` (`CATEGORY_PRODUIT_ID`);

--
-- Index pour la table `produit_recompense`
--
ALTER TABLE `produit_recompense`
  ADD PRIMARY KEY (`PRODUIT_ID`,`RECOMPENSE_ID`),
  ADD KEY `FK_ASSOCIER2` (`RECOMPENSE_ID`);

--
-- Index pour la table `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`QUEST_ID`),
  ADD KEY `FK_RECOMPENSER` (`RECOMPENSE_ID`);

--
-- Index pour la table `quest_pnj`
--
ALTER TABLE `quest_pnj`
  ADD PRIMARY KEY (`PNJ_ID`,`QUEST_ID`),
  ADD KEY `FK_DONNER2` (`QUEST_ID`);

--
-- Index pour la table `recompense`
--
ALTER TABLE `recompense`
  ADD PRIMARY KEY (`RECOMPENSE_ID`);

--
-- Index pour la table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`TITLE_ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category_produit`
--
ALTER TABLE `category_produit`
  MODIFY `CATEGORY_PRODUIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `perssonage`
--
ALTER TABLE `perssonage`
  MODIFY `PERSO_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pnj`
--
ALTER TABLE `pnj`
  MODIFY `PNJ_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `PRODUIT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quest`
--
ALTER TABLE `quest`
  MODIFY `QUEST_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recompense`
--
ALTER TABLE `recompense`
  MODIFY `RECOMPENSE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `title`
--
ALTER TABLE `title`
  MODIFY `TITLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `perssonage`
--
ALTER TABLE `perssonage`
  ADD CONSTRAINT `FK_AVOIR` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `FK_CLASSER` FOREIGN KEY (`CLASS_ID`) REFERENCES `classe` (`CLASS_ID`),
  ADD CONSTRAINT `FK_HONORER` FOREIGN KEY (`TITLE_ID`) REFERENCES `title` (`TITLE_ID`);

--
-- Contraintes pour la table `pnj`
--
ALTER TABLE `pnj`
  ADD CONSTRAINT `FK_PNJTYPER` FOREIGN KEY (`CATEGORY_PRODUIT_ID`) REFERENCES `category_produit` (`CATEGORY_PRODUIT_ID`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_PRODUITTYPER` FOREIGN KEY (`CATEGORY_PRODUIT_ID`) REFERENCES `category_produit` (`CATEGORY_PRODUIT_ID`);

--
-- Contraintes pour la table `produit_recompense`
--
ALTER TABLE `produit_recompense`
  ADD CONSTRAINT `FK_ASSOCIER` FOREIGN KEY (`PRODUIT_ID`) REFERENCES `produit` (`PRODUIT_ID`),
  ADD CONSTRAINT `FK_ASSOCIER2` FOREIGN KEY (`RECOMPENSE_ID`) REFERENCES `recompense` (`RECOMPENSE_ID`);

--
-- Contraintes pour la table `quest`
--
ALTER TABLE `quest`
  ADD CONSTRAINT `FK_RECOMPENSER` FOREIGN KEY (`RECOMPENSE_ID`) REFERENCES `recompense` (`RECOMPENSE_ID`);

--
-- Contraintes pour la table `quest_pnj`
--
ALTER TABLE `quest_pnj`
  ADD CONSTRAINT `FK_DONNER` FOREIGN KEY (`PNJ_ID`) REFERENCES `pnj` (`PNJ_ID`),
  ADD CONSTRAINT `FK_DONNER2` FOREIGN KEY (`QUEST_ID`) REFERENCES `quest` (`QUEST_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
