-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06.11.2018 klo 16:30
-- Palvelimen versio: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laiterekisteri`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `asiakas`
--

DROP TABLE IF EXISTS `asiakas`;
CREATE TABLE IF NOT EXISTS `asiakas` (
  `TUNNUS` varchar(20) CHARACTER SET latin1 NOT NULL,
  `SALASANA` varchar(20) CHARACTER SET latin1 NOT NULL,
  `NIMI` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`TUNNUS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `asiakas`
--

INSERT INTO `asiakas` (`TUNNUS`, `SALASANA`, `NIMI`) VALUES
('Admin', 'root', 'Admini');

-- --------------------------------------------------------

--
-- Rakenne taululle `kategoria`
--

DROP TABLE IF EXISTS `kategoria`;
CREATE TABLE IF NOT EXISTS `kategoria` (
  `KATEGORIA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KATEGORIA_NIMI` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`KATEGORIA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `kategoria`
--

INSERT INTO `kategoria` (`KATEGORIA_ID`, `KATEGORIA_NIMI`) VALUES
(1, 'Puhelin'),
(2, 'Tabletti'),
(3, 'Kannettava tietokone'),
(4, 'Älykello'),
(5, 'Pöytäkone');

-- --------------------------------------------------------

--
-- Rakenne taululle `laite`
--

DROP TABLE IF EXISTS `laite`;
CREATE TABLE IF NOT EXISTS `laite` (
  `LAITE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LAITE_NIMI` varchar(30) CHARACTER SET latin1 NOT NULL,
  `MERKKI` varchar(30) CHARACTER SET latin1 NOT NULL,
  `KATEGORIA_ID` int(11) NOT NULL,
  `OMISTAJA_ID` int(11) NOT NULL,
  PRIMARY KEY (`LAITE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `omistaja`
--

DROP TABLE IF EXISTS `omistaja`;
CREATE TABLE IF NOT EXISTS `omistaja` (
  `OMISTAJA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OMISTAJA_NIMI` varchar(50) CHARACTER SET latin1 NOT NULL,
  `OSOITE` varchar(50) CHARACTER SET latin1 NOT NULL,
  `POSTINRO` varchar(5) CHARACTER SET latin1 NOT NULL,
  `POSTITMP` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`OMISTAJA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `omistaja`
--

INSERT INTO `omistaja` (`OMISTAJA_ID`, `OMISTAJA_NIMI`, `OSOITE`, `POSTINRO`, `POSTITMP`) VALUES
(1, 'Gigantti', 'Volttikatu 4', '70700', 'KUOPIO'),
(2, 'Power', 'Volttikatu 4', '70700', 'KUOPIO'),
(3, 'DNA', 'Kauppakatu 28', '70110', 'KUOPIO');

-- --------------------------------------------------------

--
-- Rakenne taululle `varaus`
--

DROP TABLE IF EXISTS `varaus`;
CREATE TABLE IF NOT EXISTS `varaus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LAITE_ID` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ALKUPVM` date NOT NULL,
  `LOPPUPVM` date NOT NULL,
  `STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `ASIAKAS_NIMI` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
