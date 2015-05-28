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

-- Dumping structure for table pc.judete
DROP TABLE IF EXISTS `judete`;
CREATE TABLE IF NOT EXISTS `judete` (
  `JudetId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `NumeJudet` varchar(50) COLLATE utf16_romanian_ci NOT NULL DEFAULT '0',
  `PrescurtareJudet` varchar(50) COLLATE utf16_romanian_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`JudetId`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci;

-- Dumping data for table pc.judete: ~42 rows (approximately)
DELETE FROM `judete`;
/*!40000 ALTER TABLE `judete` DISABLE KEYS */;
INSERT INTO `judete` (`JudetId`, `NumeJudet`, `PrescurtareJudet`) VALUES
	(1, 'Alba', 'AB'),
	(2, 'Arad', 'AR'),
	(3, 'Arges', 'AG'),
	(4, 'Bacau', 'BC'),
	(5, 'Bihor', 'BH'),
	(6, 'Bistrita-Nasaud', 'BN'),
	(7, 'Botosani', 'BT'),
	(8, 'Brasov', 'BV'),
	(9, 'Braila', 'BR'),
	(10, 'Buzau', 'BZ'),
	(11, 'Caras-Severin', 'CS'),
	(12, 'Calarasi', 'CL'),
	(13, 'Cluj', 'CJ'),
	(14, 'Constanta', 'CT'),
	(15, 'Covasna', 'CV'),
	(16, 'Dambovita', 'DB'),
	(17, 'Dolj', 'DJ'),
	(18, 'Galati', 'GL'),
	(19, 'Giurgiu', 'GR'),
	(20, 'Gorj', 'GJ'),
	(21, 'Harghita', 'HR'),
	(22, 'Hunedoara', 'HD'),
	(23, 'Ialomita', 'IL'),
	(24, 'Iasi', 'IS'),
	(25, 'Ilfov', 'IF'),
	(26, 'Maramures', 'MM'),
	(27, 'Mehedinti', 'MH'),
	(28, 'Mures', 'MS'),
	(29, 'Neamt', 'NT'),
	(30, 'Olt', 'OT'),
	(31, 'Prahova', 'PH'),
	(32, 'Satu Mare', 'SM'),
	(33, 'Salaj', 'SJ'),
	(34, 'Sibiu', 'SB'),
	(35, 'Suceava', 'SV'),
	(36, 'Teleorman', 'TR'),
	(37, 'Timis', 'TM'),
	(38, 'Tulcea', 'TL'),
	(39, 'Vaslui', 'VS'),
	(40, 'Valcea', 'VL'),
	(41, 'Vrancea', 'VN'),
	(42, 'Bucuresti', 'B');
/*!40000 ALTER TABLE `judete` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
