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

-- Dumping structure for table pc.promotii
DROP TABLE IF EXISTS `promotii`;
CREATE TABLE IF NOT EXISTS `promotii` (
  `PromoId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `AnuntId` int(11) unsigned NOT NULL DEFAULT '0',
  `StartTime` date NOT NULL DEFAULT '0000-00-00',
  `EndTime` date NOT NULL DEFAULT '0000-00-00',
  `NewPrice` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`PromoId`),
  KEY `Id` (`AnuntId`),
  CONSTRAINT `Id` FOREIGN KEY (`AnuntId`) REFERENCES `produse` (`IdAnunt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Aici o sa fie stocate reducerile de pret';

-- Dumping data for table pc.promotii: ~0 rows (approximately)
DELETE FROM `promotii`;
/*!40000 ALTER TABLE `promotii` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotii` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
