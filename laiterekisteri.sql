-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 24.11.2018 klo 15:41
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
('Admin', 'root', 'Admini'),
('Juha', 'kurkku', 'Juha'),
('Pekka', 'kurkku', 'Pekka');

-- --------------------------------------------------------

--
-- Rakenne taululle `kategoria`
--

DROP TABLE IF EXISTS `kategoria`;
CREATE TABLE IF NOT EXISTS `kategoria` (
  `KATEGORIA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KATEGORIA_NIMI` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`KATEGORIA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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
  `MALLI` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `KUVAUS` tinytext COLLATE utf8_swedish_ci NOT NULL,
  `SIJAINTI` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`LAITE_ID`),
  KEY `KATEGORIA_ID` (`KATEGORIA_ID`),
  KEY `OMISTAJA_ID` (`OMISTAJA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `laite`
--

INSERT INTO `laite` (`LAITE_ID`, `LAITE_NIMI`, `MERKKI`, `KATEGORIA_ID`, `OMISTAJA_ID`, `MALLI`, `KUVAUS`, `SIJAINTI`) VALUES
(1, 'Huawei Honor 9', 'Huawei', 1, 1, 'Honor', 'Erittäin kiva puhelin.', 'Kuopio'),
(2, 'OnePlus 6', 'OnePlus', 1, 3, '6', 'Kivempi puhelin', 'Kuopio');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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
  `LAITE_ID` int(11) NOT NULL,
  `ALKUPVM` date NOT NULL,
  `LOPPUPVM` date NOT NULL,
  `STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `ASIAKAS_TUNNUS` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `LAITE_ID` (`LAITE_ID`),
  KEY `ASIAKAS_TUNNUS` (`ASIAKAS_TUNNUS`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `varaus`
--

INSERT INTO `varaus` (`ID`, `LAITE_ID`, `ALKUPVM`, `LOPPUPVM`, `STATUS`, `ASIAKAS_TUNNUS`) VALUES
(1, 1, '2018-11-08', '2018-11-06', 'varattu', 'Pekka'),
(2, 2, '2018-11-20', '2018-11-22', 'lainattu', 'Pekka');

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `laite`
--
ALTER TABLE `laite`
  ADD CONSTRAINT `laite_ibfk_1` FOREIGN KEY (`KATEGORIA_ID`) REFERENCES `kategoria` (`KATEGORIA_ID`),
  ADD CONSTRAINT `laite_ibfk_2` FOREIGN KEY (`OMISTAJA_ID`) REFERENCES `omistaja` (`OMISTAJA_ID`);

--
-- Rajoitteet taululle `varaus`
--
ALTER TABLE `varaus`
  ADD CONSTRAINT `varaus_ibfk_1` FOREIGN KEY (`LAITE_ID`) REFERENCES `laite` (`LAITE_ID`),
  ADD CONSTRAINT `varaus_ibfk_2` FOREIGN KEY (`ASIAKAS_TUNNUS`) REFERENCES `asiakas` (`TUNNUS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
