-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 03 Septembre 2014 à 15:45
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `oeuvres`
--
CREATE DATABASE IF NOT EXISTS `oeuvres` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `oeuvres`;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_activites`
--

CREATE TABLE IF NOT EXISTS `oeuvres_activites` (
  `id` char(10) NOT NULL,
  `title` char(80) DEFAULT NULL,
  `domaine` char(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_activites`
--

INSERT INTO `oeuvres_activites` (`id`, `title`, `domaine`) VALUES
('01', 'Spectacle chorégraphique', ''),
('02', 'Spectacle théâtral', ''),
('03', 'Spectacle musical', ''),
('04', 'Spectacle de cirque', ''),
('05', 'Spectacle des arts de la rue', '');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_contacts`
--

CREATE TABLE IF NOT EXISTS `oeuvres_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) NOT NULL DEFAULT '0',
  `name` char(40) NOT NULL,
  `distinction` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `REF_ACTEUR` (`oeuvre_id`),
  KEY `CLE_APPEL` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `oeuvres_contacts`
--

INSERT INTO `oeuvres_contacts` (`id`, `oeuvre_id`, `name`, `distinction`) VALUES
(1, 114, 'SIMARD CLAIRE', 'Metteur en scène');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_criteres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_criteres` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `critere` varchar(80) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `criteres` (`critere`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_criteres`
--

INSERT INTO `oeuvres_criteres` (`id`, `title`, `critere`, `order`) VALUES
(1, 'de 800 à 1600 euros', 'prix', 2),
(2, 'Moins de 800 euros', 'prix', 1),
(3, 'de 1600 à 2500 euros', 'prix', 3),
(4, 'de 2500 à 5000 euros', 'prix', 4),
(5, 'de 5000 à 10 000 euros', 'prix', 5),
(6, 'Plus de 10 000 euros', 'prix', 6),
(7, '100 à 500', 'Jauge', 3),
(8, '1 à 50', 'Jauge', 1),
(9, '50 à 100', 'Jauge', 2),
(10, '500 à 1000', 'Jauge', 4),
(11, 'Plus de 1000', 'Jauge', 5),
(12, '1h à 1h30', 'duree', 3),
(13, '30 min à 1h', 'duree', 2),
(14, 'moins de 30 min', 'duree', 1),
(15, 'plus de 1h30', 'duree', 4);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_disciplines`
--

CREATE TABLE IF NOT EXISTS `oeuvres_disciplines` (
  `id` char(20) NOT NULL,
  `title` char(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_fichesliees`
--

CREATE TABLE IF NOT EXISTS `oeuvres_fichesliees` (
  `id` varchar(20) NOT NULL,
  `nom_usuel` varchar(45) NOT NULL,
  `nom_complet` mediumtext NOT NULL,
  `adresse` mediumtext,
  `code_postal` varchar(10) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `telephone_billeterie` varchar(20) DEFAULT NULL,
  `telecopie` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `site_web` varchar(80) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_fichesliees`
--

INSERT INTO `oeuvres_fichesliees` (`id`, `nom_usuel`, `nom_complet`, `adresse`, `code_postal`, `ville`, `telephone`, `telephone_billeterie`, `telecopie`, `mobile`, `email`, `site_web`, `user_id`) VALUES
('ADBO_043_7489149760', 'CIE JOELLE BOUVIER', 'COMPAGNIE JOELLE BOUVIER', '3 rue des trois frères', '75018', 'PARIS', '01.42.55.29.96', '', '', '06.09.67.35.21', 'contact@joellebouvier.com', 'www.joellebouvier.com', 1),
('ADBO_043_8169571270', 'CIE CIRQUM SOLO', 'CIRQUM SOLO', '3 rue du marché', '89130', 'TOUCY', '03.86.18.95.24', '', '', '06.78.14.25.04', 'elgran_olif@yahoo.fr', 'www.cirqumsolo.blogspot.com', 2),
('ADBO_043_8169572750', 'CIE SANS NOM', 'COMPAGNIE SANS NOM', '28 rue Gerbeaux', '89130', 'MOULINS-SUR-OUANNE', '06.24.36.38.24', '', '', '06.86.58.79.81', 'cie.sans.nom@hotmail.fr', 'myspace.com/lacompagniesansnom', 3),
('ADBO_043_8735420360', 'CIE OPOPOP', 'CIE OPOPOP', '22 rue Auguste Perdrix', '21000', 'DIJON', '03.80.42.87.03', '', '', '06.82.91.44.02', 'cieopopop@gmail.com', 'www.opopop.fr', 4),
('ADBO_043_8843649060', 'CIE ATELIER LEFEUVRE ET ANDRE', 'CIE ATELIER LEFEUVRE ET ANDRE', 'Par Les Chemins Productions - Matthieu Hagene\r6 rue Deguerry', '75011', 'PARIS', '01.43.38.76.65', '', '', '06.61.34.99.94', 'contact@parleschemins.com', 'www.lefeuvre-andre.com', 5),
('ADBO_043_8852294470', 'CIE TOUK TOUK CIE', 'TOUK TOUK CIE', '2 rue Aristide Briand', '89220', 'BLENEAU', '03.86.45.23.78', '', '', '06.60.23.31.04', 'sylvain@touktoukcie.com', 'www.touktoukcie.com', 6),
('ADBO_043_9350993340', 'CIE ATELIER 29 (POCHEROS)', 'CIE ATELIER 29', 'Route de Saint Andreux', '89420', 'BUSSIERES', '07.60.70.75.54', '', '', '', 'antigone.clown@yahoo.fr', 'www.antigone-clown.com', 7),
('ADBO_043_9411721380', 'CIE NUMB', 'CIE NUMB', '40 avenue Victor Hugo', '21000', 'DIJON', '06.11.08.52.77', '', '', '\r', 'cienumb@hotmail.fr', '', 8),
('BO21_043_8124333250', 'CIE BEAU CHAOS', 'CIE LE BEAU CHAOS', '2 Bis petite rue du Vieux Prieuré', '21000', 'DIJON', '09.52.85.38.62', '', '', '06.71.20.08.12', 'lebeauchaos@gmail.com', 'www.le-beau-chaos.com', 9),
('BO21_043_8124349010', 'CIE FEE FOLIE', 'CIE LA FEE FOLIE', '7 allée de Saint-Nazaire', '21000', 'DIJON', '06.12.38.70.42', '', '', '', 'lafeefolie@gmail.com', 'www.lafeefolie.com', 10),
('BO21_043_8124356731', 'CIE BLEUS TRAVAIL', 'CIE LES BLEUS DE TRAVAIL', 'Rue Saint Andeol', '21530', 'SAINT-ANDEUX', '03.80.64.88.67', '', '03.80.64.88.67', '06.61.50.83.51', 'alexandre.demay2@orange.fr', 'www.lesbleusdetravail.fr', 11),
('BO21_043_8124366270', 'CIE MANIE', 'CIE MANIE', 'Maison des associations\r2 rue des Corroyeurs\r', '21000', 'DIJON', '06.84.08.05.87', '', '', '06.88.76.89.92', 'compagnie.manie@gmail.com', 'compagniemanie.blogspot.com', 12),
('CmPa_043_6443285011', 'ARMO - CIE JEROME THOMAS', 'ARMO - CIE JEROME THOMAS', '71 rue des rotondes', '21000', 'DIJON', '03.80.30.39.16', '', '', '06.85.05.95.61', 'info@jerome-thomas.com', 'www.jerome-thomas.com', 13),
('CmPa_043_6443295630', 'CIE ALFRED ALERTE', 'Compagnie ALFRED ALERTE', '15 rue Jean Jaurès', '77186', 'NOISIEL', '06.81.47.12.68', '', '', '', 'cie.alfredalerte@yahoo.fr', 'www.ciealfredalerte.com', 14),
('CmPa_043_6443295702', 'CIE ARTIFICE', 'CIE ARTIFICE', '63 avenue de Langres', '21024', 'DIJON', '03.80.30.12.91', '', '03.80.30.12.91', '06.07.71.69.68', 'lartifice@wanadoo.fr', 'www.lartifice.com', 15),
('CmPa_043_6443295871', 'COLL CIE CLAIR OBSCUR', 'COMPAGNIE DU CLAIR OBSCUR', '16 rue Général Henri Delaborde', '21000', 'DIJON', '03.80.41.83.94', '', '03.80.41.83.94', '06.63.41.15.05\r', 'contact@cieclairobscur.com', 'www.cieclairobscur.com', 16),
('CmPa_043_6443296000', 'CIE DU HANNETON', 'LA COMPAGNIE DU HANNETON', 'Dront', '71550', 'ANOST', '09.70.40.61.56', '', '', '06.84.82.87.77', 'junebug@wanadoo.fr', 'www.compagnieduhanneton.com', 17),
('CmPa_043_6443296012', 'CIE ECLAIRCIE', 'CIE THEATRE DE L''ECLAIRCIE', '36 ter rue Colson', '21000', 'DIJON', '03.80.30.65.19', '', '03.80.30.65.19', '', 'cie.eclaircie@wanadoo.fr', 'www.cie-eclaircie.com', 18),
('CmPa_043_6443296130', 'CIE GRAND JETÉ', 'LE GRAND JETÉ! CIE FREDERIC CELLE', '9 rue des Tanneries', '71250', 'CLUNY', '09.50.94.41.94', '', '', '06.80.54.64.04', 'administration@legrandjete.com', 'www.legrandjete.com', 19),
('CmPa_043_6443296171', 'CIE GLOMERIS!COMPAGNIE', 'GLOMERIS ! COMPAGNIE', '11 rue Dijon', '21490', 'RUFFEY-LES-ECHIREY', '03.80.53.01.93', '', '', '', 'glomeris@laposte.net', '', 20),
('CmPa_043_6443296302', 'CIE LA GALERIE', 'COMPAGNIE LA GALERIE', '7 avenue Hoche', '89000', 'AUXERRE', '06.11.02.34.89', '', '', '06.73.09.55.69', 'admin@cie-lagalerie.fr', 'www.cie-lagalerie.fr', 21),
('CmPa_043_6443296642', 'CIE RASPOSO', 'COMPAGNIE RASPOSO', 'Cidex 1260 - Cercot', '71390', 'MOROGES', '03.85.47.93.72', '', '03.85.47.91.84', '06.87.15.30.44', 'rasposo@wanadoo.fr', 'www.rasposo.net', 22),
('CmPa_043_6443296790', 'CIE TURLUPIN', 'LE TURLUPIN', '19 rue du 14 septembre', '21000', 'DIJON', '03.45.61.39.14', '', '', '06.83.01.76.40', 'leturlupin@gmail.com', 'www.turlupin-over-blog.com', 23),
('CmPa_043_6443296850', 'CIE CIRKO SENSO', 'CIE CIRKO SENSO', 'Maison des Association\r19 rue Poterne\r', '21200', 'BEAUNE', '03.80.22.54.79', '', '09.55.06.76.15', '', 'cirkoum@gmail.com', 'www.cirkoum.com', 24),
('CmPa_043_6443296861', 'CIE CIRQUE ILYA', 'CIRQUE ILYA', '3 et 5 rue des Fleurs', '21000', 'DIJON', '03.45.60.26.36', '', '', '06.62.82.73.90', 'contact@cirque-ilya.com', 'www.cirque-ilya.com', 25),
('CmPa_043_6443296870', 'CIE CIRQUE STAR', 'CIRQUE STAR', 'Le Petit Launay', '89330', 'PIFFONDS', '03.86.86.44.87', '', '', '06.80.20.23.50', 'cirque.star@wanadoo.fr', 'www.cirquestar.com', 26),
('CmPa_043_6443298161', 'GRAT - CIE JEAN LOUIS HOURDIN', 'G.R.A.T. - CIE JEAN LOUIS HOURDIN', '15 passage de la Main d''Or', '75011', 'PARIS', '01.47.00.45.71', '', '01.48.06.24.65', '06.77.34.41.81', 'brunet.mireille@sfr.fr', 'jeanlouishourdin.com', 27),
('CmPa_043_6443301011', 'CIE THEATRE EN BULLES', 'THEATRE EN BULLES', 'Mairie', '21800', 'CHEVIGNY-SAINT-SAUVEUR', '03.80.71.04.69', '', '', '06.82.33.59.34', 'theatrenbulles@hotmail.fr', '', 28),
('CmPa_043_6443301050', 'THEATRE JAUNE CHAMEAU', 'THEATRE JAUNE CHAMEAU', '2 rue des Saulcies', '89290', 'ESCOLIVES-SAINTE-CAMILLE', '03.86.81.10.90', '', '', '06.11.22.07.37', 'rainette@les-marionnettes.fr', 'www.les-marionnettes.fr', 29),
('CmPa_043_6443301150', 'CIE LES TOTORS', 'LES TOTORS', '6 rue des Poulets', '71100', 'CHALON-SUR-SAONE', '03.85.92.11.19', '', '', '06.48.72.10.99', 'lestotors@gmail.com', 'www.lestotors.com', 30),
('MDB_043_10051067380', 'BIGMAX CREATION', 'BIGMAX CREATION', 'Nicéphore Cité - 34 quai Saint Cosme', '71100', 'CHALON-SUR-SAONE', '03.85.90.83.13', '', '', '06.01.44.64.04', 'contact@bigmaxcreation.com', '', 31),
('MDB_043_10076855280', 'SOPHIE DE MEYRAC', 'SOPHIE DE MEYRAC', '12 rue du Cloître', '71100', 'CHALON-SUR-SAONE', '09.66.91.94.15', '', '', '06.44.70.05.93', 'sdemeyrac@gmail.com', 'www.contes-et-conteurs.com/sophiedemeyrac', 32),
('MDB_043_10122184880', 'CIE BONGO', 'CIE BONGO', 'John Mzee MAINGI\r12 rue de la Romanée', '21000', 'DIJON', '06.50.83.01.96', '', '', '', 'mzeebongo@gmail.com', 'showandshows.free.fr', 33),
('MDB_043_8824147040', 'CIE PECHEURS REVES', 'CIE LES PECHEURS DE REVES', '347 Chemin de Duchaux', '71310', 'LA-CHAPELLE-SAINT-SAUVEUR', '03.85.74.58.44', '', '', '06.62.85.89.55', 'lespecheursdereves@yahoo.fr', 'www.pecheursdereves.com', 34),
('MDB_043_8841436990', 'CIE A ET O', 'COMPAGNIE A & O', '3 cour Potiron\r', '89420', 'SAINT-ANDRE-EN-TERRE-PLAINE', '03.81.81.48.43', '', '', '06.64.20.15.03', 'jeanne-antide.leque@orange.fr', 'www.a-et-o.com', 35),
('MDB_043_8841458920', 'CIE ANXO', 'COMPAGNIE ANXO', '9 rue de Panges', '21410', 'ANCEY', '03.80.23.67.98', '', '', '06.19.92.07.35', 'simonanxo@hotmail.com', 'www.cieanxo.fr', 36),
('MDB_043_8843419480', 'CIE CIRQUE VEGETAL', 'CIRQUE VEGETAL', 'Maison des associations - Boite Q8\r2 rue des Corroyeurs', '21068', 'DIJON', '06.64.90.66.41', '', '', '', 'lhommearbre@laposte.net', '', 37),
('MDB_043_8843666270', 'CIE MEZCLA', 'CIE MEZCLA', 'Château de Monthelon', '89420', 'MONTREAL', '03.86.32.53.42', '', '', '06.10.35.53.34', 'skydesela@yahoo.com', '', 38),
('MDB_043_9174114390', 'CIE UNDERCLOUDS', 'CIE UNDERCLOUDS', 'Le Totem \r151 rue des brasseries', '54320', 'MAXEVILLE', '06.07.15.25.99', '', '', '', 'underclouds.cie@gmail.com', 'www.myspace.com/funambus', 39),
('MDB_043_9372771820', 'CIE FLYING FISH', 'CIE LES FLYING FISH', '21 rue Abraham', '72000', 'LE-MANS', '', '', '', '', 'mariemunch@noos.fr', '', 40),
('MDB_043_9880465270', 'CIE PIECES MAIN D''OEUVRE', 'CIE PIECES ET MAIN D''OEUVRE', '3 rue du Parc', '71270', 'PIERRE-DE-BRESSE', '03.85.72.87.63', '', '', '06.83.49.16.93', 'piecesetmaindoeuvre@free.fr', 'www.ciepiecesetmaindoeuvre.com', 41),
('MDB_043_9899664660', 'CIE PAROLES MA PAROLE', 'PAROLES, MA PAROLE', 'Rue de la croix pitris', '21430', 'LIERNAIS', '06.73.68.74.34', '', '', '06.59.66.71.63', 'jcaubrun@orange.fr', '', 42),
('Serv_043_8169584021', 'CIE CIRQUM FLEX', 'CIE CIRQUM FLEX', '3 rue du marché', '89130', 'TOUCY', '03.86.18.95.24', '', '', '06.78.14.25.04', 'cirqumflex@hotmail.com', 'www.cirqumsolo.blogspot.com', 43),
('Serv_043_8169634631', 'CIE HYAQUADIRE-QUE', 'CIE HYAQUADIRE-QUE', '2 rue de la Fontaine', '89200', 'CUSSY-LES-FORGES', '03.86.33.04.07', '', '', '06.29.86.18.93', 'parceque@sfr.fr', 'www.hyaquadire-que.com', 44);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_genres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_genres` (
  `id` char(20) NOT NULL,
  `title` char(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_genres`
--

INSERT INTO `oeuvres_genres` (`id`, `title`) VALUES
('61', 'Musique'),
('6101', 'Musiques actuelles'),
('6102', 'Musique classique'),
('6103', 'Musique contemporaine'),
('6104', 'Musique ancienne'),
('62', 'Danse'),
('6201', 'Danse contemporaine'),
('6202', 'Danse jazz'),
('6203', 'Danse classique'),
('6204', 'Danses anciennes et baroques'),
('6205', 'Hip-Hop'),
('6206', 'Danse aerienne / verticale'),
('63', 'Arts du théâtre'),
('6301', 'Théâtre'),
('6302', 'Théâtre d''humour / café-théâtre'),
('6303', 'Conte'),
('6304', 'Marionnette / théâtre d''objets'),
('64', 'Arts de la rue'),
('65', 'Arts de la piste'),
('6501', 'Nouveau cirque'),
('6502', 'Cirque traditionnel');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_implantations`
--

CREATE TABLE IF NOT EXISTS `oeuvres_implantations` (
  `id` char(16) NOT NULL,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_implantations`
--

INSERT INTO `oeuvres_implantations` (`id`, `name`) VALUES
('BO', 'Bourgogne'),
('BO21', 'Côte-d''Or'),
('BO58', 'Nièvre'),
('BO71', 'Saône-et-Loire'),
('BO89', 'Yonne');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_medias`
--

CREATE TABLE IF NOT EXISTS `oeuvres_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) NOT NULL,
  `file` char(80) NOT NULL DEFAULT '',
  `filetype` char(6) DEFAULT NULL,
  `width` int(8) DEFAULT NULL,
  `height` int(8) DEFAULT NULL,
  `name` char(80) DEFAULT NULL,
  `copyright` char(60) DEFAULT NULL,
  `affichage_liste` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`oeuvre_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `oeuvres_medias`
--

INSERT INTO `oeuvres_medias` (`id`, `oeuvre_id`, `file`, `filetype`, `width`, `height`, `name`, `copyright`, `affichage_liste`) VALUES
(1, 63, 'Tigre Crâne.png', 'png', 0, 0, 'Un Tigre dans le crâne', 'Copyright', '1'),
(2, 65, 'chameau.jpg', 'jpg', 0, 0, 'Le chameau', 'Copyright', '1'),
(3, 66, 'toutsdemonte.jpg', 'jpg', 0, 0, 'Tout s''démonte tout s''plie', 'Copyright', '1'),
(4, 67, 'Loeuf en craie.jpg', 'jpg', 0, 0, 'L''oeuf en craie', 'Copyright', '1'),
(5, 68, 'L''enfant elephant.jpg', 'jpg', 0, 0, 'L''Enfant Elephant', 'Copyright', '1'),
(6, 69, 'enfant et sortilèges.jpg', 'jpg', 0, 0, 'L''enfant et les sortilèges', 'Copyright', '1'),
(7, 70, 'lepetitpoucet_300.jpg', 'jpg', 0, 0, 'Le Petit Poucet', 'Copyright', '1'),
(8, 71, 'la marotte rapee.jpg', 'jpg', 0, 0, 'La Marotte Rapée', 'Copyright', '1'),
(9, 77, 'Jean la Chance.jpg', 'jpg', 0, 0, 'Jean La Chance - Jean-Louis HOURDIN', 'Copyright', '1'),
(10, 79, 'Clarisse Mehdi et les autres.jpg', 'jpg', 0, 0, 'Clarisse Mehdi et les autres - Jean-Louis HOURDIN.jpg', 'Copyright', '1'),
(11, 80, 'Armons-nous en pensée.JPG', 'jpg', 0, 0, 'Veillons et armons-nous en pensée -Jean-Louis HOURDIN', 'Copyright', '1'),
(12, 81, 'Je suis en colere.JPG', 'jpg', 0, 0, 'Je suis en colère mais ça me fait rire', '', '1'),
(13, 82, 'Woyzeck.JPG', 'jpg', 0, 0, 'Woyzeck - Jean-Louis Hourdin', 'Copyright', '1'),
(14, 89, 'Credit phot _ michel Fechaud.jpg', 'jpg', 0, 0, 'Un malheur de Sophie', 'Copyright - Michel Fechaud', '1'),
(15, 114, 'En attendant le petit poucet.jpg', 'jpg', 0, 0, 'En attendant le petit poucet', 'Copyright', '1'),
(16, 115, 'signe nina.jpg', 'jpg', 0, 0, 'Signé Nina', 'Copyright', '1'),
(17, 118, 'Odyssee urbaine.jpg', 'jpg', 0, 0, 'Odyssee urbaine', '', '1'),
(18, 119, 'pneumatica.jpg', 'jpg', 0, 0, 'Pneumatica', '', '1'),
(19, 120, 'noir tousse.jpg', 'jpg', 0, 0, 'Dans le noir il ya toujours quelqu''un qui tousse', 'Copyright', '1'),
(20, 122, 'la-gallerie-memory2.jpg', 'jpg', 0, 0, 'Memory#2', '', '1'),
(21, 123, 'Puzzle me up.JPG', 'jpg', 0, 0, 'Puzzle me up', '', '1'),
(22, 124, 'lotorama.jpg', 'jpg', 0, 0, 'Lotorama', '', '1'),
(23, 125, 'room service.jpg', 'jpg', 0, 0, 'Room Service', '', '1'),
(24, 127, '09 copie.jpg', 'jpg', 0, 0, 'Miche et Drate', '', '1'),
(25, 128, 'LA5_credit Michel Ferchaud.jpg', 'jpg', 0, 0, 'Lettres d''amour de 0 à 10', 'Copyright - Michel Ferchaud', '1'),
(26, 129, 'pour rire_cre¦üdit Michel Ferchaud.gif', 'gif', 0, 0, 'Pour rire pour passer le temps', 'Copyright - Michel Ferchaud', '1'),
(27, 130, 'bleu_petoche.jpg', 'jpg', 0, 0, 'Bleu Pétoche', '', '1');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_oeuvres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_oeuvres` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `ficheliee_id` varchar(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_usuel` varchar(50) NOT NULL,
  `nom_complet` mediumtext NOT NULL,
  `auteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `compositeur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `choregraphe` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `metteurenscene` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `producteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `duree` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `jauge` int(11) DEFAULT NULL,
  `anneecreation` varchar(4) DEFAULT NULL,
  `hauteurminimale` int(20) DEFAULT NULL,
  `profondeurminimale` int(20) DEFAULT NULL,
  `ouvertureminimale` int(20) DEFAULT NULL,
  `disponibilitespectacle` varchar(4) DEFAULT NULL,
  `projetencours` varchar(4) DEFAULT NULL,
  `interprete` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distributeur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `scenariste` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `realisateur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `editeurmusical` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `labels` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `co_auteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `traducteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `illustrateur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `isbn` varchar(20) DEFAULT NULL,
  `gencod` int(20) DEFAULT NULL,
  `nomcollection` varchar(120) DEFAULT NULL,
  `lieuedition` varchar(120) DEFAULT NULL,
  `reedition` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `leformat` varchar(80) DEFAULT NULL,
  `nombrepage` int(20) DEFAULT NULL,
  `numdewey` varchar(10) DEFAULT NULL,
  `anneeedition` varchar(4) DEFAULT NULL,
  `titreorigine` varchar(4) DEFAULT NULL,
  `auteur_origine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `co_auteur_origine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `editeur_origine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `langueorigine` varchar(4) DEFAULT NULL,
  `languetraduite` varchar(4) DEFAULT NULL,
  `annee1erpublication` varchar(4) DEFAULT NULL,
  `code_operateur` varchar(6) DEFAULT NULL,
  `nom_operateur` varchar(40) DEFAULT NULL,
  `commentaires` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_arts_visuels` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_audio_visuel` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_livre` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_patrimoine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_spectacle` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_actualisation` date DEFAULT NULL,
  `id_fiche` varchar(20) DEFAULT NULL,
  `mot_passe` varchar(20) DEFAULT NULL,
  `questionnaires` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `nom_prenom_destinataire` varchar(80) DEFAULT NULL,
  `e_mail_destinataire` varchar(80) DEFAULT NULL,
  `fonction_titre` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `liste_des_contacts` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `activites` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `genres` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `disciplines` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `localisations` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `precision_activites` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type_public` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `support` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rayonnement` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distinction` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `index_complementaire` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `nom_complet` (`nom_complet`(50)),
  KEY `user_id` (`user_id`),
  KEY `type_id` (`type_id`),
  KEY `ficheliee_id` (`ficheliee_id`),
  FULLTEXT KEY `auteurs` (`auteur`,`compositeur`,`choregraphe`,`metteurenscene`,`scenariste`,`illustrateur`,`co_auteur`,`realisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_oeuvres`
--

INSERT INTO `oeuvres_oeuvres` (`id`, `user_id`, `ficheliee_id`, `type_id`, `nom_usuel`, `nom_complet`, `auteur`, `compositeur`, `choregraphe`, `metteurenscene`, `producteur`, `duree`, `prix`, `jauge`, `anneecreation`, `hauteurminimale`, `profondeurminimale`, `ouvertureminimale`, `disponibilitespectacle`, `projetencours`, `interprete`, `distributeur`, `scenariste`, `realisateur`, `editeurmusical`, `labels`, `co_auteur`, `traducteur`, `illustrateur`, `isbn`, `gencod`, `nomcollection`, `lieuedition`, `reedition`, `leformat`, `nombrepage`, `numdewey`, `anneeedition`, `titreorigine`, `auteur_origine`, `co_auteur_origine`, `editeur_origine`, `langueorigine`, `languetraduite`, `annee1erpublication`, `code_operateur`, `nom_operateur`, `commentaires`, `commentaires_arts_visuels`, `commentaires_audio_visuel`, `commentaires_livre`, `commentaires_patrimoine`, `commentaires_spectacle`, `date_actualisation`, `id_fiche`, `mot_passe`, `questionnaires`, `nom_prenom_destinataire`, `e_mail_destinataire`, `fonction_titre`, `liste_des_contacts`, `activites`, `genres`, `disciplines`, `localisations`, `precision_activites`, `type_public`, `support`, `rayonnement`, `distinction`, `index_complementaire`) VALUES
(1, 1, 'MDB_043_8824147040', 2, 'SOT L''Y LAISSE (CIE PECHEURS REVES)', 'LE SOT L''Y LAISSE', 'Florence Dusset', '', '', 'Caroline Oblin, Gulko et Florence Dusset', '', 0, 6, 0, '2005', 5, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rVoici Za. Za est un vrai phénomène. Za est un manipulateur, un dresseur et un montreur de colombes volantes! Voila pour le boniment...Mais lorsque Za rentre en scène, un frémissement de bonheur mêlé d''un zeste d''inquiétude parcourt le public...\r\rEquipe de création \r\rType de spectacle : fixe\rLangue du spectacle : français \rAccessibilité pour personnes handicapées : oui\rDisposition du public : circulaire \rEspaces scéniques : théâtre, chapiteau, rue, parcs et jardins, salle \rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9552151700', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(2, 2, 'MDB_043_8824147040', 2, 'DESIRS FONT DESORDRE (CIE PECHEURS REVES)', 'NOS DESIRS FONT DESORDRE', 'Florence Dusset, Vincent Schmitt et Jean-Luc Chorgnon', '', '', 'Christophe Tellier (regard extérieur)', '', 0, 4, 0, '2002', 5, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rTrois maisons en bord de piste...Sur fond de bambou et moquette rouge, l''aire de jeu s''anime quand débarquent la princesse boulimique, le famélique avec son inséparable bêtise et le flamand rose égocentrique. Ils sont trois à se mettre en quatre derrière un drôle de paravent. En fait, leurs coulisses sont à vue mais eux, ils ne le savent pas! Tout ce la pour faire leur cirque, ou plutôt leur "bazar" où ils tenteront malgré tout quelques prouesses. Leur univers burlesco-poético-contemporain est un univers de chamboule-tout absurde et surtout très décalé.\r\rType de spectacle : fixe \rLangue du spectacle : français, très peu de texte \rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, chapiteau, rue, parcs et jardins, salle \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9552076150', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(3, 3, 'MDB_043_8824147040', 2, 'OMBRE DU ZEBRE RAYURES (CIE PECHEURS REVES)', 'L''OMBRE DU ZEBRE N''A PAS DE RAYURES', 'Florence Dusset, Vincent Schmitt, Jean-Luc Chorgnon, Khaled Benzekri', '', '', 'Michel Dallaire, Christophe Tellier (regard extérieur)', '', 0, 4, 0, '2009', 5, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rCe soir, c''est le grand saut pour Yvonne et Jean-Raymond, leur première en public, heureusement Jean-David, grand comédien professionnel et Jean-Hamed, grand nouveau sorti de nul part sont là pour souligner tous leurs faux pas! Dans le stress du direct, l''équipe abordera tant bien que mal le thème de l''argent. Hold-up, embrouilles, l''argent circule, voyage, tout comme les spectateurs, d''univers décalés en parodies.\r\rType de spectacle : fixe \rLangue du spectacle : français \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, rue, parcs et jardins, salle \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 4\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9554105190', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(4, 4, 'ADBO_043_8843649060', 2, 'SERRE (CIE AT LEFEUVRE ANDRE)', 'LA SERRE', 'Jean-Paul Lefeuvre, Didier André', '', '', 'Jean-Paul Lefeuvre, Didier André', '', 0, 0, 0, '2000', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rPetit cirque bestial et intime sous une serre. Deux acrobates effarés alignent les coups de folie miniatures. Ils nous recoivent dans leur serre. Une plaque de gazon synthétique leur sert de terrain de jeu. Une centaine de spectateurs s''agglutinent de part et d''autre. Didier André et Jean-Paul Lefeuvre sont les jardiniers de service. Ils ont d''ailleurs planté à chaque coin de leur plate-bande comique un bouquet d''amoureux transi, oeillets rouges et tournesols minuscules . L''un somnole sur son hamac.L''autre, slip noir sur chair ferme, remue ciel et terre pour tirer de sa torpeur son acolyte. Le voici qui fait valser, en guise de préambule, une brouette prolétaire, pendant qu''un magnétophone libère un standard sirupeux. Du miel dans la sueur. Tout est là : dans cette prousse foraine et dans cette vague légère de mélancholie. La serre est donc un cirque intime. Trente minutes à peine de frissons, qui valent toutes sortes de fantasias sur des pistes plus m''as-tu-vu. Il y a dix ans, ces deux-là faisaient partie du Cirque 0, spectacle en forme de manifeste, qui chassait l''animal de la piste et injectait du venin dans le corps des acrobates, suppliciés ou bourreaux. C''était un cirque cruel et culotté. Des histoire de fou qui nous ressemblaient... \r\rType de spectacle : fixe \rLangue du spectacle : muet \rAccessibilité pour personnes handicapées : oui \rDisposition du public : bi-frontal \rEspaces scéniques : serre \rFiche technique : légère\rOeuvre incrite à la SACD : oui\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'MDB_069_9554201410', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(5, 5, 'ADBO_043_8843649060', 2, 'JARDIN (CIE AT LEFEUVRE ANDRE)', 'LE JARDIN', 'Jean-Paul Lefeuvre, Didier André', '', '', 'Jean-Paul Lefeuvre, Didier André', '', 0, 0, 0, '2003', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn pavé dans les étoiles - Ne plus courrir, oublier le stress quotidien : un passage dans ce jardin régénère durablement. Une heure et quart sans paroles pour méditer sur la condition humaine. Soixante quinze minutes de poésie burlesque qui ramène au cinéma de Buster Keaton et au théâtre de Samuel Beckett. Quatre mille cinq cents secondes qui s''égouttent le plus souvent pianissimo. On a rarement vu, cependant, pareille maîtrise d''un tempo aussi délicat - et périlleux. Didier André et Jean-Paul Lefeuvre savent donc garder le rythme au ralenti, comme un volcan en veilleuse, crachant ses artifices de temps à autre, par surprise. Le cadre est simple : une grande serre au milieu de la scène et deux personnages, bien évidemment opposés dans leur style. L''un est de taille moyenne, dodu, pataud et plutôt autoritaire. Au début, il est couché dans un hamac et joue du banjo, l''air pas du tout rigolo. Il jongle avec tout, sauf avec ses zygomatiques. L''autre, style "Pierrot des jardins", est un peu plus grand, juste une culotte-short pour habit; toujours actif et serviable, l''air très souvent ahuri, regardant le public de ses grands yeux exhorbités. Ce gymnaste a des abdominaux en béton armé et la souplesse d''un félin. Ces deux jardiniers-clowns vont faire fleurir, sur les planches, les petits riens de l''existence et les gros tracas des relations entre les êtres. Pour accessoires: un magnétophone et des cassettes, une brouette, des cagettes, des bouquets de fleurs ou encore des tuyaux, petits ou grands (Tati aurait pu filmer la scène). Les deux compères se jouent des matières comme des références et des contrastes, entre l''ombre et la lumière, la gravité et la légèreté, à l''image de ce pavé qui semble plume. Il y a de l''émerveillement permanent dans ce spectacle, avec des effets rarement spectaculaires. Ils tirent un maximum d''une dramaturgie en apparence minimale. Dans ce Jardin, c''est le temps qui paraît suspendu. Il n''y a pas de saisons pour aller voir ce qui y pousse. Courez-y ! Michel Caspary, 24 Heures (CH)\r\rType de spectacle : fixe \rLangue du spectacle : muet \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9554234920', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(6, 6, 'ADBO_043_8843649060', 2, 'BRICOLAGE EROTIQUE (CIE AT LEFEUVRE ANDRE)', 'BRICOLAGE EROTIQUE', 'Jean-Paul Lefeuvre, Didier André', '', '', 'Jean-Paul Lefeuvre, Didier André', '', 0, 6, 0, '2007', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rBricolage : Travail peu rentable fait de ses mains en amateur et avec ingéniosité. Erotique : Relatif à l''amour physique, à la sexualité.Attention ! Même accompagné, ce spectacle se regarde seul et s''impose dans le jardin secret de chacun. Presque une centaine d''années à eux deux et toujours actifs à la Serre et au Jardin, ils explorent enfin la vie, leurs corps et la sensualité. Richesse de plaisirs. Rien de ce qu''ils méconnaissent ne les intimide. Alors, en toute naïveté et avec leur cirque pour bagage, ils partent déflorer ce monde merveilleux et sans limites. Avec ingéniosité, ils construisent leur luxure. Entre leurs mains : ficelles, rideaux, planches et ballons fabriquent des rêves de rondeurs, de longueurs et autres jeux de peau. Ces bricoleurs d''illusions imaginent la femme et la suggèrent par des détails qu''ils devinent. La pudeur est encore loin, insoupçonnée, inutile. L’un est rond, nonchalant, voyeur gentil et à peine vicieux. L’autre est long, perpétuellement agité, il ne perçoit rien des images maladroites ou obscènes, pour quiconque aurait les idées mal placées. Ni vulgaires ni pervers, ces deux hommes se jouent de la différence des genres. La dérision, la poésie et l''absurde sont peut-être leurs meilleurs atouts de séduction. N''interprétez pas mal ce que vous pensez voir, vous vous trompez sûrement déjà !\r\rType de spectacle : fixe \rLangue du spectacle : muet \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal \rEspaces scéniques : théâtre \rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2 \r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9554254420', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(7, 7, 'ADBO_043_8843649060', 2, 'ENTRE SERRE JARDIN (CIE AT LEFEUVRE ANDRE)', 'ENTRE SERRE ET JARDIN', 'Jean-Paul Lefeuvre, Didier André', '', '', 'Jean-Paul Lefeuvre, Didier André', '', 0, 0, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn lopin où tout pousse au sourire des gens Ces deux là n''ont rien en commun. Leurs apparences, leurs caractères et leurs buts les opposent. C''est la vivacité désorganisée contre l''intelligence de la paresse. Ils passent pourtant de concurrents à compères et complices. C''est leur monde. Pour "La Serre", les spectateurs sont invités à les rejoindre sous Serre et sur fond de gazon synthétique. Rencontre intime. Pour "Le Jardin", ils entrainent leur public au théâtre et lui dévoile la Serre sur un plateau. Transhumance. "Entre Serre et Jardin" se joue en plein air et en pleine herbe. Retour à la terre. Nos deux protagonistes sont chez eux partout, au soleil, sous la pluie, à même le sol. Les objets sont détournés de leur usage, c''est encore là leur poésie et c''est aussi leur Cirque. Conditions optimales pour la culture d''absurde au naturel, de dérision sauvage et d''inutile en botte. Le lourd écrase l''herbe que le long redresse. Le lent fait couler l''eau que le vif pompe à celle de son front. C''est un lopin où tout pousse au sourire des gens. Ils n''ont de répit que le temps de ce qu''ils récoltent : le bonheur du public.\r\rType de spectacle : fixe \rLangue du spectacle : muet\rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi-circulaire \rEspaces scéniques : parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9554263600', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(8, 8, 'ADBO_043_8843649060', 2, 'NI OMNIBUS (CIE AT LEFEUVRE ANDRE)', 'NI OMNIBUS', 'Jean-Paul Lefeuvre', '', '', 'Jean-Paul Lefeuvre', '', 0, 0, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rCirque et transports sont liés, tout est question de proportions. 5 mètres carré, ce sera ma piste, 120 places vos gradins. Nous partagerons cet espace réduit le temps d''un trajet immobile. Ces 8 mètres cubes joueront alors l''agrès principal, le premier rôle. Le paysage devient intérieur, le moteur-musique, les aménagements-accessoires et le bus-théâtre. A moi de triturer ces objets et tordre ce corps pour qu''ils étonnent,technique et dérision à l''appui. 100 mots et 1 spectacle pour regarder d''un oeil nouveau, passer le bus. \r\rType de spectacle : fixe \rLangue du spectacle : muet \rAccessibilité pour personnes handicapées : oui\rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, salle polyvalente \rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9554276070', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(9, 9, 'ADBO_043_8843649060', 2, 'CHEZ MOI CIRCUS (CIE AT LEFEUVRE ANDRE)', 'CHEZ MOI CIRCUS', 'Didier André', '', '', 'Didier André', '', 0, 0, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn jongleur se retrouve seul dans sa caravane, assis devant une vieille télévision. Dans cet espace réduit, il invite le public à revisiter sa vie d''artiste. Avec humour et poésie, les objets vont s''animer. Mais, tout se passe-t''il vraiment comme prévu ?\r\rType de spectacle : fixe \rLangue du spectacle : muet \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal \rEspaces scéniques : \rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'MDB_069_9554323800', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(10, 10, 'MDB_043_8841436990', 2, 'A&O PRÉSENTENT & (CIE A&O)', 'A&O PRÉSENTENT &', 'Joël Colas', '', '', 'Joël Colas', '', 0, 1, 0, '1998', 6, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rA et O sont deux personnages opposés et complémentaires issus du même univers naïf. Espiègles, leurs jeux sont tendres et parfois cruels. Et lorsque s''immisce entre eux &, c''est pour leur en faire voir de toutes les couleurs! Tel un nouveau trait d''union & devient entre A & O, le fil rouge de nouveaux conflits et de rapprochements à rebondissements. Manipulateurs manipulés d''objets simples, A & O se jouent de tout comme de tous avec un art accompli de l''espace, du mime et du corps. Dans cette parodie de vie en duo, & l''enfant de la balle va t''il perdre la boule? A&O présentent & est le spectacle sans mots de deux clowns qui parlent du lien entre homme & femme. Conte intimiste de cirque, il jongle sans cesse entre humour au premier et au second degré. Il s''inscrit pleinement dans une démarche imaginaire, sur les chemins de la suggestion plutôt que ceux de la démonstration, pour susciter l''émotion.\rSpectacle tout public à partir de 3 ans\r\rType de spectacle : fixe \rLangue du spectacle : spectacle muet (donc disponible à l''international) \rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2 + 1 technicien', '', '', '', '', '', '0000-00-00', 'MDB_069_9562708780', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(11, 11, 'MDB_043_8841436990', 2, 'KAO (CIE A&O)', 'KaO', 'Joël Colas', '', '', 'Joël Colas', '', 0, 4, 0, '2004', 5, 4, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rLa caricature du tracas qu''a O: accablé de n''être O, qu''un. Un clown bancal à caractère kamikaze, incapable de s''accaparer un camarade du même acabit. Car le cas d''O, c''est qu''il n''a rien à offrir, c''est un cas raté, un cas phare, un clown calamiteux d''occasion aux cahots pas très cathodiques. Ses cartons camouflent une cascade d''encarts et un capharnaüm où il n''a qu''à fouiller pour un apocalyptique carnage... de bouteilles plastiques! Le cirque à O c''est son chaos qu''O casse...\rKaO? est le spectacle d''un clown entre solitude et violence. Par l''imaginaire, il exprime une symbolique à partir d''un univers d''objets quotidiens détournés de leur utilisation, d''un vocabulaire sans paroles, et d''une musique bruitée en direct. Conte intimiste de cirque, KaO? est à la fois drôle et dérangeant. Il suggère bien plus qu''il ne laisse voir. Il cherche essentiellement à toucher d''émotion.\r\rType de spectacle : fixe \rLangue du spectacle : spectacle muet (donc disponible à l''international \rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi-circulaire \rEspaces scéniques : rue, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1 + 1 technicien\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_9703289560', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(12, 12, 'CmPa_043_6443296000', 2, 'SYMPHONIE HANNETON (CIE HANNETON)', 'LA SYMPHONIE DU HANNETON', 'James Thiérrée', '', '', 'James Thiérrée', '', 0, 2, 0, '1998', 0, 0, 0, 'Non', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rJérôme Sabre (lumière); Thomas Delot (son); Victoria Thiérrée (costumes); Raphaëlle Boitel, Magnus Jakobsson, James thiérrée, Uma Ysamat (interprètes)\r\rType de spectacle : fixe \rLangue du spectacle : spectacle muet \rAccessibilité pour personnes handicapées : oui\rDisposition du public : frontal \rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 4\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9703323680', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(13, 13, 'CmPa_043_6443296000', 2, 'VEILLEE ABYSSES (CIE HANNETON)', 'LA VEILLEE DES ABYSSES', 'James Thiérrée', '', '', 'James Thiérrée', '', 0, 2, 0, '2003', 0, 0, 0, 'Non', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rJérôme Sabre (lumière); Thomas Delot (son); Victoria Thiérrée, Cidalia Da Costa (costumes); Raphaëlle Boitel, Niklas Ek, Thiago Martins,, James thiérrée, Uma Ysamat (interprètes), James Thiérrée (scénographe)\r\rType de spectacle : fixe \rLangue du spectacle : spectacle muet \rAccessibilité pour personnes handicapées : non \rDisposition du public : frontal \rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 5\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9703330950', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(14, 14, 'CmPa_043_6443296000', 2, 'AU REVOIR PARAPLUIE (CIE HANNETON)', 'AU REVOIR PARAPLUIE', 'James Thiérrée', '', '', 'James Thiérrée', '', 0, 3, 0, '2007', 0, 0, 0, 'Non', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rJérôme Sabre (lumière); Thomas Delot (son); Victoria Thiérrée et Manon Gignoux (costumes); Kaori Ito, Magnus Jakobsson, Satchie Noro, Maria Sendow, James thiérrée (interprètes); James Thiérrée (scénographie)\r\rType de spectacle : fixe \rLangue du spectacle : spectacle muet\rAccessibilité pour personnes handicapées : non\rDisposition du public : frontal \rEspaces scéniques : théâtre \rFiche technique: moyyement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 5', '', '', '', '', '', '0000-00-00', 'ADBO_069_9703343110', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(15, 15, 'CmPa_043_6443296000', 2, 'RAOUL (CIE HANNETON)', 'RAOUL', 'James Thiérrée', '', '', 'James Thiérrée', '', 0, 5, 0, '2009', 15, 20, 12, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rJérôme Sabre (lumière); Thomas Delot (son); Victoria Thiérrée (costumes); James thiérrée (interprètes); James Thiérrée (scénographie)\r\rType de spectacle : fixe \rLangue du spectacle : spectacle muet\rAccessibilité pour personnes handicapées : non\rDisposition du public : frontal \rEspaces scéniques : théâtre \rFiche technique: moyyement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_9703345680', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(16, 16, 'MDB_043_8843419480', 2, 'AMES VEGETALES (CIRQUE VEGETAL)', '...AMES VEGETALES', 'Lucas David', '', '', 'Lucas David assisté de Ueli Hirzel et Yuko Kobayashi', '', 0, 1, 0, '2011', 0, 0, 14, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rExpérience foraine et circassienne Âmes végétales est incarné par deux chimères : L’Homme Arbre, qui s’inspire des palétuviers, arbres mobiles montés sur racines échasses, et la Femme Mousse qui revisite le mythe de la femme végétale. Éloge d’un espace-temps éloigné de celui des humains, éloge du dénuement (vide, rien), comme un retour à l’essentiel, à l’essence du cirque et de l’humanité, cette recherche porte un regard croisé sur les êtres vivants, les spécimens, sur l’enracinement déracinement de l’animal/homme et du végétal, sur l’exhibition foraine et les phénomènes d’attraction. Âmes végétales se joue dans les pars et les jardins.\r\rEquipe de création\rLucas David (direction, conception, mise en piste), Yuko kobayashi et Lucas David (interprètes), Monte Laster et Ueli Hirzel (accompagnement artistique), Yuko Kobayashi (chorégraphie), Shin Arai (costumes), Sandrine de Borman (végétalisation des costumes), Atelier Duval (fabricant chaussures), Franck Ténot et Arnaud Liegeon (construction scénographique), Jean Olivier Bourbon (fabricants cannes en bois).\r\rType de spectacle : fixe \rLangue du spectacle : sans paroles \rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi circulaire / circulaire \rEspaces scéniques : parc végétal, parcs et jardins \rFiche technique : moyemment lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2 ou 3\r\r\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_9703349600', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(17, 17, 'BO21_043_8124356731', 2, 'HISTOIRES DE MARCEL (CIE BLEUS TRAVAIL)', 'LES HISTOIRES DE MARCEL', 'Alexandre Demay', '', '', 'Alexandre Demay', '', 0, 1, 0, '', 3, 6, 4, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rLES HISTOIRES DE MARCEL, où la figure du clown apparaît dans toute sa force du désordre, Le clown physique, avec l’expression corporelle qui emmène le mot, le clown et sa métaphysique. Un clown qui n’a pas à subir le monde qui l’ entoure, mais qui a une fantasmagorie intrinsèque qui lui permet d’échapper à la contingence du monde, et donc de créer de nouvelles utopie :LE CLOWN\r\rType de spectacle : fixe \rLangue du spectacle : \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal , demi circulaire \rEspaces scéniques : théâtre, chapiteau, rue, parcs et jardins \rFiche technique: légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_9705494900', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(18, 18, 'BO21_043_8124356731', 2, 'RING (CIE BLEUS TRAVAIL)', 'LE RING', 'Alexandre Demay et Sylvain Granjon', 'Les Bleus de travail', '', 'Alain Veilleux', '', 0, 0, 0, '2005', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', '', '', '', '', '', '', '0000-00-00', 'ADBO_069_9705525670', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(19, 19, 'MDB_043_8843666270', 2, 'FLYING FISH CIRCUS (CIE MEZCLA)', 'FLYING FISH CIRCUS', 'Miriam de Sela, Sky de Sela', '', '', 'Andrès Tapia-Fernandez, Kamma Rosenbeck', '', 0, 2, 0, '2011', 5, 10, 7, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rAnnées 50, dans les coulisses d''un petit cirque traditionnel. L''heure du spectacle approche. On devine la scène de l''autre côté et les spectateurs qui s''installent. Mais nous sommes les spectateurs d''un autre spectacle. Celui qui se déroule de l''autre côté du miroir. Nous sommes les spectateurs de la vie de ces circassiens. Nous sommes témoins de leur échauffement, de leur préparation, de leur changement de costumes, de leurs angoisses, de leurs rires et surtout de leurs vies qui s''affichent et qui s''affirment...\r\rEquipe de création \rMiriam De Sela, Sky de Sela, Andrès Tapia-Fernandez et Kamma Rosenbeck (acteurs, auteurs et mise ne scène); Titoune et Sophie Akrich (assistance à la mise en scène, oeil extérieur); Ingo Groher, Jérôme Glorieux et Daniel Ott (conception et construction décor); Dorothée Lebrun (conception lumières); Sébastien Apert avec les artistes (bande son); Arnaud Guillossou (régisseur); Fary et Ayin de Sela (costumes), merci au Cirque Aladin\r\rType de spectacle : fixe \rLangue du spectacle : anglais et français\rDisposition du public : demi-circulaire\rEspaces scéniques : chapiteau du Flying Fish Circus (250 spectacteurs), théâtre (400 spectateurs max)\rFiche technique : moyemment lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 4\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9791637280', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(20, 20, 'MDB_043_8843666270', 2, 'MAINTENANT (CIE MEZCLA)', 'MAINTENANT', 'Sky De Sela', '', '', 'Sky de Sela', '', 0, 1, 0, '2006', 25, 25, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rMesdames et Messieurs j''ai pris une décision. Je ne veux plus rien cacher. C''est avec ces mots que le spectacle s''ouvre, et dans cet esprit qu''elle se présente pour raconter son histoire. L''histoire en soi n''a rien d''exceptionnel si ce n''est la révolution ordinaire inhérente à une vie - cette fois, une vie de cirque - qui tourne, qui tourne.\rLe tourbillon commence sobrement, les mots sont efficaces, directs. Le compte est limpide. Mais comme tout compte, sa source est au passé, les évenments s''empilent, les phrases s''entassent. La mémoire prend le dessus. Arrive un moment où la narration se suspend et à la place de toutes ces explications il y a un clown qui prend la parole, en silence. Il ne souffle pas un mot. Il vit la suite. sans notion de temps, le clown existe tout simplement, maintenant. Mais dans sa perméabilité extrême il se heurte à lui-même. Désastre. Il s''écroule, se désintègre et relaisse la place aux mots. L''intellect bloque l''impulse, le geste remplace le verbe, la femme provoque le clown. Le clown rappelle la femme. Sur une piste en bois, elle vibre avec tout cet élan, et tient debout.\r\rEquipe de création\rCarmen Blanco Principal, Ueli Hirzel, sophie Akrich (collaboration artistique); Julien Thiery et Benoit Jayot (création musical); Alexandra Karam (photographie); Daniel Ott (scénographie et création lumière)\r\rType de spectacle : fixe \rLangue du spectacle : anglais, français ou espagnol \rAccessibilité pour personnes handicapées : non\rDisposition du public : frontal et demi circulaire\rEspaces scéniques : théâtre ou chapiteau\rFiche technique : moyemment lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 3\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9791647080', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(21, 21, 'CmPa_043_6443296861', 2, 'PANINI CIRCUS (CIRQUE ILYA)', 'LE PANINI CIRCUS', 'Laurent Volken', '', '', 'Jacky Pellegrini', '', 0, 4, 0, '2005', 4, 6, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rAujourd''hui, dans notre ville, le Panini Circus vient généreusement nous dévoiler son secret de famille...la potion Forza Vita! Soyez convaincus, en véritables camelots, ils sauront vous conquérir, et vous repartirez vous aussi avec cet élixir de longue vie, panacée universelle à la posologie si simple : une seule goutte suffit pour résoudre tous vos problèmes. Pas de blabla, venez et voyez le résultat!\r\rEquipe de création\rMarion D''Hooge, Benny Martin (interprètes); Laurent Volken (artiste de cirque)\r\rType de spectacle : fixe \rLangue du spectacle : français \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal et demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9791802390', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(22, 22, 'CmPa_043_6443296861', 2, 'FRERES PANINI (CIE CIRQUE ILYA)', 'LES FRERES PANINI', 'Laurent Volken', '', '', 'Laurent Volken', '', 0, 4, 0, '2007', 4, 6, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rIls savent tout faire mais très mal. Venus tout droit d''italie, les Frères Panini vous pésentent un spectacle des plus explosifs! Giovanni et Bénito, échappés des plus grands cirques d''Europe, jouent avec Maestria une partition fantasque et surprenante où se mêlent vélo acrobatique, jonglerie, cascades et magie, le tout saupoudré de musique.\r\rEquipe de création \rBenny Martin (interprète); Laurent Volken (artiste de cirque)\r\rType de spectacle : fixe \rLangue du spectacle : français ou italien\rAccessibilité pour personnes handicapées : oui\rDisposition du public : frontal et demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9791854460', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(23, 23, 'CmPa_043_6443296870', 2, 'DUO TENBAS (CIRQUE STAR)', 'LE DUO TENBAS', 'Création collective du Cirque Star', '', '', 'Stéphane Philibert', '', 0, 4, 0, '2010', 12, 25, 25, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rVoici un duo explosif entre une starlette de la piste aux étoiles et son assistant maladroit! Jonglage de massues façon majorettes, dressage de chiens féroces, acrobaties romantiques, hercule de pacotille, hula hoop, assiettes en folie et bien d''autres surprises sont au programme...Un spectacle drôle, dynamique et intéractif présenté par deux personnages que tout oppose, où l''humour rime avec prouesse, la dérision avec tendresse, la surprise avec poésie...\r\rEquipe de création\rClaire Simon (trapéziste), Stéphane Philibert (clown)\r\rType de spectacle : fixe \rLangue du spectacle : français \rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins et autres structures itinérantes \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9791873150', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(24, 24, 'CmPa_043_6443296870', 2, 'ALLEE GRETTO (CIRQUE STAR)', 'ALLEE GRETTO', 'Stéphane Philibert', '', '', 'Stéphane Philibert', '', 0, 2, 0, '2011', 12, 25, 25, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLa journée s’achève sur la place du bout de « l’allée Gretto », le crieur de journaux plie bagage, la maréchaussée effectue une dernière tournée d’inspection, une habitante rentre son linge avant la tombée de la nuit. Derrière son orgue de barbarie, Ferdinand, chanteur de rue, compte la recette du jour… On lui avait bien dit que cela n’était pas un bon coin ! Il y a déjà bien longtemps que René le laitier, Ernest le photographe, et Bébert le rémouleur ont quitté le quartier…Seul dans la nuit tombé, Ferdinand va vous raconter son histoire: celle d’un être oublié qui a vu sa vie basculer par un beau soir d’été. \r\rEquipe de création\rClaire Simon (trapéziste), Sara Vermeylen (equilibriste), Martin Robin (jongleur et porteur), Guillaume Peudon (acrobate au mat chinois), Stéphane Philibert (clown); Gilbert Weiser (lumière); Abel Guibebault (costumes); Thierry Sadou (création musicale); Marc Dutriez et François Prost (graphisme)\r\rType de spectacle : fixe \rLangue du spectacle : français \rAccessibilité pour personnes handicapées : oui \rDisposition du public : circulaire \rEspaces scéniques : chapiteau\rFiche technique : moyemment lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 6\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9791884990', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Cirque traditionnel', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(25, 25, 'CmPa_043_6443301150', 2, 'MARGARET CHOMBARD (TOTORS)', 'MARGARET CHOMBARD', 'Claudie Dewynter', '', '', 'Nicolas Dewynter', '', 0, 4, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rQuant Margaret Chombard, déléguée territoriale des affaires en cours, est née elle a tout de suite casé sa science ! Immédiatement elle a voulu élever le niveau culturel des « Petites soirées » de St Rémy (71) en faisant à chaque ouverture de soirée, quel que soit le spectacle, «les « Prises de tête de Margaret », traitant en un quart d’heure des sujets aussi variés que Ionesco, la couleur bleue, la naissance du théâtre, le printemps, le mouvement dada etc...\r\rEquipe de création\rClaudie Dewynter (auteur et interprète), olivier Parolini (interprète), Nicolas Dewynter (metteur en scène)\r\rType de spectacle : Fixe et déambulatoire \rLangue du spectacle : français\rAccessibilité pour personnes handicapées : non\rDisposition du public : frontal ou demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9804686200', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(26, 26, 'CmPa_043_6443296130', 2, 'ASPIRATEUR (CIE GRAND JETE)', 'L''ASPIRATEUR - DE LA POUSSIERE AUTOUR DU COEUR', '', '', 'Frédéric Cellé, Solange Cheloudiakoff et Pauline Maluski (assistantes)', '', 'CCN Ballet de Biarritz (Accueil studio), L’arc scène nationale Le Creusot, Théâtre de l’Atrium de Tassin la Demi-Lune, Le Préau Théâtre de Vire et Les Scènes du Jura.', 0, 2, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rSept femmes se croisent autour d’une petite fille en fugue et d''un tapis volé. Chacune, sans forcément se connaître, a participé d''une façon ou d''une autre, volontairement ou pas, à ce micro drame.\rSept femmes, toutes avec une dent qui leur fait mal, un caillou dans leur chaussure, une douleur plus ou moins brulante qui agit par intermittence. De quoi sont faits les regrets qui émaillent nos vies ? Chaque corps a son nœud plus ou moins secret. On souffle magiquement sur la douleur des enfants pour la faire disparaître. Peut-on aspirer les regrets avant qu''ils nous empêchent de vivre?\r\rEquipe de création \rFrédéric Cellé (Chorégraphe); Pauline Sales (Commande d’écriture); Pauline Maluski (Assistante chorégraphe); Solange Cheloudiakoff (Assistante répétitrice); Catherine Ailloud-Nicolas (Dramaturge); Aurore Di Bianco, Li-Li Cheng, Inès Hernandez, Aurélie Mouilhade, Christine Labadie, Pauline Sales, Jeanne Rousseau ou Lucile Terreau ( Interprètes); Alexandre Balanescù (Musique); Anthony Poupard (Direction d’acteurs); Thomas Chazalon (Régie générale, Régie lumières); Laurent Sassi (Régie son); Amandine Fonfrede (Scénographe); Béatrice Vermande (Costumes).\r\rType de spectacle : fixe \rCréation/ reprise : création \rDisposition du public : frontal \rEspaces scéniques : théâtre \rFiche technique : moyennement lourde\rContraintes scéniques : parquet souple, tapis de danse\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 10\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9895311890', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(27, 27, 'MDB_043_9899664660', 2, 'MORVENTE (CIE PAROLES MA PAROLE)', 'MORVENTE', 'Jean-Claude Aubrun', '', '', '', '', 0, 5, 0, '2011', 0, 4, 4, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rPeut-on tout vendre ? Objets, maison, mémoires, corps… C’est une histoire de séparation impossible, d’une retrouvaille, d’un nouveau départ. Un vieux morvandiau attaché sa maison, à son patois natal et au passé qui l’entoure. Une nièce à la verve citadine qui revient et qui veut se débarrasser des objets, des histoires et des secrets de famille. Entre celui qui est resté et qui garde tout et celle qui est de passage et veut tout vendre, deux générations, deux solitudes, deux cultures s’affrontent. Quand la porte du passé et la porte de l’ailleurs sont ouvertes, ça fait courant d’air et l’air du Morvan s’engouffre et la pièce se réveille. Le tout, sous les yeux du public devenu acheteur et un Taisant : si on vend, tout doit rester dans la famille. Deux néo-ruraux originaux et accueillants, débarqués dont on ne sait où, qui offrent à manger et à boire aux spectateurs. \r\rType de spectacle : fixe \rLangue du spectacle : Français / patois bourguignon \rAccessibilité pour personnes handicapées : non \rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, parcs et jardins, ou chez l''habitant (4m x 4m)\rFiche technique : légère\rOeuvre inscrite à la SACD : non\r-Artistes sous contrat : 2\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9899681440', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(28, 28, 'CmPa_043_6443295630', 2, 'MASQ (CIE ALFRED ALERTE)', 'MASQ', '', '', 'Alfred Alerte', '', '', 0, 1, 0, '2003', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLargement inspiré des cultures antillaise et africaine, MASQ se construit autour d’un conte écrit par François Place. L’air, la terre et l’eau accompagnent le personnage principal à travers son parcours initiatique. Supports majeurs du spectacle, des «masques-costumes», vivent et se transforment tantôt en créatures humaines, tantôt en éléments de décor, créant ainsi un univers et des situations fantastiques. Les chorégraphies, interprétées avec une inépuisable intensité, palpitent au rythme des percussions et soulignent avec finesse la magie et la poésie qui animent le texte. Né d’une rencontre entre Alfred Alerte, danseur et chorégraphe d’origine martiniquaise formé aux côtés de Maurice Béjart, et François Place, auteur et illustrateur de nombreux contes, ce spectacle suscite l’imaginaire et invite au rêve. Entre conte et poésie, entre musique et danse, Masq est une fable onirique conçue comme une invitation au voyage...\r\rEquipe de création\rFrançois Place (conte); Agathe Laemmel et Marion Laurens (Masques et Costumes); Hervé Bontemps (Lumières); Thierry Bertoneu (musique); Alfred Alert, Lucie Anceau et Julie Barbier (interprètes)\r\rType de spectacle : fixe \rCréation/ reprise : création \rDisposition du public : frontal \rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : moyennement lourde\rContraintes scéniques : parquet souple, tapis de danse\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 4\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9899873560', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(29, 29, 'CmPa_043_6443295630', 2, 'LUKU (CIE ALFRED ALERTE)', 'LUKU - SUR LES TRACES DES REVES', '', '', 'Alfred ALERTE', '', '', 0, 4, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation \rLa matière chorégraphique du solo est largement inspirée par les recherches faites avec les enfants autour des traces : traces animales, traces humaines, éléments de paysages, traces d''esprits... La pièce associe avec justesse danse et arts visuels, jouant du métissage entre danse d''inspiration tribale et danse contemporaine. Tout en se nourrissant des traditions ancestrales aborigènes l''écriture chorégraphique les transpose dans une démarche fortement actuelle. Un univers poétique et sensible qui vous invitera indéniablement au voyage et au rêve...\r\rEquipe de création \rSylvain Marguerat (lumières), Lucie Anceau (interpète)\r\rType de spectacle : fixe \rCréation/ reprise : création \rDisposition du public : frontal \rEspaces scéniques : théâtre, salle polyvalente \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rContraintes scéniques : aucune\rArtistes sous contrat : 3\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9899883170', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(30, 30, 'CmPa_043_6443295630', 2, 'EXIBUS (CIE ALFRED ALERTE)', 'EXIBUS', '', '', 'Alfred Alerte', '', '', 0, 4, 0, '1999', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rComme surgit d’un monde fantastique, Exibus se tient là, posé, immense et majestueux, suspendu à l’espace et au temps. Le moindre de ses mouvements se répète et se délie à l’infini dans une danse tentaculaire. Cette étrange créature se reproduit, abandonnant dans son sillage des prolongements d’elle-même, comme des jetés, des tracés de vie... Histoire ludique et joyeuse, de grandes et petites formes qui s’animent, se rencontrent, s’inventent et se transforment ! Exibus ce personnage venu d’ailleurs nous emmène dans un monde où différence, reconnaissance de soi et acceptation par les autres, sont autant de chemins à parcourir et à défricher. \r\rEquipe de création \rAlfred Alerte, Lucie Anceau, Marc Fennette ou Fabrice Provansal (interprètes)\r\rType de spectacle : fixe, déambulatoire, performance \rCréation/ reprise : création \rDisposition du public : frontal , demi-circulaire \rEspaces scéniques : rue, parcs et jardins \rContraintes scéniques : aucune\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 3\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9901833410', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte');
INSERT INTO `oeuvres_oeuvres` (`id`, `user_id`, `ficheliee_id`, `type_id`, `nom_usuel`, `nom_complet`, `auteur`, `compositeur`, `choregraphe`, `metteurenscene`, `producteur`, `duree`, `prix`, `jauge`, `anneecreation`, `hauteurminimale`, `profondeurminimale`, `ouvertureminimale`, `disponibilitespectacle`, `projetencours`, `interprete`, `distributeur`, `scenariste`, `realisateur`, `editeurmusical`, `labels`, `co_auteur`, `traducteur`, `illustrateur`, `isbn`, `gencod`, `nomcollection`, `lieuedition`, `reedition`, `leformat`, `nombrepage`, `numdewey`, `anneeedition`, `titreorigine`, `auteur_origine`, `co_auteur_origine`, `editeur_origine`, `langueorigine`, `languetraduite`, `annee1erpublication`, `code_operateur`, `nom_operateur`, `commentaires`, `commentaires_arts_visuels`, `commentaires_audio_visuel`, `commentaires_livre`, `commentaires_patrimoine`, `commentaires_spectacle`, `date_actualisation`, `id_fiche`, `mot_passe`, `questionnaires`, `nom_prenom_destinataire`, `e_mail_destinataire`, `fonction_titre`, `liste_des_contacts`, `activites`, `genres`, `disciplines`, `localisations`, `precision_activites`, `type_public`, `support`, `rayonnement`, `distinction`, `index_complementaire`) VALUES
(31, 31, 'CmPa_043_6443295630', 2, 'POIGNEE DE TERRE (CIE ALFRED ALERTE)', 'POIGNEE DE TERRE, GANTS DE VELOURS', '', '', 'Alfred Alerte, Lucie Anceau (assistante)', '', '', 0, 1, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rForte de son implantation en milieu rural depuis une dizaine d’années, la Compagnie Alfred Alerte se lance le défi de travailler avec les éléments qui l’environnent en créant une pièce pour « danseurs, agriculteur et tracteur… » Ce projet issu des relations tissées au fil du temps avec les paysans locaux cherche à montrer que dans l’AgriCulture il y a bien de la Culture, au sens artistique du terme. Cette pièce associe trois danseuses aux personnalités et parcours très différents - Annamirl Van der Pluijm, danseuse de Jan Fabre et Reinhild Hoffmann et chorégraphe de ses propres soli depuis une vingtaine d’années - Aurore Castan Ain, danseuse de Luc Petton et Marilen Breukler et chorégraphe de la Cie Kalijo - Lucie Anceau, danseuse d’Alfred Alerte et Jany Jérémy et assistante chorégraphique d’Alfred Alerte Ces trois femmes associées à Pascal Ragon et son tracteur créent à travers leur danse un hymne poétique en hommage au monde rural.\r\rEquipe de création : Pascal Ragon, Jean-François Ragon, Virgile Vaurette (aménagement du tracteur); Lucie Anceau, Aurore Castan, Pascal Ragon, Annamirl Van Der Pliijm (interprètes)\r\rType de spectacle : fixe \rCréation/ reprise : création \rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : rue, parcs et jardins \rFiche technique : légère\rContraintes scéniques : aucune\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 4\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9901848340', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(32, 32, 'ADBO_043_7489149760', 2, 'STELLA (CIE JOELLE BOUVIER)', 'STELLA', '', '', 'Joëlle Bouvier', '', '', 0, 2, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Equipe de création\rThalie Gibout (lumière), Min Jeongkim et Luca Giacomoni (interprètes)\r\rType de spectacle : fixe \rDisposition du public : frontal \rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : légère\rContraintes scéniques : tapis de danse\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 4\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9901889040', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(33, 33, 'MDB_043_8841458920', 2, 'BATELEUR (CIE ANXO)', 'LE BATELEUR', 'Simon Anxolabéhère, Hélène Lopez de la Torre', '', '', 'Simon Anxolabéhère, Hélène Lopez de la Torre', '', 0, 1, 0, '2012', 0, 0, 0, 'Non', 'Oui', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLe bateleur est d’une certaine façon le Créateur de mondes qui ne sont pourtant qu’illusions. Il ne suit même pas le mouvement de ses mains ; son regard est ailleurs, il joue. Sa concentration est sans effort, son écoute silencieuse ; il est le présent, le commencement. C’est un jongleur qui relie le ciel et la terre et pour qui chaque balle lancée est une célébration. Le personnage (jongleur, musicien, clown et magicien) joue avec le vide, l’espace, les objets sonores et les balles. Il témoigne de son époque et tente d''y voir de l''espoir en créant une poésie. La scénographie dirige la cadence (éolienne, panneau solaire, un nid, des réveils...) La musique est un mélange d''instruments ludiques joués en direct par l''artiste, d''ambiances sonores , de morceaux classiques. "Le Bateleur", un spectacle qui traite de l''actualité où le personnage lit le Journal pour les enfants. Comment parler aux enfants d''informations, de climat, de faits divers, de politique planètaire, de philosophie ? Le spectacle s''ouvre sur un espace vide où juste une éolienne se met à tourner au son du vent. La lumière s''allume ainsi.Le spectacle commence.....\r\rType de spectacle : fixe \rAccessibilité pour personnes handicapées : oui \rDisposition du public : frontal, demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue \rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_9908471240', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(34, 34, 'MDB_043_8841458920', 2, 'HEN TA PENTA (CIE ANXO)', 'HEN TA PENTA', 'Simon Anxolabéhère, Hélène Lopez de la Torre', '', '', 'Simon Anxolabéhère, Hélène Lopez de la Torre', '', 0, 4, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\r« Hen Ta Panta » signifie Un-Toute-choses. Point de départ de ce spectacle, « Hen Ta Panta » est une célébration de la Vie. L’artiste joue avec les bulles et leur plasticité : les différentes tailles de celles-ci, leur transparence, leur pesanteur et leur rondeur. Que ce soit en équilibre (avec un mobile géant), en manipulation (pluie de bulles, jonglage de balles acryliques), en construction, avec des bulles qui n’éclatent pas, les bulles sont partout.\rDe l’infiniment petit, comme une goutte d’eau, à l’infiniment grand, où l’artiste se retrouve dans une bulle géante.\rLa danse et la manipulation d’objets soulignent les déplacements tantôt aériens, tantôt aquatiques des bulles.\r « Hen Ta Panta » est une invitation à la poésie, à la mémoire de la Création.\rL’artiste jongle avec une multitude de petites bulles qui flottent autour d’elle ou se collent à son corps. Sa danse est aquatique, lente, électrique. Passage du monde aquatique à l’air libre : naissance.\rAu Milieu d’une pluie de bulles, l’artiste, tout en jouant des claquettes, éclate les bulles qui deviennent musicales. Une Mélodie de cloches retentit, accompagnée du clapotement rythmé par les pieds. C’est alors que tout s’arrête, laissant place à quelques bulles restées suspendues dans l’espace. L’artiste jongle avec les bulles en apesanteur qui tournent comme un mobile géant. De l''image de la naissance, nous passons à celle du début de l''enfance\r\rEquipe de création\rHélèné Lopez de la Torre, Simon Anxolabéhère\r\rType de spectacle : fixe\rDisposition du public : frontal et demi-circulaire\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9908515880', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(35, 35, 'ADBO_043_9350993340', 2, 'ANTIGONE (CIE ATELIER 29)', 'ANTIGONE, MONOLOGUE CLOWNESQUE', 'Adèll Nodé-Langlois et Sophie Buis', '', '', 'Sophie Buis, Mads Rosenbeck (regard extérieur)', '', 0, 1, 0, '2007', 5, 8, 10, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rSymbole de la rébellion, condamnée à mort pour avoir enterré son frère Polynice malgré les ordres du roi Créon, Antigone a toujours sa robe noire, mais son gros nez est rouge, ses cheveux ébouriffés, et sa bouche bien trop large. Sous la terre noire de Thèbes, c’est une piste de cirque qu’on aperçoit. Antigone est triste mais enragée. C’est normal, son frère est mort et c’est aujourd’hui qu’elle va l’enterrer. Tout est prêt, elle a même fabriqué un cercueil. Alors à coup de peinture , de cheval de cirque, et de chocolat, Antigone se débat, s’insurge, et fait de ces funérailles un grand carnaval innocent, hirsute et exalté. \r\rEquipe de création\rAdell Nodé-Langlois (interprète, conception et construction décor); Guillaume Roudot (conception et construction décor); Sébastien Morin (conception lumières); De Kift (bande son); Sébastien Morin ou François Pernin (régisseur); Charlotte Pareja - Atelier Bonne taille (costumes)\r\rType de spectacle : fixe \rLangue du spectacle : aucune \rAccessibilité pour personnes handicapées : oui\rDisposition du public : frontal, demi-circulaire\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rEspaces scéniques : théâtre, chapiteau \rArtistes sous contrat : 1\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_9908549910', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(36, 36, 'ADBO_043_9350993340', 2, 'CARNETS VOLEUSE (CIE ATELIER 29)', 'CARNETS D''UNE VOLEUSE', 'Adèll Nodé-Langlois', 'Mayeul Loisel', '', 'Mads Rosenbeck', '', 0, 1, 0, '2010', 5, 8, 6, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rAdèll Nodé-Langlois imagine un récit autour de l’incarcération empli et emprunt de poésie, entre le sublime et le viscéral. La circassienne y célèbre les voleurs comme des sortes de frères d’armes des clowns : des êtres marginaux, hors norme. Des exclus auréolés de grâce, des voyous et des clowns finalement proches de la figure de l’Ange\r\rEquipe de création\rAdèll Nodé-Langlois (interprète); Mayeul Loisel (musique), Sébastien Morin (création lumières), Fary (costumes); remerciements à Titoune\r\rType de spectacle : fixe \rLangue du spectacle : français \rDisposition du public : frontal ou demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'MDB_069_9910463640', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(37, 37, 'Serv_043_8169584021', 2, 'CIRQUM FLEX (CIRQUM FLEX)', 'LE CIRQUM FLEX', 'Olivier Sanseigne et Laurent Chavany', '', '', 'Olivier Sanseigne et Laurent Chavany', '', 0, 4, 0, '2005', 6, 6, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLa mise en place des éléments se termine : Sur la piste, Ballo et son cousin, Olive Legrand, s''affairent à ce que tout soit en place pour l''arrivée de la star : Olivski Zaïkuski. Quand il arrive tout s''enchaîne, se succède et se dérègle à vitesse grand V. La vedette se fait voler le protagonisme par son assistant. L''assistant est dépassé par son cousin et le cousin ne sait pas ce qu''il fait. En mêlant les disciplines classiques de cirque (jongleries, équilibres, clown) avec l''absurdité et les quiproquos, la compagnie fait perdre pied au spectateur. Les doubles sens régalent les parents autant que les enfants et le final laisse entrevoir un monde que l''on souhaite meilleur.\r\rType de spectacle : fixe \rLangue du spectacle : français ou espagnol\rAccessibilité pour personnes handicapées : oui\rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, rue, chapiteau, salle polyvalente, parcs et jardins...\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9910509960', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(38, 38, 'ADBO_043_8169571270', 2, 'ENTRE NOUS (CIRQUM SOLO)', 'ENTRE NOUS', 'Olivier Sanseigne', '', '', 'Olivier Sanseigne', '', 0, 5, 0, '2008', 0, 5, 6, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rAu début, une personne, un homme. Il arrive sur la piste. Il est en retard, il cherche, il attend quelqu’un. Soudain, dans le public, une rencontre se produit, un échange se crée. Il veut aller plus loin, s’expose, explose et finit en apothéose. "Entre nous", premier spectacle solo d’El Gran Olif, est un moment d''échange entre l''artiste et son public. Drôle, absurde, cocasse mais surtout… fin...\r\rType de spectacle : fixe \rLangue du spectacle : pas de parole \rAccessibilité pour personnes handicapées : oui \rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'MDB_069_9910530750', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(39, 39, 'CmPa_043_6443296850', 2, 'MADGICA (CIRKO SENSO)', 'MADGICA', 'Hervé Duca', '', '', 'Nicolas Dewynter', '', 0, 5, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation \rSur fond de gromelot et onomatopées, Elbé Douka, le magicien fou, nous embarque dans un univers étrange et original. Apparition, disparition, manipulation, prestidigitation... Madgica ! Un tour de passe-passe pour un spectacle décalé, déroutant et délirant, plein d''humour et de poésie, pour tout public à partir de 6 ans.\r\rEquipe de création : Hervé Duca (magicien)\r\rType de spectacle : fixe \rLangue du spectacle : Gromelo\rAccessibilité pour personnes handicapées : oui\rDisposition du public : frontal \rEspaces scéniques : théâte, chapiteau, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 1\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9910536980', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(40, 40, 'CmPa_043_6443296850', 2, 'CIRQUE DANS VALISE (CIRKO SENSO)', 'UN CIRQUE DANS UNE VALISE', 'Oleguer Preto', '', '', 'Hervé Duca', '', 0, 5, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLe petit cirque d''Ula, un cirque si petit qu''il tient dans une... valise ?!" Pas d''éléphants, pas de trapézistes, pas de funambules... mais le grand coeur d''un clown qui aime avant tout être avec son public. Sous vos applaudissements et au son de vos fous rires, Ula vous fera découvrir sa vie de clown avec des numéros époustouflants de balles et diabolo fous, de chapeau capricieux et de dressage comique. Un spectacle dynamique et participatif de jonglerie, acrobatie et humour pour tout public.\r\rType de spectacle : fixe \rLangue du spectacle : français ou espagnol \rDisposition du public : demi-circulaire \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 1\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9910545210', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(41, 41, 'CmPa_043_6443296850', 2, 'P''TIT VERRE CIRQUE (CIRKO SENSO)', 'UN P''TIT VERRE DE CIRQUE', 'Marion D''Hooge', '', '', 'Hervé Duca', '', 0, 5, 0, '2006', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn duo poétique, drôle et tendre, pour tout public ! Un accordéoniste guilleret arrive de nulle part et s’accorde une petite pause entre deux tonneaux. S’enivrant de musique, il se met à divaguer tout en dégustant le nectar divin. Mais son verre se vide plus vite que la musique… Les artistes de la Cie Cirko Senso partent de leurs sources bourguignonnes pour mélanger joyeusement le monde du vin et l''univers du cirque, avec au programme : équilibres sur tonneau, danse de verres, portés acrobatiques et accordéon.\r\rEquipe de création : Marion d''Hooge (équilibriste, costumes); frédéric Vanet (accordéoniste)\r\rType de spectacle : fixe \rLangue du spectacle : pas de paroles\rAccessibilité pour personnes handicapées : oui\rDisposition du public : demi-circulaire\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9910605280', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Musique ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(42, 42, 'CmPa_043_6443296850', 2, '2 MAINS 3 PIEDS (CIRKO SENSO)', '2 MAINS 3 PIEDS', 'Marion D''Hooge', 'Sylvain Nouguier', '', 'Hervé Duca', '', 0, 5, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUne performance hybride, animal et onirique, pour tout public. Un tonneau, une curieuse araignée, de drôles de bestioles, des yeux tout ronds, une main, deux mains, ...trois pieds ! Dans ce spectacle intriguant, impressionnant et poétique, Marion D''Hooge, sans un mot, évoque plus qu''elle ne raconte. Avec grâce et sensibilité, accompagnée d’une musique électroacoustique, elle nous offre des équilibres sens dessus-dessous, des contorsions atypiques, des pirouettes acrobatiques et des mutations à répétition.\r\rType de spectacle : fixe \rLangue du spectacle : pas de paroles \rAccessibilité pour personnes handicapées : oui\rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'MDB_069_9910624830', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(43, 43, 'CmPa_043_6443296850', 2, 'ENVERS DECORS (CIRKO SENSO)', 'L''ENVERS DU DECORS', 'Marion D''Hooge', '', '', 'Laure Seguette', '', 0, 4, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn spectacle de cirque truffé de rebondissements, de cascades et d''humour. "Que le spectacle commence !", dit-on. Mais, monter un spectacle n''est pas chose facile. Le cirque demande de l''adresse, de l''équilibre, de la grâce, de la discipline et un sens aigu du travail en équipe. Et... tout dérape ! Nos deux stars et leur assistant vont tout tenter pour que le spectacle soit parfait, ou presque. Le régisseur s''emmêle dans ses câbles, trébuche et s''étale sur la scène ; les filles se chamaillent et les pyramides acrobatiques s''effondrent, mais... La magie est là ! Et les artistes apparaissent, disparaissent et réapparaissent !\r\rEquipe de création\rMarion d''Hooge (auteur, artiste, costumes, décor); Sylvain Nouguier (artiste), Karine Amiot (artiste)\r\rType de spectacle : fixe \rLangue du spectacle : français, très peu de texte\rAccessibilité pour personnes handicapées : non\rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9910630570', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(44, 44, 'CmPa_043_6443295871', 2, 'DUO DUEL (CLAIR OBSCUR)', 'DUO DUEL', 'Vincent Regnard, Laurent Renaudot', '', '', 'Vincent Regnard, Laurent Renaudot', '', 0, 5, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rTony et Pédro sont frères. Ils ont décidé de faire perdurer les traditionnels numéros du cirque familial. Pour le plus grand plaisir des spectateurs, ils présentent des duos de jonglerie et de grandes illusions dont ils sont les seuls à détenir le secret. Ce spectacle sera servi avec élégance et humour, car ici se joue l’honneur de la famille Renardo !\r\rEquipe de création\rVincent Regnard, Laurent Renaudot (comédiens, jongleurs)\r\rType de spectacle : fixe \rLangue du spectacle : français\rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9914748790', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(45, 45, 'CmPa_043_6443295871', 2, 'ROBIN BALLES MAGIQUES (CLAIR OBSCUR)', 'ROBIN ET LES BALLES MAGIQUES', 'Laurent Renaudot', '', '', 'Laurent Renaudot', '', 0, 5, 0, '2003', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rRobin, jeune fils de vigneron, rencontre un jour une mystérieuse fée et décide alors de devenir troubadour. Il nous raconte sa destinée entre jonglerie, pitrerie et équilibrisme\r\rEquipe de création : Laurent Renaudot (comédien, jongleur)\r\rType de spectacle : fixe \rLangue du spectacle : français \rDisposition du public : frontal \rEspaces scéniques : chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2, dont 1 technicien\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9914799680', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(46, 46, 'CmPa_043_6443295871', 2, 'SIM SALABIM (CLAIR OBSCUR)', 'SIM SALABIM', 'Gaël Amizet, Guillaume Magnien', '', '', '', '', 0, 4, 0, '2003', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUne petite maison tout là-haut dans le grand nord s''illumine. C''est l''atelier du Père Noël. Froggy le lutin malicieux s''affaire aux derniers préparatifs des cadeaux. L''arrivée de Barbatruk le Magicien, va soudainement raviver son plus profond désir : Grandir! Il va tout tenter pour son rêve se réalise au dépend de Barbatruk qui lui apprendra avec peine que quand on grandit trop vite, on ne grandit pas bien...\r\rEquipe de création : Gaël Amizet (jongleur, équilibriste); Guillaume Magnien (magicien); Charles Brun (lumière)\r\rType de spectacle : fixe \rLangue du spectacle : francais \rDisposition du public : frontal \rEspaces scéniques : chapiteau, salles polyvalentes, écoles \rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3, dont 1 technicien\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9914812200', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(47, 47, 'CmPa_043_6443295871', 2, 'FOCUS ALLEGORIA (CLAIR OBSCUR)', 'FOCUS ALLEGORIA', 'Collectif Le Clair obscur', '', '', 'Simon Anxolabéhère', '', 0, 1, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rSPECTACLE DE FEU - Vision allégorique des oeuvres du peintre Jérôme Bosch où le jeu se révèle conducteur de rêverie et de mystère...\r\rEquipe de création\rSimon Anxolabéhère (metteur en scène, arrangement musical); Delphine ribeiro (danse, chant); Gaël Amizet (comédien, manipulation feu); Christophe Dorbais (comédien, manipulation feu); Vincent Regnard (comédien, manipulation feu); Laurent Renaudot (comédien, manipulation feu); hélène Lopes de la Torre (comédienne, manipulation feu); Gérald Dologé (scenographie, accessoiriste)\r\rType de spectacle : fixe \rLangue du spectacle : muet + chant \rAccessibilité pour personnes handicapés : en fonction des lieux \rDisposition du public : frontal, demi-circulaire \rEspaces scéniques : rue, parcs et jardins\rFiche technique : lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 7, dont 1 technicien\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9914836940', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(48, 48, 'CmPa_043_6443295871', 2, 'PHOBIE LONGUEURS (CLAIR OBSCUR)', 'LA PHOBIE DES LONGUEURS', 'Laurent Renaudot, Gaël Amizet', '', '', 'Simon Anxolabéhère (regard extérieur)', '', 0, 4, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rThierry est un jongleur soliste qui vous présente un trio en duo avec Jean-Claude, son ami et technicien de fortune. Ces deux-là sont obsédés par le rythme de leur spectacle car ils ont la phobie des longueurs. Organisation chaotique et incidents de parcours sont leur quotidien, mais ils restent pourtant convaincus que le jour où ils auront un bon public, le succès sera alors au rendez-vous.\r\rEquipe de création : Simon Anxolabéhère (regard extérieur); Laurent Renaudot, Gaël Amizet (comédiens)\r\rType de spectacle : fixe \rLangue du spectacle : français \rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau \rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9914847160', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(49, 49, 'CmPa_043_6443295871', 2, 'LAELITH (CLAIR OBSCUR)', 'LAELITH', 'Collectif du Clair Obscur', '', '', 'Collectif du Clair Obscur', '', 0, 4, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn cortège poético féerique... Née de l’air, elle danse libre, joyeuse et légère. Elle est la caresse, le souffle qui enchante. Né du bois, il frappe, rythme et percute malignement. Il est le coeur sonore, la pulsion de Laëlith. Nés du feu et de l’eau, ils sont les gardes du cortège. Force tranquilles, ils veillent, insaisissables et majestueux. Née du crépuscule, elle est la mélodie tranquille. De l’aurore à l’étoile, elle charme par les vibrations de sa musique.\r\rEquipe de création: Gaël Amizet (échassier), Vincent Regnard (échassier), Hélène Lopes de la Torre (danseuse), Amélie Loisy (costumes)\r\rType de spectacle : déambulatoire \rLangue du spectacle : muet \rAccessibilité pour personnes handicapés : en fonction des lieux \rDisposition du public : déambulatoire \rEspaces scéniques : rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9916920110', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(50, 50, 'CmPa_043_6443295871', 2, 'CHANGE DEMAIN (CLAIR OBSCUR)', 'CHANGE DEMAIN', 'Vincent Regnard, Christophe Dorbais', '', '', 'Vincent Regnard, Christophe Dorbais', '', 0, 5, 0, '2003', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rD''apparence très organisée, la représentation devrait se dérouler sans embûches. Vic, jongleur à l''assurance certaine est prêt à vous présenter ses nouvelles prouesses. Mais Toc son compagnon de scène est un perturbateur dans l''âme. Lui aussi est jongleur mais ce qu''il aime par dessus tout, c''est jongler avec les nerfs de Vic. Et pour parvenir à ses fins tout est bon. Jonglerie, musique et pitreries.\r\rEquipe de création : Vincent Regnard et Christophe Dorbais (comédiens et jongleurs)\r\rType de spectacle : fixe \rLangue du spectacle : français \rDisposition du public : frontal \rEspaces scéniques : chapiteau, salle polyvalente, parcs et jardins, école \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'MDB_069_9916948070', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(51, 51, 'CmPa_043_6443295871', 2, 'RIDEAU TROUBADOURS (CLAIR OBSCUR)', 'LE RIDEAU DES TROUBADOURS', '', '', '', 'Simon Anxolabéhère (regard extérieur)', '', 0, 1, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation \rSpectacle - Animations médiévales : Les trublions de Clair Obscur envahissent vos rues, places, cours et tavernes pour présenter leurs numéros et pitreries afin d''esbaudir le bon peuple de votre ville\r\rEquipe de création\rGaël Amizet, Vincent Regnard, Laurent Renaudot, Hélène Lopes de la Torre, Christophe Dorbais, Guillaume Magnien, Delphine Ribeiro, Yannick Sirurguet (jeu, jonglerie, acrobate, magie et chant).\r\rType de spectacle : fixe \rLangue du spectacle : français \rDisposition du public : frontal, demi-circulaire \rEspaces scéniques : chapiteau, rue \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 8\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9916961270', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(52, 52, 'CmPa_043_6443295871', 2, 'AMOK (CLAIR OBSCUR)', 'AMOK', 'Vincent Regnard', '', '', 'Vincent Regnard', '', 0, 5, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rD''apparence classique mais d''interprétation moderne, ce duo, qui réunit un accordéoniste et un jongleur, narre l''histoire de ce dernier qui va se laisser charmer par la musique et faire vibrer ses objets avec finesse et harmonie...\r\rEquipe de création\rVincent Regnard (jonglerie, manipulation d''objets), Marc Clément (musicien, composition musicale)\r\rType de spectacle : fixe \rLangue du spectacle : muet \rDisposition du public : frontal, demi-circulaire \rEspaces scéniques : théâtre, chapiteau, rue \rFiche technique : légère\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'MDB_069_9916971230', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Musique ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(53, 53, 'CmPa_043_6443285011', 2, 'ICI (JEROME THOMAS)', 'ICI.', 'Jérôme Thomas, Markus Schmid, Pierre Bastien', '', '', 'Jérôme Thomas, Markus Schmid', 'Association ARMO/Cie Jérôme Thomas avec le soutien de la Cie Andrayas; co-production : Comédie de Caen - Centre Dramatique National de Normandie / Agora PNC de Boulazac / Théâtre Dijon Bourgogne - Centre Dramatique National', 0, 2, 0, '2010', 6, 10, 9, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation \rUn spectacle pour trois mouvements, pour deux artistes et une musique mécanique, aux fins de transformer la contrainte en poésie...\r\rEquipe de création\rMarkus Schmid (artiste), Jérôme Thomas (artiste), Pierre Bastien (musique, création des machines musicales), Ivan Roussel (création sonore), Bernard Revel (lumière et scénographie), Emmanuelle Grobet (costumes), Julien Lanud (régie générale et plateau), Franck Ténot, Atelier Prelud, Olivier Gauducheau, Basile Bernard (construction décor et machinerie de scène)\r\rType de spectacle : fixe \rAccessibilité pour personnes handicapés : oui\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2 et 3 régisseurs\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9917005670', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(54, 54, 'CmPa_043_6443285011', 2, 'DUO JEROME THOMAS - JEAN-FRANCOIS BAEZ', 'DUO JEROME THOMAS INVITE JEAN-FRANCOIS BAEZ', 'Jérôme Thomas, Jean-François Baëz', '', '', 'Jérôme Thomas', 'Espace des Arts, scène nationale de Chalon-sur-Saône, co-production Act-Opus Compagnie Roland Auzet/ ARMO compagnie Jérôme Thomas', 0, 2, 0, '2003', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rArmés pour l’un d’un accordéon, pour l’autre de ses outils à jongler et rien d’autre, ils développent pendant une heure un hymne à la liberté de jouer, de créer, de dialoguer avec le public. Praticiens de l’improvisation, et donc d’une redoutable précision, ils font de chaque « concert jonglé », un spectacle unique. Pour Jérôme Thomas, ce duo prend place à côté de pièces plus écrites, ouvrant la possibilité d’exprimer en quelque sorte son jonglage de toujours, mais nourri de nouvelles expérimentations, du mime, de la danse, du clown...\r\rEquipe de création\rJérôme Thomas et Jean-François Baëz (interprètes), Bernard Revel (lumière), emmanuelle Grobet (costumes)\r\r- type de spectacle : fixe \r- accessibilité pour personnes handicapés : oui \r- disposition du public : frontal \r- espaces scéniques : théâtre, salle polyvalente, parcs et jardins \r- fiche technique : légère\r- oeuvre inscrite à la SACD : oui\r- artistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'MDB_069_9923413130', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Musique ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(55, 55, 'CmPa_043_6443285011', 2, 'DEUX HOMMES JONGLAIENT TETE (JEROME THOMAS)', 'DEUX HOMMES JONGLAIENT DANS LEUR TETE', 'Roland Auzet, Jérôme Thomas', '', '', 'Jérôme Thomas, Roland Auzet; Mathurin Bolze (regard extérieur)', 'Espace des Arts, scène nationale de Chalon-sur-Saône, co-production Act-Opus Compagnie Roland Auzet/ ARMO compagnie Jérôme Thomas', 0, 2, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rCe Duo a été créé en octobre 2008 à L’espace des Arts scène nationale de Chalon sur Saône, dont Roland Auzet est l’artiste associé. Sous les doigts du jongleur et du musicien, les instruments originaux construits par Robert Hébrard se mettent à vibrer dans un décor de miroirs qui renforcent l’image d’un cabinet de curiosité contemporain. Les deux artistes ont demandé à Mathurin Bolze de les accompagner dans cette création, ainsi qu’à Wilfried Wendling pour la musique éléctronique.\r\rEquipe de création\rRoland Auzet (musicien), Jérôme Thomas (jongleur), Wilfried Wendling (musique électronique "live"), Bernard Revel (lumière) assisté de Dominique Mercier-Balaz, Robert Hebrard (construction et conception des instruments) \r\rType de spectacle : fixe \rAccessibilité pour personnes handicapés : oui \rDisposition du public : frontal \rEspaces scéniques : théâtre \rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 3', '', '', '', '', '', '0000-00-00', 'MDB_069_9923443060', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(56, 56, 'CmPa_043_6443285011', 2, 'LIBELLULE PAPILLONS (JEROME THOMAS)', 'LIBELLULE ET PAPILLONS!', 'Pedro Pauwels, Jérôme Thomas', '', 'Pedro Pauwels', 'Jérome Thomas', 'Agnès Célérier; Co-production : La Passerelle, scène nationale de Gap et des Alpes du Sud; Le Hangar, Fabrique des Arts de la Rue, Amiens; ARMO - Cie Jérôme Thomas', 0, 3, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rFantaisie visuelle où se conjuguent délicatesse du geste et entrain des artistes, le spectacle avant de s’épanouir dans une atmosphère de conte s’ouvre par un solo de Jérôme Thomas chorégraphié par Pedro Pauwels. Libellule est une pièce dansée pour un homme et un sac. De l’informe naissent des formes évoquant minéral, végétal ou animal ?? À la fin, un corps, puis un visage, un homme debout, un homme doué d’imagination, un homme qui rêve… de Papillons !! Le spectateur glisse à sa suite dans un univers proche du merveilleux. Les Papillons mêlent manipulation, patinage acrobatique, acrobatie et pantomime. Les « Robes » construites par Emmanuelle Grobet sont des sortes d’agrès-costumes manipulables dont ils s’emparent pour jouer de toutes les transformations.\r\rEquipe de création\rIvan Roussel (son), Bernard Revel (lumière), Jérôme Thomas (direction artistique, interprète), Caroline Escafit, Jive Faury, Claude Hébrard, Kim Huynh, Bongo Maingi, Vincent Regnard, Aurélie Varrin (interprètes), Emmanuelle Grobet (costumes)\r\rType de spectacle : fixe \rAccessibilité pour personnes handicapés : oui \rDisposition du public : frontal \rEspaces scéniques : théâtre \rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 8\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9923466650', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rArts de la piste ; Danse ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(57, 57, 'CmPa_043_6443285011', 2, 'SORTILEGES (CIE JEROME THOMAS)', 'SORTILEGES', 'Jérôme Thomas, Agnès Célérier, Max Nagel', 'Max Nagel', '', 'Jérôme Thomas', 'Agnès Célérier- ARMO/Cie Jérôme Thomas, théâtre d''Ivry-Antoine Vitez, Cirque Théâtre d''Elbeuf, centre des arts du cirque de Haute-Normandie', 0, 2, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rSortilèges est une histoire pour les enfants, et l’histoire d’une enfant qui est en colère. Faire ses devoirs, elle ne veut pas, dormir, elle ne veut pas, mais rêver et jongler, elle veut bien. Justement, voilà que sa chambre et tout particulièrement son lit, s’animent, que les poupées deviennent acrobates, les personnages du livre de vrais guerriers, et que des corbeaux volent au dessus de sa tête… De fil en aiguille, d’un objet à l’autre, elle construit son imaginaire, rempart contre les peurs et échelle pour mieux grandir. Pour raconter cette histoire, se mêlent techniques de cirque, jonglage, manipulation d’objets, acrobatie, théâtre et musique.\r\rEquipe de création : Karen Bourre (artiste), Bongo Maingi (artiste), Emile Chaygneaud (artiste), Max Nagl (composition musicale), Emmanuelle Grobet (costumes, accessoires), Ivan Roussel (son), Romain Ratsimba (lumière)\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire \rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 3\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_9923574710', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(58, 58, 'CmPa_043_6443301150', 2, 'PEAU LAPIN (TOTORS)', 'PEAU DE LAPIN', 'Nicolas Dewynter', '', '', 'Claudie Dewynter', '', 0, 4, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rAprès la Petite Tuerie (solo de clown sanguinolant), Gédéon poursuit ses aventures... A nouveau seul, il se retrouve écrasé par une masse de questions. Il dérive, en quête de réponses, il s''invente son monde, ses amours, ses guerres, ses voisins, ses amis...comme un gosse perdu dans sa chambre Gédéon sait qu''on le regarde, et il n''hésite pas à chercher chez l''intrus l''ami qu''il réclame. On l''écoute penser tout haut, on rit et on a peur, on aimerait bien comprendre ce qui se passe dans sa tête, mais, il n''y a ni sens, ni direction... c''est le bazar. Le rire est une arme, il la retourne contre lui, et nous explose ses pensées au visage. \r\rEquipe de création: Nicolas Dewynter (auteur, interprète), Claudie dewynter (metteur en scène)\r\rType de spectacle : fixe \rLangue du spectacle : français\rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1\r\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10003396730', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(59, 59, 'CmPa_043_6443301150', 2, 'ADIEU VIEILLE CARNE (TOTORS)', 'ADIEU VIEILLE CARNE', 'Nicolas Dewynter', '', '', 'Nicolas Dewynter', '', 0, 4, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rCe titre qui sonne comme une épitaphe nous indique que oui oui nous voilà bel et bien dans un enterrement. Après le mariage de « Photo de famille », voici l’enterrement. Les rituels de la vie font partie des sujets préférés des totors. Autant « Photo de famille » donnait la parole aux invité de la noce autant là les acteurs sont muets. Nous sommes donc dans le pur burlesque. Un enterrement peut-il être burlesque ? Bien sûr... toute situation humaine peut l’être. Nous avons tous assisté à des enterrements où le burlesque venait se mêler à la tristesse et à la mort. Pas vous ? Moi oui et plusieurs fois mais c’est peut-être ma nature comique qui m’a permis de le voir, peut-être... \r\rEquipe de création\rNicolas Dewynter (auteur, metteur en scène, régie), Claudie Dewynter (interprète), Olivier Parolini (interprète, décor)\r\rType de spectacle : fixe \rLangue du spectacle : muet\rDisposition du public : frontal \rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins \rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10003401200', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(60, 60, 'CmPa_043_6443301150', 2, 'VOT''BON COEUR (TOTORS)', 'A VOT''BON COEUR', 'Nicolas Dewynter, Claudie Dewynter et Olivier Parolini', '', '', 'Nicolas Dewynter, Claudie Dewynter et Olivier Parolini', '', 0, 1, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rA vot'' bon coeur M''sieurs, Dames ! Entrez, entrez ! Et vous verrez ! Vous verrez des tas de trucs amoncelés, des bribes de souvenirs endommagés, des accessoires usagés poétisés, des clowns tourneboulés, un Cambouis cabossé, un Chochotte empesé et une Mémé la vieille à roulettes. C''est comme entrer dans le train fantôme, en mieux ! C''est une exposition sans guide, c''est du théâtre sans scène, c''est un musée totoresque où la caravane ne passe pas, où les chiens n''aboient pas, mais où les clowns chantent.\r\rEquipe de création\rNicolas Dewynter(interprète, metteur en scène), Claudie Dewynter (interprète, metteur en scène) et Olivier Parolini (décor et interprète)\r\rType de spectacle : fixe \rLangue du spectacle : français \rDisposition du public : spectateurs debouts \rEspaces scéniques : chapiteau, salle polyvalente, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10003409820', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(61, 61, 'CmPa_043_6443296171', 2, 'TOUS EGO (GLOMERIS)', 'TOUS EGO', 'Glomeris Compagnie!', '', '', '', 'Glomeris Compagnie!', 0, 5, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Type de spectacle : fixe \rDisposition du public : frontal \rEspaces scéniques : théâtre, salle polyvalente, bars, restaurants \rFiche technique : légère \rArtistes sous contrat : -', '', '', '', '', '', '0000-00-00', 'Serv_069_10051108660', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre d\\''humour / café-théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(62, 62, 'MDB_043_9880465270', 2, 'TOUT FOU LE CAMP (PIECE MAIN OEUVRE)', 'TOUT FOU LE CAMP (PIECE MAIN OEUVRE)', '', '', '', '', '', 0, 1, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', '', '', '', '', '', '', '0000-00-00', 'Serv_069_10051121700', '', '', '', '', '', '', '\rSpectacle théâtral', '\r', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte');
INSERT INTO `oeuvres_oeuvres` (`id`, `user_id`, `ficheliee_id`, `type_id`, `nom_usuel`, `nom_complet`, `auteur`, `compositeur`, `choregraphe`, `metteurenscene`, `producteur`, `duree`, `prix`, `jauge`, `anneecreation`, `hauteurminimale`, `profondeurminimale`, `ouvertureminimale`, `disponibilitespectacle`, `projetencours`, `interprete`, `distributeur`, `scenariste`, `realisateur`, `editeurmusical`, `labels`, `co_auteur`, `traducteur`, `illustrateur`, `isbn`, `gencod`, `nomcollection`, `lieuedition`, `reedition`, `leformat`, `nombrepage`, `numdewey`, `anneeedition`, `titreorigine`, `auteur_origine`, `co_auteur_origine`, `editeur_origine`, `langueorigine`, `languetraduite`, `annee1erpublication`, `code_operateur`, `nom_operateur`, `commentaires`, `commentaires_arts_visuels`, `commentaires_audio_visuel`, `commentaires_livre`, `commentaires_patrimoine`, `commentaires_spectacle`, `date_actualisation`, `id_fiche`, `mot_passe`, `questionnaires`, `nom_prenom_destinataire`, `e_mail_destinataire`, `fonction_titre`, `liste_des_contacts`, `activites`, `genres`, `disciplines`, `localisations`, `precision_activites`, `type_public`, `support`, `rayonnement`, `distinction`, `index_complementaire`) VALUES
(63, 63, 'CmPa_043_6443296790', 2, 'TIGRE DANS CRANE (TURLUPIN)', 'UN TIGRE DANS LE CRÂNE', 'Texte de Karin SERRES', 'Joël PATIN', '', 'Nathalie AZAM et Elvire IENCIU', '', 0, 4, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\r"Yellow Banane, balayeuse de gare, est tranquillement en train d''écrire. Jusque-là, rien d''étonnant. Sauf qu''à l''instant où elle écrit "tigr...." un gros tigre du Bengale jaillit de la feuille et s''installe sans crier gare à l''intérieur de son crâne. S''ensuit une cohabitation entre ce félin envahissant et son hôtesse qui se rebelle.\rGuib, le petit voisin, ne peut croire à cette histoire, de leurs dialogues naîtra un voyage extraordinaire dans l''imaginaire.\rKarin Serres laisse vagabonder son écriture poétique et imaginative dans un texte où les personnages les plus loufoques se côtoient.\r\rEquipe de création : Jean-Jacques IGNART (Eclairage), Joël PATIN (Son), Nina PATIN et Charlotte DENAMUR (Vidéo), Charlotte Paspajou (Costumes)\r\rType de spectacle : création - fixe \rDisposition du public : frontal\rEspaces scéniques : théâtre\rArtistes sous contrat : 3\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10074639200', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(64, 64, 'CmPa_043_6443296790', 2, 'CELLES QUI SAVAIENT (TURLUPIN)', 'CELLES QUI SAVAIENT...', 'Texte de Claude PUJADE RENAUD', 'Vincent LEBEGUE', 'Téo FDIDA', 'Elvire IENCIU', '', 0, 4, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Equipe de création\rJean-Jacques IGNART (Eclairage), Joël PATIN (Son), Nina PATIN et Charlotte DENAMUR (Vidéo), Charlotte Paspajou (Costumes)\r\rType de spectacle : fixe \rDisposition du public : frontal\rEspaces scéniques : théâtre\rArtistes sous contrat : 3\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10074659900', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(65, 65, 'CmPa_043_6443301050', 2, 'CHAMEAU (JAUNE CHAMEAU)', 'LE CHAMEAU', 'Rainette GONET', '', '', 'Rainette GONET', '', 0, 0, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rRegardez ! Voilà l''Chameau du Théâtre Jaune Chameau ! Un animal en bois de plus de deux mètres de hauteur qui déambule en musique dans les rues. Le Voilà qui s''arrête ! Et sur son dos apparaissent ... Les marionnettes !\r\rEquipe de création\rRainette Gonet\r\rType de spectacle : spectacle de rue\rEspaces scéniques : rue\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'Serv_069_10074862840', '', '', '', '', '', '', '\rSpectacle des arts de la rue ; Spectacle théâtral', '\rArts de la rue', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(66, 66, 'CmPa_043_6443301050', 2, 'TOUT S''DEMONTE TOUT S''PLIE (JAUNE CHAMEAU)', 'TOUT S''DEMONTE TOUT S''PLIE', 'Rainette GONET', 'Stephen DAVIS', '', '', 'Théâtre Jaune Chameau', 0, 5, 0, '', 3, 3, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rC''est un conte météorologique, c''est l''histoire d''une tempête, un rêve sur la connaissance, un spectacle qui parle d''hospitalité...\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : -\rArtistes sous contrat : 2\rEquipe de création : Rainette Gonet\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10074869210', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(67, 67, 'CmPa_043_6443301050', 2, 'OEUF EN CRAIE (JAUNE CHAMEAU)', 'L''OEUF EN CRAIE', 'Texte d''Alain GERARD', 'Eric CHAPELLE', '', 'Rainette GONET', 'Théâtre Jaune Chameau', 0, 5, 0, '', 3, 5, 4, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn voyage, un tour du monde poétique, a bord d''un carroussel, où les anges tombent du ciel, où l''on se voit dans les yeux d''un chien.\rA travers les poèmes d''Alain Gérard, "Face au silence" d''Eric Chapelle Trio : guitare, clavier, batterie, percussion, flûte et contrebasse. \rSpectacle de marionnettes à fils, conçu et réalise par le Théâtre Jaune Chameau.\r\rEquipe de création\rRainette Gonet (Marionettes, mise en scène et jeu), Alain Gérard (Texte), Eric Chapelle (musique), Sylvain Jouanin (Eclairage)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : -\rArtistes sous contrat : -\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10076785110', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(68, 68, 'CmPa_043_6443301050', 2, 'ENFANT ELEPHANT (JAUNE CHAMEAU)', 'L''ENFANT D''ELEPHANT', 'D’après un conte de RUDYARD KIPLING', '', '', 'Rainette GONET', 'Théâtre Jaune Chameau', 0, 0, 0, '2012', 3, 3, 4, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rEt depuis ce jour, tous les éléphants que tu verras ainsi que ceux que tu ne verras pas portent une trompe exactement semblable à la trompe de l''insatiable enfant d''éléphant...\rD’après un conte de RUDYARD KIPLING\r\rEquipe de création\rRainette Gonet (Marionettes, mise en scène et jeu)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : -\rArtistes sous contrat : 1\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10076798710', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(69, 69, 'CmPa_043_6443301050', 2, 'ENFANT SORTILEGES (JAUNE CHAMEAU)', 'L''ENFANT ET LES SORTILEGES', 'd''après la pièce de COLETTE', '', '', 'Rainette GONET et Din BARNETT', 'Théâtre Jaune Chameau', 0, 0, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rC''est un enfant terrible...Il casse tout dans la maison. Il ne veut pas faire ses devoirs. Il dit qu''il est très méchant. Et voilà les objets qui se révoltent contre lui. Le fauteuil ne veut plus que l''enfant s''assoit sur lui. La pendule se lamente et ne veut plus donner l''heure. La princesse merveilleuse sort du livre déchiré...Pensant échapper à leurs reproches, l''enfant se réfugie dans le jardin, mais là ce sont les arbres qui se plaignent de lui, les animaux, les insectes.\rAprès une nuit magique passée entre la lune et la marre aux grenouilles, l''Enfant réalise qu''il ne peut pas vivre détesté de tous...Alors le jardin tout entier le ramène à la maison où, dans les bras de Maman, il comprend qu''il est devenu sage, si sage...\r\rEquipe de création\rRainette Gonet et Din Barnett (Adaptation et mise en scène), Jeanne Morel Costumes), Franck Zippo (Eclairages), Décor du jardin d''apèrs un dessin d''Alain Gérard\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : -\rArtistes sous contrat : -', '', '', '', '', '', '0000-00-00', 'MDB_069_10076815870', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(70, 70, 'CmPa_043_6443301050', 2, 'PETIT POUCET (JAUNE CHAMEAU)', 'LE PETIT POUCET', 'D''après le conte de Charles Perrault', '', '', 'Rainette GONET', 'Théâtre Jaune Chameau', 0, 0, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLe Petit Poucet est un spectacle de marionnettes à fils, tiré du conte de Charles Perrault. Présentation traditionelle dans les marionnettes comme dans les décors.\rIl comprend sur une durée de 40 minutes : 8 scènes différents, 3 décors fixes, 1 décor mobile représentant la forêt et toute la promenade des enfants jusqu''au château du roi.\rLes musiques : Génésis et Haendel\rLe texte : volontairement très près de celui de l''auteur. Les tournures de phrase et le vocabulaire du XVIIème siècle ont été conservés, ce qui lui confère un charme supplémentaire.\rSi le jeune spectateur ne comprend pas tous les mots, il est capté par le jeu des marionnettes et le conte, tandis que les parents profitent des "piques" de l''auteur et du travail de création.\r\rEquipe de création : Rainette Gonet\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : -\rArtistes sous contrat : 1\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10076829360', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(71, 71, 'CmPa_043_6443301050', 2, 'MAROTTE RAPEE (JAUNE CHAMEAU)', 'MAROTTE RAPEE', 'Rainette GONET', '', '', 'Rainette GONET', 'Théâtre Jaune Chameau', 0, 5, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rCe spectacle raconte l''initiation sentimentale et sexuelle d''une petite femme sauvage...\rZoa est une petite femme sauvage. Elle vit nue, dans la région la plus obscure de ses rêves...\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : Café-théâtres, bars, Night-club, soirées privées\rArtistes sous contrat : 2\rEquipe de création : Rainette GONET (texte, marionettes et décors), Franck ZIPPO (Eclairages)\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10076838440', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(72, 72, 'CmPa_043_6443301011', 2, 'SORS DE LA (THEATRE BULLES)', 'SORS DE LA!', 'Chantal LOUIS', 'Michaël SANTOS', '', 'Chantal LOUIS', '', 0, 0, 0, '2009', 3, 7, 8, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rGrandir n''est pas facile ! Un spectacle initiatique où les langues se taisent et les corps parlent ... de l''origine, du cycle de la vie, au rythme d''une musique faite de chuchotements, de claquements de langue, qui les guide, les entraîne dans un parcours, pas toujours simple. Voyage dans le temps du corps... naissance, marche, propreté, partage,\rchagrin, conflit, jeux...Grandir, c''est renoncer ! à sa tétine, son doudou, sa couche … Grandir, c''est tenter ses propres expériences ! sous le regard de l''adulte, autorité bienveillante,rassurante, mais parfois frustrante. Apprendre, pour pouvoir transmettre...\r\rType de spectacle : fixe\rDisposition du public : frontal\rArtistes sous contrat : 2\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10076937980', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(73, 73, 'CmPa_043_6443296790', 2, 'LABO RIRES (TURLUPIN)', 'LE LABO RIRES', 'Elvire IENCIU', '', '', 'Elvire IENCIU', '', 0, 4, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\r"L''homme est le seul animal doué du rire...". Deux éminentes professeurs vous invitent dans leur petit labo pour vous faire part de leur dernières avancées dans le domaine du rire : qu''est ce que l''humour? Comment déclenche t''on le rire? Quelles sont ses fonctions : sociales, poétiques, philosophiques catharsis tiques (!), littéraires? Comment le sourire porte-t-il le rire? Qu''est-ce qui en pince? Quand est-ce qu''il grince? Les Turlupins vous proposent une conférence détonante, où vous vivrez une expérience unique de grande loufoquerie, agrémentée de calembours, petites annonces, citations, poèmes et nouvelles...Attention contagion possible! Dérision assurée! Et jeux de mots désopilants... Nous déclinons toute responsabilité en cas de décrochés de mâchoires\r\rType de spectacle : fixe\rDisposition du public : frontal ou demi-circulaire\rEspaces scéniques : théâtre, salles polyvalentes, bibliothèques\rArtistes sous contrat : 2\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10076950460', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(74, 74, 'CmPa_043_6443296790', 2, 'RUMEURS (TURLUPIN)', 'RUMEURS', 'Elvire IENCIU', '', '', 'Elvire IENCIU', '', 0, 4, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLa ville : ça grouille, ça se bouscule et ça empile. De tous ces uns qui font ce tout, nous dresserons un étal des portraits de la cité.\r"Entrez dans notre petite boutique! Du grand choix, faites votre marché : \r- promotion de petits et grands imbéciles, \r- bouquets de naïveté, \r- paniers de solitudes, \r- tranches de quartiers, \r- cagettes de p''tits métiers, du chargé d''com au fromager, \r- sacs d''agitateurs, \r- portants de paroles, \r- coffrets d''images et d''espaces..."\r\rType de spectacle : fixe\rDisposition du public : frontal ou demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, bibliothèques\rArtistes sous contrat : 3 \rAutre : version jeune public (35 mn) composée d''extraits de textes d''Alain Serre\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10076970670', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(75, 75, 'CmPa_043_6443296790', 2, 'LOUP (TURLUPIN)', 'LE LOUP', 'D''après des auteurs de littérature jeunesse contemporains', '', '', 'Elvire IENCIU et Philippe JOURNO', '', 0, 5, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation \r"Encore une histoire qui commence par la Faim!" " J''en profite ça fait longtemps que j''ai des trucs à te dire : aberration de la nature, dégonflé du cerveau, hématome, fiente de la forêt, ypomeute..."\rExtraits de "Faim de Loup" d''Eric PINTUS et Rémi JAILLARD. Une rencontre incongrue entre un loup et un lapin.\rLe loup : une brute simple d''esprit, un rustre disait Henri Gougaud.\rSinon Dindon de la farce, le loup n''est pas seulement ce monstre effrayant qui peuple les légendes...\r\rType de spectacle : fixe - reprise\rDisposition du public : frontal ou demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, bibliothèques\rArtistes sous contrat : 2\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10076993630', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(76, 76, 'CmPa_043_6443296790', 2, 'COURSE OU VIE (TURLUPIN)', 'LA COURSE OU LA VIE', 'Elvire IENCIU', '', '', 'Elvire IENCIU et Anne-Gaëlle JOURDAIN', '', 0, 5, 0, '2013', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLa course ou la vie ? Deux femmes affairées galopent toute la semaine, et pour se détendre courent le dimanche matin. Elles vous invitent à les suivre dans leurs tourbillons littéraires, poétiques, ou humoristiques, en quête d''instants suspendus, entre des pages à tourner... L''existence ne manquera pas de dérégler leurs chronos, et remplira alors le vide des feuilles blanches...\r\rType de spectacle : fixe\rDisposition du public : frontal ou demi-circulaire\rEspaces scéniques : salle polyvalente, bibliothèques\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'MDB_069_10077015640', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(77, 77, 'CmPa_043_6443298161', 2, 'JEAN LA CHANCE (JEAN-LOUIS HOURDIN)', 'JEAN LA CHANCE', 'Texte français de Marielle SILHOUETTE et Bernard BANOUN', 'Karine QUINTANA', 'Cécile BON', 'Jean-Louis HOURDIN', 'Co production GRAT- Jean-Louis HOURDIN, Théâtre Dijon Bourgogne, Théâtre National de Strasbourg, avec la participation artistique du Jeune Théâtre National', 0, 0, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\r« Jean la Chance » de Bertolt Brecht : Un road movie\rCela arrive rarement : l’état d’amour, intégral pour une œuvre. Lorsque j’ai lu la pièce : le désir immédiat de la monter ;\rComme pour « Woyzeck » de Georges Büchner. Comme pour les sketches de Karl Valentin et ce n’est sans doute pas un hasard, cette trilogie amoureuse. Et tant d’autres…Comment se faisait-il que les amoureux de théâtre ne la connaissent pas, ou si peu. Il me fallait, sans délai, que nous partagions ce poème.\rUne œuvre à la fois savante et populaire, tragique et farcesque. Maillon inouï entre les premières pièces et les grandes œuvres de la maturité, où s’élabore le système Brecht.\rAussi, plein de surprise devant le reniement de Bertolt Brecht sur ce poème ; il fallait s’y frotter, tout de, suite, le temps de trouver les moyens de production pour le monter en « grand ».\r\rEquipe de création : Julien Barret/David Casada/Priscille Cuche/Jean Marie Frin/Paul Fructus/Mary Léaument/Laurent Meininger/Julie Palmier, Karine Quintana, Stéphane Gueydan et Nathalie Goutailler.\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre\rArtistes sous contrat :\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10081092350', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(78, 78, 'CmPa_043_6443298161', 2, 'COUPS FOUDRE (JEAN-LOUIS HOURDIN)', 'COUPS DE FOUDRE', 'Michel DEUTSCH et Frantz FANON - Le texte de clôture est extrait de « Peau noire, masques blancs » de Frantz Fanon, publié par les Editions Points', 'Karine QUINTANA', '', 'Jean-Louis HOURDIN', '', 0, 0, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUne petite troupe d‘acteurs et de musiciens - un petit peuple - raconte le parcours d’un homme à la recherche d’une nouvelle pensée. Face à la catastrophe en cours, aux désillusions frappant les utopies fraternelles du XXe siècle, l’homme dénonce les reniements de la République et appelle au développement harmonieux d’un « tous ensemble ». Ecrit il y a vingt ans, le texte de Deutsch est une grande imprécation dénonçant l’erreur que l’Occident perpétue en poussant au bout un capitalisme sauvage, terrible. En contrepoint, le cri de Fanon n’oublie rien des horreurs de la colonisation, mais ne réclame pas vengeance : il tente une façon nouvelle de parler de l’homme. Ainsi s’agit-il, le temps d’une veillée théâtrale, de convoquer la communauté à partager en musique la recherche d’une pensée nouvelle pour un vivre ensemble libéré de la prétendue fatalité du plus fort.\r\rEquipe de création\rJean-Louis Hourdin comédien, Karine Quintana musicienne (accordéon), chanteuse, compositrice, Sylvain Hartwick musicien (guitare), chanteur, Priscille Cuche comédienne, chanteuse, Sarah Taradach comédienne, chanteuse, Anthony Moreau comédien, chanteur, Frédéric Plazy comédien, chanteur, Cédric Djédjé comédien.\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre\rArtistes sous contrat : 8 comédiens, 1 technicien\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10081114810', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(79, 79, 'CmPa_043_6443298161', 2, 'CLARISSE MEHDI AUTRES (JEAN-LOUIS HOURDIN)', 'CLARISSE, MEHDI ET LES AUTRES', 'Texte de David DUMORTIER', '', '', 'Jean-Louis HOURDIN', 'Coproduction GRAT – Cie Jean-Louis Hourdin, Théâtre National Populaire – Villeurbanne\r', 0, 0, 0, '', 0, 6, 7, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn spectacle pour jeune public, difficulté suprême ! Pour la première fois la Compagnie s’y essaie. Charme inouï. L’écriture de David Dumortier n’est pas infantile, notre jeu essaiera de ne pas s’adresser qu’aux enfants consommateurs de spectacles dits « pour eux ». Non ensemble nous parlons de la souffrance. Oui, à sept, huit ans la vie est dure. Et c’est pas rigolo. Le sérieux avec lequel les petits êtres humains de Dumortier nous expliquent leurs douleurs et leurs joies nous font rire et pleurer et surtout si les petits spectateurs riront souvent dans le spectacle, les petits adultes que nous sommes se souviendront et pleureront doucement en tenant dans leurs bras leurs enfants\rSpectacle pour le jeune public à partir de 10 ans et pour les grands.\r\rEquipe de création\rPriscille Cuche, Stéphane Delbassé, Natalie Royer\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10081120870', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(80, 80, 'CmPa_043_6443298161', 2, 'VEILLONS ARMONS NOUS...(JEAN-LOUIS HOURDIN)', 'VEILLONS ET ARMONS NOUS EN PENSEE', 'A partir des textes : Le Messager Hessois de Georg Büchner, Le Manifeste du Parti Communiste de Karl Marx et Friedrich Engels, Le Manifeste de Bertold Brecht, des textes de l’A.G.C.S. et chansons', '', '', 'Jean Louis HOURDIN et François CHATTOT', 'Co-production Théâtre National de Chaillot, GRAT/Cie Jean Louis Hourdin, Théâtre Vidy-\rLausanne E.T.E.', 0, 0, 0, '', 4, 10, 0, 'Non', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLe monde est foutu, la vie est intacte.\rThéâtre et monde : Buchner, Marx, Engels, Brecht\rNous nous sommes emparés de leurs textes avec appétit, gourmandise. Et nous y ajoutons des chansons, des sketches, et des bribes de ces accords « iniques » qui vont tuer le monde les années qui viennent : L’A.G.C.S. Pour faire un poème d’aujourd’hui : joyeux et terrible, sous le regard de nos morts et pour que nos enfants puissent dire que nous avons travaillé\rsérieusement. Le monde change, radicalement ; comme jamais dans l’histoire. Nous le savions, mais nous n’y croyions pas. C’est là. Nous sommes entourés d’assassins. Nous ne pouvons plus continuer le geste théâtral comme nous l’avons fait jusqu’ici. Il nous faut inventer ; et inventer, « c’est penser à côté » (Einstein)\r« Mais pourquoi avoir peur de l’inconnu puisque c’est nous qui allons le créer » (Laurent)\r\rEquipe de création : Jean-Louis HOURDIN et François CHATTOT\r\rType de spectacle : fixe\rDisposition du public : Public sur les 4 côtés autour de l’espace de jeu matérialisé par une toile au sol de 7m x 4m.\rLes bancs sont à 2m de la toile.\rEspaces scéniques : théâtre\rArtistes sous contrat : 2\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10081146120', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(81, 81, 'CmPa_043_6443298161', 2, 'JE SUIS EN COLERE RIRE (JEAN-LOUIS HOURDIN)', 'JE SUIS EN COLERE MAIS CA ME FAIT RIRE', 'Eugène DURIF, Jean Yves PICQ, Jean Pierre SIMEON', 'Marie Claire DUPUY , Stéphanne GUEYDAN, Karine QUINTANA', '', 'Jean-Louis HOURDIN', '', 0, 0, 0, '', 0, 0, 0, 'Non', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rEn ces temps peu chaleureux, le théâtre sera peut-être cette possible tendresse : se prendre ensemble dans les bras pendant le temps de la représentation, et d’essayer de se consoler un moment, inconsolables que nous sommes.\rIl s’agirait d’un cabaret poétique et politique, gai et joyeux sur l’état de notre terrible monde. Le « milieu culturel » a toujours méprisé les formes populaires qu’il décréta « mineures ».\r\rEquipe de création\rComédiens : Eloïse Brunet, Priscille Cuche, Paul Fructus, Pierre Henri, Julie Kpéré, Laurent Meineinger;\rCostumes : Cissou Wiling\r\rType de spectacle : Cabaret fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre\rArtistes sous contrat : \r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10081153510', '', '', '', '', '', '', '\rSpectacle théâtral', '\rMusique', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(82, 82, 'CmPa_043_6443298161', 2, 'WOYZECK (JEAN-LOUIS HOURDIN)', 'WOYZECK', 'De Georg BUCHNER', '', 'Olivier GELPE', 'Jean-Louis HOURDIN', '', 0, 0, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUne troupe de théâtre avec un orchestre forain et sur le plateau un chef de troupe : le bonimenteur de la pièce de G. Buchner. Nous commencerions par la scène de la foire, Woyzeck serait « le singe qui devient soldat, qui devient baron… ». Le théâtre dans le théâtre. Les débuts du monde.\rUn cirque onirique (Beckett, Lola Montès de Max Ophuls)\rUn humain qui se défait, jouet-cobaye entre les mains du monde, et sur qui pèse non seulement l’oppression sociale, mais une sorte de fatalité biblique métaphysique. C’est tout l’ordre du monde qui le menace, l’écrase et loge en lui, dans sa tête, dans son corps, instant par instant et le ruine, alors qu’il essaie de comprendre le monde désespérément.\rJ’aimerais régler ce spectacle comme une sorte de cérémonial forain et tragique, un drame populaire avec musique.\r\rEquipe de création : Daniel Briquet, Eloïse Brunet, Arlette Chosson, Priscille Cuche, Agnès Duvivier, Julien Flament, Paul Fructus, Pierre Henri, Valérie LArroque, Richard Mitou, Guillaume Perrot, Alain Poisot, Florian Vidgrain, Victor Zucchini, Daniel Pasquier\rChorégraphie Olivier GELPE, costumes Régina MARTINO assistée de Rose-Marie SERVENAY, accessoires Nathanaelle LOBJOY, régie Générale Jean Pierre DOS, régie Plateau Jean Michel BRUNETTI, construction du décor Eric THEVENET, administration Mireille BRUNET\r\rType de spectacle : fixe - Drame populaire avec musique\rDisposition du public : frontal\rEspaces scéniques : théâtre\r\r\r', '', '', '', '', '', '2012-10-11', 'MDB_069_10081157630', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(83, 83, 'MDB_043_10076855280', 2, 'NOUS LE THE (SOPHIE DE MEYRAC)', 'NOUS LE THE', 'Sophie De Meyrac', '', '', 'Sophie De Meyrac', '', 0, 5, 0, '1998', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn pas pour passer le portique d''entrée, on pénètre dans le jardin du Maître du thé. Avec ses histoires, c''est tout un monde qui se déploie. Mais toi qui écoutes les histoires, où sont tes oreilles? Est-ce qu''elles bougent avec l''histoire? L''esprit avec lequel on goûte le thé, que peut-on en dire?\rDe conte en conte, comme les pierres dans le jardin dessinent le chemin, se déploie l''univers du thé..avec quelques koans, quelques haïkus, histoire d''être dépaysé!Type de spectacle : fixe, ou performance (possibilité de faire une cérémonie de thé, ou une dégustation de thés)\r\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10081270770', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Conte', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(84, 84, 'MDB_043_10076855280', 2, 'GUESAR (SOPHIE DE MEYRAC)', 'GUESAR ROI DE LING', 'Sophie DE MEYRAC', '', '', 'Sophie DE MEYRAC', '', 0, 5, 0, '2001', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rGuésar est un dieu-héros venu sur terre pour combattre les démons et délivrerle pays de ce joug terrifiant. Cette épopée est la plus longue du monde. Transmise oralement depuis des siècles, elle est chantée par ses bardes et encore aujourd''hui, chacun est spécialisé dans un épisode de ce récit fondateur. Cette épopée fondamentale dans la tradition tibétaine présente des valeurs universelles où le merveilleux côtoie le réalisme. Sophie DE MEYRAC raconte la création du monde, la naissance du héros, la course de chevaux ou le combat contre Lutsen, le plus féroce des démons\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardin\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10081287740', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Conte', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(85, 85, 'MDB_043_10076855280', 2, 'SUR TOIT MONDE (SOPHIE DE MEYRAC)', 'SUR LE TOIT DU MONDE', 'Sophie DE MEYRAC', '', '', 'Sophie DE MEYRAC', '', 0, 5, 0, '2001', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation \rContes et légendes du Tibet et de l''Himalaya, où l''on voit des animaux devenir bouddha grâce à leur courage, un fils découvre que sa mère est la reine des sorcières, comment une filel échappe à l''ogre, comment une vache crée un pays, comment on dveint fée...\rHistoires de yogis, fables d''animaux, contes populaires, vies antérieures de Bouddha, histoires d''amour et de sorcières, fées magiques, anecdotes de maîtres tibétains.\r\rType de spectacle : fixe ou déambulatoire\rdisposition du public : frontal ou demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, rue, parcs et jardins\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10081298400', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Conte', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(86, 86, 'MDB_043_10076855280', 2, 'CONTES CHAMBRE THE (SOPHIE DE MEYRAC)', 'CONTES DE LA CHAMBRE DE THE', 'Sophie DE MEYRAC', '', '', 'Sophie DE MEYRAC', '', 0, 5, 0, '2001', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rIl existe des centaines de thés liés à un lieu et une légende. Les noms de thés chnois révèlent des histoires étonnantes et fabuleuses qui évoquent la Chine taoïste d''autrefois, la Chien rêvée, celle des poètes, des voyageurs et des philosophes qui demeurent. Venez découvrir comment Spirale de Jade du Printemps sauve son amoureux des griffes du monstre, le Puits-du-Dragon, le thé de la déesse de compassion, Brume de nuage, comment le moine rencontre un immortel, le thé des phénix, et mille autres histoires éternelles.\r\rType de spectacle : fixe, déambulatoire et performance avec cérémonie de thé chnoise\rDisposition du public : frontal, demi circulaire\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10081326800', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Conte', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(87, 87, 'MDB_043_10076855280', 2, 'ROBES PLUMES (SOPHIE DE MEYRAC)', 'ROBES DE PLUMES', 'Sophie DE MEYRAC', '', '', 'Sophie DE MEYRAC', '', 0, 4, 0, '2011', 0, 0, 0, 'Non', 'Oui', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rFemmes qui deviennent oiseau, ou déesse, elles portent la robe à plumes qu rend immortellle...Quelques contes, d''ici et d''Asie, pour un voyage enchanteur.\rDes déesses descendues de la lune, une robe volée...un chevalier amoureux d''un cygne, femme ensorcelée, une fille enlevée par un cheval qui la veut pour épouse...Comment le marchand et celle qu''il aime échappent à l''ogresse...deux phénix qui jouent avec le voyageur...\rCes ont des femmes qui traversent la mort, l''abandon, la violence parfois. A travers la métamorphose, parviendront-elles à vaincre le destin?\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins\r\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10081335050', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Conte', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(88, 88, 'BO21_043_8124333250', 2, 'CITADELLE CIBOULETTE (CIE BEAU CHAOS)', 'CITADELLE ET CIBOULETTE', 'Fanny Lebert et Geneviève Reynouard', '', '', 'Fanny Lebert et Geneviève Reynouard', '', 0, 4, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rCitadelle et Ciboulette, deux soeurs, jolis personnages colorés, un peu décalés, vivant dans un monde enchanteur et presque parfait ; mais toutes belles qu’elles soient, les deux jeunes filles ont un petit quelque chose qui ne va pas ; alors, elles se sentent observées, montrées du doigt, pas assez ceci ou trop cela…\r\rEquipe de création\rFanny Lebert, Genevieve Reynouard (Écriture, mise en scène, interprétation),Christophe Pierron, Julien Grandemange (régie technique, création sons et lumière), Mireille Reynouard, Renée Masson (costumes), Anne-Marie François (marionnette), Nathalie Turpin (décors et accessoires), Sabine Clairet (toile peinte), Oriane Varack (masque)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : non\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10217395310', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(89, 89, 'CmPa_043_6443295702', 2, 'MALHEUR SOPHIE (CIE ARTIFICE)', 'UN MALHEUR DE SOPHIE', 'Extrait de la Comtesse de Ségur, publié en 1858. Editions Pauvert', '', '', 'Christian Duchange', '', 0, 5, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rAu bord du monde adulte, dans la solitude de l’enfance, Sophie n’a écouté que ses impulsions devant le bocal des poissons de sa maman. Ce texte, qui parle si bien de l’enfance aux enfants, est porté ici par une comédienne fidèle au texte original. Comme si, devenue adulte, elle revenait sur les lieux de son enfance, pour nous raconter un de ses voyages au-delà des frontières du raisonnable, en réalisant devant nous, dans la précision de son récit, la cruauté de ses actes.\r\rEquipe de création \rMise en scène / Christian Duchange (mise en scène), Anne Cuisenier (interprète), Alice Duchange (Scénographie et costume), Béatrice Billard (visuel)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle de classe, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : non\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10217412750', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(90, 90, 'BO21_043_8124333250', 2, 'LE PEUPLE DU GRENIER (CIE BEAU CHAOS)', 'LE PEUPLE DU GRENIER', 'Fanny Lebert, Geneviève Reynouard', '', '', 'Fanny Lebert, Geneviève Reynouard', '', 0, 4, 0, '', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', 'Geneviève Reynouard', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rChut!!! pas un mot, juste du Gromlo...\rDes bruits et des vocalises\rCachés tout au fond de la valise...\rDans ce décor poussiéreux; 2 petits personnages heureux invitent les enfants et les plus grands\rA partager les trésors insoupçonnés cachés dans le grenier.\r\rLe Peuple du Grenier est un périple poétique où les histoires se dansent, se chantent, s''inventent et s''évaporent au gré des objets dénichés.\r\rEquipe de création\rChristope Pierron (régie générale), Fanny Lebert (auteur, metteur en scène, interprète), Geneviève Reynouard (auteur, metteur en scène, interprète)\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins\rFiche technique: légère\rSACD : non\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10096266160', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(91, 91, 'BO21_043_8124356731', 2, 'VOYAGE DE NOCES (CIE BLEUS TRAVAIL)', 'LE VOYAGE DE NOCES', 'Alexandre Demay, Sylvain Granjon', '', '', 'Alexandre Demay, Sylvain Granjon', '', 0, 1, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rMarcel et Raymonde sont prêts pour partir en voyage de noce !! Mais leur vieille Fiat 500 tombe en panne. Ce voyage va se transformer en un véritable parcours initiatique ! En une heure ils affronteront un nombre incalculable d’épreuve, à suivre! ..\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : rue, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_10096459440', '', '', '', '', '', '', '\rSpectacle des arts de la rue ; Spectacle théâtral', '\rArts de la rue', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(92, 92, 'CmPa_043_6443301150', 2, 'LES YEUX PLUS GROS QUE LE VENTRE (TOTORS)', 'LES YEUX PLUS GROS QUE LE VENTRE', 'Nicolas Dewynter', '', '', 'Claudie Dewynter', '', 0, 0, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rIl était une fois deux loups, Fiodor et Raspoutine, deux loups au chômage. Plus rien à bouffer. "C''est peut-être le moment de devenir végétarien", dit Fiodor. Mais pour Raspoutine, pas question de se nourrir de baies et de champignons. Bien sûr c''est l''hiver et il neige et chaque fois qu''ils ouvrent la porte, la neige s''engouffre dans leur cabane, "Home sweet home", délicieusement entretenue par Fiodor. Raspoutine se décide à partir pour la quête du gras. il rêve de cochon, de jambon, de saucisson. Raspoutine quitte donc la cabane avec son grand couteau et Fiodor l''attend... Comment survivre quand on est loup, affamé et carnivore? Comment sauver la fraternité quand on est dans les ennuis? et la neige qui continue à tomber!\rLa poisse quoi! "et si on invitait des enfants????"\r\rEquipe de création\rNicolas Dewynter (clown, comédien), Olivier Parolini (clown, comédien, décorateur), Claudie Dewynter (metteuse en scène)\r\rType de spectacle : fixe\rLangue du spectacle : français\rDisposition du public : frontal\rEspaces scéniques : parc, square, jardin, bois\rFiche technique : moyennement lourde\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_10098361120', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(93, 93, 'ADBO_043_8735420360', 2, 'ROSIE ROSE (CIE OPOPOP)', 'ROSIE ROSE', 'Karen Bourre, Julien Lanaud', '', '', 'Karen Bourre, Julien Lanaud', '', 0, 4, 0, '2011', 3, 5, 6, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\r"Rosie Rose" est un spectacle un peu kitsch et plein d''humour mêlant jongleries, magie et bricoles d''environ 45 min. et destiné à tous à partir de 4 ans.\r\rEquipe de création\rKaren Bourre (jongleuse), Julien Lanaud (régie générale, plateau son lumière)\r\rType de spectacle : fixe\rAccessibilité du spectacle pour personnes handicapées : oui\rDisposition du public : frontal\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, écoles\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_10098395700', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(94, 94, 'MDB_043_9372771820', 2, 'MOI JOSEPHINA (CIE FLYING FISH)', 'MOI JOSEPHINA', 'Miriam De Sela', '', '', 'Miriam De Sela', '', 0, 4, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rMiriam De Sela (interprète); Andreas Tapia-Fernandez, Sky De Sela et Joel Colas (regard extérieur); Fary (costumes)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : structures itinérantes, salles polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'Serv_069_10098408590', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(95, 95, 'BO21_043_8124366270', 2, 'AIR DE RIEN (CIE MANIE)', 'L''AIR DE RIEN', 'Olivier Dureuil', '', '', 'Olivier Dureuil (création et mise en scène), Sabine Parisot (mise en scène et réadaptation)', '', 0, 1, 0, '', 4, 7, 8, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rSur scène, ils sont trois et ne font qu''un... Qui fait quoi? Qui est qui? Où veulent-ils en venir? La piste du Nouveau Cirque se brouille avec ce spectacle singulier entre mystère et burlesque. les chapeaux volent, les balles dessinent des arabesques dans cet étrange laboratoire où la musique conduit les gestes des uns vers la folie d''un seul. Des prouesses de jonglerie comme s''il en pleuvait!\r\rEquipe de création\r Vincent Regnard (comédien, manipulation d''objets), Laurent Renaudot (comédien, manipulation d''objets), Mayeul Loisel (création et interprétation musical, jeu); Jean-Jacques Ignart et Vincent Gredin (création lumière) Amélie Loisy (création costumes)\r\rType de spectacle : fixe\rLangue du spectacle : muet\rDisposition du public : frontal\rEspaces scéniques : théâtre, chapiteau\rFiche technique : lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 3', '', '', '', '', '', '0000-00-00', 'Serv_069_10098443750', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(96, 96, 'BO21_043_8124366270', 2, 'TIENS TOI DROIT (CIE MANIE)', 'TIENS TOI DROIT', 'Vincent Regnard', '', '', 'Agnès Celerier', '', 0, 0, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rAprès L’air de rien, pièce pour deux jongleurs et un musicien, la compagnie Manie revient avec sa nouvelle création Tiens-toi-droiT. Pour ce spectacle, les balles de jonglage ont été troquées contre des tubes métalliques, des cadres, des boîtes et d’autres objets géométriques... Un étrange chantier apparaît dans lequel un personnage cherche à construire, transformer et métamorphoser son horizon. Il ne ménage pas ses efforts et devant un tel casse-tête c’est une histoire d’obstination qui commence, se traduisant par une succession d’échecs présentés avec beaucoup d’humour et de dérision. Ce spectacle reste fondamentalement optimiste. On assiste au travers des essais et des inventions en tous genres, à l’évolution d’un personnage prenant possession de son corps, au départ manipulé par l’objet puis manipulant l’objet, pour au final, créer ensemble une danse en s’appuyant l’un sur l’autre.\r\rEquipe de création\rVincent Regnard ( création, interprétation), Agnès Célérier (mise en scène), Stéphane Scott (création musicale), Michel Mugnier et Yves Bouche (scénographie, construction), Vincent Gredin (création lumières), Laurence Rossignol et Camille Perreau (costumes).\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'Serv_069_10098450380', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte');
INSERT INTO `oeuvres_oeuvres` (`id`, `user_id`, `ficheliee_id`, `type_id`, `nom_usuel`, `nom_complet`, `auteur`, `compositeur`, `choregraphe`, `metteurenscene`, `producteur`, `duree`, `prix`, `jauge`, `anneecreation`, `hauteurminimale`, `profondeurminimale`, `ouvertureminimale`, `disponibilitespectacle`, `projetencours`, `interprete`, `distributeur`, `scenariste`, `realisateur`, `editeurmusical`, `labels`, `co_auteur`, `traducteur`, `illustrateur`, `isbn`, `gencod`, `nomcollection`, `lieuedition`, `reedition`, `leformat`, `nombrepage`, `numdewey`, `anneeedition`, `titreorigine`, `auteur_origine`, `co_auteur_origine`, `editeur_origine`, `langueorigine`, `languetraduite`, `annee1erpublication`, `code_operateur`, `nom_operateur`, `commentaires`, `commentaires_arts_visuels`, `commentaires_audio_visuel`, `commentaires_livre`, `commentaires_patrimoine`, `commentaires_spectacle`, `date_actualisation`, `id_fiche`, `mot_passe`, `questionnaires`, `nom_prenom_destinataire`, `e_mail_destinataire`, `fonction_titre`, `liste_des_contacts`, `activites`, `genres`, `disciplines`, `localisations`, `precision_activites`, `type_public`, `support`, `rayonnement`, `distinction`, `index_complementaire`) VALUES
(97, 97, 'CmPa_043_6443296642', 2, 'CHANT DU DINDON (CIE RASPOSO)', 'LE CHANT DU DINDON', 'Fanny Molliens et Marie Molliens', '', '', 'Fanny Molliens', '', 0, 3, 0, '2009', 10, 40, 40, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\r... Sur la piste, l''Artiste joue une farce...\rMais il est le " Dindon " de cette farce, car la farce c''est sa vie, et il joue sa vie.\rDans cette "existence rêvée" que l''on prête à l''Artiste, on l''imagine brillant, encensé, adulé, entouré d''amis... mais la réalité est toute autre : l''Artiste est seul.\rChaque personnage avec son histoire, son passé, ses racines, cherche à échapper à la solitude, il rejoint alors la tribu, le clan qui sera sa famille : c’est La Troupe.\rLe voyage, indissociable de la vie circassienne, enferme les rancœurs et confine les inimitiés, mais resserre entre eux les marginaux. Ils mettent en commun leurs rêves, leurs illusions et leurs utopies dans un labeur harassant qui les rend solidaires dans leur ardeur pour magnifier l’éphémère.\rLa piste est bien un lieu de conflit. La douleur ou la joie, l''envol ou la chute, la gloire ou l''humiliation... les tensions s''exaltent jusqu''à un degré critique. Le passage d''un état à son contraire, le renversement des tendances, est permanent. Tout artiste de cirque s''accomplit dans une lutte singulière, à la recherche de l''envers des choses.\rCe spectacle possède le dynamisme d''une aventure puissante dont la hardiesse n''a d''égale que la joie de vivre. Il est l''exploit renouvelé tous les soirs, d''un spectacle donné au public sans que les tourments humains ne puissent entraver la générosité et le don des artistes.\rEt nous faisons nôtre, cette synthèse de Nietzsche : "l''homme est une corde tendue entre la bête et le surhumain, une corde au dessus d''un abîme".\r\rEquipe de création\rFanny Molliens, Joseph Molliens, Marie Molliens, Vincent Molliens, Hélène Molliens, Vincent Mignot, Katell Le Brenn, Bruno Lussier, Julien Scholl, Jan Oving, Luca Forte, Alain Poisot, Benoît Keller, Jacky Lignon, Christian Millanvois, Arnaud Gallée, Pascal Lelièvre, Etienne Bousquet, Bernard Bonin, Stéphanie Monnot\r\rType de spectacle : fixe\rDisposition du public : circulaire\rEspaces scéniques : chapiteau\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 15', '', '', '', '', '', '0000-00-00', 'Serv_069_10098454780', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(98, 98, 'ADBO_043_8169572750', 2, 'RÉCRÉ (CIE SANS NOM)', 'LA RÉCRÉ', 'Jérôme Boulommier', '', '', 'Mise en scène collective des interprètes ; Ludovic Féménias (regard extérieur)', '', 0, 4, 0, '2009', 7, 7, 7, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rMathilde Charles et Jérôme Boulommier (artistes de cirque), david Théry (musicien); Simon Founel (création lumière et régisseur); Claude Boulommier (costumes)\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 3', '', '', '', '', '', '0000-00-00', 'Serv_069_10098460710', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(99, 99, 'ADBO_043_8169572750', 2, 'STREET SCENE (CIE SANS NOM)', 'LA STREET SCENE', 'Jérôme Boulommier', '', '', 'Jérôme Boulommier', '', 0, 5, 0, '2011', 4, 4, 4, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rSpectacle de 30 min environ, alliant le théâtre de rue burlesque et la jonglerie.\rFormé par les plus grands camelots, Raymond monte, démonte et vous démontre l''utilité de la dernière invention de la Compagnie des Scènes Nouvelles : La Street Scene. A la pointe de la technologie, avec ses diverses options, elle ravira les artistes de rue, les animateurs de foire et les particuliers pour leurs soirées karaoké. Ne manquez surtout pas cette démonstration qui changera la vie de millier de personnes.\r\rEquipe de création\rJérôme Boulommier (auteur, mise en scène, interprète)\r\rType de spectacle : fixe\rLangue dus pectacle : français\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : rue, salle polyvalente, chapiteau\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 1', '', '', '', '', '', '2012-10-30', 'Serv_069_10098464220', '', '', '', '', '', '', '\rSpectacle des arts de la rue ; Spectacle théâtral', '\rArts de la rue', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(100, 100, 'MDB_043_8841458920', 2, 'TEMPO (CIE ANXO)', 'TEMPO', 'Simon Anxolabéhère, Hélène Lopez de la Torre', '', '', 'Simon Anxolabéhère, Hélène Lopez de la Torre', '', 0, 1, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rDepuis plusieurs années, La compagnie s’interroge sur l’art de la magie et son rapport au Cirque. Comment concilier ces deux arts ? Défier les lois de la pesanteur a toujours été un grand thème des numéros de cirque. Notamment en Jonglerie.\rRenverser ces lois rejoint le domaine de la Magie. Comment ralentir le mouvement d’une balle de jonglage ? Comment suspendre une bulle dans l’air ? Comment le corps peut-il également dépasser ses limites anatomiques, léviter, se pencher entièrement sans tomber, voler… ? Relier l’art de la magie avec celui du Mime et de la danse fait également partie de nos recherches. Dans une phrase mimée ou dansée, comment faire apparaître ou faire disparaître un Objet ? Comment rendre visible l’invisible et jouer avec la réalité ?\rEnfin, chacun de ces arts utilise des techniques différentes et ont leurs propres outils d’écriture. Mis ensemble ils créent une nouvelle forme, un style. Comment la forme peut elle raconter autre chose qu’elle-même ? Comment la performance ou l’effet magique passe t’il au second plan pour laisser place à l’univers poétique, à l’histoire, à la situation dramatique ?\rNotre démarche artistique pose ainsi plusieurs questions : Comment les mythes reflètent ils notre époque ? Comment parler d’écologie ou d’actualité avec humour et poésie ? Comment toucher aussi bien un public d’enfants qu’un public plus averti ? Elle s’inscrit aussi bien dans l’histoire de la magie nouvelle que dans celle du nouveau Cirque.\r"Tempo" se compose de différents tableaux réalisés par un Homme et une Femme, seuls ou en duo. Leurs deux mondes se font écho, se croisent et se rencontrent. La musique est un mélange d’instruments ludiques joués en direct par les artistes, de morceaux classiques , d’ambiances sonores, de textes relevant de l’actualité.\r"Tempo" c''est :\r- Le rythme, la pulsation, le battement du coeur,\r- L'' actualité des époques passées et présentes,\r- Le climat et l''environnement,\r- l''eclosion de la vie...son mouvement, le temps suspendu... \r\rEquipe de création\rSimon Anxolabéhère, Hélène Lopez de la Torre (auteur, interprète, metteur en scène)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre, chapiteau, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10098527100', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(101, 101, 'MDB_043_9174114390', 2, 'FUNAMBUS (CIE UNDERCLOUDS)', 'LE FUNAMBUS', 'Mathieu Hibon, Chloé Moura', '', '', 'Diane Vaicle (coach fil, regard extérieur mise en scène) et Didier Manuel (street coach, regard extérieur)', 'Région Bourgogne (Dispositif Les Arts Publics : La Transverse, CNAR L’Abattoir, Les Zacro’s d’ma Rue.), DDJS 54, Mairie de Maxéville, Materia Prima / Le Totem, Le Môm’Théâtre, Cirk’Eole, Haut Fourneaux U4.\r', 0, 0, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rFunambus : (fynâbys) n.m. Du lat. funambulus, dérivé de funis (corde) du verbe ambulare (se promener) et du mot bus (désigne une architecture de réseau selon laquelle toutes les machines partagent un fil unique.). 1.Véhicule de transport peu commun. 2.Engin motorisé spécialisé dans le transport d’acrobates équilibristes. Il permet le repos des funambules migrateurs lors des grandes transhumances de rue.\rExp : « Etre beau comme un funambus » cad, en avoir sous la carrosserie malgré les apparences. Le « Funambus » devient une mythologie des temps présents où chacun est libre de s’approprier et d’interpréter les images proposées. Le fil est un agrès fragile et en tension, à la fois aérien et terrien, contradictoire par nature, et ce sont les étincelles créées au contact de ces éléments qui nous intéressent. Partir de la technique de cirque et de ce qu’elle raconte, pour la transposer à la vie, à l’humain avec ses troubles, ses rêves, ses folies, ses amours et ses incohérences. Dans une succession de tableaux, la compagnie Underclouds tente de raconter les péripéties de l’homme face au monde confrontant la poésie brute et l’onirisme.\r\rEquipe de création\rMathieu Hibon, Chloé Moura (auteur, metteur en scène et interpètes); Diane Vaicle (coach fil, regard extérieur mise en scène) et Didier Manuel (street coach, regard extérieur); Phil Von (musique, performeur, acting); William Nurdin (vidéo, son du câble, machiniste, acting); Thomas Ménoret (chauffeur, régisseur son et lumière, machiniste, acting)\r\rType de spectacle : déambulatoire\rDisposition du public : circulaire\rEspaces scéniques : rue\rFiche technique : légère\rArtistes sous contrat : 6', '', '', '', '', '', '0000-00-00', 'Serv_069_10098540510', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(102, 102, 'BO21_043_8124349010', 2, 'LABORATOIRE HISTOIRES MUSICALES (FEE FOLIE)', 'LE LABORATOIRE D''HISTOIRES MUSICALES', 'Rosline Pornin et Thomas Bressy', '', '', 'Bongo Maingi (regard extérieur)', '', 0, 4, 0, '2011', 4, 8, 8, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation:\rRecette du Professeur jbouiing :\rPrenez 3 contes populaires,\rDécoupez-les dans tous les sens,\rMélangez le tout en un unique spectacle d’arts vivants,\rAjoutez du théâtre préalablement réchauffé\rAgrémentez d’une sauce de merveilleux,\rPimentez d’une épice humoristique,\rEt relevez d’une pointe de rêve.\rVersez votre préparation dans un plat pour enfants,\rMettez le tout sous pression, dans une cocotte musique,\rFaites bouillir et attendez l’émulsion d’ émotions,\rLaissez refroidir, puis dégustez,\rVous obtiendrez une excellente préparation de\r« Spectacle vivant d’histoires musicales ! »\rUne recette pleine d’appétit au goût de voyage,\rEntre rêve et réalité !!\r\rEquipe de création\rRosline Pornin et Thomas Bressy (auteur, interprète); Clément Fonteniaud (création lumière)\r\rType de spectacle : fixe\rLangue du spectacle : français\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_10098575200', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(103, 103, 'BO21_043_8124349010', 2, 'OUAIS C''EST ÇA (FEE FOLIE)', 'OUAIS C''EST ÇA', 'Roseline Pornin', '', '', 'Roseline Pornin, Soutien artistique : Claudine et Yves Breton', '', 0, 4, 0, '2009', 3, 3, 3, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rDriiiiiiiiiiiiiing ! Une sonnerie de réveil, une chasse d’eau, et la journée commence ! Lili et son frère Jojo se préparent pour aller à l’école.\rDés le matin, Lili, la princesse écolo, est sur le dos de son frère, qui ne se soucie guère de laisser son robinet ouvert.\rUne fois en classe, la maitresse, Madame Schmurtz propose un cours qui sort de l’ordinaire : apprendre à reconnaitre un pictogramme ? …un pictoquoi ?\rDriiiiiiiiiiiiiiiiing…. Chouette la récrée !!! C’est quoi ton gouter ? Le gâteau de Maman ou du supermarché ?\rEn fin de matinée, Madame Schmurtz les interroge sur les habitudes de consommation : J’achète ? Je jette ?\rDe retour à la maison : on mange quoi M’man ? Une tarte aux poireaux ...Beuurk ! Ho non ! La maman explique aux enfants quels sont les fruits et légumes de saison et fait participer le public.\rDurant toute la journée, des déchets se sont accumulés devant la maison des Zigomates. A son réveil, Miss Fafaline, est éberluée par la montagne de déchets. Désemparée, elle demande aux enfants du public de l’aider à trier le verre, les emballages recyclables, le compost, …et à faire attention aux exceptions (piles, ampoules...).\r\rEquipe de création\rRoseline Pornin (conception, mise en scène, jeu, fabrication des décors,des costumes et des marionnettes), Thotho (Bruitage et son), Thomas Bressy (Ingénieur en ce qu’il y a à faire)\r\rType de spectacle : fixe\rLangue du spectacle : français\rDisposition du public : frontal\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_10098579230', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Marionnette / théâtre d\\''objets', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(104, 104, 'Serv_043_8169634631', 2, 'H68 O (CIE HYAQUADIRE QUE)', 'H68 O', 'Hyacinthe Reisch - idée de Jorg Muller (Tube)', '', '', 'Hyacinthe Reisch', '', 0, 0, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Type de spectacle : fixe\rDisposition du public : circulaire\rEspaces scéniques : "sur commande" s''adapte si repérages - théâtre, chapiteau, salle polyvalente, rue, parcs et jardins\rFiche technique : lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'Serv_069_10098583560', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(105, 105, 'Serv_043_8169634631', 2, 'H70 (CIE HYAQUADIRE QUE)', 'H70', 'Hyacinthe Reisch', '', '', 'Hyacinthe Reisch', '', 0, 2, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Equipe de création\rHyacinthe Reisch (interprète), Julie Loyot (interprète), Diane Vaicle (interpète)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 3 + 2 techniciens', '', '', '', '', '', '0000-00-00', 'Serv_069_10098587140', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(106, 106, 'ADBO_043_8852294470', 2, 'FATAL RECITAL (CIE TOUK TOUK CIE)', 'FATAL RECITAL', 'Raoul Petit', '', '', 'Sylvain Bernert', '', 0, 4, 0, '2011', 4, 3, 3, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rJustin Quidam vient proposer un récital de guitare acoustique. Il prend soin de présenter les oeuvres qu''il va interpréter. Il se retrouve vite empêtré dans ses anecdotes personnelles, digressant vers des dujets plus universels. Le fil rouge qui est sensé guider le public et soutenir le comédien n''apportera que cauchemars et confusions.\r\rEquipe de création\rRaoul Petit (interprète)\r\rType de spectacle : fixe\rLangue du spectacle : français\rDisposition du public : frontal\rEspaces scéniques : théâtre, rue\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 1\r\r\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10098592180', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(107, 107, 'CmPa_043_6443296130', 2, 'TETE DANS ETOILES (CIE GRAND JETE)', 'LA TETE DANS LES ETOILES', '', '', 'Frédéric Cellé, Solange Cheloudiakoff et Pauline Maluski (assistantes)', '', 'Coproductions L’arc, scène nationale Le Creusot, L’Atrium de Tassin la Demi-Lune', 0, 2, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rUn homme est pris dans sa rêverie. Du haut de son observatoire cielé, la tête dans les étoiles, il orchestre trois créatures qui jouent pour lui ses peurs, ses rêves, ses désirs, ses fantasmes... Les rêves s’enchaînent au gré de sa musique, de ses propositions. Sa jubilation l’aveugle… Enfermé dans son monde, il se permet d’aller de plus en plus loin et impose plus qu’il ne propose. Quand il met véritablement en danger l’un de ses ircadanseurs, sa bulle se fissure. Le trio prend alors petit à petit sa\rliberté et va jusqu’à se révolter. Il le détrône et l’oblige enfin à revenir au sol, à la réalité.\r\rEquipe de création\rFrédéric Cellé (Chorégraphe); Hervé Rigaud (Musique); Claire Vuillemin, Rémy Benard, Pierre Bertrand, Hervé Rigaud (Interprètes); Hélène Triboulet (Dramaturge); Thomas Chazalon (Régie générale et lumières); Yannick Verot (Régie son); Béatrice Vermande et Aude Desigaux (Costumes); Amandine Fonfrede (Scénographe); Pauline Maluski et Solange Cheloudiakoff (Assistantes du chorégraphes)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rContraintes scéniques : parquet souple, tapis de danse\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 7\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10104881910', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(108, 108, 'CmPa_043_6443296130', 2, 'A FAIT UN LONG VOYAGE (CIE GRAND JETE)', '...A FAIT UN LONG VOYAGE', 'Eddy Pallaro', '', 'Frédéric Cellé; Assistante chorégraphe : Pauline Maluski', '', 'Coproduction : L’arc, scène nationale Le Creusot, L’atrium de Tassin la Demi-Lune', 0, 3, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\r« Un homme avance-t-il dans la vie, un ou unifié ? Est-il une seule matrice qui s’est modelée au cours des ans, une statue de glaise qui a changé de forme, peu à peu, en se confrontant aux épreuves, aux joies, aux peines ? Ou bien, garde-t-il en lui, comme des avatars multiples, toutes les formes qu’il a tour à tour empruntées, qui se sont superposées comme des strates gardant leur autonomie et montrant leurs jointures.\rEt si le voyage dans la vie était cette tentative impossible de la fusion des différents êtres que l’on a été, qui pourraient comme dans un cauchemar revendiquer leur autonomie, refuser d’adhérer à celui que l’on est devenu. Limites de l’essence, limites de la folie qui fait que le voyage dans le passé devient impossible car chaque souvenir est relié à une époque, est objet de soupçon : souvenir réel, souvenir reconstitué,\rsouvenir-écran ? Dire le passé suffit-il à le faire exister ?\rEt si le voyage dans la vie n’était que cela : l’apprentissage de l’incertitude, le doute de la réalité, l’interrogation de ce qui nous constitue et l’inquiétude sur les traces que l’on va laisser. Et si le voyage ultime était d’abord un voyage dans une chambre et un voyage dans une tête ? »\r\rEquipe de création\rHervé Rigaud (Musique); Solange Cheloudiakoff (Répétitrice); Catherine Ailloud-Nicolas (Dramaturge); Béatrice Vermande (Costumes); Thomas Chazalon (Régie générale et lumières); Samuel Bazin (Régie son); Amandine Fonfrede (Scénographe); Frédéric Cellé, Piet Defrancq, Jim Krummenacker, Alexis Jestin, Gérald Robert-Tissot (Danseurs); Hervé Rigaud, Christophe Gratien (Musiciens)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : moyennemnt lourde\rContraintes scéniques : parquet souple, tapis de danse\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : 9', '', '', '', '', '', '0000-00-00', 'Serv_069_10105089170', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(109, 109, 'ADBO_043_8735420360', 2, 'ROSIE ROSE BABY (CIE OPOPOP)', 'ROSIE ROSE BABY', 'Karen Bourre', '', '', 'Karen Bourre; Julien Lanaud', '', 0, 5, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rUne histoire simple et familière, proche des petits : une maman qui essaye d''endormir son bébé. Le coucher, le sommeil, le réveil ne sont pas toujours simples à appréhender pour un tout petit, « Que se passe t''il quand on dort ? Que fait maman quand je dors ? Pourquoi faut il dormir? »\rA partir de ces questions très simples que se pose un jour ou l''autre chaque enfant, nous partirons en voyage dans un monde drôle et malicieux peuplé de balles, d''ombrelles, de hula hoops, de marionnettes et de magie.\rSans parole, en utilisant un langage corporel poétique et sensible, nous tenterons de donner une réponse à ces questions essentielles à travers un univers décalé et plein d''humour..\r\rEquipe de création\rKaren Bourre, Julien Lanaud\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : chapiteau, théâtre,\rFiche technique : légère\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 2', '', '', '', '', '', '0000-00-00', 'Serv_069_10107155720', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(110, 110, 'MDB_043_9174114390', 2, 'OPUS INCERTUM (CIE UNDERCLOUDS)', 'OPUS INCERTUM', 'Chloé Moura', '', '', 'Pierre Meunier (regard extérieur)', '', 0, 5, 0, '2009', 5, 0, 7, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rOpus Incertum*\rOu comment déplacer des montagnes\r\rPièce de cirque pour un film, une fille penchée et quelques cailloux.\rBataille absurde d''un Sysiphe ordinaire obstiné à traîner son fardeau sans lequel il n''a plus raison d''être.\rPorter, supporter, déporter, rapporter, colporter, transporter, reporter, emporter...\rSentir le poids des choses et la légèreté de l''être à moins que ce ne soit le contraire...\rSe laisser traverser par la gravité, se donner de la consistance en se confrontant à la matière brute.\rBrasser du vent.\rToutes les raisons sont bonnes pour ne pas avoir l''air de ne pas rien faire.\rConstruire, déconstruire, équilibre instable, casser, tomber.\rEt puis le rien, le vide, la chute, un instant de silence; et ça repart?\r\r*Ouvrage sans ordre fait de blocs de pierres d''importance variable et de forme irrégulière...\r\rEquipe de création : Chloé Moura (interprète), Valentin Mussou, Leslie Bourdin (création musicale et interprétation), Charlotte Winter (costumière), Serge Meyer (création lumière)\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire, circulaire\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, parcs et jardins\rFiche technique : mpoyennement lourde\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 4', '', '', '', '', '', '0000-00-00', 'Serv_069_10124311900', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(111, 111, 'MDB_043_9174114390', 2, 'FACE SONORE (CIE UNDERCLOUDS)', 'LA FACE SONORE', 'Mathieu Hibon', '', '', '', '', 0, 3, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rPerformance de funambule sur câble sonorisé tendu à grande hauteur. Quel son un câble tendu à plusieurs tonnes vat-il produire? chuchotements, murmures, craquements, mélodies? Et si à 10, 20, 30 m de haut, sur un câble de 10 m d''épaisseur... On prenait le temps de respirer, d''écouter, de se promener... Projet hybride mêlant technique de cirque et recherche sonore. Entre l''intime et l''extime, la tension et la fragilité.\r\rEquipe de création\rMathieu Hibon, William Nurdin et Philippe Fontez (interprètes)\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire, circulaire\rEspaces scéniques : installation funambule sur des bâtiments\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : -\rArtistes sous contrat : 4', '', '', '', '', '', '0000-00-00', 'Serv_069_10124345600', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(112, 112, 'MDB_043_10122184880', 2, 'KUSAWAZISHA (BONGO)', 'KUSAWAZISHA', 'John Mzee Maingi', '', '', '', '', 0, 4, 0, '2012', 4, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Equipe de création\rJohn Mzee Maingi (interprète, auteur, metteur en scène)\r\rType de spectacle : fixe\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : théâtre, chapiteau, salle polyvalente, rue, parcs et jardins\rFiche technique : - \rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 1', '', '', '', '', '', '0000-00-00', 'Serv_069_10124442720', '', '', '', '', '', '', '\rSpectacle de cirque', '\rArts de la piste ; Nouveau cirque', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(113, 113, 'ADBO_043_9411721380', 2, 'NUIT TRANSFIGUREE (CIE NUMB)', 'LA NUIT TRANSFIGUREE', 'Cie Numb', '', '', '', '', 0, 0, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rSur le plateau, dix personnes.\rSix musiciens et quatre danseuses.\rDes cordes, des corps...ensemble ou non. \rComment se tisse le lien?\rQuand est-on "avec" et quand ne l''est-on plus?\rPar quel mouvement s''initie la prise de distance, inévitablement évocatrice de plus ou moins grandes séparations?\rDe qui? De quoi décide-t-on de s''éloigner?\rD''une personne, un espace, un instant, une part de soi. Que l''on souhaiterait laisser là, dans la profondeur et l''épaisseur de cette Nuit qui se joue...\rNuit au caractère romantique mais aussi parfois dissonant. Produisant l''impression d''une fausse tranquilité, d''une instabilité, d''une contrariété, d''une tension entre les notes...comme, peut-être, entre les personnes...\r\rEquipe de création\rEstelle de Montalembert, Gladys Massenot, Maëlle Desclaux, Charlotte Moretti (danseuses) ; Anne Mercier, Thierry Juffard, Sandra Delavault, Aline Corbière, Christian Wolff, Laurent Lagarde (musiciens).\rN.B : la représentation peut aussi être donnée sur bande sonore\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : légère\rContraintes scéniques : tapis de danse\rOeuvre inscrite à la SACD : non\rArtistes sous contrat : 4', '', '', '', '', '', '0000-00-00', 'Serv_069_10167630280', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(114, 114, 'CmPa_043_6443296012', 2, 'ATTENDANT PETIT POUCET (ECLAIRCIE)', 'EN ATTENDANT LE PETIT POUCET', 'Texte de Philippe Dorin', '', '', 'Claire Simard', '', 0, 4, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rLa scénographie est constituée d''un tableau d''école que les deux personnages font tourner au gré de leur errance dans cet espace rond cerné par un chemin de fer. Le petit train personnage et compagnon de jeu dessine l''espace, le temps et les fait voyager dans l''infiniment grand de leurs jeux d''enfant. Le grand et la Petite sèment des cailloux le long de leur chemin des mots au fil de leur histoire. Parviendront-ils à tracer la ligne de leur récit ? Peut-être mais plus sûrement rond comme le monde un poème.\rA partir de 18 mois jusqu''à 5 ans\r\rEquipe de création\rClaire Simard (mise en scène), Thierry Feral (assistant à la mise en scène et à la scénographie), Mayeul Loisel (musique), Julia Morlot (costumes)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : -', '', '', '', '', '', '0000-00-00', 'ADBO_069_10184976290', '', '', '', '', '', 'SIMARD Claire', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(115, 115, 'CmPa_043_6443296012', 2, 'SIGNE NINA (ECLAIRCIE)', 'SIGNE NINA', '', '', '', '', '', 0, 5, 0, '2008', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rCe spectacle est, né de notre rencontre entre notre compagnie et l''association "Ecoute mes Mains" qui promeut l''enseignement de la langue des signes.\rSur scène deux comédiennes, l''une signe l''autre pas, l''une chante, l''autre pas. Elles jouent ensemble et créent un espace de jeu ou sons et signes s''entremêlent et tissent une danse qui raconte. Voix chantée, voix parlée, langue des signes et langues du corps se mêlent joyeusement pour donner envie d''ouvrir et de découvrir les albums jeunesses.\rA partir de 4 ans\r\rEquipe de création\rClaire Simard (Voix et accordéon), Laurence Koehler (Langue des signes)\r\rType de spectacle : fixe\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente \rFiche technique : légère\rOeuvre inscrite à la SACD : oui\rArtistes sous contrat : -\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10185006220', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(116, 116, 'CmPa_043_6443296012', 2, 'CONTES PERCUS (ECLAIRCIE)', 'CONTES ET PERCUS', '', '', '', 'Claire Simard', '', 0, 0, 0, '', 0, 0, 0, 'Non', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\r4 versions (18 mois-5 ans/à partir de 6 ans/à partir de 10 ans / itinérant)\rSpectacle modulable en fonction de l''âge du public et du lieu.\rDans chacun de ces spectacles les deux artistes, à l’écoute du public, peuvent en adapter le rythme, ajouter une histoire, un morceau de musique, se lancer dans une autre version… tant le conte, avant d’être un art du spectacle, est un art de la relation, de la transmission dans la jubilation de l’instant.\r- Des pieds des mains pour les tout petits (18 mois à 5 ans)\r- Bon rebond pour tous à partir de 6 ans\r- Tout est bond : Pour adolescents et adultes…\r- Promenade Contée et Percutante…tout public\r\rDans chaque version des contes des 7 coins du monde issus pour la plupart des traditions populaires. Le conteur et le percussionniste se renvoient la balle, les mots dans des jeux d''opposition, qui rythment les histoires.\r\rEquipe de création\rClaire Simard (metteur en scène), Bernard Becherot (Conteur), Michael Santos (percussion)\r\rType de spectacle : fixe et déambulatoire\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente, rue, parcs et jardins\rFiche technique : légère\rOeuvre inscrite à la SACD : oui', '', '', '', '', '', '0000-00-00', 'ADBO_069_10185017200', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Conte', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(117, 117, 'CmPa_043_6443296302', 2, 'BAD SHOT (CIE GALERIE)', 'BAD SHOT', '', '', 'Florent Ottello, Kylie Walters', '', 'La Galerie', 0, 5, 0, '2012', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rDeux cow-boys se font face pour un duel... L''instant précédent le premier coup de feu est prétexte aux souvenirs et aux anticipations. Un combat qui ne nécessite pas de vainqueur mais résolument\rludique !\r\rEquipe de création : Kylie WALTERS et Florent OTTELLO (conception et chorégraphie)\r\rType de spectacle : fixe / performance\rCréation/ reprise : création\rDisposition du public : différente en fonction des lieux de représentation\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins, tout lieux pouvant accueillir des performances\rFiche technique : légère\rContraintes scéniques : - \rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10212908860', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(118, 118, 'CmPa_043_6443296302', 2, 'ODYSSEE URBAINE (CIE GALERIE)', 'ODYSSE URBAINE', '', 'Bertrand Larrieu', 'Florent Ottello', '', 'La Galerie', 0, 4, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rOdyssée Urbaine est un projet de parcours artistiques pluridisciplinaires avec les émotions comme moteur principal. Une femme et un homme traversent la ville et donnent à voir leur vécu. Ils se cherchent et se rencontrent, des mondes imaginaires se créent autour d''eux. Les espaces du quotidien résonnent et se transforment pour émouvoir les spectateurs.\rPour chaque ville étape, Odyssée Urbaine proposera un itinéraire poétique particulier conçu spécialement en fonction des spécificités de la ville (le spectacle pourra être une déambulation in situ, en extérieur, ou un spectacle en salle...)\r\rEquipe de création\rOTTELLO Florent – conception, LARRIEU Bertrand – composition musique, GRAS Fabienne – réalisation vidéo, PEREZ Jérôme - scénographie et lumière, PINGRÉONN Lucie - dramaturgie, WALTERS Kylie – costume\r\rType de spectacle : fixe, déambulatoire, performance\rCréation/ reprise : création\rDisposition du public : frontal, demi-circulaire, circulaire, en fonction des lieux\rEspaces scéniques : théâtre, salle polyvalente, rue, parcs et jardins, piscine, stade, parking, gare\rFiche technique : légère\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10212924700', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\r', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(119, 119, 'CmPa_043_6443296302', 2, 'PNEUMATICA (CIE GALERIE)', 'PNEUMATICA', '', 'Bertrand Larrieu', 'Florent Ottello', '', 'La Galerie', 0, 4, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rLes chemins des émotions chez un individu connaissent de multiples théories selon les philosophes et psychologues : est ce un ressenti cérébral qui a des effets sur le corps ou des modifications corporelles qui font naître des émotions? Si pour explorer les émotions dans le corps humain, nous comparons l''évolution de celles-ci à un air de musique : le paroxysme émotionnel serait le temps fort musical et les prémices seraient alors l''anacrouse. Comme toute première mesure d''un morceau en anacrouse commence par du silence, attachons-nous à regarder le silence du corps...\r\rEquipe de création\rBarbara Caillieu (interprète), Florent Ottello (chorégraphe), Bertrand Larrieu (compositeur),Jérôme Perez (scénographe et régisseur lumière), Kylie Walters (costumière)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : 2,5m x 2,5m\rFiche technique : légère\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10213066610', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(120, 120, 'CmPa_043_6443296302', 2, 'NOIR TOUJOURS QUELQU''UN TOUSSE (CIE GALERIE)', 'DANS LE NOIR, IL Y A TOUJOURS QUELQU''UN QUI TOUSSE', '', 'Bertrand Larrieu', 'Florent Ottello', '', '', 0, 5, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rA travers cette nouvelle collaboration avec le chorégraphe Florent Ottello, Bertrand Larrieu poursuit son travail de recherche expérimentale des matières et des objets. A l''aide de micros, il explore et capte les sons, les bruits issus de différentes matières organiques (eau, tissu, cuir, pierre...) et crée un environnement musical qui sert d''appui pour la danse de Florent Ottello.\rCette création musicale articulée autour de l''exploration des émotions est composée de deux parties : tandis que la première est complètement improvisée, la seconde laisse place à une bandeson, composée en amont, teintée de musique électroacoustique.\r\rEquipe de création : Florent Ottello (chorégraphie), Bertrand Larrieu (composition musique)\r\rType de spectacle : fixe, performance\rCréation/ reprise : création\rDisposition du public : en fonction du lieu de représentation\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins, tout lieu pouvant accueillir des performances\rFiche technique : légère\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10213078890', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(121, 121, 'CmPa_043_6443296302', 2, 'TRANSFUGE (CIE GALERIE)', 'TRANSFUGE', '', 'Bertrand Larrieu', 'Florent Ottello', '', 'La Galerie - en co-production avec l''école de musique, danse et théâtre du Pays de Puisaye-Forterre et la Cie Ornithorynque.', 0, 4, 0, '2009', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn homme politique en costume-cravate, un homme fort, sûr de lui, combattant, séducteur… Il suscite l’ambiguïté des sentiments chez le spectateur : admiration/agacement, sympathie/dégoût. Il est à la fois attachant et repoussant, il est odieux, mais il sait être émouvant, c’est un manipulateur.\rIl est dans la maîtrise de soi, mais ses failles laissent parfois transpirer son humanité. La danse de ce solo est construite sur une énergie intense, continue, tenue, puissante (à l’image de ce que le personnage souhaite montrer de lui-même), elle s’assimile à l’endurance du coureur de fond, pour qu’instinctivement elle laisse jaillir des moments de faiblesse corporelle, comme des ponctuations d’intime, des moments de “vérité”…\r\rEquipe de création\rFlorent Ottelo (chorégraphe), Bertrand Larrieu (compositeur), PEREZ Jérôme Perez (scénographie et lumière), Kylie Walters (costume), Fabienne Gras (regard sur la danse)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal avec avancées dans les gradins\rEspaces scéniques : théâtre, salle polyvalente\rFiche technique : légère\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10213108670', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(122, 122, 'CmPa_043_6443296302', 2, 'MEMORY#2 (CIE GALERIE)', 'MEMORY#2', '', '', 'Florent Ottello', '', 'La Galerie - en coproduction avec le CDC de Bourgogne', 0, 4, 0, '2007', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rInspiré du jeu de société éponyme, Memory#2 est un spectacle interactif, où le spectateur est joueur. Comme dans le jeu traditionnel, il lui est demandé de former des paires ; à cette différence près que ce ne sont pas des paires d’images fixes mais des paires chorégraphiques thématiques (le lac des cygnes, le tennis, la gourmandise, les muscles faciaux, etc….) qu’interprètent les danseurs en live.\rAu sol une grille de jeu est dessinée avec des cases notées A1, A2, B3, C4, C5 etc… Le spectateur choisit 2 cases qui vont être dansées… Les paires gagnantes donnent naissance à un duo sur le même thème…\r\rEquipe de création : Florent Ottello (auteur, interprète), CAILLIEU Barbara Caillieu (interprète), Nicolas Delarbre ou Pierre-Jean Etienne (interprètes)\r\rType de spectacle : fixe, spectacle intéractif\rCréation/ reprise : création\rDisposition du public : frontal, demi-circulaire\rEspaces scéniques : théâtre, salle polyvalente, gymnases, studio de danse ...\rFiche technique : légère\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10215011510', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(123, 123, 'CmPa_043_6443296302', 2, 'PUZZLE ME UP (CIE GALERIE)', 'PUZZLE ME UP', '', '', 'Florent Ottello', '', 'La Galerie - Coproductions : Association Plus (Lausanne) / Cie Wisniewski', 0, 5, 0, '2006', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rPour ce solo composé d’images fortes inspirées de ce que la vie médiatisée nous donne à voir, il est laissé à chacun le soin de composer son histoire avec des fragments exacerbés. Dans un cadre de lumière crue, trois personnages, incarnés par un seul homme, se croisent, et chacun à leur manière, vivent des situations analogues. De cette juxtaposition semblable à un zapping télévisuel, des émotions apparaissent qui peuvent être acceptées, refusées ou partagées...\rAu-delà de leur image volontairement stéréotypée, ces trois personnages (un militaire, une sainte et un/une prostitué/e) symbolisent tout autant : l’autorité, l’amour, la mort, le désir, la routine, le sacré... Par la confrontation de leurs disparités, des similarités inattendues surgissent et confrontent le spectateur à certains paradoxes : l’attirance pour l’interdit, les affinités entre des idées adverses, consentir à ce que nous voulons rejeter...\r\rEquipe de création : Florent Ottello\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal, ou possibilité en version performance in situ\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins, ou tout autre espace pertinent\rFiche technique : légère\rContraintes scéniques : - \rOeuvre inscrite à la SACD : non\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10215036040', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(124, 124, 'CmPa_043_6443296302', 2, 'LOTORAMA (CIE GALERIE)', 'LOTORAMA', '', '', 'Florent Ottello', '', 'La Galerie', 0, 3, 0, '2005', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rCette soirée, à l''origine conçue pour le Château Rouge d’Annemasse, est une sorte “lotospectacles”. Le spectateur récupère à l’accueil un carton à gratter puis il déambule dans le théâtre à la découverte des 6 performances sur 10 qu’il a “gagnées”...\rAu grattage de son carton, le spectateur découvre son itinéraire : 6 lieux associés à six horaires. (10 est le minimum de performances pour que l ''événement se déroule, mais il est possible de présenter 15 performances pour que les spectateurs en voit une dizaine...).\r\rEquipe de création : Florent Ottello (conception) et artistes invités\r\rType de spectacle : performance déambulatoire\rCréation/ reprise : création\rDisposition du public : multi-espaces (plusieurs espaces séparés dans le même bâtiment\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins, tout bâtiment pouvant accueillir du public\rFiche technique : moyennement lourde\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10215056510', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte');
INSERT INTO `oeuvres_oeuvres` (`id`, `user_id`, `ficheliee_id`, `type_id`, `nom_usuel`, `nom_complet`, `auteur`, `compositeur`, `choregraphe`, `metteurenscene`, `producteur`, `duree`, `prix`, `jauge`, `anneecreation`, `hauteurminimale`, `profondeurminimale`, `ouvertureminimale`, `disponibilitespectacle`, `projetencours`, `interprete`, `distributeur`, `scenariste`, `realisateur`, `editeurmusical`, `labels`, `co_auteur`, `traducteur`, `illustrateur`, `isbn`, `gencod`, `nomcollection`, `lieuedition`, `reedition`, `leformat`, `nombrepage`, `numdewey`, `anneeedition`, `titreorigine`, `auteur_origine`, `co_auteur_origine`, `editeur_origine`, `langueorigine`, `languetraduite`, `annee1erpublication`, `code_operateur`, `nom_operateur`, `commentaires`, `commentaires_arts_visuels`, `commentaires_audio_visuel`, `commentaires_livre`, `commentaires_patrimoine`, `commentaires_spectacle`, `date_actualisation`, `id_fiche`, `mot_passe`, `questionnaires`, `nom_prenom_destinataire`, `e_mail_destinataire`, `fonction_titre`, `liste_des_contacts`, `activites`, `genres`, `disciplines`, `localisations`, `precision_activites`, `type_public`, `support`, `rayonnement`, `distinction`, `index_complementaire`) VALUES
(125, 125, 'CmPa_043_6443296302', 2, 'ROOM SERVICE (CIE GALERIE)', 'ROOM SERVICE', '', 'Bertrand Larrieu et Sofie Dubs (réalisation vidéo)', 'Florent Ottello', '', 'La Galerie', 0, 4, 0, '2004', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rLe point de départ de Room service est une performance en appartement. Les spectateurs étaient plongés au coeur d’une action très théâtrale ; ils vivaient un meurtre en “direct” ! Par la suite, Room service est devenu un film présenté avec une performance live.\rIl s’agit alors de constituer un tissage du même événement vu sous deux angles différents, de créer une mise en abîme… Comme deux miroirs face à face, les actions des acteurs “en live” sont comme des arrêts photographiques en noir et blanc de la fiction colorée du film. Les corps ne servent pas de support à la projection, le spectateur reste libre de choisir où il veut\rposer son regard.\r\rEquipe de création : Florent Ottello (chorégraphie), Sofie Dubs (réalisation vidéo), Bertrand Larrieu (musique)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle polyvalente, , salle pouvant faire de la vidéo-projection\rFiche technique : légère\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10215072860', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(126, 126, 'CmPa_043_6443296302', 2, 'AU MENU : ART TAPAS (CIE GALERIE)', 'AU MENU : ART TAPAS', '', '', 'Florent Ottello - réalisé avec une quizaine d''artistes de tout horizons', '', 'La Galerie', 0, 3, 0, '2001', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rProjet pluridisciplinaire, "Au menu : Art-tapas" est une performance réalisée dans des lieux “publiques” (restaurants, cafés, théâtres transformés...) réunissant une quinzaine d’artistes\rd’horizons très variés : la danse, le théâtre, la musique, le cirque, les marionnettes, les arts\rplastiques...\rChaque artiste est maître de sa performance appelée “art-tapas”, mais les spectateurs en\rchoisissent la durée et l’instant de présentation. Chaque performance est réalisée à la table des\rspectateurs, pour une ou deux personnes à la fois, créant une intimité que ni l’artiste ni le\rspectateur ne peuvent ignorer\r\rEquipe de création : OTTELLO Florent – conception\rréalisé avec une quinzaine d''artistes de tous horizons\r\rType de spectacle : performance déambulatoire\rCréation/ reprise : création\rDisposition du public : grand espace installé en espace de restauration\rEspaces scéniques : théâtre, salle polyvalente, parcs et jardins, tout bâtiment pouvant accueillir du public (restaurant)\rFiche technique : moyennement lourde\rContraintes scéniques : -\rOeuvre inscrite à la SACD : non\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10215093520', '', '', '', '', '', '', '\rSpectacle chorégraphique', '\rDanse ; Danse contemporaine', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(127, 127, 'CmPa_043_6443295702', 2, 'MICHE DRATE (CIE ARTIFICE)', 'MICHE ET DRATE : PAROLES BLANCHES', '‘‘Miche et Drate, paroles blanches’’ de Gérald Chevrolet - Création novembre 2011\r‘‘Peter Pan’’ de James Matthew Barrie – Création novembre 2013\r‘‘La dispute’’ de Marivaux – Création démcembre 2013', 'John Kaced', '', 'Christian Duchange', 'Compagnie l’Artifice - Coproduction Le Théâtre de l’Espace, scène nationale de Besançon et l’ARC, scène\rnationale du Creusot', 0, 1, 0, '2011', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rMiche et Drate sont deux personnages qui jouent, et comme chacun sait, et le jeu est une chose sérieuse. Ils brassent les mots et les idées en explorateurs de la langue et champions de la polémique. Ils s’attaquent méthodiquement aux questions essentielles, existentielles. Ils se testent et se détestent, s’adorent et se confondent un peu comme Vladimir et Estragon chez Beckett. Ils empruntent les mots des grands, mais préfèrent en explorer de tout neufs. Ils cherchent des réponses, mais rencontrent souvent de nouvelles questions. Ils parlent beaucoup mais c’est pour mieux charger de profondeur leurs silences. À la fois désireux et inquiets de grandir, ils explorent ici et maintenant l’ailleurs du monde ; celui où vivent les grands, le vrai. Ils se déplacent donc dans ce temps et cet espace du jeu, devenu pour nous la scène du théâtre ; univers clos, où ils s’exposent cependant à tous les regards du public. Ils construisent un monde réel « sans le poids de la réalité » dirait le psychanalyste D. W. Winnicott\r\rEquipe de création\rMise en scène Christian Duchange (mise en scène), Diane Müller et Sébastien Chabane (interprétation), John Kaced (création musique), David Debrinay (création lumière), Nathalie Pernette (chorégraphie), Alice Duchange (scénographie), Nathalie Martella (création costume et réalisation), Emanuelle Petit (régie générale et de tournée), Gilles Abel (accompagnement philosophique), Virginie Lonchamp assistée de Céline Dupuy (chargée de production) \r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui - le texte de G. Chevrolet\rArtistes sous contrat : 4\r', '', '', '', '', '', '0000-00-00', 'Serv_069_10217424720', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(128, 128, 'CmPa_043_6443295702', 2, 'LETTRES AMOUR (CIE ARTIFICE)', 'LETTRES D''AMOUR DE 0 à 10', 'Susie Morgenstern', '', '', 'Christian Duchange', '', 0, 1, 0, '2004', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rC’est une traversée du désastre, une quête du père, des origines… Ernest, l’enfant, le héros de cette fable, tourne en rond dans sa vie en panne de sens. Le hasard vital d’une rencontre avec Victoire le pousse à se poser la question de son lien avec le monde et de sa place sur la frise du temps. Une véritable quête l’emporte et le métamorphose, entraînant sa progression dans deux directions à la fois, le passé et l’avenir.\rL’enfant trouve du sens en l’à venir lorsqu’il accède à son passé cependant que chaque avancée lui permet de reconstruire ce passé manquant. Il déchiffre petit à petit les secrets de famille qui ressemblent quelquefois à des secrets de Polichinelle, il rompt les silences depuis trop longtemps installés.\rHistoire contemporaine aux allures de conte, cette fable fabrique un de ces mythes nécessaires où l’on aimerait que la réalité rejoigne la fiction. Une quête qui malgré tout n’aboutira pas sous nos yeux ; Trop de bonheur deviendrait suspect.\rComment ne pas raconter cette histoire d’amitié exemplaire aux enfants d’aujourd’hui, confrontés régulièrement à la barbarie des Hommes, largement exposée tous les jours au « 2O heures ».\rEn réponse à leurs questions, à nos questions, sur les « pourquoi et pour qui grandir », nous souhaitons témoigner de cela sur le théâtre et raconter l’histoire. (...).\r\rEquipe de création \rChristian Duchange (mise en scène), Diane Müller et Bernard Daisey (interprète), Jean-Jacques Ignart (création lumière)\rNathalie Martella (création costume ), Stephan Castang assisté de Thomas Bart (dramaturgie musicale), Alice Duchange (affiche), Virginie Lonchamp (production)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : moyennement lourde\rOeuvre inscrite à la SACD : oui\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10217435030', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(129, 129, 'CmPa_043_6443295702', 2, 'POUR RIRE PASSER TEMPS (CIE ARTIFICE)', 'POUR RIRE POUR PASSER LE TEMPS', 'Sylvain Levey, publié en 2006 - Editions Théâtrales', 'John Kaced', '', 'Christian Duchange', 'ABC Dijon, Ville de Louhans, Pays de la Bresse Bourguignonne, Compagnie l’Artifice', 0, 4, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'ADBO', 'Administrateur', 'Présentation\rThéâtre en écho au désarroi actuel, certes ; fable sur le désir de violence adolescent, bien sûr ; ce texte pourrait simplement nous servir de punching-ball s’il n’avait pas les qualités, bien plus atemporelles, d’une excellente pièce de théâtre.\rLa mise en scène «!commando!», en dehors des théâtres, que nous proposons pour cette séance de torture «!pour passer le temps!», rapproche le public très près de ses héros “négatifs”, le faisant complice, malgré lui, de plaisirs troubles et témoins de lâchetés ordinaires. !Un “fait divers” sous la loupe précieuse du théâtre c’est toujours une excellente occasion d’appréhender notre difficile travail d’humanité.\r\rEquipe de création \rChristian Duchange (mise en scène), Sébastien Chabane (interprète), John Kaced (Espace sonore), Kenneth King (visuel)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre, salle de classe, salle polyvalente\rFiche technique : légère\rOeuvre inscrite à la SACD : oui - le texte de Sylvain Levey\r\r', '', '', '', '', '', '0000-00-00', 'ADBO_069_10217449200', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte'),
(130, 130, 'CmPa_043_6443296012', 2, 'BLEU PETOCHE (ECLAIRCIE)', 'BLEU PETOCHE', 'Claire Simard', 'Michael Santos', '', 'Claire Simard', 'La Compagnie Théâtre de L’Eclaircie - Coproduction : Caisse d’allocation familiales de la Côte d’or', 0, 4, 0, '2010', 0, 0, 0, 'Oui', 'Non', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'MDB', 'MDB Amandine', 'Présentation\rUn puits aux images et aux sons au centre du plateau, qui est à la fois le lieu de tous les dangers et le réceptacle de toutes les paroles de peur .Il résonne parfois de mille voix mystérieuses et fait apparaître des formes fugaces et fantomatiques.Parfois il se tait.\rDeux panneaux de part et d’autre sont les maisons cachettes des deux protagonistes.Ils sont aménagés de petites fenêtres qui s’ouvrent pour épier ou accueillir, qui se ferment pour se cacher ou se protéger.\rLes deux personnages vont jouer chacun avec leur langage (musique et marionnettes peluches) à rejouer les petites scènes du quotidien où la peur est parfois et à notre insu ce qui nous attache au réel, dans tous les sens du terme « attacher ».\r\rEquipe de création\rMichael Santos (percussionniste comédien), Ismaël Gutierrez (comédien et marionnettiste) Claire Simard (metteur en scène), Jean Jacques Ignart (création éclairage et technique) Anne Chignard, Yves Bouche, Thierry Féral (réalisation des décors)\r\rType de spectacle : fixe\rCréation/ reprise : création\rDisposition du public : frontal\rEspaces scéniques : théâtre\rFiche technique : légère\rOeuvre inscrite à la SACD : non\r', '', '', '', '', '', '0000-00-00', 'MDB_069_10219344360', '', '', '', '', '', '', '\rSpectacle théâtral', '\rArts du théâtre ; Théâtre', '\r', '\r', '\r', '\rJeune public ; Tous publics', '\r', '\r', '\r', '\rAdulte');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_oeuvres_activites`
--

CREATE TABLE IF NOT EXISTS `oeuvres_oeuvres_activites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) NOT NULL DEFAULT '0',
  `activite_id` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`oeuvre_id`),
  KEY `activite_id` (`activite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

--
-- Contenu de la table `oeuvres_oeuvres_activites`
--

INSERT INTO `oeuvres_oeuvres_activites` (`id`, `oeuvre_id`, `activite_id`) VALUES
(11, 1, '04'),
(12, 2, '04'),
(13, 3, '04'),
(14, 4, '04'),
(15, 5, '04'),
(16, 6, '04'),
(17, 7, '04'),
(18, 8, '04'),
(19, 9, '04'),
(20, 10, '04'),
(21, 11, '04'),
(22, 12, '04'),
(23, 13, '04'),
(24, 14, '04'),
(25, 15, '04'),
(26, 16, '04'),
(27, 17, '04'),
(28, 18, '04'),
(29, 19, '04'),
(30, 20, '04'),
(31, 21, '04'),
(32, 22, '04'),
(33, 23, '04'),
(34, 24, '04'),
(35, 25, '04'),
(36, 26, '01'),
(37, 27, '02'),
(38, 28, '01'),
(39, 29, '01'),
(40, 30, '01'),
(41, 31, '01'),
(42, 32, '01'),
(43, 33, '04'),
(44, 34, '04'),
(45, 35, '04'),
(46, 36, '04'),
(47, 37, '04'),
(48, 38, '04'),
(49, 39, '04'),
(50, 40, '04'),
(51, 41, '04'),
(52, 42, '04'),
(53, 43, '04'),
(54, 44, '04'),
(55, 45, '04'),
(56, 46, '04'),
(57, 47, '04'),
(58, 48, '04'),
(59, 49, '04'),
(60, 50, '04'),
(61, 51, '04'),
(62, 52, '04'),
(63, 53, '04'),
(64, 54, '04'),
(65, 55, '04'),
(66, 56, '01'),
(67, 57, '04'),
(68, 58, '04'),
(69, 59, '04'),
(70, 60, '04'),
(71, 61, '02'),
(72, 62, '02'),
(73, 63, '02'),
(74, 64, '02'),
(75, 65, '02'),
(76, 65, '05'),
(77, 66, '02'),
(78, 67, '02'),
(79, 68, '02'),
(80, 69, '02'),
(81, 70, '02'),
(82, 71, '02'),
(83, 72, '02'),
(84, 73, '02'),
(85, 74, '02'),
(86, 75, '02'),
(87, 76, '02'),
(88, 77, '02'),
(89, 78, '02'),
(90, 79, '02'),
(91, 80, '02'),
(92, 81, '02'),
(93, 82, '02'),
(94, 83, '02'),
(95, 84, '02'),
(96, 85, '02'),
(97, 86, '02'),
(98, 87, '02'),
(99, 88, '02'),
(100, 89, '02'),
(101, 90, '02'),
(102, 91, '02'),
(103, 91, '05'),
(104, 92, '04'),
(105, 93, '04'),
(106, 94, '04'),
(107, 95, '04'),
(108, 96, '04'),
(109, 97, '04'),
(110, 98, '04'),
(111, 99, '02'),
(112, 99, '05'),
(113, 100, '04'),
(114, 101, '04'),
(115, 102, '04'),
(116, 103, '02'),
(117, 104, '04'),
(118, 105, '04'),
(119, 106, '04'),
(120, 107, '01'),
(121, 108, '01'),
(122, 109, '04'),
(123, 110, '04'),
(124, 111, '04'),
(125, 112, '04'),
(126, 113, '01'),
(127, 114, '02'),
(128, 115, '02'),
(129, 116, '02'),
(130, 117, '01'),
(131, 118, '01'),
(132, 119, '01'),
(133, 120, '01'),
(134, 121, '01'),
(135, 122, '01'),
(136, 123, '01'),
(137, 124, '01'),
(138, 125, '01'),
(139, 126, '01'),
(140, 127, '02'),
(141, 128, '02'),
(142, 129, '02'),
(143, 130, '02');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_oeuvres_disciplines`
--

CREATE TABLE IF NOT EXISTS `oeuvres_oeuvres_disciplines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) NOT NULL,
  `discipline_id` char(10) NOT NULL,
  KEY `id` (`id`),
  KEY `oeuvre_id` (`oeuvre_id`),
  KEY `discipline_id` (`discipline_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_oeuvres_genres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_oeuvres_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) NOT NULL,
  `genre_id` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`oeuvre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=253 ;

--
-- Contenu de la table `oeuvres_oeuvres_genres`
--

INSERT INTO `oeuvres_oeuvres_genres` (`id`, `oeuvre_id`, `genre_id`) VALUES
(11, 1, '6501'),
(12, 1, '65'),
(13, 2, '6501'),
(14, 2, '65'),
(15, 3, '6501'),
(16, 3, '65'),
(17, 4, '6501'),
(18, 4, '65'),
(19, 5, '6501'),
(20, 5, '65'),
(21, 6, '6501'),
(22, 6, '65'),
(23, 7, '6501'),
(24, 7, '65'),
(25, 8, '6501'),
(26, 8, '65'),
(27, 9, '6501'),
(28, 9, '65'),
(29, 10, '6501'),
(30, 10, '65'),
(31, 11, '65'),
(32, 12, '65'),
(33, 13, '65'),
(34, 14, '65'),
(35, 15, '65'),
(36, 16, '6501'),
(37, 16, '65'),
(38, 17, '6501'),
(39, 17, '65'),
(40, 18, '6501'),
(41, 18, '65'),
(42, 19, '6501'),
(43, 19, '65'),
(44, 20, '65'),
(45, 21, '6501'),
(46, 21, '65'),
(47, 22, '6501'),
(48, 22, '65'),
(49, 23, '65'),
(50, 24, '6502'),
(51, 24, '65'),
(52, 25, '6501'),
(53, 25, '65'),
(54, 26, '6201'),
(55, 26, '62'),
(56, 27, '6301'),
(57, 27, '63'),
(58, 28, '6201'),
(59, 28, '62'),
(60, 29, '62'),
(61, 30, '62'),
(62, 31, '6201'),
(63, 31, '62'),
(64, 32, '6201'),
(65, 32, '62'),
(66, 33, '6501'),
(67, 33, '65'),
(68, 34, '6501'),
(69, 34, '65'),
(70, 35, '6501'),
(71, 35, '65'),
(72, 36, '6501'),
(73, 36, '65'),
(74, 37, '6501'),
(75, 37, '65'),
(76, 38, '6501'),
(77, 38, '65'),
(78, 39, '6501'),
(79, 39, '65'),
(80, 40, '6501'),
(81, 40, '65'),
(82, 41, '6501'),
(83, 41, '65'),
(84, 41, '61'),
(85, 42, '6501'),
(86, 42, '65'),
(87, 43, '6501'),
(88, 43, '65'),
(89, 44, '6501'),
(90, 44, '65'),
(91, 45, '6501'),
(92, 45, '65'),
(93, 46, '6501'),
(94, 46, '65'),
(95, 47, '65'),
(96, 48, '65'),
(97, 49, '6501'),
(98, 49, '65'),
(99, 50, '6501'),
(100, 50, '65'),
(101, 51, '6501'),
(102, 51, '65'),
(103, 52, '61'),
(104, 52, '6501'),
(105, 52, '65'),
(106, 53, '6501'),
(107, 53, '65'),
(108, 54, '6501'),
(109, 54, '65'),
(110, 54, '61'),
(111, 55, '6501'),
(112, 55, '65'),
(113, 56, '6501'),
(114, 56, '65'),
(115, 56, '62'),
(116, 57, '6501'),
(117, 57, '65'),
(118, 58, '6501'),
(119, 58, '65'),
(120, 59, '6501'),
(121, 59, '65'),
(122, 60, '6501'),
(123, 60, '65'),
(124, 61, '6302'),
(125, 61, '63'),
(126, 63, '6301'),
(127, 63, '63'),
(128, 64, '6301'),
(129, 64, '63'),
(130, 65, '64'),
(131, 66, '6304'),
(132, 66, '63'),
(133, 67, '6304'),
(134, 67, '63'),
(135, 68, '6304'),
(136, 68, '63'),
(137, 69, '6304'),
(138, 69, '63'),
(139, 70, '6304'),
(140, 70, '63'),
(141, 71, '6304'),
(142, 71, '63'),
(143, 72, '6301'),
(144, 72, '63'),
(145, 73, '6301'),
(146, 73, '63'),
(147, 74, '6301'),
(148, 74, '63'),
(149, 75, '6301'),
(150, 75, '63'),
(151, 76, '6301'),
(152, 76, '63'),
(153, 77, '6301'),
(154, 77, '63'),
(155, 78, '6301'),
(156, 78, '63'),
(157, 79, '6301'),
(158, 79, '63'),
(159, 80, '6301'),
(160, 80, '63'),
(161, 81, '61'),
(162, 82, '6301'),
(163, 82, '63'),
(164, 83, '6303'),
(165, 83, '63'),
(166, 84, '6303'),
(167, 84, '63'),
(168, 85, '6303'),
(169, 85, '63'),
(170, 86, '6303'),
(171, 86, '63'),
(172, 87, '6303'),
(173, 87, '63'),
(174, 88, '6301'),
(175, 88, '63'),
(176, 89, '6301'),
(177, 89, '63'),
(178, 90, '6301'),
(179, 90, '63'),
(180, 91, '64'),
(181, 92, '65'),
(182, 93, '65'),
(183, 94, '65'),
(184, 95, '6501'),
(185, 95, '65'),
(186, 96, '6501'),
(187, 96, '65'),
(188, 97, '6501'),
(189, 97, '65'),
(190, 98, '6501'),
(191, 98, '65'),
(192, 99, '64'),
(193, 100, '6501'),
(194, 100, '65'),
(195, 101, '6501'),
(196, 101, '65'),
(197, 102, '6501'),
(198, 102, '65'),
(199, 103, '6304'),
(200, 103, '63'),
(201, 104, '6501'),
(202, 104, '65'),
(203, 105, '6501'),
(204, 105, '65'),
(205, 106, '6501'),
(206, 106, '65'),
(207, 107, '6201'),
(208, 107, '62'),
(209, 108, '6201'),
(210, 108, '62'),
(211, 109, '6501'),
(212, 109, '65'),
(213, 110, '6501'),
(214, 110, '65'),
(215, 111, '6501'),
(216, 111, '65'),
(217, 112, '6501'),
(218, 112, '65'),
(219, 113, '6201'),
(220, 113, '62'),
(221, 114, '6301'),
(222, 114, '63'),
(223, 115, '6301'),
(224, 115, '63'),
(225, 116, '6303'),
(226, 116, '63'),
(227, 117, '6201'),
(228, 117, '62'),
(229, 119, '6201'),
(230, 119, '62'),
(231, 120, '6201'),
(232, 120, '62'),
(233, 121, '6201'),
(234, 121, '62'),
(235, 122, '6201'),
(236, 122, '62'),
(237, 123, '6201'),
(238, 123, '62'),
(239, 124, '6201'),
(240, 124, '62'),
(241, 125, '6201'),
(242, 125, '62'),
(243, 126, '6201'),
(244, 126, '62'),
(245, 127, '6301'),
(246, 127, '63'),
(247, 128, '6301'),
(248, 128, '63'),
(249, 129, '6301'),
(250, 129, '63'),
(251, 130, '6301'),
(252, 130, '63');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_oeuvres_implantations`
--

CREATE TABLE IF NOT EXISTS `oeuvres_oeuvres_implantations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `implantation_id` char(10) NOT NULL,
  `name` char(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `implantation_id` (`implantation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_oeuvres_typepublics`
--

CREATE TABLE IF NOT EXISTS `oeuvres_oeuvres_typepublics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) DEFAULT NULL,
  `typepublic_id` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=271 ;

--
-- Contenu de la table `oeuvres_oeuvres_typepublics`
--

INSERT INTO `oeuvres_oeuvres_typepublics` (`id`, `oeuvre_id`, `typepublic_id`) VALUES
(11, 1, '0404'),
(12, 1, '0401'),
(13, 2, '0404'),
(14, 2, '0401'),
(15, 3, '0404'),
(16, 3, '0401'),
(17, 4, '0404'),
(18, 4, '0401'),
(19, 5, '0404'),
(20, 5, '0401'),
(21, 6, '0404'),
(22, 6, '0401'),
(23, 7, '0404'),
(24, 7, '0401'),
(25, 8, '0404'),
(26, 8, '0401'),
(27, 9, '0404'),
(28, 9, '0401'),
(29, 10, '0404'),
(30, 10, '0401'),
(31, 11, '0404'),
(32, 11, '0401'),
(33, 12, '0404'),
(34, 12, '0401'),
(35, 13, '0404'),
(36, 13, '0401'),
(37, 14, '0404'),
(38, 14, '0401'),
(39, 15, '0404'),
(40, 15, '0401'),
(41, 16, '0404'),
(42, 16, '0401'),
(43, 17, '0404'),
(44, 17, '0401'),
(45, 18, '0404'),
(46, 18, '0401'),
(47, 19, '0404'),
(48, 19, '0401'),
(49, 20, '0404'),
(50, 20, '0401'),
(51, 21, '0404'),
(52, 21, '0401'),
(53, 22, '0404'),
(54, 22, '0401'),
(55, 23, '0404'),
(56, 23, '0401'),
(57, 24, '0404'),
(58, 24, '0401'),
(59, 25, '0404'),
(60, 25, '0401'),
(61, 26, '0404'),
(62, 26, '0401'),
(63, 27, '0404'),
(64, 27, '0401'),
(65, 28, '0404'),
(66, 28, '0401'),
(67, 29, '0404'),
(68, 29, '0401'),
(69, 30, '0404'),
(70, 30, '0401'),
(71, 31, '0404'),
(72, 31, '0401'),
(73, 32, '0404'),
(74, 32, '0401'),
(75, 33, '0404'),
(76, 33, '0401'),
(77, 34, '0404'),
(78, 34, '0401'),
(79, 35, '0404'),
(80, 35, '0401'),
(81, 36, '0404'),
(82, 36, '0401'),
(83, 37, '0404'),
(84, 37, '0401'),
(85, 38, '0404'),
(86, 38, '0401'),
(87, 39, '0404'),
(88, 39, '0401'),
(89, 40, '0404'),
(90, 40, '0401'),
(91, 41, '0404'),
(92, 41, '0401'),
(93, 42, '0404'),
(94, 42, '0401'),
(95, 43, '0404'),
(96, 43, '0401'),
(97, 44, '0404'),
(98, 44, '0401'),
(99, 45, '0404'),
(100, 45, '0401'),
(101, 46, '0404'),
(102, 46, '0401'),
(103, 47, '0404'),
(104, 47, '0401'),
(105, 48, '0404'),
(106, 48, '0401'),
(107, 49, '0404'),
(108, 49, '0401'),
(109, 50, '0404'),
(110, 50, '0401'),
(111, 51, '0404'),
(112, 51, '0401'),
(113, 52, '0404'),
(114, 52, '0401'),
(115, 53, '0404'),
(116, 53, '0401'),
(117, 54, '0404'),
(118, 54, '0401'),
(119, 55, '0404'),
(120, 55, '0401'),
(121, 56, '0404'),
(122, 56, '0401'),
(123, 57, '0404'),
(124, 57, '0401'),
(125, 58, '0404'),
(126, 58, '0401'),
(127, 59, '0404'),
(128, 59, '0401'),
(129, 60, '0404'),
(130, 60, '0401'),
(131, 61, '0404'),
(132, 61, '0401'),
(133, 62, '0404'),
(134, 62, '0401'),
(135, 63, '0404'),
(136, 63, '0401'),
(137, 64, '0404'),
(138, 64, '0401'),
(139, 65, '0404'),
(140, 65, '0401'),
(141, 66, '0404'),
(142, 66, '0401'),
(143, 67, '0404'),
(144, 67, '0401'),
(145, 68, '0404'),
(146, 68, '0401'),
(147, 69, '0404'),
(148, 69, '0401'),
(149, 70, '0404'),
(150, 70, '0401'),
(151, 71, '0404'),
(152, 71, '0401'),
(153, 72, '0404'),
(154, 72, '0401'),
(155, 73, '0404'),
(156, 73, '0401'),
(157, 74, '0404'),
(158, 74, '0401'),
(159, 75, '0404'),
(160, 75, '0401'),
(161, 76, '0404'),
(162, 76, '0401'),
(163, 77, '0404'),
(164, 77, '0401'),
(165, 78, '0404'),
(166, 78, '0401'),
(167, 79, '0404'),
(168, 79, '0401'),
(169, 80, '0404'),
(170, 80, '0401'),
(171, 81, '0404'),
(172, 81, '0401'),
(173, 82, '0404'),
(174, 82, '0401'),
(175, 83, '0404'),
(176, 83, '0401'),
(177, 84, '0404'),
(178, 84, '0401'),
(179, 85, '0404'),
(180, 85, '0401'),
(181, 86, '0404'),
(182, 86, '0401'),
(183, 87, '0404'),
(184, 87, '0401'),
(185, 88, '0404'),
(186, 88, '0401'),
(187, 89, '0404'),
(188, 89, '0401'),
(189, 90, '0404'),
(190, 90, '0401'),
(191, 91, '0404'),
(192, 91, '0401'),
(193, 92, '0404'),
(194, 92, '0401'),
(195, 93, '0404'),
(196, 93, '0401'),
(197, 94, '0404'),
(198, 94, '0401'),
(199, 95, '0404'),
(200, 95, '0401'),
(201, 96, '0404'),
(202, 96, '0401'),
(203, 97, '0404'),
(204, 97, '0401'),
(205, 98, '0404'),
(206, 98, '0401'),
(207, 99, '0404'),
(208, 99, '0401'),
(209, 100, '0404'),
(210, 100, '0401'),
(211, 101, '0404'),
(212, 101, '0401'),
(213, 102, '0404'),
(214, 102, '0401'),
(215, 103, '0404'),
(216, 103, '0401'),
(217, 104, '0404'),
(218, 104, '0401'),
(219, 105, '0404'),
(220, 105, '0401'),
(221, 106, '0404'),
(222, 106, '0401'),
(223, 107, '0404'),
(224, 107, '0401'),
(225, 108, '0404'),
(226, 108, '0401'),
(227, 109, '0404'),
(228, 109, '0401'),
(229, 110, '0404'),
(230, 110, '0401'),
(231, 111, '0404'),
(232, 111, '0401'),
(233, 112, '0404'),
(234, 112, '0401'),
(235, 113, '0404'),
(236, 113, '0401'),
(237, 114, '0404'),
(238, 114, '0401'),
(239, 115, '0404'),
(240, 115, '0401'),
(241, 116, '0404'),
(242, 116, '0401'),
(243, 117, '0404'),
(244, 117, '0401'),
(245, 118, '0404'),
(246, 118, '0401'),
(247, 119, '0404'),
(248, 119, '0401'),
(249, 120, '0404'),
(250, 120, '0401'),
(251, 121, '0404'),
(252, 121, '0401'),
(253, 122, '0404'),
(254, 122, '0401'),
(255, 123, '0404'),
(256, 123, '0401'),
(257, 124, '0404'),
(258, 124, '0401'),
(259, 125, '0404'),
(260, 125, '0401'),
(261, 126, '0404'),
(262, 126, '0401'),
(263, 127, '0404'),
(264, 127, '0401'),
(265, 128, '0404'),
(266, 128, '0401'),
(267, 129, '0404'),
(268, 129, '0401'),
(269, 130, '0404'),
(270, 130, '0401');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_ric_oeuvres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_ric_oeuvres` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_usuel` varchar(50) NOT NULL,
  `nom_complet` mediumtext NOT NULL,
  `auteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `compositeur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `choregraphe` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `metteurenscene` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `producteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dureespecacle` varchar(80) DEFAULT NULL,
  `prix` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `jauge` varchar(40) DEFAULT NULL,
  `anneecreation` varchar(4) DEFAULT NULL,
  `hauteurminimale` int(20) DEFAULT NULL,
  `profondeurminimale` int(20) DEFAULT NULL,
  `ouvertureminimale` int(20) DEFAULT NULL,
  `disponibilitespectacle` varchar(4) DEFAULT NULL,
  `projetencours` varchar(4) DEFAULT NULL,
  `interprete` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distributeur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `scenariste` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `realisateur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `editeurmusical` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `labels` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `co_auteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `traducteur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `illustrateur` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `isbn` varchar(20) DEFAULT NULL,
  `gencod` int(20) DEFAULT NULL,
  `nomcollection` varchar(120) DEFAULT NULL,
  `lieuedition` varchar(120) DEFAULT NULL,
  `reedition` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `leformat` varchar(80) DEFAULT NULL,
  `nombrepage` int(20) DEFAULT NULL,
  `numdewey` varchar(10) DEFAULT NULL,
  `anneeedition` varchar(4) DEFAULT NULL,
  `titreorigine` varchar(4) DEFAULT NULL,
  `auteur_origine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `co_auteur_origine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `editeur_origine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `langueorigine` varchar(4) DEFAULT NULL,
  `languetraduite` varchar(4) DEFAULT NULL,
  `annee1erpublication` varchar(4) DEFAULT NULL,
  `code_operateur` varchar(6) DEFAULT NULL,
  `nom_operateur` varchar(40) DEFAULT NULL,
  `commentaires` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_arts_visuels` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_audio_visuel` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_livre` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_patrimoine` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commentaires_spectacle` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_actualisation` date DEFAULT NULL,
  `id_fiche` varchar(20) DEFAULT NULL,
  `mot_passe` varchar(20) DEFAULT NULL,
  `questionnaires` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `nom_prenom_destinataire` varchar(80) DEFAULT NULL,
  `e_mail_destinataire` varchar(80) DEFAULT NULL,
  `fonction_titre` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `liste_des_contacts` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `activites` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `genres` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `disciplines` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `localisations` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `precision_activites` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type_public` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `support` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rayonnement` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distinction` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `index_complementaire` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `nom_complet` (`nom_complet`(50)),
  KEY `user_id` (`user_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_ric_oeuvres_activites`
--

CREATE TABLE IF NOT EXISTS `oeuvres_ric_oeuvres_activites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ric_oeuvre_id` int(11) NOT NULL DEFAULT '0',
  `activite_id` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`ric_oeuvre_id`),
  KEY `activite_id` (`activite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_ric_oeuvres_disciplines`
--

CREATE TABLE IF NOT EXISTS `oeuvres_ric_oeuvres_disciplines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ric_oeuvre_id` int(11) NOT NULL,
  `discipline_id` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`ric_oeuvre_id`),
  KEY `discipline_id` (`discipline_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_ric_oeuvres_genres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_ric_oeuvres_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ric_oeuvre_id` int(11) NOT NULL,
  `genre_id` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`ric_oeuvre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_typeoeuvres`
--

CREATE TABLE IF NOT EXISTS `oeuvres_typeoeuvres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` char(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `oeuvres_typeoeuvres`
--

INSERT INTO `oeuvres_typeoeuvres` (`id`, `title`) VALUES
(1, 'Production phonographique'),
(2, 'Production scénique');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_typepublics`
--

CREATE TABLE IF NOT EXISTS `oeuvres_typepublics` (
  `id` char(10) NOT NULL,
  `title` char(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_typepublics`
--

INSERT INTO `oeuvres_typepublics` (`id`, `title`) VALUES
('0404', 'Jeune public'),
('0401', 'Tous publics');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_users`
--

CREATE TABLE IF NOT EXISTS `oeuvres_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` char(40) NOT NULL,
  `md5password` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `password` (`password`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres_users`
--

INSERT INTO `oeuvres_users` (`id`, `username`, `password`, `md5password`) VALUES
(1, 'contact@joellebouvier.com', '10032*RIS043', ''),
(2, 'elgran_olif@yahoo.fr', '84009*EYS043', ''),
(3, 'cie.sans.nom@hotmail.fr', '80078*ULINS-043', ''),
(4, 'cieopopop@gmail.com', '60050*JON043', ''),
(5, 'contact@parleschemins.com', '50058*RIS043', ''),
(6, 'sylvain@touktoukcie.com', '70091*ENEAU043', ''),
(7, 'antigone.clown@yahoo.fr', '40052*SSIERE043', ''),
(8, 'cienumb@hotmail.fr', '80087*JON043', ''),
(9, 'lebeauchaos@gmail.com', '14074*JON043', ''),
(10, 'lafeefolie@gmail.com ', '98035*JON043', ''),
(11, 'alexandre.demay2@orange.fr', '97018*INT-AN043', ''),
(12, 'compagnie.manie@gmail.com', '95039*JON043', ''),
(13, 'info@jerome-thomas.com', '38021*JON043', ''),
(14, 'cie.alfredalerte@yahoo.fr', '32039*THIOU043', ''),
(15, 'lartifice@wanadoo.fr', '39047*JONCE043', ''),
(16, 'contact@cieclairobscur.com', '59097*JON043', ''),
(17, 'junebug@wanadoo.fr', '74084*AGNY043', ''),
(18, 'cie.eclaircie@wanadoo.fr', '76071*JON043', ''),
(19, 'administration@legrandjete.com', '90079*ENOBLE043', ''),
(20, 'glomeris@laposte.net', '95065*FFEY-L043', ''),
(21, 'admin@cie-lagalerie.fr', '12069*XERRE043', ''),
(22, 'rasposo@wanadoo.fr', '51081*ROGES043', ''),
(23, 'leturlupin@gmail.com', '65011*JON043', ''),
(24, 'cirkoum@gmail.com', '72038*AUNE043', ''),
(25, 'contact@cirque-ilya.com', '74047*JON043', ''),
(26, 'cirque.star@wanadoo.fr', '75009*FFONDS043', ''),
(27, 'brunet.mireille@sfr.fr', '02013*RIS043', ''),
(28, 'theatrenbulles@hotmail.fr', '53057*EVIGNY043', ''),
(29, 'rainette@les-marionnettes.fr', '57058*INGY043', ''),
(30, 'lestotors@gmail.com', '74048*ALON-S043', ''),
(31, 'contact@bigmaxcreation.com', '380051*ALON-S043', ''),
(32, 'sdemeyrac@gmail.com', '280017*ALON-S043', ''),
(33, 'mzeebongo@gmail.com', '500007*JON043', ''),
(34, 'lespecheursdereves@yahoo.fr', '40046*RASBOU043', ''),
(35, 'jeanne-antide.leque@orange.fr', '90052*INT-AN043', ''),
(36, 'simonanxo@hotmail.com', '20089*JON043', ''),
(37, 'lhommearbre@laposte.net', '80063*JON043', ''),
(38, 'skydesela@yahoo.com', '70031*NTREAL043', ''),
(39, 'underclouds.cie@gmail.com', '90015*XEVILL043', ''),
(40, 'mariemunch@noos.fr', '70047*043', ''),
(41, 'piecesetmaindoeuvre@free.fr', '60089*ERRE-D043', ''),
(42, 'jcaubrun@orange.fr', '60077*ERNAIS043', ''),
(43, 'cirqumflex@hotmail.com', '07009*EYS043', ''),
(44, 'parceque@sfr.fr', '95075*SSY-LE043', '');

-- --------------------------------------------------------

--
-- Structure de la table `ric_oeuvres_ficheoeuvres_activites`
--

CREATE TABLE IF NOT EXISTS `ric_oeuvres_ficheoeuvres_activites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) NOT NULL DEFAULT '0',
  `activite_id` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oeuvre_id` (`oeuvre_id`),
  KEY `activite_id` (`activite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

--
-- Contenu de la table `ric_oeuvres_ficheoeuvres_activites`
--

INSERT INTO `ric_oeuvres_ficheoeuvres_activites` (`id`, `oeuvre_id`, `activite_id`) VALUES
(11, 1, '04'),
(12, 2, '04'),
(13, 3, '04'),
(14, 4, '04'),
(15, 5, '04'),
(16, 6, '04'),
(17, 7, '04'),
(18, 8, '04'),
(19, 9, '04'),
(20, 10, '04'),
(21, 11, '04'),
(22, 12, '04'),
(23, 13, '04'),
(24, 14, '04'),
(25, 15, '04'),
(26, 16, '04'),
(27, 17, '04'),
(28, 18, '04'),
(29, 19, '04'),
(30, 20, '04'),
(31, 21, '04'),
(32, 22, '04'),
(33, 23, '04'),
(34, 24, '04'),
(35, 25, '04'),
(36, 26, '01'),
(37, 27, '02'),
(38, 28, '01'),
(39, 29, '01'),
(40, 30, '01'),
(41, 31, '01'),
(42, 32, '01'),
(43, 33, '04'),
(44, 34, '04'),
(45, 35, '04'),
(46, 36, '04'),
(47, 37, '04'),
(48, 38, '04'),
(49, 39, '04'),
(50, 40, '04'),
(51, 41, '04'),
(52, 42, '04'),
(53, 43, '04'),
(54, 44, '04'),
(55, 45, '04'),
(56, 46, '04'),
(57, 47, '04'),
(58, 48, '04'),
(59, 49, '04'),
(60, 50, '04'),
(61, 51, '04'),
(62, 52, '04'),
(63, 53, '04'),
(64, 54, '04'),
(65, 55, '04'),
(66, 56, '01'),
(67, 57, '04'),
(68, 58, '04'),
(69, 59, '04'),
(70, 60, '04'),
(71, 61, '02'),
(72, 62, '02'),
(73, 63, '02'),
(74, 64, '02'),
(75, 65, '02'),
(76, 65, '05'),
(77, 66, '02'),
(78, 67, '02'),
(79, 68, '02'),
(80, 69, '02'),
(81, 70, '02'),
(82, 71, '02'),
(83, 72, '02'),
(84, 73, '02'),
(85, 74, '02'),
(86, 75, '02'),
(87, 76, '02'),
(88, 77, '02'),
(89, 78, '02'),
(90, 79, '02'),
(91, 80, '02'),
(92, 81, '02'),
(93, 82, '02'),
(94, 83, '02'),
(95, 84, '02'),
(96, 85, '02'),
(97, 86, '02'),
(98, 87, '02'),
(99, 88, '02'),
(100, 89, '02'),
(101, 90, '02'),
(102, 91, '02'),
(103, 91, '05'),
(104, 92, '04'),
(105, 93, '04'),
(106, 94, '04'),
(107, 95, '04'),
(108, 96, '04'),
(109, 97, '04'),
(110, 98, '04'),
(111, 99, '02'),
(112, 99, '05'),
(113, 100, '04'),
(114, 101, '04'),
(115, 102, '04'),
(116, 103, '02'),
(117, 104, '04'),
(118, 105, '04'),
(119, 106, '04'),
(120, 107, '01'),
(121, 108, '01'),
(122, 109, '04'),
(123, 110, '04'),
(124, 111, '04'),
(125, 112, '04'),
(126, 113, '01'),
(127, 114, '02'),
(128, 115, '02'),
(129, 116, '02'),
(130, 117, '01'),
(131, 118, '01'),
(132, 119, '01'),
(133, 120, '01'),
(134, 121, '01'),
(135, 122, '01'),
(136, 123, '01'),
(137, 124, '01'),
(138, 125, '01'),
(139, 126, '01'),
(140, 127, '02'),
(141, 128, '02'),
(142, 129, '02'),
(143, 130, '02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
