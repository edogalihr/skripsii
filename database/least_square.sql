-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2023 pada 04.55
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `least_square`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(25) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `status` enum('tetap','tidak') DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `alamat`, `kota`, `jenis_kelamin`, `status`, `telepon`) VALUES
(2, 'Edo Galih Rispianto', 'Perum Doko Sragi', 'Kediri', 'L', 'tidak', '779977');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(40) DEFAULT NULL,
  `harga` int(15) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_supplier` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_supplier` (`id_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jenis`, `harga`, `stok`, `tanggal`, `id_supplier`) VALUES
(4, 'Power', 'Unit', 450, 225, '2008-12-30', 5),
(5, 'North Star', 'Unit', 450, 253, '2009-10-29', 5),
(7, 'Pata Pata', 'Unit', 450, 332, '2010-11-27', 5),
(8, 'Bata 3D', 'Unit', 450, 360, '2011-12-20', 5),
(9, 'Sneakers', 'Unit', 450, 277, '2012-12-23', 5),
(10, 'Flats', 'Unit', 450, 567, '2013-12-12', 5),
(11, 'Bata Comfit', 'Unit', 450, 370, '2014-12-23', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `no_faktur` varchar(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_karyawan` int(5) DEFAULT NULL,
  `id_supplier` int(5) DEFAULT NULL,
  `id_barang` int(5) DEFAULT NULL,
  `jumlah_barang` int(10) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `pajak` float DEFAULT NULL,
  `total_bayar` float DEFAULT NULL,
  PRIMARY KEY (`no_faktur`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_barang` (`id_barang`),
  KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no_faktur`, `tanggal`, `id_karyawan`, `id_supplier`, `id_barang`, `jumlah_barang`, `harga`, `pajak`, `total_bayar`) VALUES
('FAK-0001', '2015-08-23', 2, 1, 7, 12, 4500, 100, 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peramalan`
--

CREATE TABLE IF NOT EXISTS `peramalan` (
  `id_peramalan` int(3) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(5) DEFAULT NULL,
  `peramalan` float DEFAULT NULL,
  PRIMARY KEY (`id_peramalan`),
  KEY `id_peramalan` (`id_peramalan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `peramalan`
--

INSERT INTO `peramalan` (`id_peramalan`, `tahun`, `peramalan`) VALUES
(4, '2015', 497.67);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int(5) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(50) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(20) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `kota`, `telepon`) VALUES
(1, 'Bata Pare Kabupaten', 'Jawa Timur', 'Kediri', 775643),
(2, 'Bata Kediri Kabupaten', 'Jalan Dlopo', 'Kediri', 890987),
(4, 'Bata Dhoho Kota', 'Jalan Pattimura', 'Kediri', 567498),
(5, 'Bata Gurah Kabupaten', 'Jawa Timur', 'Kediri', 7418900);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` tinyint(3) NOT NULL AUTO_INCREMENT,
  `no_ip` varchar(60) NOT NULL,
  `tahun` varchar(5) DEFAULT NULL,
  `nilai_x` int(3) DEFAULT NULL,
  `stok` float DEFAULT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `tmp`
--

INSERT INTO `tmp` (`id_tmp`, `no_ip`, `tahun`, `nilai_x`, `stok`) VALUES
(14, '::1', '2012', -1, 277),
(15, '::1', '2013', 0, 567),
(16, '::1', '2014', 1, 370);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
