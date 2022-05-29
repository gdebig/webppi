-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2022 at 04:40 AM
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
  `VerbSkill` enum('P','T','L','A') DEFAULT NULL,
  `WriteType` text,
  `LangMark` varchar(50) DEFAULT NULL,
  `File` text,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian VI';

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian II.1';

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.4';

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
  `Year` year(4) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Mediatype` enum('Lok','Nas','Int') DEFAULT NULL,
  `Diffbenefit` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.1';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kualifikasi`
--

DROP TABLE IF EXISTS `tbl_kualifikasi`;
CREATE TABLE IF NOT EXISTS `tbl_kualifikasi` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `StartYear` year(4) DEFAULT NULL,
  `StartMonth` varchar(20) DEFAULT NULL,
  `EndYear` year(4) DEFAULT NULL,
  `EndMonth` varchar(20) DEFAULT NULL,
  `NameInstance` varchar(100) DEFAULT NULL,
  `Position` enum('Ang','Sup','Dir','Png') DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Giver` varchar(100) DEFAULT NULL,
  `LocCity` varchar(200) DEFAULT NULL,
  `LocProv` varchar(200) DEFAULT NULL,
  `LocYear` varchar(200) DEFAULT NULL,
  `Duration` enum('smp3','smp5','smp10','lbh10') DEFAULT NULL,
  `Jabatan` enum('anggota','supervisor','direktur','pengarah') DEFAULT NULL,
  `ProjValue` varchar(100) DEFAULT NULL,
  `RspnValue` varchar(100) DEFAULT NULL,
  `Hresource` enum('dik','sed','bny','sbny') DEFAULT NULL,
  `Diff` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Scale` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian III';

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
  `Year` year(4) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Level` enum('Lok','Nas','Int') DEFAULT NULL,
  `DiffBenefit` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text,
  `File` text,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.2 dan V.3';

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.3';

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
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian II.2';

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
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.2';

--
-- Dumping data for table `tbl_pendidikan`
--

INSERT INTO `tbl_pendidikan` (`Num`, `user_id`, `Rank`, `Name`, `Faculty`, `Major`, `City`, `Province`, `Country`, `GradYear`, `Degree`, `Title`, `Desc`, `Mark`, `Judicium`, `File`, `date_created`, `date_modified`) VALUES
(2, 4, 'S1', 'Universitas Indonesia', 'Fakultas Teknik', 'Teknik Elektro', 'Depok', NULL, 'Indonesia', 2005, 'Sarjana Te', 'Judul Tugas Akhir', 'Uraian Singkat', '2,89', 'Yudisium', '4_ijazah_S1.pdf', '2022-05-03 17:00:00', '2022-05-03 17:00:00'),
(3, 4, 'S2', 'Universitas Indonesia', 'Fakultas Teknik', 'Teknik Elektro', 'Depok', NULL, 'Indonesia', 2009, 'Master Teknik', 'Judul Tugas Akhir', 'Uraian Singkat', '3,89', 'Yudisium', '4_ijazah_S2.pdf', '2022-05-03 17:00:00', '2022-05-03 17:00:00');

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian IV';

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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.4';

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
  `SIP` varchar(50) DEFAULT NULL,
  `Vocational` enum('Ars','Ele','Fis','BumE','Wil','Ind','Kim','Mes','Lin','Min','Tam','Sip','Mat','Hut','Met','Tan','Ter','IndT','inf','Dir','Lau','Nuk','Kap','Ikn','TekT','Tra','KerA') DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.1';

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`ID`, `user_id`, `FullName`, `BirthPlace`, `Birthdate`, `KTA`, `SIP`, `Vocational`, `HAddr`, `HCity`, `HPostnum`, `Work`, `Position`, `WAddr`, `WCity`, `Wpostnum`, `Hnum`, `Hfaks`, `Htelex`, `Hemail`, `Hpnum`, `Wnum`, `Wfaks`, `Wtelex`, `Wemail1`, `Wemail2`, `Photo`, `pindahregular`, `date_created`, `date_modified`) VALUES
(2, 4, 'I Gde Dharma Nugraha', 'Jakarta', '2017-02-02', '123456', '', 'Kim', 'Bella Casa Residence Blok A12 no 9\r\nCluster Alamanda Jl. Tole Iskandar', 'Depok', '16431', 'Fakultas Teknik', 'Pengajar', 'Kampus UI', 'Depok', '16424', '021775949385', '', '', 'gdebig@gmail.com', '081558805505', '02177834328', '', '', 'i.gde@ui.ac.id', '', '4_I Gde Dharma Nugraha_profilpic.', 'Ya', '2022-05-03 17:00:00', '2022-05-03 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sertifikat`
--

DROP TABLE IF EXISTS `tbl_sertifikat`;
CREATE TABLE IF NOT EXISTS `tbl_sertifikat` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Organizer` varchar(100) NOT NULL,
  `Kota` varchar(200) NOT NULL,
  `Prov` varchar(200) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `StartYear` year(4) NOT NULL,
  `StartMonth` int(5) NOT NULL,
  `EndYear` year(4) NOT NULL,
  `EndMonth` int(5) NOT NULL,
  `Level` enum('Dasar','Lanjut') NOT NULL,
  `Lenght` enum('sd36','smp100','smp240','lbh240') NOT NULL,
  `Description` text NOT NULL,
  `File` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `status` enum('baru','diterima','ditolak','lulus','keluar') NOT NULL,
  `tipe_user` varchar(4) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `active`, `nodaftar`, `NPM`, `NIP`, `status`, `tipe_user`, `date_created`, `date_modified`) VALUES
(1, 'admin', '$2a$10$Z879iN.oObibsaILr4p1leqAcvBZdhrn3mOYxBm1cTd52NtgDNMai', 'yes', '', NULL, '123456', 'diterima', 'nnny', '2022-04-26 16:26:11', '2022-04-28 03:13:02'),
(4, 'testuser', '$2y$10$FZkifDRx3IbjaP3yZuVCE.UgV2.kR3T994b6x0EUwU5agLeTr/oqC', 'yes', '123456', NULL, NULL, 'baru', 'nnny', '2022-04-27 15:09:03', '2022-04-27 15:09:03'),
(5, 'testuser2', '$2y$10$.i3XINSEVIuRtbA6NHuSwOlgAl6GY8Nnro1AKNTgRgCxU3RIG67qy', 'yes', '1234567', NULL, NULL, 'baru', 'nnny', '2022-04-28 19:23:09', '2022-04-28 19:23:09'),
(6, 'testuser3', '$2y$10$KxPcPiOD9J.BQgZQWGoUL.NSZ8gozw6.aVEs8a1Hn8KYvwPuDgNyq', 'yes', '1234567', NULL, NULL, 'baru', 'nnny', '2022-04-28 19:23:53', '2022-04-28 19:23:53');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
