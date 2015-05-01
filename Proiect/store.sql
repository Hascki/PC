-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Mai 2015 la 19:37
-- Versiune server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `cereri`
--

CREATE TABLE IF NOT EXISTS `cereri` (
`id` int(11) NOT NULL,
  `nume` text NOT NULL,
  `prenume` text NOT NULL,
  `telefon` text NOT NULL,
  `email` text NOT NULL,
  `adresa` text NOT NULL,
  `produs` text NOT NULL,
  `nr_buc` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `cereri`
--

INSERT INTO `cereri` (`id`, `nume`, `prenume`, `telefon`, `email`, `adresa`, `produs`, `nr_buc`) VALUES
(41, 'Ciuciu ', 'Daniel Mihaita', '0748789489', 'cioco_dany2000@yahoo.com', 'strada mea', 'BMW 525', 1),
(42, 'Ciuciu ', 'Daniel Mihaita', '0748789489', 'cioco_dany2000@yahoo.com', 'strada mea', 'Mercedes-Benz Clasa A', 1),
(43, 'ionut', 'mihai', '0748789489', 'fhdf', 'fhdh', 'BMW 320', 3),
(44, 'Ciuciu ', 'Daniel', '0748789489', 'dany_cioco@yahoo.com', 'strada mea', 'Audi A6', 1),
(45, 'dsadasd', 'gsdfs', '0748789489', 'dany_cioco@yahoo.com', 'aa', 'Mercedes-Benz S Class', 1),
(50, 'Proiect', 'Individual', '0748789489', 'cioco_dany2000@yahoo.com', 'UVT', 'Mercedes-Benz Clasa A', 1),
(51, 'Ciuciu ', '', '', '', 'sadadasdsa', 'BMW 325', 1),
(52, 'Alina', '', '', '', 'camin', 'Audi A8', 1),
(53, 'Ciuciu', 'Daniel Mihaita', '651616', 'dany_cioco@yahoo.com', 'vdzvfbc', 'BMW 320', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `produse`
--

CREATE TABLE IF NOT EXISTS `produse` (
`id` int(11) NOT NULL,
  `poza` text NOT NULL,
  `nume` text NOT NULL,
  `descriere1` text NOT NULL,
  `descriere2` text NOT NULL,
  `nr` int(11) NOT NULL,
  `pret` int(11) NOT NULL,
  `tip` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `produse`
--

INSERT INTO `produse` (`id`, `poza`, `nume`, `descriere1`, `descriere2`, `nr`, `pret`, `tip`) VALUES
(1, 'imagini/bmw1.jpg', 'BMW 320', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 2.0 </dt>\r\n\r\n<dt><b>Putere:</b> 130CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Albastru</dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina</dt>\r\n\r\n<dt><b>Transmisie:</b> Manuala</dt>\r\n\r\n<dt><b>An fabricatie</b> 2012</dt>', 1, 12000, 'bmw'),
(2, 'imagini/bmw2.jpg', 'BMW 325', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 2.5 </dt>\r\n\r\n<dt><b>Putere:</b> 184 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Maro</dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina</dt>\r\n\r\n<dt><b>Transmisie:</b> Manuala</dt>\r\n\r\n<dt><b>An fabricatie</b> 2013</dt>', 9, 15000, 'bmw'),
(3, 'imagini/bmw3.jpg', 'BMW 320', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 2.0 </dt>\r\n\r\n<dt><b>Putere:</b> 150 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Alb</dt>', '<dt><b>Numar usi:</b> 2/3 </dt>\r\n\r\n<dt><b>Caroserie:</b> Coupe</dt>\r\n\r\n<dt><b>Transmisie:</b> Manuala</dt>\r\n\r\n<dt><b>An fabricatie</b> 2012</dt>', 10, 14000, 'bmw'),
(4, 'imagini/bmw4.jpg', 'BMW 330', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 3.0 </dt>\r\n\r\n<dt><b>Putere:</b> 200 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Benzina</dt>\r\n\r\n<dt><b>Culoare</b> Rosu </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2014</dt>', 7, 16000, 'bmw'),
(7, 'imagini/bmw5.jpg', 'BMW 525', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 2.5 </dt>\r\n\r\n<dt><b>Putere:</b> 190 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel </dt>\r\n\r\n<dt><b>Culoare</b> Alb </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2013</dt>', 9, 25000, 'bmw'),
(8, 'imagini/a1.jpg', 'Audi A1', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 1.4 </dt>\r\n\r\n<dt><b>Putere:</b> 80 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Benzina</dt>\r\n\r\n<dt><b>Culoare</b> Alb </dt>', '<dt><b>Numar usi:</b> 2/3 </dt>\r\n\r\n<dt><b>Caroserie:</b> Coupe </dt>\r\n\r\n<dt><b>Transmisie:</b> Manuala </dt>\r\n\r\n<dt><b>An fabricatie</b> 2014</dt>', 0, 8000, 'audi'),
(9, 'imagini/a3.jpg', 'Audi A3', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 1.6 </dt>\r\n\r\n<dt><b>Putere:</b> 100 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Benzina</dt>\r\n\r\n<dt><b>Culoare</b> Rosu </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Manuala</dt>\r\n\r\n<dt><b>An fabricatie</b> 2013</dt>', 18, 10000, 'audi'),
(10, 'imagini/a4.jpg', 'Audi A4', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 3.0 </dt>\r\n\r\n<dt><b>Putere:</b> 210 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Benzina</dt>\r\n\r\n<dt><b>Culoare</b> Alb </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2012</dt>', 8, 17999, 'audi'),
(11, 'imagini/a6.jpg', 'Audi A6', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 3.4 </dt>\r\n\r\n<dt><b>Putere:</b> 230 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Benzina</dt>\r\n\r\n<dt><b>Culoare</b> Negru mat </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2014</dt>', 10, 25000, 'audi'),
(12, 'imagini/a8.jpg', 'Audi A8', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 4.0 </dt>\r\n\r\n<dt><b>Putere:</b> 280 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Negru </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2014</dt>', 11, 30000, 'audi'),
(13, 'imagini/ca.jpg', 'Mercedes-Benz Clasa A', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 1.5 </dt>\r\n\r\n<dt><b>Putere:</b> 60 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Gri metalizat </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Manuala</dt>\r\n\r\n<dt><b>An fabricatie</b> 2011</dt>', 9, 11000, 'mercedes'),
(14, 'imagini/cla.jpg', 'Mercedes-Benz Cla', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 1.9 </dt>\r\n\r\n<dt><b>Putere:</b> 140 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Alb </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2014</dt>', 15, 18000, 'mercedes'),
(15, 'imagini/cls.jpg', 'Mercedes-Benz Cls', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 2.0 </dt>\r\n\r\n<dt><b>Putere:</b> 160 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Alb </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata </dt>\r\n\r\n<dt><b>An fabricatie</b> 2012</dt>', 14, 21000, 'mercedes'),
(16, 'imagini/gl.jpg', 'Mercedes-Benz GL', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 4.0 </dt>\r\n\r\n<dt><b>Putere:</b> 300 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel</dt>\r\n\r\n<dt><b>Culoare</b> Alb </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Hibrid </dt>\r\n\r\n<dt><b>An fabricatie</b> 2014</dt>', 15, 50000, 'mercedes'),
(17, 'imagini/ml.jpg', 'Mercedes-Benz ML', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 3.6 </dt>\r\n\r\n<dt><b>Putere:</b> 290 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Benzina</dt>\r\n\r\n<dt><b>Culoare</b> Negru </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2013</dt>', 19, 60000, 'mercedes'),
(18, 'imagini/sclass.jpg', 'Mercedes-Benz S Class', '<font size="4"><b>Caracteristici:</b></font><br>\r\n\r\n<dt><b>Motor:</b> 2.5 </dt>\r\n\r\n<dt><b>Putere:</b> 175 CP </dt>\r\n\r\n<dt><b>Combustibil:</b> Diesel </dt>\r\n\r\n<dt><b>Culoare</b> Negru </dt>', '<dt><b>Numar usi:</b> 4/5 </dt>\r\n\r\n<dt><b>Caroserie:</b> Berlina </dt>\r\n\r\n<dt><b>Transmisie:</b> Automata</dt>\r\n\r\n<dt><b>An fabricatie</b> 2012</dt>', 4, 35000, 'mercedes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cereri`
--
ALTER TABLE `cereri`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `produse`
--
ALTER TABLE `produse`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cereri`
--
ALTER TABLE `cereri`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `produse`
--
ALTER TABLE `produse`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
