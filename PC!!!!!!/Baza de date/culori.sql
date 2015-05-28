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

-- Dumping structure for table pc.culori
DROP TABLE IF EXISTS `culori`;
CREATE TABLE IF NOT EXISTS `culori` (
  `ColorId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Culoare` varchar(15) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`ColorId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Posibilele culori ale masinilor';

-- Dumping data for table pc.culori: ~13 rows (approximately)
DELETE FROM `culori`;
/*!40000 ALTER TABLE `culori` DISABLE KEYS */;
INSERT INTO `culori` (`ColorId`, `Culoare`) VALUES
	(1, 'Alb'),
	(2, 'Albastru'),
	(3, 'Argintiu'),
	(4, 'Auriu'),
	(5, 'Bej'),
	(6, 'Galben'),
	(7, 'Gri'),
	(8, 'Maro'),
	(9, 'Negru'),
	(10, 'Portocaliu'),
	(11, 'Rosu'),
	(12, 'Verde'),
	(13, 'Violet');
/*!40000 ALTER TABLE `culori` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
