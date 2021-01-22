-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 22 jan. 2021 à 00:03
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `schoolapps`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `idArticles` int(11) NOT NULL AUTO_INCREMENT,
  `titreArticle` varchar(32) NOT NULL,
  `corpsArticle` longtext NOT NULL,
  `IllustrationPrinciaple` varchar(120) NOT NULL,
  `IllustrationSecondaire` varchar(120) DEFAULT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArticles`),
  KEY `FK_articles_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `idAvis` int(11) NOT NULL AUTO_INCREMENT,
  `avis` text NOT NULL,
  `noteProduit` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAvis`),
  KEY `FK_avis_idProduit` (`idProduit`),
  KEY `FK_avis_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`idAvis`, `avis`, `noteProduit`, `idProduit`, `idUtilisateur`) VALUES
(1, 'Ce produit est de très grande qualité ! Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 5, 1, 1),
(2, 'Ce produit est de très grande qualité ! Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 4, 2, 5),
(3, 'Ce produit est de très grande qualité ! Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 3, 3, 5),
(4, 'Ce produit est de très grande qualité ! Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 4, 1, 1),
(5, 'Ce produit est de très grande qualité !', 5, 2, 5),
(6, 'Ce produit est de très grande qualité !', 4, 3, 1),
(7, 'Ce produit est de très grande qualité !', 4, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `idCommandes` int(11) NOT NULL AUTO_INCREMENT,
  `dateAchat` date NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idCommandes`),
  KEY `FK_commandes_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idCommandes`, `dateAchat`, `idUtilisateur`) VALUES
(1, '2021-01-18', 1),
(2, '2021-01-11', 1),
(3, '2020-01-17', 5),
(4, '2021-01-17', 5),
(5, '2021-01-17', 5),
(6, '2020-10-17', 5);

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

DROP TABLE IF EXISTS `etats`;
CREATE TABLE IF NOT EXISTS `etats` (
  `idEtat` int(11) NOT NULL,
  `etat` varchar(32) NOT NULL,
  PRIMARY KEY (`idEtat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`idEtat`, `etat`) VALUES
(0, 'Fermé'),
(1, 'En cours'),
(2, 'Urgent'),
(3, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `dateMsg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idTicket` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`),
  KEY `FK_message_idTicket` (`idTicket`),
  KEY `FK_message_idUtilisateur` (`idAuteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idMessage`, `message`, `dateMsg`, `idTicket`, `idAuteur`) VALUES
(1, 'a', '2021-01-22 00:18:59', 2, 1),
(2, '&lt;script&gt;', '2021-01-22 00:19:07', 2, 1),
(3, 'a', '2021-01-22 00:19:09', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `idPanier` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` date NOT NULL,
  `total` decimal(15,3) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idPanier`),
  KEY `FK_paniers_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`idPanier`, `dateCreation`, `total`, `idUtilisateur`) VALUES
(1, '2021-01-22', '0.000', 3),
(2, '2021-01-22', '0.000', 2);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `prixHT` double NOT NULL,
  `dateSortie` date DEFAULT NULL,
  `nbrVues` int(11) DEFAULT NULL,
  `nbrAchat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `nomProduit`, `description`, `prixHT`, `dateSortie`, `nbrVues`, `nbrAchat`) VALUES
(1, 'SchoolDev', 'Apprendre à coder dans le langage de votre choix, quels que soient votre âge et votre niveau : lancez-vous dans la programmation par loisir ou professionnellement.', 50, '2021-01-17', NULL, NULL),
(2, 'SchoolNet', 'Plateforme éducative numérique destiné aux enfants (de niveau maternelle à CM2) pour les écoles, mairies et les familles.', 50, '2021-01-17', NULL, NULL),
(3, 'E-education', 'LA solution complète de tous les outils indispensables au fonctionnement des établissements de formation et d’enseignement allant du collège aux formations du supérieur.', 50, '2021-01-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produitscommandes`
--

DROP TABLE IF EXISTS `produitscommandes`;
CREATE TABLE IF NOT EXISTS `produitscommandes` (
  `IdProduitCommande` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(64) DEFAULT NULL,
  `qteProduit` int(11) DEFAULT NULL,
  `prixHT` double DEFAULT NULL,
  `description` text,
  `idCommandes` int(11) NOT NULL,
  PRIMARY KEY (`IdProduitCommande`),
  KEY `FK_produitsCommandes_idCommandes` (`idCommandes`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produitscommandes`
--

INSERT INTO `produitscommandes` (`IdProduitCommande`, `nomProduit`, `qteProduit`, `prixHT`, `description`, `idCommandes`) VALUES
(1, 'SchoolNet', 2, 50, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 1),
(2, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 1),
(3, 'SchoolNet', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 2),
(4, 'SchoolDev', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 2),
(5, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 2),
(6, 'SchoolNet', 2, 50, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 4),
(7, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 4),
(8, 'SchoolNet', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 6),
(9, 'SchoolDev', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 5),
(10, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 3),
(11, 'SchoolNet', 2, 50, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 6),
(12, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 2),
(13, 'SchoolNet', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 4),
(14, 'SchoolDev', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 6),
(15, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 5),
(16, 'SchoolNet', 2, 50, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 3),
(17, 'E-education', 6, 1000.99, 'placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim.', 3);

-- --------------------------------------------------------

--
-- Structure de la table `produitspanier`
--

DROP TABLE IF EXISTS `produitspanier`;
CREATE TABLE IF NOT EXISTS `produitspanier` (
  `qteProduits` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idPanier` int(11) NOT NULL,
  PRIMARY KEY (`idProduit`,`idPanier`),
  KEY `FK_produitsPanier_idPanier` (`idPanier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produitspanier`
--

INSERT INTO `produitspanier` (`qteProduits`, `idProduit`, `idPanier`) VALUES
(1, 1, 1),
(1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `idTicket` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  `explication` text,
  `dateCreation` datetime DEFAULT NULL,
  `dateFermeture` datetime DEFAULT NULL,
  `idEtat` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idTechnicien` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `FK_tickets_idEtat` (`idEtat`),
  KEY `FK_tickets_idUtilisateur` (`idUtilisateur`),
  KEY `FK_tickets_idProduit` (`idProduit`),
  KEY `FK_tickets_idUtilisateur_utilisateurs` (`idTechnicien`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`idTicket`, `intitule`, `explication`, `dateCreation`, `dateFermeture`, `idEtat`, `idUtilisateur`, `idProduit`, `idTechnicien`) VALUES
(1, 'Ticket test', 'J\'explique mon problème', NULL, NULL, 2, 5, 1, 2),
(2, 'Ticket 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in lorem vulputate, placerat risus at, mollis nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec et convallis enim, in hendrerit urna. Nulla auctor nisi et urna placerat volutpat. Suspendisse ultricies metus nulla, non porttitor est consectetur vitae. Suspendisse posuere, nisl vitae convallis lacinia, nibh urna luctus nunc, vitae lobortis urna ante non erat. Nam dolor arcu, malesuada et egestas non, blandit ac nibh. Donec rutrum dolor sit amet eros condimentum luctus. Maecenas consectetur venenatis rutrum. Aliquam tempor nisi nec lacus porttitor, et tincidunt augue iaculis.', NULL, NULL, 2, 1, 1, 2),
(3, 'Ticket 3', 'J\'explique mon problème, qui est comme ça et puis comme ceci d\'où je voulais savoir si', NULL, NULL, 2, 1, 1, 2),
(4, 'Ticket 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in lorem vulputate, placerat risus at, mollis nisi.', NULL, NULL, 0, 5, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `types_utilisateur`
--

DROP TABLE IF EXISTS `types_utilisateur`;
CREATE TABLE IF NOT EXISTS `types_utilisateur` (
  `idTypeUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `typeUtilisateur` varchar(32) NOT NULL,
  PRIMARY KEY (`idTypeUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `types_utilisateur`
--

INSERT INTO `types_utilisateur` (`idTypeUtilisateur`, `typeUtilisateur`) VALUES
(1, 'admin'),
(2, 'technicien'),
(3, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `nom` varchar(32) DEFAULT NULL,
  `prenom` varchar(32) DEFAULT NULL,
  `hashMdp` varchar(64) NOT NULL,
  `emailFacturation` varchar(254) NOT NULL,
  `emailLivraison` varchar(254) DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `idTypeUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `login` (`login`),
  KEY `FK_utilisateurs_idTypeUtilisateur` (`idTypeUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `login`, `nom`, `prenom`, `hashMdp`, `emailFacturation`, `emailLivraison`, `telephone`, `dateNaissance`, `idTypeUtilisateur`) VALUES
(1, 'utilisateur', 'Utilisateur', 'Client', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'utilisateur@hotmail.fr', 'utilisateur@hotmail.fr', 1041010101, '2021-01-01', 3),
(2, 'technicien', 'Technicien', 'technicien', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'technicien@hotmail.fr', 'technicien@hotmail.fr', 2024020202, '2021-01-02', 2),
(3, 'admin', 'Admin', 'admin', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'admin@hotmail.fr', 'admin@hotmail.fr', 303030303, '2021-01-03', 1),
(4, 'VotreTechnicien', 'VotreTechnicien', 'VotreTechnicien', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'technicien2@hotmail.fr', 'technicien2@hotmail.fr', 612562024, '2021-01-02', 2),
(5, 'Client', 'Jean', 'Marc', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'jean-marc93@hotmail.fr', 'jean-marc93@hotmail.fr', 612562024, '2021-01-02', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_articles_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_avis_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `FK_avis_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_commandes_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_idTicket` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`idTicket`),
  ADD CONSTRAINT `FK_message_idUtilisateur` FOREIGN KEY (`idAuteur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `FK_paniers_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `produitscommandes`
--
ALTER TABLE `produitscommandes`
  ADD CONSTRAINT `FK_produitsCommandes_idCommandes` FOREIGN KEY (`idCommandes`) REFERENCES `commandes` (`idCommandes`);

--
-- Contraintes pour la table `produitspanier`
--
ALTER TABLE `produitspanier`
  ADD CONSTRAINT `FK_produitsPanier_idPanier` FOREIGN KEY (`idPanier`) REFERENCES `paniers` (`idPanier`),
  ADD CONSTRAINT `FK_produitsPanier_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`);

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `FK_tickets_idEtat` FOREIGN KEY (`idEtat`) REFERENCES `etats` (`idEtat`),
  ADD CONSTRAINT `FK_tickets_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `FK_tickets_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `FK_tickets_idUtilisateur_utilisateurs` FOREIGN KEY (`idTechnicien`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_utilisateurs_idTypeUtilisateur` FOREIGN KEY (`idTypeUtilisateur`) REFERENCES `types_utilisateur` (`idTypeUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
