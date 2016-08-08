-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2016 at 11:14 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `br_deductive_v2`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `ambil`
--
CREATE TABLE IF NOT EXISTS `ambil` (
`nim` varchar(20)
,`semester` int(5)
,`tahun` int(5)
,`id_kelas` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ambil_kuliah`
--
CREATE TABLE IF NOT EXISTS `ambil_kuliah` (
`x` varchar(20)
,`y` int(5)
,`z` int(5)
,`c` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ambil_s2`
--
CREATE TABLE IF NOT EXISTS `ambil_s2` (
`x` varchar(10)
,`y` int(5)
,`z` int(5)
);
-- --------------------------------------------------------

--
-- Table structure for table `argumen_body`
--

CREATE TABLE IF NOT EXISTS `argumen_body` (
  `id_aturan` int(11) NOT NULL,
  `urutan_body` int(11) NOT NULL,
  `urutan_argumen` int(5) NOT NULL,
  `isi_argumen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_aturan`,`urutan_body`,`urutan_argumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `argumen_body`
--

INSERT INTO `argumen_body` (`id_aturan`, `urutan_body`, `urutan_argumen`, `isi_argumen`) VALUES
(2, 1, 1, 'x'),
(2, 1, 2, 'y'),
(2, 1, 3, 'z'),
(2, 2, 1, 'x'),
(2, 2, 2, 'y'),
(2, 3, 1, 'y'),
(2, 3, 2, '1'),
(3, 1, 1, 'x'),
(3, 1, 2, 'y'),
(3, 1, 3, 'z'),
(3, 2, 1, 'x'),
(3, 2, 2, 'y'),
(3, 3, 1, 'y'),
(3, 3, 2, '2'),
(4, 1, 1, 'x'),
(4, 2, 1, 'x'),
(4, 2, 2, 'y'),
(4, 2, 3, 'z'),
(4, 3, 1, NULL),
(5, 1, 1, 'x'),
(5, 2, 1, 'x'),
(5, 2, 2, 'y'),
(5, 2, 3, 'z'),
(5, 3, 1, NULL),
(5, 4, 1, NULL),
(6, 1, 1, 'x'),
(6, 1, 2, 'y'),
(6, 1, 3, 'z'),
(6, 2, 1, NULL),
(7, 1, 1, 'x'),
(7, 1, 2, 'y'),
(7, 1, 3, 'z'),
(7, 1, 4, 'c'),
(7, 1, 5, 'd'),
(7, 1, 6, 'e'),
(7, 1, 7, 'f'),
(7, 2, 1, NULL),
(10, 1, 1, 'x'),
(10, 1, 2, 'y'),
(10, 1, 3, 'z'),
(10, 1, 4, 'f'),
(12, 1, 1, 'x'),
(12, 1, 2, 'y'),
(12, 1, 3, 'z'),
(12, 1, 4, 'a'),
(12, 1, 5, 'b'),
(12, 2, 1, 'x'),
(12, 2, 2, 'y'),
(12, 3, 1, NULL),
(12, 4, 1, NULL),
(14, 1, 1, 'x'),
(14, 1, 2, 'y'),
(14, 1, 3, 'z'),
(14, 1, 4, 'c'),
(14, 1, 5, 'd'),
(14, 1, 6, 'e'),
(14, 1, 7, 'f'),
(14, 2, 1, 'y'),
(14, 2, 2, '1'),
(14, 3, 1, 'z'),
(14, 3, 2, '1'),
(14, 4, 1, NULL),
(15, 1, 1, 'x'),
(15, 1, 2, 'y'),
(15, 1, 3, 'z'),
(15, 1, 4, 'c'),
(15, 1, 5, 'd'),
(15, 1, 6, 'e'),
(15, 1, 7, 'f'),
(15, 2, 1, 'y'),
(15, 2, 2, '1'),
(15, 3, 1, 'z'),
(15, 4, 1, NULL),
(16, 1, 1, 'x'),
(16, 2, 1, 'x'),
(16, 2, 2, 'y'),
(16, 2, 3, 'z'),
(16, 3, 1, NULL),
(17, 1, 1, 'x'),
(17, 2, 1, 'x'),
(17, 2, 2, 'y'),
(17, 2, 3, 'z'),
(17, 3, 1, NULL),
(17, 4, 1, NULL),
(18, 1, 1, 'x'),
(18, 1, 2, 'y'),
(18, 1, 3, 'p'),
(18, 2, 1, 'x'),
(18, 2, 2, 'y'),
(18, 2, 3, 'q'),
(18, 3, 1, 'y'),
(18, 3, 2, '1'),
(18, 4, 1, NULL),
(20, 1, 1, 'x'),
(20, 2, 1, 'x'),
(20, 2, 2, 'y'),
(20, 2, 3, 'z'),
(20, 3, 1, NULL),
(20, 4, 1, NULL),
(21, 1, 1, 'x'),
(21, 1, 2, 'y'),
(21, 1, 3, 'z'),
(21, 2, 1, NULL),
(22, 1, 1, 'x'),
(22, 2, 1, 'x'),
(22, 2, 2, 'y'),
(22, 2, 3, 'z'),
(22, 3, 1, NULL),
(25, 1, 1, 'c'),
(25, 1, 2, 'p'),
(25, 2, 1, NULL),
(26, 1, 1, 'c'),
(26, 1, 2, 'p'),
(26, 2, 1, NULL),
(27, 1, 1, 'x'),
(27, 1, 2, 'y'),
(27, 1, 3, 'z'),
(27, 1, 4, 'k'),
(27, 2, 1, 'k'),
(27, 2, 2, 'c'),
(28, 1, 1, 'x'),
(28, 1, 2, 'y'),
(28, 1, 3, 'z'),
(28, 1, 4, 'c'),
(28, 2, 1, 'x'),
(28, 3, 1, 'x'),
(28, 3, 2, 'y'),
(28, 3, 3, 'z'),
(28, 3, 4, 'f'),
(28, 4, 1, 'c'),
(29, 1, 1, 'x'),
(29, 1, 2, 'y'),
(29, 1, 3, 'z'),
(29, 1, 4, 'n'),
(29, 2, 1, 'y'),
(29, 2, 2, '1'),
(30, 1, 1, 'x'),
(30, 1, 2, 'y'),
(30, 1, 3, 'z'),
(30, 1, 4, 'n'),
(30, 2, 1, 'y'),
(30, 2, 2, '1'),
(30, 3, 1, 'z'),
(30, 3, 2, '1'),
(31, 1, 1, 'x'),
(31, 1, 2, 'y'),
(31, 1, 3, 'z'),
(31, 1, 4, 'f'),
(31, 2, 1, 'x'),
(31, 2, 2, 'n'),
(31, 3, 1, NULL),
(33, 1, 1, 'x'),
(33, 2, 1, 'x'),
(33, 2, 2, 'a'),
(33, 2, 3, 'b'),
(33, 2, 4, 'c'),
(33, 3, 1, 'x'),
(33, 3, 2, 'n'),
(33, 4, 1, NULL),
(33, 5, 1, NULL),
(33, 6, 1, NULL),
(33, 7, 1, NULL),
(34, 1, 1, 'x'),
(34, 2, 1, 'x'),
(34, 2, 2, 'z'),
(35, 1, 1, 'x'),
(35, 1, 2, 'y'),
(35, 1, 3, 'z'),
(35, 1, 4, 'f'),
(35, 2, 1, 'x'),
(35, 3, 1, 'x'),
(35, 4, 1, 'x'),
(35, 4, 2, 't'),
(35, 5, 1, NULL),
(36, 1, 1, 'x'),
(36, 1, 2, 'y'),
(36, 1, 3, 'z'),
(36, 1, 4, 'c'),
(36, 2, 1, NULL),
(37, 1, 1, 'x'),
(37, 2, 1, 'x'),
(38, 1, 1, 'x'),
(38, 1, 2, 'y'),
(38, 1, 3, 'z'),
(38, 1, 4, 'c'),
(38, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `argumen_head`
--

CREATE TABLE IF NOT EXISTS `argumen_head` (
  `id_rule` int(11) NOT NULL,
  `urutan` int(5) NOT NULL,
  `isi_argumen` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rule`,`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `argumen_head`
--

INSERT INTO `argumen_head` (`id_rule`, `urutan`, `isi_argumen`) VALUES
(2, 1, 'x'),
(2, 2, 'y'),
(2, 3, 'z'),
(3, 1, 'x'),
(3, 2, 'y'),
(3, 3, 'z'),
(4, 1, 'x'),
(4, 2, 'y'),
(5, 1, 'x'),
(5, 2, 'y'),
(6, 1, 'x'),
(7, 1, 'x'),
(7, 2, 'y'),
(7, 3, 'z'),
(7, 4, 'f'),
(10, 1, 'x'),
(10, 2, 'y'),
(10, 3, 'z'),
(12, 1, 'x'),
(12, 2, 'y'),
(12, 3, 'z'),
(14, 1, 'x'),
(14, 2, 'y'),
(14, 3, 'z'),
(15, 1, 'x'),
(15, 2, 'y'),
(15, 3, 'z'),
(16, 1, 'x'),
(16, 2, 'y'),
(17, 1, 'x'),
(17, 2, 'y'),
(18, 1, 'x'),
(18, 2, 'y'),
(20, 1, 'x'),
(20, 2, 'y'),
(21, 1, 'x'),
(22, 1, 'x'),
(22, 2, 'y'),
(25, 1, 'c'),
(26, 1, 'c'),
(27, 1, 'x'),
(27, 2, 'y'),
(27, 3, 'z'),
(27, 4, 'c'),
(28, 1, 'x'),
(28, 2, 'y'),
(28, 3, 'z'),
(29, 1, 'x'),
(29, 2, 'n'),
(30, 1, 'x'),
(30, 2, 'n'),
(31, 1, 'x'),
(31, 2, 'y'),
(31, 3, 'z'),
(33, 1, 'x'),
(34, 1, 'x'),
(35, 1, 'x'),
(35, 2, 'z'),
(36, 1, 'x'),
(37, 1, 'x'),
(38, 1, 'x');

-- --------------------------------------------------------

--
-- Stand-in structure for view `batas_tpb`
--
CREATE TABLE IF NOT EXISTS `batas_tpb` (
`x` varchar(10)
,`z` int(5)
);
-- --------------------------------------------------------

--
-- Table structure for table `body_idb`
--

CREATE TABLE IF NOT EXISTS `body_idb` (
  `id_aturan` int(11) NOT NULL,
  `urutan_body` int(11) NOT NULL,
  `predikat` int(11) NOT NULL,
  `is_negasi` varchar(10) NOT NULL,
  PRIMARY KEY (`id_aturan`,`urutan_body`),
  KEY `predikat_edb` (`predikat`),
  KEY `predikat` (`predikat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `body_idb`
--

INSERT INTO `body_idb` (`id_aturan`, `urutan_body`, `predikat`, `is_negasi`) VALUES
(2, 1, 7, 'FALSE'),
(2, 2, 28, 'FALSE'),
(2, 3, 5, 'FALSE'),
(3, 1, 7, 'FALSE'),
(3, 2, 28, 'TRUE'),
(3, 3, 5, 'FALSE'),
(4, 1, 14, 'FALSE'),
(4, 2, 12, 'FALSE'),
(4, 3, 15, 'FALSE'),
(5, 1, 14, 'FALSE'),
(5, 2, 24, 'FALSE'),
(5, 3, 3, 'FALSE'),
(5, 4, 18, 'FALSE'),
(6, 1, 13, 'FALSE'),
(6, 2, 1, 'FALSE'),
(7, 1, 33, 'FALSE'),
(7, 2, 1, 'FALSE'),
(10, 1, 32, 'FALSE'),
(12, 1, 35, 'FALSE'),
(12, 2, 31, 'FALSE'),
(12, 3, 1, 'FALSE'),
(12, 4, 1, 'FALSE'),
(14, 1, 33, 'FALSE'),
(14, 2, 11, 'FALSE'),
(14, 3, 5, 'FALSE'),
(14, 4, 1, 'FALSE'),
(15, 1, 33, 'FALSE'),
(15, 2, 5, 'FALSE'),
(15, 3, 37, 'FALSE'),
(15, 4, 1, 'FALSE'),
(16, 1, 14, 'FALSE'),
(16, 2, 12, 'FALSE'),
(16, 3, 15, 'FALSE'),
(17, 1, 14, 'FALSE'),
(17, 2, 24, 'FALSE'),
(17, 3, 3, 'FALSE'),
(17, 4, 18, 'FALSE'),
(18, 1, 9, 'FALSE'),
(18, 2, 10, 'FALSE'),
(18, 3, 5, 'FALSE'),
(18, 4, 1, 'FALSE'),
(20, 1, 19, 'FALSE'),
(20, 2, 24, 'FALSE'),
(20, 3, 3, 'FALSE'),
(20, 4, 18, 'FALSE'),
(21, 1, 13, 'FALSE'),
(21, 2, 1, 'FALSE'),
(22, 1, 19, 'FALSE'),
(22, 2, 12, 'FALSE'),
(22, 3, 15, 'FALSE'),
(25, 1, 41, 'FALSE'),
(25, 2, 1, 'FALSE'),
(26, 1, 41, 'FALSE'),
(26, 2, 1, 'FALSE'),
(27, 1, 44, 'FALSE'),
(27, 2, 43, 'FALSE'),
(28, 1, 45, 'FALSE'),
(28, 2, 14, 'FALSE'),
(28, 3, 32, 'FALSE'),
(28, 4, 42, 'FALSE'),
(29, 1, 38, 'FALSE'),
(29, 2, 5, 'FALSE'),
(30, 1, 38, 'FALSE'),
(30, 2, 11, 'FALSE'),
(30, 3, 5, 'FALSE'),
(31, 1, 32, 'FALSE'),
(31, 2, 39, 'FALSE'),
(31, 3, 15, 'FALSE'),
(33, 1, 14, 'FALSE'),
(33, 2, 49, 'FALSE'),
(33, 3, 50, 'FALSE'),
(33, 4, 1, 'FALSE'),
(33, 5, 1, 'FALSE'),
(33, 6, 1, 'FALSE'),
(33, 7, 15, 'FALSE'),
(34, 1, 14, 'FALSE'),
(34, 2, 48, 'TRUE'),
(35, 1, 32, 'FALSE'),
(35, 2, 14, 'FALSE'),
(35, 3, 51, 'TRUE'),
(35, 4, 47, 'FALSE'),
(35, 5, 18, 'FALSE'),
(36, 1, 53, 'FALSE'),
(36, 2, 1, 'FALSE'),
(37, 1, 14, 'FALSE'),
(37, 2, 54, 'FALSE'),
(38, 1, 53, 'FALSE'),
(38, 2, 1, 'FALSE');

-- --------------------------------------------------------

--
-- Table structure for table `br_statement`
--

CREATE TABLE IF NOT EXISTS `br_statement` (
  `id_statement` varchar(10) NOT NULL,
  `id_policy` varchar(10) NOT NULL,
  `definition` varchar(100) NOT NULL,
  `predikat` int(11) NOT NULL,
  `target` int(5) NOT NULL,
  PRIMARY KEY (`id_statement`),
  KEY `id_predikat` (`id_policy`),
  KEY `id_predikat_2` (`id_policy`),
  KEY `predikat` (`predikat`),
  KEY `target` (`target`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_statement`
--

INSERT INTO `br_statement` (`id_statement`, `id_policy`, `definition`, `predikat`, `target`) VALUES
('BS18', 'PA1801', 'Syarat mahasiswa yang boleh daftar ulang', 34, 36),
('BS2A', 'PA0404', 'Mahasiswa S1 yang boleh mengambil maksimal 24 sks', 8, 25),
('BS2B', 'PA0404', 'Mahasiswa S1 yang boleh mengambil maksimal 22 sks', 16, 26),
('BS3', 'PA0404', 'Mahasiswa S2 yang boleh mengambil maksimal 16 sks', 17, 27),
('BS51A', 'PA5101', 'Syarat penghentian studi S1', 52, 55),
('BS9', 'PA0901', 'Syarat mengambil matakuliah S2', 40, 46);

-- --------------------------------------------------------

--
-- Stand-in structure for view `check_bs2a`
--
CREATE TABLE IF NOT EXISTS `check_bs2a` (
`x` varchar(20)
,`y` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `check_bs2b`
--
CREATE TABLE IF NOT EXISTS `check_bs2b` (
`x` varchar(20)
,`y` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `check_bs3`
--
CREATE TABLE IF NOT EXISTS `check_bs3` (
`x` varchar(20)
,`y` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `check_bs9`
--
CREATE TABLE IF NOT EXISTS `check_bs9` (
`x` varchar(20)
,`y` int(5)
,`z` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `check_bs18`
--
CREATE TABLE IF NOT EXISTS `check_bs18` (
`x` varchar(10)
,`y` int(5)
,`z` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `check_bs51a`
--
CREATE TABLE IF NOT EXISTS `check_bs51a` (
`x` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `contoh`
--
CREATE TABLE IF NOT EXISTS `contoh` (
`nip` varchar(20)
,`nama` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar`
--
CREATE TABLE IF NOT EXISTS `daftar` (
`nim` varchar(20)
,`semester` int(5)
,`sks` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar2`
--
CREATE TABLE IF NOT EXISTS `daftar2` (
`x` varchar(10)
,`y` int(5)
,`z` int(5)
,`f` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_do`
--
CREATE TABLE IF NOT EXISTS `daftar_do` (
`x` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_ulang`
--
CREATE TABLE IF NOT EXISTS `daftar_ulang` (
`x` varchar(10)
,`y` int(5)
,`z` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `dropout_s1`
--
CREATE TABLE IF NOT EXISTS `dropout_s1` (
`x` varchar(20)
);
-- --------------------------------------------------------

--
-- Table structure for table `edb`
--

CREATE TABLE IF NOT EXISTS `edb` (
  `id_predikat` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  PRIMARY KEY (`id_predikat`),
  KEY `reference` (`reference`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edb`
--

INSERT INTO `edb` (`id_predikat`, `reference`) VALUES
(44, 'ambil'),
(24, 'daftar'),
(38, 'ip'),
(50, 'ipk_TPB'),
(53, 'kasus'),
(43, 'kelas'),
(6, 'mahasiswa'),
(41, 'matkul'),
(7, 'nr'),
(21, 'nr2'),
(10, 'sks_ambil'),
(9, 'sks_total'),
(49, 'sks_TPB'),
(33, 'status_mhs'),
(35, 'stat_mahasiswa1'),
(13, 'strata_mhs'),
(47, 'thn_masuk');

-- --------------------------------------------------------

--
-- Table structure for table `ekspresi`
--

CREATE TABLE IF NOT EXISTS `ekspresi` (
  `id_aturan` int(11) NOT NULL,
  `urutan_body` int(11) NOT NULL,
  `exp_id` int(11) NOT NULL,
  `argumen` varchar(100) NOT NULL,
  `leftnum` int(11) NOT NULL,
  `rightnum` int(11) NOT NULL,
  PRIMARY KEY (`id_aturan`,`urutan_body`,`exp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekspresi`
--

INSERT INTO `ekspresi` (`id_aturan`, `urutan_body`, `exp_id`, `argumen`, `leftnum`, `rightnum`) VALUES
(4, 3, 1, 'z', 2, 3),
(4, 3, 2, '3.25', 4, 5),
(4, 3, 3, '>=', 1, 6),
(5, 3, 1, 'z', 2, 3),
(5, 3, 2, '22', 4, 5),
(5, 3, 3, '>', 1, 6),
(5, 4, 1, 'z', 2, 3),
(5, 4, 2, '24', 4, 5),
(5, 4, 3, '<=', 1, 6),
(6, 2, 1, 'z', 2, 3),
(6, 2, 2, '''S1''', 4, 5),
(6, 2, 3, '=', 1, 6),
(7, 2, 1, 'c', 2, 3),
(7, 2, 2, '''Daftar''', 4, 5),
(7, 2, 3, '=', 1, 6),
(12, 3, 1, 'a', 2, 3),
(12, 3, 2, '''Tunai''', 4, 5),
(12, 3, 3, '=', 1, 6),
(12, 4, 1, 'b', 2, 3),
(12, 4, 2, '''Tidak skorsing''', 4, 5),
(12, 4, 3, '=', 1, 6),
(14, 4, 1, 'c', 2, 3),
(14, 4, 2, '''Daftar''', 4, 5),
(14, 4, 3, '=', 1, 6),
(15, 4, 1, 'c', 2, 3),
(15, 4, 2, '''Daftar''', 4, 5),
(15, 4, 3, '=', 1, 6),
(16, 3, 1, 'z', 2, 3),
(16, 3, 2, '2.90', 4, 5),
(16, 3, 3, '>=', 1, 6),
(17, 3, 1, 'z', 2, 3),
(17, 3, 2, '20', 4, 5),
(17, 3, 3, '>', 1, 6),
(17, 4, 1, 'z', 2, 3),
(17, 4, 2, '22', 4, 5),
(17, 4, 3, '<=', 1, 6),
(18, 4, 1, 'p', 2, 3),
(18, 4, 2, 'q', 4, 5),
(18, 4, 3, '=', 1, 6),
(20, 3, 1, 'z', 2, 3),
(20, 3, 2, '12', 4, 5),
(20, 3, 3, '>', 1, 6),
(20, 4, 1, 'z', 2, 3),
(20, 4, 2, '16', 4, 5),
(20, 4, 3, '<=', 1, 6),
(21, 2, 1, 'z', 2, 3),
(21, 2, 2, '''S2''', 4, 5),
(21, 2, 3, '=', 1, 6),
(22, 3, 1, 'z', 2, 3),
(22, 3, 2, '3.00', 4, 5),
(22, 3, 3, '>=', 1, 6),
(25, 2, 1, 'p', 2, 3),
(25, 2, 2, '232', 4, 5),
(25, 2, 3, '=', 1, 6),
(26, 2, 1, 'p', 2, 3),
(26, 2, 2, '235', 4, 5),
(26, 2, 3, '=', 1, 6),
(31, 3, 1, 'n', 2, 3),
(31, 3, 2, '2.75', 4, 5),
(31, 3, 3, '>=', 1, 6),
(33, 4, 1, 'a', 2, 3),
(33, 4, 2, '36', 4, 5),
(33, 4, 3, '=', 1, 6),
(33, 5, 1, 'b', 2, 3),
(33, 5, 2, '0', 4, 5),
(33, 5, 3, '=', 1, 6),
(33, 6, 1, 'c', 2, 3),
(33, 6, 2, '0', 4, 5),
(33, 6, 3, '=', 1, 6),
(33, 7, 1, 'n', 2, 3),
(33, 7, 2, '2.00', 4, 5),
(33, 7, 3, '>=', 1, 6),
(35, 5, 1, 'z', 2, 3),
(35, 5, 2, 't', 5, 6),
(35, 5, 3, '2', 7, 8),
(35, 5, 4, '+', 4, 9),
(35, 5, 5, '<=', 1, 10),
(36, 2, 1, 'c', 2, 3),
(36, 2, 2, '''dropout''', 4, 5),
(36, 2, 3, '=', 1, 6),
(38, 2, 1, 'c', 2, 3),
(38, 2, 2, '''dropout lagi''', 4, 5),
(38, 2, 3, '=', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `idb`
--

CREATE TABLE IF NOT EXISTS `idb` (
  `id_aturan` int(11) NOT NULL AUTO_INCREMENT,
  `id_predikat` int(11) NOT NULL,
  PRIMARY KEY (`id_aturan`),
  KEY `id_predikat` (`id_predikat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `idb`
--

INSERT INTO `idb` (`id_aturan`, `id_predikat`) VALUES
(4, 8),
(2, 12),
(3, 12),
(6, 14),
(16, 16),
(22, 17),
(21, 19),
(5, 25),
(17, 26),
(20, 27),
(18, 28),
(14, 31),
(15, 31),
(7, 32),
(12, 34),
(10, 36),
(29, 39),
(30, 39),
(31, 40),
(25, 42),
(26, 42),
(27, 45),
(28, 46),
(35, 48),
(33, 51),
(34, 52),
(36, 54),
(38, 54),
(37, 55);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ip`
--
CREATE TABLE IF NOT EXISTS `ip` (
`nim` varchar(20)
,`semester` int(5)
,`tahun` int(5)
,`IP` float(5,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ipk_tpb`
--
CREATE TABLE IF NOT EXISTS `ipk_tpb` (
`nim` varchar(10)
,`IPK` float(5,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus`
--
CREATE TABLE IF NOT EXISTS `kasus` (
`nim` varchar(10)
,`semester` int(5)
,`tahun` int(5)
,`kasus` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `kelas`
--
CREATE TABLE IF NOT EXISTS `kelas` (
`id_kelas` int(11)
,`kode_kuliah` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `last_nr`
--
CREATE TABLE IF NOT EXISTS `last_nr` (
`x` varchar(20)
,`y` int(11)
,`z` float(5,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `last_nr2`
--
CREATE TABLE IF NOT EXISTS `last_nr2` (
`X` varchar(20)
,`Y` int(11)
,`Z` float(5,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `latest_ip`
--
CREATE TABLE IF NOT EXISTS `latest_ip` (
`x` varchar(20)
,`n` float(5,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `lulus_tpb`
--
CREATE TABLE IF NOT EXISTS `lulus_tpb` (
`x` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `mahasiswa`
--
CREATE TABLE IF NOT EXISTS `mahasiswa` (
`nim` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `matkul`
--
CREATE TABLE IF NOT EXISTS `matkul` (
`kode_kuliah` varchar(10)
,`kode_prodi` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `matkul_s2`
--
CREATE TABLE IF NOT EXISTS `matkul_s2` (
`c` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `max16_sks`
--
CREATE TABLE IF NOT EXISTS `max16_sks` (
`x` varchar(20)
,`y` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `max22_sks`
--
CREATE TABLE IF NOT EXISTS `max22_sks` (
`x` varchar(20)
,`y` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `max24_mhs`
--

CREATE TABLE IF NOT EXISTS `max24_mhs` (
  `nim` varchar(15) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `max24_mhs`
--

INSERT INTO `max24_mhs` (`nim`, `semester`) VALUES
('13512002', 3),
('13512075', 3),
('13512075', 3),
('13512005', 3),
('13512071', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `max24_sks`
--
CREATE TABLE IF NOT EXISTS `max24_sks` (
`x` varchar(20)
,`y` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `mhs_s1`
--
CREATE TABLE IF NOT EXISTS `mhs_s1` (
`x` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `mhs_s2`
--
CREATE TABLE IF NOT EXISTS `mhs_s2` (
`x` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `nr`
--
CREATE TABLE IF NOT EXISTS `nr` (
`nim` varchar(20)
,`semester` int(5)
,`NR` float(5,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `nr_lengkap`
--
CREATE TABLE IF NOT EXISTS `nr_lengkap` (
`x` varchar(20)
,`y` int(5)
);
-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE IF NOT EXISTS `policy` (
  `id_policy` varchar(10) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_policy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`id_policy`, `deskripsi`) VALUES
('PA0404', 'Beban lebih untuk percepatan studi'),
('PA0901', 'Syarat boleh mengambil matakuliah S2'),
('PA1801', 'Persyaratan pendaftaran ulang'),
('PA5101', 'Penghentian studi program sarjana');

-- --------------------------------------------------------

--
-- Table structure for table `predikat`
--

CREATE TABLE IF NOT EXISTS `predikat` (
  `id_predikat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_predikat` varchar(50) NOT NULL,
  `jumlah_argumen` int(11) NOT NULL,
  `kelompok_predikat` varchar(10) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_predikat`),
  UNIQUE KEY `nama_predikat_2` (`nama_predikat`),
  KEY `nama_predikat` (`nama_predikat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `predikat`
--

INSERT INTO `predikat` (`id_predikat`, `nama_predikat`, `jumlah_argumen`, `kelompok_predikat`, `deskripsi`) VALUES
(1, '=', 2, 'Operator', 'Operator sama dengan'),
(2, '<>', 2, 'Operator', 'Operator tidak sama dengan'),
(3, '>', 2, 'Operator', 'Operator lebih dari'),
(4, '<', 2, 'Operator', 'Operator kurang dari'),
(5, 'previous', 2, 'Operator', 'Operator decrement'),
(6, 'mahasiswa', 1, 'EDB', 'Entitas mahasiswa'),
(7, 'nr', 3, 'EDB', 'Nilai rata-rata mahasiswa'),
(8, 'max24_sks', 2, 'IDB', 'Aturan maksimal 24 sks'),
(9, 'sks_total', 3, 'EDB', 'Jumlah sks tanpa nilai T'),
(10, 'sks_ambil', 3, 'EDB', 'Jumlah sks yang diambil dalam 1 semester'),
(11, 'next', 2, 'Operator', 'Operator increment'),
(12, 'last_nr', 3, 'IDB', 'NR terakhir mahasiswa '),
(13, 'strata_mhs', 3, 'EDB', 'Keterangan strata mahasiswa'),
(14, 'mhs_s1', 1, 'IDB', 'Mahasiswa dengan strata S1'),
(15, '>=', 2, 'Operator', 'Lebih dari sama dengan'),
(16, 'max22_sks', 2, 'IDB', 'Aturan maksimal 22 sks'),
(17, 'max16_sks', 2, 'IDB', 'Aturan maksimal 16 sks'),
(18, '<=', 2, 'Operator', 'Kurang dari sama dengan'),
(19, 'mhs_s2', 1, 'IDB', 'Mahasiswa dengan strata S2'),
(20, 'mhs_s3', 1, 'IDB', 'Mahasiswa dengan strata S3'),
(21, 'nr2', 4, 'EDB', 'NR mahasiswa di semester dan tahun tertentu'),
(22, 'prev_nr', 4, 'IDB', 'NR mahasiswa di semester sebelumnya'),
(23, 'prev_semester', 3, 'IDB', 'Mahasiswa yang dilihat NR semester sebelumnya'),
(24, 'daftar', 3, 'EDB', 'Mahasiswa yang melakukan daftar ulang'),
(25, 'check_BS2A', 2, 'IDB', 'Snapshot data untuk aturan BS2A'),
(26, 'check_BS2B', 2, 'IDB', 'Snapshot data untuk aturan BS2B'),
(27, 'check_BS3', 2, 'IDB', 'Snapshot data untuk aturan BS3 '),
(28, 'nr_lengkap', 2, 'IDB', 'Jumlah SKS yang dihitung sesuai dengan jumlah sKS yang diambil'),
(29, 'last_nr2', 3, 'IDB', 'NR terakhir mahasiswa versi 2'),
(31, 'terdaftar', 3, 'IDB', 'Mahasiswa yang terdaftar pada semester sebelumnya'),
(32, 'daftar2', 4, 'IDB', 'Mahasiswa yang melakukan pendaftaran'),
(33, 'status_mhs', 7, 'EDB', 'Status mahasiswa'),
(34, 'daftar_ulang', 3, 'IDB', 'Mahasiswa yang boleh daftar ulang'),
(35, 'stat_mahasiswa1', 5, 'EDB', 'Status untuk prasyarat daftar ulang'),
(36, 'check_BS18', 3, 'IDB', 'Snapshot data untuk aturan BS18'),
(37, 'current', 1, 'Operator', 'Operator this'),
(38, 'ip', 4, 'EDB', 'Indeks prestasi mahasiswa'),
(39, 'latest_ip', 2, 'IDB', 'IP terbaru mahasiswa'),
(40, 'ambil_S2', 3, 'IDB', 'Syarat boleh mengambil matakuliah S2'),
(41, 'matkul', 2, 'EDB', 'Kode dan prodi matakuliah'),
(42, 'matkul_S2', 1, 'IDB', 'Mata kuliah S2'),
(43, 'kelas', 2, 'EDB', 'Kelas matakuliah'),
(44, 'ambil', 4, 'EDB', 'Kelas yang diambil mahasiswa'),
(45, 'ambil_kuliah', 4, 'IDB', 'Mata kuliah yang diambil mahasiswa'),
(46, 'check_BS9', 3, 'IDB', 'Snapshot data untuk aturan BS9'),
(47, 'thn_masuk', 2, 'EDB', 'Tahun masuk mahasiswa'),
(48, 'batas_TPB', 2, 'IDB', 'Batas studi masa TPB'),
(49, 'sks_TPB', 4, 'EDB', 'Jumlah sks lulus masa TPB'),
(50, 'ipk_TPB', 2, 'EDB', 'IPK untuk TPB'),
(51, 'lulus_TPB', 1, 'IDB', 'Mahasiswa yang lulus TPB'),
(52, 'dropout_S1', 1, 'IDB', 'Syarat dropout untuk jenjang S1'),
(53, 'kasus', 4, 'EDB', 'Ringkasan kasus akademik mahasiswa'),
(54, 'daftar_DO', 1, 'IDB', 'Mahasiswa yang terancam dropout'),
(55, 'check_BS51A', 1, 'IDB', 'Snapshot data untuk aturan BS51A'),
(57, 'test', 3, 'IDB', 'Test rule');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE IF NOT EXISTS `reference` (
  `id_ref` varchar(50) NOT NULL,
  `predikat` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `db_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_ref`),
  KEY `predikat` (`predikat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id_ref`, `predikat`, `table_name`, `db_name`) VALUES
('ambil', 44, 'mengambil', 'data_test'),
('daftar', 24, 'daftar_ulang', 'praktikum'),
('ip', 38, 'rapor', 'data_test'),
('ipk_TPB', 50, 'transkrip_tpb', 'data_test'),
('kasus', 53, 'kasus_akademik', 'data_test'),
('kelas', 43, 'kelas', 'data_test'),
('mahasiswa', 6, 'mahasiswa', 'praktikum'),
('matkul', 41, 'kuliah', 'data_test'),
('nr', 7, 'rapor', 'praktikum'),
('nr2', 21, 'rapor', 'praktikum'),
('sks_ambil', 10, 'rapor', 'praktikum'),
('sks_total', 9, 'rapor', 'praktikum'),
('sks_TPB', 49, 'transkrip_tpb', 'data_test'),
('status_mhs', 33, 'status_mhs', 'data_test'),
('stat_mahasiswa1', 35, 'status_mhs', 'data_test'),
('strata_mhs', 13, 'mahasiswa', 'praktikum'),
('thn_masuk', 47, 'mahasiswa', 'data_test');

-- --------------------------------------------------------

--
-- Table structure for table `ref_attribute`
--

CREATE TABLE IF NOT EXISTS `ref_attribute` (
  `id_ref` varchar(50) NOT NULL,
  `order` int(5) NOT NULL,
  `attr_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ref`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_attribute`
--

INSERT INTO `ref_attribute` (`id_ref`, `order`, `attr_name`) VALUES
('ambil', 1, 'nim'),
('ambil', 2, 'semester'),
('ambil', 3, 'tahun'),
('ambil', 4, 'id_kelas'),
('daftar', 1, 'nim'),
('daftar', 2, 'semester'),
('daftar', 3, 'sks'),
('ip', 1, 'nim'),
('ip', 2, 'semester'),
('ip', 3, 'tahun'),
('ip', 4, 'IP'),
('ipk_TPB', 1, 'nim'),
('ipk_TPB', 2, 'IPK'),
('kasus', 1, 'nim'),
('kasus', 2, 'semester'),
('kasus', 3, 'tahun'),
('kasus', 4, 'kasus'),
('kelas', 1, 'id_kelas'),
('kelas', 2, 'kode_kuliah'),
('mahasiswa', 1, 'nim'),
('matkul', 1, 'kode_kuliah'),
('matkul', 2, 'kode_prodi'),
('nr', 1, 'nim'),
('nr', 2, 'semester'),
('nr', 3, 'NR'),
('nr2', 1, 'nim'),
('nr2', 2, 'semester'),
('nr2', 3, 'tahun'),
('nr2', 4, 'NR'),
('sks_ambil', 1, 'nim'),
('sks_ambil', 2, 'semester'),
('sks_ambil', 3, 'sks_ambil'),
('sks_total', 1, 'nim'),
('sks_total', 2, 'semester'),
('sks_total', 3, 'sks_total'),
('sks_TPB', 1, 'nim'),
('sks_TPB', 2, 'sks_lulus'),
('sks_TPB', 3, 'sks_E'),
('sks_TPB', 4, 'sks_T'),
('status_mhs', 1, 'nim'),
('status_mhs', 2, 'semester'),
('status_mhs', 3, 'tahun'),
('status_mhs', 4, 'stat_daftar'),
('status_mhs', 5, 'stat_bayar'),
('status_mhs', 6, 'stat_skorsing'),
('status_mhs', 7, 'jumlah_sks'),
('stat_mahasiswa1', 1, 'nim'),
('stat_mahasiswa1', 2, 'semester'),
('stat_mahasiswa1', 3, 'tahun'),
('stat_mahasiswa1', 4, 'stat_bayar'),
('stat_mahasiswa1', 5, 'stat_skorsing'),
('strata_mhs', 1, 'nim'),
('strata_mhs', 2, 'nama'),
('strata_mhs', 3, 'strata'),
('thn_masuk', 1, 'nim'),
('thn_masuk', 2, 'thn_masuk');

-- --------------------------------------------------------

--
-- Stand-in structure for view `sks_ambil`
--
CREATE TABLE IF NOT EXISTS `sks_ambil` (
`nim` varchar(20)
,`semester` int(5)
,`sks_ambil` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `sks_total`
--
CREATE TABLE IF NOT EXISTS `sks_total` (
`nim` varchar(20)
,`semester` int(5)
,`sks_total` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `sks_tpb`
--
CREATE TABLE IF NOT EXISTS `sks_tpb` (
`nim` varchar(10)
,`sks_lulus` int(5)
,`sks_E` int(5)
,`sks_T` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `status_mhs`
--
CREATE TABLE IF NOT EXISTS `status_mhs` (
`nim` varchar(10)
,`semester` int(5)
,`tahun` int(5)
,`stat_daftar` varchar(30)
,`stat_bayar` varchar(30)
,`stat_skorsing` varchar(30)
,`jumlah_sks` int(5)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `stat_mahasiswa1`
--
CREATE TABLE IF NOT EXISTS `stat_mahasiswa1` (
`nim` varchar(10)
,`semester` int(5)
,`tahun` int(5)
,`stat_bayar` varchar(30)
,`stat_skorsing` varchar(30)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `strata_mhs`
--
CREATE TABLE IF NOT EXISTS `strata_mhs` (
`nim` varchar(20)
,`nama` varchar(255)
,`strata` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `terdaftar`
--
CREATE TABLE IF NOT EXISTS `terdaftar` (
`x` varchar(10)
,`y` int(11)
,`z` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `thn_masuk`
--
CREATE TABLE IF NOT EXISTS `thn_masuk` (
`nim` varchar(20)
,`thn_masuk` int(5)
);
-- --------------------------------------------------------

--
-- Structure for view `ambil`
--
DROP TABLE IF EXISTS `ambil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ambil` AS select `data_test`.`mengambil`.`nim` AS `nim`,`data_test`.`mengambil`.`semester` AS `semester`,`data_test`.`mengambil`.`tahun` AS `tahun`,`data_test`.`mengambil`.`id_kelas` AS `id_kelas` from `data_test`.`mengambil`;

-- --------------------------------------------------------

--
-- Structure for view `ambil_kuliah`
--
DROP TABLE IF EXISTS `ambil_kuliah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ambil_kuliah` AS select `ambil`.`nim` AS `x`,`ambil`.`semester` AS `y`,`ambil`.`tahun` AS `z`,`kelas`.`kode_kuliah` AS `c` from (`ambil` join `kelas`) where (`ambil`.`id_kelas` = `kelas`.`id_kelas`);

-- --------------------------------------------------------

--
-- Structure for view `ambil_s2`
--
DROP TABLE IF EXISTS `ambil_s2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ambil_s2` AS select `daftar2`.`x` AS `x`,`daftar2`.`y` AS `y`,`daftar2`.`z` AS `z` from (`daftar2` join `latest_ip`) where ((`daftar2`.`x` = `latest_ip`.`x`) and (`latest_ip`.`n` >= 2.75));

-- --------------------------------------------------------

--
-- Structure for view `batas_tpb`
--
DROP TABLE IF EXISTS `batas_tpb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `batas_tpb` AS select `daftar2`.`x` AS `x`,`daftar2`.`z` AS `z` from ((`daftar2` join `mhs_s1`) join `thn_masuk`) where ((not(exists(select 1 from `lulus_tpb` where (`daftar2`.`x` = `lulus_tpb`.`x`)))) and (`daftar2`.`x` = `mhs_s1`.`x`) and (`daftar2`.`x` = `thn_masuk`.`nim`) and (`daftar2`.`z` <= (`thn_masuk`.`thn_masuk` + 2)) and (`daftar2`.`x` = 13512003));

-- --------------------------------------------------------

--
-- Structure for view `check_bs2a`
--
DROP TABLE IF EXISTS `check_bs2a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `check_bs2a` AS select `mhs_s1`.`x` AS `x`,`daftar`.`semester` AS `y` from (`mhs_s1` join `daftar`) where ((`mhs_s1`.`x` = `daftar`.`nim`) and (`daftar`.`sks` > 22) and (`daftar`.`sks` <= 24));

-- --------------------------------------------------------

--
-- Structure for view `check_bs2b`
--
DROP TABLE IF EXISTS `check_bs2b`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `check_bs2b` AS select `mhs_s1`.`x` AS `x`,`daftar`.`semester` AS `y` from (`mhs_s1` join `daftar`) where ((`mhs_s1`.`x` = `daftar`.`nim`) and (`daftar`.`sks` > 20) and (`daftar`.`sks` <= 22));

-- --------------------------------------------------------

--
-- Structure for view `check_bs3`
--
DROP TABLE IF EXISTS `check_bs3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `check_bs3` AS select `mhs_s2`.`x` AS `x`,`daftar`.`semester` AS `y` from (`mhs_s2` join `daftar`) where ((`mhs_s2`.`x` = `daftar`.`nim`) and (`daftar`.`sks` > 12) and (`daftar`.`sks` <= 16));

-- --------------------------------------------------------

--
-- Structure for view `check_bs9`
--
DROP TABLE IF EXISTS `check_bs9`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `check_bs9` AS select `ambil_kuliah`.`x` AS `x`,`ambil_kuliah`.`y` AS `y`,`ambil_kuliah`.`z` AS `z` from (((`ambil_kuliah` join `mhs_s1`) join `daftar2`) join `matkul_s2`) where ((`ambil_kuliah`.`x` = `mhs_s1`.`x`) and (`ambil_kuliah`.`x` = `daftar2`.`x`) and (`ambil_kuliah`.`y` = `daftar2`.`y`) and (`ambil_kuliah`.`z` = `daftar2`.`z`) and (`ambil_kuliah`.`c` = `matkul_s2`.`c`));

-- --------------------------------------------------------

--
-- Structure for view `check_bs18`
--
DROP TABLE IF EXISTS `check_bs18`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `check_bs18` AS select `daftar2`.`x` AS `x`,`daftar2`.`y` AS `y`,`daftar2`.`z` AS `z` from `daftar2`;

-- --------------------------------------------------------

--
-- Structure for view `check_bs51a`
--
DROP TABLE IF EXISTS `check_bs51a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `check_bs51a` AS select `mhs_s1`.`x` AS `x` from (`mhs_s1` join `daftar_do`) where (`mhs_s1`.`x` = `daftar_do`.`x`);

-- --------------------------------------------------------

--
-- Structure for view `contoh`
--
DROP TABLE IF EXISTS `contoh`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contoh` AS select `praktikum`.`dosen`.`nip` AS `nip`,`praktikum`.`dosen`.`nama` AS `nama` from `praktikum`.`dosen`;

-- --------------------------------------------------------

--
-- Structure for view `daftar`
--
DROP TABLE IF EXISTS `daftar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar` AS select `praktikum`.`daftar_ulang`.`nim` AS `nim`,`praktikum`.`daftar_ulang`.`semester` AS `semester`,`praktikum`.`daftar_ulang`.`sks` AS `sks` from `praktikum`.`daftar_ulang`;

-- --------------------------------------------------------

--
-- Structure for view `daftar2`
--
DROP TABLE IF EXISTS `daftar2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar2` AS select `status_mhs`.`nim` AS `x`,`status_mhs`.`semester` AS `y`,`status_mhs`.`tahun` AS `z`,`status_mhs`.`jumlah_sks` AS `f` from `status_mhs` where ((`status_mhs`.`stat_daftar` = 'Daftar') and (`status_mhs`.`nim` = 13512003));

-- --------------------------------------------------------

--
-- Structure for view `daftar_do`
--
DROP TABLE IF EXISTS `daftar_do`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_do` AS select `kasus`.`nim` AS `x` from `kasus` where (`kasus`.`kasus` = 'dropout');

-- --------------------------------------------------------

--
-- Structure for view `daftar_ulang`
--
DROP TABLE IF EXISTS `daftar_ulang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_ulang` AS select `stat_mahasiswa1`.`nim` AS `x`,`stat_mahasiswa1`.`semester` AS `y`,`stat_mahasiswa1`.`tahun` AS `z` from (`stat_mahasiswa1` join `terdaftar`) where ((`stat_mahasiswa1`.`nim` = `terdaftar`.`x`) and (`stat_mahasiswa1`.`semester` = `terdaftar`.`y`) and (`stat_mahasiswa1`.`stat_bayar` = 'Tunai') and (`stat_mahasiswa1`.`stat_skorsing` = 'Tidak skorsing'));

-- --------------------------------------------------------

--
-- Structure for view `dropout_s1`
--
DROP TABLE IF EXISTS `dropout_s1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dropout_s1` AS select `mhs_s1`.`x` AS `x` from `mhs_s1` where (not(exists(select 1 from `batas_tpb` where (`mhs_s1`.`x` = `batas_tpb`.`x`))));

-- --------------------------------------------------------

--
-- Structure for view `ip`
--
DROP TABLE IF EXISTS `ip`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ip` AS select `data_test`.`rapor`.`nim` AS `nim`,`data_test`.`rapor`.`semester` AS `semester`,`data_test`.`rapor`.`tahun` AS `tahun`,`data_test`.`rapor`.`IP` AS `IP` from `data_test`.`rapor`;

-- --------------------------------------------------------

--
-- Structure for view `ipk_tpb`
--
DROP TABLE IF EXISTS `ipk_tpb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ipk_tpb` AS select `data_test`.`transkrip_tpb`.`nim` AS `nim`,`data_test`.`transkrip_tpb`.`IPK` AS `IPK` from `data_test`.`transkrip_tpb`;

-- --------------------------------------------------------

--
-- Structure for view `kasus`
--
DROP TABLE IF EXISTS `kasus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus` AS select `data_test`.`kasus_akademik`.`nim` AS `nim`,`data_test`.`kasus_akademik`.`semester` AS `semester`,`data_test`.`kasus_akademik`.`tahun` AS `tahun`,`data_test`.`kasus_akademik`.`kasus` AS `kasus` from `data_test`.`kasus_akademik`;

-- --------------------------------------------------------

--
-- Structure for view `kelas`
--
DROP TABLE IF EXISTS `kelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kelas` AS select `data_test`.`kelas`.`id_kelas` AS `id_kelas`,`data_test`.`kelas`.`kode_kuliah` AS `kode_kuliah` from `data_test`.`kelas`;

-- --------------------------------------------------------

--
-- Structure for view `last_nr`
--
DROP TABLE IF EXISTS `last_nr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `last_nr` AS select `nr`.`nim` AS `x`,`nr`.`semester` AS `y`,`nr`.`NR` AS `z` from (`nr` join `nr_lengkap`) where ((`nr`.`nim` = `nr_lengkap`.`x`) and (`nr`.`semester` = `nr_lengkap`.`y`) and (`nr`.`nim` = 13512015) and (`nr`.`semester` = (4 - 1))) union select `nr`.`nim` AS `x`,`nr`.`semester` AS `y`,`nr`.`NR` AS `z` from `nr` where ((not(exists(select 1 from `nr_lengkap` where ((`nr`.`nim` = `nr_lengkap`.`x`) and (`nr`.`semester` = `nr_lengkap`.`y`))))) and (`nr`.`nim` = 13512015) and (`nr`.`semester` = (4 - 2)));

-- --------------------------------------------------------

--
-- Structure for view `last_nr2`
--
DROP TABLE IF EXISTS `last_nr2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `last_nr2` AS select `nr`.`nim` AS `X`,`nr`.`semester` AS `Y`,`nr`.`NR` AS `Z` from (`nr` join `nr_lengkap`) where ((`nr`.`nim` = `nr_lengkap`.`x`) and (`nr`.`semester` = `nr_lengkap`.`y`) and (`nr`.`nim` = 13512015) and (`nr`.`semester` = (4 - 1))) union select `nr`.`nim` AS `X`,`nr`.`semester` AS `Y`,`nr`.`NR` AS `Z` from `nr` where ((not(exists(select 1 from `nr_lengkap` where ((`nr`.`nim` = `nr_lengkap`.`x`) and (`nr`.`semester` = `nr_lengkap`.`y`))))) and (`nr`.`nim` = 13512015) and (`nr`.`semester` = (4 - 2)));

-- --------------------------------------------------------

--
-- Structure for view `latest_ip`
--
DROP TABLE IF EXISTS `latest_ip`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `latest_ip` AS select `ip`.`nim` AS `x`,`ip`.`IP` AS `n` from `ip` where (`ip`.`nim` = 13512013) union select `ip`.`nim` AS `x`,`ip`.`IP` AS `n` from `ip` where (`ip`.`nim` = 13512013);

-- --------------------------------------------------------

--
-- Structure for view `lulus_tpb`
--
DROP TABLE IF EXISTS `lulus_tpb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lulus_tpb` AS select `mhs_s1`.`x` AS `x` from ((`mhs_s1` join `sks_tpb`) join `ipk_tpb`) where ((`mhs_s1`.`x` = `sks_tpb`.`nim`) and (`mhs_s1`.`x` = `ipk_tpb`.`nim`) and (`sks_tpb`.`sks_lulus` = 36) and (`sks_tpb`.`sks_E` = 0) and (`sks_tpb`.`sks_T` = 0) and (`ipk_tpb`.`IPK` >= 2.00) and (`mhs_s1`.`x` = 13512003));

-- --------------------------------------------------------

--
-- Structure for view `mahasiswa`
--
DROP TABLE IF EXISTS `mahasiswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mahasiswa` AS select `praktikum`.`mahasiswa`.`nim` AS `nim` from `praktikum`.`mahasiswa`;

-- --------------------------------------------------------

--
-- Structure for view `matkul`
--
DROP TABLE IF EXISTS `matkul`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `matkul` AS select `data_test`.`kuliah`.`kode_kuliah` AS `kode_kuliah`,`data_test`.`kuliah`.`kode_prodi` AS `kode_prodi` from `data_test`.`kuliah`;

-- --------------------------------------------------------

--
-- Structure for view `matkul_s2`
--
DROP TABLE IF EXISTS `matkul_s2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `matkul_s2` AS select `matkul`.`kode_kuliah` AS `c` from `matkul` where (`matkul`.`kode_prodi` = 232) union select `matkul`.`kode_kuliah` AS `c` from `matkul` where (`matkul`.`kode_prodi` = 235);

-- --------------------------------------------------------

--
-- Structure for view `max16_sks`
--
DROP TABLE IF EXISTS `max16_sks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max16_sks` AS select `mhs_s2`.`x` AS `x`,`last_nr`.`y` AS `y` from (`mhs_s2` join `last_nr`) where ((`mhs_s2`.`x` = `last_nr`.`x`) and (`last_nr`.`z` >= 3.00));

-- --------------------------------------------------------

--
-- Structure for view `max22_sks`
--
DROP TABLE IF EXISTS `max22_sks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max22_sks` AS select `mhs_s1`.`x` AS `x`,`last_nr`.`y` AS `y` from (`mhs_s1` join `last_nr`) where ((`mhs_s1`.`x` = `last_nr`.`x`) and (`last_nr`.`z` >= 2.90));

-- --------------------------------------------------------

--
-- Structure for view `max24_sks`
--
DROP TABLE IF EXISTS `max24_sks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max24_sks` AS select `mhs_s1`.`x` AS `x`,`last_nr`.`y` AS `y` from (`mhs_s1` join `last_nr`) where ((`mhs_s1`.`x` = `last_nr`.`x`) and (`last_nr`.`z` >= 3.25));

-- --------------------------------------------------------

--
-- Structure for view `mhs_s1`
--
DROP TABLE IF EXISTS `mhs_s1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mhs_s1` AS select `strata_mhs`.`nim` AS `x` from `strata_mhs` where ((`strata_mhs`.`strata` = 'S1') and (`strata_mhs`.`nim` = 13512015));

-- --------------------------------------------------------

--
-- Structure for view `mhs_s2`
--
DROP TABLE IF EXISTS `mhs_s2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mhs_s2` AS select `strata_mhs`.`nim` AS `x` from `strata_mhs` where ((`strata_mhs`.`strata` = 'S2') and (`strata_mhs`.`nim` = 13512061));

-- --------------------------------------------------------

--
-- Structure for view `nr`
--
DROP TABLE IF EXISTS `nr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nr` AS select `praktikum`.`rapor`.`nim` AS `nim`,`praktikum`.`rapor`.`semester` AS `semester`,`praktikum`.`rapor`.`NR` AS `NR` from `praktikum`.`rapor`;

-- --------------------------------------------------------

--
-- Structure for view `nr_lengkap`
--
DROP TABLE IF EXISTS `nr_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nr_lengkap` AS select `sks_total`.`nim` AS `x`,`sks_total`.`semester` AS `y` from (`sks_total` join `sks_ambil`) where ((`sks_total`.`nim` = `sks_ambil`.`nim`) and (`sks_total`.`semester` = `sks_ambil`.`semester`) and (`sks_total`.`sks_total` = `sks_ambil`.`sks_ambil`) and (`sks_total`.`nim` = 13512015) and (`sks_total`.`semester` = (4 - 1)));

-- --------------------------------------------------------

--
-- Structure for view `sks_ambil`
--
DROP TABLE IF EXISTS `sks_ambil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sks_ambil` AS select `praktikum`.`rapor`.`nim` AS `nim`,`praktikum`.`rapor`.`semester` AS `semester`,`praktikum`.`rapor`.`sks_ambil` AS `sks_ambil` from `praktikum`.`rapor`;

-- --------------------------------------------------------

--
-- Structure for view `sks_total`
--
DROP TABLE IF EXISTS `sks_total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sks_total` AS select `praktikum`.`rapor`.`nim` AS `nim`,`praktikum`.`rapor`.`semester` AS `semester`,`praktikum`.`rapor`.`sks_total` AS `sks_total` from `praktikum`.`rapor`;

-- --------------------------------------------------------

--
-- Structure for view `sks_tpb`
--
DROP TABLE IF EXISTS `sks_tpb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sks_tpb` AS select `data_test`.`transkrip_tpb`.`nim` AS `nim`,`data_test`.`transkrip_tpb`.`sks_lulus` AS `sks_lulus`,`data_test`.`transkrip_tpb`.`sks_E` AS `sks_E`,`data_test`.`transkrip_tpb`.`sks_T` AS `sks_T` from `data_test`.`transkrip_tpb`;

-- --------------------------------------------------------

--
-- Structure for view `status_mhs`
--
DROP TABLE IF EXISTS `status_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `status_mhs` AS select `data_test`.`status_mhs`.`nim` AS `nim`,`data_test`.`status_mhs`.`semester` AS `semester`,`data_test`.`status_mhs`.`tahun` AS `tahun`,`data_test`.`status_mhs`.`stat_daftar` AS `stat_daftar`,`data_test`.`status_mhs`.`stat_bayar` AS `stat_bayar`,`data_test`.`status_mhs`.`stat_skorsing` AS `stat_skorsing`,`data_test`.`status_mhs`.`jumlah_sks` AS `jumlah_sks` from `data_test`.`status_mhs`;

-- --------------------------------------------------------

--
-- Structure for view `stat_mahasiswa1`
--
DROP TABLE IF EXISTS `stat_mahasiswa1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stat_mahasiswa1` AS select `data_test`.`status_mhs`.`nim` AS `nim`,`data_test`.`status_mhs`.`semester` AS `semester`,`data_test`.`status_mhs`.`tahun` AS `tahun`,`data_test`.`status_mhs`.`stat_bayar` AS `stat_bayar`,`data_test`.`status_mhs`.`stat_skorsing` AS `stat_skorsing` from `data_test`.`status_mhs`;

-- --------------------------------------------------------

--
-- Structure for view `strata_mhs`
--
DROP TABLE IF EXISTS `strata_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `strata_mhs` AS select `praktikum`.`mahasiswa`.`nim` AS `nim`,`praktikum`.`mahasiswa`.`nama` AS `nama`,`praktikum`.`mahasiswa`.`strata` AS `strata` from `praktikum`.`mahasiswa`;

-- --------------------------------------------------------

--
-- Structure for view `terdaftar`
--
DROP TABLE IF EXISTS `terdaftar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `terdaftar` AS select `status_mhs`.`nim` AS `x`,`status_mhs`.`semester` AS `y`,`status_mhs`.`tahun` AS `z` from `status_mhs` where ((`status_mhs`.`stat_daftar` = 'Daftar') and (`status_mhs`.`semester` = (2 + 1)) and (`status_mhs`.`nim` = 13512013) and (`status_mhs`.`tahun` = (2015 - 1))) union select `status_mhs`.`nim` AS `x`,`status_mhs`.`semester` AS `y`,`status_mhs`.`tahun` AS `z` from `status_mhs` where ((`status_mhs`.`stat_daftar` = 'Daftar') and (`status_mhs`.`nim` = 13512013) and (`status_mhs`.`semester` = (2 - 1)) and (`status_mhs`.`tahun` = 2015));

-- --------------------------------------------------------

--
-- Structure for view `thn_masuk`
--
DROP TABLE IF EXISTS `thn_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `thn_masuk` AS select `data_test`.`mahasiswa`.`nim` AS `nim`,`data_test`.`mahasiswa`.`thn_masuk` AS `thn_masuk` from `data_test`.`mahasiswa`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `argumen_body`
--
ALTER TABLE `argumen_body`
  ADD CONSTRAINT `argumen_body_ibfk_1` FOREIGN KEY (`id_aturan`) REFERENCES `body_idb` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `argumen_head`
--
ALTER TABLE `argumen_head`
  ADD CONSTRAINT `argumen_head_ibfk_1` FOREIGN KEY (`id_rule`) REFERENCES `idb` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `body_idb`
--
ALTER TABLE `body_idb`
  ADD CONSTRAINT `body_idb_ibfk_1` FOREIGN KEY (`id_aturan`) REFERENCES `idb` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `body_idb_ibfk_2` FOREIGN KEY (`predikat`) REFERENCES `predikat` (`id_predikat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `br_statement`
--
ALTER TABLE `br_statement`
  ADD CONSTRAINT `br_statement_ibfk_1` FOREIGN KEY (`id_policy`) REFERENCES `policy` (`id_policy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `br_statement_ibfk_2` FOREIGN KEY (`predikat`) REFERENCES `predikat` (`id_predikat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `br_statement_ibfk_3` FOREIGN KEY (`target`) REFERENCES `predikat` (`id_predikat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `edb`
--
ALTER TABLE `edb`
  ADD CONSTRAINT `edb_ibfk_1` FOREIGN KEY (`id_predikat`) REFERENCES `predikat` (`id_predikat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ekspresi`
--
ALTER TABLE `ekspresi`
  ADD CONSTRAINT `ekspresi_ibfk_1` FOREIGN KEY (`id_aturan`) REFERENCES `idb` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idb`
--
ALTER TABLE `idb`
  ADD CONSTRAINT `idb_ibfk_1` FOREIGN KEY (`id_predikat`) REFERENCES `predikat` (`id_predikat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`predikat`) REFERENCES `edb` (`id_predikat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ref_attribute`
--
ALTER TABLE `ref_attribute`
  ADD CONSTRAINT `ref_attribute_ibfk_1` FOREIGN KEY (`id_ref`) REFERENCES `reference` (`id_ref`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
