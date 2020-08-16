-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 09:32 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtokobuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idBuku` int(10) NOT NULL,
  `judulBuku` varchar(200) NOT NULL,
  `noISBN` varchar(30) NOT NULL,
  `penulis` varchar(200) NOT NULL,
  `penerbit` varchar(200) NOT NULL,
  `tahunTerbit` year(4) NOT NULL,
  `stok` int(30) NOT NULL,
  `hargaPokok` float NOT NULL,
  `hargaJual` float NOT NULL,
  `PPN` float NOT NULL,
  `diskon` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idBuku`, `judulBuku`, `noISBN`, `penulis`, `penerbit`, `tahunTerbit`, `stok`, `hargaPokok`, `hargaJual`, `PPN`, `diskon`) VALUES
(2, 'Bagaikan Bumi dan Langit', '092819284017', 'Nur Putri Sianida', 'Matahari Dunia', 2017, 253, 30000, 35000, 1, 3),
(3, 'Cinta di Bawah Matahari', '12392138891', 'Minaswtu', 'Catur Soter', 2015, 423, 12000, 18000, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `idDistributor` int(10) NOT NULL,
  `namaDistributor` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`idDistributor`, `namaDistributor`, `alamat`, `telepon`) VALUES
(2, 'Matahari Dunia', 'Jl. Angkasa', '08108108121');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `idKasir` int(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`idKasir`, `nama`, `alamat`, `telepon`, `status`, `username`, `password`, `level`) VALUES
(1, 'Muhammad Ferdy Sopian', 'Dalung Permai', '085847631904', 1, 'admin', 'admin', 'admin'),
(2, 'Agus Fahrur Rozaq', 'Dalung Permai', '08108121821', 0, 'fahrur', 'ZVLQA', 'staff'),
(3, 'Roby Adi Susilo', 'Jakarta', '08150820123', 0, 'roby', 'ZYXIL', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `pasok`
--

CREATE TABLE `pasok` (
  `idPasok` int(10) NOT NULL,
  `idDistributor` int(10) NOT NULL,
  `idBuku` int(10) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `tglMasuk` date NOT NULL,
  `tglKeluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasok`
--

INSERT INTO `pasok` (`idPasok`, `idDistributor`, `idBuku`, `jumlah`, `tglMasuk`, `tglKeluar`) VALUES
(2, 2, 2, 10, '2018-02-23', '2018-02-23'),
(3, 2, 2, 20, '2018-02-23', '2018-02-23'),
(4, 2, 3, 100, '2018-02-23', '2018-02-23'),
(5, 2, 3, 213, '2018-02-23', '2018-02-23'),
(7, 2, 2, 123, '2018-02-23', '2018-02-23'),
(8, 2, 2, 30, '2018-02-23', '2018-02-23'),
(9, 2, 2, 20, '2018-02-23', '2018-02-23'),
(10, 2, 2, 20, '2018-02-23', '2018-02-23'),
(11, 2, 3, 100, '2018-02-24', '2018-02-24'),
(12, 2, 2, 10, '2018-02-24', '2018-02-24'),
(13, 2, 2, 10, '2018-02-24', '2018-02-24');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idPenjualan` int(10) NOT NULL,
  `noTransaksi` varchar(200) NOT NULL,
  `idBuku` int(10) NOT NULL,
  `idKasir` int(10) NOT NULL,
  `jumlah` int(200) NOT NULL,
  `totalBayar` float NOT NULL,
  `tglTransaksi` date NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idPenjualan`, `noTransaksi`, `idBuku`, `idKasir`, `jumlah`, `totalBayar`, `tglTransaksi`, `status`) VALUES
(1, 'GOXE2018-02', 2, 1, 1, 34300, '2018-02-24', 1),
(2, 'VCHF2018-02', 2, 2, 123, 4218900, '2018-02-24', 1),
(3, 'Z4FX2018-02', 3, 1, 1, 17820, '2018-02-24', 1),
(4, 'Z4FX2018-02', 2, 1, 1, 34300, '2018-02-24', 1),
(5, 'U8XB2018-02', 2, 2, 2, 102900, '2018-02-24', 1),
(6, '4QI22018-02', 2, 1, 3, 102900, '2018-02-24', 1),
(7, '1RAQ2018-02', 2, 1, 2, 68600, '2018-02-24', 1),
(8, '2Z3O2018-02', 3, 1, 2, 35640, '2018-02-24', 1),
(9, '2Z3O2018-02', 2, 1, 4, 137200, '2018-02-24', 1),
(10, 'JC052018-02', 2, 1, 23, 788900, '2018-02-24', 1),
(11, 'CJKI2018-02', 2, 1, 2, 68600, '2018-02-24', 1),
(12, 'CJKI2018-02', 3, 1, 2, 35640, '2018-02-24', 1),
(13, '8FAW2018-02', 3, 1, 104, 3635280, '2018-02-24', 1),
(14, 'KX2O2018-02', 2, 2, 2, 68600, '2018-02-24', 1),
(15, 'KX2O2018-02', 3, 2, 2, 35640, '2018-02-24', 1),
(16, '8FAW2018-02', 2, 1, 100, 3430000, '2018-02-24', 1),
(17, 'G0162018-02', 3, 2, 100, 1782000, '0000-00-00', 0),
(18, 'G0162018-02', 2, 2, 100, 3430000, '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idBuku`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`idDistributor`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`idKasir`);

--
-- Indexes for table `pasok`
--
ALTER TABLE `pasok`
  ADD PRIMARY KEY (`idPasok`),
  ADD KEY `idDistributor` (`idDistributor`),
  ADD KEY `idBuku` (`idBuku`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idPenjualan`),
  ADD KEY `idBuku` (`idBuku`),
  ADD KEY `idKasir` (`idKasir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `idBuku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `idDistributor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `idKasir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasok`
--
ALTER TABLE `pasok`
  MODIFY `idPasok` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idPenjualan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pasok`
--
ALTER TABLE `pasok`
  ADD CONSTRAINT `pasok_ibfk_1` FOREIGN KEY (`idDistributor`) REFERENCES `distributor` (`idDistributor`),
  ADD CONSTRAINT `pasok_ibfk_2` FOREIGN KEY (`idBuku`) REFERENCES `buku` (`idBuku`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`idKasir`) REFERENCES `kasir` (`idkasir`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`idBuku`) REFERENCES `buku` (`idBuku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
