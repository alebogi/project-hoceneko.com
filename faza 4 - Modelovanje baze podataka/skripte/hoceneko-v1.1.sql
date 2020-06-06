-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 09, 2020 at 07:11 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoceneko`
--

-- --------------------------------------------------------

--
-- Table structure for table `objava`
--

DROP TABLE IF EXISTS `objava`;
CREATE TABLE IF NOT EXISTS `objava` (
  `idObj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kategorija` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `br_potrebnih_clanova` int(11) NOT NULL,
  `br_prijavljenih_clanova` int(11) NOT NULL DEFAULT '0',
  `datum` date NOT NULL,
  `vreme` time NOT NULL,
  `mesto` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(999) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tip` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'besplatna',
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idObj`),
  KEY `R_1` (`idKor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objava`
--

INSERT INTO `objava` (`idObj`, `naziv`, `kategorija`, `br_potrebnih_clanova`, `br_prijavljenih_clanova`, `datum`, `vreme`, `mesto`, `opis`, `tip`, `idKor`) VALUES
(1, 'Mali Fudbal', 'Sport', 10, 2, '2020-05-30', '19:00:00', 'Zvezdara', 'Potrebna ekipa za mali fudbal u balonu NekiBalonImeNemamPojma 30.maja u 19:00h!!!', 'besplatna', 1),
(2, 'Kosarka', 'Sport', 6, 3, '2020-05-28', '21:15:00', 'Novi Beograd-Zemun', 'Potrebna ekipa za kosarku 3 na 3 , samo ljudi preko  180 cm !!!', 'premium', 2),
(3, 'Pozorisna predstava', 'Kultura', 10, 3, '2020-05-25', '20:00:00', 'Vracar', 'Potrebno jos 9 osoba zainteresovanih za organizovanje predstave Umri muski   , pozeljno glumacko iskustvo', 'besplatna', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
