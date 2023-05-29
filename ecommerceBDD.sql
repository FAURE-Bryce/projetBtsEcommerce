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
    CONSTRAINT fk_user_Commande FOREIGN KEY(`idUser`)
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
VALUES ('FAURE','Bryce','2003-09-01','0613637632','adresse-FAURE-Bryce','Montpellier','34090','fayce@gmail.com','ABCD','1'),
	   ('DUGAS','Adeline','2003-04-06','0666384741','adresse-DUGAS-Adeline','Montpellier','34000','adelineudas@gmail.com','EFGH','1'),
	   ('RALLI','Félix','2003-04-16','0638390075','adresse-RALLI-Félix','Montpellier','34080','rallix@gmail.com','IJKL','1'),
	   ('HO','Bob','2000-08-16','0638477076','adresse-HO-Bob','Gap','34080','BobHo@gmail.com','MNOP','1'),
	   ('MALE','ANNIE','2001-05-13','0634419076','adresse-MALE-Annie','Gap','05000','anniemale@gmail.com','dd94709528bb1c83d08f3088d4043f4742891f4f','3'),
	   ('JAGER','Eren','2001-05-13','0634419076','ile du paradis','Madagascar','12345','client@gmail.com','$2y$10$KJgqxCTnF6TLR4fLVyp7SeHT.OBd2tnM1m9Jrfd4xefz4d7hWyVBS','1'),
	   ('DRAKE','Nathan','1999-05-23','0621419076','adresse-Nathan-Drake','Paris','75003','admin@gmail.com','$2y$10$xYKXa6mZ3pt03a2ZsWs4E.dXCkZaKHTTyDTEec1XBt9Yvzk.Cwd2K','2'),
	   ('FAURE','Bryce','2001-05-13','0636499076','adresse-FAURE-Bryce2','Gap','05500','b@gmail.com','$2y$10$v7VFRBJJ3wtHDV26HRUyYuLPl4/k0AUJr2zoUJgk.GjZvTelWiuZq','1');
	   

/*Les Marques*/
INSERT INTO Marque (`libelle`)
VALUES ('Samsung'),
	   ('LG'),
	   ('TCL'),
	   ('Hisense'),
	   ('Philips'),
	   ('Panasonic'),
	   ('Sony'),
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
	   ('86'),
	   ('96'),
	   ('98');
	   
	   
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
	   ('Philips The One PUS8807'),
	   ('Sony KD-X85K'),
	   ('Samsung LED UEBU8005'),
	   ('Sony KD-X81K'),
	   ('TCL P735'),
	   ('Hisense U8HQ'),
	   ('Samsung Neo QLED QEQN85B'),
	   ('Samsung Neo QLED QN90C'),
	   ('TCL C935'),
	   ('Samsung Neo QLED QN85C'),
	   ('Panasonic TX-LZ2000E'),
	   ('Philips OLED807'),
	   ('Sony XR-A95K'),
	   ('Samsung OLED TQS90C'),
	   ('LG OLEDCS'),
	   ('Samsung The Terrace QELST7T'),
	   ('TCL C735'),
	   ('TCL C835'),
	   ('TCL C635'),
	   ('Samsung Q50A'),
	   ('Samsung QLED QEQ65A');
	   
	   
/*Les Produits*/
INSERT INTO Produit (`idModel`,`libelle`,`resume`,`description`,`pathPhoto`,`qteEnStock`,`qteLimite`,`prixVenteUHT`,`idMarque`,`idTaille`,`idType`)
VALUES ((SELECT id FROM Model WHERE libelle = 'Blaupunkt BNU2132FEB'),'Blaupunkt BN43U2132FEB','Téléviseur LED 4K UHD 43" (109 cm) 16/9 - 3x HDMI - 2x USB - Son 2.0 16W','Avec son design épuré et ses pieds latéraux, la TV 4K UHD Blaupunkt BN43U2132FEB s\'intègre idéalement dans votre intérieur pour vous donner accès à un divertissement de haute qualité. Ce modèle est équipé d\'une connectique optimale pour faciliter son installation et d\'un système audio stéréo.','img/produit/led/1-produit/1img.jpg','5','2','339.95',(SELECT id FROM Marque WHERE libelle = 'Blaupunkt'),(SELECT id FROM Taille WHERE libelle = '43'),(SELECT id FROM TypeEcran WHERE libelle = 'LED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG QNED916PA'),'LG 65QNED916PA','Téléviseur QNED Mini LED 4K UHD 65" (165 cm) - 100 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - FreeSync Premium - HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','La TV 4K HDR LG QNED Mini LED 65QNED916PA hisse votre divertissement vers de nouveaux sommets en associant les technologies Mini LED, Quantum Dot et NanoCell Plus. Cette Smart TV de 65 pouces offre également un environnement gaming optimal et un système audio 2.2 canaux immersif.','img/produit/miniled/1-produit/1img.jpg','2','2','1498.99',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '65'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG QNED916PA'),'LG 75QNED916PA','Téléviseur QNED Mini LED 4K UHD 75" (190 cm) - 100 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - FreeSync Premium - HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','La TV 4K HDR LG QNED Mini LED 75QNED916PA hisse votre divertissement vers de nouveaux sommets en associant les technologies Mini LED, Quantum Dot et NanoCell Plus. Cette Smart TV de 75 pouces offre également un environnement gaming optimal et un système audio 2.2 canaux immersif.','img/produit/miniled/1-produit/1img.jpg','3','2','1899.01',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '75'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG OLEDC1'),'LG OLED55C1','Téléviseur OLED 4K UHD 55" (140 cm) - 100 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - G-Sync/FreeSync Premium - 4x HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','Le téléviseur LG OLED55C1 propulsé par le processeur 4K Alpha 9 Gen 4 offre une image 4K UHD avec Dolby Vision IQ et HDR10 Pro, un son puissant de 40 W avec Dolby Atmos et AI Sound Pro 5.1.2 et des performances gaming élevées avec HDMI 2.1, dalle 100 Hz et certifications G-SYNC et FreeSync Premium.','img/produit/oled/1-produit/1img.jpg','8','2','1168.99',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '55'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung QLED QEQ65A'),'Samsung QLED QE75Q65A','Téléviseur QLED 4K 75" (190 cm) - HDR - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.0 / ALLM - Son 2.0 20W','Une qualité visuelle supérieure vous attend grâce au téléviseur QLED QE75Q65A signé Samsung. Ce modèle de 75 pouces délivre une image 4K HDR des plus agréables avec des couleurs riches via Quantum Dots et un rétro-éclairage optimisé avec Dual LED.','img/produit/qled/1-produit/1img.jpg','1','1','1299.95',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '75'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED'));
  
/*Nouveaux Led Produits*/
INSERT INTO Produit (`idModel`,`libelle`,`resume`,`description`,`pathPhoto`,`qteEnStock`,`qteLimite`,`prixVenteUHT`,`idMarque`,`idTaille`,`idType`)
VALUES ((SELECT id FROM Model WHERE libelle = 'Philips The One PUS8807'),'Philips The One 86PUS8807','Téléviseur LED 4K 86" (217 cm) - 120 Hz - Dolby Vision/HDR10+ - Wi-Fi/Bluetooth - 2 x HDMI 2.1 - Android TV - Google Assistant - Ambilight 3 côtés - Son 2.0 20W Dolby Atmos','Gaming 4K/120 Hz, divertissement connecté, immersion Ambilight et image 4K HDR, le téléviseur Philips 86PUS8807 ne vous laissera pas indifférent ! Profitez d\'un rendu exceptionnel, d\'une belle fluidité et d\'une connectique complète en plus d\'une fonction Smart TV Android TV.','img/produit/led/2-produit/1img.jpg','12','2','2599.23',(SELECT id FROM Marque WHERE libelle = 'Philips'),(SELECT id FROM Taille WHERE libelle = '86'),(SELECT id FROM TypeEcran WHERE libelle = 'LED')),
	   ((SELECT id FROM Model WHERE libelle = 'Sony KD-X85K'),'Sony KD-85X85K','Téléviseur LED 4K 85" (215 cm) - 100 Hz - HDR Dolby Vision - Google TV - Wi-Fi/Bluetooth/AirPlay 2 - Google Assistant - 2x HDMI 2.1 - Son 2.0 20W Dolby Atmos','Le téléviseur Sony KD-85X85K propose une fluidité native de 100 Hz (120 Hz en optimisation), un système audio stéréo immersif avec prise en charge Dolby Atmos et une fonction Smart TV avec Google TV et Assistant Google. 2 connecteurs HDMI 2.1 avec fonctions VRR et ALLM sont présents pour les gamers.','img/produit/led/3-produit/1img.jpg','21','5','1999.94',(SELECT id FROM Marque WHERE libelle = 'Sony'),(SELECT id FROM Taille WHERE libelle = '85'),(SELECT id FROM TypeEcran WHERE libelle = 'LED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung LED UEBU8005'),'Samsung LED UE85BU8005','Téléviseur LED 4K 85" (215 cm) - HDR10+ - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.0 / ALLM - Son 2.0 20W','Avec le téléviseur 4K HDR Samsung 85BU8005, votre divertissement passe un nouveau cap. Bénéficiez d\'une qualité d\'image supérieure, d\'un système audio performant et de fonctionnalités connectées complètes. Ultra-fin, ce modèle se pare également de pieds ajustables pour une installation optimisée.','img/produit/led/4-produit/1img.jpg','14','5','1689.90',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '85'),(SELECT id FROM TypeEcran WHERE libelle = 'LED')),
	   ((SELECT id FROM Model WHERE libelle = 'Sony KD-X81K'),'Sony KD-43X81K','Téléviseur LED 4K 43" (109 cm) - HDR Dolby Vision - Google TV - Wi-Fi/Bluetooth/AirPlay 2 - Google Assistant - Son 2.0 20W Dolby Atmos','Installez-vous confortablement et bénéficiez d\'un divertissement 4K HDR connecté avec le téléviseur Sony KD-43X81K ! Avec ses lignes épurées, ses trois bords fins et ses technologies embarquées, ce modèle dévoile un large potentiel pour satisfaire toutes vos envies au quotidien.','img/produit/led/5-produit/1img.jpg','6','1','749.95',(SELECT id FROM Marque WHERE libelle = 'Sony'),(SELECT id FROM Taille WHERE libelle = '43'),(SELECT id FROM TypeEcran WHERE libelle = 'LED')),
	   ((SELECT id FROM Model WHERE libelle = 'TCL P735'),'TCL 85P735','Téléviseur LED 4K UHD 85" (215 cm) - Dolby Vision/HDR10+ - Google TV - Wi-Fi/Bluetooth - Son 2.0 30W Dolby Atmos','Diagonale de 85 pouces, spectacle 4K HDR, le téléviseur TCL 85P735 dévoile des qualités XXL pour transformer votre quotidien. Bénéficiez d\'un système audio stéréo compatible Dolby Atmos, appréciez le contenu connecté depuis Google TV et découvrez un équipement aux lignes élégantes.','img/produit/led/6-produit/1img.jpg','20','2','1290.23',(SELECT id FROM Marque WHERE libelle = 'TCL'),(SELECT id FROM Taille WHERE libelle = '85'),(SELECT id FROM TypeEcran WHERE libelle = 'LED'));

/*Nouveaux MiniLed Produits*/
INSERT INTO Produit (`idModel`,`libelle`,`resume`,`description`,`pathPhoto`,`qteEnStock`,`qteLimite`,`prixVenteUHT`,`idMarque`,`idTaille`,`idType`)
VALUES ((SELECT id FROM Model WHERE libelle = 'Hisense U8HQ'),'Hisense 55U8HQ','Le téléviseur Mini LED QLED Hisense 55UH8Q se montre à la hauteur de vos attentes avec son image 4K UHD de 140 cm, sa prise en charge HDR10+ Adaptive et Dolby Vision IQ et son système audio 2.1.2 canaux de 70 Watts. Profitez d\'un équipement de jeu optimisé (120 Hz, HDMI 2.1, FreeSync Premium).','Le téléviseur Mini LED QLED Hisense 55UH8Q se montre à la hauteur de vos attentes avec son image 4K UHD de 140 cm, sa prise en charge HDR10+ Adaptive et Dolby Vision IQ et son système audio 2.1.2 canaux de 70 Watts. Profitez d\'un équipement de jeu optimisé (120 Hz, HDMI 2.1, FreeSync Premium).','img/produit/miniled/2-produit/1img.jpg','31','5','689.99',(SELECT id FROM Marque WHERE libelle = 'Hisense'),(SELECT id FROM Taille WHERE libelle = '55'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung Neo QLED QEQN85B'),'Samsung Neo QLED QE55QN85B','Téléviseur Mini LED 4K 55" (140 cm) - Dalle 100 Hz - HDR10+ Adaptive - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.1/FreeSync - Son 2.2.2 60W - Dolby Atmos sans fil','Associez les technologies Quantum Dots et Mini LED et profitez d\'un spectacle inoubliable avec le téléviseur Samsung 55QN85B ! Ce modèle délivre une image 4K UHD avec prise en charge HDR10+ Adaptive et se pare d\'un système audio performant de 60 Watts avec compatibilité Dolby Atmos via Wi-Fi.','img/produit/miniled/3-produit/1img.jpg','12','1','990.00',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '55'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung Neo QLED QN90C'),'Samsung Neo QLED 43QN90C','Téléviseur Mini LED 4K 43" (108 cm) - 144 Hz - HDR10+ Adaptive - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.1 / FreeSync - Son 2.0 20W - Dolby Atmos sans fil','Le téléviseur QN90C Serie 9 de Samsung associe les technologies Quantum Dots et Mini LED pour vous faire profiter d\'une expérience vidéoludique inoubliable ! Ce modèle vous offre une image 4K UHD avec prise en charge HDR10+ Adaptive.','img/produit/miniled/4-produit/1img.jpg','20','3','1289.95',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '43'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'TCL C935'),'TCL 75C935','Téléviseur Mini LED OD5 QLED 4K UHD 75" (190 cm) - 144 Hz - Dolby Vision IQ/HDR10+ - Google TV - Wi-Fi AX/Bluetooth 5.0 - Assistant Google - 4x HDMI 2.1 - FreeSync Premium Pro - Son 2.1.2 90W Dolby Atmos','Votre divertissement voit son potentiel augmenté en présence du téléviseur TCL 75C935. Ce modèle 75 pouces offre un spectacle exceptionnel avec résolution 4K HDR, rétro-éclairage Mini LED OD5, technologie Quantum Dot et système audio Onkyo 2.1.2 canaux 90 Watts.','img/produit/miniled/5-produit/1img.jpg','11','5','2490.25',(SELECT id FROM Marque WHERE libelle = 'TCL'),(SELECT id FROM Taille WHERE libelle = '75'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung Neo QLED QN85C'),'Samsung Neo QLED 55QN85C','Téléviseur Mini LED 4K 55" (138 cm) - Dalle 100 Hz - HDR10+ Adaptive - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.1/FreeSync - Son 2.2.2 60W - Dolby Atmos sans fil','Le téléviseur QN85C Serie 8 de Samsung associe les technologies Quantum Dots et Mini LED pour vous faire profiter d\'une expérience vidéoludique inoubliable ! Ce modèle vous offre une image 4K UHD avec prise en charge HDR10+ Adaptive.','img/produit/miniled/6-produit/1img.jpg','13','2','1789.94',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '55'),(SELECT id FROM TypeEcran WHERE libelle = 'MiniLED'));
  
/*Nouveaux OLed Produits*/
INSERT INTO Produit (`idModel`,`libelle`,`resume`,`description`,`pathPhoto`,`qteEnStock`,`qteLimite`,`prixVenteUHT`,`idMarque`,`idTaille`,`idType`)
VALUES ((SELECT id FROM Model WHERE libelle = 'Panasonic TX-LZ2000E'),'Panasonic TX-77LZ2000E','Téléviseur OLED 4K UHD 77" (195 cm) - 100 Hz - Dolby Vision IQ/HDR10+ Adaptive - HDMI 2.1 - AMD FreeSync Premium - Wi-Fi/Bluetooth - Google Assistant/Alexa - Son 4.1.2 170W Dolby Atmos','Porté par une dalle OLED à haute luminosité et système audio 4.1.2 canaux de 170 Watts, le téléviseur Panasonic TX-77LZ2000 combine l\'excellence de l\'image et l\'immersion sonore. Profitez alors d\'un spectacle saisissant avec en prime une image 4K multi-HDR et une section gaming évoluée.','img/produit/oled/2-produit/1img.jpg','17','3','4999.99',(SELECT id FROM Marque WHERE libelle = 'Panasonic'),(SELECT id FROM Taille WHERE libelle = '77'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Philips OLED807'),'Philips 77OLED807','TV OLED-EX 4K 77" (195 cm) - 120 Hz - Dolby Vision/HDR10+ Adaptive - IMAX Enhanced - HDMI 2.1 - FreeSync/G-Sync Compatible - Wi-Fi/Bluetooth - Android TV - Google Assistant - Ambilight 4 côtés - Son 2.1 70W Dolby Atmos','Laissez-vous transporter vers un divertissement immersif avec une qualité d\'image incroyable en installant le téléviseur Philips 77OLED807 dans votre salon. Profitez alors d\'une image 4K HDR avec processeur ultra-performant, du système Ambilight sur 4 côtés et d\'une section gaming supérieure.','img/produit/oled/3-produit/1img.jpg','12','1','3990.21',(SELECT id FROM Marque WHERE libelle = 'Philips'),(SELECT id FROM Taille WHERE libelle = '77'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Sony XR-A95K'),'Sony XR-65A95K','Téléviseur QD-OLED 4K 65" (165 cm) - 100 Hz - HDR Dolby Vision - Google TV - Wi-Fi/Bluetooth/AirPlay - Google Assistant - 2 x HDMI 2.1 - Son 2.2 60W Dolby Atmos','Le confort de l\'OLED avec la luminosité en plus, le téléviseur QD-OLED Sony XR-65A95K possède de belles qualités pour transformer votre divertissement quotidien. Ce modèle 4K UHD Dolby Vision de 65" possède des fonctions connectées Google TV et une section gaming performante avec 2 ports HDMI 2.1.','img/produit/oled/4-produit/1img.jpg','40','10','3499.94',(SELECT id FROM Marque WHERE libelle = 'Sony'),(SELECT id FROM Taille WHERE libelle = '65'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung OLED TQS90C'),'Samsung OLED TQ65S90C','Téléviseur OLED 4K 65" (165 cm) - 100 Hz - HDR10+ Gaming - Wi-Fi/Bluetooth/AirPlay 2 - HDMI 2.1/FreeSync Premium - Son 2.1 40W - Dolby Atmos sans fil','Le téléviseur OLED Samsung TQ65S90C va vous permettre de vivre des moments de divertissement intenses grâce à des noirs plus profonds et des couleurs plus éclatantes. Les noirs plus purs et les contrastes plus profonds vous plongent au coeur d\'une expérience cinématographique unique.','img/produit/oled/5-produit/1img.jpg','12','3','2789.95',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '65'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED')),
	   ((SELECT id FROM Model WHERE libelle = 'LG OLEDCS'),'LG OLED77CS','Téléviseur OLED 4K UHD 77" (195 cm) - 120 Hz - Dolby Vision IQ - Wi-Fi/Bluetooth/AirPlay 2 - G-Sync/FreeSync Premium - 4x HDMI 2.1 - Google Assistant/Alexa - Son 2.2 40W Dolby Atmos','Le téléviseur LG OLED77CS vous propose une expérience inoubliable. Que ce soit pour le jeu ou pour les films, retrouvez une qualité d\'image supérieure 4K HDR Dolby Vision IQ, un système audio 2.2 canaux compatible Dolby Atmos, des fonctionnalités gaming optimales et un système connecté webOS 22.','img/produit/oled/6-produit/1img.jpg','36','4','2499.99',(SELECT id FROM Marque WHERE libelle = 'LG'),(SELECT id FROM Taille WHERE libelle = '77'),(SELECT id FROM TypeEcran WHERE libelle = 'OLED'));

  
/*Nouveaux QLed Produits*/
INSERT INTO Produit (`idModel`,`libelle`,`resume`,`description`,`pathPhoto`,`qteEnStock`,`qteLimite`,`prixVenteUHT`,`idMarque`,`idTaille`,`idType`)
VALUES ((SELECT id FROM Model WHERE libelle = 'Samsung The Terrace QELST7T'),'Samsung The Terrace QE75LST7T','TV extérieur QLED 4K 75" (190 cm) - 100 Hz - Full LED Local Dimming - 2000 cd/m² - HDR10+ - Wi-Fi/Bluetooth/AirPlay 2 - Son 2.0.20W - Anti-reflet - IP55','Le téléviseur d\'extérieur Samsung The Terrace 75" (QE75LST7T) assure une expérience très agréable en 4K HDR même dans les environnements lumineux. Luminosité maximale de 2000 cd/m², technologie anti-reflet et conception IP55, installez ce modèle pour une utilisation outdoor en toute sérénité.','img/produit/oled/2-produit/1img.jpg','37','10','4999.99',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '75'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED')),
	   ((SELECT id FROM Model WHERE libelle = 'TCL C735'),'TCL 98C735','TV QLED 4K UHD 98" (248 cm) - 144 Hz - Dolby Vision IQ/HDR10+ - Google TV - Wi-Fi AC/Bluetooth 5.0 - Assistant Google - 4x HDMI 2.1 - FreeSync Premium - Son 2.1 70W Dolby Atmos','Parfait pour le divertissement et idéal pour le gaming, la TV 98C735 signée TCL possède toutes les qualités pour accompagner toutes vos envies. Profitez d\'une fluidité exceptionnelle de 144 Hz, d\'une résolution 4K avec prise en charge HDR étendue et d\'une connectique complète.','img/produit/oled/3-produit/1img.jpg','21','3','3999.99',(SELECT id FROM Marque WHERE libelle = 'TCL'),(SELECT id FROM Taille WHERE libelle = '98'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED')),
	   ((SELECT id FROM Model WHERE libelle = 'TCL C835'),'TCL 65C835','Téléviseur Mini LED QLED 4K UHD 65" (165 cm) - 144 Hz - Dolby Vision IQ/HDR10+ - Google TV - Wi-Fi AX/Bluetooth 5.0 - Assistant Google - 4x HDMI 2.1 - FreeSync Premium Pro - Son 2.1 60W Dolby Atmos','Votre divertissement voit son potentiel augmenté en présence du téléviseur TCL 65C835. Ce modèle 65 pouces offre un spectacle exceptionnel avec résolution 4K HDR, rétro-éclairage Mini LED, technologie Quantum Dot et système audio Onkyo 2.1 canaux 60 Watts.','img/produit/oled/4-produit/1img.jpg','40','5','1090.19',(SELECT id FROM Marque WHERE libelle = 'TCL'),(SELECT id FROM Taille WHERE libelle = '65'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED')),
	   ((SELECT id FROM Model WHERE libelle = 'TCL C635'),'TCL 55C635','Téléviseur QLED 4K UHD 55" (140 cm) - Dolby Vision/HDR10+ - Google TV - Wi-Fi/Bluetooth - Assistant Google - 3x HDMI 2.1 - Son 2.0 20W Dolby Atmos','Offrez-vous un divertissement de haute qualité avec le téléviseur TCL 55C635. Equipé de la technologie QLED, d\'une résolution 4K UHD et d\'une prise en charge HDR étendue, ce modèle de 55 pouces possède toutes les qualités pour sublimer vos journées et soirées.','img/produit/oled/5-produit/1img.jpg','45','10','549.99',(SELECT id FROM Marque WHERE libelle = 'TCL'),(SELECT id FROM Taille WHERE libelle = '55'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED')),
	   ((SELECT id FROM Model WHERE libelle = 'Samsung Q50A'),'Samsung 32Q50A','Téléviseur QLED Full HD 32" (81 cm) - Quantum HDR - Wi-Fi/Bluetooth - Son 2.0 20W','Profitez d\'une expérience Smart TV QLED sans limite avec ce téléviseur Samsung 32Q50A. Laissez parler votre curiosité et votre émerveillement en faisant la découverte de sublimes images Full HD enrichies par le HDR.','img/produit/oled/6-produit/1img.jpg','15','3','449.95',(SELECT id FROM Marque WHERE libelle = 'Samsung'),(SELECT id FROM Taille WHERE libelle = '32'),(SELECT id FROM TypeEcran WHERE libelle = 'QLED'));

/*Les Mode de Paiement*/
INSERT INTO ModePaiement (`libelle`)
VALUES ('Carte Bancaire'),
	   ('Virement Bancaire'),
	   ('Paypal');


/*Les Commandes*/
INSERT INTO Commande (`idModePaiement`,`idUser`)
VALUES ((SELECT id from ModePaiement where libelle = 'Carte Bancaire'),(SELECT id from User where adresseMail = 'fayce@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Virement Bancaire'),(SELECT id from User where adresseMail = 'adelineudas@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Virement Bancaire'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Paypal'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Carte Bancaire'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Virement Bancaire'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Paypal'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Carte Bancaire'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Virement Bancaire'),(SELECT id from User where adresseMail = 'client@gmail.com')),
	   ((SELECT id from ModePaiement where libelle = 'Paypal'),(SELECT id from User where adresseMail = 'rallix@gmail.com'));
   

/*Les Details Commandes*/
INSERT INTO DetailCommande (`idProduit`,`idCommande`,`qte`)
VALUES ((Select id from Produit where libelle = 'Samsung QLED QE75Q65A'),'1','2'),
       ((Select id from Produit where libelle = 'Samsung QLED QE75Q65A'),'2','2'),
	   ((Select id from Produit where libelle = 'Samsung Neo QLED QE55QN85B'),'3','4'),
	   ((Select id from Produit where libelle = 'TCL 75C935'),'4','1'),
	   ((Select id from Produit where libelle = 'Sony KD-85X85K'),'4','2'),
	   ((Select id from Produit where libelle = 'Philips The One 86PUS8807'),'5','3'),
	   ((Select id from Produit where libelle = 'LG OLED55C1'),'6','1'),
	   ((Select id from Produit where libelle = 'Blaupunkt BN43U2132FEB'),'7','5'),
	   ((Select id from Produit where libelle = 'TCL 65C835'),'8','10'),
	   ((Select id from Produit where libelle = 'LG OLED55C1'),'9','1'),
	   ((Select id from Produit where libelle = 'TCL 98C735'),'9','5'),
	   ((Select id from Produit where libelle = 'TCL 55C635'),'9','10'),
	   ((Select id from Produit where libelle = 'LG OLED55C1'),'10','4');
	   
	   
	   
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
	   (5,2,'2023-01-04'),
	   (2,3,'2022-11-01'),
	   (3,3,'2022-12-04'),
	   (4,3,'2022-12-29'),
	   (5,3,'2023-01-04'),
	   (2,4,'2022-11-01'),
	   (3,4,'2022-12-04'),
	   (4,4,'2022-12-29'),
	   (5,4,'2023-01-04'),
	   (2,5,'2022-11-01'),
	   (3,5,'2022-12-04'),
	   (4,5,'2022-12-29'),
	   (5,5,'2023-01-04'),
	   (2,6,'2022-11-01'),
	   (3,6,'2022-12-04'),
	   (4,6,'2022-12-29'),
	   (5,6,'2023-01-04'),
	   (2,7,'2022-11-01'),
	   (3,7,'2022-12-04'),
	   (4,7,'2022-12-29'),
	   (5,7,'2023-01-04'),
	   (2,8,'2022-11-01'),
	   (3,8,'2022-12-04'),
	   (4,8,'2022-12-29'),
	   (5,8,'2023-01-04'),
	   (2,9,'2022-11-01'),
	   (3,9,'2022-12-04'),
	   (4,9,'2022-12-29'),
	   (5,9,'2023-01-04'),
	   (2,10,'2022-11-01'),
	   (3,10,'2022-12-04'),
	   (4,10,'2022-12-29'),
	   (5,10,'2023-01-04');
	   
