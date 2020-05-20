-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 18, 2020 at 06:46 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKom`, `sadrzaj`, `idObj`, `idKor`) VALUES
(3, 'Ja sam nabildovan i glumim Bruce Willis-a da se zna odmah !', 3, 3),
(4, 'Kul...', 3, 4),
(9, 'molim vas', 8, 8);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKor`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `pol`, `e_mail`, `datum_rodjenja`, `tip`, `ocena`, `opis`, `profilna_slika`) VALUES
(8, 'aleksandar', 'sifra123', 'aleksandar', 'matic', 'muski', 'coa@gmail.com', '1998-03-03', 'obican', '1.00', 'Ja sam uzoran student Ja sam uzoran student Ja sam uzoran student ', '../../public/uploads/aleksandar_profilna_1.jpg'),
(3, 'nikola', 'sifra123', 'Nikola', 'Milicevic', 'muski', 'nikola@gmail.com', '1998-03-04', 'admin', '7.00', 'Ja sam Nikola i ja sam admin', '../../public/uploads/nikola_profilna.jpg'),
(4, 'aleksandra', 'sifra123', 'Aleksandra', 'Bogicevic', 'zenski', 'aleksandra@gmail.com', '1998-03-04', 'admin', '3.00', 'Ja sam Aleksandra i ja sam admin', '../../public/uploads/aleksandra_profilna.jpg'),
(7, 'ognjen', 'sifra123', 'ognjen', 'subaric', 'muski', 'ogi@gmail.com', '1998-01-04', 'obican', '0.00', 'Ja sam uzoran student Ja sam uzoran student Ja sam uzoran student ', '../../public/uploads/ognjen_profilna_1.jpg'),
(9, 'lepabrena', 'sifra123', 'lepa', 'brena', 'zenski', 'lepa@gmail.com', '1950-02-02', 'obican', '0.00', 'Idemo da pijemo alkoholna pica. Idemo da pijemo alkoholna pica. ', '../../public/uploads/lepabrena_profilna.jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objava`
--

INSERT INTO `objava` (`idObj`, `naziv`, `kategorija`, `br_potrebnih_clanova`, `br_prijavljenih_clanova`, `datum`, `vreme`, `mesto`, `opis`, `tip`, `idKor`) VALUES
(8, 'Izlazak', 'Izlasci-Kafane', 2, 2, '2020-05-21', '20:00:00', 'Kafana Limun Crven', 'Idemo da pijemo alkoholna picaIdemo da pijemo alkoholna pica', 'premium', 8),
(9, 'Pevanje', 'Izlasci-Rejv', 100, 1, '2020-05-30', '07:00:00', 'Trg', 'Idemo da pijemo alkoholna pica. Idemo da pijemo alkoholna pica', 'besplatna', 9),
(3, 'Pozorisna predstava', 'Kultura', 10, 4, '2020-05-25', '20:00:00', 'Vracar', 'Potrebno jos 9 osoba zainteresovanih za organizovanje predstave Umri muski   , pozeljno glumacko iskustvo', 'besplatna', 3),
(4, 'NAJJACA OBJAVA IKAD', 'Izlasci-Rejv', 50, 2, '2020-08-18', '23:59:00', 'blok 70', 'rejv blok 70 pod nazivom \"sirimo covid-19\". idemo sviiii', 'premium', 4),
(5, 'NAJJACA OBJAVA IKAD2', 'Sport-Odbojka', 12, 1, '2020-05-15', '10:00:00', 'ada', 'ajmo svi na odbojke', 'obicna', 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocenio`
--

INSERT INTO `ocenio` (`id`, `idOcenio`, `idOcenjen`, `tip_ocene`) VALUES
(17, 9, 8, 'pozitivna'),
(14, 8, 4, 'pozitivna'),
(15, 9, 4, 'negativna'),
(16, 9, 3, 'pozitivna');

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
(9, 3),
(9, 4),
(9, 8);

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
