-- --------------------------------------------------------
-- Host:                         info.tm.edu.ro
-- Server version:               5.5.38-0+wheezy1 - (Debian)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table pc.profiles
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
  `Sold` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`ProfileId`,`AdresaEmail`),
  KEY `Email` (`AdresaEmail`),
  KEY `Judet` (`Judet`),
  CONSTRAINT `Email` FOREIGN KEY (`AdresaEmail`) REFERENCES `utilizatori` (`EmailAdd`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Judet` FOREIGN KEY (`Judet`) REFERENCES `judete` (`JudetId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Profile` FOREIGN KEY (`ProfileId`) REFERENCES `utilizatori` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Datele utilizatorilor';

-- Dumping data for table pc.profiles: ~0 rows (approximately)
DELETE FROM `profiles`;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
