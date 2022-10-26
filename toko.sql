-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 04:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `namaBarang` varchar(100) NOT NULL,
  `hargaBeli` double NOT NULL,
  `hargaJual` double NOT NULL,
  `stok` int(11) NOT NULL,
  `fotoBarang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`namaBarang`, `hargaBeli`, `hargaJual`, `stok`, `fotoBarang`) VALUES
('Audi A8', 300000000, 350000000, 2, 'Audi A8.jpg'),
('Honda Civic', 150000000, 200000000, 10, 'Honda Civic.png'),
('Honda Jazz', 200000000, 250000000, 10, 'Honda Jazz.jpg'),
('Honda Mobilio', 150000000, 200000000, 20, 'Honda Mobilio.jpg'),
('Mitsubishi Xpander', 250000000, 300000000, 25, 'Xpander.jpg'),
('Toyota Avanza', 120000000, 150000000, 10, 'Avanza.jpg'),
('Toyota Corolla', 250000000, 150000000, 10, 'Toyota Corolla.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`namaBarang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
