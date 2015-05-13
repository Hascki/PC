-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.24 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table proiectcolectiv.categorie
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `Type` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `CatName` varchar(30) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`Type`),
  UNIQUE KEY `CatName` (`CatName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Tipurile de vehicule';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.chat
DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `ChatId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IdAnunt` int(11) unsigned NOT NULL,
  `UserId` int(11) unsigned NOT NULL,
  `Text` text COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`ChatId`),
  KEY `AnuntComentat` (`IdAnunt`),
  KEY `Comentator` (`UserId`),
  CONSTRAINT `AnuntComentat` FOREIGN KEY (`IdAnunt`) REFERENCES `produse` (`IdAnunt`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Comentator` FOREIGN KEY (`UserId`) REFERENCES `utilizatori` (`UserId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Stored Comments';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.culori
DROP TABLE IF EXISTS `culori`;
CREATE TABLE IF NOT EXISTS `culori` (
  `ColorId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Culoare` varchar(15) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`ColorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Posibilele culori ale masinilor';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.emisii
DROP TABLE IF EXISTS `emisii`;
CREATE TABLE IF NOT EXISTS `emisii` (
  `EcoId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `EuroName` varchar(10) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`EcoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Noxele Emise si clasa ecologica';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.judete
DROP TABLE IF EXISTS `judete`;
CREATE TABLE IF NOT EXISTS `judete` (
  `JudetId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `NumeJudet` varchar(50) COLLATE utf16_romanian_ci NOT NULL DEFAULT '0',
  `PrescurtareJudet` varchar(50) COLLATE utf16_romanian_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`JudetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci;

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.marci
DROP TABLE IF EXISTS `marci`;
CREATE TABLE IF NOT EXISTS `marci` (
  `MakeId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id-ul o sa fie folosit ca si cheie straina',
  `Producator` varchar(20) COLLATE utf16_romanian_ci NOT NULL,
  `Auto` bit(1) NOT NULL,
  `Moto` bit(1) NOT NULL,
  `ATV` bit(1) NOT NULL,
  PRIMARY KEY (`MakeId`),
  UNIQUE KEY `Producator` (`Producator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Tabelul contine principalele marci auto';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.modele
DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `ModelId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `MakeId` tinyint(3) unsigned NOT NULL,
  `ModelName` varchar(30) COLLATE utf16_romanian_ci NOT NULL,
  `Type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ModelId`),
  KEY `Marca` (`MakeId`),
  KEY `Tip` (`Type`),
  CONSTRAINT `Marca` FOREIGN KEY (`MakeId`) REFERENCES `marci` (`MakeId`) ON UPDATE CASCADE,
  CONSTRAINT `Tip` FOREIGN KEY (`Type`) REFERENCES `categorie` (`Type`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Tabelul contine modelele asociate fiecarui producator';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.pozeanunturi
DROP TABLE IF EXISTS `pozeanunturi`;
CREATE TABLE IF NOT EXISTS `pozeanunturi` (
  `PozaId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `IdAnunt` int(11) unsigned NOT NULL,
  `Poza` mediumblob NOT NULL COMMENT 'Limita la poza 16 MB',
  PRIMARY KEY (`PozaId`),
  KEY `Anunt` (`IdAnunt`),
  CONSTRAINT `Anunt` FOREIGN KEY (`IdAnunt`) REFERENCES `produse` (`IdAnunt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Host for photos';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.produse
DROP TABLE IF EXISTS `produse`;
CREATE TABLE IF NOT EXISTS `produse` (
  `IdAnunt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DataCreere` date NOT NULL,
  `Categorie` tinyint(3) unsigned NOT NULL,
  `IdVanzator` int(11) unsigned NOT NULL,
  `MakeId` tinyint(3) unsigned NOT NULL,
  `ModelId` mediumint(8) unsigned NOT NULL,
  `Kilometraj` int(11) NOT NULL,
  `DataFabricatie` date NOT NULL,
  `Pret` mediumint(8) unsigned NOT NULL,
  `Putere` smallint(5) unsigned NOT NULL COMMENT 'kW',
  `CaiPutere` smallint(5) unsigned NOT NULL COMMENT 'Cp',
  `Capacitate` smallint(5) unsigned NOT NULL,
  `NrLocuri` tinyint(3) unsigned NOT NULL,
  `MMA` smallint(5) unsigned NOT NULL COMMENT 'Masa Maxima Adminsa',
  `CostTimbru` smallint(5) unsigned NOT NULL,
  `CostRCA` smallint(5) unsigned NOT NULL,
  `ClasaEuro` tinyint(3) unsigned NOT NULL,
  `Emisi` smallint(5) unsigned NOT NULL COMMENT 'Emisii CO2/l',
  `Culoare` tinyint(3) unsigned NOT NULL,
  `VIN` varchar(15) COLLATE utf16_romanian_ci NOT NULL COMMENT 'Serie Sasiu',
  `Combustibil` varchar(1) COLLATE utf16_romanian_ci NOT NULL COMMENT '1=benzina, 2=motorina, 3=hibrid si continuati daca vreti',
  `Distributie` varchar(1) COLLATE utf16_romanian_ci NOT NULL COMMENT '1=manuala, 2=secventiala, 3=automata',
  `Climatizare` varchar(1) COLLATE utf16_romanian_ci NOT NULL COMMENT '0=fara ac, 1=ac manual, 2=ac automat',
  `SIA` bit(1) NOT NULL COMMENT 'Sistem de incalzire auxiliar',
  `IC` bit(1) NOT NULL COMMENT 'Inchidere centralizata',
  `RV` bit(1) NOT NULL COMMENT 'Regulator de viteza',
  `SIE` bit(1) NOT NULL COMMENT 'Scaune Incalzite electric',
  `GE` bit(1) NOT NULL COMMENT 'Geamuri Electrice',
  `Nav` bit(1) NOT NULL COMMENT 'Sistem de navigatie',
  `SP` bit(1) NOT NULL COMMENT 'Senzori de parcare',
  `Servo` bit(1) NOT NULL,
  `TD` bit(1) NOT NULL COMMENT 'Trapa decapotabila',
  `JA` bit(1) NOT NULL COMMENT 'Jante de aliaj',
  `Carlig` bit(1) NOT NULL,
  `ABS` bit(1) NOT NULL,
  `ESP` bit(1) NOT NULL,
  `Integrala` bit(1) NOT NULL COMMENT '4x4',
  `Xenon` bit(1) NOT NULL,
  `Promovare` varchar(1) COLLATE utf16_romanian_ci NOT NULL COMMENT '0>1>2=gratis',
  `Descriere` mediumtext COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`IdAnunt`),
  KEY `MarcaP` (`MakeId`),
  KEY `ModelP` (`ModelId`),
  KEY `Vanzator` (`IdVanzator`),
  KEY `Categorie` (`Categorie`),
  KEY `Culoare` (`Culoare`),
  KEY `Emisii` (`ClasaEuro`),
  CONSTRAINT `Categorie` FOREIGN KEY (`Categorie`) REFERENCES `categorie` (`Type`) ON UPDATE CASCADE,
  CONSTRAINT `Culoare` FOREIGN KEY (`Culoare`) REFERENCES `culori` (`ColorId`) ON UPDATE CASCADE,
  CONSTRAINT `Emisii` FOREIGN KEY (`ClasaEuro`) REFERENCES `emisii` (`EcoId`) ON UPDATE CASCADE,
  CONSTRAINT `MarcaP` FOREIGN KEY (`MakeId`) REFERENCES `marci` (`MakeId`) ON UPDATE CASCADE,
  CONSTRAINT `ModelP` FOREIGN KEY (`ModelId`) REFERENCES `modele` (`ModelId`) ON UPDATE CASCADE,
  CONSTRAINT `Vanzator` FOREIGN KEY (`IdVanzator`) REFERENCES `utilizatori` (`UserId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Anunturile cu masini de vanzare';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `ProfileId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nume` varchar(15) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Prenume` varchar(30) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Telefon` varchar(12) COLLATE utf16_romanian_ci DEFAULT NULL,
  `AdresaEmail` varchar(35) COLLATE utf16_romanian_ci NOT NULL,
  `Judet` tinyint(3) unsigned DEFAULT NULL,
  `Localitate` varchar(15) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Strada` varchar(30) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Bloc` varchar(5) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Numar` varchar(5) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Scara` varchar(5) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Etaj` varchar(5) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Apartament` varchar(5) COLLATE utf16_romanian_ci DEFAULT NULL,
  `Avatar` mediumblob COMMENT '16Mb MaximSize',
  PRIMARY KEY (`ProfileId`,`AdresaEmail`),
  KEY `Email` (`AdresaEmail`),
  KEY `Judet` (`Judet`),
  CONSTRAINT `Email` FOREIGN KEY (`AdresaEmail`) REFERENCES `utilizatori` (`EmailAdd`) ON UPDATE CASCADE,
  CONSTRAINT `Judet` FOREIGN KEY (`Judet`) REFERENCES `judete` (`JudetId`) ON UPDATE CASCADE,
  CONSTRAINT `Profile` FOREIGN KEY (`ProfileId`) REFERENCES `utilizatori` (`UserId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Datele utilizatorilor';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.promotii
DROP TABLE IF EXISTS `promotii`;
CREATE TABLE IF NOT EXISTS `promotii` (
  `PromoId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `AnuntId` int(11) unsigned NOT NULL DEFAULT '0',
  `StartTime` date NOT NULL DEFAULT '0000-00-00',
  `EndTime` date NOT NULL DEFAULT '0000-00-00',
  `NewPrice` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`PromoId`),
  KEY `Id` (`AnuntId`),
  CONSTRAINT `Id` FOREIGN KEY (`AnuntId`) REFERENCES `produse` (`IdAnunt`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Aici o sa fie stocate reducerile de pret';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.style
DROP TABLE IF EXISTS `style`;
CREATE TABLE IF NOT EXISTS `style` (
  `StyleId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `TypeId` tinyint(3) unsigned NOT NULL,
  `Tip` varchar(30) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`StyleId`),
  KEY `Type` (`TypeId`),
  CONSTRAINT `Type` FOREIGN KEY (`TypeId`) REFERENCES `categorie` (`Type`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Stilul Vehiculului';

-- Data exporting was unselected.


-- Dumping structure for table proiectcolectiv.utilizatori
DROP TABLE IF EXISTS `utilizatori`;
CREATE TABLE IF NOT EXISTS `utilizatori` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID-ul userului, care o sa fie folosit la identificarea lui in comentarii sau ca vanzator',
  `UserName` varchar(15) COLLATE utf16_romanian_ci NOT NULL,
  `Password` varchar(50) COLLATE utf16_romanian_ci NOT NULL,
  `EmailAdd` varchar(35) COLLATE utf16_romanian_ci NOT NULL,
  `Type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '2=user, 1=admin',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserName` (`UserName`),
  UNIQUE KEY `EmailAdd` (`EmailAdd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Tabelul contine utilizatorii care pot folosi site-ul si tipul lor';

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
