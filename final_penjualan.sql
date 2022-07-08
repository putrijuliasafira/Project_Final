-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 09:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akses`
--

CREATE TABLE `tb_akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akses`
--

INSERT INTO `tb_akses` (`id_akses`, `nama_akses`) VALUES
(1, 'admin'),
(2, 'pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(8) NOT NULL,
  `nm_barang` varchar(40) NOT NULL,
  `id_merk` int(5) NOT NULL,
  `stok_barang` int(10) NOT NULL,
  `harga_beli` int(10) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `model_bahan` varchar(100) DEFAULT NULL,
  `ukuran` enum('S','M','L','XL','XXL') NOT NULL,
  `warna` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nm_barang`, `id_merk`, `stok_barang`, `harga_beli`, `harga_jual`, `tgl_masuk`, `model_bahan`, `ukuran`, `warna`, `gambar`) VALUES
(1, 'Baju Kemeja Formal', 1, 1, 200000, 280000, '2022-07-04', 'Bagus, Awet dan Tahan Panas', 'L', 'hitam', 'barang1.jpg'),
(2, 'Baju Kerah Lengan Panjang', 2, 44, 150000, 230000, '2022-07-01', 'bagus, nyaman dipakai dan pastinya harga murah', 'L', 'coklat', 'barang2.jpg'),
(3, 'Baju Kemeja Hitam', 2, 6, 150000, 180000, '2022-07-02', NULL, 'M', 'coklat gelap', 'barang2.jpg'),
(4, 'Baju Koko', 2, 9, 200000, 280000, '2022-07-25', NULL, 'XL', 'putih', 'barang1.jpg'),
(5, 'Baju Islami', 1, 50, 150000, 230000, '2022-07-12', NULL, 'L', 'putih ke coklatan', 'barang2.jpg'),
(6, 'Baju Gamis', 1, 49, 200000, 280000, '2022-07-01', 'Bagus', 'L', 'putih', 'barang2.jpg'),
(7, 'Baju Pesta', 2, 58, 158000, 200000, '2022-07-01', 'Bagus', 'XL', 'Kuning', 'barang1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_barang`, `id_user`, `qty`) VALUES
(1, 1, 3, 1),
(2, 1, 5, 1),
(3, 2, 5, 1),
(4, 2, 5, 1),
(5, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `merk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `merk`) VALUES
(1, 'Uniqlo'),
(2, 'Eighty Eight');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `id_barang` int(8) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `tgl_transaksi`, `id_barang`, `qty`, `total_bayar`, `id_user`) VALUES
(1, '2022-07-03 21:55:10', 2, 1, 230000, 3),
(2, '2022-07-03 21:56:15', 5, 1, 230000, 3),
(3, '2022-07-03 22:03:31', 1, 1, 280000, 3),
(4, '2022-07-03 22:04:07', 2, 1, 230000, 3),
(5, '2022-07-03 22:07:55', 2, 1, 230000, 3),
(6, '2022-07-03 22:08:09', 5, 1, 230000, 3),
(7, '2022-07-04 07:55:06', 1, 1, 280000, 3),
(8, '2022-07-04 08:03:17', 1, 5, 1400000, 3),
(9, '2022-07-04 08:07:59', 1, 15, 4200000, 3),
(10, '2022-07-04 08:16:49', 2, 1, 230000, 3),
(11, '2022-07-04 08:20:35', 2, 1, 230000, 3),
(12, '2022-07-04 09:09:36', 3, 1, 180000, 3),
(13, '2022-07-04 09:10:30', 3, 1, 180000, 3),
(14, '2022-07-04 09:17:01', 3, 1, 180000, 3),
(15, '2022-07-04 09:17:02', 2, 1, 230000, 3),
(16, '2022-07-04 09:17:02', 2, 1, 230000, 3),
(17, '2022-07-04 09:18:25', 3, 1, 180000, 3),
(18, '2022-07-04 09:18:26', 2, 1, 230000, 3),
(19, '2022-07-04 09:18:26', 2, 1, 230000, 3),
(20, '2022-07-04 09:19:38', 2, 1, 230000, 3),
(21, '2022-07-04 09:19:39', 2, 1, 230000, 3),
(22, '2022-07-04 09:19:39', 3, 7, 1260000, 3),
(23, '2022-07-04 09:19:39', 4, 21, 5880000, 3),
(24, '2022-07-04 12:34:39', 6, 1, 280000, 5),
(25, '2022-07-04 12:34:39', 3, 13, 2340000, 5),
(26, '2022-07-04 14:23:58', 2, 1, 230000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `id_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `id_akses`) VALUES
(1, 'kazuryo', 'kazuryo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, 'putri', 'putri@gmail.com', 'ab56b4d92b40713acc5af89985d4b786', 2),
(3, 'Rahmaini', 'rahmaini', 'aafe26449a364e5d6b5db7dc565a9b6a', 1),
(4, 'rizqi', 'kazuryokun@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 2),
(5, 'rizky fahlevi', 'cuk', 'aafe26449a364e5d6b5db7dc565a9b6a', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akses`
--
ALTER TABLE `tb_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_merk` (`id_merk`) USING BTREE;

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `brg` (`id_barang`),
  ADD KEY `user` (`id_user`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`) USING BTREE,
  ADD KEY `transuser` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `akses` (`id_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akses`
--
ALTER TABLE `tb_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `merek` FOREIGN KEY (`id_merk`) REFERENCES `tb_merk` (`id_merk`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `brg` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `transaksi` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transuser` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `akses` FOREIGN KEY (`id_akses`) REFERENCES `tb_akses` (`id_akses`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
