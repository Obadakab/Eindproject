-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 01:16 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `factuur`
--

CREATE TABLE `factuur` (
  `prefix` varchar(3) NOT NULL DEFAULT 'FAC',
  `factuurid` int(32) NOT NULL,
  `status` varchar(12) NOT NULL,
  `bedrag` double NOT NULL,
  `ts_issued` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ts_paid` timestamp NULL DEFAULT NULL,
  `ts_canceled` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factuur`
--

INSERT INTO `factuur` (`prefix`, `factuurid`, `status`, `bedrag`, `ts_issued`, `ts_paid`, `ts_canceled`) VALUES
('FAC', 14000, 'Betaald', 354.57, '2021-05-07 22:08:27', '2021-06-07 22:08:27', NULL),
('FAC', 14001, 'Betaald', 320.65, '2021-10-07 22:05:26', '2021-06-07 22:05:26', NULL),
('FAC', 14002, 'Onbetaald', 292.03, '2021-10-07 18:06:32', NULL, NULL),
('FAC', 14003, 'Betaald', 340.79, '2021-04-07 22:09:01', '2021-06-07 22:09:01', NULL),
('FAC', 14004, 'Onbetaald', 637.59, '2021-09-07 18:05:56', NULL, NULL),
('FAC', 14005, 'Onbetaald', 385.31, '2021-06-07 18:05:51', NULL, NULL),
('FAC', 14006, 'Onbetaald', 171.19, '2021-08-07 18:05:25', NULL, NULL),
('FAC', 14008, 'Onbetaald', 240.09, '2021-07-07 18:05:00', NULL, NULL),
('FAC', 14009, 'Onbetaald', 297.33, '2021-07-07 18:04:47', NULL, NULL),
('FAC', 14010, 'Onbetaald', 221.01, '2021-06-07 18:04:12', NULL, NULL),
('FAC', 14012, 'Onbetaald', 117.66, '2021-05-07 18:03:58', NULL, NULL),
('FAC', 14013, 'Onbetaald', 195.04, '2021-05-07 18:03:38', NULL, NULL),
('FAC', 14015, 'Onbetaald', 256.52, '2021-04-07 18:03:16', NULL, NULL),
('FAC', 14016, 'Onbetaald', 233.2, '2021-03-07 19:02:39', NULL, NULL),
('FAC', 14017, 'Onbetaald', 209.88, '2021-03-07 19:02:20', NULL, NULL),
('FAC', 14018, 'Onbetaald', 186.56, '2021-02-07 19:02:17', NULL, NULL),
('FAC', 14019, 'Onbetaald', 256.52, '2021-02-07 19:01:33', NULL, NULL),
('FAC', 14020, 'Onbetaald', 209.88, '2021-01-07 18:55:16', NULL, NULL),
('FAC', 14023, 'Betaald', 569.22, '2021-08-07 21:24:43', '2021-06-07 21:24:43', NULL),
('FAC', 14028, 'Onbetaald', 544.84, '2021-12-07 19:56:22', NULL, NULL),
('FAC', 14030, 'Betaald', 375.24, '2021-01-07 22:24:39', '2021-06-07 21:24:39', NULL),
('FAC', 14031, 'Onbetaald', 277.72, '2021-02-07 19:25:10', NULL, NULL),
('FAC', 14034, 'Betaald', 426.12, '2021-11-07 22:24:03', '2021-06-07 21:24:03', NULL),
('FAC', 14035, 'Betaald', 213.59, '2021-11-07 22:01:30', NULL, NULL),
('FAC', 14036, 'Onbetaald', 214.12, '2021-06-07 22:48:00', NULL, NULL),
('FAC', 14037, 'Onbetaald', 268.18, '2021-06-07 23:06:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `prefix` varchar(3) NOT NULL DEFAULT 'KLA',
  `klantnr` int(32) NOT NULL,
  `voornaam` varchar(32) NOT NULL,
  `achternaam` varchar(32) NOT NULL,
  `adres` varchar(32) NOT NULL,
  `huisnummer` int(32) NOT NULL,
  `postcode` varchar(32) NOT NULL,
  `woonplaats` varchar(32) NOT NULL,
  `tel` int(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`prefix`, `klantnr`, `voornaam`, `achternaam`, `adres`, `huisnummer`, `postcode`, `woonplaats`, `tel`, `email`) VALUES
('KLA', 6750, 'test', 'testhee', 'Pine Street', 564, '9411EE', 'Haarlem', 2147483647, 'john@example.com'),
('KLA', 6751, 'bebbe', 'bobob', 'nasidjiajsd', 75, '6356GH', 'HHHHAA', 697413494, 'basbdi@naono.com'),
('KLA', 6752, 'bebbe', 'bobob', 'nasidjiajsd', 75, '6356GH', 'HHHHAA', 697413494, 'basbdi@naono.com'),
('KLA', 6753, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6754, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6755, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6756, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6758, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6759, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6760, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6762, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6763, 'ertewr', 'ywrwerq', 'Pine Street', 66, '9411PP', 'MEMEM', 1241235123, 'john@example.com'),
('KLA', 6765, 'final', 'ywrwerq', 'Pine Street', 564, '9411EE', 'ijmiu', 2147483647, 'john@example.com'),
('KLA', 6766, 'final', 'ywrwerq', 'Pine Street', 564, '9411EE', 'ijmiu', 2147483647, 'john@example.com'),
('KLA', 6767, 'final', 'ywrwerq', 'Pine Street', 564, '9411EE', 'ijmiu', 2147483647, 'john@example.com'),
('KLA', 6768, 'final', 'ywrwerq', 'Pine Street', 564, '9411EE', 'ijmiu', 2147483647, 'john@example.com'),
('KLA', 6769, 'final', 'ywrwerq', 'Pine Street', 564, '9411EE', 'ijmiu', 2147483647, 'john@example.com'),
('KLA', 6770, 'final', 'ywrwerq', 'Pine Street', 564, '9411EE', 'ijmiu', 2147483647, 'john@example.com'),
('KLA', 6773, 'lalalal', 'alalala', 'kasjdkna', 1456, '3698GF', 'nbejnfajn', 2147483647, 'lalala@lalalal.com'),
('KLA', 6778, 'blalvlabla', 'lalsdlasdlk', 'nhaskdla', 7959, '6541TT', 'andogjqowlmr', 2147483647, 'balblalba@ladkglasm.com'),
('KLA', 6780, 'oansfkn', 'kadgiqejr', 'masifhim', 654, '3697RR', 'iadhgin', 2147483647, 'jnaskfnk@naofj.com'),
('KLA', 6781, 'oansfkn', 'kadgiqejr', 'masifhim', 654, '3697RR', 'iadhgin', 2147483647, 'jnaskfnk@naofj.com'),
('KLA', 6783, 'oansfkn', 'kadgiqejr', 'masifhim', 654, '3697RR', 'iadhgin', 2147483647, 'jnaskfnk@naofj.com'),
('KLA', 6784, 'oansfkn', 'kadgiqejr', 'masifhim', 654, '3697RR', 'iadhgin', 2147483647, 'jnaskfnk@naofj.com'),
('KLA', 6785, 'qweqwe', 'tryghnfgb', 'agahewq', 693, '6579KK', 'qweqtaz', 659723104, 'fhjdghsg@abasczx.com'),
('KLA', 6786, 'finaaal ', 'test', 'lalallstraat', 6930, '6574NN', 'ijmiu', 649523794, 'finaaal@example.com'),
('KLA', 6787, 'Obada', 'Kabbani', 'Pine Street', 36, '9411LL', 'Haarlem', 2147483647, 'john@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `medewerker`
--

CREATE TABLE `medewerker` (
  `medewerkerid` int(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `user_type` varchar(32) NOT NULL,
  `wachtwoord` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medewerker`
--

INSERT INTO `medewerker` (`medewerkerid`, `username`, `email`, `user_type`, `wachtwoord`) VALUES
(6, 'obada', 'obada.kabbani@live.com', 'admin', 81),
(7, 'eva', 'eva@example.com', 'user', 0),
(8, 'ramon', 'ramon@example.com', 'admin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `optie`
--

CREATE TABLE `optie` (
  `optienr` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `reserveringnr` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `optie`
--

INSERT INTO `optie` (`optienr`, `aantal`, `reserveringnr`) VALUES
(1, 3, 963000),
(2, 1, 963000),
(3, 2, 963000),
(4, 3, 963000),
(5, 3, 963000),
(6, 7, 963000),
(7, 0, 963000),
(8, 9, 963000),
(9, 1, 963000),
(1, 4, 963001),
(2, 1, 963001),
(3, 0, 963001),
(4, 4, 963001),
(5, 4, 963001),
(6, 8, 963001),
(7, 0, 963001),
(8, 7, 963001),
(9, 1, 963001),
(1, 4, 963002),
(2, 1, 963002),
(3, 0, 963002),
(4, 4, 963002),
(5, 4, 963002),
(6, 8, 963002),
(7, 0, 963002),
(8, 7, 963002),
(9, 1, 963002),
(1, 4, 963003),
(2, 3, 963003),
(3, 0, 963003),
(4, 6, 963003),
(5, 6, 963003),
(6, 6, 963003),
(7, 0, 963003),
(8, 9, 963003),
(9, 1, 963003),
(1, 4, 963004),
(2, 3, 963004),
(3, 0, 963004),
(4, 6, 963004),
(5, 6, 963004),
(6, 6, 963004),
(7, 0, 963004),
(8, 9, 963004),
(9, 1, 963004),
(1, 6, 963005),
(2, 2, 963005),
(3, 0, 963005),
(4, 6, 963005),
(5, 6, 963005),
(6, 6, 963005),
(7, 0, 963005),
(8, 9, 963005),
(9, 1, 963005),
(1, 2, 963006),
(2, 1, 963006),
(3, 0, 963006),
(4, 6, 963006),
(5, 6, 963006),
(6, 6, 963006),
(7, 0, 963006),
(8, 9, 963006),
(9, 1, 963006),
(1, 3, 963008),
(2, 0, 963008),
(3, 0, 963008),
(4, 5, 963008),
(5, 5, 963008),
(6, 5, 963008),
(7, 0, 963008),
(8, 9, 963008),
(9, 1, 963008),
(1, 3, 963009),
(2, 0, 963009),
(3, 0, 963009),
(4, 5, 963009),
(5, 5, 963009),
(6, 5, 963009),
(7, 0, 963009),
(8, 9, 963009),
(9, 1, 963009),
(1, 3, 963010),
(2, 0, 963010),
(3, 0, 963010),
(4, 5, 963010),
(5, 5, 963010),
(6, 5, 963010),
(7, 0, 963010),
(8, 9, 963010),
(9, 1, 963010),
(1, 3, 963012),
(2, 0, 963012),
(3, 0, 963012),
(4, 3, 963012),
(5, 2, 963012),
(6, 5, 963012),
(7, 0, 963012),
(8, 6, 963012),
(9, 1, 963012),
(1, 3, 963013),
(2, 0, 963013),
(3, 0, 963013),
(4, 6, 963013),
(5, 6, 963013),
(6, 6, 963013),
(7, 0, 963013),
(8, 8, 963013),
(9, 1, 963013),
(1, 3, 963015),
(2, 1, 963015),
(3, 0, 963015),
(4, 5, 963015),
(5, 5, 963015),
(6, 6, 963015),
(7, 0, 963015),
(8, 8, 963015),
(9, 1, 963015),
(1, 3, 963016),
(2, 1, 963016),
(3, 0, 963016),
(4, 5, 963016),
(5, 5, 963016),
(6, 6, 963016),
(7, 0, 963016),
(8, 8, 963016),
(9, 1, 963016),
(1, 3, 963017),
(2, 1, 963017),
(3, 0, 963017),
(4, 5, 963017),
(5, 5, 963017),
(6, 6, 963017),
(7, 0, 963017),
(8, 8, 963017),
(9, 1, 963017),
(1, 3, 963018),
(2, 1, 963018),
(3, 0, 963018),
(4, 5, 963018),
(5, 5, 963018),
(6, 6, 963018),
(7, 0, 963018),
(8, 8, 963018),
(9, 1, 963018),
(1, 3, 963019),
(2, 1, 963019),
(3, 0, 963019),
(4, 5, 963019),
(5, 5, 963019),
(6, 6, 963019),
(7, 0, 963019),
(8, 8, 963019),
(9, 1, 963019),
(1, 3, 963020),
(2, 1, 963020),
(3, 0, 963020),
(4, 5, 963020),
(5, 5, 963020),
(6, 6, 963020),
(7, 0, 963020),
(8, 8, 963020),
(9, 1, 963020),
(1, 3, 963023),
(2, 2, 963023),
(3, 0, 963023),
(4, 7, 963023),
(5, 7, 963023),
(6, 7, 963023),
(7, 1, 963023),
(8, 10, 963023),
(9, 1, 963023),
(1, 3, 963028),
(2, 1, 963028),
(3, 0, 963028),
(4, 6, 963028),
(5, 6, 963028),
(6, 6, 963028),
(7, 1, 963028),
(8, 2, 963028),
(9, 0, 963028),
(1, 5, 963030),
(2, 1, 963030),
(3, 0, 963030),
(4, 6, 963030),
(5, 6, 963030),
(6, 8, 963030),
(7, 1, 963030),
(8, 12, 963030),
(9, 1, 963030),
(1, 5, 963031),
(2, 1, 963031),
(3, 0, 963031),
(4, 7, 963031),
(5, 7, 963031),
(6, 8, 963031),
(7, 1, 963031),
(8, 12, 963031),
(9, 1, 963031),
(1, 4, 963034),
(2, 0, 963034),
(3, 0, 963034),
(4, 4, 963034),
(5, 4, 963034),
(6, 4, 963034),
(7, 1, 963034),
(8, 8, 963034),
(9, 1, 963034),
(1, 3, 963035),
(2, 1, 963035),
(3, 4, 963035),
(4, 4, 963035),
(5, 4, 963035),
(6, 4, 963035),
(7, 0, 963035),
(8, 7, 963035),
(9, 1, 963035),
(1, 3, 963036),
(2, 1, 963036),
(3, 0, 963036),
(4, 2, 963036),
(5, 1, 963036),
(6, 4, 963036),
(7, 0, 963036),
(8, 4, 963036),
(9, 1, 963036),
(1, 3, 963037),
(2, 1, 963037),
(3, 1, 963037),
(4, 6, 963037),
(5, 6, 963037),
(6, 4, 963037),
(7, 1, 963037),
(8, 6, 963037),
(9, 1, 963037);

-- --------------------------------------------------------

--
-- Table structure for table `opties`
--

CREATE TABLE `opties` (
  `optienr` int(32) NOT NULL,
  `optienaam` varchar(32) NOT NULL,
  `optieprijs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opties`
--

INSERT INTO `opties` (`optienr`, `optienaam`, `optieprijs`) VALUES
(1, 'aantalvolwassenen', 5),
(2, 'aantalkinderen', 4),
(3, 'bezoekers', 2),
(4, 'wasmachine ', 6),
(5, 'wasdroger', 4),
(6, 'elektriciteit ', 2),
(7, 'huisdier', 2),
(8, 'douche ', 0.5),
(9, 'parkeerplaats', 3);

-- --------------------------------------------------------

--
-- Table structure for table `plaatentarief`
--

CREATE TABLE `plaatentarief` (
  `plaatsnaam` varchar(32) NOT NULL,
  `prijs` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plaatentarief`
--

INSERT INTO `plaatentarief` (`plaatsnaam`, `prijs`) VALUES
('CaravanGroot', 4),
('CaravanKlein', 2),
('TentGroot', 5),
('TentKline', 3);

-- --------------------------------------------------------

--
-- Table structure for table `plaatsen`
--

CREATE TABLE `plaatsen` (
  `plaatsnr` int(32) NOT NULL,
  `plaatsnaam` varchar(32) NOT NULL,
  `plaatsid` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plaatsen`
--

INSERT INTO `plaatsen` (`plaatsnr`, `plaatsnaam`, `plaatsid`) VALUES
(1, 'CaravanGroot', 'A1'),
(2, 'CaravanGroot', 'A2'),
(3, 'CaravanGroot', 'A3'),
(4, 'CaravanGroot', 'A4'),
(5, 'CaravanGroot', 'A5'),
(6, 'CaravanGroot', 'A6'),
(7, 'CaravanGroot', 'A7'),
(8, 'CaravanGroot', 'A8'),
(9, 'CaravanGroot', 'A9'),
(10, 'CaravanGroot', 'A10'),
(11, 'CaravanGroot', 'A11'),
(12, 'CaravanGroot', 'A12'),
(13, 'CaravanGroot', 'A13'),
(14, 'CaravanGroot', 'A14'),
(15, 'CaravanGroot', 'A15'),
(16, 'CaravanGroot', 'A16'),
(17, 'CaravanGroot', 'A17'),
(18, 'CaravanGroot', 'A18'),
(19, 'CaravanGroot', 'A19'),
(20, 'CaravanGroot', 'A20'),
(21, 'CaravanGroot', 'A21'),
(22, 'CaravanGroot', 'A22'),
(23, 'CaravanGroot', 'A23'),
(24, 'CaravanGroot', 'A24'),
(25, 'CaravanGroot', 'A25'),
(26, 'CaravanKline', 'B1'),
(27, 'CaravanKline', 'B2'),
(28, 'CaravanKline', 'B3'),
(29, 'CaravanKline', 'B4'),
(30, 'CaravanKline', 'B5'),
(31, 'CaravanKline', 'B6'),
(32, 'CaravanKline', 'B7'),
(33, 'CaravanKline', 'B8'),
(34, 'CaravanKline', 'B9'),
(35, 'CaravanKline', 'B10'),
(36, 'CaravanKline', 'B11'),
(37, 'CaravanKline', 'B12'),
(38, 'CaravanKline', 'B13'),
(39, 'CaravanKline', 'B14'),
(40, 'CaravanKline', 'B15'),
(41, 'CaravanKline', 'B16'),
(42, 'CaravanKline', 'B17'),
(43, 'CaravanKline', 'B18'),
(44, 'CaravanKline', 'B19'),
(45, 'CaravanKline', 'B20'),
(46, 'CaravanKline', 'B21'),
(47, 'CaravanKline', 'B22'),
(48, 'CaravanKline', 'B23'),
(49, 'CaravanKline', 'B24'),
(50, 'CaravanKline', 'B25'),
(51, 'TentGroot', 'C1'),
(52, 'TentGroot', 'C2'),
(53, 'TentGroot', 'C3'),
(54, 'TentGroot', 'C4'),
(55, 'TentGroot', 'C5'),
(56, 'TentGroot', 'C6'),
(57, 'TentGroot', 'C7'),
(58, 'TentGroot', 'C7'),
(59, 'TentGroot', 'C9'),
(60, 'TentGroot', 'C10'),
(61, 'TentGroot', 'C11'),
(62, 'TentGroot', 'C12'),
(63, 'TentGroot', 'C13'),
(64, 'TentGroot', 'C14'),
(65, 'TentGroot', 'C15'),
(66, 'TentGroot', 'C16'),
(67, 'TentGroot', 'C17'),
(68, 'TentGroot', 'C18'),
(69, 'TentGroot', 'C19'),
(70, 'TentGroot', 'C20'),
(71, 'TentGroot', 'C21'),
(72, 'TentGroot', 'C22'),
(73, 'TentGroot', 'C23'),
(74, 'TentGroot', 'C24'),
(75, 'TentGroot', 'C25'),
(76, 'TentKline', 'D1'),
(77, 'TentKline', 'D2'),
(78, 'TentKline', 'D3'),
(79, 'TentKline', 'D4'),
(80, 'TentKline', 'D5'),
(81, 'TentKline', 'D6'),
(82, 'TentKline', 'D7'),
(83, 'TentKline', 'D8'),
(84, 'TentKline', 'D9'),
(85, 'TentKline', 'D10'),
(86, 'TentKline', 'D11'),
(87, 'TentKline', 'D12'),
(88, 'TentKline', 'D13'),
(89, 'TentKline', 'D14'),
(90, 'TentKline', 'D15'),
(91, 'TentKline', 'D16'),
(92, 'TentKline', 'D17'),
(93, 'TentKline', 'D18'),
(94, 'TentKline', 'D19'),
(95, 'TentKline', 'D20'),
(96, 'TentKline', 'D21'),
(97, 'TentKline', 'D22'),
(98, 'TentKline', 'D23'),
(99, 'TentKline', 'D24'),
(100, 'TentKline', 'D25');

-- --------------------------------------------------------

--
-- Table structure for table `reservering`
--

CREATE TABLE `reservering` (
  `prefix` varchar(3) NOT NULL DEFAULT 'RES',
  `reserveringnr` int(32) NOT NULL,
  `klantnr` int(32) NOT NULL,
  `factuurid` int(32) NOT NULL,
  `datumaankomst` date NOT NULL,
  `datumvertrek` date NOT NULL,
  `plaatsnr` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservering`
--

INSERT INTO `reservering` (`prefix`, `reserveringnr`, `klantnr`, `factuurid`, `datumaankomst`, `datumvertrek`, `plaatsnr`) VALUES
('RES', 963000, 6750, 14000, '2021-08-16', '2021-08-27', 98),
('RES', 963001, 6751, 14001, '2021-09-28', '2021-10-07', 97),
('RES', 963002, 6752, 14002, '2021-09-29', '2021-10-07', 93),
('RES', 963003, 6753, 14003, '2021-07-15', '2021-07-22', 75),
('RES', 963004, 6754, 14004, '2021-07-15', '2021-07-30', 17),
('RES', 963005, 6755, 14005, '2021-08-10', '2021-08-17', 16),
('RES', 963006, 6756, 14006, '2021-10-26', '2021-10-31', 85),
('RES', 963008, 6758, 14008, '2021-12-01', '2021-12-10', 1),
('RES', 963009, 6759, 14009, '2021-12-14', '2021-12-26', 6),
('RES', 963010, 6760, 14010, '2021-12-22', '2021-12-30', 16),
('RES', 963012, 6762, 14012, '2021-02-24', '2021-02-28', 2),
('RES', 963013, 6763, 14013, '2021-03-01', '2021-03-07', 1),
('RES', 963015, 6765, 14015, '2021-05-11', '2021-05-19', 75),
('RES', 963016, 6766, 14016, '2021-05-12', '2021-05-19', 8),
('RES', 963017, 6767, 14017, '2021-05-25', '2021-05-31', 1),
('RES', 963018, 6768, 14018, '2021-05-26', '2021-05-31', 2),
('RES', 963019, 6769, 14019, '2021-05-04', '2021-05-12', 6),
('RES', 963020, 6770, 14020, '2021-05-06', '2021-05-12', 7),
('RES', 963023, 6773, 14023, '2021-12-07', '2021-12-23', 22),
('RES', 963028, 6778, 14028, '2021-12-08', '2021-12-29', 2),
('RES', 963030, 6780, 14030, '2021-01-13', '2021-01-21', 15),
('RES', 963031, 6781, 14031, '2021-02-10', '2021-02-15', 2),
('RES', 963034, 6784, 14034, '2021-03-09', '2021-03-23', 2),
('RES', 963035, 6785, 14035, '2021-03-16', '2021-03-21', 70),
('RES', 963036, 6786, 14036, '2021-06-16', '2021-06-24', 1),
('RES', 963037, 6787, 14037, '2021-06-16', '2021-06-23', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`factuurid`),
  ADD UNIQUE KEY `prefix` (`prefix`,`factuurid`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantnr`),
  ADD UNIQUE KEY `prefix` (`prefix`,`klantnr`);

--
-- Indexes for table `medewerker`
--
ALTER TABLE `medewerker`
  ADD PRIMARY KEY (`medewerkerid`);

--
-- Indexes for table `optie`
--
ALTER TABLE `optie`
  ADD KEY `optie_ibfk_1` (`optienr`),
  ADD KEY `optie_ibfk_2` (`reserveringnr`);

--
-- Indexes for table `opties`
--
ALTER TABLE `opties`
  ADD PRIMARY KEY (`optienr`);

--
-- Indexes for table `plaatentarief`
--
ALTER TABLE `plaatentarief`
  ADD PRIMARY KEY (`plaatsnaam`);

--
-- Indexes for table `plaatsen`
--
ALTER TABLE `plaatsen`
  ADD PRIMARY KEY (`plaatsnr`);

--
-- Indexes for table `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`reserveringnr`),
  ADD UNIQUE KEY `prefix` (`prefix`,`reserveringnr`),
  ADD KEY `plaatsnr` (`plaatsnr`),
  ADD KEY `klantnr` (`klantnr`),
  ADD KEY `factuurid` (`factuurid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factuur`
--
ALTER TABLE `factuur`
  MODIFY `factuurid` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14038;

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantnr` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6788;

--
-- AUTO_INCREMENT for table `medewerker`
--
ALTER TABLE `medewerker`
  MODIFY `medewerkerid` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plaatsen`
--
ALTER TABLE `plaatsen`
  MODIFY `plaatsnr` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `reservering`
--
ALTER TABLE `reservering`
  MODIFY `reserveringnr` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=963038;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `optie`
--
ALTER TABLE `optie`
  ADD CONSTRAINT `optie_ibfk_1` FOREIGN KEY (`optienr`) REFERENCES `opties` (`optienr`),
  ADD CONSTRAINT `optie_ibfk_2` FOREIGN KEY (`reserveringnr`) REFERENCES `reservering` (`reserveringnr`);

--
-- Constraints for table `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `reservering_ibfk_1` FOREIGN KEY (`plaatsnr`) REFERENCES `plaatsen` (`plaatsnr`),
  ADD CONSTRAINT `reservering_ibfk_2` FOREIGN KEY (`klantnr`) REFERENCES `klanten` (`klantnr`),
  ADD CONSTRAINT `reservering_ibfk_3` FOREIGN KEY (`factuurid`) REFERENCES `factuur` (`factuurid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
