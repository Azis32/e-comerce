-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2019 at 08:20 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_broadcast`
--

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=294 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tdosenmatkul`
--

CREATE TABLE IF NOT EXISTS `tdosenmatkul` (
  `kd_dm` varchar(10) NOT NULL,
  `kd_matkul` varchar(8) NOT NULL COMMENT 'foreigen key dari tabel matkul',
  `no_reg` varchar(18) NOT NULL COMMENT 'foreigen key dari tabel pengguna',
  `semester` enum('1','2') NOT NULL,
  `tahun` int(4) NOT NULL,
  PRIMARY KEY (`kd_dm`),
  KEY `kd_matkul` (`kd_matkul`,`no_reg`),
  KEY `no_reg` (`no_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tjadwal`
--

CREATE TABLE IF NOT EXISTS `tjadwal` (
  `kd_jadwal` bigint(20) NOT NULL AUTO_INCREMENT,
  `hari` varchar(10) NOT NULL,
  `jam` enum('1','2','3','4') NOT NULL,
  `kelas` enum('A','B','C','D','E') NOT NULL,
  `semester` int(2) NOT NULL,
  `jurusan` int(3) NOT NULL,
  `kd_dm` varchar(10) DEFAULT NULL COMMENT 'foreigen key dari tabel dosenmatkul',
  PRIMARY KEY (`kd_jadwal`),
  KEY `kd_kelas` (`kd_dm`),
  KEY `kd_dm` (`kd_dm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1394 ;

-- --------------------------------------------------------

--
-- Table structure for table `tjurusan`
--

CREATE TABLE IF NOT EXISTS `tjurusan` (
  `kd_jurusan` int(3) NOT NULL,
  `nm_jurusan` varchar(30) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`kd_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tkrs`
--

CREATE TABLE IF NOT EXISTS `tkrs` (
  `kd_krs` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_reg` varchar(18) NOT NULL COMMENT 'foreigen key dari tabel pengguna',
  `kd_dm` varchar(10) NOT NULL COMMENT 'foreigen key dari tabel dosenmatkul',
  `semester` enum('1','2') NOT NULL,
  `tahun` int(4) NOT NULL,
  PRIMARY KEY (`kd_krs`),
  KEY `no_reg` (`no_reg`,`kd_dm`),
  KEY `kd_dm` (`kd_dm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmatkul`
--

CREATE TABLE IF NOT EXISTS `tmatkul` (
  `kd_matkul` varchar(8) NOT NULL,
  `nm_matkul` varchar(30) NOT NULL,
  `sks` int(2) NOT NULL,
  `semester` varchar(4) NOT NULL,
  `kd_jurusan` int(3) NOT NULL COMMENT 'foreigen key dari tabel jurusan',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_matkul`),
  KEY `kd_jurusan` (`kd_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tpengguna`
--

CREATE TABLE IF NOT EXISTS `tpengguna` (
  `no_reg` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kelamin` enum('l','p') DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(13) NOT NULL,
  `kd_jurusan` int(3) DEFAULT NULL COMMENT 'foreigen key dari tabel jurusan',
  `kelas` enum('A','B','C','D','E') DEFAULT NULL,
  `thn_akademik` varchar(10) DEFAULT NULL,
  `jabatan` enum('TU','Dosen','Mahasiswa') NOT NULL,
  `level` enum('1','2','3','4') NOT NULL,
  `pin` varchar(4) NOT NULL DEFAULT '1234',
  `pass` varchar(64) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`no_reg`),
  UNIQUE KEY `no_reg` (`no_reg`),
  KEY `kd_jurusan` (`kd_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tdosenmatkul`
--
ALTER TABLE `tdosenmatkul`
  ADD CONSTRAINT `tdosenmatkul_ibfk_4` FOREIGN KEY (`no_reg`) REFERENCES `tpengguna` (`no_reg`),
  ADD CONSTRAINT `tdosenmatkul_ibfk_5` FOREIGN KEY (`kd_matkul`) REFERENCES `tmatkul` (`kd_matkul`);

--
-- Constraints for table `tjadwal`
--
ALTER TABLE `tjadwal`
  ADD CONSTRAINT `tjadwal_ibfk_1` FOREIGN KEY (`kd_dm`) REFERENCES `tdosenmatkul` (`kd_dm`);

--
-- Constraints for table `tkrs`
--
ALTER TABLE `tkrs`
  ADD CONSTRAINT `tkrs_ibfk_1` FOREIGN KEY (`no_reg`) REFERENCES `tpengguna` (`no_reg`),
  ADD CONSTRAINT `tkrs_ibfk_2` FOREIGN KEY (`kd_dm`) REFERENCES `tdosenmatkul` (`kd_dm`);

--
-- Constraints for table `tmatkul`
--
ALTER TABLE `tmatkul`
  ADD CONSTRAINT `tmatkul_ibfk_1` FOREIGN KEY (`kd_jurusan`) REFERENCES `tjurusan` (`kd_jurusan`);

--
-- Constraints for table `tpengguna`
--
ALTER TABLE `tpengguna`
  ADD CONSTRAINT `tpengguna_ibfk_1` FOREIGN KEY (`kd_jurusan`) REFERENCES `tjurusan` (`kd_jurusan`);
