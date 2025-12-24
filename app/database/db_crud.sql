-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2025 at 01:30 PM
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
-- Database: `db_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `id_distributor`, `kode_barang`, `nama_barang`, `harga_barang`, `qty`) VALUES
(2, 4, 'AZ-001', 'Keyboard Ajazz AK860 PRO', 570000, 0),
(4, 6, 'VT-002', 'Mouse Vortex Series Oni R1', 270000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_distributor`
--

CREATE TABLE `data_distributor` (
  `id_distributor` int(11) NOT NULL,
  `kode_distributor` varchar(11) NOT NULL,
  `nama_distributor` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_distributor`
--

INSERT INTO `data_distributor` (`id_distributor`, `kode_distributor`, `nama_distributor`, `brand`, `alamat`, `telp`, `email`) VALUES
(1, 'FT', 'PT. Fantech ID', 'Fantech', 'Jakarta', '08344463812', 'fantechID@gmail.com'),
(2, 'RX', 'PT. Rexus ID', 'Rexus', 'Jakarta Selatan', '0882223631832', 'rexusID@gmail.com'),
(3, 'RD', 'PT. RedDragon ID', 'RedDragon', 'Bandung', '0838249832983', 'redDragonID@gmail.com'),
(4, 'AZ', 'PT. Ajazz Indonesia', 'Ajazz', 'Bekasi', '0883627735219', 'ajazzID@gmail.com'),
(6, 'VT', 'PT. Vortex Indonesia', 'Vortex Series', 'Banten', '088221247362', 'vortexID@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_distributor`, `id_barang`, `qty`, `subtotal`) VALUES
(1, 1, 4, 2, 1, 570000),
(2, 1, 6, 4, 1, 270000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang`
--

CREATE TABLE `transaksi_barang` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_detail_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_barang`
--

INSERT INTO `transaksi_barang` (`id_transaksi`, `id_user`, `id_detail_transaksi`, `tgl_transaksi`, `total`, `status`) VALUES
(1, 2, 1, '2025-12-19', 840000, 'masuk');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `umur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `umur`) VALUES
(1, 'hahay', '$2y$10$FM13kRBydboYjmYeJ8NML.Vdv1e4Vtr4zLlZQv56c7nlAlyr.NE.S', 41),
(2, 'ayamkampung', '$2y$10$DjgALsLPiQWO6R2bzmwcJuJ9iV5G3TAXQSJ44CKdo7LrGluRojYCW', 56);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_distributor` (`id_distributor`);

--
-- Indexes for table `data_distributor`
--
ALTER TABLE `data_distributor`
  ADD PRIMARY KEY (`id_distributor`),
  ADD UNIQUE KEY `kode_distributor` (`kode_distributor`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`,`id_distributor`,`id_barang`),
  ADD KEY `id_distributor` (`id_distributor`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`,`id_detail_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_distributor`
--
ALTER TABLE `data_distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_ibfk_1` FOREIGN KEY (`id_distributor`) REFERENCES `data_distributor` (`id_distributor`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_barang` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_distributor`) REFERENCES `data_distributor` (`id_distributor`),
  ADD CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`);

--
-- Constraints for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD CONSTRAINT `transaksi_barang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
