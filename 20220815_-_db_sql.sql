-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2022 at 02:06 AM
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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian VI';

--
-- Dumping data for table `tbl_bahasa`
--

INSERT INTO `tbl_bahasa` (`Num`, `user_id`, `Name`, `LangType`, `VerbSkill`, `WriteType`, `LangMark`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Inggris', 'In', 'Aktif', 'Jurnal', '', '', '', '2022-08-14 05:10:22', '2022-08-13 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.4';

--
-- Dumping data for table `tbl_inovasi`
--

INSERT INTO `tbl_inovasi` (`Num`, `user_id`, `Name`, `Year`, `Month`, `Publication`, `PubLevel`, `DiffBenefit`, `Desc`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Test', 2022, 1, 'Apalah', 'Nas', 'sed', 'Test saja lagi', '4_inovasi_test_406cd7fb.pdf', '', '2022-08-14 03:20:57', '2022-08-12 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.1';

--
-- Dumping data for table `tbl_karyatulis`
--

INSERT INTO `tbl_karyatulis` (`Num`, `user_id`, `Name`, `Media`, `LocCity`, `LocProv`, `LocCountry`, `Year`, `Month`, `Mediatype`, `Diffbenefit`, `Desc`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Test Kartul Saja', 'IOP Advanced', 'Depok', NULL, 'Indonesia', '2020', 'Januari', 'Int', 'sed', 'Tentang Jaringan', NULL, '', '2022-05-08 15:52:31', '2022-05-07 17:00:00'),
(3, 7, 'Karya Tulis 1', 'Media Nasional', 'Jakarta', NULL, 'Indonesia', '2022', 'Januari', 'Lok', 'ren', 'Tulisan insinyur', '', '', '2022-05-20 17:00:00', '2022-05-20 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian III';

--
-- Dumping data for table `tbl_kualifikasi`
--

INSERT INTO `tbl_kualifikasi` (`Num`, `user_id`, `StartDate`, `EndDate`, `NameInstance`, `Position`, `Name`, `Giver`, `LocCity`, `LocProv`, `LocCountry`, `Duration`, `Jabatan`, `ProjValue`, `RspnValue`, `Hresource`, `Diff`, `Scale`, `Desc`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(1, 7, '2014-08-04', '0000-00-00', 'Fakultas Teknik', 'Penanggung Jawab', 'Pembuatan web silegal', 'KaPuskom FT UI', 'Depok', 'Jawa Barat', 'Indonesia', 'smp3', 'supervisor', '10000000', '30', 'dik', 'sed', 'sed', 'Membuat website silegal.eng.ui.ac.id', '7_pengkerja_FakultasTeknik_PenanggungJawab.jpg', '', '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(2, 4, '2022-07-01', '0000-00-00', 'Fakultas Teknik', 'Programmer', 'Proyek WebPPI', 'Prodi PPI', 'Depok', 'Jawa Barat', 'Indonesia', 'smp3', 'supervisor', 'Rp. 51,000,000.00', 'Programmer', 'dik', 'ren', 'ren', 'Membuat website', '4_pengkerja_fakultasteknik_programmer.pdf', '', '2022-08-11 16:21:57', '2022-08-10 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.2 dan V.3';

--
-- Dumping data for table `tbl_makalahseminar`
--

INSERT INTO `tbl_makalahseminar` (`Num`, `user_id`, `Type`, `PaperName`, `Name`, `Organizer`, `LocCity`, `LocProv`, `LocCountry`, `Year`, `Month`, `Level`, `DiffBenefit`, `Desc`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Sem', 'Judul Test', 'Seminar Latihan', 'Latihan', 'Depok', NULL, 'Indonesia', '2022', 'Mei', 'Nas', 'sed', 'Seminar Jaringan', NULL, '', '2022-05-08 17:34:07', '2022-05-07 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.3';

--
-- Dumping data for table `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`Num`, `user_id`, `Name`, `Type`, `City`, `Country`, `Period`, `StartPeriodBulan`, `StartPeriodYear`, `EndPeriodBulan`, `EndPeriodYear`, `Position`, `OrgLevel`, `OrgScp`, `Desc`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Organisasi Saja', 'Non', 'Depok', 'Indonesia', 'smp15', 'Maret', 2018, 'Maret', 2023, 'Peng', 'Reg', 'Mas', 'Membantu Pengurus', '4_organisasi_OrganisasiSaja_Peng.pdf', '', '2022-05-07 22:47:47', '2022-05-06 17:00:00'),
(3, 7, 'KMHDI', 'Non', 'Jakarta', 'Indonesia', 'sd5', 'Januari', 2014, 'Januari', 2018, 'Pimp', 'Nas', 'Mas', 'Organisasi kemahasiswaan saja', NULL, '', '2022-05-22 03:57:50', '2022-05-20 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian IV';

--
-- Dumping data for table `tbl_pengalaman`
--

INSERT INTO `tbl_pengalaman` (`Num`, `user_id`, `Institution`, `Name`, `LocCity`, `LocProv`, `LocCountry`, `Period`, `StartPeriod`, `EndPeriod`, `Position`, `Skshour`, `Desc`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(2, 4, 'Universitas Indonesia', 'Database', 'Depok', 'Jawa Barat', 'Indonesia', 'smp9', 2020, 2022, 'Stf', 'sks4', 'Mengajar Database', '4_pengajar_universitasindonesia_database.pdf', '', '2022-08-12 01:52:50', '2022-08-10 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.4';

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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Num`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sertifikat`
--

INSERT INTO `tbl_sertifikat` (`Num`, `user_id`, `Jenis`, `Name`, `Organizer`, `Kota`, `Prov`, `Country`, `StartYear`, `StartMonth`, `EndYear`, `EndMonth`, `Level`, `Length`, `Description`, `File`, `kompetensi`, `date_created`, `date_modified`) VALUES
(3, 4, 'sertifikat', 'Sertifikat apalah', 'Huawei', 'Depok', '', 'Indonesia', '2022', 'April', '', '', 'Dasar', 'sd36', 'Training Sederhana', '', '', '2022-05-08 03:10:20', '2022-05-08 03:10:20'),
(4, 7, 'pelatihan', 'Pelatihan Cisco', 'Cisco', 'Depok', '', 'Indonesia', '2020', 'Januari', '', '', 'Dasar', 'sd36', 'Pelatihan jaringan', '7_pelatihan_PelatihanCisco.pdf', '', '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(5, 7, 'pelatihan', 'Sertifikat CEH', 'ECCouncil', 'Depok', '', 'Indonesia', '2021', 'September', '', '', 'Dasar', 'sd36', 'Pelatihan keamanan security', '7_pelatihan_SertifikatCEH.jpeg', '', '2022-05-20 17:00:00', '2022-05-20 17:00:00'),
(6, 7, 'sertifikat', 'Sertifikat CEH', 'ECCouncil', 'Depok', '', 'Indonesia', '2021', 'Agustus', '', '', 'Dasar', 'sd36', 'Sertifikat Keamanan Jaringan', '7_sertifikat_SertifikatCEH.jpg', '', '2022-05-20 17:00:00', '2022-05-20 17:00:00');

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
  `softdelete` varchar(3) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `active`, `nodaftar`, `NPM`, `NIP`, `status`, `thnajaran`, `semester`, `tipe_user`, `confirmcapes`, `softdelete`, `date_created`, `date_modified`) VALUES
(1, 'admin', '$2a$10$Z879iN.oObibsaILr4p1leqAcvBZdhrn3mOYxBm1cTd52NtgDNMai', 'yes', '', '', '12345678', 'staff', '2022', 'Ganjil', 'yyyn', 'Ya', 'no', '2022-04-26 16:26:11', '2022-06-12 02:10:32'),
(4, 'testuser', '$2y$10$FZkifDRx3IbjaP3yZuVCE.UgV2.kR3T994b6x0EUwU5agLeTr/oqC', 'yes', '12345678', '', '', 'baru', '2022', 'Ganjil', 'nnny', 'Ya', 'no', '2022-04-27 15:09:03', '2022-07-28 03:19:37'),
(9, 'testpenilai', '$2y$10$3eDBjIjuTKbogxF1QByUK.o7ZDntmOy0DIkZa0lG/64wfyPvORqtq', 'yes', '', NULL, '123456', 'staff', '2022', 'Ganjil', 'nnyn', 'Ya', 'no', '2022-05-26 23:11:56', '2022-06-02 14:29:08'),
(7, 'i.gde31', '$2y$10$6HJNDbikTBwF04BDWfXOLukc1t.1oos5VLRYAhtgdOcOO/wjc.IY2', 'yes', '12345678', '', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'no', '2022-05-21 14:29:20', '2022-07-25 03:56:51'),
(10, 'test', '$2y$10$54vDOK5uNazTG4Ya8ypIeObT4ZyGO5qmjF1BwSkV5GmjE4R/fDjem', 'yes', '', '123456', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'no', '2022-06-02 02:36:57', '2022-07-25 16:46:54'),
(11, 'adminbiasa', '$2y$10$BDrPcor7LZ9It8RczzpYTOska9dnOOvFmJ5edaWg3OkJJWxmb3.r2', 'yes', '', '', '12345678', 'staff', '2022', 'Ganjil', 'nynn', 'Ya', 'no', '2022-06-02 04:45:11', '2022-06-02 05:13:55'),
(12, 'peserta', '$2y$10$E607d/M1SwbjS71xjAhEH.z65BVdK1cfgH/8x2z8yIL5L9Hqh/Ge6', 'yes', '', '04000123456', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'no', '2022-06-12 02:11:01', '2022-08-14 04:33:55'),
(13, 'testpeserta', '$2y$10$Zt9glZT/CKHFu9L.ERkYYuzWR4Ep3WRiN4ftUa/vf.lc2Zmd1wbCG', 'yes', '123456', '123456', '', 'diterima', '2022', 'Ganjil', 'nnny', 'Ya', 'no', '2022-07-25 04:51:25', '2022-07-25 04:51:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
