-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2020 at 12:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `kode` varchar(200) NOT NULL,
  `alternatif` varchar(200) NOT NULL,
  `jenis_pickup` varchar(200) NOT NULL,
  `jenis_kayu` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `merk` varchar(200) NOT NULL,
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode`, `alternatif`, `jenis_pickup`, `jenis_kayu`, `harga`, `merk`, `photo`) VALUES
(45, 'A3', 'TRBX174', '34 ', '16 ', '19', '22 ', '943962.jpg'),
(46, 'A4', 'GLOBAL Series WL534S BM/M', '26 ', '15 ', '19', '22 ', '943962.jpg'),
(52, 'A2', 'SRMD200', '40 ', '16 ', '20', '25 ', '943962.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `rank` int(10) NOT NULL,
  `id_alternatif` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `rank`, `id_alternatif`) VALUES
(28, 1, 49),
(29, 2, 47),
(30, 3, 46),
(31, 4, 52),
(32, 5, 50),
(33, 6, 43),
(34, 7, 48),
(35, 8, 44),
(36, 9, 51),
(37, 10, 45);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode` varchar(110) NOT NULL,
  `kriteria` varchar(200) NOT NULL,
  `nilai` varchar(110) NOT NULL,
  `atribut` tinyint(4) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `kriteria`, `nilai`, `atribut`, `keterangan`) VALUES
(70, 'K1', '1', '4', 1, 'abc'),
(71, 'K2', '2', '5', 1, 'cba'),
(72, 'K3', '3', '3', 2, 'abc'),
(73, 'K4', '4', '2', 1, 'cba');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(77, 52, 70, 5),
(78, 52, 71, 2),
(79, 52, 72, 2),
(80, 52, 73, 4),
(81, 45, 70, 2),
(82, 45, 71, 2),
(83, 45, 72, 3),
(84, 45, 73, 2),
(85, 46, 70, 4),
(86, 46, 71, 4),
(87, 46, 72, 4),
(88, 46, 73, 3);

-- --------------------------------------------------------

--
-- Table structure for table `range_kriteria`
--

CREATE TABLE `range_kriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `range_kriteria` varchar(200) NOT NULL,
  `nilai` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `range_kriteria`
--

INSERT INTO `range_kriteria` (`id`, `id_kriteria`, `range_kriteria`, `nilai`) VALUES
(10, 70, 'Bachuss Original', '5'),
(11, 70, 'Split Single Coil / Ceramic', '2'),
(12, 70, 'V-Mod Jazz Bass Pickup Set', '4'),
(13, 70, 'ACHB-2 Humbucker Pickup, nickeleck (CR)', '3'),
(14, 71, 'Alder ', '5'),
(15, 71, 'maple ', '4'),
(16, 71, 'Poplar', '2'),
(17, 72, '100000 - 3000000', '5'),
(18, 72, '3000000 - 5000000', '4'),
(19, 72, '5000000 - 7500000', '3'),
(20, 72, '7500000 - 10000000', '2'),
(21, 73, 'Fender', '3'),
(22, 73, 'Ibanez', '3'),
(23, 73, 'Yamaha', '3'),
(24, 73, 'Bachuss', '3'),
(25, 73, 'Schecter', '3'),
(26, 70, 'MONSTERTONE J (modern)', '4'),
(27, 70, 'Original Precision Bass® Pickups', '4'),
(28, 70, 'Original Jazz Bass Pickups', '4'),
(29, 70, 'V-Mod Precision Bass® Pickup Set', '4'),
(30, 70, 'XP2 P-BASS ACTIVE PICKUP', '3'),
(31, 70, 'nickelECK ADX6, BASS', '3'),
(32, 70, 'BRIDGE ADX6, BASS', '3'),
(33, 70, 'BRIDGE DXH2, BASS', '3'),
(34, 70, 'DiMarzio WillPower', '2'),
(35, 70, 'Double Coil / Alnico V', '2'),
(36, 70, 'Yamaha Custom Stack Type / Alnico V', '2'),
(37, 70, 'Yamaha Custom Side-by-Side Type Double coil / Alnico V', '3'),
(38, 70, 'Original JB set', '5'),
(39, 70, 'Original J Type', '5'),
(40, 70, 'Original Humbucker Type', '5'),
(41, 70, 'AG 4J-HOT', '3'),
(42, 70, 'MONSTERTONE P (modern)', '4'),
(43, 70, 'PASADENA VJ (vintage)', '3'),
(44, 70, 'PASADENA VP (vintage)', '3'),
(45, 70, 'MICHAEL ANTHONY 78 SIGNATURE (vintage)', '4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `range_kriteria`
--
ALTER TABLE `range_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `range_kriteria`
--
ALTER TABLE `range_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
