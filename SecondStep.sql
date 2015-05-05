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

-- Dumping database structure for proiectcolectiv
DROP DATABASE IF EXISTS `proiectcolectiv`;
CREATE DATABASE IF NOT EXISTS `proiectcolectiv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proiectcolectiv`;


-- Dumping structure for table proiectcolectiv.categorie
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `CatId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `CatName` varchar(30) NOT NULL,
  PRIMARY KEY (`CatId`),
  UNIQUE KEY `CatName` (`CatName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table proiectcolectiv.categorie: ~3 rows (approximately)
DELETE FROM `categorie`;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`CatId`, `CatName`) VALUES
	(3, 'ATV'),
	(1, 'Masina'),
	(2, 'Motocicleta');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;


-- Dumping structure for table proiectcolectiv.chat
DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `IdAnunt` int(11) unsigned NOT NULL,
  `UserId` int(11) unsigned NOT NULL,
  `Text` text NOT NULL,
  KEY `AnuntComentat` (`IdAnunt`),
  KEY `Comentator` (`UserId`),
  CONSTRAINT `AnuntComentat` FOREIGN KEY (`IdAnunt`) REFERENCES `produse` (`IdAnunt`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Comentator` FOREIGN KEY (`UserId`) REFERENCES `utilizatori` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stored Comments';

-- Dumping data for table proiectcolectiv.chat: ~0 rows (approximately)
DELETE FROM `chat`;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;


-- Dumping structure for table proiectcolectiv.marci
DROP TABLE IF EXISTS `marci`;
CREATE TABLE IF NOT EXISTS `marci` (
  `MakeId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id-ul o sa fie folosit ca si cheie straina',
  `Producator` varchar(20) NOT NULL,
  PRIMARY KEY (`MakeId`),
  UNIQUE KEY `Producator` (`Producator`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1 COMMENT='Tabelul contine principalele marci auto';

-- Dumping data for table proiectcolectiv.marci: ~110 rows (approximately)
DELETE FROM `marci`;
/*!40000 ALTER TABLE `marci` DISABLE KEYS */;
INSERT INTO `marci` (`MakeId`, `Producator`) VALUES
	(1, 'Abarth'),
	(2, 'AC'),
	(3, 'Acura'),
	(4, 'Aixam'),
	(5, 'Alfa Romeo'),
	(6, 'ALPINA'),
	(7, 'Artega'),
	(8, 'Asia Motors'),
	(9, 'Aston Martin'),
	(10, 'Audi'),
	(11, 'Austin Healey'),
	(12, 'Bentley'),
	(13, 'BMW'),
	(14, 'Borgward'),
	(15, 'Brilliance'),
	(16, 'Bugatti'),
	(17, 'Buick'),
	(18, 'Cadillac'),
	(19, 'Casalini'),
	(20, 'Caterham'),
	(21, 'Chatenet'),
	(22, 'Chevrolet'),
	(23, 'Chrysler'),
	(24, 'Citroën'),
	(25, 'Cobra'),
	(26, 'Corvette'),
	(27, 'Dacia'),
	(28, 'Daewoo'),
	(29, 'Daihatsu'),
	(30, 'DeTomaso'),
	(31, 'Dodge'),
	(32, 'Ferrari'),
	(33, 'Fiat'),
	(34, 'Fisker'),
	(35, 'Ford'),
	(36, 'GAC Gonow'),
	(37, 'Gemballa'),
	(38, 'GMC'),
	(39, 'Grecav'),
	(40, 'Hamann'),
	(41, 'Holden'),
	(42, 'Honda'),
	(43, 'Hummer'),
	(44, 'Hyundai'),
	(45, 'Infiniti'),
	(46, 'Isuzu'),
	(47, 'Iveco'),
	(48, 'Jaguar'),
	(49, 'Jeep'),
	(50, 'Kia'),
	(52, 'Konigsegg'),
	(51, 'KTM'),
	(53, 'Lada'),
	(54, 'Lamborghini'),
	(55, 'Lancia'),
	(56, 'Land Rover'),
	(57, 'Landwind'),
	(58, 'Lexus'),
	(59, 'Ligier'),
	(60, 'Lincoln'),
	(61, 'Lotus'),
	(62, 'Mahindra'),
	(63, 'Maserati'),
	(64, 'Maybach'),
	(65, 'Mazda'),
	(66, 'McLaren'),
	(67, 'Mercedes-Benz'),
	(68, 'MG'),
	(69, 'Microcar'),
	(70, 'MINI'),
	(71, 'Mitsubishi'),
	(72, 'Morgan'),
	(73, 'Nissan'),
	(74, 'NSU'),
	(75, 'Oldsmobile'),
	(76, 'Opel'),
	(77, 'Pagani'),
	(78, 'Peugeot'),
	(79, 'Piaggio'),
	(80, 'Plymouth'),
	(81, 'Pontiac'),
	(82, 'Porsche'),
	(83, 'Proton'),
	(84, 'Renault'),
	(85, 'Rolls-Royce'),
	(86, 'Rover'),
	(87, 'Ruf'),
	(88, 'Saab'),
	(89, 'Santana'),
	(90, 'Seat'),
	(91, 'Skoda'),
	(92, 'Smart'),
	(93, 'speedART'),
	(94, 'Spyker'),
	(95, 'Ssangyong'),
	(96, 'Subaru'),
	(97, 'Suzuki'),
	(98, 'Talbot'),
	(99, 'Tata'),
	(100, 'TECHART'),
	(101, 'Tesla'),
	(102, 'Toyota'),
	(103, 'Trabant'),
	(104, 'Triumph'),
	(105, 'TVR'),
	(106, 'Volkswagen'),
	(107, 'Volvo'),
	(108, 'Wartburg'),
	(109, 'Westfield'),
	(110, 'Wiesmann');
/*!40000 ALTER TABLE `marci` ENABLE KEYS */;


-- Dumping structure for table proiectcolectiv.modele
DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `ModelId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `MakeId` tinyint(3) unsigned NOT NULL,
  `ModelName` varchar(30) NOT NULL,
  PRIMARY KEY (`ModelId`),
  UNIQUE KEY `ModelName` (`ModelName`),
  KEY `Marca` (`MakeId`),
  CONSTRAINT `Marca` FOREIGN KEY (`MakeId`) REFERENCES `marci` (`MakeId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1 COMMENT='Tabelul contine modelele asociate fiecarui producator';

-- Dumping data for table proiectcolectiv.modele: ~81 rows (approximately)
DELETE FROM `modele`;
/*!40000 ALTER TABLE `modele` DISABLE KEYS */;
INSERT INTO `modele` (`ModelId`, `MakeId`, `ModelName`) VALUES
	(1, 10, '100'),
	(2, 10, '200'),
	(3, 10, '80'),
	(4, 10, '90'),
	(5, 10, 'A1'),
	(6, 10, 'A2'),
	(7, 10, 'A3'),
	(8, 10, 'A4'),
	(9, 10, 'A4 Allroad'),
	(10, 10, 'A5'),
	(11, 10, 'A6'),
	(12, 10, 'A6 Allroad'),
	(13, 10, 'A7'),
	(14, 10, 'A8'),
	(15, 10, 'Cabriolet'),
	(16, 10, 'Coupé'),
	(17, 10, 'Q3'),
	(18, 10, 'Q5'),
	(19, 10, 'Q7'),
	(20, 10, 'QUATTRO'),
	(21, 10, 'R8'),
	(22, 10, 'RS2'),
	(23, 10, 'RS3'),
	(24, 10, 'RS4'),
	(25, 10, 'RS5'),
	(26, 10, 'RS6'),
	(27, 10, 'RS7'),
	(28, 10, 'RSQ3'),
	(29, 10, 'S1'),
	(30, 10, 'S2'),
	(31, 10, 'S3'),
	(32, 10, 'S4'),
	(33, 10, 'S5'),
	(34, 10, 'S6'),
	(35, 10, 'S7'),
	(36, 10, 'S8'),
	(37, 10, 'SQ5'),
	(38, 10, 'TT'),
	(39, 10, 'TT RS'),
	(40, 10, 'TTS'),
	(41, 10, 'V8'),
	(42, 76, 'Adam'),
	(43, 76, 'Agila'),
	(44, 76, 'Ampera'),
	(45, 76, 'Antara'),
	(46, 76, 'Arena'),
	(47, 76, 'Ascona'),
	(48, 76, 'Astra'),
	(49, 76, 'Calibra'),
	(50, 76, 'Campo'),
	(51, 76, 'Cascada'),
	(52, 76, 'Cavalier'),
	(53, 76, 'Combo'),
	(54, 76, 'Commodore'),
	(55, 76, 'Corsa'),
	(56, 76, 'Diplomat'),
	(57, 76, 'Frontera'),
	(58, 76, 'GT'),
	(59, 76, 'Insignia'),
	(60, 76, 'Insignia CT'),
	(61, 76, 'Kadett'),
	(62, 76, 'Karl'),
	(63, 76, 'Manta'),
	(64, 76, 'Meriva'),
	(65, 76, 'Mokka'),
	(66, 76, 'Monterey'),
	(67, 76, 'Monza'),
	(68, 76, 'Movano'),
	(69, 76, 'Nova'),
	(70, 76, 'Omega'),
	(71, 76, 'Pick Up Sportscap'),
	(72, 76, 'Rekord'),
	(73, 76, 'Senator'),
	(74, 76, 'Signum'),
	(75, 76, 'Sintra'),
	(76, 76, 'Speedster'),
	(77, 76, 'Tigra'),
	(78, 76, 'Vectra'),
	(79, 76, 'Vivaro'),
	(80, 76, 'Zafira'),
	(81, 76, 'Zafira Tourer');
/*!40000 ALTER TABLE `modele` ENABLE KEYS */;


-- Dumping structure for table proiectcolectiv.pozeanunturi
DROP TABLE IF EXISTS `pozeanunturi`;
CREATE TABLE IF NOT EXISTS `pozeanunturi` (
  `IdAnunt` int(11) unsigned NOT NULL,
  `Poza` mediumblob NOT NULL COMMENT 'Limita la poza 16 MB',
  KEY `Anunt` (`IdAnunt`),
  CONSTRAINT `Anunt` FOREIGN KEY (`IdAnunt`) REFERENCES `produse` (`IdAnunt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Host for photos';

-- Dumping data for table proiectcolectiv.pozeanunturi: ~0 rows (approximately)
DELETE FROM `pozeanunturi`;
/*!40000 ALTER TABLE `pozeanunturi` DISABLE KEYS */;
/*!40000 ALTER TABLE `pozeanunturi` ENABLE KEYS */;


-- Dumping structure for table proiectcolectiv.produse
DROP TABLE IF EXISTS `produse`;
CREATE TABLE IF NOT EXISTS `produse` (
  `IdAnunt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Categorie` tinyint(3) unsigned NOT NULL,
  `IdVanzator` int(11) unsigned NOT NULL,
  `MakeId` tinyint(3) unsigned NOT NULL,
  `ModelId` mediumint(8) unsigned NOT NULL,
  `Kilometraj` int(11) NOT NULL,
  `DataFabricatie` date NOT NULL,
  `Pret` mediumint(8) unsigned NOT NULL,
  `Putere` smallint(5) unsigned NOT NULL,
  `Capacitate` smallint(5) unsigned NOT NULL,
  `Combustibil` varchar(1) NOT NULL COMMENT '1=benzina, 2=motorina, 3=hibrid si continuati daca vreti',
  `Distributie` varchar(1) NOT NULL COMMENT '1=manuala, 2=secventiala, 3=automata',
  `Climatizare` varchar(1) NOT NULL COMMENT '0=fara ac, 1=ac manual, 2=ac automat',
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
  PRIMARY KEY (`IdAnunt`),
  KEY `MarcaP` (`MakeId`),
  KEY `ModelP` (`ModelId`),
  KEY `Vanzator` (`IdVanzator`),
  KEY `Categorie` (`Categorie`),
  CONSTRAINT `Categorie` FOREIGN KEY (`Categorie`) REFERENCES `categorie` (`CatId`) ON UPDATE CASCADE,
  CONSTRAINT `MarcaP` FOREIGN KEY (`MakeId`) REFERENCES `marci` (`MakeId`) ON UPDATE CASCADE,
  CONSTRAINT `ModelP` FOREIGN KEY (`ModelId`) REFERENCES `modele` (`ModelId`) ON UPDATE CASCADE,
  CONSTRAINT `Vanzator` FOREIGN KEY (`IdVanzator`) REFERENCES `utilizatori` (`UserId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Anunturile cu masini de vanzare';

-- Dumping data for table proiectcolectiv.produse: ~0 rows (approximately)
DELETE FROM `produse`;
/*!40000 ALTER TABLE `produse` DISABLE KEYS */;
/*!40000 ALTER TABLE `produse` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Tabelul contine utilizatorii care pot folosi site-ul si tipul lor';

-- Dumping data for table proiectcolectiv.utilizatori: ~1 rows (approximately)
DELETE FROM `utilizatori`;
/*!40000 ALTER TABLE `utilizatori` DISABLE KEYS */;
INSERT INTO `utilizatori` (`UserId`, `UserName`, `Password`, `EmailAdd`, `Type`) VALUES
	(1, 'Hsk', '1234', 'test@mail.com', 1);
/*!40000 ALTER TABLE `utilizatori` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
