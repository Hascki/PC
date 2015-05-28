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

-- Dumping structure for table pc.emisii
DROP TABLE IF EXISTS `emisii`;
CREATE TABLE IF NOT EXISTS `emisii` (
  `EcoId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `EuroName` varchar(10) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`EcoId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Noxele Emise si clasa ecologica';

-- Dumping data for table pc.emisii: ~7 rows (approximately)
DELETE FROM `emisii`;
/*!40000 ALTER TABLE `emisii` DISABLE KEYS */;
INSERT INTO `emisii` (`EcoId`, `EuroName`) VALUES
	(1, 'Non-Euro'),
	(2, 'Euro1'),
	(3, 'Euro2'),
	(4, 'Euro3'),
	(5, 'Euro4'),
	(6, 'Euro5'),
	(7, 'Hibrid');
/*!40000 ALTER TABLE `emisii` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
