-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2019. Ápr 05. 03:23
-- Kiszolgáló verziója: 5.7.24
-- PHP verzió: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szakdolgozat_ab`
--
CREATE DATABASE IF NOT EXISTS `szakdolgozat_ab` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `szakdolgozat_ab`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminok`
--

DROP TABLE IF EXISTS `adminok`;
CREATE TABLE IF NOT EXISTS `adminok` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `felhasznalonev` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `adminok`
--

INSERT INTO `adminok` (`adminid`, `felhasznalonev`, `jelszo`) VALUES
(2, 'Admin', '$2y$10$RUH5Gf1/ZT2KYkjzeCEme.Y4M4JWmSh0arWulF3qp.GJxFOokjmCS'),
(3, 'a1', '$2y$10$hOmKLFTjAiBLg5l1PVQlA.OqpOnKSx/td5cpl892oX1QA57mwChzS');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `diakok`
--

DROP TABLE IF EXISTS `diakok`;
CREATE TABLE IF NOT EXISTS `diakok` (
  `diakid` int(11) NOT NULL AUTO_INCREMENT,
  `osztalyid` int(11) NOT NULL,
  `vezeteknev` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `keresztnev` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `oktatasi_azon` bigint(11) NOT NULL COMMENT 'bejelentkezéshez',
  `jelszo` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`diakid`),
  UNIQUE KEY `oktatasi_azon` (`oktatasi_azon`),
  KEY `osztalyid` (`osztalyid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `diakok`
--

INSERT INTO `diakok` (`diakid`, `osztalyid`, `vezeteknev`, `keresztnev`, `oktatasi_azon`, `jelszo`) VALUES
(1, 1, 'Szabó', 'András', 77526118115, '$2y$10$XgMJVNB66SQIruS0rVMoCOSiHiP4qI1M0CzvO8vGe4kH6islrS91.'),
(2, 1, 'B', 'B', 123, '$2y$10$eI.vP730GAcZek0UJpcipOztr1FuOIh/aA/wrhDk8ozkyUbJbMKFK'),
(3, 2, 'D', 'D', 456, '$2y$10$bHCCyE6F16eIki/GUInl3uIwkUhEWPR9xq8Tx.ahCFH6JGYAReXES'),
(4, 3, 'd', 'd', 5463, '$2y$10$l1BhYggBwya8GGyaT7ITEOfu9/YZKk5fLAzbfSocfwjQ7WHpU1xMS'),
(5, 3, 'Molnár', 'Tímea', 12345678910, '$2y$10$3OqSC/ghfp2zZ.apUivv0u8MY9LkS.RpGWdfFxndoaDyK7Z1MUe8q'),
(9, 3, 'Molnár', 'Piroska', 546417, '$2y$10$68i28aDXaAn73xPtSyNE3eqziePxosPWSjgcMmDDWhBkJ38iZSzCC'),
(12, 3, 'Molnár', 'Piroska', 11111, '$2y$10$Q/ChfJXbcN8sW/LyjI61buKEeC21RnGiBxMFcbJfQOGqx4TBGS2gi'),
(13, 1, 'Juhász', 'Martin', 777654, '$2y$10$eRxttRASnfMzWWJZVsPtFeVXT1m0IUOqxP184vBs2UCK6TtneLx7a');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `diakokvalaszai`
--

DROP TABLE IF EXISTS `diakokvalaszai`;
CREATE TABLE IF NOT EXISTS `diakokvalaszai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diakid` int(11) NOT NULL,
  `kerdesid` int(11) NOT NULL,
  `diakvalasza` varchar(500) COLLATE utf8_hungarian_ci NOT NULL,
  `helyes` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `diakid` (`diakid`),
  KEY `kerdesid` (`kerdesid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `diakokvalaszai`
--

INSERT INTO `diakokvalaszai` (`id`, `diakid`, `kerdesid`, `diakvalasza`, `helyes`) VALUES
(53, 2, 1, ' bárány ', b'0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kepek`
--

DROP TABLE IF EXISTS `kepek`;
CREATE TABLE IF NOT EXISTS `kepek` (
  `kepid` int(11) NOT NULL AUTO_INCREMENT,
  `kepnev` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  UNIQUE KEY `kepid` (`kepid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kepek`
--

INSERT INTO `kepek` (`kepid`, `kepnev`) VALUES
(1, 'matek.png'),
(2, 'matek2.jpg'),
(4, 'England-Flag.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdesek`
--

DROP TABLE IF EXISTS `kerdesek`;
CREATE TABLE IF NOT EXISTS `kerdesek` (
  `kerdesid` int(11) NOT NULL AUTO_INCREMENT,
  `tesztid` int(11) NOT NULL,
  `tipus` int(11) NOT NULL,
  `szoveg` text COLLATE utf8_hungarian_ci NOT NULL,
  `szovegkep` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kerdes` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `kerdeskep` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`kerdesid`),
  KEY `tesztid` (`tesztid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdesek`
--

INSERT INTO `kerdesek` (`kerdesid`, `tesztid`, `tipus`, `szoveg`, `szovegkep`, `kerdes`, `kerdeskep`) VALUES
(1, 3, 2, '', '', 'Mit jelent a sheep angolul?', ''),
(2, 3, 1, '', '', 'Mennyi szín található Anglia zászlóján?', ''),
(3, 3, 3, '', 'England-Flag.jpg', 'Milyen színek található Anglia zászlóján?', ''),
(4, 3, 4, '', '', 'Melyik ital gyártásában az angolok az elsők', ''),
(5, 2, 2, 'excel sz.beírós', '', 'excel sz.beírós 2', ''),
(6, 2, 4, 'excel dropdown1', '', 'excel dropdown2', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `osztalyok`
--

DROP TABLE IF EXISTS `osztalyok`;
CREATE TABLE IF NOT EXISTS `osztalyok` (
  `osztalyid` int(11) NOT NULL AUTO_INCREMENT,
  `kezdeseve` int(11) NOT NULL,
  `vegzeseve` int(11) NOT NULL,
  `megnevezes` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`osztalyid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `osztalyok`
--

INSERT INTO `osztalyok` (`osztalyid`, `kezdeseve`, `vegzeseve`, `megnevezes`) VALUES
(1, 2017, 2019, 'nyelvi'),
(2, 2017, 2019, 'a'),
(3, 2017, 2019, 'AJTP'),
(4, 2016, 2017, 'huszár'),
(5, 2020, 2021, 'Zenész'),
(6, 2016, 2017, 'huszár'),
(7, 2020, 2021, 'Zenész'),
(8, 2015, 2020, 'Orvosi');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tanar`
--

DROP TABLE IF EXISTS `tanar`;
CREATE TABLE IF NOT EXISTS `tanar` (
  `tanarid` int(11) NOT NULL AUTO_INCREMENT,
  `vezeteknev` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `keresztnev` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `felhasznalonev` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`tanarid`),
  UNIQUE KEY `felhasznalonev` (`felhasznalonev`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tanar`
--

INSERT INTO `tanar` (`tanarid`, `vezeteknev`, `keresztnev`, `felhasznalonev`, `jelszo`) VALUES
(3, 'Dörmögő', 'Dömötör', 'dördöm', '$2y$10$GHvsGvcCIi.up7Vr2WmOleDL8NhM29OcBgJgZi9ZE/E9kyLMw9dJ.'),
(4, 'Pasku', 'Balázs', 'Balu', '$2y$10$VS2GXzAQ86XwgD9WpW3d7.MROsunjwUGoUHKEqjSOiarQLB1.Ntuu'),
(5, 'Szabó', 'Attila', 'Szaboa', '$2y$10$TbBx/yU7IdYop59ImH.1GucIP3pK4.VUNsEvYNPXWtxhjqQpTDXxG');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tanitasok`
--

DROP TABLE IF EXISTS `tanitasok`;
CREATE TABLE IF NOT EXISTS `tanitasok` (
  `osztalyid` int(11) NOT NULL,
  `tantargyid` int(11) NOT NULL,
  `tanarid` int(11) DEFAULT NULL,
  KEY `osztalyid` (`osztalyid`),
  KEY `tanarid` (`tanarid`),
  KEY `tantargyid` (`tantargyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tanitasok`
--

INSERT INTO `tanitasok` (`osztalyid`, `tantargyid`, `tanarid`) VALUES
(1, 4, NULL),
(1, 6, NULL),
(2, 4, NULL),
(2, 6, NULL),
(3, 2, NULL),
(3, 3, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tantargyak`
--

DROP TABLE IF EXISTS `tantargyak`;
CREATE TABLE IF NOT EXISTS `tantargyak` (
  `tantargyid` int(11) NOT NULL AUTO_INCREMENT,
  `megnevezes` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`tantargyid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tantargyak`
--

INSERT INTO `tantargyak` (`tantargyid`, `megnevezes`) VALUES
(2, 'Matek 9.osztaly'),
(3, 'Magyar 9.osztaly'),
(4, 'Angol haladó'),
(5, 'Német haladó'),
(6, 'Angol kezdő'),
(7, 'Német kezdő'),
(8, 'Kémia');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tesztek`
--

DROP TABLE IF EXISTS `tesztek`;
CREATE TABLE IF NOT EXISTS `tesztek` (
  `tesztid` int(11) NOT NULL AUTO_INCREMENT,
  `tantargyid` int(11) NOT NULL,
  `tema` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `megnevezes` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `aktiv` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`tesztid`),
  KEY `tanrargyId` (`tantargyid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tesztek`
--

INSERT INTO `tesztek` (`tesztid`, `tantargyid`, `tema`, `megnevezes`, `aktiv`) VALUES
(2, 4, 'Matek teszt2', 'nyelvi', b'1'),
(3, 6, 'Angol kultúra', 'Szint felmérő', b'1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `valaszlehetosegek`
--

DROP TABLE IF EXISTS `valaszlehetosegek`;
CREATE TABLE IF NOT EXISTS `valaszlehetosegek` (
  `kerdesid` int(11) NOT NULL,
  `valaszid` int(11) NOT NULL AUTO_INCREMENT,
  `valasz` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `helyes_e` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`valaszid`),
  KEY `kerdesID` (`kerdesid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `valaszlehetosegek`
--

INSERT INTO `valaszlehetosegek` (`kerdesid`, `valaszid`, `valasz`, `helyes_e`) VALUES
(2, 1, '2', b'1'),
(1, 2, 'bárány', b'1'),
(3, 3, 'fehér', b'1'),
(3, 4, 'kék', b'0'),
(4, 5, 'cider', b'1'),
(5, 9, 'excel', b'1'),
(1, 10, 'bírka', b'1'),
(2, 11, '4', b'0'),
(2, 12, '6', b'0'),
(3, 13, 'piros', b'1'),
(3, 14, 'fekete', b'0'),
(4, 15, 'fanta', b'0'),
(4, 16, 'Kóla', b'0');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `diakok`
--
ALTER TABLE `diakok`
  ADD CONSTRAINT `diakok_ibfk_1` FOREIGN KEY (`osztalyid`) REFERENCES `osztalyok` (`osztalyid`);

--
-- Megkötések a táblához `diakokvalaszai`
--
ALTER TABLE `diakokvalaszai`
  ADD CONSTRAINT `diakokvalaszai_ibfk_1` FOREIGN KEY (`diakid`) REFERENCES `diakok` (`diakid`),
  ADD CONSTRAINT `diakokvalaszai_ibfk_2` FOREIGN KEY (`kerdesid`) REFERENCES `kerdesek` (`kerdesid`);

--
-- Megkötések a táblához `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD CONSTRAINT `kerdesek_ibfk_1` FOREIGN KEY (`tesztid`) REFERENCES `tesztek` (`tesztid`);

--
-- Megkötések a táblához `tanitasok`
--
ALTER TABLE `tanitasok`
  ADD CONSTRAINT `tanitasok_ibfk_1` FOREIGN KEY (`osztalyid`) REFERENCES `osztalyok` (`osztalyid`),
  ADD CONSTRAINT `tanitasok_ibfk_2` FOREIGN KEY (`tanarid`) REFERENCES `tanar` (`tanarid`),
  ADD CONSTRAINT `tanitasok_ibfk_3` FOREIGN KEY (`tantargyid`) REFERENCES `tantargyak` (`tantargyid`);

--
-- Megkötések a táblához `tesztek`
--
ALTER TABLE `tesztek`
  ADD CONSTRAINT `tesztek_ibfk_1` FOREIGN KEY (`tantargyid`) REFERENCES `tantargyak` (`tantargyid`);

--
-- Megkötések a táblához `valaszlehetosegek`
--
ALTER TABLE `valaszlehetosegek`
  ADD CONSTRAINT `valaszlehetosegek_ibfk_1` FOREIGN KEY (`kerdesid`) REFERENCES `kerdesek` (`kerdesid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
