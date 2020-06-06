-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 27, 2020 at 08:52 AM
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

CREATE DATABASE IF NOT EXISTS `hoceneko` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hoceneko`; 
-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `idKom` int(11) NOT NULL AUTO_INCREMENT,
  `sadrzaj` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idObj` int(11) NOT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idKom`),
  KEY `R_4` (`idObj`),
  KEY `R_5` (`idKor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKom`, `sadrzaj`, `idObj`, `idKor`) VALUES
(1, 'Boze koja glupost , ja ne verujem ...', 2, 1),
(2, 'Bice super , nemoj tako !', 2, 2),
(3, 'Ja sam nabildovan i glumim Bruce Willis-a da se zna odmah !', 3, 3),
(4, 'Kul...', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKor` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pol` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `e_mail` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `tip` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'obican',
  `ocena` decimal(10,2) DEFAULT NULL,
  `opis` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `profilna_slika` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idKor`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKor`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `pol`, `e_mail`, `datum_rodjenja`, `tip`, `ocena`, `opis`, `profilna_slika`) VALUES
(1, 'aleksandar', 'sifra123', 'Aleksandar', 'Matic', 'muski', 'aleksandar@gmail.com', '1998-03-04', 'obican', '3.00', 'Ja sam Aleksandar', NULL),
(2, 'ognjen', 'sifra123', 'Ognjen', 'Subaric', 'muski', 'ognjen@gmail.com', '1998-03-04', 'obican', '0.00', 'Ja sam Ognjen', NULL),
(3, 'nikola', 'sifra123', 'Nikola', 'Milicevic', 'muski', 'nikola@gmail.com', '1998-03-04', 'admin', '5.00', 'Ja sam Nikola i ja sam admin', NULL),
(4, 'aleksandra', 'sifra123', 'Aleksandra', 'Bogicevic', 'zenski', 'aleksandra@gmail.com', '1998-03-04', 'admin', '2.00', 'Ja sam Aleksandra i ja sam admin', NULL),
(5, 'djuraPas', 'sifra123', 'Djuroslav', 'Pasojevic', 'muski', 'djura19@gmail.com', '2019-11-22', 'obican', '2.00', 'djura je mala bebica', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objava`
--

INSERT INTO `objava` (`idObj`, `naziv`, `kategorija`, `br_potrebnih_clanova`, `br_prijavljenih_clanova`, `datum`, `vreme`, `mesto`, `opis`, `tip`, `idKor`) VALUES
(1, 'Mali Fudbal', 'Sport-Fudbal', 10, 2, '2020-05-30', '19:00:00', 'Zvezdara', 'Potrebna ekipa za mali fudbal u balonu NekiBalonImeNemamPojma 30.maja u 19:00h!!!', 'besplatna', 1),
(2, 'Kosarka', 'Sport-Kosarka', 6, 3, '2020-05-28', '21:15:00', 'Novi Beograd-Zemun', 'Potrebna ekipa za kosarku 3 na 3 , samo ljudi preko  180 cm !!!', 'premium', 2),
(3, 'Pozorisna predstava', 'Kultura-Pozoriste', 10, 4, '2020-05-25', '20:00:00', 'Vracar', 'Potrebno jos 9 osoba zainteresovanih za organizovanje predstave Umri muski   , pozeljno glumacko iskustvo', 'besplatna', 3),
(4, 'NAJJACA OBJAVA IKAD', 'Izlasci-Rejv', 50, 2, '2020-08-18', '23:59:00', 'blok 70', 'rejv blok 70 pod nazivom \"sirimo covid-19\". idemo sviiii', 'premium', 4),
(5, 'NAJJACA OBJAVA IKAD2', 'Sport-Odbojka', 12, 1, '2020-05-30', '10:00:00', 'ada', 'ajmo svi na odbojke', 'besplatna', 4),
(8, 'Kucici', 'Izlasci-Splavovi', 5, 2, '2020-05-30', '16:03:00', 'Zvezdara', 'dadada', 'besplatna', 5);

-- --------------------------------------------------------

--
-- Table structure for table `objava_prijava`
--

DROP TABLE IF EXISTS `objava_prijava`;
CREATE TABLE IF NOT EXISTS `objava_prijava` (
  `idOPri` int(11) NOT NULL AUTO_INCREMENT,
  `idObj` int(11) NOT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idOPri`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objava_prijava`
--

INSERT INTO `objava_prijava` (`idOPri`, `idObj`, `idKor`) VALUES
(16, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocenio`
--

DROP TABLE IF EXISTS `ocenio`;
CREATE TABLE IF NOT EXISTS `ocenio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idOcenio` int(11) NOT NULL,
  `idOcenjen` int(11) NOT NULL,
  `tip_ocene` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocenio`
--

INSERT INTO `ocenio` (`id`, `idOcenio`, `idOcenjen`, `tip_ocene`) VALUES
(1, 3, 2, 'negativna'),
(2, 3, 1, 'negativna'),
(3, 3, 5, 'pozitivna'),
(4, 3, 4, 'negativna'),
(5, 2, 3, 'pozitivna'),
(6, 2, 5, 'pozitivna'),
(7, 2, 1, 'negativna');

-- --------------------------------------------------------

--
-- Table structure for table `prijavljen`
--

DROP TABLE IF EXISTS `prijavljen`;
CREATE TABLE IF NOT EXISTS `prijavljen` (
  `idKor` int(11) NOT NULL,
  `idObj` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idObj`),
  KEY `R_13` (`idObj`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prijavljen`
--

INSERT INTO `prijavljen` (`idKor`, `idObj`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 8),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 1),
(4, 3),
(4, 5),
(5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

DROP TABLE IF EXISTS `zahtev`;
CREATE TABLE IF NOT EXISTS `zahtev` (
  `idZah` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(999) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idZah`),
  KEY `R_16` (`idKor`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zahtev`
--

INSERT INTO `zahtev` (`idZah`, `tema`, `opis`, `status`, `idKor`) VALUES
(1, 'Registracija', 'Pozdrav , da li moj drug mora da ima nalog da bi pristupio mojoj objavi ?', 'otvoren', 2),
(2, 'Testiranje ', 'test test ajde radi', 'otvoren', 1),
(3, 'Testiranje 2', 'Podrska svaka cast super ste poyy', 'otvoren', 1),
(4, 'SUPER SUPER', 'ovo sve dobro radi dodavanje u bazu', 'otvoren', 1),
(7, 'podrsko braco', 'super sve super super duper super sve bravo', 'otvoren', 4),
(8, 'LOLLLOL', 'KAKO SE KORISTI SAJT JA NE ZNAM IMAM TRI GODINE', 'otvoren', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
