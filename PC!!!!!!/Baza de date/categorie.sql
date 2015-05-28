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

-- Dumping structure for table pc.categorie
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `Type` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `CatName` varchar(30) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`Type`),
  UNIQUE KEY `CatName` (`CatName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Tipurile de vehicule';

-- Dumping data for table pc.categorie: ~3 rows (approximately)
DELETE FROM `categorie`;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`Type`, `CatName`) VALUES
	(3, 'ATV'),
	(1, 'Masina'),
	(2, 'Motocicleta');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
