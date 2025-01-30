-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 03:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taryat_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_kategori` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_kategori`, `kode_barang`, `nama_barang`, `stock`, `harga`, `images`) VALUES
(3, 'KTG002', 'BRG002', 'Nescafe', '30', '10000', '1470172905_nescafe.jpg'),
(4, 'KTG002', 'BRG003', 'Teh Pucuk', '30', '3500', '1607005119_teh pucuk.jpg'),
(5, 'KTG001', 'BRG004', 'Nasi Kuning', '30', '5000', '1399471526_nasi kuning.jpg'),
(6, 'KTG001', 'BRG005', 'Basreng', '30', '2000', '1475041299_basreng.jpg'),
(7, 'KTG001', 'BRG006', 'Gorengan', '30', '1000', '1298639589_gorengan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detailtrans`
--

CREATE TABLE `detailtrans` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailtrans`
--

INSERT INTO `detailtrans` (`id`, `id_transaksi`, `kode_barang`, `qty`, `total`) VALUES
(1, 'TRX001', 'BRG001', 1, ''),
(2, 'TRX001', 'BRG002', 1, '10000'),
(3, 'TRX002', 'BRG002', 1, '10000'),
(4, 'TRX003', 'BRG002', 1, '10000'),
(5, 'TRX004', 'BRG003', 1, '1'),
(6, 'TRX005', 'BRG003', 1, '1'),
(7, 'TRX006', 'BRG002', 3, '30000'),
(8, 'TRX007', 'BRG002', 1, '10000'),
(9, 'TRX008', 'BRG002', 1, '10000'),
(10, 'TRX009', 'BRG002', 1, '10000'),
(11, 'TRX009', 'BRG003', 1, '1'),
(12, 'TRX010', 'BRG002', 1, '10000'),
(13, 'TRX011', 'BRG002', 1, '10000'),
(14, 'TRX011', 'BRG003', 1, '3500'),
(15, 'TRX011', 'BRG004', 1, '5000'),
(16, 'TRX011', 'BRG005', 1, '2000'),
(17, 'TRX011', 'BRG006', 2, '2000');

-- --------------------------------------------------------

--
-- Table structure for table `headtrans`
--

CREATE TABLE `headtrans` (
  `id_transaksi` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `headtrans`
--

INSERT INTO `headtrans` (`id_transaksi`, `total`, `tanggal_transaksi`, `total_bayar`) VALUES
('TRX001', '10000', '2025-01-09', '15000'),
('TRX002', '10000', '2025-01-09', '17000'),
('TRX003', '10000', '2025-01-09', '15000'),
('TRX004', '1', '2025-01-15', '3'),
('TRX005', '1', '2025-01-15', '4'),
('TRX006', '30000', '2025-01-15', '50000'),
('TRX007', '10000', '2025-01-15', '15000'),
('TRX008', '10000', '2025-01-17', '15000'),
('TRX009', '10001', '2025-01-20', '15000'),
('TRX010', '10000', '2025-01-21', '15000'),
('TRX011', '22500', '2025-01-21', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kode_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kode_kategori`, `nama_kategori`) VALUES
(1, 'KTG001', 'Makanan'),
(2, 'KTG002', 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `hak`) VALUES
(1, 'Super Admin', 'super admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailtrans`
--
ALTER TABLE `detailtrans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headtrans`
--
ALTER TABLE `headtrans`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detailtrans`
--
ALTER TABLE `detailtrans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
