-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2023 pada 13.31
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `tgl_keluar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `tgl_keluar`, `harga`) VALUES
(70, '2023-06-03 10:05:40', 44545000),
(71, '2023-06-03 10:12:29', 1781800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `tgl_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `tgl_masuk`, `harga`) VALUES
(79, '2023-06-02 17:00:00', 89090000),
(80, '2023-06-02 17:00:00', 6250000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata`
--

CREATE TABLE `biodata` (
  `id_biodata` int(11) NOT NULL,
  `foto` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `biodata`
--

INSERT INTO `biodata` (`id_biodata`, `foto`, `username`, `password`, `nama`, `alamat`, `no_telp`, `tgl_lahir`, `jk`, `level`) VALUES
(43, 'default-profile-pic-e1513291410505.jpg', 'fadlqnn', '45a5482491bcdb55e03ac9b12bd75f14', 'Muhammad Fadlan', 'Cimahi, Jawa Barat, Indonesia', '0851645174', '2006-03-23', 'Laki-laki', 1),
(44, 'default-profile-pic-e1513291410505.jpg', 'sandy@FTECH.209', 'ba853c550a1687d3cc912aef79f857c3', 'Sandy Tigerwhong', 'Surabaya, Indonesia', '10052456', '1945-08-17', 'Laki-laki', 2);

--
-- Trigger `biodata`
--
DELIMITER $$
CREATE TRIGGER `insert data pegawai` AFTER INSERT ON `biodata` FOR EACH ROW BEGIN
    INSERT INTO log_biodata (id_biodata, aktifitas)
    VALUES (NEW.id_biodata, 'INSERT DATA');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `tgl_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stock_barang` varchar(5) NOT NULL,
  `harga_barang` varchar(15) NOT NULL,
  `status_barang` enum('Tersedia','Tidak Tersedia','NONAKTIF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `id_distributor`, `tgl_masuk`, `kode_barang`, `nama_barang`, `stock_barang`, `harga_barang`, `status_barang`) VALUES
(71, 36, '2023-06-03 10:12:29', 'FA-001', 'Varsity PACK 1', '48', '890900', 'Tersedia'),
(72, 37, '2023-06-02 17:00:00', 'FA-001', 'Fantech 1', '0', '450000', 'Tidak Tersedia'),
(73, 36, '2023-06-03 10:45:00', 'FA-002', 'T-SHIRT Limited 20/08/23', '50', '125000', 'Tersedia'),
(74, 37, '2023-06-02 17:00:00', 'FA-002', 'FANTECH 2', '0', '250000', 'Tidak Tersedia'),
(75, 37, '2023-06-02 17:00:00', 'FA-003', 'FANTECH 3', '0', '300000', 'Tidak Tersedia');

--
-- Trigger `data_barang`
--
DELIMITER $$
CREATE TRIGGER `insert data barang` AFTER INSERT ON `data_barang` FOR EACH ROW BEGIN
    INSERT INTO log_databarang (id_barang, id_distributor, aktifitas)
    VALUES (NEW.id_barang, NEW.id_distributor, 'INSERT DATA');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update data barang` AFTER UPDATE ON `data_barang` FOR EACH ROW BEGIN
    INSERT INTO log_databarang (id_barang, id_distributor, aktifitas)
    VALUES (NEW.id_barang, NEW.id_distributor, 'UPDATE DATA');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_distributor`
--

CREATE TABLE `data_distributor` (
  `id_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `alamat_distributor` text NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `email_distributor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_distributor`
--

INSERT INTO `data_distributor` (`id_distributor`, `nama_distributor`, `brand`, `alamat_distributor`, `no_telp`, `email_distributor`) VALUES
(36, 'Faith Industries', 'FAITH', 'Bandung, Indonesia', '0854641', 'faith.industries@gmail.com'),
(37, 'FANTECH INDONESIA', 'FANTECH', 'Jakarta, Indonesia', '845751', 'fantech.support@fantech.com');

--
-- Trigger `data_distributor`
--
DELIMITER $$
CREATE TRIGGER `delete_distributor` AFTER DELETE ON `data_distributor` FOR EACH ROW INSERT INTO log_distributor SET
id_distributor = old.id_distributor,
aktifitas = 'DELETE DATA'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_distributor` AFTER INSERT ON `data_distributor` FOR EACH ROW INSERT INTO log_distributor SET
id_distributor = new.id_distributor,
aktifitas = 'INSERT DATA'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_distributor` AFTER UPDATE ON `data_distributor` FOR EACH ROW INSERT INTO log_distributor
SET
  id_distributor = new.id_distributor,
  aktifitas = 'UPDATE DATA',
  log_user = USER()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barang_keluar`
--

CREATE TABLE `detail_barang_keluar` (
  `id_detail` int(11) NOT NULL,
  `id_keluar` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kondisi` int(11) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `subtotal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_barang_keluar`
--

INSERT INTO `detail_barang_keluar` (`id_detail`, `id_keluar`, `id_distributor`, `id_barang`, `id_kondisi`, `jumlah`, `subtotal`) VALUES
(7, 70, 36, 71, 1, '50', '44545000'),
(8, 71, 36, 71, 2, '2', '1781800');

--
-- Trigger `detail_barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `barang_keluar` BEFORE INSERT ON `detail_barang_keluar` FOR EACH ROW UPDATE data_barang SET stock_barang = stock_barang - NEW.jumlah WHERE id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barang_masuk`
--

CREATE TABLE `detail_barang_masuk` (
  `id_detail` int(11) NOT NULL,
  `id_masuk` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kondisi` int(11) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `subtotal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_barang_masuk`
--

INSERT INTO `detail_barang_masuk` (`id_detail`, `id_masuk`, `id_distributor`, `id_barang`, `id_kondisi`, `jumlah`, `subtotal`) VALUES
(16, 79, 36, 71, 1, '100', '89090000'),
(17, 80, 36, 73, 1, '50', '6250000');

--
-- Trigger `detail_barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `detail_barang_masuk` FOR EACH ROW UPDATE data_barang SET stock_barang = stock_barang + NEW.jumlah WHERE id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_barang`
--

CREATE TABLE `kondisi_barang` (
  `id_kondisi` int(11) NOT NULL,
  `kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kondisi_barang`
--

INSERT INTO `kondisi_barang` (`id_kondisi`, `kondisi`) VALUES
(1, 'Baik'),
(2, 'Rusak/Cacat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_biodata`
--

CREATE TABLE `log_biodata` (
  `id_log` int(11) NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aktifitas` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_biodata`
--

INSERT INTO `log_biodata` (`id_log`, `id_biodata`, `timestamp`, `aktifitas`) VALUES
(6, 43, '2023-06-03 04:51:23', 'INSERT DATA'),
(7, 44, '2023-06-03 10:26:45', 'INSERT DATA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_databarang`
--

CREATE TABLE `log_databarang` (
  `id_log` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `aktifitas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_databarang`
--

INSERT INTO `log_databarang` (`id_log`, `id_barang`, `id_distributor`, `timestamp`, `aktifitas`) VALUES
(137, 71, 36, '2023-06-03 09:55:51', 'INSERT DATA'),
(138, 72, 37, '2023-06-03 09:56:54', 'INSERT DATA'),
(139, 71, 36, '2023-06-03 10:02:07', 'UPDATE DATA'),
(140, 73, 36, '2023-06-03 10:02:51', 'INSERT DATA'),
(141, 73, 36, '2023-06-03 10:04:34', 'UPDATE DATA'),
(142, 71, 36, '2023-06-03 10:05:40', 'UPDATE DATA'),
(143, 71, 36, '2023-06-03 10:05:40', 'UPDATE DATA'),
(144, 71, 36, '2023-06-03 10:12:29', 'UPDATE DATA'),
(145, 71, 36, '2023-06-03 10:12:29', 'UPDATE DATA'),
(146, 73, 36, '2023-06-03 10:19:28', 'UPDATE DATA'),
(147, 73, 36, '2023-06-03 10:45:00', 'UPDATE DATA'),
(148, 74, 37, '2023-06-03 10:48:54', 'INSERT DATA'),
(149, 75, 37, '2023-06-03 10:49:13', 'INSERT DATA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_distributor`
--

CREATE TABLE `log_distributor` (
  `id_log` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aktifitas` varchar(100) NOT NULL,
  `log_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_distributor`
--

INSERT INTO `log_distributor` (`id_log`, `id_distributor`, `timestamp`, `aktifitas`, `log_user`) VALUES
(24, 31, '2023-05-23 15:13:15', 'DELETE DATA', ''),
(25, 33, '2023-05-23 15:13:15', 'DELETE DATA', ''),
(26, 34, '2023-05-23 15:13:15', 'DELETE DATA', ''),
(27, 35, '2023-05-23 15:23:10', 'INSERT DATA', ''),
(28, 35, '2023-06-03 04:19:09', 'DELETE DATA', ''),
(29, 36, '2023-06-03 09:55:05', 'INSERT DATA', ''),
(30, 37, '2023-06-03 09:56:39', 'INSERT DATA', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `level` int(11) NOT NULL,
  `nama_level` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id_biodata`),
  ADD KEY `level` (`level`);

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`,`kode_barang`),
  ADD KEY `id_distributor` (`id_distributor`);

--
-- Indeks untuk tabel `data_distributor`
--
ALTER TABLE `data_distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indeks untuk tabel `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_keluar` (`id_keluar`,`id_distributor`,`id_barang`),
  ADD KEY `id_distributor` (`id_distributor`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_kondisi` (`id_kondisi`);

--
-- Indeks untuk tabel `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_masuk` (`id_masuk`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_distributor` (`id_distributor`),
  ADD KEY `id_kondisi` (`id_kondisi`);

--
-- Indeks untuk tabel `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indeks untuk tabel `log_biodata`
--
ALTER TABLE `log_biodata`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_databarang`
--
ALTER TABLE `log_databarang`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `user_id` (`id_distributor`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `log_distributor`
--
ALTER TABLE `log_distributor`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `data_distributor`
--
ALTER TABLE `data_distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log_biodata`
--
ALTER TABLE `log_biodata`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `log_databarang`
--
ALTER TABLE `log_databarang`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT untuk tabel `log_distributor`
--
ALTER TABLE `log_distributor`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_ibfk_1` FOREIGN KEY (`level`) REFERENCES `role` (`level`);

--
-- Ketidakleluasaan untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_ibfk_1` FOREIGN KEY (`id_distributor`) REFERENCES `data_distributor` (`id_distributor`);

--
-- Ketidakleluasaan untuk tabel `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  ADD CONSTRAINT `detail_barang_keluar_ibfk_2` FOREIGN KEY (`id_distributor`) REFERENCES `data_distributor` (`id_distributor`),
  ADD CONSTRAINT `detail_barang_keluar_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`),
  ADD CONSTRAINT `detail_barang_keluar_ibfk_4` FOREIGN KEY (`id_keluar`) REFERENCES `barang_keluar` (`id_keluar`),
  ADD CONSTRAINT `detail_barang_keluar_ibfk_5` FOREIGN KEY (`id_kondisi`) REFERENCES `kondisi_barang` (`id_kondisi`);

--
-- Ketidakleluasaan untuk tabel `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  ADD CONSTRAINT `detail_barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`),
  ADD CONSTRAINT `detail_barang_masuk_ibfk_3` FOREIGN KEY (`id_masuk`) REFERENCES `barang_masuk` (`id_masuk`),
  ADD CONSTRAINT `detail_barang_masuk_ibfk_4` FOREIGN KEY (`id_distributor`) REFERENCES `data_distributor` (`id_distributor`),
  ADD CONSTRAINT `detail_barang_masuk_ibfk_5` FOREIGN KEY (`id_kondisi`) REFERENCES `kondisi_barang` (`id_kondisi`);

--
-- Ketidakleluasaan untuk tabel `log_databarang`
--
ALTER TABLE `log_databarang`
  ADD CONSTRAINT `log_databarang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`),
  ADD CONSTRAINT `log_databarang_ibfk_2` FOREIGN KEY (`id_distributor`) REFERENCES `data_distributor` (`id_distributor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
