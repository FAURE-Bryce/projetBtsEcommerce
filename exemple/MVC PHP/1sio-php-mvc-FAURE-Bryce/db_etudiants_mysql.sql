-- Base de données Gestion des étudiants de SIO
-- SGBD MySQL
-- Script de création ou de restauration
-- SIO v2021 T. Savary

-- Création de la base si elle n'existe pas
CREATE DATABASE  IF NOT EXISTS `db_etudiants` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `db_etudiants`;

-- Suppression des tables si elles existent
DROP TABLE IF EXISTS `section`;
DROP TABLE IF EXISTS `etudiant`;

--
-- création des tables et insertion des enregistrements
--

CREATE TABLE IF NOT EXISTS `section` (
  `idsection` INTEGER NOT NULL AUTO_INCREMENT,
  `libellesection` varchar(50) NOT NULL,
  CONSTRAINT `pk_section`PRIMARY KEY (`idsection`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `section` (`idsection`, `libellesection`) VALUES
(1, '1SIO'),
(2, '2SIO SISR'),
(3, '2SIO SLAM');

CREATE TABLE IF NOT EXISTS `etudiant` (
	`idetudiant` INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	`nom` VARCHAR(50) NOT NULL,
	`prenom` VARCHAR(50) NOT NULL,
	`datenaissance` date DEFAULT NULL,
	`email` varchar(100) DEFAULT NULL,
    `telmobile` varchar(20) DEFAULT NULL,
    `adresse` varchar(200) DEFAULT NULL,
    `cp` varchar(5) DEFAULT NULL,
    `ville` varchar(50) DEFAULT NULL,
    `latitude` FLOAT NOT NULL,
    `longitude` FLOAT NOT NULL,
    `idsection` INTEGER NOT NULL
)	ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `fk_etudiant_section` FOREIGN KEY (`idsection`) REFERENCES `section` (`idsection`);

INSERT INTO `etudiant` (`nom`, `prenom`, `datenaissance`, `email`, `telmobile`, `adresse`, `cp`, `ville`, `latitude`, `longitude`, `idsection`) VALUES
('Lagaffe', 'Gaston', '2001-01-01', 'glagaffe@gmail.com', '01-23-45-67-89', 'galerie salvador dali', '66000', 'perpignan', 42.6964, 2.88, 1),
('Hochon', 'Paul', '2001-02-02', 'phochon@gmail.com', '01-23-45-67-89', 'quai nicolas sadi carnot', '66000', 'perpignan', 42.6998, 2.89318, 1),
('Obscur', 'Claire', '2001-07-07', 'cobscur@gmail.com', '01-23-45-67-89', '3 place des droits de l\'homme', '66330', 'cabestany', 42.7057, 3.00873, 2),
('Aivitable', 'Céline', '2001-09-09', 'cevitable@gmail.com', '01-23-45-67-89', '1 avenue jules ferry', '66350', 'toulouges', 42.6701, 2.83087, 2),
('Avuleur', 'Edith', '2001-10-10', 'etavuleur@gmail.com', '01-23-45-67-89', '12 avenue de la salanque', '66430', 'bompas', 42.7303, 2.93556, 2);
