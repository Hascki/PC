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

-- Dumping structure for table pc.utilizatori
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

-- Dumping data for table pc.utilizatori: ~1 rows (approximately)
DELETE FROM `utilizatori`;
/*!40000 ALTER TABLE `utilizatori` DISABLE KEYS */;
INSERT INTO `utilizatori` (`UserId`, `UserName`, `Password`, `EmailAdd`, `Type`) VALUES
	(1, 'Hsk', '81dc9bdb52d04dc20036dbd8313ed055', 'test@mail.com', 1);
/*!40000 ALTER TABLE `utilizatori` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
