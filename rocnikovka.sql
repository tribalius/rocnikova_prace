-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 11. dub 2016, 00:53
-- Verze serveru: 10.1.10-MariaDB
-- Verze PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `rocnikovka`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `artist`
--

CREATE TABLE `artist` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Nazev` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `artist`
--

INSERT INTO `artist` (`Id`, `Nazev`) VALUES
(1, 'Gramatik'),
(2, 'Paramore');

-- --------------------------------------------------------

--
-- Struktura tabulky `lide`
--

CREATE TABLE `lide` (
  `Id` tinyint(3) UNSIGNED NOT NULL,
  `Jmeno` text COLLATE utf8_czech_ci NOT NULL,
  `Prijmeni` text COLLATE utf8_czech_ci NOT NULL,
  `Stat` text COLLATE utf8_czech_ci NOT NULL,
  `Artist` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `lide`
--

INSERT INTO `lide` (`Id`, `Jmeno`, `Prijmeni`, `Stat`, `Artist`) VALUES
(1, 'Denis', 'Jašarević', 'Slovenia', 1),
(2, 'Hayley', 'Williams', 'USA', 2),
(5, 'Taylor', 'York', 'USA', 2);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`Id`);

--
-- Klíče pro tabulku `lide`
--
ALTER TABLE `lide`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `artist`
--
ALTER TABLE `artist`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `lide`
--
ALTER TABLE `lide`
  MODIFY `Id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
