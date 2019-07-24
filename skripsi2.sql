-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 04:49 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi2`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pc`
--

CREATE TABLE `data_pc` (
  `id_pc` int(10) NOT NULL,
  `kode_inventori` varchar(50) NOT NULL,
  `id_dept` int(10) NOT NULL,
  `tgl_terakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pc`
--

INSERT INTO `data_pc` (`id_pc`, `kode_inventori`, `id_dept`, `tgl_terakhir`) VALUES
(1, 'SIM.2018.01.01.04.01', 11, '2016-05-25'),
(2, 'SIM.2018.01.01.04.02', 8, '2017-02-10'),
(3, 'SIM.2018.01.01.04.03', 3, '2017-01-14'),
(4, 'SIM.2018.01.01.04.04', 5, '2016-07-09'),
(5, 'SIM.2018.01.01.04.05', 4, '2016-03-01'),
(6, 'SIM.2018.01.01.04.06', 2, '2015-12-08'),
(7, 'SIM.2018.01.01.04.07', 12, '2015-11-05'),
(8, 'SIM.2018.01.01.04.08', 13, '2016-02-02'),
(9, 'SIM.2018.01.01.04.09', 5, '2015-07-29'),
(10, 'SIM.2018.01.01.04.10', 11, '2016-04-13'),
(11, 'SIM.2018.01.01.04.11', 2, '2015-05-11'),
(12, 'SIM.2018.01.01.04.12', 1, '2016-08-09'),
(13, 'SIM.2018.01.01.04.13', 10, '2015-08-22'),
(14, 'SIM.2018.01.01.04.14', 7, '2017-01-14'),
(15, 'SIM.2018.01.01.04.15', 6, '2016-12-13'),
(16, 'SIM.2018.01.01.04.16', 9, '2016-04-22'),
(17, 'SIM.2018.01.01.04.17', 1, '2015-05-11'),
(18, 'SIM.2018.01.01.04.18', 1, '2016-07-14'),
(19, 'SIM.2018.01.01.04.19', 4, '2017-04-11'),
(20, 'SIM.2018.01.01.04.20', 4, '2015-06-13'),
(21, 'SIM.2018.01.01.04.21', 6, '2016-01-28'),
(22, 'SIM.2018.01.01.04.22', 3, '2016-09-13'),
(23, 'SIM.2018.01.01.04.23', 11, '2015-12-18'),
(24, 'SIM.2018.01.01.04.24', 5, '2016-05-14'),
(25, 'SIM.2018.01.01.04.25', 6, '2016-08-15'),
(26, 'SIM.2018.01.01.04.26', 3, '2016-09-05'),
(27, 'SIM.2018.01.01.04.27', 8, '2016-03-15'),
(28, 'SIM.2018.01.01.04.28', 3, '2015-08-25'),
(29, 'SIM.2018.01.01.04.29', 7, '2016-04-19'),
(30, 'SIM.2018.01.01.04.30', 9, '2017-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id_dept` int(10) NOT NULL,
  `nm_dept` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id_dept`, `nm_dept`) VALUES
(1, 'Ayyub 1'),
(2, 'Ayyub 2'),
(3, 'Ayyub 3'),
(4, 'Sulaiman 3'),
(5, 'Sulaiman 4'),
(6, 'Sulaiman 5'),
(7, 'Sulaiman 6'),
(8, 'Ismail 2'),
(9, 'Yusuf 1'),
(10, 'Yusuf 2'),
(11, 'Yusuf 3'),
(12, 'Ibrahim 1'),
(13, 'Ibrahim 2');

-- --------------------------------------------------------

--
-- Table structure for table `slot_waktu`
--

CREATE TABLE `slot_waktu` (
  `id_slot` int(10) NOT NULL,
  `kode_hari` varchar(3) NOT NULL,
  `nama_hari` varchar(10) NOT NULL,
  `weekday` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_waktu`
--

INSERT INTO `slot_waktu` (`id_slot`, `kode_hari`, `nama_hari`, `weekday`) VALUES
(1, 'SN1', 'Senin', 1),
(2, 'SN2', 'Senin', 1),
(3, 'SL1', 'Selasa', 2),
(4, 'SL2', 'Selasa', 2),
(5, 'RB1', 'Rabu', 3),
(6, 'RB2', 'Rabu', 3),
(7, 'KM1', 'Kamis', 4),
(8, 'KM2', 'Kamis', 4),
(9, 'JU1', 'Jumat', 5),
(10, 'JU2', 'Jumat', 5),
(11, 'SB1', 'Sabtu', 6),
(12, 'SB2', 'Sabtu', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pc`
--
ALTER TABLE `data_pc`
  ADD PRIMARY KEY (`id_pc`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `slot_waktu`
--
ALTER TABLE `slot_waktu`
  ADD PRIMARY KEY (`id_slot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pc`
--
ALTER TABLE `data_pc`
  MODIFY `id_pc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id_dept` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `slot_waktu`
--
ALTER TABLE `slot_waktu`
  MODIFY `id_slot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
