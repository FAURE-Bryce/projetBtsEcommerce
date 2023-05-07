DROP DATABASE `bddEcommerce`;

CREATE DATABASE IF NOT EXISTS `bddEcommerce`;
USE `bddEcommerce`;

-- CREATE USER 'mobileUser'@localhost IDENTIFIED BY '#?K?5eFyH';

-- GRANT INSERT PRIVILEGES ON 'ecommerce'.* TO 'mobileUser'@localhost IDENTIFIED BY '#?K?5eFyH';
-- GRANT UPDATE PRIVILEGES ON 'ecommerce'.* TO 'mobileUser'@localhost IDENTIFIED BY '#?K?5eFyH';

CREATE TABLE IF NOT EXISTS `Marque` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(35) NOT NULL,
    CONSTRAINT pk_Marque PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Taille` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(35) NOT NULL,
    CONSTRAINT pk_Taille PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `TypeEcran` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(35) NOT NULL,
    CONSTRAINT pk_TypeEcran PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Model` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(35) NOT NULL,
    CONSTRAINT pk_Model PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Produit` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(128) NOT NULL,
    `resume` varchar(100),
    `description` varchar(500),
    `pathPhoto` varchar(100) NOT NULL,
    `qteEnStock` integer NOT NULL,
    `qteLimite` integer,
    `prixVenteUHT` DECIMAL(10,2) NOT NULL,
	`idModel` INTEGER,
    `idMarque` INTEGER,
    `idTaille` INTEGER,
    `idType` INTEGER,
    CONSTRAINT fk_Produit_Marque FOREIGN KEY(`idMarque`)
                                           REFERENCES Marque(`id`),
    CONSTRAINT fk_Produit_Taille FOREIGN KEY(`idTaille`)
                                           REFERENCES Taille(`id`),
    CONSTRAINT fk_Produit_TypeEcran FOREIGN KEY(`idType`)
                                           REFERENCES TypeEcran(`id`),
    CONSTRAINT fk_Produit_Model FOREIGN KEY(`idModel`)
                                           REFERENCES Model(`id`),
    CONSTRAINT pk_Produit PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Role` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(40),
	CONSTRAINT pk_Role PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE IF NOT EXISTS `User` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `nom` varchar(40) NOT NULL,
    `prenom` varchar(40) NOT NULL,
    `dateNaissance` date NOT NULL,
    `numeroTelephone` varchar(10),
    `adresse` varchar(100) NOT NULL,
    `ville` varchar(50) NOT NULL,
    `codePoste` varchar(5) NOT NULL,
    `adresseMail` varchar(50) NOT NULL,
    `motDePasse` text NOT NULL,
    `idRole` integer,
    CONSTRAINT pk_User PRIMARY KEY (`id`),
    CONSTRAINT fk_User_Role FOREIGN KEY(`idRole`)
                                           REFERENCES Role(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `ModePaiement` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(20) NOT NULL,
    CONSTRAINT pk_ModePaiement PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Commande` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `idModePaiement` integer NOT NULL,
    `idUser` integer NOT NULL,
    CONSTRAINT pk_Commande PRIMARY KEY (`id`),
    CONSTRAINT fk_Produit_Commande FOREIGN KEY(`idUser`)
                                           REFERENCES User(`id`),
    CONSTRAINT fk_Commande_ModePaiement FOREIGN KEY(`idModePaiement`)
                                           REFERENCES ModePaiement(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `DetailCommande`(
`idProduit` INTEGER NOT NULL,
`idCommande` INTEGER NOT NULL, 
`qte` INTEGER NOT NULL,
CONSTRAINT pk_Detailcommande PRIMARY KEY (`idCommande`,`idProduit`),
CONSTRAINT fk_Detailscommandes_Produit FOREIGN KEY (`idProduit`)
                                                   REFERENCES Produit(`id`),
CONSTRAINT fk_Detailscommandes_Commandes FOREIGN KEY (`idCommande`)
                                                   REFERENCES Commande(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `StatutCommande` (
    `id` integer NOT NULL AUTO_INCREMENT,
    `libelle` varchar(35) NOT NULL,
    CONSTRAINT pk_Statut PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `Posseder` (
    `idStatut` integer NOT NULL,
    `idCommande` integer NOT NULL,
    `datePosseder` date NOT NULL,
    CONSTRAINT pk_Posseder PRIMARY KEY (`idStatut`,`idCommande`),
    CONSTRAINT fk_posseder_Commande FOREIGN KEY(`idCommande`)
                                           REFERENCES Commande(`id`),
    CONSTRAINT fk_Cosseder_Statut FOREIGN KEY(`idStatut`)
                                           REFERENCES StatutCommande(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


/*----------------------------------------------------------------------------------------*/

/*Les Marques*/
INSERT INTO Role (`libelle`)
VALUES ('Client'),
	   ('Admin'),
	   ('AdminGestionCommande');
	   
/*Les Users*/
INSERT INTO User (`nom`,`prenom`,`dateNaissance`,`numeroTelephone`,`adresse`,`ville`,`codePoste`,`adresseMail`, `motDePasse`,`idRole`)
VALUES ('FAURE','Bryce','2003-09-01','0613637632','adresse-FAURE-Bryce','Montpellier','34090','faurebryce@gmail.com','ABCD','1'),
	   ('DUGAS','Adeline','2003-04-06','0666384741','adresse-DUGAS-Adeline','Montpellier','34000','adelinegudas@gmail.com','EFGH','1'),
	   ('RALLI','Félix','2003-04-16','0638399075','adresse-RALLI-Félix','Montpellier','34080','rallifelix@gmail.com','IJKL','1'),
	   ('HO','Bob','2000-08-16','0638377076','adresse-HO-Bob','Gap','34080','BobHo@gmail.com','MNOP','1'),
	   ('MALE','ANNIE','2001-05-13','0634499076','adresse-MALE-Annie','Gap','05000','anniemale@gmail.com','dd94709528bb1c83d08f3088d4043f4742891f4f','3'),
	   ('FAURE','Bryce','2001-05-13','0634499076','adresse-FAURE-Bryce2','Gap','05500','f@gmail.com','dd94709528bb1c83d08f3088d4043f4742891f4f','2');
	   

/*Les Marques*/
INSERT INTO Marque (`libelle`)
VALUES ('Samsung'),
	   ('LG'),
	   ('TCL'),
	   ('Hisense'),
	   ('Philips'),
	   ('Panasonic'),
	   ('Blaupunkt');
	   
	
/*Les Tailles*/
INSERT INTO Taille (`libelle`)
VALUES ('27'),
	   ('32'),
	   ('40'),
	   ('43'),
	   ('48'),
	   ('50'),
	   ('55'),
	   ('58'),
	   ('65'),
	   ('70'),
	   ('75'),
	   ('77'),
	   ('82'),
	   ('83'),
	   ('85'),
	   ('86');
	   
	   
/*Les Types Ecrans*/
INSERT INTO TypeEcran (`libelle`)
VALUES ('LED'),
	   ('MiniLED'),
	   ('OLED'),
	   ('QLED');
	   
	   
/*Les Models*/
INSERT INTO Model (`libelle`)
VALUES ('Blaupunkt BNU2132FEB'),
	   ('LG QNED916PA'),
	   ('LG OLEDC1'),
	   ('Samsung QLED QEQ65A');
	   
	   
/*Les Produits*/
INSERT INTO Produit (`idModel`,`libelle`,`resume`,`description`,`pathPhoto`,`qteEnStock`,`qteLimite`,`prixVenteUHT`,`idMarque`,`idTaille`,`idType`)
VALUES ((SELECT id FROM Model WHERE libelle = 'Blaupunkt BNU2132FEB'),'Blaupunkt BN43U2132FEB','Téléviseur LED 4K UHD 43" (109 cm) 16/9 - 3x HDMI - 2x USB - Son 2.0 16W','Avec son design épuré et ses pieds latéraux, la TV 4K UHD Blaupunkt BN43U2132FEB s\'intègre idéalement dans votre intérieur pour vous donner accès à un divertissement de haute qualité. Ce modèle est équipé d\'une connectique optimale pour faciliter son installation et d\'un système audio stéréo.','img/produit/led/1-produit/1img.jpg','5','2','339.95',(SELECT id FROM Marque WHERE libelle = 'Blaupunkt'),(SELECT id FROM Taille WHERE libelle = '43'),(SELECT id FROM TypeEcran WHERE libelle = 'LED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG QNED916PA'),'LG 65QNED916PA','Téléviseur QNED Mini LED 4K UHD 65" (165 cm) - 100 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - FreeSync Premium - HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','La TV 4K HDR LG QNED Mini LED 65QNED916PA hisse votre divertissement vers de nouveaux sommets en associant les technologies Mini LED, Quantum Dot et NanoCell Plus. Cette Smart TV de 65 pouces offre également un environnement gaming optimal et un système audio 2.2 canaux immersif.','img/produit/miniled/1-produit/1img.jpg','2','2','1498.99',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '65'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG QNED916PA'),'LG 75QNED916PA','Téléviseur QNED Mini LED 4K UHD 75" (190 cm) - 100 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - FreeSync Premium - HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','La TV 4K HDR LG QNED Mini LED 75QNED916PA hisse votre divertissement vers de nouveaux sommets en associant les technologies Mini LED, Quantum Dot et NanoCell Plus. Cette Smart TV de 75 pouces offre également un environnement gaming optimal et un système audio 2.2 canaux immersif.','img/produit/miniled/1-produit/1img.jpg','3','2','1899.01',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '75'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG OLEDC1'),'LG OLED55C1','Téléviseur OLED 4K UHD 55" (140 cm) - 100 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - G-Sync/FreeSync Premium - 4x HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','Le téléviseur LG OLED55C1 propulsé par le processeur 4K Alpha 9 Gen 4 offre une image 4K UHD avec Dolby Vision IQ et HDR10 Pro, un son puissant de 40 W avec Dolby Atmos et AI Sound Pro 5.1.2 et des performances gaming élevées avec HDMI 2.1, dalle 100 Hz et certifications G-SYNC et FreeSync Premium.','img/produit/oled/1-produit/1img.jpg','8','2','1168.99',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '55'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung QLED QEQ65A'),'Samsung QLED QE75Q65A','Téléviseur QLED 4K 75" (190 cm) - HDR - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.0 / ALLM - Son 2.0 20W','Une qualité visuelle supérieure vous attend grâce au téléviseur QLED QE75Q65A signé Samsung. Ce modèle de 75 pouces délivre une image 4K HDR des plus agréables avec des couleurs riches via Quantum Dots et un rétro-éclairage optimisé avec Dual LED.','img/produit/qled/1-produit/1img.jpg','1','1','1299.95',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '75'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED'));



/*Les Mode de Paiement*/
INSERT INTO ModePaiement (`libelle`)
VALUES ('Carte Bancaire'),
	   ('Virement Bancaire'),
	   ('Paypal');


/*Les Commandes*/
INSERT INTO Commande (`idModePaiement`,`idUser`)
VALUES ((SELECT id from ModePaiement where libelle = 'Carte Bancaire'),(SELECT id from User where adresseMail = 'faurebryce@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Virement Bancaire'),(SELECT id from User where adresseMail = 'adelinegudas@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Paypal'),(SELECT id from User where adresseMail = 'rallifelix@gmail.com'));
   

/*Les Details Commandes*/
INSERT INTO DetailCommande (`idProduit`,`idCommande`,`qte`)
VALUES ((Select id from Produit where libelle = 'Samsung QLED QE75Q65A'),(select Co.id from commande Co join User U on Co.idUser = U.id where adresseMail = 'faurebryce@gmail.com' ),'2'),
	   ((Select id from Produit where libelle = 'Blaupunkt BN43U2132FEB'),(select Co.id from commande Co join User U on Co.idUser = U.id where adresseMail = 'adelinegudas@gmail.com' ),'1'),
	   ((Select id from Produit where libelle = 'LG OLED55C1'),(select Co.id from commande Co join User U on Co.idUser = U.id where adresseMail = 'rallifelix@gmail.com' ),'4');
	   
	   
	   
/*Les Statut Commande*/
INSERT INTO StatutCommande (`libelle`)
VALUES ('non validée'),
	   ('préparation'),
	   ('pris en charge'),
	   ('en cours d\'acheminement'),
	   ('livré');
	   
	   
/*Les Statut Commande*/
INSERT INTO Posseder (`idStatut`, `idCommande`, `datePosseder`)
VALUES (1,1,'2022-12-01'),
	   (2,2,'2022-11-01'),
	   (3,2,'2022-12-04'),
	   (4,2,'2022-12-29'),
	   (5,2,'2023-01-04');
	   