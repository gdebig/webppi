-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2022 at 01:12 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2022ppirpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bahasa`
--

DROP TABLE IF EXISTS `tbl_bahasa`;
CREATE TABLE IF NOT EXISTS `tbl_bahasa` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `LangType` enum('Da','Na','In') DEFAULT NULL,
  `VerbSkill` enum('Pasif','Aktif') DEFAULT NULL,
  `WriteType` text,
  `LangMark` varchar(50) DEFAULT NULL,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) DEFAULT '0',
  `nilai_q` int(11) NOT NULL DEFAULT '0',
  `nilai_r` int(11) NOT NULL DEFAULT '0',
  `nilai_w1` int(11) NOT NULL DEFAULT '0',
  `nilai_w2` int(11) NOT NULL DEFAULT '0',
  `nilai_w3` int(11) NOT NULL DEFAULT '0',
  `nilai_w4` int(11) NOT NULL DEFAULT '0',
  `nilai_pil` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian VI';

--
-- Dumping data for table `tbl_bahasa`
--

INSERT INTO `tbl_bahasa` (`Num`, `user_id`, `Name`, `LangType`, `VerbSkill`, `WriteType`, `LangMark`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(2, 4, 'Inggris', 'In', 'Aktif', 'Jurnal', '', '', 'W.4.1.2., W.4.3.5., W.4.5.2.', 6, 9, 9, 0, 0, 0, 100, 0, '2022-09-07 00:43:54', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bimbing`
--

DROP TABLE IF EXISTS `tbl_bimbing`;
CREATE TABLE IF NOT EXISTS `tbl_bimbing` (
  `bimbing_id` int(11) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bimbing_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bimbing`
--

INSERT INTO `tbl_bimbing` (`bimbing_id`, `mhs_id`, `dosen_id`, `date_created`, `date_modified`) VALUES
(1, 12, 1, '2022-07-24 17:00:00', '2022-07-24 17:00:00'),
(9, 10, 9, '2022-07-24 17:00:00', '2022-07-24 17:00:00'),
(8, 7, 9, '2022-07-24 17:00:00', '2022-07-24 17:00:00'),
(7, 13, 1, '2022-07-24 17:00:00', '2022-07-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ethicref`
--

DROP TABLE IF EXISTS `tbl_ethicref`;
CREATE TABLE IF NOT EXISTS `tbl_ethicref` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Institute` varchar(100) DEFAULT NULL,
  `Addr` varchar(200) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Prov` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Pnum` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Relation` varchar(100) DEFAULT NULL,
  `kompetensi` text NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian II.1';

--
-- Dumping data for table `tbl_ethicref`
--

INSERT INTO `tbl_ethicref` (`Num`, `user_id`, `Name`, `Institute`, `Addr`, `City`, `Prov`, `Country`, `Pnum`, `Email`, `Relation`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Boss Geje', NULL, 'Depok', 'Depok', 'Jawa Barat', 'Indonesia', '123456', 'geje@ui.ac.id', 'Bos Saja', '', '2022-08-11 14:00:32', '2022-08-10 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inovasi`
--

DROP TABLE IF EXISTS `tbl_inovasi`;
CREATE TABLE IF NOT EXISTS `tbl_inovasi` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Year` year(4) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Publication` varchar(100) DEFAULT NULL,
  `PubLevel` enum('Lok','Nas','Int') DEFAULT NULL,
  `DiffBenefit` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL DEFAULT '0',
  `nilai_q` int(11) NOT NULL DEFAULT '0',
  `nilai_r` int(11) NOT NULL DEFAULT '0',
  `nilai_w1` int(11) NOT NULL DEFAULT '0',
  `nilai_w2` int(11) NOT NULL DEFAULT '0',
  `nilai_w3` int(11) NOT NULL DEFAULT '0',
  `nilai_w4` int(11) NOT NULL DEFAULT '0',
  `nilai_pil` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.4';

--
-- Dumping data for table `tbl_inovasi`
--

INSERT INTO `tbl_inovasi` (`Num`, `user_id`, `Name`, `Year`, `Month`, `Publication`, `PubLevel`, `DiffBenefit`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(2, 4, 'Test', 2022, 1, 'Apalah', 'Nas', 'sed', 'Test saja lagi', '4_inovasi_test_406cd7fb.pdf', 'P.6.1.3., P.6.4.2., P.6.5.3.', 3, 9, 6, 0, 0, 0, 0, 162, '2022-09-07 00:24:36', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwalsidang`
--

DROP TABLE IF EXISTS `tbl_jadwalsidang`;
CREATE TABLE IF NOT EXISTS `tbl_jadwalsidang` (
  `sidang_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sidang_ruang` varchar(25) NOT NULL,
  `sidang_tanggal` varchar(35) DEFAULT NULL,
  `sidang_judul` text NOT NULL,
  `hasil_sidang` varchar(25) NOT NULL,
  `cat_sidang` text NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sidang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jadwalsidang`
--

INSERT INTO `tbl_jadwalsidang` (`sidang_id`, `ta_id`, `user_id`, `sidang_ruang`, `sidang_tanggal`, `sidang_judul`, `hasil_sidang`, `cat_sidang`, `date_created`, `date_modified`) VALUES
(3, 3, 1, 'Ruang Rapat Lt. 2', '2022-08-15 12:00 AM', '', '', '', '2022-08-13 17:00:00', '2022-08-13 17:00:00'),
(2, 4, 1, 'Ruang Multimedia', '2022-08-16 04:00 PM', '', '', '', '2022-08-13 17:00:00', '2022-08-13 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyatulis`
--

DROP TABLE IF EXISTS `tbl_karyatulis`;
CREATE TABLE IF NOT EXISTS `tbl_karyatulis` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Media` varchar(100) DEFAULT NULL,
  `LocCity` varchar(200) DEFAULT NULL,
  `LocProv` varchar(200) DEFAULT NULL,
  `LocCountry` varchar(200) DEFAULT NULL,
  `Year` varchar(4) DEFAULT NULL,
  `Month` varchar(25) DEFAULT NULL,
  `Mediatype` enum('Lok','Nas','Int') DEFAULT NULL,
  `Diffbenefit` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL DEFAULT '0',
  `nilai_q` int(11) NOT NULL DEFAULT '0',
  `nilai_r` int(11) NOT NULL DEFAULT '0',
  `nilai_w1` int(11) NOT NULL DEFAULT '0',
  `nilai_w2` int(11) NOT NULL DEFAULT '0',
  `nilai_w3` int(11) NOT NULL DEFAULT '0',
  `nilai_w4` int(11) NOT NULL DEFAULT '0',
  `nilai_pil` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.1';

--
-- Dumping data for table `tbl_karyatulis`
--

INSERT INTO `tbl_karyatulis` (`Num`, `user_id`, `Name`, `Media`, `LocCity`, `LocProv`, `LocCountry`, `Year`, `Month`, `Mediatype`, `Diffbenefit`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(2, 4, 'Test Kartul Saja', 'IOP Advanced', 'Depok', NULL, 'Indonesia', '2020', 'Januari', 'Int', 'sed', 'Tentang Jaringan', '', 'W.4.1.3., W.4.4.2., W.4.5.4.', 3, 12, 6, 0, 0, 0, 216, 0, '2022-09-06 22:03:15', '2022-09-05 17:00:00'),
(3, 7, 'Karya Tulis 1', 'Media Nasional', 'Jakarta', NULL, 'Indonesia', '2022', 'Januari', 'Lok', 'ren', 'Tulisan insinyur', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-20 17:00:00', '2022-05-20 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kompetensi`
--

DROP TABLE IF EXISTS `tbl_kompetensi`;
CREATE TABLE IF NOT EXISTS `tbl_kompetensi` (
  `komp_id` int(11) NOT NULL AUTO_INCREMENT,
  `komp_code` varchar(10) NOT NULL,
  `komp_desc` text NOT NULL,
  `komp_cat` varchar(10) NOT NULL,
  `komp_parent` enum('y','n') NOT NULL DEFAULT 'n',
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`komp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=338 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kompetensi`
--

INSERT INTO `tbl_kompetensi` (`komp_id`, `komp_code`, `komp_desc`, `komp_cat`, `komp_parent`, `date_created`, `date_modified`) VALUES
(1, 'W.1.1', 'Mengembangkan dan mewujudkan tanggungjawab kecendekiaan dan   kepedulian profesi keinsinyuran kepada bangsa, negara dan komunitas internasional', 'W.1.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(2, 'W.1.1.1', 'Menyadari tanggungjawab kecendekiaan Insinyur Profesional bagi memahami dan menjunjung falsafah dan nilai Pancasila sebagai  falsafah dasar masyarakat bangsa Indonesia', 'W.1.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(3, 'W.1.1.2', 'Menghayati dan senantiasa  berusaha mengamalkan nilai dan jiwa Pancasila dalam menjalankan profesi.', 'W.1.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(4, 'W.1.1.3', 'Berpedoman kepada konstitusi dan perundang-undangan yang berlaku di Negara Kesatuan Republik Indonesia dalam menjalankan profesi.', 'W.1.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(5, 'W.1.1.4', 'Menjunjung rasa kesetiakawanan nasional dan rasa kepedulian sosial dan berusaha mendorong kewirausahaan dan kesejahteraan masyarakat menuju cita-cita Bangsa dan Negara', 'W.1.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(6, 'W.1.1.5', 'Mengembangkan wawasan kebangsaan yang kuat dan dengan sadar menumbuhkan  kepercayaan  diri  membangun  kemandirian  nasional dalam profesinya dan dalam mengembangkan kerjasama di komunitas internasional', 'W.1.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(7, 'W.1.2', 'Menghayati serta mematuhi Kode Etik Insinyur Indonesia dan tatalaku profesi yang berlaku', 'W.1.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(8, 'W.1.2.1', 'Menempatkan tanggungjawab pada  kesejahteraan, kesehatan dan keselamatan masyarakat di atas tanggungjawabnya kepada profesi, kepada kepentingan golongan, atau kepada rekan sesama insinyur', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(9, 'W.1.2.2', 'Bertindak dengan menjunjung tinggi kehormatan, martabat dan nilai luhur profesi.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(10, 'W.1.2.3', 'Melakukan pekerjaan, hanya dalam batasan kompetensinya.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(11, 'W.1.2.4', 'Mengembangkan nama baik berdasarkan prestasi dan tidak bersaing secara curang.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(12, 'W.1.2.5', 'Menerapkan kemampuan profesionalnya untuk kepentingan pemberi kerja keinsinyuran secara penuh amanah.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(13, 'W.1.2.6', 'Memberikan keterangan, pendapat atau pernyataan secara obyektif berdasarkan  kebenaran dan dalam cakupan pengetahuannya.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(14, 'W.1.2.7', 'Melakukan pengembangan kemampuan profesional secara berkelanjutan.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(15, 'W.1.2.8', 'Secara aktif membantu dan mendorong rekan kerjanya untuk memajukan pengetahuan dan pengalaman mereka.', 'W.1.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(16, 'W.1.3', 'Memahami, menerapkan, serta mengembangkan wawasan dan kaidah-kaidah kelestarian lingkungan', 'W.1.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(17, 'W.1.3.1', 'Menyadari  bahwa saling ketergantungan dan keaneka-ragaman ekosistem adalah dasar bagi  kelangsungan hidup manusia.', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(18, 'W.1.3.2', 'Menyadari keterbatasan daya dukung lingkungan hidup untuk menyerap perubahan yang dibuat manusia.', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(19, 'W.1.3.3', 'Menggalakkan tindakan  keinsinyuran yang diperlukan untuk memperbaiki, mempertahankan dan memulihkan  lingkungan hidup.', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(20, 'W.1.3.4', 'Menggalakkan  penggunaan  yang  bijaksana  atas  sumber-daya  tak  terbarukan  dengan  memperkecil  atau  mendaur-ulang  limbah  dan mengembangkan sumber-daya alternatif lain sejauh mungkin', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(21, 'W.1.3.5', 'Berusaha  mencapai  tujuan pekerjaan keinsinyurannya dengan penggunaan bahan baku dan enerji secara hemat dan dengan menerapkan kaidah pengelolaan lingkungan berkelanjutan', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(22, 'W.1.3.6', 'Memperhatikan keseluruhan dampak dari  siklus hidup produk dan proyek terhadap lingkungan hidup.', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(23, 'W.1.3.7', 'Memperhitungkan pengaruh yang mungkin muncul dari tindakan keinsinyuran terhadap faktor budaya atau warisan sejarah.', 'W.1.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(24, 'W.1.4', 'Mengemban tanggungjawab profesional atas tindakan dan karyanya.', 'W.1.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(25, 'W.1.4.4', 'Memperhitungkan risiko dan tanggung-gugat (liabilities) profesional, dan sanggup bertanggungjawab untuk itu', 'W.1.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(26, 'W.1.4.5', 'Menerapkan dengan tepat persyaratan kesehatan dan keselamatan kerja (K-3).', 'W.1.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(27, 'W.1.4.6', 'Menyelidiki kebutuhan keselamatan masyarakat dan bertindak untuk memecahkan masalah keselamatan yang mungkin timbul.', 'W.1.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(28, 'W.1.4.7', 'Mengambil tindakan pencegahan yang tepat dalam menangani pekerjaan  yang berbahaya.', 'W.1.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(29, 'W.1.4.8', 'Memperhatikan kaidah-kaidah pencegahan dan penanganan  bencana alam serta pemulihan akibatnya.', 'W.1.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(30, 'W.2.1', 'Melaksanakan pekerjaan yang bersifat kecendekiaan dan beragam', 'W.2.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(31, 'W.2.1.1', 'Menggunakan gagasannya sendiri dalam mensintesakan pemecahan yang memuaskan atas masalah keinsinyuran.', 'W.2.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(32, 'W.2.1.2', 'Menggunakan kearifan yang profesional dalam membuat keputusan keinsinyuran.', 'W.2.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(33, 'W.2.1.3', 'Melakukan pekerjaan keinsinyuran secara kreatif dan inovatif.', 'W.2.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(34, 'W.2.1.4', 'Mengenali dan menanggulangi masalah keinsinyuran.', 'W.2.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(35, 'W.2.1.5', 'Memperluas pengetahuan dalam kejuruan  atau bidang keahlian yang terkait dan memupuk kerjasama antar kejuruan  pada  waktu  bekerja dalam lingkungan aneka-kejuruan', 'W.2.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(36, 'W.2.1.6', 'Menyelidiki kebutuhan dan memanfaatkan peluang yang khas terdapat dalam sesuatu bidang pekerjaan atau bidang kejuruan.', 'W.2.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(37, 'W.2.2', 'Menguasai, memelihara, mengembangkan dan memutakhir-kan keahlian dalam bidang  pekerjaan  dan kejuruannya', 'W.2.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(38, 'W.2.2.1', 'Menyadari keterbatasan kepakaran dan pengetahuan dirinya dan menggunakan seluruh kemampuan untuk mengenali kekurangan diri, menambah pengetahuan dan mengupayakan  bantuan dari pakar yang tepat', 'W.2.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(39, 'W.2.2.2', 'Menggunakan kemampuan untuk mencari informasi sehingga dapat mengikuti perkembangan teknologi atau kemajuan lainnya.', 'W.2.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(40, 'W.2.2.3', 'Memperluas dasar pengetahuan dengan membaca majalah profesional, mengikuti seminar profesional dan menjalin kerjasama antar profesional.', 'W.2.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(41, 'W.2.2.4', 'Memperdalam dasar pengetahuan secara sistematik dengan melakukan penelitian dan percobaan untuk menyelesaikan masalah keinsinyuran yang khas.', 'W.2.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(42, 'W.2.2.5', 'Memanfaatkan setiap pengalaman pekerjaan untuk mengembangkan keprofesionalannya.', 'W.2.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(43, 'W.2.2.6', 'Melakukan pencatatan mengenai kegiatan pengembangan keprofesionalannya.', 'W.2.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(44, 'W.2.3.', ' Memahami dan menerapkan metoda-metoda perekayasaan', 'W.2.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(45, 'W.2.3.1.', 'Menemu-kenali (mengidentifikasi) berbagai penerapan kerekayasaan tepat-guna.', 'W.2.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(46, 'W.2.3.2.', 'Mengajukan konsep untuk melaksanakan  penerapan kerekayasaan tepat-guna yang telah terpilih.', 'W.2.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(47, 'W.2.3.3.', 'Merinci penerapan kerekayasaan tepat-guna yang dipilih.', 'W.2.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(48, 'W.2.3.4.', 'Mengendalikan kemutakhiran dokumentasi hasil-hasil penerapannya.', 'W.2.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(49, 'W.2.3.5.', 'Mengkaji persyaratan bagi diperolehnya persetujuan pemberi tugas dan bagi  pemenuhan kebutuhan di masa depan.', 'W.2.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(50, 'W.2.4.', ' Memahami dan menerapkan kaidah-kaidah penjaminan mutu', 'W.2.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(51, 'W.2.4.1.', 'Menerapkan sistem mutu.', 'W.2.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(52, 'W.2.4.2.', 'Mendorong diterimanya  kaidah-kaidah penjaminan mutu oleh rekan sekerja dan anak-buah.', 'W.2.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(53, 'W.2.4.3.', 'Melaksanakan setiap pekerjaan sesuai dengan bakuan mutu yang tepat.', 'W.2.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(54, 'W.2.4.4.', 'Menerapkan tatacara kendali mutu dan penjaminan mutu.', 'W.2.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(55, 'W.2.5.', 'Memilih dan menerapkan penggunaan perangkat perekayasaan dan teknologi yang tepat-guna', 'W.2.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(56, 'W.2.5.1.', 'Memilih dan menggunakan analisis matematik, ilmu keinsinyuran, simulasi komputer atau teknik pemodelan lainnya.', 'W.2.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(57, 'W.2.5.2.', 'Memilih dan memanfaatkan penerapan  sistem komputer.', 'W.2.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(58, 'W.2.5.3.', 'Mengarahkan dan melaksanakan tugas-tugas pemrograman dan penggunaan perangkat lunak.', 'W.2.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(59, 'W.2.5.4.', 'Memilih dan menggunakan alat bantu teknologi dan memantau kinerjanya.', 'W.2.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(60, 'W.2.6.', ' Melaksanakan uji-coba, pengukuran dan kaji-nilai (evaluasi)', 'W.2.6', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(61, 'W.2.6.1.', 'Merumuskan tujuan uji-coba.', 'W.2.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(62, 'W.2.6.2.', 'Menyusun tatacara dan jadwal uji-coba.', 'W.2.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(63, 'W.2.6.3.', 'Mengembangkan tatacara dan alat-alat pengukuran.', 'W.2.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(64, 'W.2.6.4.', 'Melaksanakan uji-coba  dan pengukuran untuk kerja keinsinyuran yang kritis.', 'W.2.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(65, 'W.2.6.5.', 'Mengawasi uji-coba  dan pengukuran untuk kerja yang tidak kritis.', 'W.2.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(66, 'W.2.6.6.', 'Mengkaji-nilai hasil uji-coba  dan pengukuran.', 'W.2.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(67, 'W.3.1.', ' Menjelaskan dan merumuskan kebutuhan perencanaan dan/atau perancangan', 'W.3.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(68, 'W.3.1.1.', 'Merundingkan spesifikasi awal atau pedoman rancangan (design brief) ditinjau dari keinginan pemberi tugas maupun keterbatasan kerekayasaan.', 'W.3.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(69, 'W.3.1.2.', 'Melakukan analisis atas kebutuhan rancangan  fungsional.', 'W.3.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(70, 'W.3.1.3.', 'Memenuhi parameter perancangan seperti kinerja, keandalan, kemudahan pemeliharaan dan ergonomik.', 'W.3.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(71, 'W.3.1.4.', 'Menentukan dampak atas rancangan yang di akibatkan oleh faktor-faktor produksi, konstruksi, pemasangan, uji-pakai, implikasi siklus hidup, dukungan logistik dan ketrampilan pemakai', 'W.3.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(72, 'W.3.1.5.', 'Menentukan kendala yang mungkin ada, seperti tanggungjawab perdata atas produk, pengaruh lingkup fisik atas bagian yang dirancang, atau pengaruh bagian tersebut terhadap lingkungan, dan kemudian mengambil langkah tindak-lanjut yang tepat', 'W.3.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(73, 'W.3.1.6.', 'Menggunakan bakuan dan spesifikasi perancangan keinsinyuran dan menyusun spesifikasi ke-fungsi-an untuk rancangannya.', 'W.3.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(74, 'W.3.2.', 'Membuat usulan  untuk memenuhi kebutuhan perencanaan dan /atau perancangan', 'W.3.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(75, 'W.3.2.1.', 'Menggunakan kreatifitas dan inisiatifnya dalam menyelidiki, menganalisis dan menyusun konsep-konsep bagi memenuhi tujuan rancangan.', 'W.3.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(76, 'W.3.2.2.', 'Menganalisis konsep-konsep yang berkemungkinan menjadi rancangan akhir untuk mengkaji dampak faktor-faktor seperti kinerja, keandalan dan kemudahan pemeliharaan', 'W.3.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(77, 'W.3.2.3.', 'Menemu-kenali  masalah yang mungkin timbul dan merundingkan kemungkinan  perubahan atau penyesuaian atas pedoman rancangan.', 'W.3.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(78, 'W.3.2.4.', 'Melakukan analisis biaya-manfaat dan risiko, studi kelayakan dan pembiayaan siklus hidup untuk menghasilkan suatu rancangan yang layak dilaksanakan.', 'W.3.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(79, 'W.3.2.5.', 'Menyiapkan dan merekomendasikan pelaksanaan suatu usulan yang memenuhi persyaratan pemberi tugas atau pelaksana manufaktur.', 'W.3.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(80, 'W.3.3.', 'Melaksanakan pekerjaan perencanaan dan/atau perancangan sesuai usulan yang telah dipilih', 'W.3.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(81, 'W.3.3.1.', 'Melaksanakan atau mengatur pelaksanaan pekerjaan perancangan yang cukup berbobot.', 'W.3.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(82, 'W.3.3.2.', 'Melaksanakan atau mengatur pelaksanaan analisis  untuk memilih komponen dan bahan material sesuai rancangan.', 'W.3.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(83, 'W.3.3.3.', 'Menyiapkan dan memeriksa spesifikasi teknis sesuai rancangan.', 'W.3.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(84, 'W.3.4.', 'Melaksanakan kaji-nilai atas hasil rancangan', 'W.3.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(85, 'W.3.4.1.', 'Memaparkan rancangan secara langsung atau dengan model komputer.', 'W.3.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(86, 'W.3.4.2.', 'Menyiapkan jadwal pengujian rancangan untuk uji kinerja dan lingkup fisik.', 'W.3.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(87, 'W.3.4.3.', 'Mengawasi pengujian rancangan, analisis hasil pengujian dan mengajukan saran perbaikan.', 'W.3.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(88, 'W.3.4.4.', 'Mengkaji dampak rancangan pada kondisi sekeliling.', 'W.3.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(89, 'W.3.4.5.', 'Memaparkan hasil pengkajian dampak rancangan pada pihak-pihak terkait.', 'W.3.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(90, 'W.3.5.', 'Menyiapkan dokumen penunjang', 'W.3.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(91, 'W.3.5.1.', 'Menyiapkan dokumen penunjang rancangan untuk produksi atau konstruksi, pemasangan, operasi, pemeliharaan dan pelatihan.', 'W.3.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(92, 'W.3.5.2.', 'Menyunting dan memeriksa dokumen pendukung.', 'W.3.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(93, 'W.3.6.', 'Menjaga keutuhan tata identifikasi rancangan sepanjang proses pekerjaan', 'W.3.6', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(94, 'W.3.6.1.', 'Menerapkan tata identifikasi rancangan dengan cara-cara dokumentasi dan pencatatan yang tepat.', 'W.3.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(95, 'W.3.6.2.', 'Menetapkan tatacara pengendalian dokumentasi dan catatan dalam melakukan perubahan rancangan.', 'W.3.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(96, 'W.3.6.3.', 'Memastikan bahwa seluruh tata identifikasi rancangan tetap terjaga sebagai uraian yang benar sepanjang proses perancangan dan konstruksi atau manufaktur.', 'W.3.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(97, 'W.3.6.4.', 'Mengawasi pelaksanaan penggambaran-ulang rancangan, sesuai dengan kenyataan dalam pelaksanaan konstruksi (as-built) atau pelaksanaan produksi (as-manufactured)', 'W.3.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(98, 'W.4.1.', 'Menerapkan kaidah-kaidah manajemen atas diri sendiri', 'W.4.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(99, 'W.4.1.1.', 'Melakukan pengembangan diri dalam kemampuan di bidang manajemen, termasuk hukum, ekonomi dan sosial.', 'W.4.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(100, 'W.4.1.2.', 'Menentukan sasaran bagi diri sendiri dalam  mencapai tujuan kerja.', 'W.4.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(101, 'W.4.1.3.', 'Menerapkan pengelolaan waktu dan tatakerja yang efektif.', 'W.4.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(102, 'W.4.1.4.', 'Melakukan pengembangan diri dalam kepemimpinan dan kerjasama kelompok.', 'W.4.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(103, 'W.4.1.5.', 'Melakukan pengembangan diri dalam cara berpikir yang berwawasan luas, analitis dan kreatif.', 'W.4.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(104, 'W.4.2.', 'Memahami dan menerapkan kaidah-kaidah pengelolaan pekerjaan keinsinyuran', 'W.4.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(105, 'W.4.2.1.', 'Melakukan tugas perencanaan dan pemantauan proyek.', 'W.4.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(106, 'W.4.2.2.', 'Mengembangkan uraian  rincian pekerjaan yang terstruktur.', 'W.4.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(107, 'W.4.2.3.', 'Menyiapkan jadwal pekerjaan dan jalur kritisnya.', 'W.4.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(108, 'W.4.2.4.', 'Memantau kemajuan, menyelidiki penyimpangan dari jadwal dan memulai tindakan perbaikan.', 'W.4.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(109, 'W.4.3.', 'Memahami dan menerapkan kaidah-kaidah kepemimpinan dalam pekerjaan keinsinyuran', 'W.4.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(110, 'W.4.3.1.', 'Melakukan penilaian kinerja bawahan.', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(111, 'W.4.3.2.', 'Mematuhi prinsip keadilan dan kebersamaan.', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(112, 'W.4.3.3.', 'Menggalang lingkungan hubungan kerja yang efektif.', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(113, 'W.4.3.4.', 'Mengorganisasikan kelompok-kelompok kerja.', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(114, 'W.4.3.5.', 'Memimpin insinyur muda, teknisi atau tenaga bawahan lainnya.', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(115, 'W.4.3.6.', 'Menghargai ataupun menghukum sesuai dengan kinerja (on-merit)', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(116, 'W.4.3.7.', 'Memantau tugas-tugas untuk menjamin bahwa kegiatan dilaksanakan sesuai rencana dan mengambil tindakan perbaikan yang perlu.', 'W.4.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(117, 'W.4.4.', 'Berkomunikasi dengan efektif', 'W.4.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(118, 'W.4.4.1.', 'Berkomunikasi dengan baik, benar dan lancar untuk menyampaikan pendapat secara  lisan  maupun tertulis dalam bahasa Indonesia.', 'W.4.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(119, 'W.4.4.2.', 'Menyiapkan, menafsirkan dan memaparkan informasi.', 'W.4.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(120, 'W.4.4.3.', 'Berhubungan dengan rekan dan pakar di dalam dan di luar kalangannya.', 'W.4.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(121, 'W.4.4.4.', 'Mengartikan dengan benar instruksi keinsinyuran yang diterima.', 'W.4.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(122, 'W.4.4.5.', 'Memberikan instruksi yang jelas, cermat dan tepat  kepada bawahan dalam suatu bahasa asing yang lazim dipergunakan di bidang keinsinyuran.', 'W.4.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(123, 'W.4.4.6.', 'Memilih media  dan cara  komunikasi yang tepat guna.', 'W.4.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(124, 'W.4.5.', 'Mengelola informasi keinsinyuran', 'W.4.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(125, 'W.4.5.1.', 'Menyiapkan dan menyajikan ceramah (lectures) pada suatu tingkat profesional.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(126, 'W.4.5.2.', 'Menyiapkan tulisan untuk diterbitkan dalam berkala  keinsinyuran.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(127, 'W.4.5.3.', 'Menyampaikan informasi keinsinyuran secara efektif kepada kalangan keinsinyuran dan kalangan lainnya.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(128, 'W.4.5.4.', 'Meneruskan informasi keinsinyuran secara efektif kepada atasan (insinyur maupun bukan).', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(129, 'W.4.5.5.', 'Melakukan perundingan, penyelesaian sengketa, pembinaan, pertukar-pikiran serta menyatakan pendapat dan sikap.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(130, 'W.4.5.6.', 'Menyiapkan laporan keinsinyuran professional, seperti laporan kemajuan pekerjaan, secara baik dan benar.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(131, 'W.4.5.7.', 'Menyiapkan dokumen seperti spesifikasi, bakuan dan paparan  grafis.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(132, 'W.4.5.8.', 'Menyiapkan dokumen yang lebih kompleks seperti analisis dampak lingkungan atau kontrak kerja.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(133, 'W.4.5.9.', 'Menafsirkan dengan benar gambar teknik serta grafik, spesifikasi, bakuan, peraturan, pedoman praktek dan analisis dampak lingkungan.', 'W.4.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(134, 'P.5.1.', 'Mengembangkan program pendidikan dan/atau pelatihan keinsinyuran', 'P.5.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(135, 'P.5.1.1.', 'Menemu-kenali kebutuhan pengajaran dan atau pelatihan.', 'P.5.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(136, 'P.5.1.2.', 'Merencanakan pengajaran untuk pendidikan tingkat lanjutan atau rencana pelatihan keinsinyuran  untuk suatu lembaga  pelatihan.', 'P.5.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(137, 'P.5.1.3.', 'Mengembangkan program pelatihan kerja praktek.', 'P.5.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(138, 'P.5.1.4.', 'Mengembangkan kurikulum, silabus atau latihan keinsinyuran.', 'P.5.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(139, 'P.5.2.', 'Melaksanakan program pendidikan dan/atau pelatihan keinsinyuran.', 'P.5.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(140, 'P.5.2.1.', 'Mengembangkan proses belajar-mengajar  untuk pendidikan dan pelatihan keinsinyuran.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(141, 'P.5.2.2.', 'Mengembangkan rencana pengembangan pengalaman kerja.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(142, 'P.5.2.3.', 'Mengelola program dalam mana siswa atau peserta latihan memperoleh teori keinsinyuran dan pengalaman praktis.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(143, 'P.5.2.4.', 'Melaksanakan secara efektif kegiatan pengajaran, pengembangan, dan belajar dalam bentuk yang paling tepat untuk sesuatu keadaan.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(144, 'P.5.2.5.', 'Menggunakan secara efektif teknologi pendidikan dan pelatihan untuk mendukung pengajaran, pengembangan dan proses belajar dalam program pendidikan atau pelatihan keinsinyuran.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(145, 'P.5.2.6.', 'Mengembangkan kandungan khas suatu program pelatihan keinsinyuran melalui penelitian, pengkajian, percobaan dan sebagainya.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(146, 'P.5.2.7.', 'Menguji peserta pendidikan dan latihan keinsinyuran secara formatif dan sumatif.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(147, 'P.5.2.8.', 'Menilai kedaya-gunaan program pendidikan dan atau pelatihan keinsinyuran.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(148, 'P.5.2.9.', 'Mengkaji-ulang program pendidikan dan atau pelatihan keinsinyuran.', 'P.5.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(149, 'P.6.1.', 'Melakukan penelitian', 'P.6.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(150, 'P.6.1.1.', 'Mengidentifikasi kebutuhan penelitian.', 'P.6.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(151, 'P.6.1.2.', 'Melakukan kajian pustaka.', 'P.6.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(152, 'P.6.1.3.', 'Melakukan penelitian dasar dan atau terapan.', 'P.6.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(153, 'P.6.1.4.', 'Mencari pengetahuan baru.', 'P.6.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(154, 'P.6.1.5.', 'Menemu-kenali dan menyampaikan hasil penelitian.', 'P.6.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(155, 'P.6.2.', 'Merumuskan konsep pengembangan hasil penelitian', 'P.6.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(156, 'P.6.2.1.', 'Menemu-kenali kebutuhan pengembangan.', 'P.6.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(157, 'P.6.2.2.', 'Memeriksa konsep-konsep yang mempunyai kemungkinan untuk dilaksanakan.', 'P.6.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(158, 'P.6.2.3.', 'Memilih konsep yang akan dikembangkan lebih lanjut.', 'P.6.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(159, 'P.6.3.', 'Menemu-kenali dan mengusahakan sumber daya untuk pengembangan hasil penelitian', 'P.6.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(160, 'P.6.3.1.', 'Merumuskan kebutuhan akhir pemakai.', 'P.6.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(161, 'P.6.3.2.', 'Menyiapkan usulan untuk mencari sumber daya bagi pengembangan.', 'P.6.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(162, 'P.6.3.3.', 'Menyiapkan perkiraan biaya untuk pengembangan, perancangan, produksi atau konstruksi, dan operasi.', 'P.6.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(163, 'P.6.4.', 'Melakukan kaji pasar  untuk produk  hasil penelitian dan pengembangan', 'P.6.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(164, 'P.6.4.1.', 'Merumuskan ciri-ciri  produk yang diinginkan pasar.', 'P.6.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(165, 'P.6.4.2.', 'Mengumpulkan informasi dan membuat rekomendasi untuk menentukan harga produk.', 'P.6.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(166, 'P.6.4.3.', 'Membuat rekomendasi mengenai distribusi produk.', 'P.6.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(167, 'P.6.4.4.', 'Membuat rekomendasi untuk mempromosikan produk.', 'P.6.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(168, 'P.6.5.', 'Mengkomersialkan hasil penelitian dan pengembangan', 'P.6.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(169, 'P.6.5.1.', 'Melakukan kaji-nilai  ekonomis atas produk hasil penelitian dan pengembangan.', 'P.6.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(170, 'P.6.5.2.', 'Memilih mekanisme yang cocok untuk memasarkan produk hasil penelitian dan pengembangan.', 'P.6.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(171, 'P.6.5.3.', 'Menyiapkan model peragaan untuk membuktikan kelayakan teknis dan komersial.', 'P.6.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(172, 'P.6.5.4.', 'Mengembangkan rencana proyek percontohan untuk membuktikan kelayakan teknis dan komersial.', 'P.6.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(173, 'P.7.1.', 'Melaksanakan tugas konsultansi  perekayasaan keinsinyuran', 'P.7.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(174, 'P.7.1.1.', 'Memberikan nasihat/konsultansi kepada pemimpin proyek.', 'P.7.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(175, 'P.7.1.2.', 'Menyusun studi kelayakan dan rencana dasar (master plan).', 'P.7.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(176, 'P.7.1.3.', 'Menyiapkan pedoman perancangan (design guidelines) perekayasaan  berdasarkan uraian kebutuhan pemberi tugas.', 'P.7.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(177, 'P.7.1.4.', 'Menyiapkan rancangan pendahuluan, pengembangannya dan rancangan terinci (detailed design) perekayasaan, agar pemilik proyek dapat melakukan pelelangan.', 'P.7.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(178, 'P.7.1.5.', 'Melakukan tugas pemantauan kemajuan proyek, menyelidiki penyimpangan dari jadwal dan memulai tindakan perbaikan  yang perlu.', 'P.7.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(179, 'P.7.1.6.', 'Mengembangkan uraian  rincian pekerjaan yang terstruktur serta menyiapkan jalur kritis (critical path) pada jadwal pelaksanaan proyek.', 'P.7.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(180, 'P.7.2.', 'Menyiapkan, melaksanakan dan memantau pelelangan dan kontrak untuk pekerjaan konstruksi/instalasi', 'P.7.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(181, 'P.7.2.1.', 'Menyiapkan jadwal pelelangan.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(182, 'P.7.2.2.', 'Mengkaji-nilai jadwal pelelangan.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(183, 'P.7.2.3.', 'Menyiapkan pelelangan.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(184, 'P.7.2.4.', 'Mengkaji-nilai penawaran.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(185, 'P.7.2.5.', 'Menyiapkan kontrak.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(186, 'P.7.2.6.', 'Mengusahakan pemenuhan terhadap persyaratan kontrak.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(187, 'P.7.2.7.', 'Memantau kemajuan pekerjaan dan menyelidiki penyimpangan terhadap persyaratan kontrak.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(188, 'P.7.2.8.', 'Memantau kinerja kontraktor dan menyelidiki penyimpangan terhadap persyaratan kontrak.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(189, 'P.7.2.9.', 'Menyelidiki kinerja kontraktor untuk merekomendasi berita-acara pembayaran untuk disetujui.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(190, 'P.7.2.10.', 'Menyiapkan laporan kemajuan pekerjaan untuk pemberi tugas.', 'P.7.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(191, 'P.7.3.', 'Melaksanakan pekerjaan konstruksi/instalasi', 'P.7.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(192, 'P.7.3.1.', 'Menyiapkan spesifikasi dan jadwal pekerjaan  konstruksi/instalasi.', 'P.7.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(193, 'P.7.3.2.', 'Menyusun pentahapan pekerjaan konstruksi/instalasi.', 'P.7.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(194, 'P.7.3.3.', 'Menyusun spesifikasi sarana dan jasa-jasa  yang dibutuhkan untuk pekerjaan konstruksi/instalasi.', 'P.7.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(195, 'P.7.3.4.', 'Mengawasi pekerjaan konstruksi/instalasi.', 'P.7.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(196, 'P.7.3.5.', 'Memastikan bahwa pekerjaan konstruksi/instalasi telah selesai dengan memuaskan untuk di-berita-acara-kan.', 'P.7.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(197, 'P.7.4.', 'Melaksanakan tugas dan kegiatan pengelolaan kerja lapangan', 'P.7.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(198, 'P.7.4.1.', 'Melaksanakan tugas pengelolaan kerja lapangan untuk pekerjaan konstruksi/instalasi.', 'P.7.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(199, 'P.7.4.2.', 'Melakukan tugas pemesanan bahan material, peralatan dan jasa pendukungnya.', 'P.7.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(200, 'P.7.4.3.', 'Mengembangkan tatalaksana kerja.', 'P.7.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(201, 'P.7.4.4.', 'Mengawasi penanganan bahan material di lapangan.', 'P.7.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(202, 'P.7.5.', 'Melaksanakan uji kinerja (commissioning)', 'P.7.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(203, 'P.7.5.1.', 'Melaksanakan tugas pengembangan program penerimaan hasil pekerjaan.', 'P.7.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(204, 'P.7.5.2.', 'Melaksanakan program commissioning dan tugas pengawasannya.', 'P.7.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(205, 'P.7.5.3.', 'Memastikan bahwa pekerjaan commissioning telah selesai dengan memuaskan untuk di-berita-acara-kan.', 'P.7.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(206, 'P.8.1.1.', 'Menganalisis tata-letak pabrik atau sistem dan aliran kerja dan mengambil langkah-langkah untuk mengoptimasikan fleksibilitas dan efisiensi.', 'P.8.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(207, 'P.8.1.2.', 'Menerapkan kaidah-kaidah  perencanaan manajemen.', 'P.8.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(208, 'P.8.1.3.', 'Memantau operasi proses dan mengubahnya di mana perlu  untuk memperbaiki keluaran (output).', 'P.8.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(209, 'P.8.1.4.', 'Menggunakan berbagai cara analisis seperti analisis lintasan kritis, garis keseimbangan dan programa  linier.', 'P.8.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(210, 'P.8.1.5.', 'Mengatur hubungan kerja antara  bagian perencanaan produksi dengan tim perancang produk.', 'P.8.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(211, 'P.8.1.6.', 'Membangun barisan kerja untuk pekerjaan manufaktur.', 'P.8.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(212, 'P.8.1.7.', 'Melakukan tugas analisis biaya terhadap proses manufaktur.', 'P.8.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(213, 'P.8.2.', 'Menjaga dan mengawasi program penjaminan mutu', 'P.8.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(214, 'P.8.2.1.', 'Memantau dan mengatur  kinerja proses produksi/manufaktur.', 'P.8.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(215, 'P.8.2.2.', 'Mencari dan melaksanakan cara-cara baru  untuk perbaikan terus-menerus atas proses manufaktur.', 'P.8.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(216, 'P.8.2.3.', 'Menerapkan kaidah  pengendalian mutu.', 'P.8.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(217, 'P.8.2.4.', 'Memulai langkah perbaikan  untuk menurunkan tingkat kegagalan produk atau kemacetan sistem produksi.', 'P.8.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(218, 'P.8.2.5.', 'Mengembangkan tatalaksana kerja yang khas.', 'P.8.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(219, 'P.8.2.6.', 'Menilai kinerja dan kehandalan pemasok.', 'P.8.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(220, 'P.8.3.', 'Melaksanakan tugas pengoperasian, pengendalian dan optimasi proses', 'P.8.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(221, 'P.8.3.1.', 'Memperhalus dan mengoptimasikan pengendalian operasi dan proses.', 'P.8.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(222, 'P.8.3.2.', 'Melaksanakan tugas operasi dan pengendalian proses.', 'P.8.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(223, 'P.8.3.3.', 'Melaksanakan tugas  analisis nilai kerja.', 'P.8.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(224, 'P.8.3.4.', 'Melaksanakan tugas pemeriksaan dan penyelesaian masalah-masalah  manufaktur atau proses.', 'P.8.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(225, 'P.8.3.5.', 'Mengembangkan dan melaksanakan proses produksi manufaktur yang fleksibel.', 'P.8.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(226, 'P.8.3.6.', 'Mengembangkan dan melaksanakan tatalaksana ergonomi  dan keselamatan pabrik.', 'P.8.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(227, 'P.8.4.', 'Melaksanakan tugas pengelolaan persediaan', 'P.8.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(228, 'P.8.4.1.', 'Mengembangkan tatacara penyediaan dan penanganan  bahan baku.', 'P.8.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(229, 'P.8.4.2.', 'Menyusun spesifikasi, mengadakan/membeli dan mengalokasikan bahan baku.', 'P.8.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(230, 'P.8.4.3.', 'Melakukan program optimasi pemakaian bahan baku.', 'P.8.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(231, 'P.8.5.', 'Mengukur kinerja produksi', 'P.8.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(232, 'P.8.5.1.', 'Mengukur keluaran proses manufaktur dari segi jumlah, mutu dan harga untuk menilai apakah sasaran produksi telah tercapai.', 'P.8.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(233, 'P.8.5.2.', 'Menganalisis produktifitas untuk menentukan di bagian mana dapat dilakukan perbaikan.', 'P.8.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(234, 'P.8.5.3.', 'Menganalisis pemakaian bahan baku dan bahan pakai-habis (consumables) untuk meningkatkan  efisiensi dan memperbaiki pelayanan sarana pendukung.', 'P.8.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(235, 'P.8.5.4.', 'Menganalisis tatacara produksi secara umum untuk meningkatkan  efisiensi.', 'P.8.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(236, 'P.9.1.', 'Merumuskan kebutuhan dan penggunaan  bahan material atau komponen khusus', 'P.9.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(237, 'P.9.1.1.', 'Menemu-kenali ciri-ciri utama suatu kelompok bahan material atau komponen untuk penggunaan tertentu,  dan kemungkinan bahan penggantinya.', 'P.9.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(238, 'P.9.1.2.', 'Mengkaji penggunaan yang tepat bagi  bahan material atau komponen untuk penggunaan tertentu.', 'P.9.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(239, 'P.9.1.3.', 'Membentuk hubungan dengan kejuruan  lain untuk dapat memperoleh bantuan kepakaran.', 'P.9.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(240, 'P.9.1.4.', 'Mempelajari peluang untuk daur  ulang.', 'P.9.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(241, 'P.9.1.5.', 'Mempelajari bahaya terhadap lingkungan atau bahaya lainnya dalam penggunaan atau pembuangan bahan material atau komponen sisa/berlebih.', 'P.9.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(242, 'P.9.2.', 'Menetapkan sumber bahan baku pengadaan bahan material atau komponen', 'P.9.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(243, 'P.9.2.1.', 'Mencari lokasi sumber bahan baku yang sesuai.', 'P.9.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(244, 'P.9.2.2.', 'Memilih bahan atau komponen yang biaya pengadaannya terjangkau.', 'P.9.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(245, 'P.9.3.', 'Mengawasi penyiapan atau pengadaan bahan material  atau komponen', 'P.9.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(246, 'P.9.3.1.', 'Menetapkan tatacara penyiapan bahan material.', 'P.9.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(247, 'P.9.3.2.', 'Menentukan interaksi antara berbagai bahan material atau komponen.', 'P.9.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(248, 'P.9.3.3.', 'Melakukan kegiatan pengendalian proses.', 'P.9.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(249, 'P.9.4.', 'Menilai sifat bahan material atau komponen', 'P.9.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(250, 'P.9.4.1.', 'Menemu-kenali rona lingkungan operasi.', 'P.9.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(251, 'P.9.4.2.', 'Menemu-kenali persyaratan  pengujian bahan material atau komponen.', 'P.9.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(252, 'P.9.4.3.', 'Melakukan atau mengawasi, dan mengkaji-nilai hasil pengujian di lapangan dan di laboratorium.', 'P.9.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(253, 'P.9.4.4.', 'Memberikan pengarahan dalam pemeliharaan dan kalibrasi sarana pengujian.', 'P.9.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(254, 'P.9.4.5.', 'Menyiapkan, menyetujui dan mensahkan laporan pengujian.', 'P.9.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(255, 'P.9.4.6.', 'Merekomendasikan bahan material atau komponen untuk pemakaian-pemakaian yang khas.', 'P.9.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(256, 'P.9.5.', 'Memilih cara pemeliharaan mutu bahan material atau komponen', 'P.9.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(257, 'P.9.5.1.', 'Menemu-kenali penyebab penurunan mutu seperti aus, korosi, kelelahan dan radiasi ultraviolet.', 'P.9.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(258, 'P.9.5.2.', 'Menggunakan teknik-teknik untuk mengurangi penurunan mutu dan mencegah kegagalan dini.', 'P.9.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(259, 'P.9.5.3.', 'Menggunakan teknik-teknik untuk melihat  gejala adanya kemungkinan  kegagalan.', 'P.9.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(260, 'P.9.5.4.', 'Memilih cara perlakuan (treatment) bahan material yang tepat, seperti perlakuan panas, perlakuan permukaan, dsb.', 'P.9.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(261, 'P.10.1.', 'Mengelola sumber-daya keinsinyuran', 'P.10.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(262, 'P.10.1.1.', 'Menetapkan dan melaksanakan tujuan dan prioritas kerja.', 'P.10.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(263, 'P.10.1.2.', 'Merumuskan metoda pendekatan untuk pengelolaan sumber-daya.', 'P.10.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(264, 'P.10.1.3.', 'Melakukan analisis rincian tugas (work breakdown analysis) sehingga tersedia dasar bagi perhitungan kebutuhan  sumber-daya.', 'P.10.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(265, 'P.10.1.4.', 'Membuat perkiraan kebutuhan waktu, biaya, bahan dan sumber-daya lainnya untuk suatu pekerjaan.', 'P.10.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(266, 'P.10.2.', 'Mengelola sumber-daya manusia', 'P.10.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(267, 'P.10.2.1.', 'Mematuhi ketentuan kesehatan dan keselamatan kerja.', 'P.10.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(268, 'P.10.2.2.', 'Menemu-kenali dan menentukan kebutuhan pelatihan bagi tenaga kerja teknis di tempat pekerjaan.', 'P.10.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(269, 'P.10.2.3.', 'Melaksanakan program pengembangan pengalaman kerja untuk bawahan, termasuk pelatihan-ulang, penyesuaian pada teknologi baru dan pengembangan ketrampilan.', 'P.10.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(270, 'P.10.2.4.', 'Mengkaji efektifitas program pelatihan di tempat kerja.', 'P.10.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(271, 'P.10.2.5.', 'Merumuskan kebutuhan pelatihan tenaga kerja non-teknis.', 'P.10.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(272, 'P.10.3.', 'Melaksanakan pengelolaan kewira-usahaan, keuangan, dan hukum/kontraktual', 'P.10.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(273, 'P.10.3.1.', 'Melakukan tugas  kaji-nilai ekonomis atas pekerjaan yang dilaksanakan.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(274, 'P.10.3.2.', 'Memahami dampak hukum dari tiap pekerjaan yang dilaksanakan.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(275, 'P.10.3.3.', 'Memahami, menafsirkan dan menerapkan peraturan yang tepat.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(276, 'P.10.3.4.', 'Menilai kebutuhan pemasaran dan memberikan saran untuk strategi pemasaran.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(277, 'P.10.3.5.', 'Mengerjakan tugas pengelolaan  risiko.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(278, 'P.10.3.6.', 'Memahami kebutuhan kewira-usahaan suatu perusahaan dan bertindak sesuai kebutuhan tersebut dalam hal biaya, waktu dan faktor-faktor lainnya.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(279, 'P.10.3.7.', 'Mengkaji dan menyiapkan rencana usaha.', 'P.10.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(280, 'P.10.4.', 'Mengelola keterangan produk (product knowledge) untuk barang/jasa keinsinyuran', 'P.10.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(281, 'P.10.4.1.', 'Menyiapkan dokumen, brosur, uraian teknis dan  spesifikasi mengenai produk barang/jasa keinsinyuran  untuk keperluan pemasaran.', 'P.10.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(282, 'P.10.4.2.', 'Menyiapkan dokumen, pedoman, buku panduan untuk pemakaian operasi, pemeliharaan,  penyetelan dan perbaikan atas produk barang/jasa oleh konsumen.', 'P.10.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(283, 'P.10.4.3.', 'Melakukan pengamatan atas kebutuhan pasar/pelanggan masa-depan terhadap  penyempurnaan dan menemu-kenali perubahan/pembaharuan yang perlu atas produk barang/jasa.', 'P.10.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(284, 'P.10.4.4.', 'Memantau dan mengikuti kinerja dan keandalan produk barang/peralatan dan jasa yang dipakai pelanggan dan melakukan perbaikan dan penyempurnaan untuk kepuasan pelanggan.', 'P.10.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(285, 'P.10.5.', 'Memahami dan menerapkan kaidah-kaidah pemasaran barang/jasa keinsinyuran', 'P.10.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(286, 'P.10.5.1.', 'Menyiapkan dan melakukan kajian kebutuhan pasar akan barang/jasa keinsinyuran yang hendak dipasarkan.', 'P.10.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(287, 'P.10.5.2.', 'Menyiapkan strategi dan program pentahapan pemasaran untuk menarik minat pasar/pelanggan.', 'P.10.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(288, 'P.10.5.3.', 'Melakukan promosi dan paparan pengenalan produk barang/jasa keinsinyuran untuk meyakinkan pelanggan dan pasar.', 'P.10.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(289, 'P.10.5.4.', 'Menyiapkan usulan penawaran produk barang/jasa keinsinyuran secara mandiri atau bersama tim proposal, meliputi proposal teknis, komersial dan kontraktual.', 'P.10.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(290, 'P.10.5.5.', 'Melaksanakan klasifikasi, negosiasi dan memberikan saran solusi/aplikasi teknis, penjelasan batasan tanggungjawab masing-masing untuk meyakinkan pelanggan sampai terlaksananya transaksi/kontrak penjualan produk barang/jasa', 'P.10.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(291, 'P.10.6.', 'Memahami dan menerapkan kaidah-kaidah pelayanan purna-jual', 'P.10.6', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(292, 'P.10.6.1.', 'Merumuskan dan menjelaskan batas syarat tanggungjawab jaminan kinerja dan perbaikan kerusakan purna-jual (warranty dan guarantee fee).', 'P.10.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(293, 'P.10.6.2.', 'Melaksanakan pelayanan teknis purna-jual dan mengatasi masalah  teknis, sesuai tanggungjawab kontraktual.', 'P.10.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(294, 'P.10.6.3.', 'Melaksanakan pelatihan pengembangan keahlian tenaga pemakai (operator) dan pemeliharaan produk.', 'P.10.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(295, 'P.10.6.4.', 'Memelihara persediaan suku-cadang dan mengelola sumber daya untuk pelaksanaan pelayanan purna jual.', 'P.10.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(296, 'P.10.6.5.', 'Melakukan pemantauan ke pelanggan untuk meningkatkan kehandalan pemakaian produk dan kepuasan pelanggan.', 'P.10.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(297, 'P.11.1.', 'Menyiapkan dan mengembangkan kebijakan umum keinsinyuran untuk mendorong sektor pembangunan', 'P.11.1', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(298, 'P.11.1.1.', 'Menyiapkan dan mengembangkan kebijakan umum melalui pendekatan pengembangan wilayah.', 'P.11.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(299, 'P.11.1.2.', 'Menyiapkan dan mengembangkan kebijakan umum dengan mengacu pada kelestarian lingkungan.', 'P.11.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(300, 'P.11.1.3.', 'Menyiapkan dan mengembangkan kebijakan umum peningkatan kemampuan rancang-bangun dan perekayasaan produk-produk berbasiskan sumber-daya untuk memacu ekspor.', 'P.11.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(301, 'P.11.1.4.', 'Menyusun suatu rancangan teknis yang mendorong peningkatan keterpaduan antar sektor pembangunan.', 'P.11.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(302, 'P.11.1.5.', 'Menyusun perencanaan dan atau program (master plan, perencanaan jangka panjang/pendek, dsb.) untuk mendukung pengembangan daerah, termasuk perkotaan.', 'P.11.1', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(303, 'P.11.2.', 'Menyiapkan dan mengembangkan kebijakan investasi teknis', 'P.11.2', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(304, 'P.11.2.1.', 'Menyiapkan kebijakan teknis yang mendorong peran serta swasta dan masyarakat dalam pembangunan sektor-sektor publik.', 'P.11.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(305, 'P.11.2.2.', 'Mengembangkan sistem manajemen teknis yang efektif dan efisien sehingga diperoleh produk perencanaan yang matang, pelaksanaan yang tepat dan pengawasan yang ketat.', 'P.11.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51');
INSERT INTO `tbl_kompetensi` (`komp_id`, `komp_code`, `komp_desc`, `komp_cat`, `komp_parent`, `date_created`, `date_modified`) VALUES
(306, 'P.11.2.3.', 'Menyiapkan upaya-upaya penajaman prioritas pelaksanaan pembangunan guna memanfaatkan sumber-daya yang terbatas secara optimal.', 'P.11.2', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(307, 'P.11.3.', 'Merumuskan kebijaksanaan dan melaksanakan tugas pengaturan teknis untuk keselamatan dan kesejahteraan masyarakat', 'P.11.3', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(308, 'P.11.3.1.', 'Membuat peraturan/pedoman pembangunan dan penggunaan prasarana dan sarana umum bagi peningkatan jaminan keselamatan dan kesejahteraan masyarakat', 'P.11.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(309, 'P.11.3.2.', 'Mengembangkan rancangan teknologi tepat-guna, yang mempertimbangkan kemudahan dan kesinambungan operasi dan pemeliharaan.', 'P.11.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(310, 'P.11.3.3.', 'Mengembangkan rancangan  teknologi sederhana yang sesuai untuk daerah pedesaan dan mendukung upaya pengentasan kemiskinan serta menciptakan lapangan kerja ketrampilan rendah.', 'P.11.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(311, 'P.11.3.4.', 'Mengembangkan rancangan teknis untuk membuka dan meningkatkan pertumbuhan daerah terpencil, terkucil  dan perbatasan.', 'P.11.3', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(312, 'P.11.4.', 'Melaksanakan tugas pengadaan asset', 'P.11.4', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(313, 'P.11.4.1.', 'Menemu-kenali kebutuhan akan aset baru.', 'P.11.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(314, 'P.11.4.2.', 'Menyiapkan spesifikasi atau uraian untuk usulan pengadaan aset baru.', 'P.11.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(315, 'P.11.4.3.', 'Melaksanakan kegiatan pengadaan aset.', 'P.11.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(316, 'P.11.4.4.', 'Melaksanakan pengujian untuk penerimaan pada saat penyerahan.', 'P.11.4', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(317, 'P.11.5.', 'Melaksanakan tugas pengendalian dan optimasi asset', 'P.11.5', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(318, 'P.11.5.1.', 'Merumuskan parameter kinerja aset.', 'P.11.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(319, 'P.11.5.2.', 'Menyiapkan petunjuk operasi dan melatih operator.', 'P.11.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(320, 'P.11.5.3.', 'Merencanakan dan melakukan tugas pemantauan kondisi aset.', 'P.11.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(321, 'P.11.5.4.', 'Mengawasi pengoperasian sistem-sistem aset.', 'P.11.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(322, 'P.11.5.5.', 'Mengatur pengoperasian aset untuk menjamin pelayanan.', 'P.11.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(323, 'P.11.5.6.', 'Mempelajari kemungkinan memperpanjang umur aset.', 'P.11.5', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(324, 'P.11.6.', 'Melaksanakan atau mengawasi tugas pemeliharaan asset', 'P.11.6', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(325, 'P.11.6.1.', 'Mengembangkan kaidah pemeliharaan dan parameter kinerja aset.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(326, 'P.11.6.2.', 'Menyiapkan jadwal pemeliharaan pencegahan.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(327, 'P.11.6.3.', 'Menyiapkan petunjuk/panduan  untuk pemeliharaan perbaikan.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(328, 'P.11.6.4.', 'Menetapkan, dan atau merancangkan, alat bantu uji pemeliharaan.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(329, 'P.11.6.5.', 'Mengawasi tugas pemeliharaan.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(330, 'P.11.6.6.', 'Menentukan kebutuhan persediaan suku-cadang.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(331, 'P.11.6.7.', 'Melaksanakan pemeriksaan dan atau analisis atas kegagalan serta dampak akibatnya.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(332, 'P.11.6.8.', 'Melaksanakan analisis terhadap  modus kegagalan dan akibatnya.', 'P.11.6', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(333, 'P.11.7.', 'Merencanakan dan melaksanakan penghapusan asset', 'P.11.7', 'y', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(334, 'P.11.7.1.', 'Mempelajari penentuan umur ekonomis aset.', 'P.11.7', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(335, 'P.11.7.2.', 'Menyelidiki penghapusan aset secara ekonomis dan layak lingkungan.', 'P.11.7', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(336, 'P.11.7.3.', 'Merekomendasikan langkah penghapusan aset.', 'P.11.7', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51'),
(337, 'P.11.7.4.', 'Melakukan pemulihan lahan bekas lokasi aset.', 'P.11.7', 'n', '2022-09-04 07:48:51', '2022-09-04 07:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kualifikasi`
--

DROP TABLE IF EXISTS `tbl_kualifikasi`;
CREATE TABLE IF NOT EXISTS `tbl_kualifikasi` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `NameInstance` varchar(100) DEFAULT NULL,
  `Position` varchar(300) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Giver` varchar(100) DEFAULT NULL,
  `LocCity` varchar(200) DEFAULT NULL,
  `LocProv` varchar(200) DEFAULT NULL,
  `LocCountry` varchar(200) DEFAULT NULL,
  `Duration` enum('smp3','smp7','smp10','lbh10') DEFAULT NULL,
  `Jabatan` enum('anggota','supervisor','direktur','pengarah') DEFAULT NULL,
  `ProjValue` varchar(100) DEFAULT NULL,
  `RspnValue` varchar(100) DEFAULT NULL,
  `Hresource` enum('dik','sed','bny','sbny') DEFAULT NULL,
  `Diff` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Scale` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL,
  `nilai_q` int(11) NOT NULL,
  `nilai_r` int(11) NOT NULL,
  `nilai_w1` int(11) NOT NULL,
  `nilai_w2` int(11) NOT NULL,
  `nilai_w3` int(11) NOT NULL,
  `nilai_w4` int(11) NOT NULL,
  `nilai_pil` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian III';

--
-- Dumping data for table `tbl_kualifikasi`
--

INSERT INTO `tbl_kualifikasi` (`Num`, `user_id`, `StartDate`, `EndDate`, `NameInstance`, `Position`, `Name`, `Giver`, `LocCity`, `LocProv`, `LocCountry`, `Duration`, `Jabatan`, `ProjValue`, `RspnValue`, `Hresource`, `Diff`, `Scale`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(1, 7, '2014-08-04', '0000-00-00', 'Fakultas Teknik', 'Penanggung Jawab', 'Pembuatan web silegal', 'KaPuskom FT UI', 'Depok', 'Jawa Barat', 'Indonesia', 'smp3', 'supervisor', '10000000', '30', 'dik', 'sed', 'sed', 'Membuat website silegal.eng.ui.ac.id', '7_pengkerja_FakultasTeknik_PenanggungJawab.jpg', '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(2, 4, '2022-07-01', '0000-00-00', 'Fakultas Teknik', 'Programmer', 'Proyek WebPPI', 'Prodi PPI', 'Depok', 'Jawa Barat', 'Indonesia', 'smp3', 'supervisor', 'Rp. 0.51', 'Programmer', 'dik', 'ren', 'ren', 'Membuat website', '4_pengkerja_fakultasteknik_programmer.pdf', 'W.2.1.1, W.2.5.4., W.3.4.3., W.4.2.2., W.4.4.3., P.6.1.1., P.7.1.2., P.7.4.1.', 8, 32, 0, 0, 256, 256, 256, 256, '2022-09-06 19:08:46', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_makalahseminar`
--

DROP TABLE IF EXISTS `tbl_makalahseminar`;
CREATE TABLE IF NOT EXISTS `tbl_makalahseminar` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Type` enum('Mak','Sem') DEFAULT NULL,
  `PaperName` varchar(100) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Organizer` varchar(100) DEFAULT NULL,
  `LocCity` varchar(200) DEFAULT NULL,
  `LocProv` varchar(200) DEFAULT NULL,
  `LocCountry` varchar(200) DEFAULT NULL,
  `Year` varchar(4) DEFAULT NULL,
  `Month` varchar(25) DEFAULT NULL,
  `Level` enum('Lok','Nas','Int') DEFAULT NULL,
  `DiffBenefit` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL DEFAULT '0',
  `nilai_q` int(11) NOT NULL DEFAULT '0',
  `nilai_r` int(11) NOT NULL DEFAULT '0',
  `nilai_w1` int(11) NOT NULL DEFAULT '0',
  `nilai_w2` int(11) NOT NULL DEFAULT '0',
  `nilai_w3` int(11) NOT NULL DEFAULT '0',
  `nilai_w4` int(11) NOT NULL DEFAULT '0',
  `nilai_pil` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.2 dan V.3';

--
-- Dumping data for table `tbl_makalahseminar`
--

INSERT INTO `tbl_makalahseminar` (`Num`, `user_id`, `Type`, `PaperName`, `Name`, `Organizer`, `LocCity`, `LocProv`, `LocCountry`, `Year`, `Month`, `Level`, `DiffBenefit`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(2, 4, 'Sem', 'Judul Test', 'Seminar Latihan', 'Latihan', 'Depok', NULL, 'Indonesia', '2022', 'Mei', 'Nas', 'sed', 'Seminar Jaringan', '', 'W.2.1.3, W.2.2.6, W.2.3.2., W.2.5.3., W.2.6.1.', 5, 15, 10, 0, 750, 0, 0, 0, '2022-09-06 22:35:52', '2022-09-05 17:00:00'),
(3, 4, 'Mak', 'test', 'test', 'test', 'Depok', NULL, 'Indonesia', '2014', 'Januari', 'Nas', 'sed', 'Test', '', 'W.4.1.1., W.4.5.2., W.4.5.7.', 3, 6, 6, 0, 0, 0, 108, 0, '2022-09-05 17:00:00', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organisasi`
--

DROP TABLE IF EXISTS `tbl_organisasi`;
CREATE TABLE IF NOT EXISTS `tbl_organisasi` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Type` enum('PII','Ins','Non') DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Period` enum('sd5','smp10','smp15','lbih15') DEFAULT NULL,
  `StartPeriodBulan` varchar(20) DEFAULT NULL,
  `StartPeriodYear` year(4) DEFAULT NULL,
  `EndPeriodBulan` varchar(20) DEFAULT NULL,
  `EndPeriodYear` year(4) DEFAULT NULL,
  `Position` enum('Bias','Peng','Pimp') DEFAULT NULL,
  `OrgLevel` enum('Lok','Nas','Reg','Int') DEFAULT NULL,
  `OrgScp` enum('Aso','Pem','Pen','Neg','Swa','Mas','Lai') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL DEFAULT '0',
  `nilai_q` int(11) NOT NULL DEFAULT '0',
  `nilai_r` int(11) NOT NULL DEFAULT '0',
  `nilai_w1` int(10) NOT NULL DEFAULT '0',
  `nilai_w2` int(11) NOT NULL DEFAULT '0',
  `nilai_w3` int(11) NOT NULL DEFAULT '0',
  `nilai_w4` int(11) NOT NULL DEFAULT '0',
  `nilai_pil` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.3';

--
-- Dumping data for table `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`Num`, `user_id`, `Name`, `Type`, `City`, `Country`, `Period`, `StartPeriodBulan`, `StartPeriodYear`, `EndPeriodBulan`, `EndPeriodYear`, `Position`, `OrgLevel`, `OrgScp`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(2, 4, 'Organisasi Saja', 'Non', 'Depok', 'Indonesia', 'smp15', 'Maret', 2018, 'Maret', 2023, 'Peng', 'Reg', 'Mas', 'Membantu Pengurus', '4_organisasi_OrganisasiSaja_Peng.pdf', '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-07 22:47:47', '2022-05-06 17:00:00'),
(3, 7, 'KMHDI', 'Non', 'Jakarta', 'Indonesia', 'sd5', 'Januari', 2014, 'Januari', 2018, 'Pimp', 'Nas', 'Mas', 'Organisasi kemahasiswaan saja', NULL, '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-22 03:57:50', '2022-05-20 17:00:00'),
(4, 4, 'test', 'Ins', 'test', 'test', 'smp10', 'Januari', 2013, 'Januari', 2022, 'Peng', 'Nas', 'Aso', 'test saja', '4_organisasi_test_peng.pdf', 'W.1.1.2, W.1.1.3, W.1.1.5', 6, 9, 6, 100, 0, 0, 0, 0, '2022-09-05 17:00:00', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelatihan`
--

DROP TABLE IF EXISTS `tbl_pelatihan`;
CREATE TABLE IF NOT EXISTS `tbl_pelatihan` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `Penyelenggara` varchar(100) DEFAULT NULL,
  `Kota` varchar(100) DEFAULT NULL,
  `Provinsi` varchar(100) DEFAULT NULL,
  `Negara` varchar(100) DEFAULT NULL,
  `StartBulan` varchar(20) DEFAULT NULL,
  `StartTahun` year(4) DEFAULT NULL,
  `EndBulan` varchar(20) DEFAULT NULL,
  `EndTahun` year(4) DEFAULT NULL,
  `TingkatPelatihan` enum('Dasar','Lanjut') DEFAULT NULL,
  `JamPelatihan` enum('36jam','100jam','240jam','lbh240jam') DEFAULT NULL,
  `Desc` tinytext,
  `File` varchar(500) NOT NULL,
  `kompetensi` text NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Num`),
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendapat`
--

DROP TABLE IF EXISTS `tbl_pendapat`;
CREATE TABLE IF NOT EXISTS `tbl_pendapat` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Desc` text,
  `kompetensi` text NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian II.2';

--
-- Dumping data for table `tbl_pendapat`
--

INSERT INTO `tbl_pendapat` (`Num`, `user_id`, `Desc`, `kompetensi`, `date_created`, `date_modified`) VALUES
(1, 4, 'Yah begitulah pengertiannya saja.', '', '2022-08-11 15:11:38', '2022-08-10 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendidikan`
--

DROP TABLE IF EXISTS `tbl_pendidikan`;
CREATE TABLE IF NOT EXISTS `tbl_pendidikan` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Rank` enum('D3','D4','S1','S2','S3','Ir.') DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Faculty` varchar(100) DEFAULT NULL,
  `Major` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Province` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `GradYear` year(4) DEFAULT NULL,
  `Degree` varchar(200) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Desc` text,
  `Mark` varchar(10) DEFAULT NULL,
  `Judicium` varchar(100) DEFAULT NULL,
  `File` varchar(300) DEFAULT NULL,
  `kompetensi` text NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.2';

--
-- Dumping data for table `tbl_pendidikan`
--

INSERT INTO `tbl_pendidikan` (`Num`, `user_id`, `Rank`, `Name`, `Faculty`, `Major`, `City`, `Province`, `Country`, `GradYear`, `Degree`, `Title`, `Desc`, `Mark`, `Judicium`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'S1', 'Universitas Indonesia', 'Fakultas Teknik', 'Teknik Elektro', 'Depok', NULL, 'Indonesia', 2005, 'Sarjana Teknik', 'Judul Tugas Akhir', 'Uraian Singkat', '2,89', 'Yudisium', '4_ijazah_S1.pdf', '', '2022-05-03 17:00:00', '2022-05-04 17:00:00'),
(3, 7, 'S3', 'Chonnam National University', 'School of Electrical and Computer Engineering', 'Computer Engineering', 'Gwangju', NULL, 'Korea Selatan', 2020, 'Ph.D', 'Lambda Architecture', 'Membuat arsitektur lambda untuk pengolahan data', '3.89', 'Gwangju', '7_ijazah_S3.jpg', '', '2022-05-20 17:00:00', '2022-05-20 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengalaman`
--

DROP TABLE IF EXISTS `tbl_pengalaman`;
CREATE TABLE IF NOT EXISTS `tbl_pengalaman` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Institution` varchar(100) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `LocCity` varchar(200) DEFAULT NULL,
  `LocProv` varchar(200) DEFAULT NULL,
  `LocCountry` varchar(200) DEFAULT NULL,
  `Period` enum('smp9','smp14','smp19','lbih20') DEFAULT NULL,
  `StartPeriod` year(4) DEFAULT NULL,
  `EndPeriod` year(4) DEFAULT NULL,
  `Position` enum('Stf','Pim') DEFAULT NULL,
  `Skshour` enum('sks1','sks2','sks4') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL,
  `nilai_q` int(11) NOT NULL,
  `nilai_r` int(11) NOT NULL,
  `nilai_w1` int(11) NOT NULL,
  `nilai_w2` int(11) NOT NULL,
  `nilai_w3` int(11) NOT NULL,
  `nilai_w4` int(11) NOT NULL,
  `nilai_pil` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian IV';

--
-- Dumping data for table `tbl_pengalaman`
--

INSERT INTO `tbl_pengalaman` (`Num`, `user_id`, `Institution`, `Name`, `LocCity`, `LocProv`, `LocCountry`, `Period`, `StartPeriod`, `EndPeriod`, `Position`, `Skshour`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(2, 4, 'Universitas Indonesia', 'Database', 'Depok', 'Jawa Barat', 'Indonesia', 'smp9', 2020, 2022, 'Stf', 'sks4', 'Mengajar Database', NULL, 'W.2.1.2, W.2.1.6, W.2.2.5, W.2.5.3., W.2.6.1., W.3.2.1., W.4.3.2., P.5.2.4.', 8, 16, 24, 0, 3072, 3072, 3072, 3072, '2022-09-06 19:44:11', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penghargaan`
--

DROP TABLE IF EXISTS `tbl_penghargaan`;
CREATE TABLE IF NOT EXISTS `tbl_penghargaan` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Institute` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Prov` varchar(200) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Bulan` varchar(20) DEFAULT NULL,
  `Tahun` varchar(20) DEFAULT NULL,
  `Level` enum('Mud','Mad','Uta') DEFAULT NULL,
  `InstituteType` enum('Lok','Nas','Reg','Int') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL DEFAULT '0',
  `nilai_q` int(11) NOT NULL DEFAULT '0',
  `nilai_r` int(11) NOT NULL DEFAULT '0',
  `nilai_w1` int(11) NOT NULL DEFAULT '0',
  `nilai_w2` int(11) NOT NULL DEFAULT '0',
  `nilai_w3` int(11) NOT NULL DEFAULT '0',
  `nilai_w4` int(11) NOT NULL DEFAULT '0',
  `nilai_pil` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.4';

--
-- Dumping data for table `tbl_penghargaan`
--

INSERT INTO `tbl_penghargaan` (`Num`, `user_id`, `Year`, `Month`, `Name`, `Institute`, `City`, `Prov`, `Country`, `Bulan`, `Tahun`, `Level`, `InstituteType`, `Desc`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(1, 4, 2022, 1, 'Penghargaan utama', 'FT UI', 'Depok', 'Jawa Barat', 'Indonesia', NULL, NULL, 'Uta', 'Nas', 'Test', '', 'W.1.1.1, W.1.1.3, W.1.2.1, W.1.2.2', 4, 16, 8, 128, 0, 0, 0, 0, '2022-09-05 17:00:00', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penguji`
--

DROP TABLE IF EXISTS `tbl_penguji`;
CREATE TABLE IF NOT EXISTS `tbl_penguji` (
  `uji_id` int(5) NOT NULL AUTO_INCREMENT,
  `ta_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `penguji` int(5) NOT NULL,
  `status_bimbing` enum('ya','tidak') NOT NULL,
  `penguji_urut` varchar(25) NOT NULL,
  `nilai_kualitas` int(5) NOT NULL,
  `nilai_presentasi` int(5) NOT NULL,
  `nilai_materi` int(5) NOT NULL,
  `nilai_dasar` int(5) NOT NULL,
  `ttd` blob NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uji_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

DROP TABLE IF EXISTS `tbl_profile`;
CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `FullName` varchar(300) NOT NULL,
  `BirthPlace` varchar(100) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `KTA` varchar(50) DEFAULT NULL,
  `SIP` varchar(300) DEFAULT NULL,
  `Vocational` enum('Ars','Ele','Fis','BumE','Wil','Ind','Kim','Mes','Lin','Min','Tam','Sip','Mat','Hut','Met','Tan','Ter','IndT','Inf','Dir','Lau','Nuk','Kap','Ikn','TekT','Tra','KerA','Kom','Bio') DEFAULT NULL,
  `HAddr` varchar(200) DEFAULT NULL,
  `HCity` varchar(100) DEFAULT NULL,
  `HPostnum` varchar(20) DEFAULT NULL,
  `Work` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `WAddr` varchar(200) DEFAULT NULL,
  `WCity` varchar(100) DEFAULT NULL,
  `Wpostnum` varchar(20) DEFAULT NULL,
  `Hnum` varchar(20) DEFAULT NULL,
  `Hfaks` varchar(20) DEFAULT NULL,
  `Htelex` varchar(20) DEFAULT NULL,
  `Hemail` varchar(100) DEFAULT NULL,
  `Hpnum` varchar(20) DEFAULT NULL,
  `Wnum` varchar(20) DEFAULT NULL,
  `Wfaks` varchar(20) DEFAULT NULL,
  `Wtelex` varchar(20) DEFAULT NULL,
  `Wemail1` varchar(100) DEFAULT NULL,
  `Wemail2` varchar(100) DEFAULT NULL,
  `Photo` text,
  `pindahregular` enum('Ya','Tidak') NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.1';

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`ID`, `user_id`, `FullName`, `BirthPlace`, `Birthdate`, `KTA`, `SIP`, `Vocational`, `HAddr`, `HCity`, `HPostnum`, `Work`, `Position`, `WAddr`, `WCity`, `Wpostnum`, `Hnum`, `Hfaks`, `Htelex`, `Hemail`, `Hpnum`, `Wnum`, `Wfaks`, `Wtelex`, `Wemail1`, `Wemail2`, `Photo`, `pindahregular`, `date_created`, `date_modified`) VALUES
(5, 4, 'I Gde Dharma Nugraha', 'Depok', '1989-01-04', '', '', 'Inf', 'Bella Casa Residence Blok A12 No 9 Jl. Tole Iskandar', 'Depok', '16431', 'Fakultas Teknik', 'Pengajar', 'Kampus UI', 'Depok', '16431', '', '', '', 'gdebig@gmail.com', '081558805505', '02177834328', '', '', 'i.gde@ui.ac.id', '', '4_profilpic.', 'Ya', '2022-05-05 16:47:01', '2022-05-04 17:00:00'),
(6, 7, 'I Gde Dharma Nugraha', 'Depok', '1982-10-07', '', '7_sip.pdf', 'Ind', 'Bella Casa Residence Blok A12 no 9\r\nCluster Alamanda Jl. Tole Iskandar', 'Depok', '16431', 'Fakultas Teknik', 'Pengajar', 'Kampus UI Depok', 'Depok', '16424', '081558805505', '', '', 'gdebig@gmail.com', '081558805505', '02177834328', '', '', 'i.gde@ui.ac.id', 'i.gde@ui.ac.id', '7_profilpic.jpg', 'Ya', '2022-05-22 03:36:46', '2022-05-20 17:00:00'),
(7, 1, 'Super Administrator', 'Depok', '2022-01-01', '', NULL, 'Ele', 'Kampus UI Depok', 'Depok', '16424', 'Fakultas Teknik', 'Administrator', 'Kampus UI', 'Depok', '16424', '', '', '', 'i.gde@ui.ac.id', '081558805505', '02177834328', '', '', 'i.gde@ui.ac.id', '', '1_profilpic.jpg', 'Ya', '2022-05-25 17:00:00', '2022-05-25 17:00:00'),
(8, 12, 'Budi Atmajaya', 'Depok', '1979-07-04', '', '', 'Kom', 'Jakarta Barat', 'Jakarta Barat', '123542', 'Jalanan', 'Freelance', 'Jakarta Barat', 'Jakarta Barat', '19283', '', '', '', 'test@saja.com', '081523657486', '02156986456', '', '', 'test@saja.com', '', '12_profilpic.png', 'Ya', '2022-07-24 17:00:00', '2022-07-24 17:00:00'),
(9, 9, 'Dosen Pembimbing', 'Jakarta', '1986-07-11', '', NULL, 'Kom', 'Apa saja', 'Depok', '1293', 'UI', 'Dosen', 'Kampus UI Depok', 'Depok', '12034', '', '', '', 'test@saja.com', '08152264532', '0215984365', '', '', 'kantor@ui.ac.id', '', '9_profilpic.JPG', 'Ya', '2022-07-24 17:00:00', '2022-07-24 17:00:00'),
(10, 10, 'Test Saja', 'Jakarta', '2004-07-08', '', NULL, 'Lin', 'Depok', 'Depok', '12393', 'Jalanan', 'Freelance', 'Jalanan', 'Depok', '12393', '', '', '', 'test@coba.saj', '123452', '019283932', '', '', 'test@saja.com', '', '10_profilpic.JPG', 'Ya', '2022-07-24 17:00:00', '2022-07-24 17:00:00'),
(11, 13, 'test peserta', 'Bengkulu', '1962-07-06', '', NULL, 'Kom', 'Jakarta', 'Jakarta', '12039', 'Jalanan', 'Freelance', 'adsfasdfa', 'asdfsa', '123453', '', '', '', 'test@saja.com', '1239845', '12334346', '', '', 'test@saja.com', '', '13_profilpic.jpg', 'Ya', '2022-07-24 17:00:00', '2022-07-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sertifikat`
--

DROP TABLE IF EXISTS `tbl_sertifikat`;
CREATE TABLE IF NOT EXISTS `tbl_sertifikat` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `Jenis` enum('pelatihan','sertifikat') NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Organizer` varchar(100) NOT NULL,
  `Kota` varchar(200) NOT NULL,
  `Prov` varchar(200) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `StartYear` varchar(4) NOT NULL,
  `StartMonth` varchar(25) NOT NULL,
  `EndYear` varchar(4) NOT NULL,
  `EndMonth` varchar(25) NOT NULL,
  `Level` enum('Dasar','Lanjut') NOT NULL,
  `Length` enum('sd36','smp100','smp240','lbh240') NOT NULL,
  `Description` text NOT NULL,
  `File` text NOT NULL,
  `kompetensi` text NOT NULL,
  `nilai_p` int(11) NOT NULL,
  `nilai_q` int(11) NOT NULL,
  `nilai_r` int(11) NOT NULL,
  `nilai_w1` int(11) NOT NULL,
  `nilai_w2` int(11) NOT NULL,
  `nilai_w3` int(11) NOT NULL,
  `nilai_w4` int(11) NOT NULL,
  `nilai_pil` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Num`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sertifikat`
--

INSERT INTO `tbl_sertifikat` (`Num`, `user_id`, `Jenis`, `Name`, `Organizer`, `Kota`, `Prov`, `Country`, `StartYear`, `StartMonth`, `EndYear`, `EndMonth`, `Level`, `Length`, `Description`, `File`, `kompetensi`, `nilai_p`, `nilai_q`, `nilai_r`, `nilai_w1`, `nilai_w2`, `nilai_w3`, `nilai_w4`, `nilai_pil`, `date_created`, `date_modified`) VALUES
(3, 4, 'sertifikat', 'Sertifikat apalah', 'Huawei', 'Depok', '', 'Indonesia', '2022', 'April', '', '', 'Dasar', 'sd36', 'Training Sederhana', '', 'W.1.1.1, W.1.2.1, W.4.1.4., W.4.2.2.', 4, 8, 8, 32, 0, 0, 32, 0, '2022-05-08 03:10:20', '2022-09-05 17:00:00'),
(4, 7, 'pelatihan', 'Pelatihan Cisco', 'Cisco', 'Depok', '', 'Indonesia', '2020', 'Januari', '', '', 'Dasar', 'sd36', 'Pelatihan jaringan', '7_pelatihan_PelatihanCisco.pdf', '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(5, 7, 'pelatihan', 'Sertifikat CEH', 'ECCouncil', 'Depok', '', 'Indonesia', '2021', 'September', '', '', 'Dasar', 'sd36', 'Pelatihan keamanan security', '7_pelatihan_SertifikatCEH.jpeg', '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(6, 7, 'sertifikat', 'Sertifikat CEH', 'ECCouncil', 'Depok', '', 'Indonesia', '2021', 'Agustus', '', '', 'Dasar', 'sd36', 'Sertifikat Keamanan Jaringan', '7_sertifikat_SertifikatCEH.jpg', '', 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(7, 4, 'pelatihan', 'test saja', 'West Java', 'Depok', '', 'Indonesia', '2022', 'Januari', '', '', 'Dasar', 'sd36', 'Test Safa', '4_pelatihan_testsaja.pdf', 'W.2.1.1, W.2.1.3, W.2.1.6, P.10.3.2.', 4, 8, 8, 0, 32, 0, 32, 32, '2022-09-03 17:00:00', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tugasakhir`
--

DROP TABLE IF EXISTS `tbl_tugasakhir`;
CREATE TABLE IF NOT EXISTS `tbl_tugasakhir` (
  `ta_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `ta_usuljudul` text NOT NULL,
  `ta_semester` enum('Ganjil','Genap') NOT NULL,
  `ta_tahun` year(4) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `instansi` varchar(500) NOT NULL,
  `divisi` varchar(500) NOT NULL,
  `ta_buku` varchar(500) NOT NULL,
  `ta_log` varchar(500) NOT NULL,
  `ta_bimbing` int(5) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tugasakhir`
--

INSERT INTO `tbl_tugasakhir` (`ta_id`, `user_id`, `ta_usuljudul`, `ta_semester`, `ta_tahun`, `startdate`, `enddate`, `instansi`, `divisi`, `ta_buku`, `ta_log`, `ta_bimbing`, `date_created`, `date_modified`) VALUES
(3, 12, 'Tugas Akhir Lama', 'Ganjil', 2022, NULL, NULL, '', '', '12_bukuta.pdf', '12_logta.pdf', 0, '2022-08-14 04:38:43', '2022-08-14 04:38:43'),
(4, 4, 'Test tugas akhir', 'Ganjil', 2022, '2021-08-16', '2021-11-15', 'PT. PLN', 'Unit Jawabali', '4_bukuta.pdf', '4_logta.pdf', 0, '2022-08-14 02:30:00', '2022-08-14 13:55:32'),
(5, 10, 'Test saja', 'Ganjil', 2022, NULL, NULL, '', '', '10_bukuta.pdf', '10_logta.pdf', 0, '2022-08-14 04:30:58', '2022-08-14 04:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` enum('yes','no') NOT NULL,
  `nodaftar` varchar(50) NOT NULL,
  `NPM` varchar(100) DEFAULT NULL,
  `NIP` varchar(100) DEFAULT NULL,
  `status` enum('baru','diterima','ditolak','lulus','keluar','staff','regular') NOT NULL,
  `thnajaran` varchar(5) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `tipe_user` varchar(4) NOT NULL,
  `confirmcapes` enum('Ya','Tidak') NOT NULL,
  `confirmfair` enum('Ya','Tidak') NOT NULL,
  `softdelete` varchar(3) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `active`, `nodaftar`, `NPM`, `NIP`, `status`, `thnajaran`, `semester`, `tipe_user`, `confirmcapes`, `confirmfair`, `softdelete`, `date_created`, `date_modified`) VALUES
(1, 'admin', '$2a$10$Z879iN.oObibsaILr4p1leqAcvBZdhrn3mOYxBm1cTd52NtgDNMai', 'yes', '', '', '12345678', 'staff', '2022', 'Ganjil', 'yyyn', 'Ya', 'Ya', 'no', '2022-04-26 16:26:11', '2022-06-12 02:10:32'),
(4, 'testuser', '$2y$10$FZkifDRx3IbjaP3yZuVCE.UgV2.kR3T994b6x0EUwU5agLeTr/oqC', 'yes', '12345678', '', '', 'baru', '2022', 'Ganjil', 'nnny', 'Ya', 'Ya', 'no', '2022-04-27 15:09:03', '2022-07-28 03:19:37'),
(9, 'testpenilai', '$2y$10$3eDBjIjuTKbogxF1QByUK.o7ZDntmOy0DIkZa0lG/64wfyPvORqtq', 'yes', '', NULL, '123456', 'staff', '2022', 'Ganjil', 'nnyn', 'Ya', 'Ya', 'no', '2022-05-26 23:11:56', '2022-06-02 14:29:08'),
(7, 'i.gde31', '$2y$10$6HJNDbikTBwF04BDWfXOLukc1t.1oos5VLRYAhtgdOcOO/wjc.IY2', 'yes', '12345678', '', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'Ya', 'no', '2022-05-21 14:29:20', '2022-07-25 03:56:51'),
(10, 'test', '$2y$10$54vDOK5uNazTG4Ya8ypIeObT4ZyGO5qmjF1BwSkV5GmjE4R/fDjem', 'yes', '', '123456', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'Ya', 'no', '2022-06-02 02:36:57', '2022-07-25 16:46:54'),
(11, 'adminbiasa', '$2y$10$BDrPcor7LZ9It8RczzpYTOska9dnOOvFmJ5edaWg3OkJJWxmb3.r2', 'yes', '', '', '12345678', 'staff', '2022', 'Ganjil', 'nynn', 'Ya', 'Ya', 'no', '2022-06-02 04:45:11', '2022-06-02 05:13:55'),
(12, 'peserta', '$2y$10$E607d/M1SwbjS71xjAhEH.z65BVdK1cfgH/8x2z8yIL5L9Hqh/Ge6', 'yes', '', '04000123456', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'Ya', 'no', '2022-06-12 02:11:01', '2022-08-14 04:33:55'),
(13, 'testpeserta', '$2y$10$Zt9glZT/CKHFu9L.ERkYYuzWR4Ep3WRiN4ftUa/vf.lc2Zmd1wbCG', 'yes', '123456', '123456', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'Ya', 'no', '2022-07-25 04:51:25', '2022-07-25 04:51:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
