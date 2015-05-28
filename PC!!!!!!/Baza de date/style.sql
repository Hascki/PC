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

-- Dumping structure for table pc.style
DROP TABLE IF EXISTS `style`;
CREATE TABLE IF NOT EXISTS `style` (
  `StyleId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `TypeId` tinyint(3) unsigned NOT NULL,
  `Tip` varchar(30) COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`StyleId`),
  KEY `Type` (`TypeId`),
  CONSTRAINT `Type` FOREIGN KEY (`TypeId`) REFERENCES `categorie` (`Type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Stilul Vehiculului';

-- Dumping data for table pc.style: ~18 rows (approximately)
DELETE FROM `style`;
/*!40000 ALTER TABLE `style` DISABLE KEYS */;
INSERT INTO `style` (`StyleId`, `TypeId`, `Tip`) VALUES
	(1, 1, 'SUV'),
	(2, 1, 'Berlina'),
	(3, 1, 'Break'),
	(4, 1, 'Cabrio'),
	(5, 1, 'Monovolum'),
	(6, 1, 'Coupe'),
	(8, 1, 'Compact'),
	(9, 2, 'Chopper'),
	(10, 2, 'Cross'),
	(11, 2, 'Enduro'),
	(12, 2, 'Moped'),
	(13, 2, 'Scuter'),
	(14, 2, 'Sport'),
	(15, 2, 'Touring'),
	(16, 3, 'Quad'),
	(17, 3, 'Agrement'),
	(18, 3, 'Utilitar'),
	(19, 3, 'Sport');
/*!40000 ALTER TABLE `style` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
