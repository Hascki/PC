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

-- Dumping structure for table pc.chat
DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `ChatId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IdAnunt` int(11) unsigned NOT NULL,
  `UserId` int(11) unsigned NOT NULL,
  `Text` text COLLATE utf16_romanian_ci NOT NULL,
  PRIMARY KEY (`ChatId`),
  KEY `AnuntComentat` (`IdAnunt`),
  KEY `Comentator` (`UserId`),
  CONSTRAINT `Comentator` FOREIGN KEY (`UserId`) REFERENCES `utilizatori` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `AnuntComentat` FOREIGN KEY (`IdAnunt`) REFERENCES `produse` (`IdAnunt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci COMMENT='Stored Comments';

-- Dumping data for table pc.chat: ~0 rows (approximately)
DELETE FROM `chat`;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
