-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Feb 2019 pada 08.31
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--
CREATE DATABASE IF NOT EXISTS `db_restoran` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_restoran`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_detail_order`
--

CREATE TABLE IF NOT EXISTS `t_detail_order` (
  `id_detail_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `jumlah` varchar(2) DEFAULT NULL,
  `status` text,
  PRIMARY KEY (`id_detail_order`),
  KEY `detail_untuk` (`id_order`),
  KEY `nama_menu` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_level`
--

CREATE TABLE IF NOT EXISTS `t_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_level`
--

INSERT INTO `t_level` (`id_level`, `nama_level`) VALUES
(1, 'Pelanggan'),
(2, 'Member'),
(3, 'Waiter'),
(4, 'Kasir'),
(5, 'Admin'),
(6, 'Owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_menu`
--

CREATE TABLE IF NOT EXISTS `t_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_menu` varchar(20) DEFAULT NULL,
  `nama_menu` text,
  `harga` varchar(20) DEFAULT NULL,
  `status_menu` text,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_menu`
--

INSERT INTO `t_menu` (`id_menu`, `jenis_menu`, `nama_menu`, `harga`, `status_menu`, `thumb`) VALUES
(1, 'Makanan', 'Ayam Bakar', '17000', 'Tersedia', '20190211083038Ayam Bakar.png'),
(2, 'Minuman', 'Jus Jeruk', '8000', 'Tersedia', '20190212012748Jus Jeruk.jpeg'),
(3, 'Makanan', 'Ayam Kecap', '17000', 'Tersedia', '20190212030756ayam kecap.jpg'),
(4, 'Makanan', 'Bakso Tenes', '20000', 'Tersedia', '20190212030825Bakso Tenes.png'),
(5, 'Makanan', 'Coto', '25000', 'Tersedia', '20190212030859coto.jpg'),
(6, 'Makanan', 'Ikan Bakar', '15000', 'Tersedia', '20190212030953ikan bakar.jpg'),
(7, 'Makanan', 'Nasi Goreng', '12000', 'Tersedia', '20190212031032nasi goreng.Jpeg'),
(8, 'Makanan', 'Rendang', '25000', 'Tersedia', '20190212031116rendang.jpeg'),
(9, 'Minuman', 'Lemon Tea', '7000', 'Tersedia', '20190212031147lemon tea.jpg'),
(10, 'Minuman', 'Coklat Panas', '8000', 'Tersedia', '20190212031228coklat panas.jpg'),
(12, 'Minuman', 'Es Buah', '6000', 'Tersedia', '20190212080746Es Buah.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_order`
--

CREATE TABLE IF NOT EXISTS `t_order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `no_meja` varchar(2) DEFAULT NULL,
  `tanggal` varchar(20) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_order`),
  KEY `diorder_oleh` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_transaksi`
--

CREATE TABLE IF NOT EXISTS `t_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `tanggal` varchar(20) DEFAULT NULL,
  `total_bayar` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `atas_nama` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nama_user` text,
  `id_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `berlevel` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `nama_user`, `id_level`) VALUES
(1, 'admin', 'admin', 'admin', 5),
(2, 'Owner', 'Owner', 'Owner', 6),
(3, 'Waiter', 'Waiter', 'Waiter', 3),
(4, 'Kasir', 'Kasir', 'Kasir', 4),
(5, 'Pelanggan12022019000', '', 'Kadir', 1),
(6, 'Pelanggan12022019001', '', 'Kadir', 1);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_detail_order`
--
ALTER TABLE `t_detail_order`
  ADD CONSTRAINT `detail_untuk` FOREIGN KEY (`id_order`) REFERENCES `t_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nama_menu` FOREIGN KEY (`id_menu`) REFERENCES `t_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_order`
--
ALTER TABLE `t_order`
  ADD CONSTRAINT `diorder_oleh` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD CONSTRAINT `atas_nama` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`),
  ADD CONSTRAINT `pesanan` FOREIGN KEY (`id_transaksi`) REFERENCES `t_order` (`id_order`);

--
-- Ketidakleluasaan untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `berlevel` FOREIGN KEY (`id_level`) REFERENCES `t_level` (`id_level`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
