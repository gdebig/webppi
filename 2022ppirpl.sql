-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Tbl_Bahasa`;
CREATE TABLE `Tbl_Bahasa` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `LangType` enum('Da','Na','In') DEFAULT NULL,
  `VerbSkill` enum('P','T','L','A') DEFAULT NULL,
  `WriteType` text DEFAULT NULL,
  `LangMark` varchar(50) DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian VI';


DROP TABLE IF EXISTS `Tbl_Ethicref`;
CREATE TABLE `Tbl_Ethicref` (
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
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian II.1';


DROP TABLE IF EXISTS `Tbl_Inovasi`;
CREATE TABLE `Tbl_Inovasi` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Year` year(4) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Publication` varchar(100) DEFAULT NULL,
  `PubLevel` enum('Lok','Nas','Int') DEFAULT NULL,
  `DiffBenefit` enum('ren','sed','tin','stin') DEFAULT NULL,
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.4';


DROP TABLE IF EXISTS `Tbl_Karyatulis`;
CREATE TABLE `Tbl_Karyatulis` (
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
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.1';


DROP TABLE IF EXISTS `Tbl_Kualifikasi`;
CREATE TABLE `Tbl_Kualifikasi` (
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
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian III';


DROP TABLE IF EXISTS `Tbl_Makalahseminar`;
CREATE TABLE `Tbl_Makalahseminar` (
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
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian V.2 dan V.3';


DROP TABLE IF EXISTS `Tbl_Organisasi`;
CREATE TABLE `Tbl_Organisasi` (
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
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.3';


DROP TABLE IF EXISTS `Tbl_Pelatihan`;
CREATE TABLE `Tbl_Pelatihan` (
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
  `Desc` tinytext DEFAULT NULL,
  `File` varchar(500) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Num`),
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `Tbl_Pendapat`;
CREATE TABLE `Tbl_Pendapat` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Desc` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian II.2';


DROP TABLE IF EXISTS `Tbl_Pendidikan`;
CREATE TABLE `Tbl_Pendidikan` (
  `Num` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Rank` enum('D3','D4','S1','S2','S3','Ir.') DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Faculty` varchar(100) DEFAULT NULL,
  `Major` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Province` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `GradYear` year(4) DEFAULT NULL,
  `Degree` year(4) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Desc` text DEFAULT NULL,
  `Mark` float DEFAULT NULL,
  `Judicium` varchar(100) DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.2';


DROP TABLE IF EXISTS `Tbl_Pengalaman`;
CREATE TABLE `Tbl_Pengalaman` (
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
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian IV';


DROP TABLE IF EXISTS `Tbl_Penghargaan`;
CREATE TABLE `Tbl_Penghargaan` (
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
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.4';


DROP TABLE IF EXISTS `Tbl_Profile`;
CREATE TABLE `Tbl_Profile` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `StartPeriod` year(4) DEFAULT NULL,
  `EndPeriod` year(4) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `BirthPlace` varchar(100) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `KTA` varchar(50) DEFAULT NULL,
  `Vocational` enum('Ars','Ele','Fis','BumE','Wil','Ind','Kim','Mes','Lin','Min','Tam','Sip','Mat','Hut','Met','Tan','Ter','IndT','inf','Dir','Lau','Nuk','Kap','Ikn','TekT','Tra','KerA') DEFAULT NULL,
  `HAddr` varchar(200) DEFAULT NULL,
  `HCity` varchar(100) DEFAULT NULL,
  `HPostnum` varchar(20) DEFAULT NULL,
  `Work` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `WAddr` varchar(200) DEFAULT NULL,
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
  `Photo` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.1';


DROP TABLE IF EXISTS `Tbl_Sertifikat`;
CREATE TABLE `Tbl_Sertifikat` (
  `Num` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID` bigint(20) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Organizer` varchar(100) DEFAULT NULL,
  `Kota` varchar(200) DEFAULT NULL,
  `Prov` varchar(200) DEFAULT NULL,
  `Country` varchar(200) DEFAULT NULL,
  `StartYear` year(4) DEFAULT NULL,
  `StartMonth` int(11) DEFAULT NULL,
  `EndYear` year(4) DEFAULT NULL,
  `EndMonth` int(11) DEFAULT NULL,
  `Level` enum('Das','Lan') DEFAULT NULL,
  `Length` enum('sd36','smp100','smp240','lbh240') DEFAULT NULL,
  `Desc` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Num`) USING BTREE,
  KEY `ID` (`ID`),
  CONSTRAINT `Tbl_Sertifikat_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Tbl_Profile` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Tbl_Sertifikat_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `Tbl_Profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Bagian I.5 dan I.6';


DROP TABLE IF EXISTS `Tbl_User`;
CREATE TABLE `Tbl_User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` enum('yes','no') NOT NULL,
  `NPM` varchar(100) DEFAULT NULL,
  `NIP` varchar(100) DEFAULT NULL,
  `status` enum('baru','diterima','ditolak','lulus','keluar') NOT NULL,
  `tipe_user` varchar(4) NOT NULL,
  `date_created` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


-- 2022-04-26 16:14:24
