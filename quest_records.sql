-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2021 at 05:42 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quest_records`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inwards`
--

DROP TABLE IF EXISTS `tbl_inwards`;
CREATE TABLE IF NOT EXISTS `tbl_inwards` (
  `sno` int NOT NULL AUTO_INCREMENT,
  `inward_date` date NOT NULL,
  `outward_num_sending_office` int NOT NULL,
  `subject` varchar(120) NOT NULL,
  `sender_office` varchar(100) NOT NULL,
  `inward_num_cs_dept` int NOT NULL,
  `received_by_cs_dept` varchar(100) NOT NULL,
  `file_name_placed` varchar(100) DEFAULT NULL,
  `file_no_record` varchar(45) DEFAULT NULL,
  `remarks` varchar(120) DEFAULT NULL,
  `rec_id` int DEFAULT NULL,
  `image_url` varchar(355) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_inwards`
--

INSERT INTO `tbl_inwards` (`sno`, `inward_date`, `outward_num_sending_office`, `subject`, `sender_office`, `inward_num_cs_dept`, `received_by_cs_dept`, `file_name_placed`, `file_no_record`, `remarks`, `rec_id`, `image_url`) VALUES
(7, '2021-01-13', 10, 'ACRs', 'Registrar', 22, 'Aftab', 'Registrar', '12', '', NULL, 'imginwards/95303_1612973039.png'),
(4, '2021-01-13', 234, 'sdfsd', 'Provost', 234, 'sdfsd', 'Provost', '453', 'dsf', NULL, 'imginwards/548482_1610518759.png'),
(5, '2021-01-05', 123, 'fdsasd', 'Director Finance', 123, 'sdfsd', 'Director Finance', '453', '', NULL, 'imginwards/64900_1610518731.png'),
(6, '2021-01-04', 567, 'dfg', 'Dean FoS', 23, 'sdfsd', 'Dean FoS', 'sdf', '', NULL, 'imginwards/188425_1610518917.png'),
(8, '2021-02-09', 2342, 'sdfds', 'Dean FoS', 32, 'sdf', 'Dean FoS', '322', '', NULL, 'imginwards/741439_1612976490.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_outwards`
--

DROP TABLE IF EXISTS `tbl_outwards`;
CREATE TABLE IF NOT EXISTS `tbl_outwards` (
  `sno` int NOT NULL AUTO_INCREMENT,
  `outward_date` date NOT NULL,
  `outward_num` int NOT NULL,
  `subject` varchar(120) NOT NULL,
  `destination_office` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `receiving_person_destination_office` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `office_copy_file_name_placed` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `office_copy_file_no_record` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `remarks` varchar(120) DEFAULT NULL,
  `rec_id` int DEFAULT NULL,
  `image_url` varchar(355) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_outwards`
--

INSERT INTO `tbl_outwards` (`sno`, `outward_date`, `outward_num`, `subject`, `destination_office`, `receiving_person_destination_office`, `office_copy_file_name_placed`, `office_copy_file_no_record`, `remarks`, `rec_id`, `image_url`) VALUES
(4, '2021-01-05', 324, 'hjdf', 'Director Finance', 'dsfsd', 'Director Finance', '432', '', NULL, 'imgoutwards/677490_1610518872.png'),
(8, '2021-02-09', 32, 'fdsasd', 'Dean FoS', 'dsfsd', 'Dean FoS', 'sdfd', 'dsf', NULL, 'imgoutwards/757221_1612974192.png'),
(7, '2021-02-15', 345, 'ACRs', 'Registrar', 'sdfsd', 'Registrar', '432', '', NULL, 'imgoutwards/740481_1612974088.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_senderoffice`
--

DROP TABLE IF EXISTS `tbl_senderoffice`;
CREATE TABLE IF NOT EXISTS `tbl_senderoffice` (
  `sno` int NOT NULL AUTO_INCREMENT,
  `sender_office_name` varchar(255) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_senderoffice`
--

INSERT INTO `tbl_senderoffice` (`sno`, `sender_office_name`) VALUES
(4, 'Registrar'),
(3, 'Dean FoS'),
(5, 'Director Finance'),
(7, 'Provost');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `mobile` int DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `mobile`, `password`) VALUES
(13, 'shan3', 'shan@s.com', 12312312, ''),
(14, 'admin', NULL, NULL, '$2y$10$eUkeIneMThHgv47AFgyzrerxABaYZCGBGPS3UHeHibCWPeKYFpdDu'),
(12, 'shan2', NULL, NULL, '$2y$10$pb3tipC45CCmxPQ8XX..bOZx4zj4eK0y2v/4YpL6AuCB7Y/uql79O');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
